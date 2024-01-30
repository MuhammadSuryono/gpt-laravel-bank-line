@include('_partials.header_content',['breadcrumb'=>['Special Rate','Search']])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div class="box">
                <div id="spinner" style="display:none"></div>
                <div class="box-header">
                    <h3 class="box-title">Special Rate Filter</h3>
                </div>
                <form class="form-horizontal">

                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Special Rate Type</label>

                                <div class="col-md-6">
                                   <select class="form-control" id="rateType" name="rateType" onchange="showForeign()">
                                        <option value="LOCAL" > Local Special Rate</option>
                                        <option value="FOREIGN" > Foreign Special Rate</option>
                                   </select>
                                </div>
                            </div>
                        </div>
                         <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Reference No</label>

                                <div class="col-md-6">
                                    <input type="text" id="refNoSpecialRate" name="refNoSpecialRate" class="form-control" autocomplete="off" value="" maxlength="40">

                                </div>
                            </div>
                        </div>
                         <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Corporate</label>

                                <div class="col-md-6">
                                   <select class="form-control" id="corporate">
                                        <option></option>
                                   </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                               <label class="col-md-2 control-label">Date Range</label>
                               <div class="form-inline dateSelect">
                                    <div class="col-md-8" >
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
                        <div class="row local">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Foreign Currency</label>

                                <div class="col-md-6">
                                   <select class="form-control" id="foreignCurrencyCode">
                                        <option></option>
                                   </select>
                                </div>
                            </div>
                        </div>

                        <div class="row foreign">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Foreign Currency 1 </label>

                                <div class="col-md-6">
                                   <select class="form-control" id="foreignCurrencyCode1">
                                        <option></option>
                                   </select>
                                </div>
                            </div>
                        </div>

                        <div class="row foreign">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Foreign Currency 2</label>

                                <div class="col-md-6">
                                   <select class="form-control" id="foreignCurrencyCode2">
                                        <option></option>
                                   </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="box-footer">
                   
                    <div class="float-left">
                        <button type="button" id="search" name="search" class="btn btn-primary">@lang('form.search')</button>
                    </div>
                    <div class="float-right">
                        <button type="button" id="add" name="add" class="btn btn-info">@lang('form.add')</button>
                    </div>

                </div>
                </form>
                    <div class="box-header list-title">
                        <h3 class="box-title">Special Rate Listing</h3>
                    </div>
                    <div class="box-body list-title">
                        
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th align="center"><strong>Reference Number </strong></th>
                                        <th align="center"><strong>Corporate</strong></th>
                                        <th align="center"><strong>Foreign Currency</strong></th>
                                        <th align="center"><strong>Created Date</strong></th>
                                        <th align="center"><strong>Type</strong></th>
                                        <th align="center"><strong>Valid Until</strong></th>
                                        <th align="center"><strong>Transaction Amount</strong></th>
                                        <th align="center"><strong>Status Transaction</strong></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
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
                    <div class="box-header listForeign-title">
                        <h3 class="box-title">Special Rate Listing</h3>
                    </div>
                    <div class="box-body listForeign-title">
                        <table id="listForeign" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th align="center"><strong>Reference Number </strong></th>
                                        <th align="center"><strong>Corporate</strong></th>
                                        <th align="center"><strong>Foreign Currency 1</strong></th>
                                        <th align="center"><strong>Foreign Currency 2</strong></th>
                                        <th align="center"><strong>Created Date</strong></th>
                                        <th align="center"><strong>Type</strong></th>
                                        <th align="center"><strong>Valid Until</strong></th>
                                        <th align="center"><strong>Transaction Amount</strong></th>
                                        <th align="center"><strong>Status Transaction</strong></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td align="left"></td>
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


    $(document).ready(function () {
        var id = '{{ $service }}';

        var url_action = 'search';
        var action = 'SEARCH';
        var result_key = 'result';
        var custom_order = {"expiryDate": "ASC"};

        $('#list').hide();
        $('.list-title').hide();
        $('#listForeign').hide();
        $('.listForeign-title').hide();

        getCurrency();
        getCorporate()
        showForeign();

         $('.datepicker').datepicker({
            format: "dd/mm/yyyy",
            locale: 'id',
            autoclose:true
        });

        $('#dateFrom').val(moment(new Date(),"DD/MM/YYYY hh:mm").format("DD/MM/YYYY"));
        $('#dateTo').val(moment(new Date()).add(1, 'days').format("DD/MM/YYYY"));


        $('#search').on('click', function () {

            $(this).prop("disabled",true);
            var foreignCurrencyCode1 =  $('#foreignCurrencyCode1').val();
            if($('#rateType').val() == 'LOCAL'){
                foreignCurrencyCode1 = $('#foreignCurrencyCode').val();
            }

            var value = {
                foreignCurrency1: foreignCurrencyCode1,
                foreignCurrency2: $('#foreignCurrencyCode2').val(),
                rateType: $('#rateType').val(),
                refNoSpecialRate: "%" + $('#refNoSpecialRate').val() + "%",
                corporateId: $('#corporate').val(),
                currentPage: "1",
                pageSize: "50",
                // orderBy: {"currency.effectiveDate": "DESC"}
            };


            if($('#rateType').val() == 'LOCAL'){
                $('#list').show();
                $('#listForeign').hide();

                $('.list-title').show();
                $('.listForeign-title').hide();

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
                        data: "refNoSpecialRate",
                        render: function ( data, type, full, meta ) {
                            return '<a href="javascript:void(0)" data-code="'+data+'">'+data+'</a>';
                        },
                        orderable: true
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
                        data: "foreignCurrency1",
                        orderable: true
                    },
                    {
                        targets: 3,
                        data: "createdDate",
                        orderable: true
                    },
                    {
                        targets: 4,
                        data: "type",
                        orderable: true
                    },
                    {
                        targets: 5,
                        data: "expiryDate",
                        orderable: true
                    },
                    {
                        targets: 6,
                        data: "transactionAmountRate",
                        orderable: true
                    },
                    {
                        targets: 7,
                        data: "status",
                        orderable: true
                    },

                ],
                "ajax": {
                    url: "fetchDataTable",
                    type:'POST',
                    data: function ( d ) {
                        d.value = value;
                        d.menu = id;
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
            }else{
                $('#list').hide();
                $('#listForeign').show();
                $('.list-title').hide();
                $('.listForeign-title').show();

                $('#listForeign').DataTable({
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
                        data: "refNoSpecialRate",
                        render: function ( data, type, full, meta ) {
                            return '<a href="javascript:void(0)" data-code="'+data+'">'+data+'</a>';
                        },
                        orderable: true
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
                        data: "foreignCurrency1",
                        orderable: true
                    },
                    {
                        targets: 3,
                        data: "foreignCurrency2",
                        orderable: true
                    },
                    {
                        targets: 4,
                        data: "createdDate",
                        orderable: true
                    },
                    {
                        targets: 5,
                        data: "type",
                        orderable: true
                    },
                    {
                        targets: 6,
                        data: "expiryDate",
                        orderable: true
                    },
                    {
                        targets: 7,
                        data: "transactionAmountRate",
                        orderable: true
                    },
                    {
                        targets: 8,
                        data: "status",
                        orderable: true
                    },

                ],
                "ajax": {
                    url: "fetchDataTable",
                    type:'POST',
                    data: function ( d ) {
                        d.value = value;
                        d.menu = id;
                        d.url_action = url_action;
                        d.action = action;
                        d.result_key = result_key;
                        d.custom_order = custom_order;
                        d._token = '{{ csrf_token() }}';
                    },
                    error:function (jqXHR, textStatus, errorThrown) {

                        var msg = '{{trans('form.conn_error')}}';
                        flash('warning', msg);
                        $('#listForeign').hide();
                        $('.listForeign-title').hide();
                        $('#search').prop("disabled",false);
                    }
                }
                });
            }
            

        });


        $('#add').on('click', function () {

            var rateType = $('#rateType').val();

            var res = app.setView(id,'add');
            if(res=='done'){
                $('#type').val('add');
                 $('#rateType').val(rateType);

                if (rateType=='FOREIGN') {
                    $('.foreign').show();
                      $('.local').hide();
                } else {
                    $('.foreign').hide();
                    $('.local').show(); 
                }

            }
        });

        $('#list tbody').on('click', 'a', function (e) {
            if(e.handled !== true) // This will prevent event triggering more then once
            {
                e.handled = true;
            }
            var code = $(this).data('code');

            if (code !== undefined) {
                var res = app.setView(id,'detail');
                if(res=='done'){
                    $('#refNoSpecialRate').val(code);

                        $('.foreign').hide();
                        $('.local').show(); 
                    
                    getMatrix();
                }
            }
        });

        $('#listForeign tbody').on('click', 'a', function (e) {
            if(e.handled !== true) // This will prevent event triggering more then once
            {
                e.handled = true;
            }
            var code = $(this).data('code');

            if (code !== undefined) {
                var res = app.setView(id,'detail');
                if(res=='done'){
                    $('#refNoSpecialRate').val(code);
                          $('.foreign').show();
                          $('.local').hide();
                    
                    getMatrix();
                }
            }
        });

    });

    function showForeign(){

        if ($('#rateType').val()=='FOREIGN') {
                $('.foreign').show();
                  $('.local').hide();
            } else {
                $('.foreign').hide();
                $('.local').show(); 
            }
    }

    function getCorporate() {
        var value = {
            code: "",
        };
        var url_action = 'searchCorporate';
        var action = 'SEARCH';
        //var menu = service;
        var menu = 'MNU_GPCASH_BO_RPT_TRX_STS'; 
        
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

                    unitOption = '<option value=""></option>';
                    $.each(result.result, function (idx, obj) {
                        unitOption += '<option value="' + obj.corporateId + '">'+ obj.corporateId  + ' - ' + obj.corporateName + '</option>';
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
    function getCurrency() {
        var value = {
            code: "",
            name: "",
            modelCode: "COM_MT_CURRENCY"
        };
        var url_action = 'searchModelForDroplist';
        var action = 'SEARCH';
        var menu = 'MNU_GPCASH_MT_PARAMETER';
        
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
                    unitOption = '<option value=""></option>';
                    $.each(result.result, function (idx, obj) {
                        unitOption += '<option value="' + obj.code + '">'+ obj.code + ' - ' + obj.name + '</option>';
                    });
                    $('#foreignCurrencyCode').html(unitOption);
                    $('#foreignCurrencyCode').select2();

                     $('#foreignCurrencyCode1').html(unitOption);
                    $('#foreignCurrencyCode1').select2();

                     $('#foreignCurrencyCode2').html(unitOption);
                    $('#foreignCurrencyCode2').select2();
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




</script>