@extends('layouts.app')


@section('content')
      
       

    <div class="col-md-10 col-lg-10 col-sm-10 col-md-offset-1 col-lg-offset-1col-sm-offset-1">
        <div class="panel panel-primary">
            <div class="panel-heading"><strong> Project Name : {{$project->project_name}} </strong>
            
          </div>

 
            <div class="panel-body">
               <div class="col-lg-4 col-md-4 col-sm-6 col-xs-8 pull-right">
                {{-- <form id="add-user" action="{{ route('projects.adduser') }}" method="POST">
                   {{ csrf_field() }}
                  <div class="input-group">
                     <input class="form-control" name="project_id" value="{{$project->id}}" type="hidden">
                     <input type="text" class="form-control" name="email" placeholder="Search users">
                      <span class="input-group-btn">
                       <button class="btn btn-default" value="submit">Add</button>
                     </span> 
                  </div><!-- /input-group -->
                </form> --}}
            </div>

              <strong> Client      : </strong>{{$project->company_name}} <br>   
              <strong> Estimated   : </strong>{{$project->days}} days <br>             
              {{-- <strong> Team Members   : </strong> <br> --}}
              <strong> Description : </strong> <br>{{$project->project_desc}}


               {{-- Button --}}
              <div class="pull-right">
                @if($project->user_id == Auth::user()->id)
                   <div class="nav nav-pills pull-right" style="margin-bottom: 0px; margin-top: 30px">
                     <li role="presentation" >
                        <a href="{{ route('tasks.create') }}" class="fa fa-lg fa-plus-circle" style="color: grey;">Add task</a>
                    </li>
                    <li role="presentation" >
                        <a href="/projects/{{$project->id}}/edit" class="fa fa-lg fa-edit" style="color: grey;">Edit</a>
                    </li>
                    <li role="presentation">
                        <form id="deletecomment-form" action="#" method="POST" style="display: none;">
                          <input type="hidden" name="_method" value="delete">
                           {{csrf_field()}}
                        </form>
                          <a href="#" style="color: grey" class="fa fa-lg fa-trash" 
                             onclick="
                          var result = confirm('Are you sure want to delete this project?');
                            if (result) {
                                  event.preventDefault();
                                  document.getElementById('delete-form').submit();
                            }
                            ">
                          Delete
                      </a>
                      <form id="delete-form" action="{{ route('projects.destroy', [$project->id]) }}" method="POST" style="display: none;">
                          <input type="hidden" name="_method" value="delete">
                          {{csrf_field()}}
                      </form>
                    </li> 
              </div>  
                
                  
                @else 

                    <div class="nav nav-pills pull-right" style="margin-bottom: 0px; margin-top: 30px">
                     <li role="presentation" >
                        <a href="#" class="fa fa-lg fa-edit" style="color: grey;">Disabled</a>
                    </li>
                    <li role="presentation" >
                        <a href="#" class="fa fa-lg fa-trash" style="color: grey;">Disabled</a>
                    </li>
                    
              </div>  
                @endif
            </div>
            {{-- End of Button --}} 

            </div>
        </div>
          @include('partials.comments')
        {{-- Comment --}}
      {{-- <div class="container"> --}}
        <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12 pull-right">
         <form method="post" action="{{route('comments.store')}}">
              {{csrf_field()}}

              <input type="hidden" name="commentable_type" value="{{$project->project_name}}">
              <input type="hidden" name="commentable_id" value="{{$project->id}}">

              <div class="form-group">
                <label for="comment-content">Note</label>
                <textarea placeholder="Enter comment " style="resize: vertical;" id="company-content" name="body" rows="3" spellcheck="false" class="form-control autosize-target text-left" required autofocus>
                </textarea>
              </div>

               <div class="form-group">
                <label for="comment-content">Url </label>
                <textarea placeholder="Enter url" style="resize: vertical;" id="company-content" name="url" rows="1" spellcheck="false" class="form-control autosize-target text-left" required autofocus>
                </textarea>
              </div>

               @if($project->user_id == Auth::user()->id)
              <div class="form-group">
                <input type="submit" class="btn btn-primary pull-right" value="Submit">
              </div>
              @else
              <div class="form-group">
                <input type="button" class="btn btn-primary pull-right" value="Disabled">
              </div>
              @endif
         </form> 


            
    </div> 

    <div class="col-md-6 col-sm-6 col-xs-12 pull-left ">
        <br>
            <!-- Fluid width widget -->        
          <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"> 
                        Recent Notes
                    </h3>
                </div>
                <div class="panel-body">
                    <ul class="media-list">
                @foreach($query->sortByDesc('id') as $q)
                        <li class="media">
                            <div class="media-body">
                              
                                <h4>
                                    {{$q->name}}
                                    <br>
                                </h4>
                              <div class="well">
                                <p> {{$q->body}}</p>  
                              </div>                             
                            </div>
                            <small>
                            <li role="presentation">
                               <a></a>
                            </li> 
                                <div class="pull-right"> Noted on :{{$q->updated_at}}</div>
                                <div class="nav nav-pills">
                                  <li role="presentation">
                                      <a href="#" class="fa fa-edit">Edit</a>
                                  </li>
                                   <li role="presentation">
                                     <form id="deletecomment-form" action="{{ route('comments.destroy', [$q->id]) }}" method="POST" style="display: none;">
                                         <input type="hidden" name="_method" value="delete">
                                         {{csrf_field()}}
                                     </form>
                                     <a href="#" class="fa fa-trash" 
                                                  onclick="
                                                  var result = confirm('Are you sure want to delete this comment');
                                                    if (result) {
                                                          event.preventDefault();
                                                          document.getElementById('deletecomment-form').submit();
                                                    }
                                                    ">Delete
                                      </a>
                                  </li> 

                              </div>  
                            </small>
                        </li>
                @endforeach
                    </ul>
                </div>
            </div>
            <!-- End fluid width widget --> 
       
    </div>
   
  </div>


@endsection