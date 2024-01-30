@include('_partials.header_content',['breadcrumb'=>['Service setup','add']])


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
                     <h3 class="box-title">Service Setup Editor</h3>
                </div>
                <form class="form-horizontal">
                <input type="hidden" id="code_edit" value=""/>
                <input type="hidden" id="type" value=""/>
                <input type="hidden" id="state" value=""/>
                <input type="hidden" id="submit_mode" value=""/>
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Service Setup Code</label>
                                <div class="col-md-6">
                                    <input type="text" id="code" name="code" class="form-control state_edit" autocomplete="off" value="">
                                    <span id="code_view" class="col-md-2 state_view"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Service Setup Name</label>
                                <div class="col-md-6">
                                    <input type="text" id="name" name="name" class="form-control state_edit" autocomplete="off" value="">
                                    <span id="name_view" class="col-md-2 state_view"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Fee Setup</label>
                                <div class="col-md-4">
                                    <div class="fee_setup state_edit"><select class="form-control"></select></div>
                                    <span id="fee_setup_view" class="col-md-2 state_view"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Limit Setup</label>
                                <div class="col-md-4">
                                    <div class="limit_setup state_edit"><select class="form-control"></select></div>
                                    <span id="limit_setup_view" class="col-md-2 state_view"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Menu Setup Name</label>
                                <div class="col-md-4">
                                    <div class="menu_setup state_edit"><select class="form-control"></select></div>
                                    <span id="menu_setup_view" class="col-md-2 state_view"></span>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12 state_edit text-center">
                                <button type="button" id="submit_add" name="submit_add" class="btn btn-default">@lang('form.submit_add')</button>
                                <button type="button" id="submit" name="submit" class="btn btn-default">@lang('form.submit')</button>
                                <button type="button" id="back" name="back" class="btn btn-default back">@lang('form.back')</button>
                            </div>
                            <div class="col-md-12 state_view text-center">
                                <button type="button" id="submit_view" name="submit_view" class="btn btn-danger">@lang('form.submit')</button>
                                <button type="button" id="back_view" name="back_view" class="btn btn-default">@lang('form.back')</button>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

</section>

<script>
    var oTable;
    var limitOption;
    var feeOption;
    var menuOption;
    var id = 'MNU_GPCASH_PRO_SRVC_PC';
    $(document).ready(function () {
        $('.table-hidden').hide();


        var submit_data;
        getFeeDropList();
        getLimitDropList();
        getMenuDropList();
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
                "chargePackageCode": $('#fee_list').val(),
                "chargePackageName": $("#fee_list option:selected").text(),
                "limitPackageCode": $('#limit_list').val(),
                "limitPackageName": $("#limit_list option:selected").text(),
                "menuPackageCode": $('#menu_list').val(),
                "menuPackageName": $("#menu_list option:selected").text()
            };
             $.ajax({
                    url: 'add',
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


        $('#submit').on('click', function () {
            $('#submit_type').val('submit');
            stateView();
        });

        $('#submit_add').on('click', function () {
            $('#submit_type').val('submit_add');
            stateView();
        });

        $('#back_view').on('click', function () {
            $(this).prop('disabled',true);

            if($('#state').val() == 'success'){
                var url = '';
                if($('#submit_type').val()=='submit'){
                    url = 'getView/';
                }else{
                    url = 'getEditor/';
                }
                $.ajax({
                    url: url+id,
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
    function getLimitDropList() {

        var url_action = 'searchLimit';
        var action = 'SEARCH';
        var menu = 'MNU_GPCASH_PRO_SRVC_PC';
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

                limitOption = '<select id="limit_list" class="form-control state_edit">';
                $.each(result.result, function (idx, obj) {
                    limitOption += '<option value="' + obj.code + '" selected="selected">' + obj.name + '</option>';

                });
                limitOption += '</select>';


            }, error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {
                $('.limit_setup').html(limitOption);
            }
        });
    }

    function getFeeDropList() {

        var url_action = 'searchCharge';
        var action = 'SEARCH';
        var menu = 'MNU_GPCASH_PRO_SRVC_PC';
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

                feeOption = '<select id="fee_list" class="form-control state_edit">';
                $.each(result.result, function (idx, obj) {
                    feeOption += '<option value="' + obj.code + '" selected="selected">' + obj.name + '</option>';

                });
                feeOption += '</select>';


            }, error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {
                $('.fee_setup').html(feeOption);
            }
        });
    }

    function getMenuDropList() {

        var url_action = 'searchMenu';
        var action = 'SEARCH';
        var menu = 'MNU_GPCASH_PRO_SRVC_PC';
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

                menuOption = '<select id="menu_list" class="form-control state_edit">';
                $.each(result.result, function (idx, obj) {
                    menuOption += '<option value="' + obj.code + '" selected="selected">' + obj.name + '</option>';
                });
                menuOption += '</select>';


            }, error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {
                $('.menu_setup').html(menuOption);
            }
        });
    }


        function stateEdit() {

            $('.parent_menu_name').show();

            $('input:checkbox').prop('disabled','');
            $('#state').val('edit');
            $('.state_view').hide();
            $('.state_edit').show();
            $('span.state_view').text('-');

        }

        function stateView() {
            $('#state').val('view');
            $('.parent_menu_name').show();

            $('input:checkbox').prop('disabled','disabled');
            var code = ($('#code').val() == '' ? '-' : $('#code').val());
            var name = ($('#name').val() == '' ? '-' : $('#name').val());
            var fee = ($('#fee_list option:selected').text() == '' ? '-' : $('#fee_list option:selected').text());
            var limit = ($('#limit_list option:selected').text() == '' ? '-' : $('#limit_list option:selected').text());
            var menu = ($('#menu_list option:selected').text() == '' ? '-' : $('#menu_list option:selected').text());
            $('#preview').text('Preview');
            $('.state_edit').hide();
            $('.state_view').show();
            $('#code_view').text(code);
            $('#name_view').text(name);
            $('#fee_setup_view').text(fee);
            $('#limit_setup_view').text(limit);
            $('#menu_setup_view').text(menu);


        }

        function stateSuccess() {
            $('#state').val('success');
            $('#code_1').val('');
            $('#name').val('');
            $('input.state_edit').val('');
            $('input.check').attr('checked', '');
            $('#back_view').html('{{trans('form.done')}}');

        }

</script>