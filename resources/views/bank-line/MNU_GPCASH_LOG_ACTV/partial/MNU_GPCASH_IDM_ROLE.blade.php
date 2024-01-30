				<div class="box-header">
                    <h3 class="box-title">Role Configuration Detail</h3><br>
                </div>

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

<script>
    var oTable;
	var menu_parent = [];
    $(document).ready(function () {       
	
        oTable = $('#list').DataTable({
            "paging" : false,
            "ordering" : false,
            "info": false,
            "destroy": true,
            "select": false,
            "searching": false,
            "autoWidth":false,
            "columnDefs": [
               {
                    targets: 0,
                    sortable: false,
                    width: "250px"
                },
                {
                    targets: 1,
                    sortable: false,
                    width: "100px"
                },
                {
                    targets: 2,
                    sortable: false,
                    width: "100px"
                }

            ]
        });
		
		getData();
    });

	function getData(){
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
                getData2('MNU_GPCASH_LOG_ACTV');
            }
        });
	}
	
    function getData2(id){
        var pendingTaskId_id= $('#pendingTaskId').val();
        var url_action= 'detailPendingTask';
         var value ={
            pendingTaskId:pendingTaskId_id,
            currentPage: "1",
            pageSize: "20",
            orderBy: {"code": "ASC"}
        };
        var action = 'DETAIL';
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data: {
                value : value,
                menu : id,
                url_action : url_action,
                action : action,
                _token : '{{ csrf_token() }}'
            },
            success: function (data) {
                var result = JSON.parse(data);
                if (result.status=="200") {
                    var detail = result.details.menuCodeList;
                    $('#code_1').text(result.details.code);
                    $('#name').text(result.details.name);
                    $('#dscp').text(result.details.dscp);

                    if(detail){

                    $.each(detail, function (idx, obj){
                        $('#menu_access').jstree('select_node', obj.menuCode);
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
                        //$("#menu_access").jstree('get_node', node).state.hidden = true;
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