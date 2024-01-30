<?php echo $__env->make('_partials._tag_head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<body class="login-page <?php echo e(env('APP_TYPE')); ?>">
		
			<?php if(env('APP_TYPE')!='bank'): ?>
				<?php echo $__env->make('_partials.header_login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			<?php endif; ?>


		 	<?php echo $__env->yieldContent('content'); ?>
	 	
		
		 <?php if(env('APP_TYPE')=='bank'): ?>
		    <footer class="footer">
		        <?php echo $__env->make('_partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		    </footer>
	    <?php endif; ?>
    

	<?php echo $__env->make('_partials._tag_script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>
</html><?php /**PATH C:\xampp8\htdocs\bank-line\resources\views/layouts/login.blade.php ENDPATH**/ ?>