				<div class="box-header">
                    <h3 class="box-title">User Identification Detail</h3><br>
                </div>

                    <div class="box-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">User Id</label>
                                    <div class="col-md-6">
                                        <label id="code_1"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">User Name</label>
                                    <div class="col-md-6">
                                        <label id="name"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Unit</label>
                                    <div class="col-md-6">
                                        <label id="unit"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Email Address</label>
                                    <div class="col-md-6">
                                        <label id="email"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Active From</label>
                                    <div class="col-md-4">
                                        <label id="activeFrom"></label>
                                    </div>
                                    <label class="col-md-2 control-label">Active To</label>
                                    <div class="col-md-4">
                                        <label id="activeTo"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Password Never Expired</label>
                                    <div class="col-md-6">
                                        <label id="isPwdNeverExpired"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Status</label>
                                    <div class="col-md-6">
                                        <label id="status"></label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                <div class="box-header">
                    <h3 class="box-title table-hidden">User Role</h3>
                </div>

                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row table-hidden">
                            <div class="form-group">
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th align="center"><strong>Role</strong></th>
                                        <th align="center"><strong>Description</strong></th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td align="left"></td>
                                        <td align="left"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

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
            "lengthMenu": [[10, 25, 50], [10, 25, 50]],
            "columnDefs": [
                {
                    targets: 0,
                    sortable: false,
                    width: "50%"
                },
                {
                    targets: 1,
                    sortable: false,
                    width: "50%"
                }

            ]
        });
		
		getDetail('MNU_GPCASH_LOG_ACTV');
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
        var action = 'DETAIL';
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data: {
                value : value,
                menu : id,
                url_action : url_action,
                action : action,
                _token : '{{ csrf_token() }}'
            },
            success: function (data) {

                var result = JSON.parse(data);
                 if (result.status=="200") {
                    var detail = result.details.roleCodeList;
                    $('#code_1').text(result.details.code);
                    $('#name').text(result.details.name);
                    $('#unit').text(result.details.branchCode + ' - ' + result.details.branchName);
                    $('#email').text(result.details.email);
                    $('#activeFrom').text(moment(result.details.activeFrom,"DD/MM/YYYY hh:mm").format("DD/MM/YYYY"));
                    if(result.details.activeTo) {
                        $('#activeTo').text(moment(result.details.activeTo, "DD/MM/YYYY hh:mm").format("DD/MM/YYYY"));
                    }
                    $('#isPwdNeverExpired').text(result.details.isPwdNeverExpired);
                    $('#status').text(result.details.status);
                    var status = $('#status').text();
                    if(status=="RESET"){
                        $('#reset').prop('disabled',false);
                        $('#unlock').prop('disabled',true);
                        $('#inactivate').prop('disabled',false);
                        $('#activate').prop('disabled',true);

                    }else if(status=="ACTIVE"){
                        $('#reset').prop('disabled',false);
                        $('#unlock').prop('disabled',true);
                        $('#inactivate').prop('disabled',false);
                        $('#activate').prop('disabled',true);
                    }else if(status=="INACTIVE"){
                        $('#reset').prop('disabled',true);
                        $('#unlock').prop('disabled',true);
                        $('#inactivate').prop('disabled',true);
                        $('#activate').prop('disabled',false);
                    }else if(status=="LOCKED"){
                        $('#reset').prop('disabled',true);
                        $('#unlock').prop('disabled',false);
                        $('#inactivate').prop('disabled',false);
                        $('#activate').prop('disabled',true);
                    }else{
                        $('#reset').prop('disabled',true);
                        $('#unlock').prop('disabled',true);
                        $('#inactivate').prop('disabled',true);
                        $('#activate').prop('disabled',true);
                    }
                    oTable.clear();
                    if(detail){
                    $.each(detail, function (idx, obj){
                        oTable.row.add([
                            obj.roleName,
                            obj.roleDscp
                        ]).draw(true);
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
            complete: function(data) {

            }
        });
    }

</script>