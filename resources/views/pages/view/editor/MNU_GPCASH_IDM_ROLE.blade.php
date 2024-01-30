@include('_partials.header_content',['breadcrumb'=>['Role Configuration','add']])


<section class="content">
    <div  class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div id="print" class="box">
                <div class="box-header state_view">
                    <span id="preview" class="state_view" style="color:darkred;display:none;"><small><i>Preview</i></small></span>
                </div>
                <div class="box-header">
                     <h3 class="box-title">Role Configuration Editor</h3>
                </div>
                <form class="form-horizontal">
                <input type="hidden" id="code_edit" value=""/>
                <input type="hidden" id="type" value=""/>
                <input type="hidden" id="state" value=""/>
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Code</label>
                                <div class="col-md-6">
                                    <input type="text" id="code" name="code" class="form-control state_edit" autocomplete="off" value="">
                                    <span id="code_view" class="state_view"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Name</label>

                                <div class="col-md-6">
                                    <input type="text" id="name" name="name" class="form-control state_edit" autocomplete="off" value="">
                                    <span id="name_view" class="state_view"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Description</label>

                                <div class="col-md-6">
                                    <textarea type="text" id="dscp" name="dscp" class="form-control state_edit" autocomplete="off" value=""></textarea>
                                    <span id="dscp_view" class="state_view"></span>
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
                    

                        <div class="box-footer state_edit">
                            <button type="button" id="back" name="back" class="btn btn-default back float-left">@lang('form.back')</button>
                            <button type="button" id="confirm" name="confirm" class="btn btn-success float-right">@lang('form.confirm')</button>
                        </div>
                        <div class="box-footer state_view" style="display:none;">
                            <button type="button" id="back_view" name="back_view" class="btn btn-default float-left">@lang('form.back')</button>
                            <div class="float-right">
                                 <button type="button" id="save_screen" name="save_screen" class="btn btn-primary" style="display:none">Save Screen</button>
                                 <button type="button" id="submit_view" name="submit_view" class="btn btn-success">@lang('form.submit')</button>
                            </div>
                        </div>


            </div>
        </div>
    </div>

</section>

<script>
    var oTable;
    var id = 'MNU_GPCASH_IDM_ROLE';
    var menu_parent = [];
    $(document).ready(function () {
        var submit_data;
        getParentMenu();


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
                        if (result.hasOwnProperty("referenceNo")) {
                            flash('success', 'ReferenceNo: '+ result.referenceNo+', '+result.message);
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
            }else{
                $.ajax({
                    url: 'edit',
                    method: 'post',
                    data: {"_token": "{{ csrf_token() }}", menu: id, value: value},
                    success: function (data) {
                        $('#submit_view').prop('disabled',false);
                        var result = JSON.parse(data);
                        if (result.hasOwnProperty("referenceNo")) {
                            flash('success', 'ReferenceNo: '+ result.referenceNo+', '+result.message);
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
        }

        $('#confirm').on('click', function () {
            submit_data = getTreeData();
            //console.log(submit_data);
            stateView();
        });

        $('#back_view').on('click', function () {
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
            if ($('#type').val() == 'add') {
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
            } else {
                $.ajax({
                    url: 'getDetail/' + id,
                    method: 'post',
                    success: function (data) {
                        $('.back').prop('disabled',false);
                        $(window).scrollTop(0);
                        var code = $('#code_edit').val();
                        $('#content-ajax').html(data);
                        $('#code').val(code);
                        getParentMenu();

                    }, error: function (xhr, ajaxOptions, thrownError) {
                        $('.back').prop('disabled',false);
                        console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                    }
                });
            }
        });
    });

    function getParentMenu() {

        var url_action = 'searchMenu';
        var action = 'SEARCH';
        var menu = 'MNU_GPCASH_IDM_ROLE_MENU';
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data: {menu:menu,url_action:url_action,action:action},
            success: function (data) {

                var result = JSON.parse(data);
                var detail = result.result;
                var html = '<ul>';
                //console.log(detail);
                html += '<li id="root">ROOT';
                html += '<ul>';
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

                html += '</ul>';
                html += '</li>';
                html += '</ul>';
                $('#menu_access').html(html);
                //console.log(html);


            }, error: function (xhr, ajaxOptions, thrownError) {
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

                    var detail = result.result[0].menuCodeList;
                    $('#code').val(result.result[0].code);
                    $('#name').val(result.result[0].name);
                    $('#dscp').val(result.result[0].dscp);
                    //console.log(detail);
                    $.each(detail, function (idx, obj){
                        $('#menu_access').jstree('select_node', obj.menuCode);
                    });

                   // stateEdit();

                }, error: function (xhr, ajaxOptions, thrownError) {
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

            $.each(menu, function (idx, obj) {
                if(obj.id!='root') {
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
            $('#state').val('edit');
            $('.state_view').hide();
            $('.state_edit').show();
            $('span.state_view').text('-');


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


            $('#preview').text('Preview');
            $('.state_edit').hide();
            $('.state_view').show();
            $('#code_view').text(code);
            $('#name_view').text(name);
            $('#dscp_view').text(dscp);


        }

        function stateSuccess() {
            $('#state').val('success');
            $('#code_1').val('');
            $('#name').val('');
            $('#dscp').val('');
            $('input.state_edit').val('');
            $('input.check').attr('checked', '');
            $('#back_view').html('{{trans('form.done')}}');
            $('save_screen').show();
        }


</script>