@include('_partials.header_content',['breadcrumb'=>[str_replace('-',' ',$menu),$type]])

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <input type="hidden" id="state" value=""/>
            <input type="hidden" id="selected-table" data-id="" value=""/>
            <input type="hidden" id="type"/>
            <input type="hidden" id="stateType" value=""/>
            <div class="box">
                <div id="spinner" style="display:none"></div>
                <div class="box-header">
                    <h3 class="box-title editState">Bank Forex Limit Listing</h3><br>
                    <h3 class="box-title addState">Bank Forex Limit Detail</h3><br>
                </div>

                <form id="form-area" class="form-horizontal form-area">
                    <div class="box-body">
                        <div class="container-fluid">
                            <div class="form-group editState">
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th align="center"><strong>Foreign Currency</strong></th>
                                        <th align="right"><strong>Minimum Buy Limit in IDR</strong></th>
                                        <th align="right"><strong>Maximum Buy Limit in IDR</strong></th>
                                        <th align="right"><strong>Minimum Sell Limit in IDR</strong></th>
                                        <th align="right"><strong>Maximum Sell Limit in IDR</strong></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="form-group addState">
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label currlbl"><strong>Foreign Currency&ast;</strong></label>
                                        <div class="col-md-4">
                                            <div class="currency_setup state_edit"><select class="form-control"></select></div>
                                            <label id="currency_setup_view" class="state_view"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label lblMinBuy"><strong>Minimum Buy Limit in IDR&ast;</strong></label>
                                        <div class="col-md-4">
                                            <input type="text" id="minBuyLimit" name="minBuyLimit" class="form-control state_edit numeric rate" autocomplete="off" value="" style="width:100%;text-align: right;" data-error="This field is required." required>
                                            <div class="help-block with-errors"></div>
                                            <label id="minBuy_view" class="state_view"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label lblMaxBuy"><strong>Maximum Buy Limit in IDR&ast;</strong></label>
                                        <div class="col-md-4">
                                            <input type="text" id="maxBuyLimit" name="maxBuyLimit" class="form-control state_edit numeric rate" autocomplete="off" value="" style="width:100%;text-align: right;" data-error="This field is required." required>
                                            <div class="help-block with-errors"></div>
                                            <label id="maxBuy_view" class="state_view"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label lblMinSell"><strong>Minimum Sell Limit in IDR&ast;</strong></label>
                                        <div class="col-md-4">
                                            <input type="text" id="minSellLimit" name="minSellLimit" class="form-control state_edit numeric rate" autocomplete="off" value="" style="width:100%;text-align: right;" data-error="This field is required." required>
                                            <div class="help-block with-errors"></div>
                                            <label id="minSell_view" class="state_view"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label lblMaxSell"><strong>Maximum Sell Limit in IDR&ast;</strong></label>
                                        <div class="col-md-4">
                                            <input type="text" id="maxSellLimit" name="maxSellLimit" class="form-control state_edit numeric rate" autocomplete="off" value="" style="width:100%;text-align: right;" data-error="This field is required." required>
                                            <div class="help-block with-errors"></div>
                                            <label id="maxSell_view" class="state_view"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        

                        </div>
                        <div class="box-footer">
                            <div class="col-md-12 state_edit text-center">
                                <button type="button" id="back" name="back" class="btn btn-default back float-left">@lang('form.cancel')</button>
                                <button type="button" id="confirm" name="confirm" class="btn btn-primary float-right ">@lang('form.confirm')</button>
                            </div>
                            <div class="col-md-12 state_view text-center" data-html2canvas-ignore="true">
                                <div class="float-left">
                                    <button type="button" id="back" name="back" class="btn btn-default back float-left">@lang('form.cancel')</button>
                                    <button type="button" id="back_view" name="back_view" class="btn btn-default">@lang('form.cancel')</button>
                                    <button type="button" id="save_screen" name="save_screen" class="btn btn-default" style="display:none" onclick="save_pdf();">@lang('form.save_pdf')</button>
                                </div>
                                <div class="float-right" style="display:inline;">
                                    <button type="button" id="next_user" name="next_user" class="btn btn-info">@lang('form.next_user')</button>
                                    <button type="button" id="done" name="done" class="btn btn-primary" style="display:none">@lang('form.done')</button>
                                    <button type="button" id="submit_view" name="submit_view" class="btn btn-primary">@lang('form.submit')</button>
                                </div>
                            </div>
                        </div>
                          @include('_partials.next_user')
                          
                        </div>
                    </form>
            </div>
        </div>
    </div>

</section>

