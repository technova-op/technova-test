@extends('admin.layout_partials.master')

@section('title', 'Dashboard')

@section('content')
<style>
    #karyawan-table_paginate a{
        cursor:pointer;
    }
    #karyawan-table_paginate span{
        display:none;
    }
</style>
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
            <li class="breadcrumb-item active">View Task</li>
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
                <dl class="row">
                    <dt class="col-sm-3">Karyawan:</dt>
                    <dd class="col-sm-9">{{$task->user->name}}</dd>

                    <dt class="col-sm-3">Email:</dt>
                    <dd class="col-sm-9">{{$task->user->email}}</dd>

                    <dt class="col-sm-3">Status</dt>
                    <dd class="col-sm-9"><span class="badge badge-primary">{{$task->status}}</span></dd>

                    <dt class="col-sm-3">Tanggal</dt>
                    <dd class="col-sm-9">
                        {{$task->tanggal}}
                    </dd>

                    <dt class="col-sm-3">Tugas</dt>
                    <dd class="col-sm-9">{{$task->tugas}}</dd>

                    <dt class="col-sm-3">Keterangan</dt>
                    <dd class="col-sm-9">
                        {!! $task->keterangan !!}
                    </dd>
                </dl>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

@endsection

@section('javascript')

<script>

</script>

<script>


</script>

@endsection
