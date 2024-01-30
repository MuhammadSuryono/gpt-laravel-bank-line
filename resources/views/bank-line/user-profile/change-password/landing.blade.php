@include('_partials.header_content',['breadcrumb'=>['Change Password']])


<section class="content">
    <div  class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div id="print" class="box">
                <div id="spinner" style="display:none"></div>
                
                <div class="box-header">
                     <h3 class="box-title">User Information</h3>
                </div>
                <form id="form-area" class="form-horizontal form-area">
                <input type="hidden" id="code_edit" value=""/>
                <input type="hidden" id="type" value=""/>
                <input type="hidden" id="state" value=""/>
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label"><strong>Current Password*</strong></label>
                                <div class="col-md-6">
                                    <input type="password" id="current_pwd" name="current_pwd" class="form-control state_edit" maxlength="100" autocomplete="off" value="" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label"></label>
                                <div class="col-md-6">
                                    <div class="box-notif">
                                        <h6><strong>For your security, your password must alphanumeric and contains at least :</strong></h6>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <div id="valid-upper" class="valid-txt">
                                                    <i class="fa fa-check green"></i>
                                                    <span>1 uppercase</span>
                                                </div>
                                                <div id="valid-lower" class="valid-txt">
                                                    <i class="fa fa-check green"></i>
                                                    <span>1 lowercase</span>
                                                </div>
                                                <div id="valid-numbers" class="valid-txt">
                                                    <i class="fa fa-check green"></i>
                                                    <span>1 number</span>
                                                </div>
                                                <div id="valid-special" class="valid-txt">
                                                    <i class="fa fa-check green"></i>
                                                    <span>1 special character e.g space,._@!</span>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div id="valid-length" class="valid-txt">
                                                    <i class="fa fa-check green"></i>
                                                    <span id="min_pass">min. 8 characters</span>
                                                </div>
                                                <div id="valid-repeated" class="valid-txt">
                                                    <i class="fa fa-check green"></i>
                                                    <span>no more than 2 repeated character in a row</span>
                                                    <br/>
                                                    <i class="fa fa-check green" style="opacity: 0"></i><span>(e.g 111 is not allowed)</span>
                                                </div>
                                                <div id="valid-same" class="valid-txt">
                                                    <i class="fa fa-check green"></i>
                                                    <span>repeat password matched</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label"><strong>New Password*</strong></label>
                                <div class="col-md-6">
                                    <input type="password" id="new_pwd" name="new_pwd" class="form-control state_edit" maxlength="100" autocomplete="off" value="" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label"><strong>Confirm New Password*</strong></label>
                                <div class="col-md-6">
                                    <input type="password" id="new_pwd_confirm" name="new_pwd_confirm" class="form-control state_edit" maxlength="100" autocomplete="off" value="" data-error="Please enter the same value again." required>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                </form>
                       <div class="box-footer">
                        <div class="state_edit text-center">
                            <div class="float-left">
                            </div>
                            <div class="float-right">
                                <button type="button" id="confirm" name="confirm" class="btn btn-primary">@lang('form.submit')</button>
                            </div>
                       </div>
                     </div>

            </div>
        </div>
    </div>

</section>

