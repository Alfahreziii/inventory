<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Lembur;
use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class LaporanController extends Controller
{
    public function index(){
        $top = DB::table('users')
        ->select('users.name')
        ->where('users.id', '=', Auth::user()->id)
        ->first();

        return view('lembur/lembur/lembur',compact('top'));
    }


    public function datatable_lembur(Request $request){
        if ($request->ajax()) {
            $data = Lembur::join('laporans', function($join) {
                $join->on('lemburs.id_karyawan', '=', 'laporans.id_karyawan')
                     ->whereMonth('laporans.hari_lembur', '=', DB::raw('MONTH(lemburs.tgl_cetak)'))
                     ->whereYear('laporans.hari_lembur', '=', DB::raw('YEAR(lemburs.tgl_cetak)'));
            })
            ->join('karyawans', 'laporans.id_karyawan', '=', 'karyawans.id')
            ->join('kategoris', 'karyawans.kategori_karyawan', '=', 'kategoris.id')
            ->select(
                'karyawans.nama_karyawan',
                DB::raw("DATE_FORMAT(lemburs.tgl_cetak, '%M %Y') AS bulan_tahun"),

                // Total jam kerja hari kerja
                DB::raw("SUM(CASE WHEN DAYOFWEEK(laporans.hari_lembur) NOT IN (1,7) THEN laporans.jam_kerja ELSE 0 END) AS total_jam_kerja_hari_kerja"),

                // Total jam kerja hari libur
                DB::raw("SUM(CASE WHEN DAYOFWEEK(laporans.hari_lembur) IN (1,7) THEN laporans.jam_kerja ELSE 0 END) AS total_jam_kerja_hari_libur"),

                // Total jumlah makan (tidak dibedakan berdasarkan hari)
                DB::raw("SUM(laporans.jml_makan) AS total_jml_makan"),

                // Total biaya hari kerja
                DB::raw("SUM(CASE WHEN DAYOFWEEK(laporans.hari_lembur) NOT IN (1,7) THEN laporans.jam_kerja * kategoris.biaya ELSE 0 END) AS total_biaya_hari_kerja"),

                // Total biaya hari libur (biaya lembur 2x)
                DB::raw("SUM(CASE WHEN DAYOFWEEK(laporans.hari_lembur) IN (1,7) THEN laporans.jam_kerja * (kategoris.biaya * 2) ELSE 0 END) AS total_biaya_hari_libur"),

                // Total upah makan
                DB::raw("SUM(laporans.jml_makan * kategoris.upah_makan) AS total_upah_makan"),

                // Total keseluruhan = biaya hari kerja + biaya hari libur + total upah makan
                DB::raw("
                    SUM(
                        (CASE WHEN DAYOFWEEK(laporans.hari_lembur) NOT IN (1,7) THEN laporans.jam_kerja * kategoris.biaya ELSE 0 END) +
                        (CASE WHEN DAYOFWEEK(laporans.hari_lembur) IN (1,7) THEN laporans.jam_kerja * (kategoris.biaya * 2) ELSE 0 END) +
                        (laporans.jml_makan * kategoris.upah_makan)
                    ) AS total_keseluruhan
                ")
            )
            ->groupBy('karyawans.nama_karyawan', 'bulan_tahun', 'kategoris.biaya', 'kategoris.upah_makan')
            ->orderBy('bulan_tahun', 'asc')
            ->get();


            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $deleteBtn = '<button class="delete-btn text-sm font-bold text-red-500" data-id="'.$row->id.'">Delete</button>';
                    return $deleteBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return response()->json(['message' => 'Invalid request'], 400);
    }


    public function cekLembur(Request $request)
    {
        $tanggal = $request->input('tanggal');

        if (!$tanggal) {
            return response()->json(['error' => 'Tanggal tidak boleh kosong'], 400);
        }

        // Konversi ke format Carbon
        $date = Carbon::parse($tanggal);
        $hari = $date->format('l'); // Mendapatkan nama hari (Monday, Tuesday, etc.)

        // Cek apakah tanggal masuk dalam daftar libur
        $isHoliday = Holiday::where('date', $tanggal)->exists();

        // Cek apakah Sabtu atau Minggu
        if ($isHoliday || $date->isWeekend()) {
            $status = "Hari Libur";
        } else {
            $status = "Hari Kerja";
        }

        return response()->json([
            'tanggal' => $tanggal,
            'hari' => $hari,
            'status' => $status
        ]);
    }
}
