@extends('layouts.app')

@section('content')


  <div class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">Companies <a href="/companies/create" class="btn btn-default btn-xs pull-right"> Add new company</a></div>
        <div class="panel-body">

          <ul class="list-group">
            @foreach($companies as $company)
            <li class="list-group-item"><a href="/companies/{{$company->id}}"> {{$company->company_name}} </a></li>
            @endforeach
          </ul>


        </div>
      </div>
    </div>


@endsection
