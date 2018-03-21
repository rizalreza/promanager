@extends('layouts.app')

@section('content')

<center><h2>Task Index</h2></center>

  <div class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">Tasks <a href="/tasks/create" class="btn btn-default btn-xs pull-right"> Add new task</a></div>
        <div class="panel-body">
           @foreach($tasks as $task)
          <div class="panel panel-info">
            <div class="panel-heading"><strong><a style="text-decoration: none;" href="/tasks/{{$task->id}}">{{$task->task_name}} </a></strong></div>
            <div class="panel-body">
             <p>Client : {{$task->company_name}}</p>
             <p>Project : {{$task->project_name}}</p>
            </div>
          </div>
          @endforeach

        </div>
      </div>
    </div>


@endsection