@extends('layouts.app')


@section('content')

  

    <div class="col-md-9 col-lg-9 col-sm-9 pull-left">
        <form method="post" action="{{route('companies.update',[$company->id])}}">
              {{csrf_field()}}
               <input type="hidden" name="_method" value="put">

              <div class="form-group">
                <label for="company-name">Company Name<span class="required">*</span></label>
                <input placeholder="Enter name" id="company-name" name="company_name" spellcheck="false" class="form-control" value="{{$company->company_name}}" required autofocus>
              </div>

              <div class="form-group">
                <label for="company-content">Description</label>
                <textarea placeholder="Enter description" style="resize: vertical;" id="company-content" name="company_desc" rows="5" spellcheck="false" class="form-control autosize-target text-left" required autofocus>{{$company->company_desc}}
                </textarea>
              </div>
              {{-- 
              <div class="form-group">
                <label for="">User</label>
                <select type="text" class="form-control" name="user_id" required autofocus>
                    <option value="">Select User</option>
                    @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
              </div> --}}


              <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
              </div>
        </form>    
    </div>

    <div class="col-lg-3 col-md-3 col-sm-3 ">
         <div class="sidebar-module">
            <h4>Action</h4>
            <ol class="list-unstyled">
              {{-- <li><a href="/companies/{{$company->id}}/show">View Companies</a></li> --}}
              <li><a href="/companies">All Companies</a></li>
            </ol>
          </div>        
    </div>
       


@endsection