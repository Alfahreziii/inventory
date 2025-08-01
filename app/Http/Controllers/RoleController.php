<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\ProfileUpdateRequest;

class RoleController extends Controller
{
    public function index(){
        $top = DB::table('users')
        ->select('users.name')
        ->where('users.id', '=', Auth::user()->id)
        ->first();

        $data = DB::table('users')
        ->select('name', 'email', 'status')
        ->get();

        return view('bahanbaku/role/index', compact('top','data'));
    }

    public function datatable_role(Request $request){
        if ($request->ajax()) {
            $data = DB::table('users')
            ->select('id','name', 'email', 'status')
            ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('edit-role', ['id' => $row->id]);
                    $editBtn = '<a href="'.$editUrl.'" class="text-sm font-bold text-[#035233]">Edit Status</a>';
                    return $editBtn ;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return response()->json(['message' => 'Invalid request'], 400);
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $top = DB::table('users')
        ->select('users.name')
        ->where('users.id', '=', Auth::user()->id)
        ->first();

        $data = DB::table('users')
            ->select('id', 'name', 'email', 'status')
            ->where('id', $request->id)
            ->first();

        return view('bahanbaku/role/edit', compact('top', 'data'), [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        // Validasi hanya field status
        $validated = $request->validate([
            'status' => 'required|in:spv,admin',
        ]);

        // Ambil user berdasarkan ID
        $user = \App\Models\User::findOrFail($id);

        // Update hanya kolom status
        $user->status = $validated['status'];
        $user->save();

        return redirect()->route('role')->with('status', 'Status berhasil diperbarui.');
    }

}
