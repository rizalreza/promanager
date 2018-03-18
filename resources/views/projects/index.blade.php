@extends('layouts.app')

@section('content')


  <div class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">Projects <a href="/projects/create" class="btn btn-default btn-xs pull-right"> Add new project</a></div>
        <div class="panel-body">

          <ul class="list-group">
            @foreach($projects as $project)
            <li class="list-group-item"><a href="/projects/{{$project->id}}"> {{$project->project_name}} </a></li>
            @endforeach
          </ul>


        </div>
      </div>
    </div>


@endsection
