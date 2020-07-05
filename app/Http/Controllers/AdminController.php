<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\User;
use DataTables;
use Charts;
use App\Task;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('master');
        $users = User::all();
        $chart_users = Charts::database($users, 'pie', 'highcharts')
			      ->title("User status")
			      ->elementLabel("Total Users")
			      ->dimensions(1000, 500)
			      ->responsive(false)
        	      ->groupBy('status');
        $tasks = Task::where(DB::raw("(DATE_FORMAT(tanggal,'%Y'))"),date('Y'))->get();
        //dd($tasks);
        $chart_tasks = Charts::database($tasks, 'bar', 'highcharts')
			      ->title("Tasks Karyawan")
			      ->elementLabel("Total Tasks Status")
			      ->dimensions(1000, 500)
			      ->responsive(false)
			      ->groupBy('status');
        return view('admin.index',compact('chart_tasks', 'chart_users'));
    }

    public function karyawan()
    {
        $this->authorize('master');

        if(request()->ajax()){
            $karyawan = User::where('role_id', 2)->get();
            return Datatables::of($karyawan)
            ->editColumn('nip', function($karyawan) {
                return $karyawan->nip;
            })
            ->editColumn('name', function($karyawan) {
                return '<span class="label label-primary">' . $karyawan->name . '</span>';
            })
            ->editColumn('action', function($karyawan) {
                return '<a href="karyawan/'.$karyawan->id.'/edit" class="btn btn-primary btn-xs"><span class="fa fa-edit"></span></a> <a href="karyawan/'.$karyawan->id.'" class="btn btn-success btn-xs"><span class="fa fa-eye"></span></a> <button type="button" onclick="deleteConfirmation('.$karyawan->id.')" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></button>';
            })
            ->escapeColumns([])
            ->make(true);
        }
        return view('admin.karyawan.index');
    }

    public function delete(Request $request)
    {
        $this->authorize('master');

        if(request()->ajax()){
            $user = User::findOrFail($request->id);
            $user->delete();
            return response()->json(['success'=>"Data berhasil dihapus"], 200);
            // DB::beginTransaction();
            // try {
            //     $user = User::findOrFail($request->id);
            //     $user->delete();
            //     return response()->json(['success'=>"Data berhasil dihapus"], 200);

            //     DB::commit();
            // } catch (Exception $e) {
            //     DB::rollback();
            //     return response()->json(['error'=>"error"], 502);
            // }
        }
    }
}
