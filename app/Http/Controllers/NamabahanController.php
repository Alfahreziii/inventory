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

    private function generateKodeBarang(): string
    {
        $last = Namabahan::orderBy('id', 'desc')->first();
        $nextId = $last ? $last->id + 1 : 1;

        return 'CB-' . str_pad($nextId, 4, '0', STR_PAD_LEFT); // contoh: CB-0001
    }


    public function index() {
        $top = DB::table('users')
        ->select('users.name')
        ->where('users.id', '=', Auth::user()->id)
        ->first();

        $data = Namabahan::select('id', 'nama_bahan', 'harga')
        ->get();


        return view('bahanbaku/bahan/bahan', compact('top','data'));
    }

    public function datatable_namabahan(Request $request)
    {
        if ($request->ajax()) {
            // Subquery untuk total sisa
            $bahanbakuSub = DB::table('bahanbakus')
                ->select('id_bahan', DB::raw('SUM(sisa) as total_sisa'))
                ->groupBy('id_bahan');

            // Subquery untuk total pengeluaran
            $pengeluaranSub = DB::table('riwayat_pengeluarans')
                ->select('id_bahan', DB::raw('SUM(jumlah) as total_keluar'))
                ->groupBy('id_bahan');

            // Join dengan subquery
            $data = Namabahan::leftJoinSub($bahanbakuSub, 'bahanbakus', function ($join) {
                    $join->on('namabahans.id', '=', 'bahanbakus.id_bahan');
                })
                ->leftJoinSub($pengeluaranSub, 'riwayat_pengeluarans', function ($join) {
                    $join->on('namabahans.id', '=', 'riwayat_pengeluarans.id_bahan');
                })
                ->select(
                    'namabahans.id',
                    'namabahans.nama_bahan',
                    'namabahans.harga',
                    'namabahans.suplier',
                    'namabahans.code_barang',
                    'namabahans.no_hp_suplier',
                    'namabahans.alamat_suplier',
                    DB::raw('COALESCE(bahanbakus.total_sisa, 0) - COALESCE(riwayat_pengeluarans.total_keluar, 0) AS jumlah_bahan')
                )
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('harga', function ($row) {
                    return 'Rp ' . number_format($row->harga, 0, ',', '.');
                })
                ->editColumn('jumlah_bahan', function ($row) {
                    return $row->jumlah_bahan >= 0 ? $row->jumlah_bahan : 0;
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('edit-namabahan', ['id' => $row->id]);
                    $editBtn = '<a href="'.$editUrl.'" class="text-sm font-bold text-[#035233]">Edit</a>';

                    $deleteBtn = '';
                    if (Gate::allows('admin-access')) {
                        $deleteBtn = '<button class="delete-btn text-sm font-bold ml-3" data-id="'.$row->id.'">Delete</button>';
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

    public function store(Request $request)
    {
        $request->validate([
            'nama_bahan' => ['required'],
            'harga' => ['required'],
            'suplier' => ['required'],
            'no_hp_suplier' => ['nullable'],
            'alamat_suplier' => ['nullable'],
        ]);

        $data = [
            'nama_bahan' => $request->nama_bahan,
            'harga' => $request->harga,
            'suplier' => $request->suplier,
            'code_barang' => $this->generateKodeBarang(), // generate otomatis
            'no_hp_suplier' => $request->no_hp_suplier,
            'alamat_suplier' => $request->alamat_suplier,
        ];

        Namabahan::create($data);

        return redirect('namabahan');
    }



    public function edit(Request $request, $id)
    {
        $top = DB::table('users')
            ->select('users.name')
            ->where('users.id', '=', Auth::user()->id)
            ->first();

        $data = Namabahan::where('id', $id)->first(); // tampilkan semua kolom saja langsung

        return view('bahanbaku/bahan/edit', compact('data', 'top'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_bahan' => ['required'],
            'harga' => ['required'],
            'suplier' => ['required'],
            'no_hp_suplier' => ['nullable'],
            'alamat_suplier' => ['nullable'],
        ]);

        $data = [
            'nama_bahan' => $request->nama_bahan,
            'harga' => $request->harga,
            'suplier' => $request->suplier,
            'no_hp_suplier' => $request->no_hp_suplier,
            'alamat_suplier' => $request->alamat_suplier,
        ];

        Namabahan::where('id', $id)->update($data);

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
