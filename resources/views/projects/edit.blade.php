@extends('layouts.app')


@section('content')

  

    <div class="col-md-8 col-lg-8 col-sm-8 col-md-offset-2 col-lg-offset-2 col-sm-offset-2">
        <form method="post" action="{{route('projects.update',[$project->id])}}">
              {{csrf_field()}}
              <input type="hidden" name="_method" value="put">

              <div class="form-group">
                <label for="company-name">Project Name<span class="required">*</span></label>
                <input placeholder="Enter name" id="company-name" name="project_name" spellcheck="false" class="form-control" value="{{$project->project_name}}" required autofocus>
              </div>

              <div class="form-group">
                <label for="company-content">Description</label>
                <textarea placeholder="Enter description" style="resize: vertical;" id="company-content" name="project_desc" rows="5" spellcheck="false" class="form-control autosize-target text-left" required autofocus>
                {{$project->project_desc}}
                </textarea>
              </div>

               <div class="form-group">
                <label for="">Company</label>
                <select type="text" class="form-control" name="company_id" required autofocus>
                    <option value="">Select Company</option>
                    @foreach($companies as $company)
                    <option value="{{$company->id}}">{{$company->company_name}}</option>
                    @endforeach
                </select>
              </div>

               <div class="form-group">
                <label for="project-days">Days<span class="required">*</span></label>
                <input placeholder="Enter days" id="project-name" name="days" spellcheck="false" class="form-control" value="{{$project->days}}" required autofocus>
              </div>
              

              <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
              </div>
        </form>    
    </div>

   {{--  <div class="col-lg-3 col-md-3 col-sm-3 ">
         <div class="sidebar-module">
            <h4>Action</h4>
            <ol class="list-unstyled">
              <li><a href="/projects/{{$project->id}}/show">View Project</a></li>
              <li><a href="/projects">Your Project</a></li>
            </ol>
          </div>        
    </div>
        --}}


@endsection