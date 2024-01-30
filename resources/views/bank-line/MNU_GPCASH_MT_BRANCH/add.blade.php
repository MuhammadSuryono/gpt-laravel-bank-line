@include('_partials.header_content',['breadcrumb'=>[str_replace('-',' ',$menu),$type]])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div class="box">
           <div class="box-header">
                     <h3 class="box-title">Branch Setup Detail</h3>
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
                                <label class="col-md-2 control-label"><strong>Branch Code&ast;</strong></label>
                                <div class="col-md-6">
                                    <input type="text" id="code" name="code" class="form-control state_edit numeric" autocomplete="off" value="" maxlength="40" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                    <label id="code_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label"><strong>Branch Name&ast;</strong></label>
                                <div class="col-md-6">
                                    <input type="text" id="name" name="name" class="form-control state_edit" autocomplete="off" value="" maxlength="100" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                    <label id="name_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label"><strong>Description&ast;</strong></label>
                                <div class="col-md-6">
                                    <input type="text" id="dscp" name="dscp" class="form-control state_edit" autocomplete="off" value="" maxlength="100" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                    <label id="dscp_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label"><strong>Contact Person&ast;</strong></label>
                                <div class="col-md-6">
                                    <input type="text" id="contact" name="contact" class="form-control state_edit   " autocomplete="off" value="" maxlength="100" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                    <label id="contact_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label"><strong>Email&ast;</strong></label>
                                <div class="col-md-6">
                                    <input type="email" id="email" name="email" class="form-control state_edit" autocomplete="off" value="" maxlength="100" data-error="This field is invalid." required>
                                    <div class="help-block with-errors"></div>
                                    <label id="email_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Address</label>
                                <div class="col-md-6">
                                    <input type="text" id="address1" name="address1" class="form-control state_edit" autocomplete="off" value="" maxlength="100">
                                    <!-- <div class="help-block with-errors"></div> -->
                                    <label id="address1_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label"><strong></strong></label>
                                <div class="col-md-6">
                                    <input type="text" id="address2" name="address2" class="form-control state_edit" autocomplete="off" value="" maxlength="100">
                                    <!-- <div class="help-block with-errors"></div> -->
                                    <label id="address2_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label"><strong></strong></label>
                                <div class="col-md-6">
                                    <input type="text" id="address3" name="address3" class="form-control state_edit" autocomplete="off" value="" maxlength="100">
                                    <!-- <div class="help-block with-errors"></div> -->
                                    <label id="address3_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label"><strong>City&ast;</strong></label>
                                <div class="col-md-4">
                                    <div class="city_setup state_edit"><select class="form-control"></select></div>
                                    <label id="city_setup_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label"><strong>Level&ast;</strong></label>
                                <div class="col-md-4">
                                    <div class="level_setup state_edit"><select class="form-control"></select></div>
                                    <label id="level_setup_view" class="state_view"></label>
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
    var levelOption;
    var cityOption;
    var submit_data;
    var id = '{{ $service }}';
    var noRef;
    $(document).ready(function () {
        $('.table-hidden').hide();

        $(document).validator().on('#form-area','submit', function (e) {
            if (e.isDefaultPrevented()) {
                // handle the invalid form...
            } else {
                // everything looks good!

            }
        });


        getCityDropList();
        getLevelDropList();
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
                "code": $('#code').val(),
                "name": $('#name').val(),
                "email": $('#email').val(),
                "dscp": $('#dscp').val(),
                "contactName": $('#contact').val(),
                "address1": $('#address1').val(),
                "address2": $('#address2').val(),
                "address3": $('#address3').val(),
                "cityCode": $('#city_list').val(),
                "cityName": $("#city_list option:selected").text(),
                "levelCode": $('#level_list').val(),
                "levelName": $("#level_list option:selected").text(),
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
            }else{
            $('#back_view').prop('disabled',false);
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
                    $('#code').val(code);
                    getMatrix();
                }
            }
        });

        $('#done').on('click', function () {
            $(this).prop('disabled',true);
            app.setView(id,'landing');
        });

        		
		$('.numeric').numeric({
            allowMinus: false,
            allowThouSep : false,
            allowDecSep : false,
        });
        
        $('input[type="text"]').not('.numeric').alphanum({
            allowSpace: true,
            allow : ',._!@'
        });
    });
    function getLevelDropList() {

        var url_action = 'searchLevelForDroplist';
        var action = 'SEARCH';
        var menu = 'MNU_GPCASH_MT_BRANCH';
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            type: 'json',
            data: {
                menu : menu,
                url_action : url_action,
                action : action,
                _token : '{{ csrf_token() }}'
            },
            success: function (data) {
                var result = JSON.parse(data);
                if (result.status=="200") {
                    levelOption = '<select id="level_list" class="form-control state_edit" required>';
                    levelOption += '<option value="" selected="selected">--Select Level--</option>';
                    $.each(result.result, function (idx, obj) {
                        levelOption += '<option value="' + obj.code + '">' + obj.name + '</option>';

                    });
                    levelOption += '</select>';
                    levelOption += '<div class="help-block with-errors"></div>';
                } else {
                    flash('warning', result.message);
                }


            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '{{trans('form.conn_error')}}';
                flash('warning', msg);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {
                $('.level_setup').html(levelOption);
            }
        });
    }

    function getCityDropList() {

        var url_action = 'searchCityForDroplist';
        var action = 'SEARCH';
        var menu = 'MNU_GPCASH_MT_BRANCH';
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            type: 'json',
            data: {
                menu : menu,
                url_action : url_action,
                action : action,
                _token : '{{ csrf_token() }}'
            },
            success: function (data) {
                var result = JSON.parse(data);
                if (result.status=="200") {
                    cityOption = '<select id="city_list" class="form-control state_edit" required>';
                    cityOption += '<option value="" selected="selected">--Select City--</option>';
                    $.each(result.result, function (idx, obj) {
                        cityOption += '<option value="' + obj.code + '">' + obj.name + '</option>';

                    });
                    cityOption += '</select>';
                    cityOption += '<div class="help-block with-errors"></div>';
                } else {
                    flash('warning', result.message);
                }



            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '{{trans('form.conn_error')}}';
                flash('warning', msg);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {
                $('.city_setup').html(cityOption);
            }
        });
    }

    function getBranchEdit(code_id){

        var url_action= 'search';
        var value ={
            code:code_id,
            name:'',
            currentPage: "1",
            pageSize: "20",
            orderBy: {"code": "ASC"}
        };
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data:{value:value,menu:id,action:'DETAIL',url_action:url_action},
            success: function (data) {

                var result = JSON.parse(data);
                if (result.status=="200") {
                    var index = result.result.map(function(o) { return o.code; }).indexOf(code_id.toString());
                    var detail = result.result[index];

                    $('#code').val(detail.code);
                    $('#code').prop('disabled',true)
                    $('#name').val(detail.name);
                    $('#dscp').val(detail.dscp);
                    $('#contact').val(detail.contactName);
                    $('#email').val(detail.email);
                    $('#address1').val(detail.address1);
                    $('#address2').val(detail.address2);
                    $('#address3').val(detail.address3);
                    $('#city_list').val(detail.cityCode).trigger('change');
                    $('#level_list').val(detail.levelCode).trigger('change');
                } else {
                    flash('warning', result.message);
                }

            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '{{trans('form.conn_error')}}';
                flash('warning', msg);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            },
            complete: function(data) {
                $('.table-hidden').show();

            }
        });

    }


        function stateEdit() {

            $('.parent_menu_name').show();

            $('input:checkbox').prop('disabled','');
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
            $('.parent_menu_name').show();

            $('input:checkbox').prop('disabled','disabled');
            var code = ($('#code').val() == '' ? '-' : $('#code').val());
            var name = ($('#name').val() == '' ? '-' : $('#name').val());
            var dscp = ($('#dscp').val() == '' ? '-' : $('#dscp').val());
            var contact = ($('#contact').val() == '' ? '-' : $('#contact').val());
            var email = ($('#email').val() == '' ? '-' : $('#email').val());
            var address1 = ($('#address1').val() == '' ? '-' : $('#address1').val());
            var address2 = ($('#address2').val() == '' ? '-' : $('#address2').val());
            var address3 = ($('#address3').val() == '' ? '-' : $('#address3').val());
            var city = ($('#city_list option:selected').text() == '' ? '-' : $('#city_list option:selected').text());
            var level = ($('#level_list option:selected').text() == '' ? '-' : $('#level_list option:selected').text());
            $('#preview').text('Preview');
            $('.state_edit').hide();
            $('.state_view').show();
            $('#code_view').text(code);
            $('#name_view').text(name);
            $('#dscp_view').text(dscp);
            $('#contact_view').text(contact);
            $('#email_view').text(email);
            $('#address1_view').text(address1);
            $('#address2_view').text(address2);
            $('#address3_view').text(address3);
            $('#city_setup_view').text(city);
            $('#level_setup_view').text(level);
            $('#save_screen').hide();
            $('.help-block').hide();
            $('#done').hide();
            $('#next_user').hide();

        }

        function stateSuccess() {
            $('#state').val('success');
            $('#code_1').val('');
            $('#name').val('');
            $('input.state_edit').val('');
            $('input.check').attr('checked', '');
            $('#back_view').hide();
            $('#save_screen').show();
            $('#done').show();
            $('#next_user').show();
        }


</script>