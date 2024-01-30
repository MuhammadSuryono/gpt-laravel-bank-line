@include('_partials.header_content',['breadcrumb'=>['Role Configuration','detail']])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <input type="hidden" id="code" value=""/>
            <div class="box">
                
                <div class="box-header detail">
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
                </form>

                    <div class="container-fluid">
                        <div class="box-body">
                           <div class="row">
                               <div class="form-group">
                                   <div class="state_view">
                                          <div class="col-md-12 state_view text-center">
                                               <button type="button" id="edit" name="edit" class="btn btn-default">@lang('form.edit')</button>
                                               <button type="button" id="back" name="back" class="btn btn-default back">@lang('form.back')</button>
                                           </div>
                                   </div>
                               </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

</section>

<script>


    var menu_parent = [];
    var id = 'MNU_GPCASH_IDM_ROLE';
    $(document).ready(function () {
        $('#edit').on('click', function () {
            $(this).prop('disabled',true);
            $.ajax({
                url: 'getEditor/' + id,
                method: 'post',
                success: function (data) {
                    $('#edit').prop('disabled',false);
                    $(window).scrollTop(0);
                    var code = $('#code_1').text();
                    $('#content-ajax').html(data);
                    $('#type').val('edit');
                    $('#code_edit').val(code);
                    getDataEdit(code);

                }, error: function (xhr, ajaxOptions, thrownError) {
                    $('#edit').prop('disabled',false);
                    console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                }
            });
        });

        $('.back').on('click', function () {
            $(this).prop('disabled',true);
            $.ajax({
                url: 'getView/'+id,
                method: 'post',
                success: function (data) {
                    $('.back').prop('disabled',true);
                    $(window).scrollTop(0);
                    $('#content-ajax').html(data);


                }, error: function (xhr, ajaxOptions, thrownError) {
                    $('.back').prop('disabled',true);
                    console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                }
            });
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

    function getTableData() {
        var data = [];

        $("#list").find("tbody tr").each(function () {

            var parent_menu_name = $(this).children().eq(0).find('#parent_menu_name').text();
            var menu_name = $('td:eq(1)', $(this)).find('#menu_name').text();
            var obj = {
                parentMenuName: parent_menu_name,
                menuName: menu_name
            };

            data.push(obj);

        });
        return data;
    }


</script>