				<div class="box-header">
                    <h3 class="box-title">User Level Information</h3><br>
                </div>
				<div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">User Level</label>
                                <div class="col-md-6">
                                    <label id="approvalLevelName">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">User Level Alias</label>
                                <div class="col-md-6">
                                    <label id="alias">-</label>
                                </div>
                            </div>
                        </div>	
						<div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Currency</label>
                                <div class="col-md-6">
                                    <label id="currencyName">-</label>
                                </div>
                            </div>
                        </div>
						<div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Maker Limit</label>
                                <div class="col-md-6">
                                    <label id="makerLimit">-</label>
                                </div>
                            </div>
                        </div>							
                    </div>
                </div>
				<div class="box-header">
                    <h3 class="box-title">Authorized Limit</h3><br>
                </div>
				<div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Single Approval Limit</label>
                                <div class="col-md-6">
                                    <label id="singleApprovalLimit">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Same Group Approval Limit</label>
                                <div class="col-md-6">
                                    <label id="intraGroupLimit">-</label>
                                </div>
                            </div>
                        </div>	
						<div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Cross Group Approval Limit</label>
                                <div class="col-md-6">
                                    <label id="crossGroupLimit">-</label>
                                </div>
                            </div>
                        </div>																		
                    </div>
                </div>

<script>
    var oTable;

	$(document).ready(function () {   
		
        $('.back').on('click', function () {
            var res = app.setView(id,'landing');
        });

		getDetail('MNU_GPCASH_BO_RPT_CORP_NON_FIN');
    });

    function getDetail(id){
        var pendingTaskId_id= $('#pendingTaskId').val();
        var url_action= 'detailPendingTask';
        var value ={
            pendingTaskId:pendingTaskId_id,
            currentPage: "1",
            pageSize: "20",
            orderBy: {"code": "ASC"}
        };
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data:{value:value,menu:id,action:'DETAIL',url_action:url_action},
            success: function (data) {

                var result = JSON.parse(data);
				var detail = result.details;
                if (result.status=="200") {                    
                    $('#approvalLevelName').text(detail.approvalLevelName);
					$('#alias').text(detail.alias);
					$('#currencyName').text(detail.currencyName);
					if(detail.makerLimit == "999999999999999"){
						$('#makerLimit').text('Unlimited');
					}else{
						$('#makerLimit').text(detail.makerLimit/1);
						$('#makerLimit').autoNumeric('init',{
							emptyInputBehavior: 'zero',
							digitGroupSeparator        : ',',
							decimalCharacter           : '.',
							decimalCharacterAlternative: '.',
							allowDecimalPadding : true,
							minimumValue:'0.00',maximumValue:'999999999999999.99'
						});
					}
					if(detail.singleApprovalLimit == "999999999999999"){
						$('#singleApprovalLimit').text('Unlimited');
					}else{
						$('#singleApprovalLimit').text(detail.singleApprovalLimit/1);	
						$('#singleApprovalLimit').autoNumeric('init',{
							emptyInputBehavior: 'zero',
							digitGroupSeparator        : ',',
							decimalCharacter           : '.',
							decimalCharacterAlternative: '.',
							allowDecimalPadding : true,
							minimumValue:'0.00',maximumValue:'999999999999999.99'
						});		
					}			
					if(detail.intraGroupLimit == "999999999999999"){
						$('#intraGroupLimit').text('Unlimited');
					}else{
						$('#intraGroupLimit').text(detail.intraGroupLimit/1);
						$('#intraGroupLimit').autoNumeric('init',{
							emptyInputBehavior: 'zero',
							digitGroupSeparator        : ',',
							decimalCharacter           : '.',
							decimalCharacterAlternative: '.',
							allowDecimalPadding : true,
							minimumValue:'0.00',maximumValue:'999999999999999.99'
						});
					}
					if(detail.crossGroupLimit == "999999999999999"){
						$('#crossGroupLimit').text('Unlimited');
					}else{
						$('#crossGroupLimit').text(detail.crossGroupLimit/1);
						$('#crossGroupLimit').autoNumeric('init',{
							emptyInputBehavior: 'zero',
							digitGroupSeparator        : ',',
							decimalCharacter           : '.',
							decimalCharacterAlternative: '.',
							allowDecimalPadding : true,
							minimumValue:'0.00',maximumValue:'999999999999999.99'
						});
					}						
							
					
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

   

</script>