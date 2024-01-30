@include('_partials.header_content',['breadcrumb'=>['Limit setup','add']])

<section class="content">
    <div  class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div id="print" class="box">
                <div id="spinner" style="display:none"></div>
                <div class="box-header state_view">
                    <span id="preview" class="state_view" style="color:darkred;display:none;"><small><i>Preview</i></small></span>
                </div>
                <div class="box-header">
                     <h3 class="box-title">Limit Setup Editor</h3>
                </div>
                <form class="form-horizontal">
                <input type="hidden" id="code_edit" value=""/>
                <input type="hidden" id="type" value=""/>
                <input type="hidden" id="state" value=""/>
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Limit Setup Code</label>
                                <div class="col-md-6">
                                    <input type="text" id="code" name="code" class="form-control state_edit" autocomplete="off" value="">
                                    <span id="code_view" class="col-md-2 state_view">-</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Limit Setup Name</label>

                                <div class="col-md-6">
                                    <input type="text" id="name" name="name" class="form-control state_edit" autocomplete="off" value="">
                                    <span id="name_view" class="col-md-2 state_view">-</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                </form>
                    <div class="box-header">
                        <h3 class="box-title table-hidden">Limit Setup Listing</h3>
                    </div>
                    <div class="container-fluid">
                        <div class="box-body">
                           <div class="row table-hidden">
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th rowspan="2"></th>
                                        <th align="center" rowspan="2"><strong>Service</strong></th>
                                        <th align="center" rowspan="2"><strong>Currency matrix</strong></th>
                                        <th align="center" rowspan="2"><strong>Max. No. Of Transaction / Day</strong></th>
                                        <th align="center" colspan="2"><strong>Maximum Transaction Amount / Day</strong></th>

                                    </tr>
                                    <tr>
                                        <th align="center"><strong>Currency</strong></th>
                                        <th align="center"><strong>Value</strong></th>
                                    </tr>
                                    </thead>
                                </table>
                           </div>
                            <br>
                            <div class="row table-hidden">

                                           <div class="col-md-12 state_edit text-center">
                                               <button type="button" id="confirm" name="confirm" class="btn btn-default">@lang('form.confirm')</button>
                                               <button type="button" id="back" name="back" class="btn btn-default back">@lang('form.back')</button>
                                           </div>
                                            <div class="col-md-12 state_view text-center">
                                                <button type="button" id="submit_view" name="submit_view" class="btn btn-danger">@lang('form.submit')</button>
                                                <button type="button" id="save_screen" name="save_screen" class="btn btn-default" style="display:none">Save Screen</button>
                                                <button type="button" id="back_view" name="back_view" class="btn btn-default">@lang('form.back')</button>
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
    var currencyOption;
    var id = 'MNU_GPCASH_PRO_LMT_PC';
    $(document).ready(function () {
        $('.table-hidden').hide();

        var submit_data;
        getCurrency("IDR");

        oTable = $('#list').DataTable({
            "paging": false,
            "ordering": false,
            "info": false,
            "destroy": true,
            "select": {
                style: 'multi',
                selector: 'input.dt-checkboxes'
            },
            "searching": false,
            "autoWidth": false,
            "ScrollX": '100%',
            "lengthMenu": [[10, 25, 50], [10, 25, 50]],
            "columnDefs": [
                {
                    sortable: false,
                    width: "5%",
                    targets: 0,
                    checkboxes: {
                        selectRow: true,
                        selectAllPages: false
                    }
                },
                {
                    targets: 1,
                    sortable: false,
                    width: "25%"
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
                {
                    targets: 4,
                    sortable: false,
                    width: "10%"
                },
                {
                    targets: 5,
                    sortable: false,
                    width: "20%"
                }

            ]
        });

        stateEdit();

        $('#submit_view').on('click', function () {
            $(this).prop('disabled',true);
            var content ='';
            if ($('#type').val() == 'add'){
                content='{{trans('form.confirm_add')}}';
            }else{
                content='{{trans('form.confirm_edit')}}';
            }

            $.confirm({
                title: '{{trans('form.submit')}}',
                content: content,
                buttons: {
                    confirm: {
                        text: '{{trans('form.confirm')}}',
                        btnClass: 'btn-danger',
                        action: function(){
                            submitData();
                        }
                    },
                    cancel: {
                        text: '{{trans('form.cancel')}}',
                        btnClass: 'btn-default',
                        action: function(){
                            $('#submit_view').prop('disabled',false);
                        }
                    }

                }
            });

        });

        function submitData(){
            var value = {
                "code": $('#code').val(),
                "name": $('#name').val(),
                "transactionLimitList": submit_data
            };
            if ($('#type').val() == 'add'){
                $.ajax({
                    url: 'add',
                    method: 'post',
                    data: {"_token": "{{ csrf_token() }}", menu: id, value: value},
                    success: function (data) {
                        $('#submit_view').prop('disabled',false);
                        result = JSON.parse(data);
                        if (result.hasOwnProperty("referenceNo")) {
                            flash('success', 'ReferenceNo: ' + result.referenceNo);
                            $('#submit_view').hide();
                            $('#preview').text('ReferenceNo: ' + result.referenceNo);
                            stateSuccess();
                        } else {
                            $('#submit_view').prop('disabled',false);
                            flash('warning', 'Form Submit Failed');
                        }

                    }, error: function (xhr, ajaxOptions, thrownError) {
                        $('#submit_view').prop('disabled',false);
                        flash('warning', 'Form Submit Failed');
                        console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                    }
                });
            }else{
                $.ajax({
                    url: 'edit',
                    method: 'post',
                    data: {"_token": "{{ csrf_token() }}", menu: id, value: value},
                    success: function (data) {
                        $('#submit_view').prop('disabled',false);
                        var result = JSON.parse(data);
                        if (result.hasOwnProperty("referenceNo")) {
                            flash('success', result.message);
                            $('#submit_view').hide();
                            $('#preview').text('ReferenceNo: ' + result.referenceNo);
                            stateSuccess();
                        } else {
                            $('#submit_view').prop('disabled',false);
                            flash('warning', 'Form Submit Failed');
                        }

                    }, error: function (xhr, ajaxOptions, thrownError) {
                        $('#submit_view').prop('disabled',false);
                        flash('warning', 'Form Submit Failed');
                        console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                    }
                });
            }
        }


        $('#confirm').on('click', function () {
            submit_data = getTableData();
            stateView();
        });

        $('#back_view').on('click', function () {
            $(this).prop('disabled',true);
            if($('#state').val() == 'success'){
                $.ajax({
                    url: 'getView/MNU_GPCASH_PRO_LMT_PC',
                    method: 'post',
                    success: function (data) {
                        $('#back_view').prop('disabled',false);
                        $(window).scrollTop(0);
                        $('#content-ajax').html(data);


                    }, error: function (xhr, ajaxOptions, thrownError) {
                        $('#back_view').prop('disabled',false);
                        console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                    }
                });
                return;
            }else{
            $('#back_view').prop('disabled',false);
            stateEdit();
            }
        });

       $('#save_pdf').on('click', function () {
           html2canvas($('#print'), {
               onrendered: function(canvas) {
                   var img = canvas.toDataURL();
                   window.open(img);
               }
           });

        });

        $('.back').on('click', function () {
            $(this).prop('disabled',true);
            if ($('#type').val() == 'add') {
                $.ajax({
                    url: 'getView/' + id,
                    method: 'post',
                    success: function (data) {
                        $('.back').prop('disabled',false);
                        $(window).scrollTop(0);
                        $('#content-ajax').html(data);


                    }, error: function (xhr, ajaxOptions, thrownError) {
                        $('.back').prop('disabled',false);
                        console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                    }
                });
            } else {
                $.ajax({
                    url: 'getDetail/' + id,
                    method: 'post',
                    success: function (data) {
                        $('.back').prop('disabled',false);
                        $(window).scrollTop(0);
                        var code = $('#code_edit').val();
                        $('#content-ajax').html(data);
                        $('#code').val(code);
                        getMatrix();

                    }, error: function (xhr, ajaxOptions, thrownError) {
                        $('.back').prop('disabled',false);
                        console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                    }
                });
            }
        });
    });
        function getMatrixAdd() {
            var url_action = 'searchServiceCurrencyMatrixTRX';
            var action = 'SEARCH';
            var menu = id;
            $.ajax({
                url: 'getAPIData',
                method: 'post',
                async: false,
                data: {menu:menu,url_action:url_action,action:action},
                success: function (data) {

                    var result = JSON.parse(data);
                    $.each(result, function (i) {
                        var lastServiceName = '';
                        $.each(result[i], function (idx, obj) {
                            var serviceName = '';

                            if(lastServiceName!==obj.serviceName){
                                serviceName = obj.serviceName;
                            }
                            oTable.row.add([
                                '<input id="check" name="check" class="dt-checkboxes state_edit" value="" type="checkbox">',
                                '<span id="service_name">'+obj.serviceName +'</span>'+'<input id="service_code" name="service_code" class="form-control state_edit" value="' + obj.serviceCode + '" type="hidden">',
                                '<span id="currency_matrix_name">'+obj.currencyMatrixName +'</span>'+'<input id="matrix_id" name="matrix_id" class="form-control state_edit" value="' + obj.serviceCurrencyMatrixId + '" type="hidden">',
                                '<input id="num_trans" name="num_trans" class="form-control state_edit num_trans" value="" type="text" style="width:100%;"><span id="num_trans_view" class="state_view">-</span>',
                                currencyOption + '<span id="currCode_view" class="state_view">-</span>',
                                '<input id="max_trans" name="max_trans" class="form-control state_edit max_trans" value="" type="text" style="width:100%;"><span id="max_trans_view" class="state_view">-</span>'
                            ]).draw(false);
                            $('#service_code[value="'+obj.serviceCode+'"]').parent().prev().children().attr('name',obj.serviceCode);
                            if(lastServiceName==obj.serviceName){
                                $('#service_charge_id[value="'+obj.serviceChargeId+'"]').parent().prev().prev().children().css('opacity','0')
                            }
                            lastServiceName = obj.serviceName;
                        });
                    });
                    $('.num_trans').autoNumeric('init', {decimalPlacesOverride: '0',minimumValue:'0',maximumValue:'999999999'});
                    $('.max_trans').autoNumeric('init',{
                        digitGroupSeparator        : '.',
                        decimalCharacter           : ',',
                        decimalCharacterAlternative: '.'
                    });
                    stateEdit();

                }, error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                },
                complete: function (data) {
                    $('.table-hidden').show();
                    $('input[type="checkbox"]').change( function(){
                        if ($(this).is(':checked')) {
                            $('input[name="'+this.name+'"]').not(this).prop('checked',true)
                        }else{
                            $('input[name="'+this.name+'"]').not(this).prop('checked',false)
                        }
                    });
                }
            });
        }

        function getMatrixEdit() {
            getMatrixAdd();
            var code_id= $('#code').val();
            var value = {
                code: code_id,
                name: "",
                currentPage: "1",
                pageSize: "20",
                orderBy: {"code": "ASC"}
            };
            var url_action = 'search';
            var action = 'DETAIL';
            var menu = id;
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
                    var data = JSON.parse(data);
                    var detail = data.result[0].transactionLimitList;

                    $('#code').val(data.result[0].code);
                    $('#code').attr('readonly', true);
                    $('#name').val(data.result[0].name);
                    //oTable.clear();
                    $.each(detail, function (idx, obj) {
                        $('input[name="'+obj.serviceCode+'"]').prop('checked',true);
                        $('#list tr').eq(idx+2).find('td').eq(3).find('#num_trans').val(obj.maxTrxPerDay);
                        $('#list tr').eq(idx+2).find('td').eq(4).find('#currCode').val(obj.currencyCode);
                        $('#list tr').eq(idx+2).find('td').eq(5).find('#max_trans').val(obj.maxTrxAmountPerDay);
                    });
                    $('.num_trans').autoNumeric('update', {decimalPlacesOverride: '0',minimumValue:'0',maximumValue:'999999999'});
                    $('.max_trans').autoNumeric('update',{
                        digitGroupSeparator        : '.',
                        decimalCharacter           : ',',
                        decimalCharacterAlternative: '.'
                    });
                    stateEdit();

                }, error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                },
                complete: function (data) {
                    $('.table-hidden').show();

                }
            });
        }

        function getCurrency(kode) {
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
                    currencyOption = '<select id="currCode" class="form-control state_edit">';
                    $.each(result.result, function (idx, obj) {
                        if (obj.code == kode) {
                            currencyOption += '<option value="' + obj.code + '" selected="selected">' + obj.code + '</option>';
                        } else {
                            currencyOption += '<option value="' + obj.code + '">' + obj.code + '</option>';
                        }
                    });
                    currencyOption += '</select>';


                }, error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                }, complete: function (data) {
                    if ($('#type').val() == 'edit') {
                        getMatrixEdit();
                    } else {
                        getMatrixAdd();
                    }
                }
            });
        }

        function getTableData() {
            var data = [];

            $("#list").find("tbody tr").each(function () {
                var check = ($('td:eq(0)', $(this)).children().is(':checked') ? 1 : 0);
                if (check == 0) {
                    $('td:eq(0)', $(this)).parent().hide();
                }
                var service_code = $('td:eq(1)', $(this)).find('#service_code').val();
                var service_name = $('td:eq(1)', $(this)).find('#service_name').text();
                var matrix_id = $('td:eq(2)', $(this)).find('#matrix_id').val();
                var currency_matrix_name = $('td:eq(2)', $(this)).find('#currency_matrix_name').text();
                var num_trans = $('td:eq(3)', $(this)).find('#num_trans').autoNumeric('get');
                $('td:eq(3)', $(this)).find('#num_trans_view').text($('td:eq(3)', $(this)).find('#num_trans').val());
                var curr_code = $('td:eq(4)', $(this)).find('#currCode').val();
                $('td:eq(4)', $(this)).find('#currCode_view').text(curr_code);
                var max_trans = $('td:eq(5)', $(this)).find('#max_trans').autoNumeric('get');
                $('td:eq(5)', $(this)).find('#max_trans_view').text($('td:eq(5)', $(this)).find('#max_trans').val());

                var obj = {
                    serviceCode: service_code,
                    serviceName: service_name,
                    currencyMatrixName: currency_matrix_name,
                    serviceCurrencyMatrixId: matrix_id,
                    maxTrxPerDay: num_trans,
                    currencyCode: curr_code,
                    maxTrxAmountPerDay: max_trans
                };
                if (check == 1) {
                    data.push(obj);
                }
            });
            return data;
        }

        function stateEdit() {
            oTable.column(0).visible(true);

            $('#state').val('edit');
            $('.state_view').hide();
            $('.state_edit').show();
            $('span.state_view').text('-');
            $("#list").find("tbody tr").each(function () {

                $('td:eq(0)', $(this)).parent().show();

            });
        }

        function stateView() {
            $('#state').val('view');
            oTable.column(0).visible(false);
            var code = ($('#code').val() == '' ? '-' : $('#code').val());
            var name = ($('#name').val() == '' ? '-' : $('#name').val());

            $('#preview').text('Preview');
            $('.state_edit').hide();
            $('.state_view').show();
            $('#code_view').text(code);
            $('#name_view').text(name);


        }

        function stateSuccess() {
            $('#state').val('success');
            $('#code_1').val('');
            $('#name').val('');
            $('input.state_edit').val('');
            $('input.check').attr('checked', '');
            $('#back_view').html('{{trans('form.done')}}');
            $('save_screen').show();
        }


</script>