@extends('admin.layout_partials.master')

@section('title', 'Dashboard')

@section('content')
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
            <li class="breadcrumb-item active">Karyawan</li>
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
        <a href="{{route('admin.create-karyawan')}}" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Karyawan</a>
            <div class="card-body">
                <table class="table table-bordered" id="karyawan-table">
                    <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Name</th>
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
    var table = $('#karyawan-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route('admin.karyawan')}}',
        columns: [
            { data: 'nip', name: 'nip' },
            { data: 'name', name: 'name' },
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
                    type: "GET",
                    url: '{{route('admin.delete-karyawan')}}',
                    data: {
                        // "_method": 'POST',
                        "_token": '{!! csrf_token() !!}',
                        id: id,
                    },
                    success: function (data) {
                        console.log(data);
                    }
                });
        });
    }

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
                    url: '{{route('admin.delete-karyawan')}}',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        console.log(data);
                        $('#karyawan-table').DataTable().ajax.reload();
                    }
                });
        });
    }

</script>

@endsection
