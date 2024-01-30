<?php echo $__env->make('_partials._tag_head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<body class="hold-transition skin-black sidebar-mini <?php echo e(env('APP_TYPE')); ?>">
	
	<div id="vm">
		<div class="wrapper">
			 
		 	<?php echo $__env->make('_partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		 	<?php echo $__env->make('_partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		 	
		 	<div class="content-wrapper">
		 		
		 		<div id="preloader-content" v-cloak v-if="submit.process"><div class="preloader"></div></div>
		 		<div id="content-ajax">
					<?php echo $__env->yieldContent('content'); ?>
				</div>
				<?php if(env('APP_TYPE')=='bank'): ?>
				    <footer class="footer relative">
				        <?php echo $__env->make('_partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				    </footer>
			    <?php endif; ?>
			</div>

	    </div>
		
		
	</div>
	

	<?php echo $__env->make('_partials._tag_script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>
</html><?php /**PATH C:\xampp8\htdocs\bank-line\resources\views/layouts/master.blade.php ENDPATH**/ ?>