
<section class="content-header top">
    <h1 class="capitalize">
        <?php echo e($breadcrumb[0]); ?>

    </h1>
    <ol class="breadcrumb">
        <li><a href="javascript:void(0)" onclick="getViewContent('dashboard')" class="capitalize">Home</a></li>
        <?php if(!isset($breadcrumb[1])): ?>
          <li class="active capitalize"><strong><?php echo e($breadcrumb[0]); ?></strong></li>
        <?php elseif(isset($breadcrumb[1])): ?>
          <li><a href="#" class="back capitalize"><?php echo e($breadcrumb[0]); ?></a></li>
          <li class="active capitalize"><strong id="breadcrumb-action"><?php echo e($breadcrumb[1]); ?></strong></li>
        <?php endif; ?>
    </ol>
</section>

<?php echo $__env->make('_partials.notifications', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Downloads\Upgrade Laravel Framework\bank-line\resources\views/_partials/header_content.blade.php ENDPATH**/ ?>