
<section class="content">
    <div class="panel panel-default">
        <div class="panel-body box-body">
            <input type="hidden" id="referenceNo" value=""/>
                <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Source Account</h3><br>
                </div>
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Source Account</label>
                                <div class="col-md-6">
                                    <label id="sourceAccount">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Sender Reference Number</label>
                                <div class="col-md-6">
                                    <label id="senderRefNo">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Final Payment</label>
                                <div class="col-md-6">
                                    <label id="finalPayment">-</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-header">
                    <h3 class="box-title">Institution</h3><br>
                </div>
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Institution Category</label>
                                <div class="col-md-6">
                                    <label id="instCategory">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Institution</label>
                                <div class="col-md-6">
                                    <label id="institution">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row nameListDetail">
                            
                        </div>
                    </div>
                </div>
                <div class="box-header">
                    <h3 class="box-title">Payment Detail</h3><br>
                </div>
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row othersInfoDetail">
                            
                        </div>
                        <div class="row chargeClass">

                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Total Fee</label>
                                <div class="col-md-6">
                                    <label id="feeTotal">-</label>
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
                        <div class="row instructionModeClass">
                            
                        </div>
                        <hr style="height:1px;border:none;color:#333;background-color:#d2d6de;"/>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Notify the Beneficiary</label>
                                <div class="col-md-6">
                                    <label id="notify">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row notifyEmail" style="display:none">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Beneficiary Email Address</label>
                                <div class="col-md-6">
                                    <label id="email">-</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<script>
    var oTable;
    var chargeList;
    var service = '{{ $service }}';
    $(document).ready(function () {

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
                    chargeList = detail.chargeList;

                    $('#sourceAccount').text(confirm_data.source_account);
                    $('#senderRefNo').text(confirm_data.senderRefNo);
                    $('#finalPayment').text(confirm_data.isFinalPayment);

                    $('#instCategory').text(confirm_data.institutionCategoryName);
                    $('#institution').text(confirm_data.institutionName);
                    
                    setDetailNameList(detail.nameList, confirm_data);
                    setDetailOthersInfo(detail.othersInfo);

                    $('#feeTotal').text(confirm_data.totalChargeCurrency+' '+confirm_data.totalCharge);
                    $('#totalDebitAmount').text(detail.transactionCurrency +' '+confirm_data.totalDebitedAmount);
                    $('#paymentSchedule').text(confirm_data.payment_schedule);
                    $('#notify').text(confirm_data.notify);
                    if (detail.isNotify == 'Y') {
                        $('#email').text(detail.notifyBenValue);
                        $('.notifyEmail').show();
                    }                    

                    setChargesDetail(chargeList);
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

    function setChargesDetail(chargeList){

        tags = '<div class="form-group">'
        for (var i = 0; i < chargeList.length; i++) {
            tags += '<label class="col-md-5 control-label">'+chargeList[i].serviceChargeName+'</label><div class="col-md-6"><label>'+chargeList[i].currencyCode+' '+chargeList[i].value+'</label></div>';
        }
        tags += '</div>';
        
        $('.chargeClass').html(tags);

    }

    function setDetailNameList(nameList, confirm_data){

        tags = '<div class="form-group">'

        $.each(nameList, function (idx, obj) {
            var type = obj.type;
            tags += '<label class="col-md-5 control-label">'+obj.name+'</label>';
            tags += '<div class="col-md-6">';
            if (type != 'DROPLIST') {
                tags += '<label>'+confirm_data["value"+(idx +1)]+'</label>';
            } else {
                tags += '<label>'+confirm_data["droplistName"+(idx +1)]+'</label>';
            }
            tags += '</div>';
        });

        tags += '</div>';
        
        $('.nameListDetail').html(tags);
    }

    function setDetailOthersInfo(infoList){

        tags = '<div class="form-group">'

        $.each(infoList, function (idx, obj) {
            tags += '<label class="col-md-5 control-label">'+obj.label+'</label>';
            tags += '<div class="col-md-6">';
            tags += '<label>'+obj.value+'</label>';
            tags += '</div>';
        });

        tags += '</div>';
        
        $('.othersInfoDetail').html(tags);
    }


</script>