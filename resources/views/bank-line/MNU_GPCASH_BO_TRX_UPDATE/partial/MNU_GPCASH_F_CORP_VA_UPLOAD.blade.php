
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
                <div class="box-body">
                    <div class="container-fluid ">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Uploaded Date Time</label>
                                <div class="col-md-6">
                                    <label id="uploadDate">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">File Format</label>
                                <div class="col-md-6">
                                    <label id="fileFormat">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">File Upload</label>
                                <div class="col-md-6">
                                    <label id="fileUpload">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Total Number of Virtual Account</label>
                                <div class="col-md-6">
                                    <label id="totalNo">-</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <table id="vaList" class="table table-bordered table-striped dataTable" border="2" cellpadding="2" style="border-collapse:collapse;">
                        <thead>
                            <tr>
                                <th align="center" width="50%"><strong>Virtual Account Number</strong></th>
                                <th align="center" width="50%"><strong>Virtual Account Name</strong></th>
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
                    width: "50%"
                },
                {
                    targets: 1,
                    sortable: false,
                    width: "50%"
                }
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
                    var confirmData = detail.confirm_data;

                    $('#mainAcct').text(detail.sourceAccountNo.concat(" / ").concat(detail.sourceAccountName).concat(" (" + detail.sourceAccountCurrencyCode + ")"));
                    $('#corpCode').text(confirmData.corpCorporateCode);
                    $('#prodCode').text(detail.fileDescription);

                    var date = moment(confirmData.uploadDateTime,'DD-MM-YYYY HH:mm:ss');
                    $('#uploadDate').text(moment(date).format('DD MMM YYYY HH:mm:ss'));
                    $('#fileFormat').text(confirmData.fileFormat);
                    $('#fileUpload').text(confirmData.fileName);
                    $('#totalNo').text(confirmData.totalRecord);

                    detailList.clear();
                    $.each(detail.details, function (idx, obj){
                        
                            detailList.row.add([
                                obj.benAccountNo,
                                obj.benAccountName
                            ]).draw(true);

                    });
                    
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