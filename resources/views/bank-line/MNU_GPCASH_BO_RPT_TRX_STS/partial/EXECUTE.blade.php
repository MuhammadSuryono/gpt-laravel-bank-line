
<section class="content">
    <div class="panel panel-default">
        <div class="panel-body box-body">
            <input type="hidden" id="tempExecutedList" value=""/>
                <div class="box">
                <div class="box-body list-title">
                        
                    <table id="listDetailExecuted" class="table table-bordered table-striped dataTable" border="2" cellpadding="2" style="border-collapse:collapse;">
                        <thead>
                            <tr>
                                <th align="center"><strong>Executed Date</strong></th>
                                <th align="center"><strong>System Reference Number</strong></th>
                                <th align="center"><strong>Debit Account</strong></th>
                                <th align="center"><strong>Amount</strong></th>
                                <th align="center"><strong>Credit Account</strong></th>
                                <th align="center"><strong>Status</strong></th>
                                <th align="center"><strong>Reason</strong></th>
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
                            </tr>
                        </tbody>
                    </table>
                        
                </div>
            </div>
            <div id="detailModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Transaction Detail</h4>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-md-5 control-label">Executed Date</label>
                                        <div class="col-md-6">
                                            <label id="executedDate">-</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-md-5 control-label">System Reference Number</label>
                                        <div class="col-md-6">
                                            <label id="sysRefNo">-</label>
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
                                        <label class="col-md-5 control-label">Debit Account</label>
                                        <div class="col-md-6">
                                            <label id="debitAcct">-</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-md-5 control-label">Debit Equivalent Amount</label>
                                        <div class="col-md-6">
                                            <label id="debitEqv">-</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-md-5 control-label">Debit Exchange Rate</label>
                                        <div class="col-md-6">
                                            <label id="debitExchange">-</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-md-5 control-label">Beneficiary Reference Number</label>
                                        <div class="col-md-6">
                                            <label id="benRefNo">-</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-md-5 control-label">Credit Account</label>
                                        <div class="col-md-6">
                                            <label id="creditAcct">-</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-md-5 control-label">Credit Equivalent Amount</label>
                                        <div class="col-md-6">
                                            <label id="creditEqv">-</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-md-5 control-label">Credit Exchange Rate</label>
                                        <div class="col-md-6">
                                            <label id="creditExchange">-</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-md-5 control-label">Fee Account</label>
                                        <div class="col-md-6">
                                            <label id="feeAcct">-</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="form-group">
                                        <label class="col-md-5 control-label">Fee Type</label>
                                        <div class="col-md-6">
                                            <label id="feeType">-</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-md-5 control-label">Fee Equivalent Account</label>
                                        <div class="col-md-6">
                                            <label id="feeEqv">-</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-md-5 control-label">Fee Exchange Rate</label>
                                        <div class="col-md-6">
                                            <label id="feeExchange">-</label>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="row chargeDetail">
                                   
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">@lang('form.close')</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</section>

