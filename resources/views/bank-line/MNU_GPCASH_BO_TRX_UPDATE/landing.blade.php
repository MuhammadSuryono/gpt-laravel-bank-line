@include('_partials.header_content',['breadcrumb'=>['Transaction Update','Search']])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div class="box">
                <div id="spinner" style="display:none"></div>
                <div class="box-header">
                    <h3 class="box-title">Transaction Filter</h3>
                </div>
                <form class="form-horizontal" id="form-area">

                <div class="box-body">
                    <div class="container-fluid">                        
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-3">
                                   <label for="refNo-rb">Reference Number</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" id="refNo" name="refNo" class="form-control" autocomplete="off" value="" maxlength="40" >
                                </div>
                            </div>
                        </div>
                </div>
                <div class="box-footer">
                    <div class="float-left">
                        <button type="button" id="search" name="search" class="btn btn-primary">@lang('form.search')</button>
                    </div>
                </div>
                </form>
                    <div class="box-header list-title">
                        <h3 class="box-title">Transaction Listing</h3>
                    </div>
                    <div class="box-body list-title">
                        
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2" style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th align="center"><strong>No.</strong></th>
                                        <th align="center"><strong>Corporate</strong></th>
                                        <th align="center"><strong>Latest Activity</strong></th>
                                        <th align="center"><strong>Reference No</strong></th>
                                        <th align="center"><strong>Menu</strong></th>
                                        <th align="center"><strong>Corporate Account</strong></th>
                                        <th align="center"><strong>Transaction Amount</strong></th>
                                        <th align="center"><strong>Created By</strong></th>
                                        <th align="center"><strong>Transaction Status</strong></th>
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
    var service = '{{ $service }}';

    $(document).ready(function () {

        var url_action = '';
        var action = 'SEARCH';
        var result_key = 'result';
        var custom_order = {"referenceNo": "DESC"};
        var data_code = '';

        $('#list').hide();
        $('.list-title').hide();

        $('#search').on('click', function (){
 
            var validate = true;

            var value = {
                referenceNo : "",
                senderRefNo : "",
                benRefNo : "",
                currentPage: "1",
                pageSize: "20",
            };

    
                url_action = 'searchTransactionStatusByReferenceNo';
                value.referenceNo = $('#refNo').val();
                value.status = 'IN_PROGRESS_OFFLINE';
                value.errorTimeoutFlag = 'Y';

            $(this).prop("disabled",true);
            $('#list').show();
            $('.list-title').show();

            if (validate) {

                    var index = 1;
                    $('#list').DataTable({
                        "destroy": true,
                        "initComplete": function(settings, json) {
                            $('#search').prop("disabled",false);

                        },
                        "select": false,
                        "searching": false,
                        "lengthMenu": [[10, 25, 50], [10, 25, 50]],
                        "processing": true,
                        "serverSide": true,
                        "autoWidth": false,
                        "ScrollX": '100%',
                        "columnDefs": [
                            {
                                targets: 0,
                                data: "indexNo",
                                className: 'dt-center',
                            },
                            {
                                targets: 1,
                                data: {
                                    corporateId: "corporateId",
                                    corporateName: "corporateName"
                                },
                                 render: function ( data, type, full, meta ) {
                                    return data.corporateId +' - '+ data.corporateName;
                                },
                                orderable: false
                            },
                            {
                                targets: 2,
                                data: "latestActivityDate",
                                orderable: false
                            },
                            {
                                targets: 3,
                                data: {
                                    referenceNo: "referenceNo",
                                    pendingTaskId: "pendingTaskId",
                                    pendingTaskMenuName: "pendingTaskMenuName",
                                    pendingTaskMenuCode: "pendingTaskMenuCode",
                                    status: "status",
                                },
                                render: function ( data, type, full, meta ) {
                                    return '<a href="javascript:void(0)" data-code="'+data.pendingTaskId+'" data-menu="'+data.pendingTaskMenuName+'" data-menuCode="'+data.pendingTaskMenuCode+'" data-refNo="'+data.referenceNo+'" data-trxStatus="'+data.status+'">'+data.referenceNo+'</a>';
                                },
                                orderable: false
                            },
                            {
                                targets: 4,
                                data: "pendingTaskMenuName",
                                orderable: false
                            },
                            {
                                targets: 5,
                                data: {
                                    sourceAccount: "sourceAccount",
                                    sourceAccountName: "sourceAccountName",
                                    sourceAccountCurrencyName: "sourceAccountCurrencyName",
                                },
                                 render: function ( data, type, full, meta ) {
                                    if (data.sourceAccount !='') {
                                        return data.sourceAccount +' / '+ data.sourceAccountName +' ('+data.sourceAccountCurrencyName+')';
                                    } else {
                                        return '';
                                    }
                                },
                                orderable: false
                            },
                            {
                                targets: 6,
                                // data: "transactionAmount",
                                data: {
                                    transactionAmount: "transactionAmount",
                                    transactionCurrency: "transactionCurrency"
                                },
                                orderable: false,
                                // render: $.fn.dataTable.render.number( ',', '.', 0, 'IDR ' )
                                render: function ( data, type, full, meta ) {
                                    if(data.transactionAmount == '-1'){
                                        return '';
                                    } else {
                                        return data.transactionCurrency +' '+ currencyFormat(data.transactionAmount);
                                    }
                                },
                            },
                            {
                                targets: 7,
                                data: {
                                    createdByUserId: "createdByUserId",
                                    createdByUserName: "createdByUserName"
                                },
                                 render: function ( data, type, full, meta ) {
                                    return data.createdByUserId +' - '+ data.createdByUserName;
                                },
                                orderable: false
                            },
                            {
                                targets: 8,
                                data: "status",
                                orderable: false
                            }
                        ],
                        "ajax": {
                            url: "fetchDataTable",
                            type:'POST',
                            data: function ( d ) {
                                d.value = value;
                                d.menu = service;
                                d.url_action = url_action;
                                d.action = action;
                                d.result_key = result_key;
                                d.custom_order = custom_order;
                                d._token = '{{ csrf_token() }}';
                            },
                            error:function (jqXHR, textStatus, errorThrown) {

                                var msg = '{{trans('form.conn_error')}}';
                                flash('warning', msg);
                                $('#list').hide();
                                $('.list-title').hide();
                                $('#search').prop("disabled",false);
                            },
                            complete: function (data) {

                            }
                        }
                    });
                }
                
        });

        $('#list tbody').on('click', 'a', function (e) {
            if(e.handled !== true) // This will prevent event triggering more then once
            {
                e.handled = true;
            }
            var id = $(this).data('code');
            var menuName = $(this).attr('data-menu');
            var trxRefNo = $(this).attr('data-refNo');
            var trxStatus = $(this).attr('data-trxStatus');
            var menuCode = $(this).attr('data-menuCode');

            if (id !== undefined) {
                var res = app.setView(service,'detail');
                if(res=='done'){
                    $('#pendingTaskId').val(id);
                    $('#menuName').text(menuName);
                    $('#trxStatus').text(trxStatus);
                    $('#trxRefNo').text(trxRefNo);
                    $('#refNo').val(trxRefNo);
                    $('#menuCode').val(menuCode);
                    getDetail();
                }
            }
        });
        $('input[type="text"]').not('.numeric').alphanum({
            allowSpace: true,
            allow : ',._!@'
        });                        

    });

    function currencyFormat (num) {
        return parseFloat(num).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");  //<--- $1  is a special replacement pattern which holds a value of the first parenthesised submatch string 
    }



</script>