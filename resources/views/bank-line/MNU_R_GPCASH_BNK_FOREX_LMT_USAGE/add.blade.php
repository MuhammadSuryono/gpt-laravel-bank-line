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
                    <h3 class="box-title ">Bank Forex Limit Usage Listing</h3><br>
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
                                        <th align="right"><strong>Usage</strong></th>
                                        <th align="right"><strong>Maximum Buy Limit in IDR</strong></th>
                                        <th align="right"><strong>Maximum Sell Limit in IDR</strong></th>
                                        <th align="right"><strong>Cover Usage</strong></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>

                            <div class="form-group resetState">
                                <table id="list_reset" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th align="center"><strong>Foreign Currency</strong></th>
                                        <th align="right"><strong>Usage</strong></th>
                                        <th align="right"><strong>Usage in IDR</strong></th>
                                        <th align="right"><strong>Maximum Buy Limit in IDR</strong></th>
                                        <th align="right"><strong>Maximum Sell Limit in IDR</strong></th>
                                        <th align="right"><strong>Buy Remaining in IDR</strong></th>
                                        <th align="right"><strong>Sell Remaining in IDR</strong></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            
                        <div class="box-footer">
                            <div class="col-md-12 state_edit text-center">
                                <button type="button" id="back" name="back" class="btn btn-default back float-left">@lang('form.cancel')</button>
                                <button type="button" id="confirm" name="confirm" class="btn btn-primary float-right ">@lang('form.confirm')</button>
                            </div>
                            <div class="col-md-12 state_view text-center" data-html2canvas-ignore="true">
                                <div class="float-left">
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
    var oTableReset;
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
                    width: "20%",

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

        oTableReset = $('#list_reset').DataTable({
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
                    width: "10%"
                },
                {
                    targets: 1,
                    sortable: false,
                    width: "15%",
                    className:"dt-right",
                    render: $.fn.dataTable.render.number( ',', '.', 2, '' )
                },
                {
                    targets: 2,
                    sortable: false,
                    width: "15%",
                    className:"dt-right",
                    render: $.fn.dataTable.render.number( ',', '.', 2, '' )
                },
                {
                    targets: 3,
                    sortable: false,
                    width: "15%",
                    className:"dt-right",
                    render: $.fn.dataTable.render.number( ',', '.', 2, '' )
                },
                {
                    targets: 4,
                    sortable: false,
                    width: "15%",
                    className:"dt-right",
                    render: $.fn.dataTable.render.number( ',', '.', 2, '' )

                },
                {
                    targets: 5,
                    sortable: false,
                    width: "15%",
                    className:"dt-right",
                    render: $.fn.dataTable.render.number( ',', '.', 2, '' )
                },
                {
                    targets: 6,
                    sortable: false,
                    width: "15%",
                    className:"dt-right",
                    render: $.fn.dataTable.render.number( ',', '.', 2, '' )

                },               
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
            
            if (currState == 'RESET') {
                content = '{{trans('form.confirm_process')}}';
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

            if(currState == 'RESET') {

                
            } else {
                if(checkCoverUsage()>0){
                    var content ='Cover Usage shoud not be 0';
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
            if (currState == 'RESET') {
                app.setView(id,'landing');
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

    function getMatrix(){
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
                                    '<span id="limitUsage_view" class="limit">'+obj.limitUsage +'</span>' +'<input id="limitUsage" name="limitUsage" class="form-control state_edit" value="' + obj.limitUsage + '" type="hidden">',
                                    '<span id="maxBuy_limit_view" class="limit">'+obj.maxBuyLimit +'</span>'+'<input id="maxBuy_limit" name="maxBuy_limit" class="form-control state_edit" value="' + obj.maxBuyLimit + '" type="hidden">',
                                    '<span id="maxSell_limit_view" class="limit">'+obj.maxSellLimit +'</span>'+'<input id="maxSell_limit" name="maxSell_limit" class="form-control state_edit" value="' + obj.maxSellLimit + '" type="hidden">',
                                     '<input id="coverUsage" name="coverUsage" class="form-control state_edit limit" value=" " type="text" style="width:100%;display:hidden;text-align: right;"><span id="coverUsage_view" class="state_view" style="float: right;">'+obj.coverUsage+'</span>',
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

                    stateEdit();

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

    function getMatrixReset(){
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
                    oTableReset.clear();
                    var selected_id = JSON.parse($('#temp').attr('data-id'));
                    //console.log(detail);
                    var data = [];
                    
                    if(detail){
                    $.each(detail, function (idx, obj){
                        $.each(selected_id, function (idx2,obj2){
                            if(obj2.id==obj.id){
                                data.push(obj);
                                oTableReset.row.add([

                                    '<span id="currency_code">'+obj.currencyCode +'</span>'+'<input id="limit_id" name="limit_id" class="form-control state_edit" value="' + obj.id + '" type="hidden">',
                                    obj.limitUsage,
                                    obj.limitUsageEquivalent,
                                    obj.maxBuyLimit,
                                    obj.maxSellLimit,                                    
                                    obj.remainingSellLimit,
                                    obj.remainingBuyLimit,
                                ]).draw(false);
                            }
                        });
                    });
                    submit_data = data;
                    }
                    $('#temp').attr('data-id','');

                    

                    stateReset();

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
           "bankForexLimitList": submit_data,
           "wfAction":'UPDATE'
        };

        var url_action = 'edit';
        if (currState == 'RESET') {
            value = {
           "bankForexLimitList": submit_data,
           "wfAction":'RESET'
        };
        }

            $.ajax({
                url: url_action,
                method: 'post',
                data: {"_token": "{{ csrf_token() }}", menu: id, value: value},
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
        } else {

            $("#list").find("tbody tr").each(function(){
                
                var limitId = $('td:eq(0)', $(this)).find('#limit_id').val();
                var currencyCode = $('td:eq(0)', $(this)).find('#currency_code').text();
                var limitUsage = $('td:eq(1)', $(this)).find('#limitUsage').val();
                var maxBuy = $('td:eq(2)', $(this)).find('#maxBuy_limit').val();
                var maxSell = $('td:eq(3)', $(this)).find('#maxSell_limit').val();
                
                var coverUsage = $('td:eq(4)', $(this)).find('#coverUsage').autoNumeric('get');
                $('td:eq(4)', $(this)).find('#coverUsage_view').text($('td:eq(4)', $(this)).find('#coverUsage').val());

                if(coverUsage == 0){
                     var content ='Cover Usage should not be 0';
                    $.alert({
                        title: '{{trans('form.warning')}}',
                        content: content
                    });
                    return;
                }
                var obj = {
                    id: limitId,
                    limitUsage: limitUsage,
                    maxBuyLimit: maxBuy,
                    maxSellLimit: maxSell,
                    coverUsage: coverUsage,
                    currencyCode: currencyCode,
                    viewState: currState
                };

                    data.push(obj);
            });
        }

        
        return data;
    }

    

    function stateReset() {

        $('.editState').hide();
        $('.resetState').show();
        $('#state').val('reset');
        $('.state_view').show();
        $('.state_edit').hide();
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
        $('.resetState').hide();
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
    }

    function loadState() {
        var stateType = $('#stateType').val();
        currState = stateType;
        if (stateType == 'EDIT'){
            stateEdit();
            getMatrix();
        }else{
            stateReset();
            getMatrixReset();
        }
    }

    function checkCoverUsage(){
        var count = 0;
        $("#list").find("tbody tr").each(function(){
                var coverUsage = $('td:eq(4)', $(this)).find('#coverUsage').autoNumeric('get');


                if(coverUsage == 0){
                    count++;
                }                
            });
                
        return count;
    }

</script>