<script>
    var executedList;
    var service = '{{ $service }}';
    $(document).ready(function () {

        executedList = $('#listDetailExecuted').DataTable({
            // "paging" : false,
            "ordering" : false,
            "info": false,
            "destroy": true,
            "lengthMenu": [[10, 25, 50], [10, 25, 50]],
            "searching": false,
            "autoWidth":false,
            "columnDefs": [
               {
                    sortable: false,
                    width: "14.28%",
                    targets: 0,
                    render: function ( data, type, full, meta ) {
                            return '<a href="javascript:void(0)" select-index="'+data.index+'">'+data.executedDate+'</a>';
                    },
               },
               {
                    targets: 1,
                    sortable: false,
                    width: "14.28%"
                },
                {
                    targets: 2,
                    sortable: false,
                    width: "14.28%"
                },
                {
                    targets: 3,
                    sortable: false,
                    // className: 'dt-center',
                    width: "14.28%"
                },
                {
                    targets: 4,
                    sortable: false,
                    width: "14.28%"
                },
                {
                    targets: 5,
                    sortable: false,
                    className: 'dt-center',
                    width: "14.28%"
                },
                {
                    targets: 6,
                    sortable: false,
                    width: "14.28%"
                }

            ]
        });

        $('#listDetailExecuted tbody').on('click', 'a', function (e) {
            if(e.handled !== true) // This will prevent event triggering more then once
            {
                e.handled = true;
            }

            var indexSelected = $(this).attr('select-index');
            
            prepareDetailPopUp(indexSelected);

            $('#detailModal').modal('show');

            
        });

    });

    function getDetailExecuted(uploadId, menu){
        var value = {
            executedId : uploadId,
            executedMenuCode : menu,
            // currentPage : 1,
            // pageSize: 10,
        };
        var url_action = 'detailExecutedTransaction';
        var action = 'DETAIL';
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data: {
                value : value,
                menu : service,
                url_action : url_action,
                action : action,
                _token : '{{ csrf_token() }}'
            },
            success: function (data) {
                var result = JSON.parse(data);
                if (result.status=="200") {

                    var listExecuted = result.executedResult;

                    $('#tempExecutedList').val(JSON.stringify(listExecuted));

                    executedList.clear();
                    $.each(listExecuted, function (idx, obj) {
                            executedList.row.add([
                                            {"executedDate" : obj.executedDate, "index" : idx},
                                            obj.systemReferenceNo,
                                            obj.debitAccount +" - "+ obj.debitAccountName,
                                            obj.transactionAmount !='-1' ? (obj.transactionCurrency +' '+currencyFormat(obj.transactionAmount)) : '',
                                            obj.creditAccount +" - "+ obj.creditAccountName,
                                            obj.status,
                                            obj.errorCode
                            ]).draw(false);
                    });

                    // console.log(result1.executedResult);

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

    function prepareDetailPopUp(idx){

        var listExecuted = $('#tempExecutedList').val();
        listExecuted = JSON.parse(listExecuted);

        // console.log("list: ", listExecuted);

        $('#executedDate').text(listExecuted[idx].executedDate);
        $('#sysRefNo').text(listExecuted[idx].systemReferenceNo);
        $('#senderRefNo').text(listExecuted[idx].senderRefNo);
        $('#debitAcct').text(listExecuted[idx].debitAccount +" / "+ listExecuted[idx].debitAccountName);
        $('#debitEqv').text(listExecuted[idx].debitAccountCurrency +" "+ currencyFormat(listExecuted[idx].debitEquivalentAmount));
        $('#debitExchange').text(listExecuted[idx].debitAccountCurrency +" "+ currencyFormat(listExecuted[idx].debitExchangeRate));
        $('#benRefNo').text(listExecuted[idx].benRefNo);
        $('#creditAcct').text(listExecuted[idx].creditAccount +" / "+ listExecuted[idx].creditAccountName);

        var creditCurrency = (listExecuted[idx].creditAccountCurrency !=null && listExecuted[idx].creditAccountCurrency !="") ? listExecuted[idx].creditAccountCurrency : listExecuted[idx].creditTransactionCurrency;

        $('#creditEqv').text(creditCurrency +" "+ currencyFormat(listExecuted[idx].creditEquivalentAmount));
        $('#creditExchange').text(creditCurrency +" "+ currencyFormat(listExecuted[idx].creditExchangeRate));
        $('#feeAcct').text(listExecuted[idx].chargeAccount);

        if (listExecuted[idx].chargeList !=null) {

            setChargesDetail(listExecuted[idx].chargeList);
        }

    }

    function currencyFormat (num) {
        return parseFloat(num).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");  //<--- $1  is a special replacement pattern which holds a value of the first parenthesised submatch string 
    }

    function setChargesDetail(chargeList){

        tags = '<div class="form-group">'
        for (var i = 0; i < chargeList.length; i++) {
            tags += '<label class="col-md-5 control-label">Fee Type</label>';
            tags += '<div class="col-md-6"><label>'+chargeList[i].chargeType+'</label></div>';
            tags += '<label class="col-md-5 control-label">Fee Equivalent Amount</label>';
            tags += '<div class="col-md-6"><label>'+chargeList[i].chargeCurrency+" "+currencyFormat(chargeList[i].chargeEquivalentAmount)+'</label></div>';
            tags += '<label class="col-md-5 control-label">Fee Exchange Rate</label>';
            tags += '<div class="col-md-6"><label>'+chargeList[i].chargeCurrency+" "+currencyFormat(chargeList[i].chargeExchangeRate)+'</label></div>';
        }
        tags += '</div>';
        
        $('.chargeDetail').html(tags);

    }



</script>