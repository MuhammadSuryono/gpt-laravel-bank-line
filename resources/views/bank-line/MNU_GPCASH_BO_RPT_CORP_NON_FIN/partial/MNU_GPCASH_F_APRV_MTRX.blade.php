				<div class="box-header">
                    <h3 class="box-title">Mechanism Information</h3><br>
                </div>
				<div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Menu</label>
                                <div class="col-md-6">
                                    <label id="searchMenuName">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row stateCurrency">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Currency</label>
                                <div class="col-md-6">
                                    <label id="currencyName">-</label>
                                </div>
                            </div>
                        </div>											
                    </div>
                </div>
				<div class="box-header">
                    <h3 class="box-title">Mechanism Listing</h3><br>
                </div>
				<div class="box-body list-title">
                    <div class="container-fluid">
                        <div class="row">
                            <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                <thead>
									<tr>
										<th align="center"><strong>Approval Limit</strong></th>
										<th align="center"><strong>No. of Approval</strong></th>
										<th align="center"><strong>Sequence</strong></th>
										<th align="center"><strong>No. of User</strong></th>
										<th align="center"><strong>User Group</strong></th>
										<th align="center"><strong>User Level</strong></th>											
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
                </form>
                

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
				var detail = result.details;
				console.log(result);
                if (result.status=="200") {                    
                    $('#searchMenuName').text(detail.searchMenuName);
					
					if(detail.currencyCode != ''){
						$('.stateCurrency').show();
						$('#currencyName').text(detail.currencyName);
					}else{
						$('.stateCurrency').hide();
					}
					var approvalMatrixList = detail.approvalMatrixListing;
                    oTable.clear();
					var rangeLimitStart = 0;
                    if(approvalMatrixList){
						$.each(approvalMatrixList, function (idx, obj){
							var noOfApproval = obj.noOfApproval;
							var rangeLimitDis = rangeLimitStart + " - " + obj.rangeLimit;
							$.each(obj.approvalList, function (idx, obj2){
								var seqNo = obj2.sequenceNo;
								var noOfUser = obj2.noOfUser;
								var userGroup = "";
								if(obj2.userGroupOptionCode == "ANY"){
									userGroup = "Any User Group";
								}else if (obj2.userGroupOptionCode == "INTRA"){
									userGroup = "Same Group With Maker";
								}else if (obj2.userGroupOptionCode == "CROSS"){
									userGroup = "Cross Group With Maker";
								}else if (obj2.userGroupOptionCode == "SPECIFY"){
									userGroup = "Spesific User Group" + " - " + obj2.userGroupName;
								}
								
								var userLevel = obj2.approvalLevelNameAlias;
								
								oTable.row.add([                                   
									rangeLimitDis,
									noOfApproval,
									seqNo,
									noOfUser,
									userGroup,
									userLevel
									]).draw(false);
								
								noOfApproval = "";
								rangeLimitDis = "";
							});
							rangeLimitStart = obj.rangeLimit + 1;
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