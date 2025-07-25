<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf; // Pastikan kamu pakai package barryvdh/laravel-dompdf
use App\Models\Bahanbaku;
use App\Models\Namabahan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\RiwayatPengeluaran;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PengeluaranController extends Controller
{
    public function index(){
        $top = DB::table('users')
        ->select('users.name')
        ->where('users.id', '=', Auth::user()->id)
        ->first();

        return view('bahanbaku/pengeluaran/index',compact('top'));
    }
public function cetakPDF(Request $request)
{
    $bulan = $request->bulan;
    $tahun = $request->tahun;
    $deskripsi = $request->deskripsi;

    $pengeluarans = RiwayatPengeluaran::whereMonth('tgl_keluar', $bulan)
        ->whereYear('tgl_keluar', $tahun)
        ->with(['namabahan', 'user'])
        ->get();

    $pdf = Pdf::loadView('pdf.pengeluaran', [
        'pengeluarans' => $pengeluarans,
        'bulan' => $bulan,
        'tahun' => $tahun,
        'deskripsi' => $deskripsi
    ])->setPaper('A4', 'portrait');

    return $pdf->stream("pengeluaran_{$bulan}_{$tahun}.pdf");
}



    public function datatable_riwayatpengeluaran(Request $request){
        if ($request->ajax()) {
            $data = RiwayatPengeluaran::join('namabahans', 'riwayat_pengeluarans.id_bahan', '=', 'namabahans.id')
            ->join('users', 'riwayat_pengeluarans.user_id', '=', 'users.id')
            ->select('riwayat_pengeluarans.id', 'tgl_keluar', 'jumlah', 'namabahans.nama_bahan', 'namabahans.code_barang', 'users.name')
            ->get();// Tambahkan 'id'

            return DataTables::of($data)->make(true);
        }

        return response()->json(['message' => 'Invalid request'], 400);
    }

    public function create(){
        $top = DB::table('users')
        ->select('users.name')
        ->where('users.id', '=', Auth::user()->id)
        ->first();

        $data = Namabahan::select('id', 'nama_bahan')->get();

        return view ('bahanbaku/pengeluaran/create', compact('top', 'data'));
    }

public function store(Request $request)
{
    $request->validate([
        'id_bahan' => ['required'],
        'jumlah' => ['required', 'integer', 'min:1'],
        'tgl_keluar' => ['required'],
        'user_id' => ['required'],
    ]);

    $id_bahan = $request->id_bahan;
    $jumlahKeluar = $request->jumlah;

    // Ambil total stok yang tersedia untuk bahan ini
    $totalSisa = BahanBaku::where('id_bahan', $id_bahan)
        ->where('sisa', '>', 0)
        ->sum('sisa');

    // Validasi: jangan izinkan melebihi stok
    if ($totalSisa < $jumlahKeluar) {
        return back()->withErrors(['jumlah' => 'Jumlah pengeluaran melebihi stok yang tersedia.']);
    }

    // Tidak perlu kurangi stok, hanya simpan pengeluaran
    RiwayatPengeluaran::create([
        'id_bahan' => $id_bahan,
        'jumlah' => $jumlahKeluar,
        'tgl_keluar' => $request->tgl_keluar,
        'user_id' => $request->user_id,
    ]);

    return redirect('riwayat-pengeluaran')->with('success', 'Pengeluaran berhasil dicatat.');
}


}
