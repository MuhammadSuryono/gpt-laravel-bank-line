				<div class="box-header">
                    <h3 class="box-title">User Information</h3><br>
                </div>
				<div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">User ID</label>
                                <div class="col-md-6">
                                    <label id="userId">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">User Name</label>
                                <div class="col-md-6">
                                    <label id="userName">-</label>
                                </div>
                            </div>
                        </div>	
						<div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Email Address</label>
                                <div class="col-md-6">
                                    <label id="email">-</label>
                                </div>
                            </div>
                        </div>
						<div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Phone Number</label>
                                <div class="col-md-6">
                                    <label id="mobileNo">-</label>
                                </div>
                            </div>
                        </div>							
                    </div>
                </div>
				<div class="box-header">
                    <h3 class="box-title">User Detail</h3><br>
                </div>
				<div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">User Role</label>
                                <div class="col-md-6">
                                    <label id="wfRoleName">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">User Level</label>
                                <div class="col-md-6">
                                    <label id="userLevel">-</label>
                                </div>
                            </div>
                        </div>	
						<div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">User Group</label>
                                <div class="col-md-6">
                                    <label id="userGroup">-</label>
                                </div>
                            </div>
                        </div>
						<div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Account Group</label>
                                <div class="col-md-6">
                                    <label id="accountGroup">-</label>
                                </div>
                            </div>
                        </div>
						<div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">View Payroll Transaction Detail</label>
                                <div class="col-md-6">
                                    <label id="isGrantViewDetail">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">New Ongoing Task</label>
                                <div class="col-md-6">
                                    <label id="isNotifyMyTask">-</label>
                                </div>
                            </div>
                        </div>	
						<div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">My Transaction Is Processed</label>
                                <div class="col-md-6">
                                    <label id="isNotifyMyTrx">-</label>
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
                if (result.status=="200") {                    
                    $('#userId').text(result.details.userId);
					$('#userName').text(result.details.userName);
					$('#email').text(result.details.email);
					$('#mobileNo').text(result.details.mobileNo);
					
					$('#wfRoleName').text(result.details.wfRoleName);
					$('#userLevel').text(result.details.approvalLevelName + ' - ' + result.details.authorizedLimitAlias);
					$('#userGroup').text(result.details.userGroupCode + ' - ' + result.details.userGroupName);
					$('#accountGroup').text(result.details.accountGroupCode + ' - ' + result.details.accountGroupName);
					$('#isGrantViewDetail').text(result.details.isGrantViewDetail);
					$('#isNotifyMyTask').text(result.details.isNotifyMyTask);
					$('#isNotifyMyTrx').text(result.details.isNotifyMyTrx);
					
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