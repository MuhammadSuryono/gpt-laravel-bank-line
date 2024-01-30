@include('_partials.header_content',['breadcrumb'=>[str_replace('-',' ',$menu),$type]])


<section class="content">
    <div  class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div id="print" class="box">
                
                <div class="box-header">
                     <h3 class="box-title">Role Configuration </h3>
                </div>
                <form id="form-area" class="form-horizontal form-area">
                <input type="hidden" id="code_edit" value=""/>
                <input type="hidden" id="type" value=""/>
                <input type="hidden" id="state" value=""/>
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label"><strong>Role Code&ast;</strong></label>
                                <div class="col-md-6">
                                    <input type="text" id="code" name="code" class="form-control state_edit" autocomplete="off" value="" maxlength="40" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                    <label id="code_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label"><strong>Role Name&ast;</strong></label>

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
                                <label class="col-md-2 control-label">Menu Access</label>
                                <div class="col-md-6">
                                    <div class="container panel panel-default" style="height:300px;width:100%;overflow: scroll;overflow-x:hidden">
                                    <div id="menu_access">
                                        <!--menu Tree-->
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
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
        </div>
    </div>

</section>

<script>
    var oTable;
    var id = '{{ $service }}';
    var menu_parent = [];
    var noRef;

    $(document).ready(function () {
        var submit_data;
        getParentMenu();

        $('#form-area').validator().on('submit', function (e) {
            if (e.isDefaultPrevented()) {
                // handle the invalid form...
            } else {
                // everything looks good!

            }
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
                    }

                }
            });

        });

        function submitData(){
            var value ={
                code:$('#code').val(),
                name:$('#name').val(),
                dscp:$('#dscp').val(),
                menuCodeList: submit_data
            };
            if ($('#type').val() == 'add'){
                $.ajax({
                    url: 'add',
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
            }else{
                $.ajax({
                    url: 'edit',
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
        }

        $('#confirm').on('click', function () {
            $('#form-area').validator('validate');
            if($('#form-area').validator('validate').has('.has-error').length!=0){
                return;
            }
            submit_data = getTreeData();
            if(submit_data.length==0){
                var content ='{{trans('form.alert_empty',['label'=>'Menu Access'])}}';
                $.alert({
                    title: '{{trans('form.warning')}}',
                    content: content
                });
                return;
            }
            setTimeout(function(){
                stateView();
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

        $('#done').on('click', function () {
            $(this).prop('disabled',true);
            app.setView(id,'landing');
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
                    getParentMenu();
                }
            }
        });
        
        $('input[type="text"]').not('.numeric').alphanum({
            allowSpace: true,
            allow : ',._!@'
        });
    });

    function getParentMenu() {

        var url_action = 'searchMenu';
        var action = 'SEARCH';
        var menu = id;
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data: {menu:menu,url_action:url_action,action:action},
            success: function (data) {

                var result = JSON.parse(data);
                if (result.status=="200") {
                    var detail = result.result;
                    var html = '<ul>';
                    //console.log(detail);
                    html += '<li id="root">ROOT';
                    html += '<ul>';
                    if(detail){
                    $.each(detail, function (idx, parent) {
                        if($.inArray(parent.parentMenuCode, menu_parent) == -1){

                            menu_parent.push(parent.parentMenuCode);
                            html += '<li class="parent_node" id="'+parent.parentMenuCode+'">'+parent.parentMenuName;
                            html += '<ul>';
                            $.each(detail, function (idx2, child) {
                                if(child.parentMenuCode==parent.parentMenuCode){
                                    html += '<li class="child_node" id="'+child.menuCode+'">'+child.menuName+'</li>';
                                }
                            });
                            html += '</ul>';
                            html += '</li>';
                        }
                    });
                    }

                    html += '</ul>';
                    html += '</li>';
                    html += '</ul>';
                    $('#menu_access').html(html);
                    //console.log(html);
                } else {
                    flash('warning', result.message);
                }



            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '{{trans('form.conn_error')}}';
                flash('warning', msg);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            },
            complete: function (data) {
                $('#menu_access').jstree({
                    "core" : {
                        "themes" : {
                            "variant" : "large"
                        }
                    },
                    "plugins" : [ "checkbox" ]
                });
                $('#menu_access').on('ready.jstree', function() {
                    $("#menu_access").jstree("open_all");

                });
                stateEdit();
            }
        });
    }

        function getDataEdit(code_id) {

            var url_action= 'search';
            var value ={
                code:code_id,
                name: "",
                currentPage: "1",
                pageSize: "20",
                orderBy: {"code": "ASC"}
            };
            var menu = id;
            $.ajax({
                url: 'getAPIData',
                method: 'post',
                data: {
                    value : value,
                    menu : menu,
                    url_action : url_action,
                    action : 'DETAIL',
                    _token : '{{ csrf_token() }}'
                },
                success: function (data) {
                    var result = JSON.parse(data);
                    if (result.status=="200") {
						var index = result.result.map(function(o) { return o.code; }).indexOf(code_id.toString());
                        var detail = result.result[index].menuCodeList;
                        $('#code').val(result.result[index].code);
                        $('#name').val(result.result[index].name);
                        $('#dscp').val(result.result[index].dscp);
                        //console.log(detail);
                        if(detail){
                        $.each(detail, function (idx, obj){
                            if(obj.menuType != 'E'){
                                $('#menu_access').jstree('select_node', obj.menuCode);
                            }
                        });
                        }
                    } else {
                        flash('warning', result.message);
                    }


                   // stateEdit();

                }, error: function (xhr, ajaxOptions, thrownError) {
                    var msg = '{{trans('form.conn_error')}}';
                    flash('warning', msg);
                    console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                },
                complete: function (data) {
                    $('#code').attr('readonly','readonly');
                    //stateEdit();
                    //$('#name').attr('readonly','readonly');
                }
            });
        }

    function getTreeData() {
            var data = [];
            var menu = $("#menu_access").jstree("get_selected",true);
            if(menu){
            $.each(menu, function (idx, obj) {
                //console.log(obj);
                 if(obj.id!='root'&&obj.text!=''&&obj.parent!='root') {
                    /*if ($.inArray(obj.id, menu_parent) == -1){
                        var value = {
                            menuCode: obj.id,
                            menuName: obj.text
                        };
                    data.push(value);
                    }*/

                        var value = {
                            menuCode: obj.id,
                            menuName: obj.text
                        };
                        data.push(value);

                }
            });
            }
            //console.log(data);
            //return;
            return data;
        }

        function stateEdit() {
            $("#menu_access")
                    .jstree('get_json', '#', {
                        flat: true
                    })
                    .forEach(function(node) {
                        if (!node.state.selected && $('#' + node.a_attr.id).find('.jstree-undetermined').length === 0) {
                            $("#menu_access").jstree('get_node', node).state.hidden = false;
                        }
                    });

            $('#menu_access').jstree('redraw', true);
            $('#menu_access li').each( function() {
                $("#menu_access").jstree().enable_node(this.id);
            });
            $('.jstree-checkbox').show();
            $('.help-block').show();
            $('#state').val('edit');
            $('.state_view').hide();
            $('.state_edit').show();
            $('label.state_view').text('-');
            $('#save_screen').hide();
            $('#done').hide();
            $('#next_user').hide();

        }

        function stateView() {
            $('#state').val('view');
            $("#menu_access").jstree('get_json', '#', {
                        flat: true
                    }).forEach(function(node) {
                        if (!node.state.selected && $('#' + node.a_attr.id).find('.jstree-undetermined').length === 0) {
                            $("#menu_access").jstree('get_node', node).state.hidden = true;
                        }
            });

            $('#menu_access').jstree('redraw', true);
            $('#menu_access li').each( function() {
                $("#menu_access").jstree().disable_node(this.id);
            });
            $('.jstree-checkbox').hide();
            var code = ($('#code').val() == '' ? '-' : $('#code').val());
            var name = ($('#name').val() == '' ? '-' : $('#name').val());
            var dscp = ($('#dscp').val() == '' ? '-' : $('#dscp').val());


            
            $('.state_edit').hide();
            $('.state_view').show();
            $('.help-block').hide();
            $('#code_view').text(code);
            $('#name_view').text(name);
            $('#dscp_view').text(dscp);
            $('#save_screen').hide();
            $('#done').hide();
            $('#next_user').hide();
        }

        function stateSuccess() {
            $('#state').val('success');
            $('#code_1').val('');
            $('#name').val('');
            $('#dscp').val('');
            $('input.state_edit').val('');
            $('input.check').attr('checked', '');
            $('#back_view').hide();
            $('#save_screen').show();
            $('#done').show();
            $('#next_user').show();
        }


</script>