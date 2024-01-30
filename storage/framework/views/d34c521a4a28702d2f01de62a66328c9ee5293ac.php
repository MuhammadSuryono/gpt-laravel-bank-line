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
										<label for="createddt-rb"><strong>Corporate</strong></label>
									</div>
									<div class="col-md-7 state_createddt">
										<select class="form-control" id="corporate_code" data-error="please select corporate" required>
											<option></option>
										</select>
										<div class="help-block with-errors"></div>
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
										<label style="margin-left:15Px">Menu Type</label>
									</div>
									<div class="col-md-7">
										<select class="form-control" id="menuType">
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
										<label style="margin-left:15Px">Activity Date</label>
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
							<div class="row">
								<div class="form-group">
									<div class="col-md-3">
										<input type="radio" id="refno-rb" name="searchby-rb" value="1" checked>
										<label for="refno-rb"><strong>Reference Number</strong></label>
									</div>
									<div class="col-md-7 state_refno">
										<input type="text" id="referenceNo" name="code" class="form-control" autocomplete="off" value="" maxlength="40" data-error="This field is required." required>
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
										<th align="center"><strong>Corporate</strong></th>
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
										<td align="left"></td>											
                                    </tr>
                                 </tbody>
                            </table>
                         </div>
                    </div>
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
			$('#form-area').validator('reset');
            if(this.value=='1'){
                $('.state_refno').show();
				$('.state_createddt').hide();
            }else{
                $('.state_refno').hide();
				$('.state_createddt').show();
            }
        });
		
		getCorporateDroplist();
		getMenuTypeDroplist();
		
		$('#activityBy').prop("disabled",true);
		$('#menuType').prop("disabled",true);
		$('#activityType').prop("disabled",true);
		$('#fromDate').prop("disabled",true);
		$('#toDate').prop("disabled",true);
		
		$('select[id="corporate_code"]').on('change', function(e) {		
			$('#activityBy').prop("disabled",false);		
            $('#menuType').prop("disabled",false);
			$('#activityType').prop("disabled",false);
			$('#fromDate').prop("disabled",false);
			$('#toDate').prop("disabled",false);
			if ($('#corporate_code').val() != "") {
    			getActivityByDroplist(this.value);			
    			getActivityTypeDroplist();
			}
			
		
        });
		
		
		
		
		$('#list').hide();
        $('.list-title').hide();
	
		var url_action = 'search';
        var action = 'SEARCH';
        var result_key = 'result';
        var custom_order = '';
		
        $('#search').on('click', function () {
			
			setTimeout(function(){
                
                   var searchby = $('input[name="searchby-rb"]:checked').val();
                   var validate = false;
			
					$(this).prop("disabled",true);
					
					var value = {};

					if(searchby == '1'){	
						$('#state_refno').validator('validate');
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
						$('.state_createddt').validator('validate');

						if ($('#corporate_code').val() != "") {
		                    validate = true;
		                }
		                
						url_action = 'search';
						var value = {
							corporateId: $('#corporate_code').val(),
							fromDateVal: $('#fromDate').val(),
							toDateVal: $('#toDate').val(),
							actionType: $('#activityType').val(),
							actionByUserId: $('#activityBy').val(),
							menuType: $('#menuType').val(),
							referenceNo:$('#referenceNo').val(),
							currentPage: "1",
							pageSize: "20"
						};
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
								data: "actionDate",
								render: function ( data, type, full, meta ) {
									return index++;
								},						
								orderable: false
							},
							{
								targets: 1,
								data: {corporateId:"corporateId", corporateName :"corporateName"},
								render: function ( data, type, full, meta ) {
									return data.corporateId + ' - ' + data.corporateName
								},
								orderable: false
							},
							{
								targets: 2,
								data: "actionDate",
								orderable: false
							},
							{
								targets: 3,
								data: {
									referenceNo:"referenceNo",
									pendingTaskId:"pendingTaskId",
									corporateId:"corporateId", 
									corporateName :"corporateName",						
									actionByUserId:"actionByUserId",
									actionByUserName:"actionByUserName",
									activityLogMenuName:"activityLogMenuName",
									actionDate:"actionDate",
									actionType:"actionType",
									status:"status"
								},
								render: function ( data, type, full, meta ) {
									if(data.pendingTaskId != ''){
										return '<a href="javascript:void(0)" data-code="'+data.pendingTaskId
										+'" data-menuCode="'+data.activityLogMenuCode
										+'" data-corporate="'+data.corporateId +' - '+ data.corporateName 
										+'" data-activityBy ="'+data.actionByUserId +' - '+ data.actionByUserName 
										+'" data-activityDate = "'+ data.actionDate 
										+'" data-referenceNo="'+data.referenceNo
										+'" data-menuName="'+data.activityLogMenuName
										+'" data-activityType="'+data.actionType
										+'" data-status = "'+data.status
										+'">'+data.referenceNo+'</a>';
									}else{
										return data.referenceNo;
									}
								},
								orderable: false
							},
							{
								targets: 4,
								data: "activityLogMenuName",
								orderable: false
							},
							{
								targets: 5,
								data: "actionType",
								orderable: false
							},
							{
								targets: 6,
								data: "uniqueKeyDisplay",
								orderable: false
							},
							{
								targets: 7,
								data: {actionByUserName:"actionByUserName",actionByUserId:"actionByUserId"},
								render: function ( data, type, full, meta ) {
									return data.actionByUserId + ' - ' + data.actionByUserName
								},
								orderable: false
							},
							{
								targets: 8,
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
			
			
        });

         $('#list tbody').on('click', 'a', function (e) {
            if(e.handled !== true) // This will prevent event triggering more then once
            {
                e.handled = true;
            }
            var pendingTaskId = $(this).data('code');
			var menuCode = $(this).attr('data-menuCode');
			var corporate = $(this).attr('data-corporate');
			var activityBy = $(this).attr('data-activityBy');
			var activityDate = $(this).attr('data-activityDate');
			var referenceNo = $(this).attr('data-referenceNo');
			var menuName = $(this).attr('data-menuName');
			var activityType = $(this).attr('data-activityType');
			var status = $(this).attr('data-status');
			if (pendingTaskId !== undefined) {
                var res = app.setView(id,'detail');
                if(res=='done'){
                    $('#pendingTaskId').val(pendingTaskId);
					$('#corporateDtl').text(corporate);
					$('#activityBy').text(activityBy);
					$('#activityDate').text(activityDate);
					$('#refNo').text(referenceNo);
					$('#menuName').text(menuName);
					$('#activityType').text(activityType);
					$('#status').text(status);
					
					getMenuDetail(menuCode);
                }
            }
        });

        $('input[type="text"]').not('.numeric').alphanum({
            allowSpace: true,
            allow : ',._!@'
        });

    });

	
	function getCorporateDroplist() {
		var menu = '<?php echo e($service); ?>';
        var value = {
        };
        var url_action = 'searchCorporate';
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
					
                    unitOption = '<option value="" selected="selected">select corporate</option>';
                    $.each(result.result, function (idx, obj) {
                        unitOption += '<option value="'+ obj.corporateId +'"data-name = "'+obj.corporateName+'">'+ obj.corporateName + '</option>';
                    });

					$('#corporate_code').html(unitOption);
                    $('#corporate_code').select2({width: '100%'});					
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
	
	function getMenuTypeDroplist() {
		var menu = '<?php echo e($service); ?>';
        var value = {
            code: "",
            name: "",
        };
        var url_action = 'getMenuType?locale=en';
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
                        unitOption += '<option value="'+ obj.key +'"data-value = "'+obj.value+'">'+ obj.value + '</option>';
                    });
                    $('#menuType').html(unitOption);
                    $('#menuType').select2({width: '100%'});

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
                    $('#activityType').select2();


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
                    $('#activityBy').select2();
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
	


</script><?php /**PATH C:\xampp8\htdocs\bank-line\resources\views/bank-line/MNU_GPCASH_BO_RPT_CORP_NON_FIN/landing.blade.php ENDPATH**/ ?>