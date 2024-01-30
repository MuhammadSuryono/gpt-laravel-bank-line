@include('_partials.header_content',['breadcrumb'=>[str_replace('-',' ',$menu),$type]])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div class="box">
           <div class="box-header">
                     <h3 class="box-title">Special Rate Detail</h3>
                </div>
                <form id="form-area" class="form-horizontal form-area">
                <input type="hidden" id="code_edit" value=""/>
                <input type="hidden" id="type" value=""/>
                <input type="hidden" id="state" value=""/>
                <input type="hidden" id="submit_mode" value=""/>
                <input type="hidden" id="rateType" value=""/>
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label lblRefNo"><strong>Reference Number&ast;</strong></label>
                                <div class="col-md-5">
                                    <input type="text" id="refNoSpecialRate" name="refNoSpecialRate" class="form-control state_edit" autocomplete="off" value="" maxlength="9" data-error="This field is required." required >
                                    <label id="refNoSpecialRate_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label lblcorpID"><strong>Corporate ID&ast;</strong></label>
                                <div class="col-md-5">
                                    <div class="corporate_setup state_edit"><select class="form-control"></select></div>
                                    <label id="corporate_setup_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row local">
                            <div class="form-group">
                                <label class="col-md-4 control-label local lblForeignCurency"><strong>Foreign Currency&ast;</strong></label>
                                <div class="col-md-5">
                                    <div class="foreignCurrency_setup state_edit"><select class="form-control"></select></div>
                                    <label id="foreignCurrency_setup_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>

                        <div class="row foreign">
                            <div class="form-group">
                                <label class="col-md-4 control-label lblForeignCurency1"><strong>Foreign Currency 1&ast;</strong></label>
                                <div class="col-md-5">
                                    <div class="foreignCurrency1_setup state_edit"><select class="form-control"></select></div>
                                    <label id="foreignCurrency1_setup_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="form-group">
                                <label class="col-md-4 control-label lblUnit local"><strong>Unit&ast;</strong></label>
                                <label class="col-md-4 control-label lblUnit foreign"><strong>Unit 1&ast;</strong></label>
                                <div class="col-md-5">
                                    <input type="text" id="unit" name="unit" class="form-control state_edit" maxlength="9" autocomplete="off" value="1" data-error="This field is required." required>
                                    <label id="unit_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row local">
                            <div class="form-group">
                                <label class="col-md-4 control-label lblSpecialrate"><strong>Special Rate&ast;</strong></label>
                                    <div class="state_edit col-md-2">
                                        <select class="form-control" id="buySellRateOpt" name="buySellRateOpt" onchange="changeTrxAmountCurr()">
                                            <option value="Buy Rate"> Buy Rate</option>
                                            <option value="Sell Rate"> Sell Rate</option>
                                        </select>
                                    </div>
                                    <div class="state_edit col-md-3">
                                        <input type="text" id="buySellRate" name="buySellRate" class="form-control state_edit numeric rate" autocomplete="off" value="0" data-error="This field is required." >
                                    </div> 
                                    <div class="help-block with-errors"></div>
                                    <label id="specialRate_view" class="state_view col-md-5"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row local">
                            <div class="form-group">
                                <label class="col-md-4 control-label lblBuySellRate"><strong>Buy/Sell Amount&ast;</strong></label>
                                <div class="col-md-5">
                                    <input type="text" id="buySellAmountRate" name="buySellAmountRate" class="form-control state_edit numeric rate" autocomplete="off" value="0" style="width:100%;text-align: right;" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                    <label id="buySellAmountRate_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>                        
                        
                        
                        <div class="row foreign">
                            <div class="form-group">
                                <label class="col-md-4 control-label lblBuyRate"><strong>Buy Rate&ast;</strong></label>
                                <div class="col-md-1">
                                    <label class="control-label">IDR</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" id="buyRate" name="buyRate" class="state_edit form-control numeric rate" autocomplete="off" value="0" maxlength="100" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                    <label id="buyRate_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row foreign">
                            <div class="form-group">
                                <label class="col-md-4 control-label lblForeignCurency2"><strong>Foreign Currency 2&ast;</strong></label>
                                <div class="col-md-5">
                                    <div class="foreignCurrency2_setup state_edit"><select class="form-control"></select></div>
                                    <label id="foreignCurrency2_setup_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row foreign">
                            <div class="form-group">
                                <label class="col-md-4 control-label lblUnit2"><strong>Unit 2&ast;</strong></label>
                                <div class="col-md-5">
                                    <input type="text" id="unit2" name="unit2" class="form-control state_edit" maxlength="9" autocomplete="off" value="1" data-error="This field is required." required>
                                    <label id="unit2_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row foreign">
                            <div class="form-group">
                                <label class="col-md-4 control-label lblSellRate"><strong>Sell Rate&ast;</strong></label>
                                <div class="col-md-1">
                                    <label class="control-label">IDR</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" id="sellRate" name="sellRate" class="state_edit form-control numeric rate" autocomplete="off" value="0" maxlength="100" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                    <label id="sellRate_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="form-group">
                                <label class="col-md-4 control-label lblTrxAmount"><strong>Transaction Amount&ast;</strong></label>
                                <div class="col-md-1 local">
                                    <label class="control-label lblTrxAmountCurr">IDR</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" id="trxAmount" name="trxAmount" class="state_edit form-control numeric rate foreign " autocomplete="off" value="0" maxlength="100" data-error="This field is required." required>
                                    <input type="text" class="local state_edit form-control numeric rate"  id="trxAmountLocal" name="trxAmountLocal" disabled="true">
                                    <div class="help-block with-errors"></div>
                                    <label id="trxAmount_view" class="state_view rate"></label>
                                </div>
                                
                            </div>
                        </div>                        
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Type</label>
                                <div class="col-md-5">
                                    <div class="state_edit">
                                       <select class="form-control" id="typeRate" name="typeRate" onchange="changeExpDate()">
                                            <option value="TODAY" > TODAY</option>
                                            <option value="TOM" > TOM</option>
                                            <option value="SPOT" > SPOT</option>
                                       </select>
                                   </div>
                                   <label id="type_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label lblExpDate"><strong>Valid Until&ast;</strong></label>                                
                                    <div class="validUntil_setup state_edit col-md-3">
                                        <select class="form-control"></select>
                                    </div>
                                    <div class="state_edit col-md-2">
                                        <input type="text" id="expHour" name="expHour" class="state_edit form-control expHour_cls" autocomplete="off" value="" maxlength="5" minlength="5" data-error="invalid format." required>
                                    </div>       
                                    <div class="help-block with-errors"></div>                             
                                    <label id="validUntil_setup_view" class="state_view col-md-5"></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label ">Remark</label>
                                <div class="col-md-5">
                                    <input type="text" id="remark" name="remark" class="form-control state_edit" autocomplete="off" value="" >
                                    <label id="remark_view" class="state_view"></label>
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
        getCorporate();
        validUntiSetup();
        stateEdit();



        $('.expHour_cls').each(function(){
                        var optionsStart = {
                                $el: $(this),
                                mask: 'HH:mm',
                                isUtc: true
                      }; 

                        Mask.newMask(optionsStart);
                    });

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
                "refNoSpecialRate": $('#refNoSpecialRate').val(),
                "corporateId": $('#corporate_list').val(),
                "foreignCurrency": $('#foreignCurrency_list').val(),
                "foreignCurrency1": $('#foreignCurrency1_list').val(),
                "foreignCurrency2": $('#foreignCurrency2_list').val(),
                "unit": $('#unit').val(),
                "unit2": $('#unit2').val(),
                "rateType": $('#rateType').val(),
                "buySellRateOpt": $('#buySellRateOpt').val(),
                "buySellRate": $('#buySellRate').autoNumeric('get'),
                "buySellAmountRate": $('#buySellAmountRate').autoNumeric('get'),
                "trxAmount": $('#trxAmount').autoNumeric('get'),
                "buyRate": $('#buyRate').autoNumeric('get'),
                "sellRate": $('#sellRate').autoNumeric('get'),
                "typeRate": $('#typeRate').val(),
                "remark": $('#remark').val(),
                "expiryDate": $('#expDate_list').val(),
                "expHour": $('#expHour').val(),
                "status" : "OPEN",
            };

             var rateType = $('#rateType').val();
                if (rateType=='LOCAL') {
                   value.foreignCurrency1 = $('#foreignCurrency_list').val()
                } 

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

        $('#refNoSpecialRate').alphanum({
            allowSpace: false,
            allow : ''
        });

        $('#unit').numeric({
            allowSpace: false,
           allow : ''
        });

        $('#unit2').numeric({
            allowSpace: false,
           allow : ''
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

    function validUntiSetup() {

        var today = moment(new Date(),"DD/MM/YYYY hh:mm").format("DD MMMM YYYY");
        var tom = moment(new Date()).add(1, 'days').format("DD MMMM YYYY");
        var spot = moment(new Date()).add(2, 'days').format("DD MMMM YYYY");

        unitOption = '<select id="expDate_list" class="form-control state_edit">';
                    unitOption += '<option value="'+today+'" selected="selected">'+today+'</option>';                    
                    unitOption += '</select>';

                    $('.validUntil_setup').html(unitOption);

    }

    function changeTrxAmountCurr() {
       if ($('#buySellRateOpt').val()=='Buy Rate') {
            $('.lblTrxAmountCurr').html('IDR');
        }else{
            $('.lblTrxAmountCurr').html(($('#foreignCurrency_list').val()));            
        }
    }
    function changeExpDate() {

        var today = moment(new Date(),"DD/MM/YYYY hh:mm").format("DD MMMM YYYY");
        var tom = moment(new Date()).add(1, 'days').format("DD MMMM YYYY");
        var spot = moment(new Date()).add(2, 'days').format("DD MMMM YYYY");

        unitOption = '<select id="expDate_list" class="form-control state_edit">';
                    unitOption += '<option value="'+today+'" selected="selected">'+today+'</option>';    

                    if ($('#typeRate').val()=='TOM') {
                        unitOption += '<option value="'+tom+'" selected="selected">'+tom+'</option>';  
                    }else if($('#typeRate').val()=='SPOT'){
                        unitOption += '<option value="'+tom+'" selected="selected">'+tom+'</option>';
                        unitOption += '<option value="'+spot+'" selected="selected">'+spot+'</option>';
                    }



                    unitOption += '</select>';
                    $('.validUntil_setup').html(unitOption);

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
                    unitOption = '<select id="foreignCurrency_list" class="form-control state_edit" data-error="Foreign Currency is mandatory" required>';
                    unitOption += '<option value="IDR" selected="selected">IDR - IDR</option>';
                    $.each(result.result, function (idx, obj) {
                        unitOption += '<option value="' + obj.code + '">'+ obj.code + ' - ' + obj.name + '</option>';
                    });
                    unitOption += '</select>';
                    unitOption += '<div class="help-block with-errors"></div>';

                    $('.foreignCurrency_setup').html(unitOption);


                    unitOption = '<select id="foreignCurrency1_list" class="form-control state_edit" data-error="Foreign Currency 1 is mandatory" required>';
                    unitOption += '<option value="IDR" selected="selected">IDR - IDR</option>';
                    $.each(result.result, function (idx, obj) {
                        unitOption += '<option value="' + obj.code + '">'+ obj.code + ' - ' + obj.name + '</option>';
                    });
                    unitOption += '</select>';
                    unitOption += '<div class="help-block with-errors"></div>';

                    $('.foreignCurrency1_setup').html(unitOption);


                    unitOption = '<select id="foreignCurrency2_list" class="form-control state_edit" data-error="Foreign Currency 2 is mandatory" required>';
                    unitOption += '<option value="IDR" selected="selected">IDR - IDR</option>';
                    $.each(result.result, function (idx, obj) {
                        unitOption += '<option value="' + obj.code + '">'+ obj.code + ' - ' + obj.name + '</option>';
                    });
                    unitOption += '</select>';
                    unitOption += '<div class="help-block with-errors"></div>';

                    $('.foreignCurrency2_setup').html(unitOption);
                    
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
                    unitOption = '<select id="corporate_list" class="form-control state_edit" data-error="Corporate is mandatory" required>';
                    unitOption += '<option value="" selected="selected"></option>';
                    $.each(result.result, function (idx, obj) {
                        unitOption += '<option value="' + obj.corporateId + '">'+ obj.corporateId + ' - ' + obj.corporateName + '</option>';
                    });
                    unitOption += '</select>';
                    unitOption += '<div class="help-block with-errors"></div>';

                    $('.corporate_setup').html(unitOption);
                    
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
            var rateType = $('#rateType').val();
                if (rateType=='FOREIGN') {
                    $('.foreign').show();
                      $('.local').hide();
                } else {
                    $('.foreign').hide();
                    $('.local').show(); 
                }

        }

        function stateView() {
            $('#state').val('view');

            var refNoSpecialRate = ($('#refNoSpecialRate').val() == '' ? '-' : $('#refNoSpecialRate').val());

            var corporateId = ($('#corporate_list option:selected').text() == '' ? '-' : $('#corporate_list option:selected').text());
            var foreignCurrency = ($('#foreignCurrency_list option:selected').text() == '' ? '-' : $('#foreignCurrency_list option:selected').text());
            var foreignCurrency1 = ($('#foreignCurrency1_list option:selected').text() == '' ? '-' : $('#foreignCurrency1_list option:selected').text());
            var foreignCurrency2 = ($('#foreignCurrency2_list option:selected').text() == '' ? '-' : $('#foreignCurrency2_list option:selected').text());

            var unit = ($('#unit').val() == '' ? '-' : $('#unit').val());
            var unit2 = ($('#unit2').val() == '' ? '-' : $('#unit2').val());
            var rateType = ($('#rateType').val() == '' ? '-' : $('#rateType').val());
            var buySellRateOpt = ($('#buySellRateOpt').val() == '' ? '-' : $('#buySellRateOpt').val());
            var buySellRate = ($('#buySellRate').val() == '' ? '-' : $('#buySellRate').val());
            var buySellAmountRate = ($('#buySellAmountRate').val() == '' ? '-' : $('#buySellAmountRate').val());
            
            var buyRate = ($('#buyRate').val() == '' ? '-' : $('#buyRate').val());
            var sellRate = ($('#sellRate').val() == '' ? '-' : $('#sellRate').val());
            var typeRate = ($('#typeRate').val() == '' ? '-' : $('#typeRate').val());
            var remark = ($('#remark').val() == '' ? '-' : $('#remark').val());
            var expiryDate = ($('#expDate_list').val() == '' ? '-' : $('#expDate_list').val());
            var expHour = ($('#expHour').val() == '' ? '-' : $('#expHour').val());

            var trxAmount = ($('#trxAmount').val() == '' ? '-' : $('#trxAmount').val());
            $('#trxAmount_view').text(trxAmount);
            if (rateType=='LOCAL') {
                    if(buySellRateOpt == 'Buy Rate'){
                        trxAmount = parseFloat(buySellAmountRate.replaceAll(",","")) * parseFloat(buySellRate.replace(",",""));
                    }else{
                        trxAmount = parseFloat(buySellAmountRate.replaceAll(",","")) / parseFloat(buySellRate.replace(",",""));
                    }

                    $('#trxAmount').val(trxAmount);
                    $('#trxAmount_view').text(trxAmount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
            } 

            $('.state_edit').hide();
            $('.state_view').show();

            $('#refNoSpecialRate_view').text(refNoSpecialRate);
            $('#corporate_setup_view').text(corporateId);
            $('#foreignCurrency_setup_view').text(foreignCurrency);
            $('#foreignCurrency1_setup_view').text(foreignCurrency1);
            $('#foreignCurrency2_setup_view').text(foreignCurrency2);
            $('#unit_view').text(unit);
            $('#unit2_view').text(unit2);

            $('#specialRate_view').text(buySellRateOpt + " : " + buySellRate);
            $('#buySellAmountRate_view').text(buySellAmountRate);
            $('#type_view').text(typeRate);
            $('#validUntil_setup_view').text(expiryDate + " " + expHour);
            $('#remark_view').text(remark);
            $('#buyRate_view').text(buyRate);
            $('#sellRate_view').text(sellRate);


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
                $('.lblRefNo').html('<strong>Reference Number*</strong>');
                $('.lblForeignCurency').html('<strong>Foreign Currency*</strong>');
                $('.lblForeignCurency1').html('<strong>Foreign Currency 1*</strong>');
                $('.lblForeignCurency2').html('<strong>Foreign Currency 2*</strong>');            
                $('.lblUnit').html('<strong>Unit*</strong>');
                $('.lblUnit1').html('<strong>Unit 1*</strong>');
                $('.lblUnit2').html('<strong>Unit 2*</strong>');
                $('.lblcorpID').html('<strong>Corporate ID*</strong>');
                $('.lblSpecialrate').html('<strong>Special Rate*</strong>');
                $('.lblExpDate').html('<strong>Valid Until*</strong>');            
                $('.lblBuySellRate').html('<strong>Buy/Sell Amount*</strong>');
                $('.lblBuyRate').html('<strong>Buy Rate*</strong>');
                $('.lblSellRate').html('<strong>Sell Rate*</strong>');
                $('.lblTrxAmount').html('<strong>Transaction Amount*</strong>');
            } else {
                $('.lblRefNo').html('Reference Number');
                $('.lblForeignCurency').html('Foreign Currency');
                $('.lblForeignCurency1').html('Foreign Currency 1');
                $('.lblForeignCurency2').html('Foreign Currency 2');
                $('.lblUnit').html('Unit');
                $('.lblUnit1').html('Unit 1');
                $('.lblUnit2').html('Unit 2');
                $('.lblcorpID').html('Corporate ID');
                $('.lblSpecialrate').html('Special Rate');
                $('.lblExpDate').html('Valid Until');
                $('.lblBuySellRate').html('Buy/Sell Amount');
                $('.lblBuyRate').html('Buy Rate');
                $('.lblSellRate').html('Sell Rate');
                $('.lblTrxAmount').html('Transaction Amount');
            }


        }


</script>