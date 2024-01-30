<?php echo $__env->make('_partials.notifications', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<section class="content-header">
		<h1 style="margin-bottom:10px;">
			<strong>Welcome <?php if(isset($user_name)): ?> <?php echo e($user_name); ?>, <?php endif; ?></strong>
		</h1>
		<p>Last login <?php if(isset($user_last_login)): ?> <?php echo e(dateFormat($user_last_login,'d M Y H:i:s')); ?> <?php endif; ?></p>
		
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12 dataTables_wrapper"> 
				<?php if($total_activity>0): ?>
					 <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                           style="border-collapse:collapse;">
                        <thead>
                        <tr>
                            <th align="left"><strong>No</strong></th>
                            <th align="left"><strong>List of Activity</strong></th>
                            <th align="left"><strong>Date / Time</strong></th>
                            <th align="left"><strong>Status</strong></th>

                        </tr>
                        </thead>
                        <tbody>
                        	<?php $__currentLoopData = $last_activity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                        	<tr>
									<td align="center" style="width: 20px;"><?php echo e($key+1); ?></td>
		                            <td align="left"><?php echo e($item->menuName); ?></td>
		                            <td align="left"><?php echo e(dateFormat($item->actionDate,'d-m-Y H:i:s')); ?></td>
		                            <td align="left"><?php echo e($item->actionType); ?></td>
	                        	</tr>
	                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
						
					</table>
				<?php else: ?>
					<h5>No Activity available</h5>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<script>
		$(document).ready(function(){

		})
	</script><?php /**PATH C:\xampp8\htdocs\bank-line\resources\views/pages/view/dashboard.blade.php ENDPATH**/ ?>