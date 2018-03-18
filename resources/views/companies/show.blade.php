@extends('layouts.app')


@section('content')

  

      <!-- The justified navigation menu is meant for single line per list item.
           Multiple lines will require custom code not provided by Bootstrap. -->

      <!-- Jumbotron -->
    <div class="col-md-9 col-lg-9 col-sm-9 pull-left">
        <div class="jumbotron">
          <h1>{{$company->company_name}}</h1>
          <p class="lead">{{$company->company_desc}}</p>
        </div>

        <!-- Example row of columns -->
        <div class="row">
          <a href="/projects/create" class="pull-right btn btn-success btn-md"> Add Project</a>
          @foreach($projects as $project)
            <div class="col-lg-4">
              <h2>{{ $project->project_name }}</h2>
              <p>{{substr($project->project_desc,0, 100)}}</p>
              <p><a class="btn btn-primary" href="/projects/{{$project->id}}" role="button">View project »</a></p>
            </div>
          @endforeach
        </div>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-3 ">
         <div class="sidebar-module">
            <h4>Action</h4>
            <ol class="list-unstyled">
              <li><a href="/companies/{{$company->id}}/edit">Edit</a></li>
              <li><a href="#"
                      onclick="
                      var result = confirm('Are you sure want to delete this company?\nYou will be missing project history from this company\n');
                        if (result) {
                              event.preventDefault();
                              document.getElementById('delete-form').submit();
                        }
                        ">
                      Delete
                  </a>
                  <form id="delete-form" action="{{ route('companies.destroy', [$company->id]) }}" method="POST" style="display: none;">
                      <input type="hidden" name="_method" value="delete">
                      {{csrf_field()}}
                  </form>
              </li>
            </ol>
          </div>         
    </div>

@endsection