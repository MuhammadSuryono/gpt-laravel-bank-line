@include('_partials.header_content',['breadcrumb'=>[str_replace('-',' ',$menu),$type]])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div class="box">
           <div class="box-header">
                     <h3 class="box-title">Rate Detail</h3>
                </div>
                <form id="form-area" class="form-horizontal form-area">
                <input type="hidden" id="code_edit" value=""/>
                <input type="hidden" id="type" value=""/>
                <input type="hidden" id="state" value=""/>
                <input type="hidden" id="submit_mode" value=""/>
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label currlbl"><strong>Currency&ast;</strong></label>
                                <div class="col-md-4">
                                    <div class="currency_setup state_edit"><select class="form-control"></select></div>
                                    <label id="currency_setup_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label lblTrxBuy"><strong>Transaction Buy Rate&ast;</strong></label>
                                <div class="col-md-4">
                                    <input type="text" id="trxBuyRate" name="trxBuyRate" class="form-control state_edit numeric rate" autocomplete="off" value="" style="width:100%;text-align: right;" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                    <label id="trxBuy_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label lblTrxMid"><strong>Transaction Mid Rate&ast;</strong></label>
                                <div class="col-md-4">
                                    <input type="text" id="trxMidRate" name="trxMidRate" class="form-control state_edit numeric rate" autocomplete="off" value="" style="width:100%;text-align: right;" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                    <label id="trxMid_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label lblTrxSell"><strong>Transaction Sell Rate&ast;</strong></label>
                                <div class="col-md-4">
                                    <input type="text" id="trxSellRate" name="trxSellRate" class="form-control state_edit numeric rate" autocomplete="off" value="" style="width:100%;text-align: right;" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                    <label id="trxSell_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Bank Note Sell Rate</label>
                                <div class="col-md-4">
                                    <input type="text" id="bankSellRate" name="bankSellRate" class="form-control state_edit numeric rate" autocomplete="off" value="" style="width:100%;text-align: right;">
                                    <label id="bankSell_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Bank Note Buy Rate</label>
                                <div class="col-md-4">
                                    <input type="text" id="bankBuyRate" name="bankBuyRate" class="form-control state_edit numeric rate" autocomplete="off" value="" style="width:100%;text-align: right;">
                                    <label id="bankBuy_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Teller Sell Rate</label>
                                <div class="col-md-4">
                                    <input type="text" id="tellerSellRate" name="tellerSellRate" class="form-control state_edit numeric rate" autocomplete="off" value="" style="width:100%;text-align: right;">
                                    <label id="tellerSell_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Teller Buy Rate</label>
                                <div class="col-md-4">
                                    <input type="text" id="tellerBuyRate" name="tellerBuyRate" class="form-control state_edit numeric rate" autocomplete="off" value="" style="width:100%;text-align: right;">
                                    <label id="tellerBuy_view" class="state_view"></label>
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
                </form>
            </div>
        </div>
    </div>

</section>

