<div id="nextUserModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Next User</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<table id="nextUserList" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
							   style="border-collapse:collapse;">
							<thead>
							<tr>
								<th><strong>User</strong></th>
								<th><strong>User Level</strong></th>
							</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('form.close'); ?></button>
			</div>
		</div>

	</div>
</div>
<script>
	var nextUserList;
        nextUserList = $('#nextUserList').DataTable({
            "paging": true,
            "ordering": true,
            "info": false,
            "destroy": true,
            "searching": false,
            "autoWidth": false,
            "lengthMenu": [[10, 25, 50], [10, 25, 50]],
            "columnDefs": [
                {
                    targets: 0,
                    sortable: true,
                    width: "50%"
                },
                {
                    targets: 1,
                    sortable: true,
                    width: "50%"
                }
            ]
        });

        $('#next_user').on('click', function () {
            $('#nextUserModal').modal('show');
        });

        $('#nextUserModal').on('show.bs.modal', function() {
            var value = {
                referenceNo : noRef
            };
            $.ajax({
                url: 'getAPIData',
                method: 'post',
                type: 'json',
                data: {
                    menu : 'MNU_GPCASH_PENDING_TASK',
                    url_action : 'searchPendingTaskByReferenceNo',
                    action : 'SEARCH',
                    value:value,
                    _token : '<?php echo e(csrf_token()); ?>'
                },
                success: function (data) {
                    var result = JSON.parse(data);
                    nextUserList.clear();
                    if (result.status=="200") {
                        $.each(result.tasks, function (idx, obj) {
                            nextUserList.row.add([
                                obj.userCode,
                                obj.userName
                            ]).draw(false);
                        });
                    } else {
                        flash('warning', result.message);
                    }


                }, error: function (xhr, ajaxOptions, thrownError) {
                    var msg = '<?php echo e(trans('form.conn_error')); ?>';
                    flash('warning', msg);
                    console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                }, complete: function (data) {

                }
            });
        });
</script><?php /**PATH D:\Downloads\Upgrade Laravel Framework\bank-line\resources\views/_partials/next_user.blade.php ENDPATH**/ ?>