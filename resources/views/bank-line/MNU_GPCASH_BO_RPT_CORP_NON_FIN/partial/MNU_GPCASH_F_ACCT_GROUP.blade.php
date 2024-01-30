				<div class="box-header">
                    <h3 class="box-title">Group Information</h3><br>
                </div>
				<div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Account Group Code</label>
                                <div class="col-md-6">
                                    <label id="accountGroupCode">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Account Group Name</label>
                                <div class="col-md-6">
                                    <label id="accountGroupName">-</label>
                                </div>
                            </div>
                        </div>											
                    </div>
                </div>
				<div class="box-header">
                    <h3 class="box-title">Account Listing</h3><br>
                </div>
				<div class="box-body list-title">
                    <div class="container-fluid">
                        <div class="row">
                            <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                <thead>
									<tr>
										<th align="center"><strong>Account Number</strong></th>
										<th align="center"><strong>Account Name</strong></th>
										<th align="center"><strong>Currency</strong></th>
										<th align="center"><strong>Allow Inquiry</strong></th>
										<th align="center"><strong>Allow Debit</strong></th>
										<th align="center"><strong>Allow Credit</strong></th>											
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
                                    </tr>
                                 </tbody>
                            </table>
                         </div>
                    </div>
                </div>

<script>
    var oTable;

	 $(document).ready(function () {   
		
		oTable = $('#list').DataTable({
            "paging" : false,
            "ordering" : false,
            "info": false,
            "destroy": true,
            "select": false,
            "searching": false,
            "autoWidth":false,
            "columnDefs": [
                {
                    targets: 0,
                    sortable: false
                },
               {
                    targets: 1,
                    sortable: false
                },
                {
                    targets: 2,
                    sortable: false
                },
                {
                    targets: 3,
                    sortable: false
                },
                {
                    targets: 4,
                    sortable: false

                },
                {
                    targets: 5,
                    sortable: false
                }

            ]
        });
 
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
				console.log(result);
                if (result.status=="200") {                    
                    $('#accountGroupCode').text(result.details.code);
					$('#accountGroupName').text(result.details.name);
					
					var accountList = result.details.accountList;
                    oTable.clear();
                    if(accountList){
                    $.each(accountList, function (idx, obj){
					
					var isAllowInquiry = 'NO';
                    var isAllowDebit = 'NO';
                    var isAllowCredit = 'NO';
                    var isAllowInquiryLabel = 'label-danger';
                    var isAllowDebitLabel = 'label-danger';
                    var isAllowCreditLabel = 'label-danger';

                    if(obj.isAllowInquiry=='Y'){
                        isAllowInquiry = 'YES';
                        isAllowInquiryLabel = 'label-success';
                    }
                    if(obj.isAllowDebit=='Y'){
                        isAllowDebit = 'YES';
                        isAllowDebitLabel = 'label-success';
                    }
                    if(obj.isAllowCredit=='Y'){
                        isAllowCredit = 'YES';
                        isAllowCreditLabel = 'label-success';
                    }
					
                        oTable.row.add([                                   
                            obj.accountNo,
                            obj.accountName,
                            obj.accountCurrencyName,
							'<input type="hidden" id="isAllowInquiry" value="'+obj.isAllowInquiry+'"><span class="label '+isAllowInquiryLabel+'">&nbsp;&nbsp;'+isAllowInquiry+'&nbsp;&nbsp;</span>',
							'<input type="hidden" id="isAllowDebit" value="'+obj.isAllowDebit+'"><span class="label '+isAllowDebitLabel+'">&nbsp;&nbsp;'+isAllowDebit+'&nbsp;&nbsp;</span>',
							'<input type="hidden" id="isAllowCredit" value="'+obj.isAllowCredit+'"><span class="label '+isAllowCreditLabel+'">&nbsp;&nbsp;'+isAllowCredit+'&nbsp;&nbsp;</span>'                           
                        ]).draw(false);

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