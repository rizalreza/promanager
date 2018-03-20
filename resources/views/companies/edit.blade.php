@extends('layouts.app')


@section('content')

   <center><h2>Company Edit</h2></center>

    <div class="col-md-8 col-lg-8 col-sm-8 col-md-offset-2 col-sm-offset-2 col-lg-offset-2">
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

              <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
              </div>
        </form>    
    </div>     


@endsection