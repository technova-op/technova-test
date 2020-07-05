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
            <li class="breadcrumb-item active">Task</li>
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
        <a href="{{route('admin.create-task')}}" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Task</a>
            <div class="card-body">
                <table class="table table-bordered" id="task-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Task</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

@endsection

@section('javascript')

<script>
$(function() {
    var table = $('#task-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route('admin.task')}}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'task', name: 'task' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action' }
        ],
        "columnDefs":[
          {
            targets:[1],
            orderable: false,
          }
        ],
    });

    $('.searchtype').on('change', function() {
        table.draw();
    });
});
</script>

<script>
    function deleteConfirmation(id) {
        swal({
                title: "Are you sure!",
                type: "error",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes!",
                showCancelButton: true,
            },
            function() {
                $.ajax({
                    type: "POST",
                    url: '{{route('admin.delete-task')}}',
                    data: {
                        '_method': 'DELETE',
                        id: id
                    },
                    success: function (data) {
                        console.log(data);
                        $('#task-table').DataTable().ajax.reload();
                    }
                });
        });
    }
</script>

@endsection
