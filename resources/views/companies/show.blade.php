@extends('layouts.app')


@section('content')


      <!-- Jumbotron -->
    <div class="col-md-10 col-lg-10 col-sm-10 col-md-offset-1 col-lg-offset-1 col-sm-offset-1">
        <div class="jumbotron" style="padding-top:15px; padding-right: 5px">

           <div class="nav nav-pills pull-right">
                <li role="presentation">
                    <a href="{{ route('projects.create') }}" class="fa fa-lg fa-plus-circle" style="color: grey">Add Project</a>
                </li>
                 <li role="presentation">
                    <a href="/companies/{{$company->id}}/edit" class="fa fa-lg fa-edit" style="color: grey">Edit</a>
                </li>
                <li role="presentation">
                    <form id="deletecomment-form" action="#" method="POST" style="display: none;">
                      <input type="hidden" name="_method" value="delete">
                       {{csrf_field()}}
                    </form>
                      <a href="#" style="color: grey" class="fa fa-lg fa-trash" 
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
          </div>  

          <h1>{{$company->company_name}}</h1>
          <p class="lead">{{$company->company_desc}}</p>
          
        </div>

        <!-- Example row of columns -->
        <div class="row">
          @foreach($projects as $project)
            <div class="col-lg-4">
              <h2>{{ $project->project_name }}</h2>
              <p>{{substr($project->project_desc,0, 100)}}</p>
              <p><a class="btn btn-primary" href="/projects/{{$project->id}}" role="button">View project »</a></p>
            </div>
          @endforeach
        </div>
    </div>

    {{-- <div class="col-lg-3 col-md-3 col-sm-3 ">
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
    </div> --}}

@endsection