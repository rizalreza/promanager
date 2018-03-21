@extends('layouts.app')


@section('content')

<center><h2>Create Project</h2></center>

    <div class="col-md-8 col-lg-8 col-sm-8 col-md-offset-2 col-lg-offset-2 col-sm-offset-2">
        <form method="post" action="{{route('projects.store')}}">
              {{csrf_field()}}
              {{-- <input type="hidden" name="_method" value="post"> --}}
             {{--  <p>Create Project for : {{$companies->company_name}} </p> --}}
              <div class="form-group">
                <label for="project-name">Project Name<span class="required">*</span></label>
                <input placeholder="Enter name" id="project-name" name="project_name" spellcheck="false" class="form-control" value="" required autofocus>
              </div>

              <div class="form-group">
                <label for="project-content">Description</label>
                <textarea placeholder="Enter description" style="resize: vertical;" id="project-content" name="project_desc" rows="5" spellcheck="false" class="form-control autosize-target text-left" required autofocus>
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
                <label for="project-days">Deadline</label>
                <input type="text" id="project_deadline" name="project_deadline" class="form-control" style="width: 200px">
              </div>


              <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
              </div>
        </form>    
    </div>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script src="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"></script>

  <script>
    $(function() {
    $( "#project_deadline" ).datepicker({ dateFormat: 'yy-mm-dd',
                                    changeMonth: true,
                                    changeYear: true});
                                    });
                                </script>

@endsection