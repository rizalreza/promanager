<?php $__env->startSection('content'); ?>

  

    <div class="col-md-8 col-lg-8 col-sm-8 col-md-offset-2 col-lg-offset-2 col-sm-offset-2">
        <form method="post" action="<?php echo e(route('projects.update',[$project->id])); ?>">
              <?php echo e(csrf_field()); ?>

              <input type="hidden" name="_method" value="put">

              <div class="form-group">
                <label for="company-name">Project Name<span class="required">*</span></label>
                <input placeholder="Enter name" id="company-name" name="project_name" spellcheck="false" class="form-control" value="<?php echo e($project->project_name); ?>" required autofocus>
              </div>

              <div class="form-group">
                <label for="company-content">Description</label>
                <textarea placeholder="Enter description" style="resize: vertical;" id="company-content" name="project_desc" rows="5" spellcheck="false" class="form-control autosize-target text-left" required autofocus>
                <?php echo e($project->project_desc); ?>

                </textarea>
              </div>

               <div class="form-group">
                <label for="">Company</label>
                <select type="text" class="form-control" name="company_id" required autofocus>
                    <option value="">Select Company</option>
                    <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($company->id); ?>"><?php echo e($company->company_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>

               <div class="form-group">
                <label for="project-days">Days<span class="required">*</span></label>
                <input placeholder="Enter days" id="project-name" name="days" spellcheck="false" class="form-control" value="<?php echo e($project->days); ?>" required autofocus>
              </div>
              

              <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
              </div>
        </form>    
    </div>

   


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>