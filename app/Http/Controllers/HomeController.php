<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\User;
use App\Task;
use DataTables;
use Alert;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('read karyawan');

        if(request()->ajax()){
            $data = Task::orderby('tanggal', 'DESC')->where('user_id', Auth::user()->id)->get();
            return Datatables::of($data)
            ->editColumn('tanggal', function($data) {
                return $data->tanggal;
            })
            ->editColumn('tugas', function($data) {
                return $data->tugas;
            })
            ->editColumn('status', function($data) {
                return '<span class="badge badge-primary">' . $data->status . '</span>';
            })
            ->editColumn('action', function($data) {
                return '<a href="home/'.$data->id.'" class="btn btn-success btn-xs"><span class="fa fa-eye"></span></a>';
            })
            ->escapeColumns([])
            ->make(true);
        }

        return view('employee.home');
    }

    public function view($id)
    {
        $this->authorize('read karyawan');

        $task = Task::findOrFail($id);

        $this->authorize('view', $task);

        return view('employee.view', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('read karyawan');

        $task = Task::findOrFail($id);
        $this->authorize('view', $task);

        DB::beginTransaction();
        try {
            $task->status = $request->status;
            $task->save();
            // Commit Transaction
            DB::commit();
            toastr()->success('Proses berhasil!', 'Status task berhasil dirubah');
            return redirect()->route('home');
        } catch (Exception $e) {
            DB::rollback();
            toastr()->error('Proses gagal!', 'Terjadi kesalahan input');
        }
    }

}
