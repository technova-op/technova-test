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
        <h1 class="m-0 text-dark">Data Karyawan</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active">View Karyawan</li>
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
        <a href="{{route('admin.karyawan')}}" class="btn btn-primary pull-right"><span class="fa fa-arrow-left"></span> Back</a>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Karyawan:</dt>
                    <dd class="col-sm-9">{{$user->name}}</dd>

                    <dt class="col-sm-3">Email:</dt>
                    <dd class="col-sm-9">{{$user->email}}</dd>

                    <dt class="col-sm-3">NIP</dt>
                    <dd class="col-sm-9">{{$user->nip}}</dd>

                    <dt class="col-sm-3">Tanggal lahir</dt>
                    <dd class="col-sm-9">{{$user->tanggal_lahir}}</dd>

                    <dt class="col-sm-3">Jenis Kelamin</dt>
                    <dd class="col-sm-9">@if($user->jenis_kelamin == 'P') Laki-laki @else Perempuan @endif</dd>

                </dl>
            </div>
        </div>
        <div class="card">
            <table class="table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Tugas</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user->tasks as $task)
                    <tr>
                        <td>{{$task->tanggal}}</td>
                        <td>{{$task->tugas}}</td>
                        <td>{{$task->status}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

@endsection

@section('javascript')


@endsection
