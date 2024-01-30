                <div class="box-header">
                    <h3 class="box-title">Corporate Detail</h3><br>
                </div>

                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">CIF</label>
                                <div class="col-md-6">
                                    <label id="cifDetail">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Corporate</label>
                                <div class="col-md-6">
                                    <label id="corpDetail">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Corporate Code</label>
                                <div class="col-md-6">
                                    <label id="corpCodeDetail">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Status</label>
                                <div class="col-md-6">
                                    <label id="statusDetail">-</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-header">
                        <h3 class="box-title">Account Listing</h3><br>
                </div>
                    <div class="box-body">
                        <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                            <thead>
                                <tr>
                                    <th align="left"><strong>Main Account Number</strong></th>
                                    <th align="left"><strong>Main Account Name</strong></th>
                                    <th align="left"><strong>Account Currency</strong></th>
                                    <th align="left"><strong>Product Code</strong></th>
                                    <th align="left"><strong>Product Name</strong></th>
                                </tr>
                            </thead>
                        </table>           
                    </div>

</section>

<script>
    var oTable;
    var currencyOption;

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
                    width: "20%"
                }
                ],
            });

		getDetail('MNU_GPCASH_LOG_ACTV');

        $('.back').on('click', function () {
            res = app.setView('MNU_GPCASH_PENDING_TASK','landing');
        });

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
                    var detail = result.details;
                    var accountList = detail.accountList;

                    $('#corpDetail').text(detail.corporateId);
                    $('#cifDetail').text(detail.cif);
                    $('#corpCodeDetail').text(detail.corpCode);
                    $('#statusDetail').text(detail.status);
					
					if (detail.action == 'UPDATE_STATUS'){
						$('#statusDetail').text(detail.vaStatus);
					}
                    if (accountList) {
                        $.each(accountList, function (idx, obj){
                            oTable.row.add([
                                obj.accountNo != null ? obj.accountNo : obj.mainAccountNo,
                                obj.accountName,
                                obj.accountCurrencyCode,
                                obj.productCode,
                                obj.productName
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