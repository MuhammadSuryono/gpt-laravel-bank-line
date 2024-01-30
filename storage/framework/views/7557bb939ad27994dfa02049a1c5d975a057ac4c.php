<?php echo $__env->make('_partials.header_content',['breadcrumb'=>[str_replace('-',' ',$menu),'detail']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <input type="hidden" id="chqOrderId" value=""/>
			<input type="hidden" id="orderNo_id" value=""/>
            <input type="hidden" id="state" value=""/>
			<form id="form-area" class="form-horizontal form-area">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Request Detail</h3><br>
					</div>

					<div class="box-body">
						<div class="container-fluid">
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Order Number</label>
									<div class="col-md-5">
										<label id="orderNo">-</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Transaction Reference Number</label>
									<div class="col-md-5">
										<label id="referenceNo">-</label>
									</div>
								</div>
							</div>
							<div class="row row-status">
								<div class="form-group">
									<label class="col-md-3 control-label">Status</label>
									<div class="col-md-5">
										<label id="statusName">-</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Request By</label>
									<div class="col-md-5">
										<label id="requestBy">-</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Source Account</label>
									<div class="col-md-5">
										<label id="sourceAccount">-</label>
									</div>
								</div>
							</div>

						</div>
					</div>
					<div class="box-header">
						<h3 class="box-title">Cheque Detail</h3><br>
					</div>
					<div class="box-body">
						<div class="container-fluid">
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Cheque Type</label>
                                    <div class="col-md-5">
                                        <label id="chequeType">Cheque Book</label>
                                    </div>
                                </div>
                            </div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Number of Pages</label>
									<div class="col-md-5">
										<label id="noOfPages">-</label>
									</div>
								</div>
							</div>

							<div id="chargeList"></div>

							<div class="row stateTotalFee">
								<div class="form-group">
									<label class="col-md-3 control-label">Total Fee</label>
									<div class="col-md-5">
										<label id="totalFee">-</label>
									</div>
								</div>
							</div>

							<div class="row stateTotalFee">
								<div class="form-group">
									<label class="col-md-3 control-label">Total Debit Amount</label>
									<div class="col-md-5">
										<label id="totalDebitAmount">-</label>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Branch</label>
									<div class="col-md-5">
										<label id="pickupBranch">-</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label"></label>
									<div class="col-md-5">
										<label id="branchAddress">-</label>
									</div>
								</div>
							</div>

















							<div class="state_identity">
								<div class="row">
									<div class="form-group">
										<label class="col-md-3 control-label"><strong>Pickup Identitiy*</strong></label>
										<div class="col-md-5 state_detail_identity">
											<label id="pickupID">-</label>
										</div>
										<div class="col-md-5 state_view_identity">
											<label id="add_pickupID_view"></label>
										</div>
										<div class="col-md-2 state_add_identity">
											<select class="form-control" id="add_identityType">
												<option></option>
											</select>
										</div>
										<div class="col-md-3 identityValidate">
											<input type="text" id="add_identityNo" name="add_identityNo" class="form-control state_add_identity" autocomplete="off" value="" maxlength="40" data-error="This field is required." required>
											<div class="help-block with-errors"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<label class="col-md-3 control-label"><strong>Name as shown in ID card*</strong></label>
										<div class="col-md-5">
											<label id="nameID" class="state_detail_identity">-</label>
											<input type="text" id="add_nameID" name="add_nameID" class="form-control state_add_identity" autocomplete="off" value="" maxlength="100" data-error="This field is required." required>
											<div class="help-block with-errors"></div>
											<label id="add_nameID_view" class="state_view_identity"></label>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<label class="col-md-3 control-label"><strong>Mobile Phone No.*</strong></label>
										<div class="col-md-5">
											<label id="phoneNo" class="state_detail_identity">-</label>
											<input type="text" id="add_phoneNo" name="add_phoneNo" class="form-control state_add_identity numeric" autocomplete="off" value="" maxlength="40" data-error="This field is required." required>
											<div class="help-block with-errors"></div>
											<label id="add_phoneNo_view" class="state_view_identity"></label>
										</div>
									</div>
								</div>
								<div class="row state_detail_identity">
									<div class="form-group">
										<label class="col-md-3 control-label">Handover Date/Time</label>
										<div class="col-md-5">
											<label id="handoverDate">-</label>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>

					<div class="box-header state_declined">
						<h3 class="box-title">DECLINE</h3><br>
					</div>
					<div class="box-body state_declined">
						<div class="container-fluid">
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label state_detail_dcl">Rejection Reason</label>
									<label class="col-md-3 control-label state_view_dcl">Rejection Reason</label>
									<label class="col-md-3 control-label state_add_dcl"><strong>Rejection Reason&ast;</strong></label>
									<div class="col-md-5">
										<label id="rejectReason" class="state_detail_dcl">-</label>
										<input type="text" id="add_rejectReason" name="add_rejectReason" class="form-control state_add_dcl" autocomplete="off" value="" maxlength="100" data-error="This field is required." required>
										<div class="help-block with-errors"></div>
										<label id="add_rejectReason_view" class="state_view_dcl"></label>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="box-header state_chqNumber">
						<h3 class="box-title">Cheque Number</h3><br>
					</div>

					<div class="box-body state_chqNumber" >
						<div class="container-fluid">
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label"><strong>Serial*</strong></label>
									<div class="col-md-5">
										<label id="serial" class="state_detail_chq">-</label>
										<input type="text" id="add_serial" name="add_serial" class="form-control state_add_chq" autocomplete="off" value="" maxlength="3" data-error="This field is required." required>
										<div class="help-block with-errors"></div>
										<label id="add_serial_view" class="state_view_chq"></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label"><strong>From Cheque Number*</strong></label>
									<div class="col-md-5">
										<label id="chequeNoFrom" class="state_detail_chq">-</label>
										<input type="text" id="add_chequeNoFrom" name="add_chequeNoFrom" class="form-control state_add_chq numeric" autocomplete="off" value="" maxlength="8" data-error="This field is required." required>
										<div class="help-block with-errors"></div>
										<label id="add_chequeNoFrom_view" class="state_view_chq"></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label"><strong>To Cheque Number*</strong></label>
									<div class="col-md-5">
										<label id="chequeNoTo" class="state_detail_chq">-</label>
										<input type="text" id="add_chequeNoTo" name="add_chequeNoTo" class="form-control state_add_chq numeric" autocomplete="off" value="" maxlength="8" data-error="This field is required." required>
										<div class="help-block with-errors"></div>
										<label id="add_chequeNoTo_view" class="state_view_chq"></label>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="box-footer">
						<div class="state_detail">
							<div class="float-left">
								<button type="button" id="back" name="back" class="btn btn-default back"><?php echo app('translator')->get('form.back'); ?></button>
								<button type="button" id="print" name="print" onclick="save_pdf();" class="btn btn-default back"><?php echo app('translator')->get('form.print'); ?></button>
							</div>

							<div class="float-right state_detail_r">
								<button type="button" id="decline" name="decline" class="btn btn-danger"><?php echo app('translator')->get('form.decline'); ?></button>
								<button type="button" id="process" name="process" class="btn btn-primary"><?php echo app('translator')->get('form.process'); ?></button>

							</div>
						</div>
						<div class="col-md-12 state_add text-center">
							<button type="button" id="back_add" name="back_add" class="btn btn-default back float-left"><?php echo app('translator')->get('form.back'); ?></button>
							<button type="button" id="confirm" name="confirm" class="btn btn-primary float-right "><?php echo app('translator')->get('form.confirm'); ?></button>
						</div>
						<div class="col-md-12 state_view text-center" data-html2canvas-ignore="true">
							<div class="float-left">
								<button type="button" id="back_view" name="back_view" class="btn btn-default"><?php echo app('translator')->get('form.back'); ?></button>
								<button type="button" id="save_screen" name="save_screen" class="btn btn-default" style="display:none" onclick="save_pdf();"><?php echo app('translator')->get('form.save_pdf'); ?></button>
							</div>
							<div class="float-right" style="display:inline;">
								<button type="button" id="done" name="done" class="btn btn-primary" style="display:none"><?php echo app('translator')->get('form.done'); ?></button>
								<button type="button" id="submit_view" name="submit_view" class="btn btn-primary"><?php echo app('translator')->get('form.submit'); ?></button>
							</div>
						</div>
					</div>
				</div>
			</form>
        </div>
    </div>

</section>

<script>
    var oTable;
    var currencyOption;
    var id = '<?php echo e($service); ?>';

    $(document).ready(function () {

		$('#form-area').validator().on('submit', function (e) {
            if (e.isDefaultPrevented()) {
                // handle the invalid form...
            } else {
                // everything looks good!

            }
        });

        $('.numeric').numeric({allowMinus:false, allowDecSep:false, allowThouSep:false});

        $('input[type="text"]').not('.numeric').alphanum({
            allowSpace: true,
            allow : ',._!@'
        });

        $('#add_serial').keypress(function(e) {


			 if (e.which == 8) { //backspace
            	return true;
             }

             var regex = new RegExp("^[a-iA-I]+$");
			 var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);

			 if (!regex.test(key)) {
			        e.preventDefault();
			        return false;
			 }
         });


		$('#process').on('click', function () {
			processNew();
        });

		$('#decline').on('click', function () {
			declineNew();
        });

		$('#update').on('click', function () {
			updateNew();
        });

		$('#confirm').on('click', function () {

            setTimeout(function(){

            	$('.row-status').hide();

                stateView();
            });

        });

		$('#submit_view').on('click', function () {
            $(this).prop('disabled',true);
			var content='';
			var state = $('#state').val();
			if(state == 'processNew'){
				content = '<?php echo e(trans('form.confirm_process')); ?>';
			}else if (state == 'declineNew'){
				content = '<?php echo e(trans('form.confirm_decline')); ?>';
			}else if (state == 'updateNew'){
				content = '<?php echo e(trans('form.confirm_handover')); ?>';
			}
            $.confirm({
                title: '<?php echo e(trans('form.submit')); ?>',
                content: content,
                buttons: {
                    cancel: {
                        text: '<?php echo e(trans('form.cancel')); ?>',
                        btnClass: 'btn-default',
                        action: function(){
                            $('#submit_view').prop('disabled',false);
                        }
                    },
                    confirm: {
                        text: '<?php echo e(trans('form.confirm')); ?>',
                        btnClass: 'btn-primary',
                        action: function(){
                            var state = $('#state').val();
							if(state == 'processNew'){
								submitProcess();
							}else if (state == 'declineNew'){
								submitDecline();
							}else if (state == 'updateNew'){
								submitUpdate();
							}
                        }
                    }
                }
            });
        });

        $('#back').on('click', function () {

        	$('.state_identity').validator('reset');
        	$('.state_declined').validator('reset');

            var res = app.setView(id,'landing');
        });

		$('#done').on('click', function () {
            $(this).prop('disabled',true);
            app.setView(id,'landing');
        });

		$('#back_add').on('click', function () {
			$('.state_identity').validator('reset');
			$('.state_declined').validator('reset');
			getDetail()
        });

		$('#back_view').on('click', function () {
			$('.state_identity').validator('reset');
			$('.state_declined').validator('reset');

			var state = $('#state').val();
			if(state == 'processNew'){
				processNew();
			}else if (state == 'declineNew'){
				declineNew();
			}else if (state == 'updateNew'){
				updateNew();
			}
        });

    });

    function getDetail(){
        var orderNo= $('#orderNo_id').val();
        var url_action= 'search';
        var value ={
            orderNo:orderNo,
            currentPage: "1",
            pageSize: "20"
        };
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data:{value:value,menu:id,action:'DETAIL',url_action:url_action},
            success: function (data) {

                var result = JSON.parse(data);
                if (result.status=="200") {

                    $('.state_detail').show();
					$('.state_detail_r').show();
					$('.state_add').hide();
					$('.state_view').hide();

					var index = result.result.map(function(o) { return o.orderNo; }).indexOf(orderNo.toString());
                    var detail = result.result[index];

					//new
					$('#chqOrderId').val(detail.chequeOrderId);
                    $('#orderNo').text(detail.orderNo);
                    $('#referenceNo').text(detail.referenceNo);
					$('#statusName').text(detail.statusName);
					$('#requestBy').text(detail.corporateId + ' - ' + detail.corporateName);
					$('#sourceAccount').text(detail.sourceAccountNo + ' / ' + detail.sourceAccountName + ' ('+detail.sourceAccountCurrency+')');
					$('#noOfPages').text(detail.noOfPages);
					$('#pickupBranch').text(detail.branchCode + ' - '+ detail.branchName);

					if(detail.branchAddress1 != '' || detail.branchAddress2 !='' || detail.branchAddress3 !=''){
						$('#branchAddress').text(detail.branchAddress1 + ' '+ detail.branchAddress2 + ' '+ detail.branchAddress3);
					}

					$('#pickupDate').text(detail.pickupDate);
					$('#pickupTime').text(detail.pickupTime);

					setChargeList(detail.chargeList);

					if(detail.totalCharge != 0){
						$('#totalFee').text(detail.transactionCurrency +' '+ detail.totalCharge);
						$('#totalDebitAmount').text(detail.transactionCurrency +' '+ detail.totalCharge);
						$('.stateTotalFee').show();
					}else{
						$('.stateTotalFee').hide();
					}

					//declined
					$('#rejectReason').text(detail.reason);

					//ready
					$('#chequeNoFrom').text(detail.chequeNoFrom);
					$('#chequeNoTo').text(detail.chequeNoTo);
					$('#serial').text(detail.chequeSerial);

					//pickedUp
					$('#pickupID').text(detail.identityType + ' - ' + detail.identityNo);
					$('#nameID').text(detail.identityName);
					$('#handoverDate').text(detail.handoverDate);
					$('#phoneNo').text(detail.mobileNo);


					if(detail.statusCode == 'NEW REQUEST'){
						stateDetailNewRequest();
					}else if (detail.statusCode == 'DECLINED'){
						stateDetailDeclined();
					}else if (detail.statusCode == 'READY'){
						stateDetailReady();
					}else if (detail.statusCode == 'PICKED UP'){
						stateDetailPickedUp();
					}

                } else {
                    flash('warning', result.message);
                }


            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '<?php echo e(trans('form.conn_error')); ?>';
                flash('warning', msg);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            },

        });
    }

	function setChargeList(chargeList){
		var html = '';
		if(chargeList.length >0){
			$.each(chargeList, function (idx, chg) {
				html +='<div class="row"><div class="form-group">';
				html += '<label class="col-md-3 control-label">' + chg.serviceChargeName + '</label>';
				html += '<div class="col-md-5"><label>' + chg.currencyName +' '+ chg.value+'</label></div>';
				html += '</div></div>'
			});
			$('#chargeList').html(html);
		}
	}

	function processNew(){
		var chqOrderId= $('#chqOrderId').val();
		var value = {
			chequeOrderId:chqOrderId
		};

		$.ajax({
			url: 'getAPIData',
            method: 'post',
            data: {
                value : value,
                menu : id,
                url_action : 'process',
                action : 'PROCESS',
                _token : '<?php echo e(csrf_token()); ?>'
            },
            success: function (data) {
                var result = JSON.parse(data);
                if (result.status=="200" && result.message == 'success') {
					$('#state').val('processNew');
					stateDetailReady();
					stateAdd();

					$('.state_detail_chq').hide();
					$('.state_add_chq').show();
					$('.state_view_chq').hide();
				} else {
                    flash('warning', result.message);
                }

            }, error: function (xhr, ajaxOptions, thrownError) {
                $('#submit_view').prop('disabled',false);
                flash('warning', 'Form Submit Failed');
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }
        });

	}

	function declineNew(){
	    $('#state').val('declineNew');
		stateDetailDeclined();
		stateAdd();

		$('.state_detail_dcl').hide();
		$('.state_add_dcl').show();
		$('.state_view_dcl').hide();
	}

	function updateNew(){
		$('#state').val('updateNew');
        stateDetailPickedUp();
		stateAdd();
		getIdentityTypeDroplist();

		$('.state_detail_identity').hide();
		$('.state_add_identity').show();
		$('.state_view_identity').hide();
	}

	function submitDecline(){
		var chqOrderId= $('#chqOrderId').val();
		var value = {
			chequeOrderId:chqOrderId,
			reason:$('#add_rejectReason').val()
		};

		$.ajax({
			url: 'getAPIData',
            method: 'post',
            data: {
                value : value,
                menu : id,
                url_action : 'decline',
                action : 'SUBMIT_DECLINE',
                _token : '<?php echo e(csrf_token()); ?>'
            },
            success: function (data) {
                $('#submit_view').prop('disabled',false);
                var result = JSON.parse(data);
                if (result.status=="200") {
                    noRef=result.referenceNo;
                    flash('success', result.message+'<br>'+'ReferenceNo: '+ result.referenceNo+'<br>'+result.dateTimeInfo);
                    $('#submit_view').hide();
					$('#back_view').hide();
					$('#done').show();
					$('#save_screen').show();

					$('#statusName').text(result.statusName);
					$('.row-status').show();
                } else {
                    $('#submit_view').prop('disabled',false);
                    flash('warning', result.message);
                }

            }, error: function (xhr, ajaxOptions, thrownError) {
                $('#submit_view').prop('disabled',false);
                flash('warning', 'Form Submit Failed');
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }
        });
	}

	function submitUpdate(){
		var chqOrderId= $('#chqOrderId').val();
		var value = {
			chequeOrderId:chqOrderId,
			identityTypeCode:$('#add_identityType').val(),
			identityNo:$('#add_identityNo').val(),
			identityName:$('#add_nameID').val(),
			mobileNo:$('#add_phoneNo').val(),
			chequeSerial: $('#serial').text(),
		};

		$.ajax({
			url: 'getAPIData',
            method: 'post',
            data: {
                value : value,
                menu : id,
                url_action : 'handover',
                action : 'SUBMIT_HANDOVER',
                _token : '<?php echo e(csrf_token()); ?>'
            },
            success: function (data) {
                $('#submit_view').prop('disabled',false);
                var result = JSON.parse(data);
                if (result.status=="200") {
                    noRef=result.referenceNo;
                    flash('success', result.message+'<br>'+'ReferenceNo: '+ result.referenceNo+'<br>'+result.dateTimeInfo);
                    $('#submit_view').hide();
					$('#back_view').hide();
					$('#done').show();
					$('#save_screen').show();

					$('#statusName').text(result.statusName);
					$('.row-status').show();
                } else {
                    $('#submit_view').prop('disabled',false);
                    flash('warning', result.message);
                }

            }, error: function (xhr, ajaxOptions, thrownError) {
                $('#submit_view').prop('disabled',false);
                flash('warning', 'Form Submit Failed');
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }
        });
	}

	function submitProcess(){
		var chqOrderId= $('#chqOrderId').val();
		var value = {
			chequeOrderId:chqOrderId,
			chequeSerial: $('#add_serial').val(),
			chequeNoFrom:$('#add_chequeNoFrom').val(),
			chequeNoTo:$('#add_chequeNoTo').val()
		};

		$.ajax({
			url: 'getAPIData',
            method: 'post',
            data: {
                value : value,
                menu : id,
                url_action : 'submitProcess',
                action : 'SUBMIT_PROCESS',
                _token : '<?php echo e(csrf_token()); ?>'
            },
            success: function (data) {
                $('#submit_view').prop('disabled',false);
                var result = JSON.parse(data);
                if (result.status=="200") {
                    noRef=result.referenceNo;
                    flash('success', result.message+'<br>'+'ReferenceNo: '+ result.referenceNo+'<br>'+result.dateTimeInfo);
                    $('#submit_view').hide();
					$('#back_view').hide();
					$('#done').show();
					$('#save_screen').show();

					$('#statusName').text(result.statusName);
					$('.row-status').show();
                } else {
                    $('#submit_view').prop('disabled',false);
                    flash('warning', result.message);
                }

            }, error: function (xhr, ajaxOptions, thrownError) {
                $('#submit_view').prop('disabled',false);
                flash('warning', 'Form Submit Failed');
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }
        });
	}

	function confirmProcess(){
		var chqOrderId= $('#chqOrderId').val();
		var value = {
			chequeOrderId:chqOrderId,
			chequeSerial: $('#add_serial').val(),
			chequeNoFrom:$('#add_chequeNoFrom').val(),
			chequeNoTo:$('#add_chequeNoTo').val()
		};

		$.ajax({
			url: 'getAPIData',
            method: 'post',
            data: {
                value : value,
                menu : id,
                url_action : 'confirm',
                action : 'CONFIRM_PROCESS',
                _token : '<?php echo e(csrf_token()); ?>'
            },
            success: function (data) {
                var result = JSON.parse(data);
                if (result.status=="200" && result.message == 'success') {
					$('#add_serial_view').text($('#add_serial').val() == '' ? '-' : $('#add_serial').val());
					$('#add_chequeNoFrom_view').text($('#add_chequeNoFrom').val() == '' ? '-' : $('#add_chequeNoFrom').val());
					$('#add_chequeNoTo_view').text($('#add_chequeNoTo').val() == '' ? '-' : $('#add_chequeNoTo').val());

					$('.state_detail_chq').hide();
					$('.state_add_chq').hide();
					$('.state_view_chq').show();
                } else {
                    flash('warning', result.message);
                }

            }, error: function (xhr, ajaxOptions, thrownError) {
                $('#submit_view').prop('disabled',false);
                flash('warning', 'Form Submit Failed');
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }
        });
	}

	function getIdentityTypeDroplist() {
		var menu = '<?php echo e($service); ?>';
        var value = {
            code: "",
            name: "",
        };
        var url_action = 'searchIdentityTypeForDroplist';
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
                    unitOption = '';
                    $.each(result.result, function (idx, obj) {
                        unitOption += '<option value="'+ obj.code +'"data-name = "'+obj.name+'">'+ obj.name + '</option>';
                    });
                    $('#add_identityType').html(unitOption);
                    $('#add_identityType').select2();
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

	function stateDetailNewRequest() {
		$('.state_declined').hide();
		$('.state_chqNumber').hide();
		$('.state_identity').hide();
		$('#decline').prop("disabled",false);
		$('#process').prop("disabled",false);
		$('#update').prop("disabled",true);
    }

	function stateDetailReady() {
		$('.state_declined').hide();
		$('.state_chqNumber').show();
		$('.state_identity').hide();

		$('.state_detail_chq').show();
		$('.state_add_chq').hide();
		$('.state_view_chq').hide();

		$('#decline').prop("disabled",true);
		$('#process').prop("disabled",true);
		$('#update').prop("disabled",false);
    }

	function stateDetailDeclined() {
		$('.state_declined').show();
		$('.state_chqNumber').hide();
		$('.state_identity').hide();

		$('.state_detail_dcl').show();
		$('.state_add_dcl').hide();
		$('.state_view_dcl').hide();

		$('.state_detail_r').hide();
    }

	function stateDetailPickedUp() {
		$('.state_declined').hide();
		$('.state_chqNumber').show();
		$('.state_identity').show();

		$('.state_detail_identity').show();
		$('.state_add_identity').hide();
		$('.state_view_identity').hide();

		$('.state_detail_chq').show();
		$('.state_add_chq').hide();
		$('.state_view_chq').hide();

		$('.state_detail_r').hide();
    }

	function stateAdd(){
		$('.state_detail').hide();
		$('.state_add').show();
		$('.state_view').hide();
	}

	function stateView() {
		$('.state_add').hide();
		$('.state_view').show();
		$('.help-block').hide();

		$('#done').hide();
		$('#save_screen').hide();

		var state = $('#state').val();
		if(state == 'processNew'){
			confirmProcess();
		}else if (state == 'declineNew'){

			$('.state_declined').validator('validate');
            if($('.state_declined').validator('validate').has('.has-error').length!=0){

            	$('.state_add').show();
				$('.state_view').hide();
				$('.help-block').show();

                return;
            }

			$('#add_rejectReason_view').text($('#add_rejectReason').val() == '' ? '-' : $('#add_rejectReason').val());

			$('.state_detail_dcl').hide();
			$('.state_add_dcl').hide();
			$('.state_view_dcl').show();
		}else if (state == 'updateNew'){

			// setTimeout(function(){
			$('.state_identity').validator('validate');

			if($('.state_identity').validator('validate').has('.has-error').length!=0){

            	$('.state_add').show();
				$('.state_view').hide();
				$('.help-block').show();

				$('#add_identityNo').focus();
				$('#add_nameID').focus();   // <---- di akalin untuk validate identityNo

				return;

            }

        // },10);

			var pickupID = $('#add_identityType').find(':selected').attr('data-name') + ' - ' + $('#add_identityNo').val() ;
			$('#add_pickupID_view').text(pickupID);
			$('#add_nameID_view').text($('#add_nameID').val() == '' ? '-' : $('#add_nameID').val());
			$('#add_phoneNo_view').text($('#add_phoneNo').val() == '' ? '-' : $('#add_phoneNo').val());

			$('.state_detail_identity').hide();
			$('.state_add_identity').hide();
			$('.state_view_identity').show();
		}

	}


</script>
<?php /**PATH D:\Downloads\Upgrade Laravel Framework\bank-line\resources\views/bank-line/MNU_GPCASH_CHQ_STS/detail.blade.php ENDPATH**/ ?>