@extends('layouts.app')


@section('content')

   <center><h2>Company Create</h2></center>

    <div class="col-md-8 col-lg-8 col-sm-8 col-md-offset-2 col-lg-offset-2 col-sm-offset-2">
        <form method="post" action="{{route('companies.store')}}">
              {{csrf_field()}}
              <div class="form-group">
                <label for="company-name">Name<span class="required">*</span></label>
                <input placeholder="Enter name" id="company-name" name="company_name" spellcheck="false" class="form-control" value="" required autofocus>
              </div>

              <div class="form-group">
                <label for="company-content">Description</label>
                <textarea placeholder="Enter description" style="resize: vertical;" id="company-content" name="company_desc" rows="5" spellcheck="false" class="form-control autosize-target text-left" required autofocus>
                </textarea>
              </div>


              <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
              </div>
        </form>    
    </div>

{{--     <div class="col-lg-3 col-md-3 col-sm-3 ">
         <div class="sidebar-module">
            <h4>Action</h4>
            <ol class="list-unstyled">
              <li><a href="/companies">All Companies</a></li>
            </ol>
          </div>        
    </div>
        --}}


@endsection