<script>
    var id = 'MNU_GPCASH_IDM_CHG_PASSWD';
    var submit_data;
    var pass_length=8;
    $(document).ready(function () {
        $('.table-hidden').hide();

        stateEdit();

        $.ajax({
            async:false,
            url: 'getAPIData',
            method: 'post',
            data: {"_token": "{{ csrf_token() }}", action:'SEARCH',url_action:'getInfo',menu: id, value: ''},
            success: function (data) {
                var result = JSON.parse(data);
                if (result.status=="200") {
                    pass_length=result.passwordLength;
                    $('#min_pass').text('min.'+ pass_length+' characters');
                } else {
                    flash('warning', result.message);
                }

            }, error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }
        });

        $('#form-area').validator().on('submit', function (e) {
            if (e.isDefaultPrevented()) {
                // handle the invalid form...
            } else {
                // everything looks good!
                //console.log('valid')
            }
        });

        $('#new_pwd').keyup(function(){
            var val = $('#new_pwd').val();
            var val2 = $('#new_pwd_confirm').val();
            var upperCase= new RegExp('[A-Z]');
            var lowerCase= new RegExp('[a-z]');
            var numbers = new RegExp('[0-9]');
            var special = /[ !@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
            var hasTripple = /(.)\1\1/;

            $('.valid-txt').addClass('error');
            if(val.match(upperCase)){
                $('#valid-upper').removeClass('error').addClass('valid');
            }
            if(val.match(lowerCase)){
                $('#valid-lower').removeClass('error').addClass('valid');
            }
            if(val.match(numbers)){
                $('#valid-numbers').removeClass('error').addClass('valid');
            }
            if (special.test(val)) {
                $('#valid-special').removeClass('error').addClass('valid');
            }
            if(val.length>=8){
                $('#valid-length').removeClass('error').addClass('valid');
            }
            if(val===val2){

                $('#valid-same').removeClass('error').addClass('valid');
            }
            if(!hasTripple.test(val)) {
                $('#valid-repeated').removeClass('error').addClass('valid');
            }

            //console.log(special.test(val));
        });
        $('#new_pwd_confirm').keyup(function(){
            var val = $('#new_pwd').val();
            var val2 = $('#new_pwd_confirm').val();
            var upperCase= new RegExp('[A-Z]');
            var lowerCase= new RegExp('[a-z]');
            var numbers = new RegExp('[0-9]');
            var special = /[ !@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
            var hasTripple = /(.)\1\1/;

            $('.valid-txt').addClass('error');
            if(val.match(upperCase)){
                $('#valid-upper').removeClass('error').addClass('valid');
            }
            if(val.match(lowerCase)){
                $('#valid-lower').removeClass('error').addClass('valid');
            }
            if(val.match(numbers)){
                $('#valid-numbers').removeClass('error').addClass('valid');
            }
            if (special.test(val)) {
                $('#valid-special').removeClass('error').addClass('valid');
            }
            if(val.length>=8){
                $('#valid-length').removeClass('error').addClass('valid');
            }
            if(!hasTripple.test(val)) {
                $('#valid-repeated').removeClass('error').addClass('valid');
            }

            if(val===val2){

                $('#valid-same').removeClass('error').addClass('valid');
            }


            //console.log(special.test(val));
        });

        function submitData(){
            var url_action = 'userChangePassword';
            var action = 'UPDATE';
            var loginId = '<?php echo Session::get('userId') ?>';
            var heartbeat = '';
            $.ajax({
                url: 'heartBeat',
                method: 'post',
                async:false,
                data: {	_token : '{{ csrf_token() }}'},
                success: function (data) {
                    var result = JSON.parse(data);
                    heartbeat = result.heartBeat;
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    msgError('No Connection to Server!');
                    return;
                }
            });
            var passwd_plain = $('#new_pwd').val();
            var pssswd_encrypted = CryptoJS.AES.encrypt(passwd_plain,heartbeat).toString();
            var passwd_old_plain = $('#current_pwd').val();
            var pssswd_old_encrypted = CryptoJS.AES.encrypt(passwd_old_plain,heartbeat).toString();
            var value = {
                "loginId": loginId,
                "oldPassword": pssswd_old_encrypted.toString(),
                "newPassword": pssswd_encrypted.toString(),
                "newPassword2": pssswd_encrypted.toString(),
                "key": heartbeat
            };
               $.ajax({
                    url: 'getAPIData',
                    method: 'post',
                    data: {"_token": "{{ csrf_token() }}", action:action,url_action:url_action,menu: id, value: value},
                    success: function (data) {
                        $('#confirm').prop('disabled',false);
                        var result = JSON.parse(data);
                        if (result.status=="200") {
                            flash('success', result.message);
                            $('#submit_view').hide();
                            stateSuccess();
                        } else {
                            $('#submit_view').prop('disabled',false);
                            flash('warning', result.message);
                        }

                    }, error: function (xhr, ajaxOptions, thrownError) {
                        $('#confirm').prop('disabled',false);
                        flash('warning', 'Form Submit Failed');
                        console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                    }
                });

        }

        $('#confirm').on('click', function () {
            $('#form-area').validator('validate');
            if($('#form-area').validator('validate').has('.has-error').length!=0){
                return;
            }
            if($('#new_pwd').val()==""){
                $.alert({
                    title: 'Attention!',
                    content: 'New Password cannot empty.'
                });
                return;
            }
            if($('#new_pwd').val()!=$('#new_pwd_confirm').val()){
                $.alert({
                    title: 'Attention!',
                    content: 'Confirm New Password not match.'
                });
                return;
            }
            if($('.valid-txt').hasClass('error')){
                $.alert({
                    title: 'Attention!',
                    content: 'Password not valid.'
                });
                return;
            }
            $(this).prop('disabled',true);

            var content='{{trans('form.confirm_chpass')}}';

            $.confirm({
                title: '{{trans('form.submit')}}',
                content: content,
                buttons: {

                    cancel: {
                        text: '{{trans('form.cancel')}}',
                        btnClass: 'btn-default',
                        action: function(){
                            $('#confirm').prop('disabled',false);
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

        $('#back_view').on('click', function () {
            $(this).prop('disabled',true);
            if($('#state').val() == 'success'){
                app.setView(id,'landing')
            }else{
            $('#back_view').prop('disabled',false);
            stateEdit();
            }
        });


        $('.back').on('click', function () {
            $(this).prop('disabled',true);
            if ($('#type').val() == 'add') {
                app.setView(id,'landing')
            } else {
                var code = $('#code_edit').val();
                var res = app.setView(id,'detail');
                if(res=='done'){
                    $('#code').val(code);
                    getMatrix();
                }
            }
        });

        $('input[type="password"]').alphanum({
            allow : ',._!@',
            allowSpace: false
        });
    });

        function stateEdit() {
            //oTable.column(0).visible(true);
            $('.parent_menu_name').show();

            $('input:checkbox').prop('disabled','');
            $('#state').val('edit');
            $('.state_view').hide();
            $('.state_edit').show();
            $('span.state_view').text('-');
            $("#list").find("tbody tr").each(function () {

                $('td:eq(0)', $(this)).parent().show();

            });
            //groupColumn();
        }

        function stateView() {
            $('#state').val('view');
            $('.parent_menu_name').show();
            //groupColumn();
            $('input:checkbox').prop('disabled','disabled');
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
            $('#back_view').html("{{trans('form.done')}}");
        }



</script>