@extends('layouts.app')


@section('content')
      
       

    <div class="col-md-8 col-lg-8 col-sm-8 col-md-offset-2 col-lg-offset-2 col-sm-offset-2">
        <div class="panel panel-primary">
            <div class="panel-heading"><strong> Task Name : {{$task->task_name}}</strong>
                <p class="pull-right"><strong> Estimate to complete : </strong> {{Carbon\Carbon::createFromFormat('Y-m-d', $task->task_deadline)->format('d-m-Y')}} </p>
            </div>
              <div class="panel-body">
                <strong>Client : </strong>{{$task->company_name}}<br>
                <strong>Project : </strong>{{$task->project_name}}<br>
                <strong>Description :<br> </strong>{{$task->task_desc}}<br>
                    {{-- Button --}}
                    <div class="pull-right">
                      @if($task->user_id == Auth::user()->id)
                         <div class="nav nav-pills pull-right" style="margin-bottom: 0px; margin-top: 30px">
                           <li role="presentation" >
                              <a href="/tasks/{{$task->id}}/edit" class="fa fa-lg fa-edit" style="color: grey;">Edit</a>
                          </li>
                          <li role="presentation">
                              <form id="deletecomment-form" action="#" method="POST" style="display: none;">
                                <input type="hidden" name="_method" value="delete">
                                 {{csrf_field()}}
                              </form>
                                <a href="#" style="color: grey" class="fa fa-lg fa-trash" 
                                   onclick="
                                var result = confirm('Are you sure want to delete this task?');
                                  if (result) {
                                        event.preventDefault();
                                        document.getElementById('delete-form').submit();
                                  }
                                  ">
                                Delete
                            </a>
                            <form id="delete-form" action="{{ route('tasks.destroy', [$task->id]) }}" method="POST" style="display: none;">
                                <input type="hidden" name="_method" value="delete">
                                {{csrf_field()}}
                            </form>
                          </li> 
                    </div>  
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
         
       
    </div>
   
  </div>


@endsection