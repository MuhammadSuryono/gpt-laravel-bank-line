
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
                                    <label id="sourceAcct">-</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-header">
                    <h3 class="box-title">Cheque Detail</h3><br>
                </div>
                <div class="box-body">
                    <div class="container-fluid ">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Number of pages</label>
                                <div class="col-md-6">
                                    <label id="pagesNo">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row chargeDetail">
                            
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
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Pickup Branch</label>
                                <div class="col-md-6">
                                    <label id="pickBranch">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label"></label>
                                <div class="col-md-6">
                                    <label id="branchAddress">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Pickup Schedule</label>
                                <div class="col-md-6">
                                    <label id="pickSchedule">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">At</label>
                                <div class="col-md-6">
                                    <label id="pickTime">-</label>
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
    // var subAcctList;
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
                    var confirm = detail.confirm_data;

                    $('#sourceAcct').text(confirm.source_account);
                    $('#pagesNo').text(detail.noOfPages);

                    setChargesDetail(detail.chargeList);

                    $('#feeTotal').text(confirm.totalChargeCurrency +" "+ confirm.totalCharge);
                    $('#totalDebitAmount').text(detail.transactionCurrency +' '+ confirm.totalDebitedAmount);
                    $('#pickBranch').text(confirm.city + ", " + detail.branchCode + " - " + detail.branch_name);
                    $('#branchAddress').text(detail.branch_address);
                    $('#pickSchedule').text(confirm.payment_date);
                    $('#pickTime').text(detail.sessionTime);

                    
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

    function setChargesDetail(chargeList){

        tags = '<div class="form-group">'
        for (var i = 0; i < chargeList.length; i++) {
            tags += '<label class="col-md-5 control-label">'+chargeList[i].serviceChargeName+'</label><div class="col-md-6"><label>'+chargeList[i].currencyCode+' '+chargeList[i].value+'</label></div>';
        }
        tags += '</div>';
        
        $('.chargeDetail').html(tags);

    }


</script>