<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Namabahan;
use App\Models\Eoq;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class EoqController extends Controller
{
    public function index()
    {
        $top = DB::table('users')
            ->select('users.name')
            ->where('users.id', '=', Auth::user()->id)
            ->first();

        return view('bahanbaku/eoq/index', compact('top'));
    }

    public function create(){
        $top = DB::table('users')
        ->select('users.name')
        ->where('users.id', '=', Auth::user()->id)
        ->first();

        $data = Namabahan::select('id', 'nama_bahan')->get();

        return view ('bahanbaku/eoq/create', compact('top', 'data'));
    }

    public function store(request $request){

        $request->validate([
            'id_bahan' => ['required'],
            'biaya_pesan' => ['required'],
            'biaya_simpan' => ['required'],
            'demand' => ['required'],
        ]);

        $data['id_bahan'] = $request->id_bahan;
        $data['biaya_pesan'] = $request->biaya_pesan;
        $data['biaya_simpan'] = $request->biaya_simpan;
        $data['demand'] = $request->demand;

        Eoq::create($data);

        return redirect('eoq');
    }
    public function datatable_eoq(Request $request){
        if ($request->ajax()) {
            $data = Eoq::join('namabahans', 'eoqs.id_bahan', '=', 'namabahans.id')
                ->select(
                    'eoqs.id',
                    'namabahans.code_barang',
                    'namabahans.nama_bahan',
                    'eoqs.demand',
                    'eoqs.biaya_pesan',
                    'eoqs.biaya_simpan',
                    DB::raw('ROUND(SQRT((2 * eoqs.demand * eoqs.biaya_pesan) / eoqs.biaya_simpan), 2) as nilai_eoq'),
                    DB::raw('ROUND(((eoqs.demand / SQRT((2 * eoqs.demand * eoqs.biaya_pesan) / eoqs.biaya_simpan)) * eoqs.biaya_pesan) + ((SQRT((2 * eoqs.demand * eoqs.biaya_pesan) / eoqs.biaya_simpan) / 2) * eoqs.biaya_simpan), 2) as nilai_tic'),
                    DB::raw('ROUND(eoqs.demand / SQRT((2 * eoqs.demand * eoqs.biaya_pesan) / eoqs.biaya_simpan), 2) as frekuensi_pembelian')
                )
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('edit-eoq', ['id' => $row->id]);
                    $detailUrl = route('detail-eoq', ['id' => $row->id]);

                    $editBtn = '<a href="'.$editUrl.'" class="text-sm font-bold text-[#035233]">Edit</a>';
                    $detailBtn = '<a href="'.$detailUrl.'" class="text-sm font-bold detail ml-3">Detail</a>';

                    $deleteBtn = '';
                    if (\Gate::allows('admin-access')) {
                        $deleteBtn = '<button class="delete-btn text-sm font-bold ml-3" data-id="'.$row->id.'">Delete</button>';
                    }

                    return $editBtn . $deleteBtn . $detailBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return response()->json(['message' => 'Invalid request'], 400);
    }

    public function edit(request $request,$id){
        $top = DB::table('users')
        ->select('users.name')
        ->where('users.id', '=', Auth::user()->id)
        ->first();

        $data = Eoq::join('namabahans', 'eoqs.id_bahan', '=', 'namabahans.id')
        ->select('eoqs.id', 'biaya_pesan', 'biaya_simpan', 'nama_bahan', 'demand', 'namabahans.id as id_bahan')
        ->where('eoqs.id' , '=', $id)
        ->first();

        $namabahan = Namabahan::select('id', 'nama_bahan')->get();

    return view('bahanbaku/eoq/edit',compact('data', 'top', 'namabahan'));
    }

    public function update(request $request,$id) {
        $request->validate([
            'id_bahan' => ['required'],
            'biaya_pesan' => ['required'],
            'demand' => ['required'],
            'biaya_simpan' => ['required'],
        ]);

        $data['id_bahan'] = $request->id_bahan;
        $data['biaya_pesan'] = $request->biaya_pesan;
        $data['demand'] = $request->demand;
        $data['biaya_simpan'] = $request->biaya_simpan;

        Eoq::where('id', '=', $id)->update($data);

        return redirect('eoq');
    }

    public function destroy($id) {
        $eoq = Eoq::find($id);

        if (!$eoq) {
            return response()->json(['message' => 'Data tidak ditemukan!'], 404);
        }

        $eoq->delete();
    return response()->json(['message' => 'Data berhasil dihapus!']);
    }

    public function detail(request $request,$id){
        $top = DB::table('users')
        ->select('users.name')
        ->where('users.id', '=', Auth::user()->id)
        ->first();

        $data = Eoq::join('namabahans', 'eoqs.id_bahan', '=', 'namabahans.id')
        ->select('eoqs.id', 'biaya_pesan', 'biaya_simpan', 'nama_bahan', 'demand', 'namabahans.id as id_bahan')
        ->where('eoqs.id' , '=', $id)
        ->first();


    return view('bahanbaku/eoq/detail',compact('data', 'top'));
    }

}
