<?php $__env->startSection('content'); ?>
      
       

    <div class="col-md-10 col-lg-10 col-sm-10 col-md-offset-1 col-lg-offset-1col-sm-offset-1">
        <div class="panel panel-primary">
            <div class="panel-heading"><strong> Project Name : <?php echo e($project->project_name); ?> </strong>
            
          </div>

 
            <div class="panel-body">
               <div class="col-lg-4 col-md-4 col-sm-6 col-xs-8 pull-right">
                
            </div>

              <strong> Client      : </strong><?php echo e($project->company_name); ?> <br>   
              <strong> Estimated   : </strong><?php echo e($project->days); ?> days <br>             
              
              <strong> Description : </strong> <br><?php echo e($project->project_desc); ?>



               
              <div class="pull-right">
                <?php if($project->user_id == Auth::user()->id): ?>
                   <div class="nav nav-pills pull-right" style="margin-bottom: 0px; margin-top: 30px">
                     <li role="presentation" >
                        <a href="<?php echo e(route('tasks.create')); ?>" class="fa fa-lg fa-plus-circle" style="color: grey;">Add task</a>
                    </li>
                    <li role="presentation" >
                        <a href="/projects/<?php echo e($project->id); ?>/edit" class="fa fa-lg fa-edit" style="color: grey;">Edit</a>
                    </li>
                    <li role="presentation">
                        <form id="deletecomment-form" action="#" method="POST" style="display: none;">
                          <input type="hidden" name="_method" value="delete">
                           <?php echo e(csrf_field()); ?>

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
                      <form id="delete-form" action="<?php echo e(route('projects.destroy', [$project->id])); ?>" method="POST" style="display: none;">
                          <input type="hidden" name="_method" value="delete">
                          <?php echo e(csrf_field()); ?>

                      </form>
                    </li> 
              </div>  
                
                  
                <?php else: ?> 

                    <div class="nav nav-pills pull-right" style="margin-bottom: 0px; margin-top: 30px">
                     <li role="presentation" >
                        <a href="#" class="fa fa-lg fa-edit" style="color: grey;">Disabled</a>
                    </li>
                    <li role="presentation" >
                        <a href="#" class="fa fa-lg fa-trash" style="color: grey;">Disabled</a>
                    </li>
                    
              </div>  
                <?php endif; ?>
            </div>
             

            </div>
        </div>
          <?php echo $__env->make('partials.comments', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        
      
        <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12 pull-right">
         <form method="post" action="<?php echo e(route('comments.store')); ?>">
              <?php echo e(csrf_field()); ?>


              <input type="hidden" name="commentable_type" value="<?php echo e($project->project_name); ?>">
              <input type="hidden" name="commentable_id" value="<?php echo e($project->id); ?>">

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

               <?php if($project->user_id == Auth::user()->id): ?>
              <div class="form-group">
                <input type="submit" class="btn btn-primary pull-right" value="Submit">
              </div>
              <?php else: ?>
              <div class="form-group">
                <input type="button" class="btn btn-primary pull-right" value="Disabled">
              </div>
              <?php endif; ?>
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
                <?php $__currentLoopData = $query->sortByDesc('id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="media">
                            <div class="media-body">
                              
                                <h4>
                                    <?php echo e($q->name); ?>

                                    <br>
                                </h4>
                              <div class="well">
                                <p> <?php echo e($q->body); ?></p>  
                              </div>                             
                            </div>
                            <small>
                            <li role="presentation">
                               <a></a>
                            </li> 
                                <div class="pull-right"> Noted on :<?php echo e($q->updated_at); ?></div>
                                <div class="nav nav-pills">
                                  <li role="presentation">
                                      <a href="#" class="fa fa-edit">Edit</a>
                                  </li>
                                   <li role="presentation">
                                     <form id="deletecomment-form" action="<?php echo e(route('comments.destroy', [$q->id])); ?>" method="POST" style="display: none;">
                                         <input type="hidden" name="_method" value="delete">
                                         <?php echo e(csrf_field()); ?>

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
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
            <!-- End fluid width widget --> 
       
    </div>
   
  </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>