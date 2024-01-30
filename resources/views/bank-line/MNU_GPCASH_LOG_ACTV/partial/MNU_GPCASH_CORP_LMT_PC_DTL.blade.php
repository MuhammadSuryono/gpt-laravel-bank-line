				<div class="box-header">
                    <h3 class="box-title">Transaction Limit Detail</h3><br>
                </div>

                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Corporate ID</label>
                                <div class="col-md-6">
                                    <label id="corporateId_1">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Corporate Name</label>
                                <div class="col-md-6">
                                    <label id="name">-</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="box-header">
                        <h3 class="box-title table-hidden">Transaction Limit per Day per Corporate</h3>
                    </div>
                    <div class="box-body">
                        
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th align="center" rowspan="2"><strong>Service</strong></th>
                                        <th align="center" rowspan="2"><strong>Currency Matrix</strong></th>
                                        <th align="center" rowspan="2"><strong>Maximum Number of Transaction / Day</strong></th>
                                        <th align="center" colspan="2"><strong>Maximum Transaction Amount / Day</strong></th>
                                    </tr>
                                    <tr>
                                        <th align="center"><strong>Currency</strong></th>
                                        <th align="center"><strong>Maximum Value</strong></th>
                                    </tr>
                                    </thead>
                                    <tbody><tr>
                                        <td align="left"></td>
                                        <td align="left"></td>
                                        <td align="left"></td>
                                        <td align="left"></td>
                                        <td align="left"></td>
                                    </tr>
                                    </tbody>
                                </table>
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
                    width: "250px"
                },
                {
                    targets: 1,
                    sortable: false,
                    width: "100px"
                },
                {
                    targets: 2,
                    sortable: false,
                    width: "50px",
                    render: $.fn.dataTable.render.number( ',', '.', 0, '' )

                },
                {
                    targets: 3,
                    sortable: false,
                    width: "30px"
                },
                {
                    targets: 4,
                    sortable: false,
                    width: "100px",
                    render: $.fn.dataTable.render.number( ',', '.', 2, '' )
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
                    var detail = result.details.corporateLimitList;
                    $('#corporateId_1').text(result.details.corporateId);
                    $('#name').text(result.details.name);
                    oTable.clear();
                    if(detail){
                    $.each(detail, function (idx, obj){
                        oTable.row.add([
                            obj.serviceName,
                            obj.currencyMatrixName,
                            obj.maxOccurrenceLimit,
                            obj.currencyCode,
                            obj.maxAmountLimit
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
            complete: function(data) {

            }
        });
    }

</script>