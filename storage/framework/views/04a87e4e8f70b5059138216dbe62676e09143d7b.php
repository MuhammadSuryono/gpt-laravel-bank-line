<?php echo $__env->make('_partials.header_content',['breadcrumb'=>[str_replace('-',' ',$menu),'Search']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
			<input type="hidden" id="index" value="1"/>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Activity Filter</h3>
                </div>
				<form id="form-area" class="form-horizontal form-area">
					<div class="box-body">
						<div class="container-fluid">							
							<div class="row">
								<div class="form-group">
									<div class="col-md-2">
										<input type="radio" id="createddt-rb" name="searchby-rb" value="0">
										<label for="createddt-rb"><strong>Creation Date</strong></label>
									</div>
									<div class="col-md-9 state_createddt">
										<div class="col-xs-5 col-md-3 no-padding">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<input type="text" id="fromDate" name="fromDate" class="form-control datepicker detail numeric" autocomplete="off" value="" >
											</div>
										</div>
										<div>
										<label class="col-md-1 text-center control-label"><strong>to</strong></label>
										</div>
										<div class="col-xs-5 col-md-3 no-padding">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<input type="text" id="toDate" name="toDate" class="form-control datepicker numeric" autocomplete="off" value="">
											</div>
										</div>
									</div>								
								</div>
							</div>           
							<div class="row state_createddt">
								<div class="form-group">
									<div class="col-md-2">
										<label style="margin-left:15Px">Activity By</label>
									</div>
									<div class="col-md-7">
										<select class="form-control" id="activityBy">
											<option>select user</option>
										</select>
									</div>
								</div>
							</div>							
							<div class="row state_createddt">
								<div class="form-group">
									<div class="col-md-2">
										<label style="margin-left:15Px">Menu</label>
									</div>
									<div class="col-md-7">
										<select class="form-control" id="menuDroplist">
											<option></option>
										</select>
									</div>
								</div>
							</div>
							<div class="row state_createddt">
								<div class="form-group">
									<div class="col-md-2">
										<label style="margin-left:15Px">Activity Type</label>
									</div>
									<div class="col-md-7">
										<select class="form-control" id="activityType">
											<option>select activity type</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row state_createddt">
								<div class="form-group">
									<div class="col-md-2">
										<label style="margin-left:15Px">Status</label>
									</div>
									<div class="col-md-7">
										<select class="form-control" id="status">
											<option>select status</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<div class="col-md-3">
										<input type="radio" id="refno-rb" name="searchby-rb" value="1" checked>
										<label for="refno-rb"><strong>Reference Number</strong></label>
									</div>
									<div class="col-md-7 state_refno">
										<input type="text" id="referenceNo" name="code" class="form-control" autocomplete="off" value="" maxlength="40" data-error="This field is required." required >
									</div>
									<div class="help-block with-errors"></div>
								</div>
							</div>
						</div>
						
					</div>
					</form>
					<div class="box-footer">
						<button type="button" id="search" name="search" class="btn  btn-primary float-left"><?php echo app('translator')->get('form.search'); ?></button>
					</div>
				
                
				<div class="box-header list-title">
					<h3 class="box-title">Activity Listing</h3>
                </div>
                
				<div class="box-body list-title">
                    <div class="container-fluid">
                        <div class="row">
                            <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                <thead>
									<tr>
										<th align="center"><strong>No</strong></th>
										<th align="center"><strong>Activity Date</strong></th>
										<th align="center"><strong>Reference No</strong></th>
										<th align="center"><strong>Menu</strong></th>
										<th align="center"><strong>ActivityType</strong></th>
										<th align="center"><strong>Description</strong></th>
										<th align="center"><strong>Activity By</strong></th>
										<th align="center"><strong>Status</strong></th>
											
									</tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td align="left"></td>
										<td align="left"></td>
                                        <td align="left"></td>
										<td align="left"></td>
                                        <td align="left"></td>
										<td align="left"></td>
                                        <td align="left"></td>		
										<td align="left"></td>											
                                    </tr>
                                 </tbody>
                            </table>
                         </div>
                    </div>
                </div>
                <div class="box-footer">
					<button type="button" id="download" name="download" class="btn  btn-primary float-right	"><?php echo app('translator')->get('Download'); ?></button>
				</div>
            </div>
        </div>
    </div>
	
</section>

<script>


    $(document).ready(function () {
        var id = '<?php echo e($service); ?>';
			
		$('.state_refno').show();
		$('.state_createddt').hide();
		
		$('.datepicker').datepicker({
            format: "dd/mm/yyyy",
            locale: 'id'
        });
		
		$('#fromDate').val(moment(new Date(),"DD/MM/YYYY hh:mm").format("DD/MM/YYYY"));
        $('#toDate').val(moment(new Date()).add(1, 'days').format("DD/MM/YYYY"));

		$('input[name="searchby-rb"]').on('change', function(e) {
            if(this.value=='1'){
                $('.state_refno').show();
				$('.state_createddt').hide();
            }else{
                $('.state_refno').hide();
				$('.state_createddt').show();
            }
        });
		
		getMenuDroplist();
		getActivityByDroplist();
		getActivityTypeDroplist();
		getStatusDroplist();
		
		
		 $(document).validator().on('#form-area','submit', function (e) {
            if (e.isDefaultPrevented()) {
                // handle the invalid form...
            } else {
                // everything looks good!

            }
        });
		
		
		
		$('#list').hide();
        $('.list-title').hide();
        $('#download').hide();
	
		var url_action = 'search';
        var action = 'SEARCH';
        var result_key = 'result';
        var custom_order = '';
		
        $('#search').on('click', function () {
			
			
			setTimeout(function(){                
                   var searchby = $('input[name="searchby-rb"]:checked').val();
					var validate = false;
			
					$(this).prop("disabled",true);

					url_action = 'search';
					var value = {
						corporateId: $('#corporate_code').val(),
						fromDateVal: $('#fromDate').val(),
						toDateVal: $('#toDate').val(),
						actionType: $('#activityType').val(),
						actionBy: $('#activityBy').val(),
						activityLogMenuCode: $('#menuDroplist').val(),
						referenceNo:$('#referenceNo').val(),
						status:$('#status').val(),
						currentPage: "1",
						pageSize: "20"
					};

					if(searchby == '1'){	
						
						$('#form-area').validator('validate');						
						if($('#form-area').validator('validate').has('.has-error').length==0){
							validate = true;
						}
						url_action = 'searchByReferenceNo';
						value = {
							referenceNo:$('#referenceNo').val(),
							orderBy: {"referenceNo": "ASC"},
							currentPage: "1",
							pageSize: "20"
						};
					
					}else{
						validate = true;
					}
				if(validate){
					$('#list').show();
					$('.list-title').show();
					var index = 1;
					$('#list').DataTable({
						"destroy": true,
						"initComplete": function(settings, json) {
							$('#search').prop("disabled",false);
						},
						"select": false,
						"searching": false,
						"lengthMenu": [[10, 25, 50], [10, 25, 50]],
						"processing": true,
						"serverSide": true,
						"autoWidth": false,
						"ScrollX": '100%',
						"columnDefs": [
							{
								targets: 0,
								data: "activityDate",
								render: function ( data, type, full, meta ) {
									return index++;
								},						
								orderable: false
							},
							{
								targets: 1,
								data: "actionDate",
								orderable: false
							},
							{
								targets: 2,
								data: {
								referenceNo:"referenceNo",
								pendingTaskId:"pendingTaskId",
								menuName:"menuName",
								menuCode:"menuCode",
								actionBy:"actionBy",
								actionByUserName:"actionByUserName",
								actionDate:"actionDate",
								actionType:"actionType",
								status:"status",
								uniqueKeyDisplay:"uniqueKeyDisplay"
								},
								render: function ( data, type, full, meta ) {
									if(data.pendingTaskId != ''){
										return '<a href="javascript:void(0)" data-code="'+data.pendingTaskId+'" data-menuCode="'+data.menuCode+'" data-menuName="'+data.menuName+'" data-activityBy ="'+data.actionBy +' - '+ data.actionByUserName +'" data-activityDate = "'+ data.actionDate +'" data-referenceNo="'+data.referenceNo+'" data-description="'+data.uniqueKeyDisplay+'" data-activityType="'+data.actionType+'" data-status = "'+data.status+'">'+data.referenceNo+'</a>';
									}else{
										return data.referenceNo;
									}
								},
								orderable: false
							},
							{
								targets: 3,
								data: "menuName",
								orderable: false
							},
							{
								targets: 4,
								data: "actionType",
								orderable: false
							},
							{
								targets: 5,
								data: "uniqueKeyDisplay",
								orderable: false
							},
							{
								targets: 6,
								data: {actionByUserName:"actionByUserName",actionBy:"actionBy"},
								render: function ( data, type, full, meta ) {
									return data.actionBy + ' - ' + data.actionByUserName
								},
								orderable: false
							},
							{
								targets: 7,
								data: "status",
								orderable: false
							}
						],
						"ajax": {
							url: "fetchDataTable",
							type:'POST',
							data: function ( d ) {
								d.value = value;
								d.menu = id;
								d.url_action = url_action;
								d.action = action;
								d.result_key = result_key;
								d.custom_order = custom_order;
								d._token = '<?php echo e(csrf_token()); ?>';
							},
							error:function (jqXHR, textStatus, errorThrown) {

								var msg = '<?php echo e(trans('form.conn_error')); ?>';
								flash('warning', msg);
								$('#list').hide();
								$('.list-title').hide();
								$('#search').prop("disabled",false);
							}
						}
					});
                }
            });
			
			$('#download').show();
        });

		$('#download').on('click', function () {

			var menu = '<?php echo e($service); ?>';
			
			var refNo = $('#referenceNo').val();
	        var value = {};
	        var fromDate = $('#fromDate').val();
	        var toDate = $('#toDate').val();

	        if (refNo !="") {
	        	value['referenceNo'] = refNo;
	        } else {
	   //      	value['fromDateVal'] = moment($('#fromDate').val()).format("DD/MM/YYYY HH:mm:ss");
				// value['toDateVal'] = moment($('#toDate').val()).format("DD/MM/YYYY HH:mm:ss");
				value['fromDateVal'] = fromDate;
				value['toDateVal'] = toDate;
				value['actionType'] = $('#activityType').val();
				value['actionBy'] = $('#activityBy').val();
				value['activityLogMenuCode'] = $('#menuDroplist').val();
				value['referenceNo'] = $('#referenceNo').val();
				value['status'] = $('#status').val();
	        }

	        var url_action = 'downloadReport';
	        var action = 'DOWNLOAD';
	        var menu = menu;
	        $.ajax({
	            url: 'getAPIData',
	            method: 'post',
	            data: {
	                value : value,
	                menu : menu,
	                url_action : url_action,
	                action : action,
	                _token : '<?php echo e(csrf_token()); ?>'
	            },
	            success: function (data) {
	                		
	                		$.ajax({
                                url: 'downloadFile',
                                method: 'POST',
                                cache: false,
                                data:{
                                    url_action : 'download',
                                    // value:'EXECUTE',
                                    service:menu,
                                },
                                xhrFields: {
                                    withCredentials: true,
                                    responseType:'arraybuffer'
                                },
                               success: function (response, status, xhr) {
                                   var filename = "";
                                   var disposition = xhr.getResponseHeader('Content-Disposition');
                                   if (disposition && disposition.indexOf('attachment') !== -1) {
                                       var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                                       var matches = filenameRegex.exec(disposition);
                                       if (matches != null && matches[1]) filename = matches[1].replace(/['"]/g, '');
                                   }

                                   var type = xhr.getResponseHeader('Content-Type');
                                   var blob = new Blob([response], { type: type });
                                   saveAs(blob, filename);


                                }

                            });


	            }, error: function (xhr, ajaxOptions, thrownError) {
	                var msg = '<?php echo e(trans('form.conn_error')); ?>';
	                flash('warning', msg);
	                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
	            }, complete: function (data) {

	            }
	        });

		});

         $('#list tbody').on('click', 'a', function (e) {
            if(e.handled !== true) // This will prevent event triggering more then once
            {
                e.handled = true;
            }
            var pendingTaskId = $(this).data('code');
			var activityBy = $(this).attr('data-activityBy');
			var activityDate = $(this).attr('data-activityDate');
			var referenceNo = $(this).attr('data-referenceNo');
			var menuCode = $(this).attr('data-menuCode');
			var menuName = $(this).attr('data-menuName');
			var activityType = $(this).attr('data-activityType');
			var status = $(this).attr('data-status');
			if (pendingTaskId !== undefined) {
                var res = app.setView(id,'detail');
                if(res=='done'){
                    $('#pendingTaskId').val(pendingTaskId);
					$('#menuCodeDetail').val(menuCode);
					$('#activityBy').text(activityBy);
					$('#activityDate').text(activityDate);
					$('#refNo').text(referenceNo);					
					$('#menuName').text(menuName);
					$('#activityType').text(activityType);
					$('#statusActivity').text(status);
					
					getMenuDetail(menuCode);
                }
            }
        });

        $('input[type="text"]').not('.numeric').alphanum({
            allowSpace: true,
            allow : ',._!@'
        });

    });



	function getMenuDroplist() {
		var menu = '<?php echo e($service); ?>';
        var value = {
            code: "",
            name: "",
        };
        var url_action = 'getMenuForActivityLog';
        var action = 'SEARCH';
        var menu = menu;
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data: {
                value : value,
                menu : menu,
                url_action : url_action,
                action : action,
                _token : '<?php echo e(csrf_token()); ?>'
            },
            success: function (data) {
                var result = JSON.parse(data);
                    unitOption = '<option value="" selected>select menu</option>';
                    $.each(result.result, function (idx, obj) {
                        unitOption += '<option value="'+ obj.menuCode +'"data-value = "'+obj.menuName+'">'+ obj.menuName + '</option>';
                    });
                    $('#menuDroplist').html(unitOption);
                    $('#menuDroplist').select2({width: '100%'});

            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '<?php echo e(trans('form.conn_error')); ?>';
                flash('warning', msg);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {

            }
        });
    }

	function getStatusDroplist() {
		var menu = '<?php echo e($service); ?>';
        var value = {
            code: "",
            name: "",
        };
        var url_action = 'getStatus';
        var action = 'SEARCH';
        var menu = menu;
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data: {
                value : value,
                menu : menu,
                url_action : url_action,
                action : action,
                _token : '<?php echo e(csrf_token()); ?>'
            },
            success: function (data) {
                var result = JSON.parse(data);
                    unitOption = '';
                    $.each(result, function (idx, obj) {
                        unitOption += '<option value="'+ obj.key +'"data-name = "'+obj.value+'">'+ obj.value + '</option>';
                    });
                    $('#status').html(unitOption);
                    $('#status').select2({width: '100%'});


            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '<?php echo e(trans('form.conn_error')); ?>';
                flash('warning', msg);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {

            }
        });
    }
	
	function getActivityTypeDroplist() {
		var menu = '<?php echo e($service); ?>';
        var value = {
            code: "",
            name: "",
        };
        var url_action = 'getActivityType';
        var action = 'SEARCH';
        var menu = menu;
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data: {
                value : value,
                menu : menu,
                url_action : url_action,
                action : action,
                _token : '<?php echo e(csrf_token()); ?>'
            },
            success: function (data) {
                var result = JSON.parse(data);
                    unitOption = '<option value="" selected>select activity type</option>';
                    $.each(result, function (idx, obj) {
                        unitOption += '<option value="'+ obj.key +'"data-name = "'+obj.value+'">'+ obj.value + '</option>';
                    });
                    $('#activityType').html(unitOption);
                    $('#activityType').select2({width: '100%'});


            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '<?php echo e(trans('form.conn_error')); ?>';
                flash('warning', msg);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {

            }
        });
    }
	
	function getActivityByDroplist(corpId) {
		var menu = '<?php echo e($service); ?>';
        var value = {
            corporateId: corpId
        };
        var url_action = 'searchUser';
        var action = 'SEARCH';
        var menu = menu;
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data: {
                value : value,
                menu : menu,
                url_action : url_action,
                action : action,
                _token : '<?php echo e(csrf_token()); ?>'
            },
            success: function (data) {
                var result = JSON.parse(data);
                if (result.status=="200") {
					unitOption = '<option value="" selected>select user</option>';
                    $.each(result.result, function (idx, obj) {
                        unitOption += '<option value="'+ obj.actionByUserId +'"data-value = "'+obj.actionByUserName+'">'+ obj.actionByUserName + '</option>';
                    });
                    $('#activityBy').html(unitOption);
                    $('#activityBy').select2({width: '100%'});
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
    }
	


</script><?php /**PATH C:\xampp8\htdocs\bank-line\resources\views/bank-line/MNU_GPCASH_LOG_ACTV/landing.blade.php ENDPATH**/ ?>