<script>
    var oTable;
    var currencyOption;
    var submit_data;
    var id = '{{ $service }}';
    var noRef;
    var currState;
    $(document).ready(function () {
        getCurrency();

        oTable = $('#list').DataTable({
            "paging" : false,
            "ordering" : false,
            "info": false,
            "destroy": true,

            "searching": false,
            "autoWidth":false,
            "columnDefs": [

               {
                    targets: 0,
                    sortable: false,
                    width: "20%"
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
                {
                    targets: 4,
                    sortable: false,
                    width: "20%"
                }

            ]
        });

        $('.numeric').autoNumeric('init',{
                        emptyInputBehavior: 'zero',
                        digitGroupSeparator        : ',',
                        decimalCharacter           : '.',
                        decimalCharacterAlternative: '.',
                        allowDecimalPadding : false,
                        minimumValue:'0.00',maximumValue:'999999999999999.99'
        });

        $('#submit_view').on('click', function () {
            $(this).prop('disabled',true);
            var content = '';
            
            if (currState == 'ADD') {
                content = '{{trans('form.confirm_add')}}';
            } else if (currState == 'DELETE'){
                content='{{trans('form.confirm_delete')}}';
                submit_data = getTableData();
            } else {
                content='{{trans('form.confirm_edit')}}';
            }


            $.confirm({
                title: '{{trans('form.submit')}}',
                content: content,
                buttons: {
                    
                    cancel: {
                        text: '{{trans('form.cancel')}}',
                        btnClass: 'btn-default',
                        action: function(){
                            $('#submit_view').prop('disabled',false);
                        }
                    },
                    confirm: {
                        text: '{{trans('form.confirm')}}',
                        btnClass: 'btn-primary',
                        action: function(){
                            submitData();
                        }
                    }

                }
            });

        });

        $('#confirm').on('click', function () {

            if(currState == 'ADD') {
                $('#form-area').validator('validate');
                    setTimeout(function(){
                        if($('#form-area').validator('validate').has('.has-error').length==0){
                            $('#submit_type').val('ADD');
                            
                            if(checkMinMax()>0){
                                var content ='{{trans('form.alert_minmax')}}';
                                $.alert({
                                    title: '{{trans('form.warning')}}',
                                    content: content
                                });
                                return;
                            }
                            setTimeout(function(){
                                submit_data = getTableData();
                                // console.log(submit_data);
                                stateView();
                            });
                        }
                });

            } else {
                if(checkMinMax()>0){
                    var content ='{{trans('form.alert_minmax')}}';
                    $.alert({
                        title: '{{trans('form.warning')}}',
                        content: content
                    });
                    return;
                }

                setTimeout(function(){
                    submit_data = getTableData();
                    // console.log(submit_data);
                    stateView();
                });
            }
            
        });


        $('#back_view').on('click', function () {
            if (currState == 'ADD') {
                stateAdd();
            } else {
                stateEdit();
            }
            
        });

        $('#back_success').on('click', function () {
            
            if($('#state').val() == 'success'){
                app.setView(id,'landing');
                
            }else{
                $('#back_success').prop('disabled',false);
                stateEdit();
            }
        });

        $('.back').on('click', function () {
            app.setView(id,'landing');

        });

        
        $('#done').on('click', function () {
            $(this).prop('disabled',true);
            app.setView(id,'landing');
        });

    });

    function countMenu(){
        var count = 0;
        $("#list").find("tbody tr").each(function () {
            var check = ($('td:eq(0)', $(this)).children().is(':checked') ? 1 : 0);

            if (check == 1) {
                count++;
            }
        });
        return count;
    }

    function getMatrix(stateType){
        var value = {};
        var url_action = 'search';
        var action = 'SEARCH';
        var result_key='result';
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            async:true,
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
                if (result.status=="200") {
                    var detail = result.result;
                    oTable.clear();
                    var selected_id = JSON.parse($('#temp').attr('data-id'));
                    //console.log(detail);
                    if(detail){
                    $.each(detail, function (idx, obj){
                        $.each(selected_id, function (idx2,obj2){
                            if(obj2.id==obj.id){
                                oTable.row.add([

                                    '<span id="currency_code">'+obj.currencyCode +'</span>'+'<input id="limit_id" name="limit_id" class="form-control state_edit" value="' + obj.id + '" type="hidden">',
                                    '<input id="minBuy_limit" name="minBuy_limit" class="form-control state_edit limit" value="'+obj.minBuyLimit+'" type="text" style="width:100%;display:hidden;text-align: right;"><span id="minBuy_limit_view" class="state_view" style="float: right;">'+obj.minBuyLimit+'</span>',
                                    '<input id="maxBuy_limit" name="maxBuy_limit" class="form-control state_edit limit" value="'+obj.maxBuyLimit+'" type="text" style="width:100%;display:hidden;text-align: right;"><span id="maxBuy_limit_view" class="state_view" style="float: right;">'+obj.maxBuyLimit+'</span>',
                                    '<input id="minSell_limit" name="minSell_limit" class="form-control state_edit limit" value="'+obj.minSellLimit+'" type="text" style="width:100%;display:hidden;text-align: right;"><span id="minSell_limit_view" class="state_view" style="float: right;">'+obj.minSellLimit+'</span>',
                                    '<input id="maxSell_limit" name="maxSell_limit" class="form-control state_edit limit" value="'+obj.maxSellLimit+'" type="text" style="width:100%;display:hidden;text-align: right;"><span id="maxSell_limit_view" class="state_view" style="float: right;">'+obj.maxSellLimit+'</span>'
                                ]).draw(false);
                            }
                        });
                    });
                    }
                    $('#temp').attr('data-id','');

                    $('.limit').autoNumeric('init',{
                        emptyInputBehavior: 'zero',
                        digitGroupSeparator        : ',',
                        decimalCharacter           : '.',
                        decimalCharacterAlternative: '.',
                        allowDecimalPadding : false,
                        minimumValue:'0.00',maximumValue:'999999999999999.99'
                    });

                    console.log("===========", stateType);
                    if (stateType == 'DELETE') {
                        stateView();
                    } else {
                    stateEdit();
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
                if (result.status=="200") {
                    currencyOption = '<select id="currency_list" class="form-control state_edit" data-error="Currency is mandatory" required>';
                    currencyOption += '<option value="" selected="selected"></option>';
                    $.each(result.result, function (idx, obj) {
                        if(obj.code=="IDR") {
                            return true; // exclude IDR
                        }
                        currencyOption += '<option value="' + obj.code + '">'+ obj.code + ' - ' + obj.name + '</option>';
                    });
                    currencyOption += '</select>';
                    currencyOption += '<div class="help-block with-errors"></div>';

                    $('.currency_setup').html(currencyOption);
                } else {
                    flash('warning', result.message);
                }



            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '{{trans('form.conn_error')}}';
                flash('warning', msg);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            },complete: function(data) {
                //getMatrix();
            }
        });
    }

    function submitData(){
        var value = {
           "bankForexLimitList": submit_data
        };

        var url_action = 'edit';
        if (currState == 'ADD') {
            url_action = 'add';
        } else if (currState == 'DELETE') {
            url_action = 'delete';
            action = 'submitDelete';
        }

            $.ajax({
                url: url_action,
                method: 'post',
                data: {"_token": "{{ csrf_token() }}", menu: id, value: value, url_action:action},
                success: function (data) {
                    $('#submit_view').prop('disabled',false);
                    var result = JSON.parse(data);
                    if (result.status=="200") {
                        noRef=result.referenceNo;
                        flash('success', result.message+'<br>'+'ReferenceNo: '+ result.referenceNo+'<br>'+result.dateTimeInfo);$('#submit_view').hide();
                        stateSuccess();
                    } else {
                        $('#submit_view').prop('disabled',false);
                        flash('warning', result.message);
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

        if (currState == 'ADD') {

            var currencyCode = $('#currency_list').val();
            var currencyView = $('#currency_list option:selected').text(); // kebutuhan screen ongoingtask

            var obj = {
                    id: currencyCode, //will be override to UUID
                    maxBuyLimit: $('#maxBuyLimit').autoNumeric('get'),
                    minBuyLimit: $('#minBuyLimit').autoNumeric('get'),
                    maxSellLimit: $('#maxSellLimit').autoNumeric('get'),
                    minSellLimit: $('#minSellLimit').autoNumeric('get'),
                    currencyCode: currencyCode,
                    currencyView: currencyView,
                    viewState: currState
                };

                    data.push(obj);

        } else {

            $("#list").find("tbody tr").each(function(){
                
                var limitId = $('td:eq(0)', $(this)).find('#limit_id').val();
                var currencyCode = $('td:eq(0)', $(this)).find('#currency_code').text();
  
                var minBuy = $('td:eq(1)', $(this)).find('#minBuy_limit').autoNumeric('get');
                $('td:eq(1)', $(this)).find('#minBuy_limit_view').text($('td:eq(1)', $(this)).find('#minBuy_limit').val());
                var maxBuy = $('td:eq(2)', $(this)).find('#maxBuy_limit').autoNumeric('get');
                $('td:eq(2)', $(this)).find('#maxBuy_limit_view').text($('td:eq(2)', $(this)).find('#maxBuy_limit').val());
                var minSell = $('td:eq(3)', $(this)).find('#minSell_limit').autoNumeric('get');
                $('td:eq(3)', $(this)).find('#minSell_limit_view').text($('td:eq(3)', $(this)).find('#minSell_limit').val());
                var maxSell = $('td:eq(4)', $(this)).find('#maxSell_limit').autoNumeric('get');
                $('td:eq(4)', $(this)).find('#maxSell_limit_view').text($('td:eq(4)', $(this)).find('#maxSell_limit').val());

                var obj = {
                    id: limitId,
                    minBuyLimit: minBuy,
                    maxBuyLimit: maxBuy,
                    minSellLimit: minSell,
                    maxSellLimit: maxSell,
                    currencyCode: currencyCode,
                    viewState: currState
                };

                    data.push(obj);
            });
        }

        
        return data;
    }

    function stateAdd() {

        $('.editState').hide();
        $('.addState').show();
        $('#state').val('add');
        $('.state_view').hide();
        $('.state_edit').show();
        $('label.state_view').text('-');
        $('#save_screen').hide();
        $("#list").find("tbody tr").each(function () {
            $('td:eq(0)', $(this)).parent().show();
        });
        $('#done').hide();
        $('#next_user').hide();
    }

    function stateEdit() {

        $('.editState').show();
        $('.addState').hide();
        $('#state').val('edit');
        $('.state_view').hide();
        $('.state_edit').show();
        $('label.state_view').text('-');
        $('#save_screen').hide();
        $("#list").find("tbody tr").each(function () {
            $('td:eq(0)', $(this)).parent().show();
        });
        $('#done').hide();
        $('#next_user').hide();
    }

    function stateView() {

        if (currState == 'ADD') {

            var currency = ($('#currency_list option:selected').text() == '' ? '-' : $('#currency_list option:selected').text());
            var maxBuy = ($('#maxBuyLimit').val() == '' ? '-' : $('#maxBuyLimit').val());
            var minBuy = ($('#minBuyLimit').val() == '' ? '-' : $('#minBuyLimit').val());
            var maxSell = ($('#maxSellLimit').val() == '' ? '-' : $('#maxSellLimit').val());
            var minSell = ($('#minSellLimit').val() == '' ? '-' : $('#minSellLimit').val());

            $('#currency_setup_view').text(currency);
            $('#maxBuy_view').text(maxBuy);
            $('#minBuy_view').text(minBuy);
            $('#maxSell_view').text(maxSell);
            $('#minSell_view').text(minSell);

            $('.help-block').hide();

        } else if (currState == 'DELETE') {
            $('.editState').show();
            $('.addState').hide();
            $('#back_view').hide();
            // $('.state_view').hide();
            // $('.state_edit').show();
        }

        $('#back').hide();
        $('#state').val('view');
        $('#preview').text('Preview');
        $('.state_edit').hide();
        $('.state_view').show();
        $('#save_screen').hide();
        $('#done').hide();
        $('#next_user').hide();
    }

    function stateSuccess() {
        $('#state').val('success');
        $('input.state_edit').val('');
        $('input.check').attr('checked', '');
        $('#save_screen').show();
        $('#back_view').hide();
        $('#back_success').show();
        $('#done').show();
        $('#next_user').show();
        $('#back').hide();
    }

    function loadState() {
        var stateType = $('#stateType').val();
        currState = stateType;
        if (stateType == 'ADD') {
            stateAdd();
        } else if (stateType == 'EDIT'){
            getMatrix(stateType);
            // stateEdit();
            
        } else if (stateType == 'DELETE'){
            getMatrix(stateType);
        }
    }

    function checkMinMax(){
        var count = 0;

        if (currState == 'ADD') {

            var minBuy = $('#minBuyLimit').autoNumeric('get');
            var maxBuy = $('#maxBuyLimit').autoNumeric('get');
            var minSell = $('#minSellLimit').autoNumeric('get');
            var maxSell = $('#maxSellLimit').autoNumeric('get');

            if (parseFloat(minBuy)>parseFloat(maxBuy)) {
                count++;
            }

            if (parseFloat(minSell)>parseFloat(maxSell)) {
                count++;
            }


        } else {

            $("#list").find("tbody tr").each(function () {
                var minBuy = $('td:eq(1)', $(this)).find('#minBuy_limit').autoNumeric('get');
                var maxBuy = $('td:eq(2)', $(this)).find('#maxBuy_limit').autoNumeric('get');
                var minSell = $('td:eq(3)', $(this)).find('#minSell_limit').autoNumeric('get');
                var maxSell = $('td:eq(4)', $(this)).find('#maxSell_limit').autoNumeric('get');

                if (parseFloat(minBuy)>parseFloat(maxBuy)) {
                    count++;
                }

                if (parseFloat(minSell)>parseFloat(maxSell)) {
                    count++;
                }

            });

        }

        

        return count;

    }

</script>