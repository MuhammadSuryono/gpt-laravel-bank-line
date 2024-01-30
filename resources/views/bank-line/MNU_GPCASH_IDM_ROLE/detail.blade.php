@include('_partials.header_content',['breadcrumb'=>[str_replace('-',' ',$menu),'detail']])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <input type="hidden" id="code" value=""/>
            <div class="box">
                
                
                <div class="box-header">
                    <h3 class="box-title">Role Configuration Detail</h3><br>
                </div>
                <form class="form-horizontal">
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Role Code</label>
                                <div class="col-md-6">
                                    <label id="code_1">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Role Name</label>
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
                <div class="box-footer">
                    <div class="float-left">
                        <button type="button" id="back" name="back" class="btn btn-default back">@lang('form.back')</button>
						<button type="button" id="save_screen" name="save_screen" class="btn btn-default" style="display:none" onclick="save_pdf();">@lang('form.save_pdf')</button>
                    </div>
                    <div class="float-right">
						<button type="button" id="next_user" name="next_user" class="btn btn-info">@lang('form.next_user')</button>
						<button type="button" id="done" name="done" class="btn btn-primary" style="display:none">@lang('form.done')</button>
                        <button type="button" id="delete" name="delete" class="btn btn-danger">@lang('form.delete')</button>
                        <button type="button" id="edit" name="edit" class="btn btn-primary">@lang('form.edit')</button>
                    </div>
                </div>
                </form>

                 @include('_partials.next_user') 
            </div>
        </div>
    </div>

</section>

<script>


    var menu_parent = [];
    var id = '{{ $service }}';
    var menu_code_list;
	var noRef;
    $(document).ready(function () {
        $('.state_delete').hide();
        $('#edit').on('click', function () {
            var code = $('#code').val();
            var res = app.setView(id,'add');
            if(res=='done'){
                $('#type').val('edit');
                $('#breadcrumb-action').html('edit');
                $('#code_edit').val(code);
                getDataEdit(code);
            }
        });

        $('#delete').on('click', function () {
            // $('.state_view').hide();
            // $('.state_delete').show();
            $(this).prop('disabled',true);
            $.confirm({
                title: '{{trans('form.delete')}}',
                content: '{{trans('form.confirm_delete')}}',
                buttons: {

                    cancel: {
                        text: '{{trans('form.cancel')}}',
                        btnClass: 'btn-default',
                        action: function(){
                            $('#delete').prop('disabled',false);
                        }
                    },
                    confirm: {
                        text: '{{trans('form.delete')}}',
                        btnClass: 'btn-primary',
                        action: function(){
                            submit_delete();
                        }
                    },

                }
            });
        });

        function submit_delete () {

            var value = {
                "code": $('#code').val(),
                "name": $('#name').text(),
                "dscp":$('#dscp').text(),
                "menuCodeList":menu_code_list
            };
            $.ajax({
                url: 'delete',
                method: 'post',
                data: {"_token": "{{ csrf_token() }}", menu: id, value: value,url_action:'submitDelete'},
                success: function (data) {
                    $('#delete').prop('disabled',false);
                    var result = JSON.parse(data);
                    if (result.status=="200") {
                        flash('success', result.message+'<br>'+'ReferenceNo: '+ result.referenceNo+'<br>'+result.dateTimeInfo);
                        $('#submit_view').hide();
                        
						noRef=result.referenceNo;
						
                        $('#edit').hide();
                        $('#delete').hide();
						$('#back').hide();
						$('#save_screen').show();
						$('#next_user').show();
                        $('#done').show();
                    } else {
                        $('#delete').prop('disabled',false);
                        flash('warning', result.message);
                    }

                }, error: function (xhr, ajaxOptions, thrownError) {
                    $('#delete').prop('disabled',false);
                    flash('warning', 'Form Submit Failed');
                    console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                }
            });
        }

        $('#back_delete').on('click', function () {
            $('.state_delete').hide();
            $('.state_view').show();
        });

        $('.back').on('click', function () {
            app.setView(id,'landing');
        });
		
		$('#save_screen').hide();
		$('#next_user').hide();
        $('#done').hide();
						
		
		
		$('#done').on('click', function () {
            var res = app.setView(id,'landing');
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
                } else {
                    flash('warning', result.message);
                }

                //console.log(html);


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
                getData();
            }
        });
    }

    function getData(){
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
                if (result.status=="200") {
                    //var index = result.result.map(function(o) { return o.code; }).indexOf(code.toString());
                    var index = 0;
                    menu_code_list = result.result[index].menuCodeList;
                    var detail = result.result[index].menuCodeList;
                    $('#code_1').text(result.result[index].code);
                    $('#name').text(result.result[index].name);
                    $('#dscp').text(result.result[index].dscp);
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


            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '{{trans('form.conn_error')}}';
                flash('warning', msg);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            },
            complete: function(data) {
                $("#menu_access").jstree('get_json', '#', {
                    flat: true
                }).forEach(function(node) {
                   // if (!node.state.selected && $('#' + node.a_attr.id).find('.jstree-undetermined').length === 0) {
                       // $("#menu_access").jstree('get_node', node).state.hidden = true;
                   // }
                });

                $('#menu_access').jstree('redraw', true);
                $('#menu_access li').each( function() {
                    $("#menu_access").jstree().disable_node(this.id);
                });
                //$('.jstree-checkbox').hide();
                $("#menu_access").show();
            }
        });
    }


</script>