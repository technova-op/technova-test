@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <table class="table" id="task-table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Tugas</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
$(function() {
    var table = $('#task-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route('home')}}',
        columns: [
            { data: 'tanggal', name: 'tanggal' },
            { data: 'tugas', name: 'tugas' },
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
@endsection
