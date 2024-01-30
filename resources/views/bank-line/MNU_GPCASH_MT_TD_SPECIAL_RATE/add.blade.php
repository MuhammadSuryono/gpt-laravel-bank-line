@include('_partials.header_content',['breadcrumb'=>[str_replace('-',' ',$menu),$type]])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div class="box">
           <div class="box-header">
                     <h3 class="box-title">TD Special Rate Detail</h3>
                </div>
                <form id="form-area" class="form-horizontal form-area">
                <input type="hidden" id="code_edit" value=""/>
                <input type="hidden" id="state" value=""/>
                <input type="hidden" id="submit_mode" value=""/>
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

        
                        <div class="row ">
                            <div class="form-group">
                                <label class="col-md-4 control-label lblSpecialRate"><strong>Special Rate&ast;</strong></label>
                                <div class="col-md-5">
                                    <input type="text" id="specialRate" name="specialRate" class="state_edit form-control numeric rate" autocomplete="off" value="0" maxlength="100" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                    <label id="specialRate_view" class="state_view"></label>
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

                content='{{trans('form.confirm_edit')}}';


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

                "specialRate": $('#specialRate').autoNumeric('get'),
                "expiryDate": $('#expDate_list').val(),
                "expHour": $('#expHour').val(),
                "status" : "OPEN",
            };


            var url_action = "";
            
                url_action = "add";
            
            
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
            
            app.setView(id,'landing')
           
        });

        $('#done').on('click', function () {
            $(this).prop('disabled',true);
            app.setView(id,'landing');
        });

        $('#refNoSpecialRate').alphanum({
            allowSpace: false,
            allow : ''
        });


        $('.rate').autoNumeric('init',{
            emptyInputBehavior: 'focus',
            digitGroupSeparator        : ',',
            decimalCharacter           : '.',
            decimalCharacterAlternative: '.',
            // allowDecimalPadding : false,
            minimumValue:'0.00',maximumValue:'999999999999999.99'
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

            var refNoSpecialRate = ($('#refNoSpecialRate').val() == '' ? '-' : $('#refNoSpecialRate').val());

            var corporateId = ($('#corporate_list option:selected').text() == '' ? '-' : $('#corporate_list option:selected').text());
           
            var specialRate = ($('#specialRate').val() == '' ? '-' : $('#specialRate').val());
          
            var expiryDate = ($('#expDate_list').val() == '' ? '-' : $('#expDate_list').val());
            var expHour = ($('#expHour').val() == '' ? '-' : $('#expHour').val());

           

            $('.state_edit').hide();
            $('.state_view').show();

            $('#refNoSpecialRate_view').text(refNoSpecialRate);
            $('#corporate_setup_view').text(corporateId);

            $('#validUntil_setup_view').text(expiryDate + " " + expHour);

            $('#specialRate_view').text(specialRate);


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
            
                $('.lblcorpID').html('<strong>Corporate ID*</strong>');
                $('.lblSpecialRate').html('<strong>Special Rate*</strong>');
                $('.lblExpDate').html('<strong>Valid Until*</strong>');            
            } else {
                $('.lblRefNo').html('Reference Number');
                
                $('.lblcorpID').html('Corporate ID');
                $('.lblSpecialRate').html('Special Rate');
                $('.lblExpDate').html('Valid Until');
                
            }


        }


</script>