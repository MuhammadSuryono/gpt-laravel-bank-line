<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Ongoing Task
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#" class="back"><i class="fa fa-dashboard"></i> Ongoing Task</a></li>
        <li class="active">Role Configuration Detail</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <input type="hidden" id="referenceNo" value=""/>
            <input type="hidden" id="taskId" value=""/>
            <div class="box">
                
                <div class="box-header detail" style="display:none">
                    <span id="detail" class="detail" style="color:darkred;"><small><i>Detail</i></small></span>
                </div>
                <div class="box-header">
                    <h3 class="box-title">Role Configuration Detail</h3><br>
                </div>
                <form class="form-horizontal">
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Code</label>
                                <div class="col-md-6">
                                    <label id="code_1">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Name</label>
                                <div class="col-md-6">
                                    <label id="name">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Description</label>
                                <div class="col-md-6">
                                    <label id="dscp">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Menu Access</label>
                                <div class="col-md-6">
                                    <div class="container panel panel-default" style="height:300px;width:100%;overflow: scroll;overflow-x:hidden">
                                        <div id="menu_access" style="display:none;">
                                            <!--menu Tree-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                        <div class="box-body">
                           <div class="row table-hidden">
                               <div class="form-group">
                                   <div class="state_view">
                                           <div class="col-md-12 state_view text-center">
                                               <button type="button" id="approve" name="approve" class="btn btn-success">@lang('form.approve')</button>
                                               <button type="button" id="reject" name="reject" class="btn btn-danger">@lang('form.reject')</button>
                                               <button type="button" id="back" name="back" class="btn btn-default back">@lang('form.back')</button>
                                           </div>
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
    var menu_parent = [];
    var id = 'MNU_GPCASH_IDM_ROLE';
    $(document).ready(function () {


        $('#approve').on('click', function () {
            $('#approve').prop('disabled',true);
            $.confirm({
                title: '{{trans('form.confirm')}}',
                content: '{{trans('form.confirm_approve')}}',
                buttons: {
                    confirm: {
                        text: '{{trans('form.confirm')}}',
                        btnClass: 'btn-danger',
                        action: function(){
                            submitTask('approve');
                        }
                    },
                    cancel: {
                        text: '{{trans('form.cancel')}}',
                        btnClass: 'btn-default',
                        action: function(){
                            $('#approve').prop('disabled',false);
                        }
                    }

                }
            });
        });

        $('#reject').on('click', function () {
            $('#reject').prop('disabled',true);
            $.confirm({
                title: '{{trans('form.confirm')}}',
                content: '{{trans('form.confirm_reject')}}',
                buttons: {
                    confirm: {
                        text: '{{trans('form.confirm')}}',
                        btnClass: 'btn-danger',
                        action: function(){
                            submitTask('reject');
                        }
                    },
                    cancel: {
                        text: '{{trans('form.cancel')}}',
                        btnClass: 'btn-default',
                        action: function(){
                            $('#reject').prop('disabled',false);
                        }
                    }

                }
            });
        });

        $('.back').on('click', function () {
            $(this).prop('disabled',true);
            $.ajax({
                url: 'getView/MNU_GPCASH_PENDING_TASK',
                method: 'post',
                success: function (data) {
                    $('.back').prop('disabled',true);
                    $(window).scrollTop(0);
                    $('#content-ajax').html(data);


                }, error: function (xhr, ajaxOptions, thrownError) {
                    var msg = '{{trans('form.conn_error')}}';
                    flash('warning', msg);
                    $('.back').prop('disabled',true);
                    console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                }
            });
        });

    });

    function getData2() {

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
                getDataTree();
            }
        });
    }

    function getData(){
        var referenceNo = $('#referenceNo').val();
        var value = {
            referenceNo : referenceNo
        };
        var url_action = 'detailPendingTask';
        var action = 'DETAIL';
        var menu = 'MNU_GPCASH_PENDING_TASK';
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

                if(result.referenceNo == undefined){
                    return;
                }
                var detail = result.details.menuCodeList;
                $('#code_1').text(result.details.code);
                $('#name').text(result.details.name);
                $('#dscp').text(result.details.dscp);
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

            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '{{trans('form.conn_error')}}';
                flash('warning', msg);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            },
            complete: function(data) {
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
                getDataTree();
            }
        });
    }

    function getDataTree(){
        var code_id= $('#code').val();
        var url_action= 'search';
        var value ={
            code:code_id,
            name: "",
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

                var detail = result.result[0].menuCodeList;
                $('#code_1').text(result.result[0].code);
                $('#name').text(result.result[0].name);
                $('#dscp').text(result.result[0].dscp);
                //console.log(detail);
                $.each(detail, function (idx, obj){
                    $('#menu_access').jstree('select_node', obj.menuCode);
                });

            }, error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            },
            complete: function(data) {
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
                $("#menu_access").show();
            }
        });
    }



    function submitTask(type){
        var id = 'MNU_GPCASH_PENDING_TASK';
        var value = {
            "referenceNo": $('#referenceNo').val(),
            "taskId": $('#taskId').val()
        };

        var action;
        var url_action;
        if(type=='approve'){
            action = 'APPROVE';
            url_action = 'approve';
        }else if(type=='reject'){
            action = 'REJECT';
            url_action = 'reject';
        }else{
            return;
        }

        $.ajax({
            url: 'detail',
            method: 'post',
            data: {"_token": "{{ csrf_token() }}", menu: id, value: value,url_action:url_action,action:action},
            success: function (data) {
                var result = JSON.parse(data);
                $(window).scrollTop(0);
                $('.detail').show();
                $('#detail').text('ReferenceNo: ' + result.referenceNo);
                $('#approve').hide();
                $('#reject').hide();
                $('#back').html('{{trans('form.done')}}');
                flash('success','{{trans('form.pending_success')}}');
                $('#approve').prop('disabled',false);
                $('#reject').prop('disabled',false);

            }, error: function (xhr, ajaxOptions, thrownError) {
                $(window).scrollTop(0);
                $('#approve').prop('disabled',false);
                $('#reject').prop('disabled',false);
                flash('warning','{{trans('form.pending_error')}}');
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }
        });
    }


</script>