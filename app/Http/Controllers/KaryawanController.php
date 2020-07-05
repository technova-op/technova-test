<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\User;
use DataTables;

class KaryawanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view($id)
    {
        $this->authorize('master');

        $user = User::findOrFail($id);

        return view('admin.karyawan.view', compact('user'));
    }

    public function create()
    {
        $this->authorize('master');

        return view('admin.karyawan.create');
    }

    public function addKaryawan(Request $request)
    {
        $this->authorize('master');
        DB::beginTransaction();
            try {
            $user = new User();
            $user->role_id = 2;
            $user->name = $request->name;
            $user->nip = $request->nip;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->jenis_kelamin = $request->jenis_kelamain;
            $user->save();

            DB::commit();
            toastr()->success('Data berhasil ditambah', 'Input success!');

            return redirect()->route('admin.karyawan');
        } catch (Exception $e) {
            DB::rollback();
            toastr()->error('Proses gagal!', 'Terjadi kesalahan input');
        }
    }

    public function edit($id)
    {
        $this->authorize('master');

        $user = User::findOrFail($id);

        return view('admin.karyawan.edit', compact('user'));

    }

    public function update(Request $request, $id)
    {
        $this->authorize('master');
        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            if($request->name){
                $user->name = $request->name;
            }
            if($request->nip){
                $user->nip = $request->nip;
            }
            if($request->email){
                $user->email = $request->email;
            }
            if($request->password){
                $user->password = bcrypt($request->password);
            }
            if($request->jenis_kelamain){
                $user->jenis_kelamin = $request->jenis_kelamain;
            }
            $user->save();

            DB::commit();
            toastr()->success('Data berhasil diupdate', 'Input success!');
            return redirect()->route('admin.karyawan');
        } catch (Exception $e) {
            DB::rollback();
            toastr()->error('Proses gagal!', 'Terjadi kesalahan input');
        }
    }
}
