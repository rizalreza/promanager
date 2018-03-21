@extends('layouts.app')

@section('content')

   <center><h2>Company Index</h2></center>


  <div class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">Companies <a href="/companies/create" class="btn btn-default btn-xs pull-right"> Add new company</a></div>
        <div class="panel-body">

        @foreach($companies as $company)
          <div class="panel panel-info">
            <div class="panel-heading"><strong><a style="text-decoration: none;" href="/companies/{{$company->id}}">{{$company->company_name}} </a></strong></div>
            <div class="panel-body">
           
              <?php $queryProject = DB::table('projects')->where('company_id', $company->id)->get();?>
                <strong><p>Project :</p></strong>
                @foreach($queryProject as $project)
                  <ul> 
                     <li> {{$project->project_name}} <p class="pull-right">{{Carbon\Carbon::parse($project->project_deadline)->diffForHumans()}} </p></li>
                   </ul>
                @endforeach
            </div>
          </div>
        @endforeach


        </div>
      </div>
    </div>


@endsection
