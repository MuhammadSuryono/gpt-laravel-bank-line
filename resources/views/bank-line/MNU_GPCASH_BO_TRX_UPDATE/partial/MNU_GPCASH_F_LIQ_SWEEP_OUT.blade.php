
<section class="content">
    <div class="panel panel-default">
        <div class="panel-body box-body">
            <input type="hidden" id="referenceNo" value=""/>
                <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Main Account</h3><br>
                </div>
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Main Account</label>
                                <div class="col-md-6">
                                    <label id="mainAccount">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Amount Type</label>
                                <div class="col-md-6">
                                    <label id="amountType">-</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-header">
                    <h3 class="box-title">Sub Account</h3><br>
                </div>
                <div class="box-body">
                    <table id="subAcctList" class="table table-bordered table-striped dataTable" border="2" cellpadding="2" style="border-collapse:collapse;">
                        <thead>
                            <tr>
                                <th align="center"><strong>Sub Account</strong></th>
                                <th align="center"><strong>Sweep Out Amount</strong></th>
                                <th align="center"><strong>Description</strong></th>
                                <th align="center"><strong>Priority</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td align="left"></td>
                                <td align="left"></td>
                                <td align="left"></td>
                                <td align="left"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-header">
                    <h3 class="box-title">Sweep Detail</h3><br>
                </div>
                <div class="box-body">
                    <div class="container-fluid ">
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
                                <label class="col-md-5 control-label">Payment Schedule</label>
                                <div class="col-md-6">
                                    <label id="paymentSchedule">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row instructionModeClass">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<script>
    var subAcctList;
    var service = '{{ $service }}';
    $(document).ready(function () {

        subAcctList = $('#subAcctList').DataTable({
            "paging" : false,
            "ordering" : false,
            "info": false,
            "destroy": true,
            "searching": false,
            "autoWidth":false,
            "columnDefs": [
               {
                    sortable: false,
                    width: "20%",
                    targets: 0,
               },
               {
                    targets: 1,
                    sortable: false,
                    width: "20%"
                },
                {
                    targets: 2,
                    sortable: false,
                    width: "20%"
                },
                {
                    targets: 3,
                    sortable: false,
                    width: "20%"
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
                    var confirm_data = detail.confirm_data;

                    $('#mainAccount').text(confirm_data.main_account);
                    $('#amountType').text(confirm_data.remaining_amount_type);

                    prepareSubAccountDetail(confirm_data.sub_account_list);
                    setChargesDetail(detail.chargeList);

                    $('#totalFee').text(confirm_data.totalChargeCurrency +" "+ confirm_data.totalCharge);
                    $('#paymentSchedule').text(confirm_data.payment_schedule);

                    setInstructionMode(detail, confirm_data);

                    
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

    function prepareSubAccountDetail(listSubAcct){

        subAcctList.clear();
        $.each(listSubAcct, function (idx, obj) {
                var amountType = obj.remaining_amount_type;
                subAcctList.row.add([
                                obj.sub_account,
                                amountType == 'FIXED' ? (obj.transactionCurrency +" "+obj.remaining_amount_display) : (obj.remainingAmount + " %"),
                                obj.description,
                                obj.priority
                ]).draw(false);
        });

    }

    function setChargesDetail(chargeList){

        tags = '<div class="form-group">'
        for (var i = 0; i < chargeList.length; i++) {
            tags += '<label class="col-md-5 control-label">'+chargeList[i].serviceChargeName+'</label><div class="col-md-6"><label>'+chargeList[i].currencyCode+' '+chargeList[i].value+'</label></div>';
        }
        tags += '</div>';
        
        $('.chargeDetail').html(tags);

    }

    function setInstructionMode(detail, confirm_data){

        var instructionMode = detail.instructionMode;

        tags = '<div class="form-group">'
        if (instructionMode !=null && instructionMode == 'I') {
            tags += '<label class="col-md-5 control-label">Payment Date</label>';
            tags += '<div class="col-md-6">';
            tags += '<label>'+confirm_data.payment_date+'</label>';
            tags += '</div>';
        } else if (instructionMode !=null && instructionMode == 'F') {
            tags += '<label class="col-md-5 control-label">Payment Date</label>';
            tags += '<div class="col-md-6">';
            tags += '<label>'+confirm_data.payment_date+'</label>';
            tags += '</div>';
            tags += '<label class="col-md-5 control-label">at</label>';
            tags += '<div class="col-md-6">';
            tags += '<label>'+detail.sessionTime+'</label>';
            tags += '</div>';
        } else if (instructionMode !=null && instructionMode == 'R') {
            tags += '<label class="col-md-5 control-label">For</label>';
            tags += '<div class="col-md-6">';
            tags += '<label>'+confirm_data.payment_for+'</label>';
            tags += '</div>';
            tags += '<label class="col-md-5 control-label">Every</label>';
            tags += '<div class="col-md-6">';
            tags += '<label>'+confirm_data.payment_every+'</label>';
            tags += '</div>';
            tags += '<label class="col-md-5 control-label">At</label>';
            tags += '<div class="col-md-6">';
            tags += '<label>'+detail.sessionTime+'</label>';
            tags += '</div>';
            tags += '<label class="col-md-5 control-label">End Date</label>';
            tags += '<div class="col-md-6">';
            tags += '<label>'+confirm_data.payment_date_end+'</label>';
            tags += '</div>';
        }
        tags += '</div>';

        $('.instructionModeClass').html(tags);

    }


</script>