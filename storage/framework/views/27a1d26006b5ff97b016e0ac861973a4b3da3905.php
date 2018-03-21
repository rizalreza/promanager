<?php $__env->startSection('content'); ?>

<center><h2>Project Index</h2></center>


  <div class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">Projects <a href="/projects/create" class="btn btn-default btn-xs pull-right"> Add new project</a></div>
        <div class="panel-body">

          <ul class="list-group">
            <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="list-group-item"><a href="/projects/<?php echo e($project->id); ?>"> <?php echo e($project->project_name); ?> </a></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>


        </div>
      </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>