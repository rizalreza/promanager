<?php $__env->startSection('content'); ?>

  

      <!-- The justified navigation menu is meant for single line per list item.
           Multiple lines will require custom code not provided by Bootstrap. -->

      <!-- Jumbotron -->
    <div class="col-md-9 col-lg-9 col-sm-9 pull-left">
        <div class="jumbotron">
          <h1><?php echo e($company->company_name); ?></h1>
          <p class="lead"><?php echo e($company->company_desc); ?></p>
        </div>

        <!-- Example row of columns -->
        <div class="row">
          <a href="/projects/create" class="pull-right btn btn-success btn-md"> Add Project</a>
          <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4">
              <h2><?php echo e($project->project_name); ?></h2>
              <p><?php echo e(substr($project->project_desc,0, 100)); ?></p>
              <p><a class="btn btn-primary" href="/projects/<?php echo e($project->id); ?>" role="button">View project »</a></p>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-3 ">
         <div class="sidebar-module">
            <h4>Action</h4>
            <ol class="list-unstyled">
              <li><a href="/companies/<?php echo e($company->id); ?>/edit">Edit</a></li>
              <li><a href="#"
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
            </ol>
          </div>         
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>