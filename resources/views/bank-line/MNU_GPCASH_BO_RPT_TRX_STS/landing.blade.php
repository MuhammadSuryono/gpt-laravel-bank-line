@include('_partials.header_content',['breadcrumb'=>['Transaction Status','Search']])


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
                                <div class="col-md-2">
                                   <input type="radio" id="corporate-rb" name="searchBy-rb" value="0" checked>
                                   <label for="corporate-rb"><strong>Corporate</strong></label>
                                </div>
                                <div class="col-md-7 row-corporate" style="margin-left: 15px;">
                                    <select class="form-control" id="corporate" data-error="please select corporate" required>
                                        <option></option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-createdby">
                            <div class="form-group" >
                                <div class="col-md-2" style="margin-left: 15px;">
                                    <label>Created By</label>
                                </div>
                                <div class="col-md-7">
                                    <select class="form-control" id="createdBy">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row row-menu">
                            <div class="form-group">
                                <div class="col-md-2" style="margin-left: 15px;">
                                    <label>Menu</label>
                                </div>
                                <div class="col-md-7">
                                    <select class="form-control" id="menu">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row row-corpaccount">
                            <div class="form-group">
                                <div class="col-md-2" style="margin-left: 15px;">
                                    <label>Corporate Account</label>
                                </div>
                                <div class="col-md-7">
                                    <select class="form-control" id="corpAccount">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row row-date">
                            <div class="form-group" style="margin-left: 15px;">
                                <label class="col-md-2">Date Range</label>
                                <div class="col-md-2 form-inline">
                                    <select class="form-control " id="dateType">
                                        <option value="0">Creation Date</option>
                                        <option value="1">Payment Date</option>
                                    </select>
                                </div>
                                <div class="form-inline dateSelect">
                                    <div class="col-md-8" style="margin-left:-25px">
                                        <div class="col-xs-5 col-md-3 no-padding">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type="text" id="dateFrom" name="dateFrom" class="form-control datepicker detail numeric" autocomplete="off" value="">
                                            </div>
                                        </div>
                                        <div>
                                            <label class="col-md-1 text-center control-label"><strong>to</strong></label>
                                        </div>
                                        <div class="col-xs-5 col-md-3 no-padding">
                                            <div class="input-group state_edit">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type="text" id="dateTo" name="dateTo" class="form-control datepicker numeric" autocomplete="off" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-status">
                            <div class="form-group">
                                <div class="col-md-2" style="margin-left: 15px;">
                                    <label>Transaction Status</label>
                                </div>
                                <div class="col-md-7">
                                    <select class="form-control" id="trxStatus">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-3">
                                   <input type="radio" id="refNo-rb" name="searchBy-rb" value="1">
                                   <label for="refNo-rb">Reference Number</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" id="refNo" name="refNo" class="form-control" autocomplete="off" value="" maxlength="40" style="display: none">
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
        getCorporate();

        $('.datepicker').datepicker({
            format: "dd/mm/yyyy",
            locale: 'id',
            autoclose:true
        });

        $('#dateFrom').val(moment(new Date(),"DD/MM/YYYY hh:mm").format("DD/MM/YYYY"));
        $('#dateTo').val(moment(new Date()).add(1, 'days').format("DD/MM/YYYY"));

        $('#search').on('click', function () {

            var validate = true;

            var value = {
                referenceNo : "",
                senderRefNo : "",
                benRefNo : "",
                currentPage: "1",
                pageSize: "20",
            };

            var searchByRefNo = ($('input[name="searchBy-rb"]:checked').val() == '1' ? true : false);

            if (searchByRefNo) {
                url_action = 'searchTransactionStatusByReferenceNo';
                value.referenceNo = $('#refNo').val();

            } else {

                $('.row-corporate').validator('validate');

                if ($('#corporate').val() == "") {
                    validate = false;
                    return;
                }

                value.corporateId = $('#corporate').val();

                if ($('#dateType').val() == '0') { // creation Date
                    value.creationDateFrom = $('#dateFrom').val();
                    value.creationDateTo = $('#dateTo').val();
                } else {
                    value.instructionDateFrom = $('#dateFrom').val();
                    value.instructionDateTo = $('#dateTo').val();
                }
                
                value.pendingTaskMenuCode = $('#menu').val();
                value.corpAccount = $('#corpAccount').val();
                value.status = $('#trxStatus').val();
                value.makerUserId = $('#createdBy').val();

                url_action = 'searchTransactionStatus';
                
            }

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
                                data: null,
                                render: function ( data, type, full, meta ) {
                                    return index++;
                                },
                                orderable: false,
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

        $('input[name="searchBy-rb"]').on('change', function(e){
            if (this.value=='1') {
                $('.row-date').hide();
                $('.row-corporate').hide();
                $('.row-createdby').hide();
                $('.row-menu').hide();
                $('.row-corpaccount').hide();
                $('.row-status').hide();
                $('#refNo').show();

                $('#form-area').validator('reset');

            } else {
                $('.row-date').show();
                $('.row-corporate').show();
                $('.row-createdby').show();
                $('.row-menu').show();
                $('.row-corpaccount').show();
                $('.row-status').show();
                $('#refNo').hide();
            }
        });

        $('#createdBy').prop("disabled",true);
        $('#menu').prop("disabled",true);
        $('#corpAccount').prop("disabled",true);
        $('#dateType').prop("disabled",true);
        $('#dateFrom').prop("disabled",true);
        $('#dateTo').prop("disabled",true);
        $('#trxStatus').prop("disabled",true);

        $('select[id="corporate"]').on('change', function(e) {         
            $('#createdBy').prop("disabled",false);
            $('#menu').prop("disabled",false);
            $('#corpAccount').prop("disabled",false);
             $('#dateType').prop("disabled",false);
            $('#dateFrom').prop("disabled",false);
            $('#dateTo').prop("disabled",false);
            $('#trxStatus').prop("disabled",false);
            getMenuDroplist(this.value);
            getCreatedByDroplist(this.value);
            getCorporateAccountDroplist(this.value);
            getStatusDroplist(this.value);
        
        });

    });

    function getCorporate() {
        var value = {
            code: "",
        };
        var url_action = 'searchCorporate';
        var action = 'SEARCH';
        var menu = service;
        // var menu = 'MNU_GPCASH_BO_RPT_TRX_STS'; 
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
                    unitOption = '<option value="">select corporate</option>';
                    $.each(result.result, function (idx, obj) {
                        unitOption += '<option value="' + obj.corporateId + '">' + obj.corporateName + '</option>';
                    });
                    $('#corporate').html(unitOption);
                    $('#corporate').select2();
                } else {
                    flash('warning', result.message);
                }


            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '{{trans('form.conn_error')}}';
                flash('warning', msg);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {

            }
        });
    }

    function getMenuDroplist(corpId) {

        var value = {
            corporateId: corpId
        };
        var url_action = 'searchCorporateMenu';
        var action = 'SEARCH';
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
                    unitOption = '<option value="">select menu</option>';
                    $.each(result.menus, function (idx, obj) {
                        unitOption += '<option value="' + obj.pendingTaskCode + '">' + obj.pendingTaskName + '</option>';
                    });
                    $('#menu').html(unitOption);
                    $('#menu').select2();
                } else {
                    flash('warning', result.message);
                }


            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '{{trans('form.conn_error')}}';
                flash('warning', msg);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {

            }
        });

    }

    function getCreatedByDroplist(corpId) {

        var url_action = 'searchUserMaker';
        var action = 'SEARCH';
        var menu = service;
        var value = {
            corporateId: corpId
        };
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
                    unitOption = '<option value="">select maker user ID</option>';
                    $.each(result.result, function (idx, obj) {
                        unitOption += '<option value="' + obj.makerUserId+ '">' + obj.makerUserName + '</option>';
                    });
                    $('#createdBy').html(unitOption);
                    $('#createdBy').select2();
                } else {
                    flash('warning', result.message);
                }


            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '{{trans('form.conn_error')}}';
                flash('warning', msg);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {

            }
        });
    }

    function getCorporateAccountDroplist(corpId) {

        var value = {
            corporateId: corpId
        };
        var url_action = 'searchSourceAccount';
        var action = 'SEARCH';
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
                    unitOption = '<option value="">select account</option>';
                    $.each(result.accounts, function (idx, obj) {
                        unitOption += '<option value="' + obj.accountGroupDtlId + '">' + obj.accountNo + ' / ' + obj.accountName + ' (' + obj.accountCurrencyName + ')' + '</option>';
                    });
                    $('#corpAccount').html(unitOption);
                    $('#corpAccount').select2();
                } else {
                    flash('warning', result.message);
                }


            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '{{trans('form.conn_error')}}';
                flash('warning', msg);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {

            }
        });

    }

    function getStatusDroplist(corpId) {

        var value = {
            corporateId: corpId
        };
        var url_action = 'getTransactionStatus';
        var action = 'SEARCH';
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
                if (result) {
                    unitOption = '<option value="">All Status</option>';
                    $.each(result, function (idx, obj) {
                        unitOption += '<option value="' + obj.key + '">' + obj.value + '</option>';
                    });
                    $('#trxStatus').html(unitOption);
                    $('#trxStatus').select2();
                } else {
                    flash('warning', result.message);
                }


            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '{{trans('form.conn_error')}}';
                flash('warning', msg);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {

            }
        });

    }

    function currencyFormat (num) {
        return parseFloat(num).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");  //<--- $1  is a special replacement pattern which holds a value of the first parenthesised submatch string 
    }



</script>