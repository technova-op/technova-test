@extends('admin.layout_partials.master')

@section('title', 'Dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-dark">Task Karyawan</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active">Edit Task</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <a href="{{route('admin.task')}}" class="btn btn-primary pull-right"><span class="fa fa-arrow-left"></span> Back</a>
            <div class="card-body">
            <form method="post" action="">
            @csrf
            <input name="_method" type="hidden" value="PUT">
                <div class="form-group">
                    <label for="exampleInputEmail1">Pilih karyawan</label>
                    <select name="user_id" id="" class="form-control">
                        <option value="">--pilih karyawan--</option>
                        @foreach($users as $user)
                            @if($task->user_id == $user->id)
                            <option value="{{$user->id}}" selected>{{$user->name}}</option>
                            @else
                            <option value="{{$user->id}}">{{$user->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" id="exampleInputPassword1" placeholder="Tanggal" value="{{$task->tanggal}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Tugas</label>
                    <input type="text" name="tugas" class="form-control" id="exampleInputPassword1" placeholder="Tugas" value="{{$task->tugas}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Keterangan</label>
                    <textarea name="keterangan" id="" cols="30" rows="10" class="form-control">{!! $task->keterangan !!}</textarea>
                </div>
                <button type="submit" class="btn btn-success">Update</button>
            </form>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

@endsection

@section('javascript')

<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('keterangan', {
        filebrowserUploadUrl: "{{route('admin.task-image', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
    // CKEDITOR.replace('keterangan', {
    //     filebrowserImageBrowseUrl: '/filemanager?type=Images',
    //     filebrowserImageUploadUrl: '/filemanager/upload?type=Images&_token=',
    //     filebrowserBrowseUrl: '/filemanager?type=Files',
    //     filebrowserUploadUrl: '/filemanager/upload?type=Files&_token='
    // });
</script>

@endsection
