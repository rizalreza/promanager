@extends('layouts.app')


@section('content')


<center><h2>Create Task</h2></center>
  

    <div class="col-md-8 col-lg-8 col-sm-8 col-md-offset-2 col-lg-offset-2 col-sm-offset-2">
        <form method="post" action="{{route('tasks.store')}}">
              {{csrf_field()}}
              <div class="form-group">
                <label for="task-name">Task Name<span class="required">*</span></label>
                <input placeholder="Enter name" id="task-name" name="task_name" spellcheck="false" class="form-control" value="" required autofocus>
              </div>

              <div class="form-group">
                <label for="">Company</label>
                <select class="form-control company_name" name="company_id" id="company_id" required autofocus>
                    <option value="company_id" disabled="true" selected="true">Select company</option>
                    @foreach($companies as $company)
                    <option value="{{$company->id}}">{{$company->company_name}}</option>
                    @endforeach
                </select>
              </div>
            
              <div class="form-group">
                <label for="">Project</label>
                <select class="form-control project_name" name="project_id">
                    <option  value="0" disabled="true" selected="true">Select Project</option>
                </select>
              </div>

              


              <div class="form-group">
                <label for="task-days">Days<span class="required">*</span></label>
                <input placeholder="Enter name" id="task-days" name="days" spellcheck="false" class="form-control" value="" required autofocus>
              </div>

              <div class="form-group">
                <label for="task-hours">Hours<span class="required">*</span></label>
                <input placeholder="Enter days" id="task-hours" name="hours" spellcheck="false" class="form-control" value="" required autofocus>
              </div>

             

              <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
              </div>
        </form>    
    </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
       
<script type="text/javascript">
  $(document).ready(function(){

  $(document).on('change','.company_name',function(){
      // console.log('Its change dude');

          var comp_id=$(this).val();

          var div=$(this).parent().parent();

          var op=" ";


         $.ajax({
        type: 'GET',
        url:'{!!URL::to('findProject')!!}',
        data: {'id':comp_id},
        success:function(data){

          console.log('success');

          console.log(data);

          console.log(data.length);
          op+='<option value="0" selected disabled>Select Project</option>';
          for(var i=0;i<data.length;i++){
          op+='<option value="'+data[i].id+'">'+data[i].project_name+'</option>';
           }

           div.find('.project_name').html(" ");
           div.find('.project_name').append(op);
        },
        error:function(){

        }
      });
    });
});

</script>

@endsection