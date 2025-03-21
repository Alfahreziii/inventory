<?php

namespace App\Http\Controllers;

use App\Models\Namabahan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class NamabahanController extends Controller
{
    public function index() {
        $top = DB::table('users')
        ->select('users.name')
        ->where('users.id', '=', Auth::user()->id)
        ->first();

        $data = Namabahan::select('id', 'nama_bahan', 'harga')
        ->get();

        return view('bahanbaku/bahan/bahan', compact('top','data'));
    }

    public function datatable_namabahan(Request $request){
        if ($request->ajax()) {
            $data = Namabahan::select('id', 'nama_bahan', 'harga')
            ->get();// Tambahkan 'id'

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('edit-namabahan', ['id' => $row->id]);
                    $editBtn = '<a href="'.$editUrl.'" class="text-sm font-bold text-green-500 mr-3">Edit</a>';

                    $deleteBtn = '';
                    if (Gate::allows('admin-access')) {
                        $deleteBtn = '<button class="delete-btn text-sm font-bold mr-3" data-id="'.$row->id.'">Delete</button>';
                    }

                    return $editBtn . $deleteBtn;
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

        return view ('bahanbaku/bahan/create', compact('top'));
    }

    public function store(request $request){

        $request->validate([
            'nama_bahan' => ['required'],
            'harga' => ['required'],
        ]);
        $data['nama_bahan'] = $request->nama_bahan;
        $data['harga'] = $request->harga;

        Namabahan::create($data);

        return redirect('namabahan');
    }

    public function edit(request $request,$id){
        $top = DB::table('users')
        ->select('users.name')
        ->where('users.id', '=', Auth::user()->id)
        ->first();

        $data = Namabahan::select('id', 'nama_bahan', 'harga')
        ->where('id', '=', $id)
        ->first();
        return view('bahanbaku/bahan/edit',compact('data', 'top'));
    }

    public function update(request $request,$id) {
        $request->validate([
            'nama_bahan' => ['required'],
            'harga' => ['required'],
        ]);
        $data['nama_bahan'] = $request->nama_bahan;
        $data['harga'] = $request->harga;

        Namabahan::where('id', '=', $id)->update($data);

        return redirect('namabahan');
    }

    public function destroy($id) {
        $namabahan = Namabahan::find($id);

        if (!$namabahan) {
            return response()->json(['message' => 'Data tidak ditemukan!'], 404);
        }

        $namabahan->delete();
        return response()->json(['message' => 'Data berhasil dihapus!']);
    }
}