<script>
    var oTable;
    var unitOption;
    var cityOption;
    var submit_data;
    var id = '{{ $service }}';
    var noRef;
    $(document).ready(function () {

        $(document).validator().on('#form-area','submit', function (e) {
            if (e.isDefaultPrevented()) {
                // handle the invalid form...
            } else {
                // everything looks good!

            }
        });

        getCurrency();
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
                    },

                }
            });

        });

        function submitData(){	
            var value = {
                "currencyCode": $('#currency_list').val(),
                "trxBuyRate": $('#trxBuyRate').autoNumeric('get'),
                "trxMidRate": $('#trxMidRate').autoNumeric('get'),
                "trxSellRate": $('#trxSellRate').autoNumeric('get'),
                "bankBuyRate": ($('#bankBuyRate').autoNumeric('get') ? $('#bankBuyRate').autoNumeric('get') : 0),
                "bankSellRate": ($('#bankSellRate').autoNumeric('get') ? $('#bankSellRate').autoNumeric('get') : 0),
                "tellerBuyRate": ($('#tellerBuyRate').autoNumeric('get') ? $('#tellerBuyRate').autoNumeric('get') : 0),
                "tellerSellRate": ($('#tellerSellRate').autoNumeric('get') ? $('#tellerSellRate').autoNumeric('get') : 0),
                "currencyView": $('#currency_list option:selected').text() // kebutuhan screen ongoingtask
            };

            var url_action = "";
            if ($('#type').val() == 'add'){
                url_action = "add";
            } else {
                url_action = "edit";
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
                            flash('success', result.message+'<br>'+'ReferenceNo: '+ result.referenceNo+'<br>'+result.dateTimeInfo);
                            $('#submit_view').hide();
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


        $('#confirm').on('click', function () {

            $('#form-area').validator('validate');
            setTimeout(function(){
                if($('#form-area').validator('validate').has('.has-error').length==0){
                    $('#submit_type').val('submit');
                    stateView();
                }
            });
        });

        /*$('#submit_add').on('click', function () {
            $('#submit_type').val('submit_add');
            stateView();
        });*/

        $('#back_view').on('click', function () {
            $(this).prop('disabled',true);

            if($('#state').val() == 'success'){
                var action = '';
                if($('#submit_type').val()=='submit'){
                    action = 'landing';
                }else{
                    action = 'add';
                }
                app.setView(id,action)
                return;
            } else {
                $('#back_view').prop('disabled',false);
                changeLabel(true);
                stateEdit();
            }
        });


        /*$('.back').on('click', function () {
            app.setView(id,'landing')

        });*/
        $('.back').on('click', function () {
            $(this).prop('disabled',true);
            if ($('#type').val() == 'add') {
                app.setView(id,'landing')
            } else {
                var code = $('#code_edit').val();
                var res = app.setView(id,'detail');
                if(res=='done'){
                    $('#currencyCode').val(code);
                    getMatrix();
                }
            }
        });

        $('#done').on('click', function () {
            $(this).prop('disabled',true);
            app.setView(id,'landing');
        });

        $('.rate').autoNumeric('init',{
            emptyInputBehavior: 'focus',
            digitGroupSeparator        : ',',
            decimalCharacter           : '.',
            decimalCharacterAlternative: '.',
            // allowDecimalPadding : false,
            minimumValue:'0.00',maximumValue:'999999999999999.9999'
        });
        
    });

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
                    unitOption = '<select id="currency_list" class="form-control state_edit" data-error="Currency is mandatory" required>';
                    unitOption += '<option value="" selected="selected"></option>';
                    $.each(result.result, function (idx, obj) {
                        unitOption += '<option value="' + obj.code + '">'+ obj.code + ' - ' + obj.name + '</option>';
                    });
                    unitOption += '</select>';
                    unitOption += '<div class="help-block with-errors"></div>';

                    $('.currency_setup').html(unitOption);
                    // $('.currency_setup').select2();
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

    function getRateEdit(code_id){

        var url_action= 'search';
        var value ={
            currencyCode:code_id,
            name:'',
            currentPage: "1",
            pageSize: "50",
            orderBy: {"currency.effectiveDate": "DESC"}
        };
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data:{value:value,menu:id,action:'DETAIL',url_action:url_action},
            success: function (data) {

                var result = JSON.parse(data);
                if (result.status=="200") {
                    var index = result.result.map(function(o) { return o.currencyCode; }).indexOf(code_id.toString());
                    var detail = result.result[index];

                    $('#currency_list').val(detail.currencyCode).trigger('change');
                    $('#currency_list').prop('disabled',true)
                    $('#trxBuyRate').val(detail.trxBuyRate);
                    $('#trxMidRate').val(detail.trxMidRate);
                    $('#trxSellRate').val(detail.trxSellRate);
                    $('#bankBuyRate').val(detail.bankBuyRate);
                    $('#bankSellRate').val(detail.bankSellRate);
                    $('#tellerBuyRate').val(detail.tellerBuyRate);
                    $('#tellerSellRate').val(detail.tellerSellRate);
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


        function stateEdit() {

            $('#state').val('edit');
            $('.state_view').hide();
            $('.state_edit').show();
            $('label.state_view').text('-');
            $('#save_screen').hide();
            $('.help-block').show();
            $('#done').hide();
            $('#next_user').hide();


        }

        function stateView() {
            $('#state').val('view');

            var currency = ($('#currency_list option:selected').text() == '' ? '-' : $('#currency_list option:selected').text());
            var trxBuy = ($('#trxBuyRate').val() == '' ? '-' : $('#trxBuyRate').val());
            var trxSell = ($('#trxSellRate').val() == '' ? '-' : $('#trxSellRate').val());
            var trxMid = ($('#trxMidRate').val() == '' ? '-' : $('#trxMidRate').val());
            var bankBuy = ($('#bankBuyRate').val() == '' ? '-' : $('#bankBuyRate').val());
            var bankSell = ($('#bankSellRate').val() == '' ? '-' : $('#bankSellRate').val());
            var tellerBuy = ($('#tellerBuyRate').val() == '' ? '-' : $('#tellerBuyRate').val());
            var tellerSell = ($('#tellerSellRate').val() == '' ? '-' : $('#tellerSellRate').val());
   
            $('.state_edit').hide();
            $('.state_view').show();
            $('#currency_setup_view').text(currency);
            $('#trxBuy_view').text(trxBuy);
            $('#trxSell_view').text(trxSell);
            $('#trxMid_view').text(trxMid);
            $('#bankBuy_view').text(bankBuy);
            $('#bankSell_view').text(bankSell);
            $('#tellerBuy_view').text(tellerBuy);
            $('#tellerSell_view').text(tellerSell);
            $('#save_screen').hide();
            $('.help-block').hide();
            $('#done').hide();
            $('#next_user').hide();

            changeLabel(false);

        }

        function stateSuccess() {
            $('#state').val('success');
            $('#code_1').val('');
            // $('#name').val('');
            $('input.state_edit').val('');
            $('#back_view').hide();
            $('#save_screen').show();
            $('#done').show();
            $('#next_user').show();
        }

        function changeLabel(isBack){

            if (isBack) {
                $('.currlbl').html('<strong>Currency*</strong>');
                $('.lblTrxBuy').html('<strong>Transaction Buy Rate*</strong>');
                $('.lblTrxMid').html('<strong>Transaction Mid Rate*</strong>');
                $('.lblTrxSell').html('<strong>Transaction Sell Rate*</strong>');
            } else {
                $('.currlbl').html('Currency');
                $('.lblTrxBuy').html('Transaction Buy Rate');
                $('.lblTrxMid').html('Transaction Mid Rate');
                $('.lblTrxSell').html('Transaction Sell Rate');
            }

        }


</script>