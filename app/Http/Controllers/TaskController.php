<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\User;
use App\Task;
use DataTables;
use Alert;
use Mail;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('master');
        if(request()->ajax()){
            $data = Task::orderby('id', 'DESC')->get();
            return Datatables::of($data)
            ->editColumn('name', function($data) {
                return $data->user->name;
            })
            ->editColumn('task', function($data) {
                return '<span class="label label-primary">' . $data->tugas . '</span>';
            })
            ->editColumn('status', function($data) {
                $status = "";

                if($data->status == "not_started"){
                    $status = "<span class='badge badge-danger'>Not started</span>";
                } else if($data->status == "in_progress"){
                    $status = "<span class='badge badge-warning'>In progress</span>";
                } else if($data->status == "awaiting_feedback"){
                    $status = "<span class='badge badge-info'>Awaiting feedback</span>";
                } else {
                    $status = "<span class='badge badge-success'>Completed</span>";
                }

                return $status;
            })
            ->editColumn('action', function($data) {
                return '<a href="tasks/'.$data->id.'/edit" class="btn btn-primary btn-xs"><span class="fa fa-edit"></span></a> <a href="tasks/'.$data->id.'" class="btn btn-success btn-xs"><span class="fa fa-eye"></span></a> <button type="button" onclick="deleteConfirmation('.$data->id.')" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></button>';
            })
            ->escapeColumns([])
            ->make(true);
        }
        return view('admin.task.index');
    }

    public function create()
    {
        $this->authorize('master');

        $users = User::where('role_id', 2)->get();
        return view('admin.task.create', compact('users'));
    }

    public function addTask(Request $request)
    {
        $this->authorize('master');

        DB::beginTransaction();
        try {
            $task = new Task();
            $task->user_id = $request->user_id;
            $task->tanggal = $request->tanggal;
            $task->tugas = $request->tugas;
            $task->keterangan = $request->keterangan;
            $task->save();

            $user = User::findOrFail($request->user_id);

            $pesan = "Task anda telah ditambah dengan judul '".$request->tugas."'";

            Mail::send('email', array('pesan' => $pesan) , function($pesan) use($user){
                $pesan->to($user->email,'Verifikasi')->subject('Task Assign - TECHNOVA');
                $pesan->from(env('MAIL_FROM_ADDRESS', 'donotreply@riymuh.xyz'),'Task baru telah ditambahkan');
            });

            DB::commit();
            toastr()->success('Data berhasil ditambah', 'Input success!');

            return redirect()->route('admin.task');
        } catch (Exception $e) {
            DB::rollback();
            toastr()->error('Proses gagal!', 'Terjadi kesalahan input');
        }
    }

    public function viewTask($id)
    {
        $this->authorize('master');

        $task = Task::find($id);
        return view('admin.task.view', compact('task'));
    }

    public function editTask($id)
    {
        $this->authorize('master');

        $users = User::where('role_id', 2)->get();
        $task = Task::find($id);
        return view('admin.task.edit', compact('task', 'users'));
    }

    public function updateTask(Request $request, $id)
    {
        $this->authorize('master');
        DB::beginTransaction();
            try {
                $task = Task::find($id);
                $task->user_id = $request->user_id;
                $task->tanggal = $request->tanggal;
                $task->tugas = $request->tugas;
                $task->keterangan = $request->keterangan;

                $task->save();
                DB::commit();
                toastr()->success('Input success!', 'Data berhasil ditambah ke database');

                return redirect()->route('admin.task');
            } catch (Exception $e) {
                DB::rollback();
                toastr()->error('Proses gagal!', 'Terjadi kesalahan input');
            }

    }

    public function deleteTask(Request $request)
    {
        $this->authorize('master');
        if(request()->ajax()){
            $task= Task::findOrFail($request->id);
            $task->delete();
            return response()->json(['success'=>"Data berhasil dihapus"], 200);
        }
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = $fileName . '_' . time() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads'), $fileName);

            $ckeditor = $request->input('CKEditorFuncNum');
            $url = asset('uploads/' . $fileName);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($ckeditor, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            return $response;
        }
    }
}
