@include('_partials.header_content',['breadcrumb'=>[str_replace('-',' ',$menu),'detail']])

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <input type="hidden" id="refNo" value=""/>
            <input type="hidden" id="idTrx" value=""/>
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
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Processing Branch</label>
									<div class="col-md-5">
										<label id="processBranch">-</label>
									</div>
								</div>
							</div>
							
						</div>
					</div>                
					<div class="box-header">
						<h3 class="box-title">Transaction Detail</h3><br>
					</div>
					<div class="box-body">
						<div class="container-fluid">
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Amount</label>
									<div class="col-md-5">
										<label id="amount">-</label>
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
								
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Total Debit Amount</label>
									<div class="col-md-5">
										<label id="totalDebitAmount">-</label>
									</div>
								</div>
							</div>
								
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Description</label>
									<div class="col-md-5">
										<label id="dscp">-</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Extended Payment Detail</label>
									<div class="col-md-5">
										<label id="extPaymentDetail">-</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Transaction Purpose</label>
									<div class="col-md-5">
										<label id="trxPurpose">-</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Transaction Description</label>
									<div class="col-md-5">
										<label id="trxDscp">-</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Payment Schedule</label>
									<div class="col-md-5">
										<label id="paymentSchedule">-</label>
									</div>
								</div>
							</div>

							<div class="row instructionModeClass"></div>

							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Destination Country</label>
									<div class="col-md-5">
										<label id="destCountry">-</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Destination Bank</label>
									<div class="col-md-5">
										<label id="destBank">-</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">SWIFT Code</label>
									<div class="col-md-5">
										<label id="swiftCode">-</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Branch</label>
									<div class="col-md-5">
										<label id="destBankbranch">-</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Address</label>
									<div class="col-md-5">
										<label id="bankAddress">-</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Destination Account Number</label>
									<div class="col-md-5">
										<label id="destAccount">-</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Address</label>
									<div class="col-md-5">
										<label id="accountAddress">-</label>
									</div>
								</div>
							</div>	
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Status</label>
									<div class="col-md-5">
										<label id="isResident">-</label><label id="isResidentCountry"></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Citizenship</label>
									<div class="col-md-5">
										<label id="isCitizen">-</label><label id="isCitizenCountry"></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Identity</label>
									<div class="col-md-5">
										<label id="identitiy">-</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Transactor Relationship</label>
									<div class="col-md-5">
										<label id="transactorRelation">-</label>
									</div>
								</div>
							</div>
								
						</div>
					</div>
					<div class="box-header">
						<h3 class="box-title">Underlying Document</h3><br>
					</div>
					<div class="box-body">
						<div class="container-fluid">
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Underlying Code</label>
									<div class="col-md-5">
										<label id="underlyingCode">-</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Document Type</label>
									<div class="col-md-5">
										<label id="docType">-</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Underlying Amount</label>
									<div class="col-md-5">
										<label id="uderlyingAmount">-</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Remark</label>
									<div class="col-md-5">
										<label id="remark">-</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Expiry Date</label>
									<div class="col-md-5">
										<label id="expiryDate">-</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Registering Branch</label>
									<div class="col-md-5">
										<label id="docBranch">-</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Register Date</label>
									<div class="col-md-5">
										<label id="registerDate">-</label>
									</div>
								</div>
							</div>

						</div>
					</div>
					<div class="box-header processTrx">
						<h3 class="box-title">Transaction Number</h3><br>
					</div>
					<div class="box-body processTrx">
						<div class="container-fluid">
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label"><strong>Transaction ID&ast;</strong></label>
									<div class="col-md-5">
										<input type="text" id="trxId" name="trxId" class="form-control state_add" autocomplete="off" value="" maxlength="40" data-error="This field is required." required>
	                                    <div class="help-block with-errors"></div>
	                                    <label id="trxId_view" class="state_view"></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label">Remark</label>
									<div class="col-md-5">
										<input type="text" id="processRemark" name="processRemark" class="form-control state_add" autocomplete="off" value="" maxlength="100">
	                                    <div class="help-block with-errors"></div>
	                                    <label id="processRemark_view" class="state_view"></label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="box-header declineTrx">
						<h3 class="box-title">Decline</h3><br>
					</div>
					<div class="box-body declineTrx">
						<div class="container-fluid">
							<div class="row">
								<div class="form-group">
									<label class="col-md-3 control-label"><strong>Rejection Reason&ast;</strong></label>
									<div class="col-md-5">
										<input type="text" id="declineRemark" name="declineRemark" class="form-control state_add" autocomplete="off" value="" maxlength="100" data-error="This field is required." required>
	                                    <div class="help-block with-errors"></div>
	                                    <label id="declineRemark_view" class="state_view"></label>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="box-footer">					
						<div class="state_detail">
							<div class="float-left">
								<button type="button" id="back" name="back" class="btn btn-default back">@lang('form.back')</button>
								<button type="button" id="print" name="print" onclick="save_pdf();" class="btn btn-default back">@lang('form.print')</button>
							</div>
						   
							<div class="float-right state_detail_r">
								<button type="button" id="decline" name="decline" class="btn btn-danger">@lang('form.decline')</button>
								<button type="button" id="process" name="process" class="btn btn-primary">@lang('form.process')</button>
							</div>
						</div>
						<div class="col-md-12 state_add text-center">
							<button type="button" id="back_add" name="back_add" class="btn btn-default back float-left">@lang('form.back')</button>
							<button type="button" id="confirm" name="confirm" class="btn btn-primary float-right ">@lang('form.confirm')</button>
						</div>
						<div class="col-md-12 state_view text-center btn1" data-html2canvas-ignore="true">
							<div class="float-left">
								<button type="button" id="back_view" name="back_view" class="btn btn-default">@lang('form.back')</button>
								<button type="button" id="save_screen" name="save_screen" class="btn btn-default" style="display:none" onclick="save_pdf();">@lang('form.save_pdf')</button>
							</div>
							<div class="float-right" style="display:inline;">
								<button type="button" id="done" name="done" class="btn btn-primary" style="display:none">@lang('form.done')</button>
								<button type="button" id="submit_view" name="submit_view" class="btn btn-primary">@lang('form.submit')</button>
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
    var id = '{{ $service }}';
	
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

        $('.processTrx').hide();
        $('.declineTrx').hide();

    
		$('#process').on('click', function () {
			$('.processTrx').show();
			$('#state').val("processNew");
			stateAdd();
        });

		$('#decline').on('click', function () {
			$('.declineTrx').show();
			$('#state').val("declineNew");
			stateAdd();
        });
		
		$('#confirm').on('click', function () {
            
            setTimeout(function(){

                stateView();
            });

        });
		
		$('#submit_view').on('click', function () {
            $(this).prop('disabled',true);
			var content='';
			var state = $('#state').val();
			if(state == 'processNew'){
				content = '{{trans('form.confirm_process')}}';
			}else if (state == 'declineNew'){
				content = '{{trans('form.confirm_decline')}}';
			}
            $.confirm({
                title: '{{trans('form.submit')}}',
                content: content,
                buttons: {                    
                    cancel: {
                        text: '{{trans('form.cancel')}}',
                        btnClass: 'btn-default',
                        action: function(){
                            $('#submit_view').prop('disabled',false);
                        }
                    },
                    confirm: {
                        text: '{{trans('form.confirm')}}',
                        btnClass: 'btn-primary',
                        action: function(){
                            var state = $('#state').val();
							if(state == 'processNew'){
								submitProcess();
							} else if (state == 'declineNew'){
								submitDecline();
							}
                        }
                    }
                }
            });
        });
		
        $('#back').on('click', function () {

        	$('.processTrx').validator('reset');
        	$('.declineTrx').validator('reset');

            var res = app.setView(id,'landing');
        });
		
		$('#done').on('click', function () {
            $(this).prop('disabled',true);
            app.setView(id,'landing');
        });

		$('#back_add').on('click', function () {
			$('.processTrx').validator('reset');
			$('.declineTrx').validator('reset');
			$('.state_detail').show();
			$('.state_detail_r').show();
			$('.processTrx').hide();
			$('.declineTrx').hide();
			$('.state_add').hide();
        });
		
		$('#back_view').on('click', function () {
			$('.processTrx').validator('reset');
			$('.declineTrx').validator('reset');
			
			stateAdd();
        });
		
    });

    function getDetail(){
        var refNo= $('#refNo').val();
        var url_action= 'search';
        var value ={
            referenceNo: refNo,      
            currentPage: "1",
            pageSize: "20",
            orderBy: {"referenceNo": "ASC"}
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
					
					var index = result.result.map(function(o) { return o.refNo; }).indexOf(refNo.toString());
                    var detail = result.result[index];
					
					//new
					
                    $('#referenceNo').text(detail.refNo);
					$('#statusName').text(detail.statusName);
					$('#requestBy').text(detail.corpId + ' - ' + detail.corpName);
					$('#sourceAccount').text(detail.sourceAccountNo + ' / ' + detail.sourceAccountName + ' ('+detail.sourceAccountCurrency+')');
					$('#processBranch').text(detail.branchCode + ' - '+ detail.branchName);
					
					$('#amount').text(detail.trxCurrency + ' ' + detail.trxAmount);
					setChargeList(detail.chargeList);
					
					if(detail.totalChargeAmount != 0){
						$('#totalFee').text(detail.trxCurrency +' '+ detail.totalChargeAmount);
						$('.stateTotalFee').show();
					}else{
						$('.stateTotalFee').hide();
					}
					$('#totalDebitAmount').text(detail.trxCurrency +' '+ detail.totalDebitAmount);
					$('#dscp').text(detail.remark1);
					$('#extPaymentDetail').text(detail.remark2);
					$('#trxPurpose').text(detail.trxPurposeCode + ' - ' + detail.trxPurposeName);
					$('#trxDscp').text(detail.trxDescription);
					
					if (detail.instructionMode == 'I') {
						$('#paymentSchedule').text('Immediate');
					} else if (detail.instructionMode == 'F'){
						$('#paymentSchedule').text('Specific Date');
					} else if (detail.instructionMode == 'R'){
						$('#paymentSchedule').text('Repeat');
					}
					setInstructionMode(detail);

					$('#destCountry').text(detail.benCountryName);
					$('#destBank').text(detail.benBankName);
					$('#swiftCode').text(detail.benBankCode);
					$('#destBankbranch').text(detail.benBankBranch);
					$('#bankAddress').text(detail.benBankAddress1 + ' ' + detail.benBankAddress2 + ' ' + detail.benBankAddress3);
					$('#destAccount').text(detail.benAccountNo + ' / ' + detail.benAccountName + ' ('+ detail.benAccountCurrency +')');
					$('#accountAddress').text(detail.benAddress1 + ' ' + detail.benAddress2 + ' ' + detail.benAddress3);

					if (detail.isResident == 'Y') {
						$('#isResident').text('Resident');
					} else if (detail.isResident == 'N') {
						$('#isResident').text('Non Resident' + '\t' + detail.residentCountryName);
					}

					if (detail.isCitizen == 'Y') {
						$('#isCitizen').text('Citizen');
					} else if (detail.isCitizen == 'N') {
						$('#isCitizen').text('Non Citizen');
						$('#isCitizenCountry').text(detail.citizenCountryName);
					}

					if (detail.isIdentical == 'Y') {
						$('#identitiy').text('Remitter is identical with Beneficiary');
					} else if (detail.isIdentical == 'N') {
						$('#identitiy').text('Remitter is not identical with Beneficiary');
					}

					if (detail.isAffiliated == 'Y') {
						$('#transactorRelation').text('Affiliated');
					} else if (detail.isAffiliated == 'N') {
						$('#transactorRelation').text('Non Affiliated');
					}
					

					if(detail.statusCode == 'NEW REQUEST'){

					} else if (detail.statusCode == 'PROCESSED'){
						$('.state_detail_r').hide();
						$('.processTrx').show();
						$('.state_add').hide();
						$('.state_view').show();
						$('.help-block').hide();
						$('.btn1').hide();

						$('#trxId_view').text(detail.hostTransactionId);
            			$('#processRemark_view').text(detail.processRemark);


					} else if (detail.statusCode == 'DECLINED'){
						$('.state_detail_r').hide();
						$('.declineTrx').show();
						$('.state_add').hide();
						$('.state_view').show();
						$('.help-block').hide();
						$('.btn1').hide();

						$('#declineRemark_view').text(detail.declineRemark);
					}

					/*$('#').text();
					$('#').text();
					$('#').text();
					$('#').text();
					$('#').text();
					$('#').text();
					$('#').text();
					$('#').text();
					$('#').text();
					$('#').text();
					$('#').text();
					$('#').text();
					$('#').text();
					$('#').text();
					$('#').text();
					$('#').text();
					$('#').text();
					$('#').text();
					$('#').text();
					$('#').text();
					$('#').text();
					$('#').text();*/
					
                } else {
                    flash('warning', result.message);
                }


            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '{{trans('form.conn_error')}}';
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
				html += '<label class="col-md-3 control-label">' + chg.chargeType + '</label>';
				html += '<div class="col-md-5"><label>' + chg.chargeCurrency +' '+ chg.chargeEquivalentAmount+'</label></div>';	
				html += '</div></div>'
			});			
			$('#chargeList').html(html);
		}
	}

	function setInstructionMode(detail){

        var instructionMode = detail.instructionMode;

        tags = '<div class="form-group">'
        if (instructionMode !=null && instructionMode == 'I') {
            tags += '<label class="col-md-3 control-label">Payment Date</label>';
            tags += '<div class="col-md-5">';
            tags += '<label>'+detail.instructionDate+'</label>';
            tags += '</div>';
        } else if (instructionMode !=null && instructionMode == 'F') {
            tags += '<label class="col-md-3 control-label">Payment Date</label>';
            tags += '<div class="col-md-5">';
            tags += '<label>'+detail.instructionDate+'</label>';
            tags += '</div>';
            tags += '<label class="col-md-3 control-label">at</label>';
            tags += '<div class="col-md-5">';
            tags += '<label>'+detail.sessionTime+'</label>';
            tags += '</div>';
        } else if (instructionMode !=null && instructionMode == 'R') {
            /*tags += '<label class="col-md-3 control-label">For</label>';
            tags += '<div class="col-md-5">';
            tags += '<label>'+confirm_data.payment_for+'</label>';
            tags += '</div>';
            tags += '<label class="col-md-3 control-label">Every</label>';
            tags += '<div class="col-md-5">';
            tags += '<label>'+confirm_data.payment_every+'</label>';
            tags += '</div>';
            tags += '<label class="col-md-3 control-label">At</label>';
            tags += '<div class="col-md-5">';
            tags += '<label>'+detail.sessionTime+'</label>';
            tags += '</div>';
            tags += '<label class="col-md-3 control-label">End Date</label>';
            tags += '<div class="col-md-5">';
            tags += '<label>'+confirm_data.payment_date_end+'</label>';
            tags += '</div>';*/
        }
        tags += '</div>';

        $('.instructionModeClass').html(tags);

    }
	
	function submitDecline(){

		var value = {
			internationalTransferId: $('#idTrx').val(),
			declineRemark:$('#declineRemark').val()	
		};
    
		$.ajax({
			url: 'getAPIData',
            method: 'post',
            data: {
                value : value,
                menu : id,
                url_action : 'decline',
                action : 'DECLINE',
                _token : '{{ csrf_token() }}'
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

		var value = {
			internationalTransferId: $('#idTrx').val(),
			transactionId: $('#trxId').val(),
			processRemark:$('#processRemark').val()
		};
    
		$.ajax({
			url: 'getAPIData',
            method: 'post',
            data: {
                value : value,
                menu : id,
                url_action : 'process',
                action : 'PROCESS',
                _token : '{{ csrf_token() }}'
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
		// console.log("state", state);		
		if(state == 'processNew'){
			
			$('.processTrx').validator('validate');
			console.log("======1=======");

			if($('.processTrx').validator('validate').has('.has-error').length!=0){

            	$('.state_add').show();
				$('.state_view').hide();
				$('.help-block').show();

				console.log("======1-error validate mandatory=======");

                return;
            }

            $('#trxId_view').text($('#trxId').val());
            $('#processRemark_view').text($('#processRemark').val() == '' ? '-' : $('#processRemark').val());

		} else if (state == 'declineNew'){

			$('.declineTrx').validator('validate');
            if($('.declineTrx').validator('validate').has('.has-error').length!=0){

            	$('.state_add').show();
				$('.state_view').hide();
				$('.help-block').show();

                return;
            }
			
			$('#declineRemark_view').text($('#declineRemark').val() == '' ? '-' : $('#declineRemark').val());

		}

		console.log("======2-Done=======");
		
	}	
	
	
</script>