@extends('layouts.app')


@section('content')
      
       
  {{-- Project Content --}}
    <div class="col-md-9 col-lg-9 col-sm-9 pull-left">
        <div class="panel panel-primary">
            <div class="panel-heading"><strong> Project Name : {{$project->project_name}} </strong>
          </div>
            <div class="panel-body">
              <strong> Client      : </strong>{{$project->company_name}} <br>   
              <strong> Deadline  : </strong>{{Carbon\Carbon::parse($project->project_deadline)->diffForHumans()}} <br>        
              {{-- <strong> Team Members   : </strong> <br> --}}
              <strong> Description : </strong> <br>{{$project->project_desc}}


               {{-- Button --}}
              <div class="pull-right">

                @if($project->user_id == Auth::user()->id)

                   <div class="nav nav-pills pull-right" style="margin-bottom: 0px; margin-top: 30px">
                    <li role="presentation" >
                        <a href="/projects/{{$project->id}}/edit" class="fa fa-lg fa-edit" style="color: grey;">Edit</a>
                    </li>
                    <li role="presentation">
                        <form id="deleteProject-form" action="#" method="POST" style="display: none;">
                          <input type="hidden" name="_method" value="delete">
                           {{csrf_field()}}
                        </form>
                          <a href="#" style="color: grey" class="fa fa-lg fa-trash" 
                             onclick="
                          var result = confirm('Are you sure want to delete this project?');
                            if (result) {
                                  event.preventDefault();
                                  document.getElementById('deleteProject-form').submit();
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
        {{-- Comment Input--}}
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
                <label for="comment-content">Tag </label>
                <textarea placeholder="Enter tag" style="resize: vertical;" id="company-content" name="tag" rows="1" spellcheck="false" class="form-control autosize-target text-left" required autofocus>
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
         {{-- End comment input --}}


            
    </div> 

    <div class="col-md-6 col-sm-6 col-xs-12 pull-left ">
        <br>
            <!-- Begin of comment / notes content -->        
          <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"> 
                        Recent Notes
                    </h3>
                </div>
                <div class="panel-body">
                    <ul class="media-list">
                @foreach($query->sortByDesc('id') as $comment)
                        <li class="media">
                            <div class="media-body">
                                <p class="pull-right"> Tag : {{$comment->tag}}</p>
                                <p> Name : {{$comment->name}}</p>                                
                              <div class="well" style="padding: 2px">
                                <p class="small"> {{$comment->body}}</p>  
                              </div>                             
                            </div>
                            <small>
                            <li role="presentation">
                               <a></a>
                            </li> 
                    
                                <div class="pull-right"> Noted on :{{$comment->updated_at}}</div>
                                <div class="nav nav-pills">
                                   <li role="presentation">
                                     <form id="deletecomment-form" action="{{ route('comments.destroy', [$comment->id]) }}" method="POST" style="display: none;">
                                         <input type="hidden" name="_method" value="delete">
                                         {{csrf_field()}}
                                     </form>
                        @if($comment->user_id == Auth::user()->id)
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
                        @else 
                                 <li role="presentation" >
                                    <a href="#" class="fa fa-lg fa-trash" style="color: grey;">Disabled</a>
                                 </li>
                        @endif

                              </div>  
                            </small>
                        </li>
                @endforeach
                    </ul>
                </div>
            </div>       
    </div>

    {{-- End of comment content --}}
   
  </div>

  {{-- End project content --}}


{{-- Begin task content --}}

  <div class="col-md-3 col-lg-3 col-sm-3 pull-right">
 @include('partials.tasks')
         <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"> 
                            Task List
                        </h3>
                    </div>
                      <div class="panel-body">
                          <ul class="media-list">
                      @foreach($tasks->sortByDesc('id') as $task)
                    
                                  <div class="media-body">
                                      <strong><p ><a style="text-decoration: none;" href="/tasks/{{$task->id}}"> {{$task->task_name}}</a></p></strong>
                                      <p style="text-align: justify;" class="small">{{substr($task->task_desc,0,100)}}</p>                        
                                  </div>
                                  <small>
                                
                                      <div class="pull-right"> Created on :{{$task->updated_at}}</div><br><br>
                                      
                                  </small>
                              </li>
                      @endforeach
                          </ul>
                      </div>
                </div>
                
        </div>
  </div>


@endsection