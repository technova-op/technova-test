@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card" style="padding:10px">
                <div id='calendar'></div>
                <form method="post">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Ubah status</label>
                        <select name="status" id="" class="form-control">
                            <option value="not_started">Not Started</option>
                            <option value="in_progress">In progress</option>
                            <option value="awaiting_feedback">Awaiting Feddback</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Tanggal</dt>
                        <dd class="col-sm-9">{{$task->tanggal}}</dd>
                        <dt class="col-sm-3">Tugas</dt>
                        <dd class="col-sm-9">{{$task->tugas}}</dd>
                        <dt class="col-sm-3">Status</dt>
                        <dd class="col-sm-9"><span class="badge badge-primary">{{$task->status}}</span></dd>
                        <dt class="col-sm-3">Keterangan</dt>
                        <dd class="col-sm-9">{!! $task->keterangan !!}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')

<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
<script>
    $(document).ready(function() {
        // page is now ready, initialize the calendar...
        $('#calendar').fullCalendar({
            // put your options and callbacks here
            events : [
                {
                    title : 'Deadline',
                    start : '{{$task->tanggal}}'
                },
            ]
        })
    });
</script>

@endsection
