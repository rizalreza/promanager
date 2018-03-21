@extends('layouts.app')

@section('content')

<center><h2>Task Index</h2></center>

  <div class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">Tasks <a href="/tasks/create" class="btn btn-default btn-xs pull-right"> Add new task</a></div>
        <div class="panel-body">

        {{--   <ul class="list-group">
            @foreach($tasks as $task)
            <li class="list-group-item"><a href="/tasks/{{$task->id}}"> {{$task->task_name}} </a></li>
            @endforeach
          </ul> --}}
           @foreach($tasks as $task)
          <div class="panel panel-info">
            <div class="panel-heading"><a href="/tasks/{{$task->id}}">{{$task->task_name}} </a></div>
            <div class="panel-body">
             <p>Company : {{$task->company_id}}</p>
             <p>Project : {{$task->project_id}}</p>
            </div>
          </div>
          @endforeach

        </div>
      </div>
    </div>


@endsection