<?php $__env->startSection('content'); ?>


      <!-- Jumbotron -->
    <div class="col-md-10 col-lg-10 col-sm-10 col-md-offset-1 col-lg-offset-1 col-sm-offset-1">
        <div class="jumbotron" style="padding-top:15px; padding-right: 5px">

           <div class="nav nav-pills pull-right">
                <li role="presentation">
                    <a href="<?php echo e(route('projects.create')); ?>" class="fa fa-lg fa-plus-circle" style="color: grey">Add Project</a>
                </li>
                 <li role="presentation">
                    <a href="/companies/<?php echo e($company->id); ?>/edit" class="fa fa-lg fa-edit" style="color: grey">Edit</a>
                </li>
                <li role="presentation">
                    <form id="deletecomment-form" action="#" method="POST" style="display: none;">
                      <input type="hidden" name="_method" value="delete">
                       <?php echo e(csrf_field()); ?>

                    </form>
                      <a href="#" style="color: grey" class="fa fa-lg fa-trash" 
                         onclick="
                      var result = confirm('Are you sure want to delete this company?\nYou will be missing project history from this company\n');
                        if (result) {
                              event.preventDefault();
                              document.getElementById('delete-form').submit();
                        }
                        ">
                      Delete
                  </a>
                  <form id="delete-form" action="<?php echo e(route('companies.destroy', [$company->id])); ?>" method="POST" style="display: none;">
                      <input type="hidden" name="_method" value="delete">
                      <?php echo e(csrf_field()); ?>

                  </form>
                </li> 
          </div>  

          <h1><?php echo e($company->company_name); ?></h1>
          <p class="lead"><?php echo e($company->company_desc); ?></p>
          
        </div>

        <!-- Example row of columns -->
        <div class="row">
          <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4">
              <h2><?php echo e($project->project_name); ?></h2>
              <p><?php echo e(substr($project->project_desc,0, 100)); ?></p>
              <p><a class="btn btn-primary" href="/projects/<?php echo e($project->id); ?>" role="button">View project »</a></p>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>