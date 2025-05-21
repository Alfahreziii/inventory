<?php

namespace App\Http\Controllers;

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
    public function index(){
        $top = DB::table('users')
        ->select('users.name')
        ->where('users.id', '=', Auth::user()->id)
        ->first();

        return view('bahanbaku/bahanbaku/index',compact('top'));
    }

    public function datatable_bahanbaku(Request $request)
    {
        if ($request->ajax()) {
            $data = Bahanbaku::join('namabahans', 'bahanbakus.id_bahan', '=', 'namabahans.id')
                ->select('bahanbakus.id', 'tgl_kadaluarsa', 'tgl_masuk', 'nama_bahan',
                    'sisa')
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

        return redirect('dashboard');
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
        'sisa', 'demand', 'biaya_simpan', 'biaya_pesan', 'harga_total', 'nilai_x')
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

        return redirect('dashboard');
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
