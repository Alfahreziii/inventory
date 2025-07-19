<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Pest\Plugins\Bail;
use App\Models\Bahanbaku;
use App\Models\Namabahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class BahanbakuController extends Controller
{

    public function cetakPDF(Request $request)
{
    $request->validate([
        'bulan' => 'required|integer|min:1|max:12',
        'tahun' => 'required|integer',
    ]);

    $bulan = $request->bulan;
    $tahun = $request->tahun;

    $data = Bahanbaku::join('namabahans', 'bahanbakus.id_bahan', '=', 'namabahans.id')
        ->select(
            'namabahans.nama_bahan',
            'namabahans.code_barang',
            'bahanbakus.tgl_masuk',
            'bahanbakus.sisa'
        )
        ->whereMonth('tgl_masuk', $bulan)
        ->whereYear('tgl_masuk', $tahun)
        ->get();

    $pdf = PDF::loadView('pdf.bahanbaku', [
        'data' => $data,
        'bulan' => Carbon::create()->month($bulan)->locale('id')->monthName,
        'tahun' => $tahun
    ]);

    return $pdf->stream("Laporan-Bahanbaku-$bulan-$tahun.pdf");
}

    public function index(){
        $top = DB::table('users')
        ->select('users.name')
        ->where('users.id', '=', Auth::user()->id)
        ->first();

        return view('bahanbaku/bahanbaku/index',compact('top'));
    }
    public function dashboard(){
        $top = DB::table('users')
        ->select('users.name')
        ->where('users.id', '=', Auth::user()->id)
        ->first();

        return view('bahanbaku/bahanbaku/dashboard',compact('top'));
    }

    public function bahanbaku_kadaluarsa_bulan_ini(Request $request)
    {
        if ($request->ajax()) {
            $currentMonth = now()->month;
            $currentYear = now()->year;

            $data = Bahanbaku::join('namabahans', 'bahanbakus.id_bahan', '=', 'namabahans.id')
                ->whereMonth('tgl_kadaluarsa', $currentMonth)
                ->whereYear('tgl_kadaluarsa', $currentYear)
                ->select(
                    'bahanbakus.id',
                    'tgl_kadaluarsa',
                    'tgl_masuk',
                    'namabahans.code_barang',
                    'nama_bahan',
                    'sisa'
                )

                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return response()->json(['message' => 'Invalid request'], 400);
    }

    public function datatable_bahanbaku(Request $request)
    {
        if ($request->ajax()) {
            $data = Bahanbaku::join('namabahans', 'bahanbakus.id_bahan', '=', 'namabahans.id')
                ->select(
                    'namabahans.id as bahan_id',
                    'nama_bahan',
                    'code_barang',
                    DB::raw('SUM(sisa) as total_sisa')
                )
                ->groupBy('namabahans.id', 'nama_bahan')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $detailUrl = route('detail-group-bahanbaku', ['id' => $row->bahan_id]);
                    return '<a href="'.$detailUrl.'" class="text-sm font-bold text-blue-500">Detail</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return response()->json(['message' => 'Invalid request'], 400);
    }

    public function detailGroup($id)
    {
        $top = DB::table('users')
            ->select('users.name')
            ->where('users.id', '=', Auth::user()->id)
            ->first();

        $bahan = Namabahan::find($id);

        return view('bahanbaku.bahanbaku.detail_group', compact('top', 'bahan'));
    }

    public function datatableDetailGroup(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = Bahanbaku::where('id_bahan', $id)
                ->select('id', 'tgl_kadaluarsa', 'tgl_masuk', 'sisa', 'demand', 'biaya_simpan', 'biaya_pesan', 'harga_total', 'nilai_x')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                        $editUrl = route('edit-bahanbaku', ['id' => $row->id]);
                        $detailUrl = route('detail-bahanbaku', ['id' => $row->id]);

                        $editBtn = '<a href="'.$editUrl.'" class="text-sm font-bold ml-3">Edit</a>';
                        $detailBtn = '<a href="'.$detailUrl.'" class="text-sm font-bold detail ml-3">Detail</a>';

                        // Cek apakah user adalah admin menggunakan Gate
                        $deleteBtn = '';
                        if (Gate::allows('admin-access')) {
                            $deleteBtn = '<button class="delete-btn text-sm font-bold ml-3" data-id="'.$row->id.'">Delete</button>';
                        }

                        return $editBtn . $deleteBtn . $detailBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return response()->json(['message' => 'Invalid request'], 400);
    }

    public function create(){
        $top = DB::table('users')
        ->select('users.name')
        ->where('users.id', '=', Auth::user()->id)
        ->first();

        $data = Namabahan::select('id', 'nama_bahan')->get();

        return view ('bahanbaku/bahanbaku/create', compact('top', 'data'));
    }

    public function store(request $request){

        $request->validate([
            'id_bahan' => ['required'],
            'tgl_kadaluarsa' => ['required'],
            'tgl_masuk' => ['required'],
            'sisa' => ['required'],
            'demand' => ['required'],
            'nilai_x' => ['required'],
        ]);

        $harga = DB::table('namabahans')->where('id', $request->id_bahan)->value('harga');

        $x = $request->nilai_x;
        $biaya_simpan = $x * $harga;
        $harga_total = $request->demand * $harga;
        $biaya_pesan = $x * $harga_total;

        $data['id_bahan'] = $request->id_bahan;
        $data['tgl_kadaluarsa'] = $request->tgl_kadaluarsa;
        $data['tgl_masuk'] = $request->tgl_masuk;
        $data['sisa'] = $request->sisa;
        $data['demand'] = $request->demand;
        $data['biaya_simpan'] = $biaya_simpan;
        $data['biaya_pesan'] = $biaya_pesan;
        $data['harga_total'] = $harga_total;
        $data['nilai_x'] = $x;


        Bahanbaku::create($data);

        return redirect('bahanbaku');
    }

    public function detail(request $request,$id){
        $top = DB::table('users')
        ->select('users.name')
        ->where('users.id', '=', Auth::user()->id)
        ->first();

        $data = Bahanbaku::join('namabahans', 'bahanbakus.id_bahan', '=', 'namabahans.id')
        ->select('bahanbakus.id', 'tgl_kadaluarsa', 'tgl_masuk', 'nama_bahan', 'harga',
        'sisa', 'demand', 'biaya_simpan', 'biaya_pesan', 'harga_total', 'nilai_x')
        ->where('bahanbakus.id' , '=', $id)
        ->first();


        return view('bahanbaku/bahanbaku/detail',compact('data', 'top'));
    }

    public function edit(request $request,$id){
        $top = DB::table('users')
        ->select('users.name')
        ->where('users.id', '=', Auth::user()->id)
        ->first();

        $data = Bahanbaku::join('namabahans', 'bahanbakus.id_bahan', '=', 'namabahans.id')
        ->select('bahanbakus.id', 'tgl_kadaluarsa', 'tgl_masuk', 'nama_bahan', 'harga',
        'sisa', 'demand', 'biaya_simpan', 'biaya_pesan', 'harga_total', 'nilai_x', 'namabahans.id as id_bahan')
        ->where('bahanbakus.id' , '=', $id)
        ->first();

        $namabahan = Namabahan::select('id', 'nama_bahan')->get();

        return view('bahanbaku/bahanbaku/edit',compact('data', 'top', 'namabahan'));
    }

    public function update(request $request,$id) {
        $request->validate([
            'id_bahan' => ['required'],
            'tgl_kadaluarsa' => ['required'],
            'tgl_masuk' => ['required'],
            'sisa' => ['required'],
            'demand' => ['required'],
            'nilai_x' => ['required'],
        ]);

        $harga = DB::table('namabahans')->where('id', $request->id_bahan)->value('harga');

        $x = $request->nilai_x;
        $biaya_simpan = $x * $harga;
        $harga_total = $request->demand * $harga;
        $biaya_pesan = $x * $harga_total;

        $data['id_bahan'] = $request->id_bahan;
        $data['tgl_kadaluarsa'] = $request->tgl_kadaluarsa;
        $data['tgl_masuk'] = $request->tgl_masuk;
        $data['sisa'] = $request->sisa;
        $data['demand'] = $request->demand;
        $data['biaya_simpan'] = $biaya_simpan;
        $data['biaya_pesan'] = $biaya_pesan;
        $data['harga_total'] = $harga_total;
        $data['nilai_x'] = $x;

        Bahanbaku::where('id', '=', $id)->update($data);

        return redirect('bahanbaku');
    }

    public function destroy($id) {
        $bahanbaku = Bahanbaku::find($id);

        if (!$bahanbaku) {
            return response()->json(['message' => 'Data tidak ditemukan!'], 404);
        }

        $bahanbaku->delete();
        return response()->json(['message' => 'Data berhasil dihapus!']);
    }
}
