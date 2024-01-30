@include('_partials.header_content',['breadcrumb'=>['Bank Global Limit','edit']])

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <input type="hidden" id="state" value=""/>
            <div id="print" class="box">
                <div id="spinner" style="display:none"></div>
                <div class="box-header state_view">
                    <span id="preview" class="state_view" style="color:darkred;display:none;"><small><i>Preview</i></small></span>
                </div>
                <div class="box-header">
                    <h3 class="box-title">Bank Global Limit Listing</h3><br>
                </div>

                      <div class="container-fluid">
                        <div class="box-body">
                           <div class="row table-hidden">
                               <div class="form-group">
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th rowspan="2"></th>
                                        <th align="center" rowspan="2"><strong>Service</strong></th>
                                        <th align="center" rowspan="2"><strong>Currency matrix</strong></th>
                                        <th align="center" rowspan="2"><strong>Currency</strong></th>
                                        <th align="center"><strong>Minimum</strong></th>
                                        <th align="center"><strong>Maximum</strong></th>
                                    </tr>
                                    <tr>
                                        <th align="center"><strong>Trx Limit</strong></th>
                                        <th align="center"><strong>Trx Limit</strong></th>
                                    </tr>
                                    </thead>
                                    <tbody><tr>
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
                               <form class="form-horizontal">
                               <div class="form-group">
                                   <div class="col-md-12 text-center">
                                       <button type="button" id="confirm" name="confirm" class="btn btn-default state_edit">@lang('form.confirm')</button>
                                       <button type="button" id="back" name="back" class="btn btn-default back state_edit">@lang('form.back')</button>
                                       <button type="button" id="submit_view" name="submit_view" class="btn btn-danger state_view" style="display:none">@lang('form.submit')</button>
                                       <button type="button" id="save_screen" name="save_screen" class="btn btn-default" style="display:none">Save Screen</button>
                                       <button type="button" id="back_view" name="back_view" class="btn btn-default state_view" style="display:none">@lang('form.back')</button>
                                       <button type="button" id="back_success" name="back_success" class="btn btn-default" style="display:none">@lang('form.done')</button>
                                   </div>
                               </div>
                               </form>

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
    var submit_data;
    var id = 'MNU_GPCASH_BANK_TRX_LMT';
    $(document).ready(function () {
        getCurrency("IDR");

        oTable = $('#list').DataTable({
            "paging" : false,
            "ordering" : false,
            "info": false,
            "destroy": true,
            "select": {
                style: 'multi',
                selector: 'input.dt-checkboxes'
            },
            "searching": false,
            "autoWidth":false,
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
                    width: "10%"
                },
                {
                    targets: 4,
                    sortable: false,
                    width: "20%"

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

            var content='{{trans('form.confirm_edit')}}';


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

        $('#confirm').on('click', function () {
            submit_data = getTableData();
            stateView();
        });

        $('#save_screen').on('click', function () {
            html2canvas($('#print'), {
                onrendered: function(canvas) {
                    var img = canvas.toDataURL();
                    window.open(img);
                }
            });

        });

        $('#back_view').on('click', function () {
            stateEdit();
        });

        $('#back_success').on('click', function () {
            $(this).prop('disabled',true);
            if($('#state').val() == 'success'){
                $.ajax({
                    url: 'getView/'+id,
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
                $('#back_success').prop('disabled',false);
                stateEdit();
            }
        });

        $('.back').on('click', function () {
            $(this).prop('disabled',true);
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

        });

    });

    function getMatrix(){
        var value = {};
        var url_action = 'search';
        var action = 'SEARCH';
        var result_key='result';
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data: {
                value : value,
                menu : id,
                url_action : url_action,
                action : action,
                result_key : result_key,
                _token : '{{ csrf_token() }}'
            },
            success: function (data) {

                var result = JSON.parse(data);

                var detail = result.result;
                oTable.clear();
                $.each(detail, function (idx, obj){
                    oTable.row.add([
                        '<input id="check" name="check" class="dt-checkboxes state_edit" value="" type="checkbox">',
                        '<span id="service_name">'+obj.serviceName +'</span>'+'<input id="service_code" name="service_code" class="form-control state_edit" value="' + obj.serviceCode + '" type="hidden"><input id="service_id" name="service_id" class="form-control state_edit" value="' + obj.id + '" type="hidden">',
                        '<span id="currency_matrix_name">'+obj.currencyMatrixName +'</span>'+'<input id="matrix_id" name="matrix_id" class="form-control state_edit" value="' + obj.serviceCurrencyMatrixId + '" type="hidden">',
                        currencyOption + '<span id="currCode_view" class="state_view">'+obj.currencyCode+'</span>',
                        '<input id="min_limit" name="min_limit" class="form-control state_edit min_limit" value="'+obj.minAmountLimit+'" type="text" style="width:100%;display:hidden"><span id="min_limit_view" class="state_view">'+obj.minAmountLimit+'</span>',
                        '<input id="max_limit" name="max_limit" class="form-control state_edit max_limit" value="'+obj.maxAmountLimit+'" type="text" style="width:100%;display:hidden"><span id="max_limit_view" class="state_view">'+obj.maxAmountLimit+'</span>'
                    ]).draw(false);

                });
                $.each(detail, function (idx, obj) {
                    $('#list tr').eq(idx+2).find('td').eq(0).find('.dt-checkboxes').click();
                    $('#list tr').eq(idx+2).find('td').eq(3).find('#currCode').val(obj.currencyCode);
                });
                $('.min_limit').autoNumeric('init',{
                    digitGroupSeparator        : '.',
                    decimalCharacter           : ',',
                    decimalCharacterAlternative: '.'
                });
                $('.max_limit').autoNumeric('init',{
                    digitGroupSeparator        : '.',
                    decimalCharacter           : ',',
                    decimalCharacterAlternative: '.'
                });
                stateEdit();

            }, error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            },
            complete: function(data) {

            }
        });
    }

    function getCurrency(){
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
                    if(obj.code=="IDR") {
                        currencyOption += '<option value="' + obj.code + '" selected="selected">' + obj.code + '</option>';
                    }else{
                        currencyOption += '<option value="' + obj.code + '">' + obj.code + '</option>';
                    }
                });
                currencyOption += '</select>';


            }, error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            },complete: function(data) {
                getMatrix();
            }
        });
    }

    function submitData(){
        var value = {
           "bankTransactionLimitList": submit_data
        };

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

    function getTableData(){
        var data = [];

        $("#list").find("tbody tr").each(function(){
            var check = ($('td:eq(0)', $(this)).children().is(':checked') ? 1 : 0);
            if (check == 0) {
                $('td:eq(0)', $(this)).parent().hide();
            }
            var service_code = $('td:eq(1)', $(this)).find('#service_code').val();
            var service_name = $('td:eq(1)', $(this)).find('#service_name').text();
            var service_id = $('td:eq(1)', $(this)).find('#service_id').val();
            var matrix_id = $('td:eq(2)', $(this)).find('#matrix_id').val();
            var currency_matrix_name = $('td:eq(2)', $(this)).find('#currency_matrix_name').text();
            var curr_code = $('td:eq(3)', $(this)).find('#currCode').val();
            $('td:eq(3)', $(this)).find('#currCode_view').text(curr_code);
            var min_limit = $('td:eq(4)', $(this)).find('#min_limit').autoNumeric('get');
            $('td:eq(4)', $(this)).find('#min_limit_view').text($('td:eq(4)', $(this)).find('#min_limit').val());
            var max_limit = $('td:eq(5)', $(this)).find('#max_limit').autoNumeric('get');
            $('td:eq(5)', $(this)).find('#max_limit_view').text($('td:eq(5)', $(this)).find('#max_limit').val());

            var obj = {
                id: service_id,
                serviceCode: service_code,
                serviceName: service_name,
                currencyMatrixName: currency_matrix_name,
                serviceCurrencyMatrixId: matrix_id,
                currencyCode: curr_code,
                minAmountLimit: min_limit,
                maxAmountLimit: max_limit
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

        $('#preview').text('Preview');
        $('.state_edit').hide();
        $('.state_view').show();

    }

    function stateSuccess() {
        $('#state').val('success');
        $('input.state_edit').val('');
        $('input.check').attr('checked', '');
        $('#save_screen').show();
        $('#back_view').hide();
        $('#back_success').show();

    }

</script>