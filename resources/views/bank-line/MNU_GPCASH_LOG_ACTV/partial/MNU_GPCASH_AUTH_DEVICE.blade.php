					<div class="box-header">
						<h3 class="box-title">Corporate Detail</h3><br>
					</div>

                    <div class="box-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Corporate</label>
                                    <div class="col-md-6">
                                        <label id="code_1">-</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row unassigned" style="display: none;">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Serial Number</label>
                                    <div class="col-md-6">
                                        <label id="tokenNo">-</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row unassigned" style="display: none;">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Assigned To</label>
                                    <div class="col-md-6">
                                        <label id="assignedTo">-</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row unassigned" style="display: none;">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Assigned By</label>
                                    <div class="col-md-6">
                                        <label id="assignedBy">-</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row unassigned" style="display: none;">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Assigned Date</label>
                                    <div class="col-md-6">
                                        <label id="assignedDate">-</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row unassigned" style="display: none;">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Status</label>
                                    <div class="col-md-6">
                                        <label id="status">-</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

					<div class="box-header listing">
						<h3 class="box-title table-hidden">Device Listing</h3>
					</div>
				
					<div class="box-body listing">
						<table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2" style="border-collapse:collapse;">
                            <thead>
                                <tr>
                                    <th align="left"><strong>Serial Number</strong></th>
                                    <th align="left"><strong>Assigned To</strong></th>
                                    <th align="left"><strong>Assigned By</strong></th>
                                    <th align="left"><strong>Assigned Date</strong></th>
                                    <th align="left"><strong>Status</strong></th>
                                </tr>
							</thead>
						</table>
					</div>
			
<script>
    var oTable;

    $(document).ready(function () {       
        oTable = $('#list').DataTable({
            //"paging" : false,
            "ordering" : false,
            "info": false,
            "destroy": true,
            "searching": false,
            "autoWidth":false,
            "lengthMenu": [[10, 25, 50], [10, 25, 50]],
            "columnDefs": [
                {
                    targets: 0,
                    sortable: true,
                    width: "20%"
                },
                {
                    targets: 1,
                    sortable: true,
                    width: "20%"
                },
                {
                    targets: 2,
                    sortable: true,
                    width: "20%"
                },
                {
                    targets: 3,
                    sortable: true,
                    width: "20%"
                },
                {
                    targets: 4,
                    sortable: false,
                    width: "10%"
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
                    var detail = result.details.tokenList;
                    $('#code_1').text(result.details.corporateId+' - '+result.details.name);
                    if(result.details.action=='UNASSIGN'){
                        $('.listing').hide();
                        $('.unassigned').show();
                        $('#tokenNo').text(result.details.tokenNo);
                        $('#assignedTo').text(result.details.userId+' - '+result.details.userName);
                        $('#assignedBy').text(result.details.assignedBy);
                        $('#assignedDate').text(result.details.assignedDate);
                        $('#status').text(result.details.status);
                    }
                    oTable.clear();
                    if(detail[0].assignedBy==undefined){
                        $.each(detail, function (idx, obj){
                            oTable.row.add([
                                obj,'','','','',''
                            ]).draw(true);
                        });
                        oTable.column(1).visible(false);
                        oTable.column(2).visible(false);
                        oTable.column(3).visible(false);
                        oTable.column(4).visible(false);

                    }else{
                        $.each(detail, function (idx, obj){
                            oTable.row.add([
                                obj.tokenNo,
                                obj.userId,
                                obj.assignedBy,
                                obj.assignedDate,
                                obj.status
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