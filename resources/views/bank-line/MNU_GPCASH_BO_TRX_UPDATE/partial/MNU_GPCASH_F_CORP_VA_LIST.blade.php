
<section class="content">
    <div class="panel panel-default">
        <div class="panel-body box-body">
            <input type="hidden" id="referenceNo" value=""/>
                <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Account Detail</h3><br>
                </div>
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Main Account</label>
                                <div class="col-md-6">
                                    <label id="mainAcct">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Corporate Code</label>
                                <div class="col-md-6">
                                    <label id="corpCode">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Product Code</label>
                                <div class="col-md-6">
                                    <label id="prodCode">-</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-header">
                    <h3 class="box-title">Virtual Account Detail</h3><br>
                </div>
                <div class="box-body addView">
                    <div class="container-fluid ">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Virtual Account Number</label>
                                <div class="col-md-6">
                                    <label id="vaNo">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Virtual Account Name</label>
                                <div class="col-md-6">
                                    <label id="vaName">-</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-body deleteView">
                    <table id="vaList" class="table table-bordered table-striped dataTable" border="2" cellpadding="2" style="border-collapse:collapse;">
                        <thead>
                            <tr>
                                <th align="center" width="35%"><strong>Virtual Account Number</strong></th>
                                <th align="center" width="35%"><strong>Virtual Account Name</strong></th>
                                <th align="center" width="30%"><strong>Status</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td align="left"></td>
                                <td align="left"></td>
                                <td align="left"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>

<script>
    var detailList;
    var service = '{{ $service }}';
    $(document).ready(function () {

        detailList = $('#vaList').DataTable({
            // "paging" : false,
            "ordering" : false,
            "info": false,
            "destroy": true,
            "lengthMenu": [[10, 25, 50], [10, 25, 50]],
            "searching": false,
            "autoWidth":false,
            "columnDefs": [
               {
                    targets: 0,
                    sortable: false,
                    width: "35%"
                },
                {
                    targets: 1,
                    sortable: false,
                    width: "35%"
                },
                {
                    targets: 2,
                    sortable: false,
                    // className: 'dt-center',
                    width: "30%"
                },
            ]
        });

    });

    function getDetailData(refNo){
        var value = {
            referenceNo : refNo
        };
        var url_action = 'detailPendingTask';
        var action = 'DETAIL';
        var menu = service;
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data: {
                value : value,
                menu : menu,
                url_action : url_action,
                action : action,
                _token : '{{ csrf_token() }}'
            },
            success: function (data) {
                var result = JSON.parse(data);
                if (result.status=="200") {
                    var detail = result.details;
                    var action = detail.action;

                    $('#mainAcct').text(detail.detail_params.mainAccount);
                    $('#corpCode').text(detail.detail_params.corpCode);
                    $('#prodCode').text(detail.detail_params.productCode);

                    if (action == 'CREATE') {
                        $('.deleteView').hide();
                        $('#vaNo').text(detail.vaNo);
                        $('#vaName').text(detail.vaName);
                    } else {
                        $('.addView').hide();
                        
                        detailList.clear();
                        $.each(detail.vaDetailList, function (idx, obj){
                        
                            detailList.row.add([
                                obj.vaNo,
                                obj.vaName,
                                obj.vaStatus
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
                $('.table-hidden').show();

            }
        });
    }

</script>