<?php

namespace App\Http\Controllers;

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

    public function datatable_riwayatpengeluaran(Request $request){
        if ($request->ajax()) {
            $data = RiwayatPengeluaran::join('namabahans', 'riwayat_pengeluarans.id_bahan', '=', 'namabahans.id')
            ->select('riwayat_pengeluarans.id', 'tgl_keluar', 'jumlah', 'namabahans.nama_bahan')
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

    public function store(request $request){

        $request->validate([
            'id_bahan' => ['required'],
            'jumlah' => ['required'],
            'tgl_keluar' => ['required'],
        ]);
        $data['id_bahan'] = $request->id_bahan;
        $data['jumlah'] = $request->jumlah;
        $data['tgl_keluar'] = $request->tgl_keluar;

        $id_bahan = $request->id_bahan;
        $jumlahKeluar = $request->jumlah;

        $bahan = BahanBaku::where('id_bahan', $id_bahan)->first();
        if (!$bahan) {
            return back()->withErrors(['id_bahan' => 'Bahan baku tidak ditemukan.']);
        }

        if ($bahan->sisa < $jumlahKeluar) {
            return back()->withErrors(['jumlah' => 'Jumlah pengeluaran melebihi stok yang tersedia.']);
        }
        $bahan->sisa -= $jumlahKeluar;
        $bahan->save();

        RiwayatPengeluaran::create($data);

        return redirect('riwayat-pengeluaran');
    }
}
