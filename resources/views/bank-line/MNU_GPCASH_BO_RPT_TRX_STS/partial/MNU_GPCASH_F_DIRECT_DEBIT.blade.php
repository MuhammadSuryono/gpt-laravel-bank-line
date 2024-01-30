
<section class="content">
    <div class="panel panel-default">
        <div class="panel-body box-body">
            <input type="hidden" id="referenceNo" value=""/>
                <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Record Detail</h3><br>
                </div>
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Credit Account</label>
                                <div class="col-md-6">
                                    <label id="creditAccount">-</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-header">
                    <h3 class="box-title">File Detail</h3><br>
                </div>
                <div class="box-body">
                    <div class="container-fluid">
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
                                <label class="col-md-5 control-label">File Description</label>
                                <div class="col-md-6">
                                    <label id="fileDescp">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Total Record</label>
                                <div class="col-md-6">
                                    <label id="totalRecord">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Total Amount</label>
                                <div class="col-md-6">
                                    <label id="totalAmount">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row chargeDetail">
                           
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Total Fee</label>
                                <div class="col-md-6">
                                    <label id="totalFee">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Total Debit Amount</label>
                                <div class="col-md-6">
                                    <label id="totalDebitAmount">-</label>
                                </div>
                            </div>
                        </div>
                        <hr style="height:1px;border:none;color:#333;background-color:#d2d6de;"/>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Payment Schedule</label>
                                <div class="col-md-6">
                                    <label id="paymentSchedule">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group instDate">
                                <label class="col-md-5 control-label">Payment Date</label>
                                <div class="col-md-6">
                                    <label id="paymentDate">-</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid overseasBankType">
                        
                    </div>
                </div>
                <div class="box-header">
                    <h3 class="box-title">Record Detail</h3><br>
                </div>
                <div class="box-body listDetail" >
                    <table id="uploadListDetail" class="table table-bordered table-striped dataTable" border="2" cellpadding="2" style="border-collapse:collapse;">
                        <thead>
                            <tr>
                                <th align="center"><strong>No</strong></th>
                                <th align="center"><strong>Debit Account Number</strong></th>
                                <th align="center"><strong>Debit Account Name</strong></th>
                                <th align="center"><strong>Transfer Amount</strong></th>                               
                                <th align="center"><strong>Description</strong></th>
                                <th align="center"><strong>Sender Ref No</strong></th>
                                <th align="center"><strong>Final Payment</strong></th>
                                <th align="center"><strong>Beneficiary Ref No</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td align="center"></td>
                                <td align="left"></td>
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
    </div>

</section>

<script>
    var oTable;
    var uploadListDetail;
    var service = '{{ $service }}';
    $(document).ready(function () {

        uploadListDetail = $('#uploadListDetail').DataTable({
            
            "ordering" : false,
            "info": false,
            "destroy": true,
            "lengthMenu": [[10, 25, 50], [10, 25, 50]],
            "searching": false,
            "autoWidth":false,
            "columnDefs": [
               {
                    sortable: false,
                    width: "5%",
                    targets: 0,
                    className: 'dt-center',
               },
               {
                    targets: 1,
                    sortable: false,
                    width: "13.57%"
                },
                {
                    targets: 2,
                    sortable: false,
                    width: "13.57%"
                },
                {
                    targets: 3,
                    sortable: false,
                    width: "13.57%"
                },
                {
                    targets: 4,
                    sortable: false,
                    width: "13.57%"
                },
                {
                    targets: 5,
                    sortable: false,
                    width: "13.57%"
                },
                {
                    targets: 6,
                    sortable: false,
                    className: 'dt-center',
                    width: "13.57%"
                },
                {
                    targets: 7,
                    sortable: false,
                    width: "13.57%"
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
                    var confirm_data = detail.confirm_data;
                    var chargeList = detail.chargeList;

                    $('#creditAccount').text(confirm_data.creditAccountNo + ' / ' + confirm_data.creditAccountName + '(' + confirm_data.creditAccountCurrencyCode + ')');
                    $('#uploadDate').text(confirm_data.uploadDateTime);
                    $('#fileFormat').text(confirm_data.fileFormat);
                    $('#fileUpload').text(confirm_data.fileName);
                    $('#fileDescp').text(confirm_data.fileDescription);
                    $('#totalRecord').text(confirm_data.totalRecord);
                    $('#totalAmount').text(confirm_data.transactionAmount);
					$('#totalAmount').autoNumeric('init',{
							emptyInputBehavior: 'zero',
							digitGroupSeparator        : ',',
							decimalCharacter           : '.',
							decimalCharacterAlternative: '.',
							allowDecimalPadding : true,
							minimumValue:'0.00',maximumValue:'999999999999999.99'
						});

                    setChargesDetail(chargeList, confirm_data);

                    $('#totalFee').text(confirm_data.totalChargeCurrency+" "+confirm_data.totalCharge);
                    $('#totalDebitAmount').text(confirm_data.totalChargeCurrency+" "+confirm_data.totalDebitedAmount);
                    
                    if (detail.instructionMode == 'I') {
                        $('#paymentSchedule').text('Immediate');
                        $('#paymentDate').text(confirm_data.instructionDate);
                    } else if (detail.instructionMode == 'F') {
                        $('#paymentSchedule').text('Specific Date');
                        $('#paymentDate').text(confirm_data.instructionDate);

                        tags = '<label class="col-md-5 control-label">at</label>';
                        tags += '<div class="col-md-6">';
                        tags += '<label>'+detail.sessionTime+'</label>';
                        tags += '</div>';

                        $('.instDate').html(tags);
                    }

                    if (detail.pendingUploadId) {

                        prepareUploadDetail(detail.pendingUploadId, detail.details);

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

    function setChargesDetail(chargeList, confirm_data){
        
        // if (chargeList[0]) {

            tags = '<div class="form-group">';
            tags += '<label class="col-md-5 control-label">'+chargeList[0].serviceChargeName+'</label>';
            tags += '<div class="col-md-6">';
            tags += '<label>'+chargeList[0].currencyCode+' '+chargeList[0].value+' / record '+'</label>';
            tags += '</div></div>';

            tags += '<div class="form-group">';
            tags += '<label class="col-md-5 control-label"></label>';
            tags += '<div class="col-md-6">';
            tags += '<label>'+chargeList[0].currencyCode+' '+chargeList[0].value+' x '+confirm_data.totalRecord+' record = '+ confirm_data.totalChargeCurrency+' '+ confirm_data.totalCharge+'</label>';
            tags += '</div></div>';

            $('.chargeDetail').html(tags);
        /*} else {

            console.log("====== else");

            tags = '<div class="form-group">';
            tags += '<label class="col-md-5 control-label">'+Payroll Fee+'</label>';
            tags += '<div class="col-md-6">';
            tags += '<label>'+' - '+'</label>';
            tags += '</div></div>';

            $('.chargeDetail').html(tags);
        }*/
    }

    function prepareUploadDetail(detailId, listDetail){

        
        uploadListDetail.clear();
        $.each(listDetail, function (idx, obj) {
                uploadListDetail.row.add([
                                idx+1,
                                obj.benAccountNo,
                                obj.benAccountName,
                                obj.trxAmount,
                                obj.description,
                                obj.senderRefNo,
                                obj.finalizeFlag,
                                obj.benRefNo
                ]).draw(true);
        });

    }


</script>