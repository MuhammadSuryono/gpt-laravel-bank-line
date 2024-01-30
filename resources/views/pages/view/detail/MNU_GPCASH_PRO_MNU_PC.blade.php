@include('_partials.header_content',['breadcrumb'=>['menu setup','detail']])

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
                    <h3 class="box-title">Menu Setup Detail</h3><br>
                </div>
                <form class="form-horizontal">
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Menu Setup Code</label>
                                <div class="col-md-6">
                                    <label id="code_1">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Menu Setup Name</label>
                                <div class="col-md-6">
                                    <label id="name">-</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
                    <div class="box-header">
                        <h3 class="box-title table-hidden">Menu Setup Listing</h3>
                    </div>
                    <div class="container-fluid">
                        <div class="box-body">
                           <div class="row table-hidden">
                               <div class="form-group">
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th align="center"><strong>Menu Group</strong></th>
                                        <th align="center"><strong>Menu</strong></th>

                                    </tr>
                                    </thead>
                                    <tbody><tr>
                                        <td align="left"></td>
                                        <td align="left"></td>

                                    </tr>
                                    </tbody>
                                </table>
                               </div>
                               <div class="form-group">
                                   <div class="state_view">
                                          <div class="col-md-12 state_view text-center">
                                               <button type="button" id="edit" name="edit" class="btn btn-default">@lang('form.edit')</button>
                                               <button type="button" id="delete" name="delete" class="btn btn-default">@lang('form.delete')</button>
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
    var oTable;
    var currencyOption;
    var id = 'MNU_GPCASH_PRO_MNU_PC';
    $(document).ready(function () {
        $('.table-hidden').hide();
        $('.state_delete').hide();


        oTable = $('#list').DataTable({
            "paging" : false,
            "ordering" : false,
            "info": false,
            "destroy": true,
            "select": false,
            "searching": false,
            "autoWidth":false,
            "lengthMenu": [[10, 25, 50], [10, 25, 50]],
            "columnDefs": [

                {
                    targets: 0,
                    sortable: false,
                    width: "50%"
                },
                {
                    targets: 1,
                    sortable: false,
                    width: "50%"
                }

            ]
        });


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
                    getMatrixEdit(code);

                }, error: function (xhr, ajaxOptions, thrownError) {
                    $('#edit').prop('disabled',false);
                    console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                }
            });
        });

        $('#delete').on('click', function () {
           // $('.state_view').hide();
           // $('.state_delete').show();
            $(this).prop('disabled',true);
            $.confirm({
                title: '{{trans('form.delete')}}',
                content: '{{trans('form.confirm_delete')}}',
                buttons: {
                    confirm: {
                        text: '{{trans('form.delete')}}',
                        btnClass: 'btn-danger',
                        action: function(){
                            submit_delete();
                        }
                    },
                    cancel: {
                        text: '{{trans('form.cancel')}}',
                        btnClass: 'btn-default',
                        action: function(){
                            $('#delete').prop('disabled',false);
                        }
                    }

                }
            });
        });

        function submit_delete () {
            var submit_data = getTableData();

            var value = {
                "code": $('#code').val(),
                "name": $('#name').text(),
                "menuList": submit_data
            };
            $.ajax({
                url: 'delete',
                method: 'post',
                data: {"_token": "{{ csrf_token() }}", menu: id, value: value,url_action:'submitDelete'},
                success: function (data) {
                    $('#delete').prop('disabled',false);
                    var result = JSON.parse(data);
                    if (result.hasOwnProperty("referenceNo")) {
                        flash('success', result.message);
                        $('#submit_view').hide();
                        $('#detail').show();
                        $('#detail').text('ReferenceNo: ' + result.referenceNo);
                        $('#edit').hide();
                        $('#delete').hide();
                        $('#back').html('{{trans('form.done')}}');
                    } else {
                        $('#delete').prop('disabled',false);
                        flash('warning', 'Form Submit Failed');
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

    function getMatrix(){
        var code_id= $('#code').val();
        var url_action= 'searchMenuPackageDetailByCode';
        var value ={code:code_id};
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data:{value:value,menu:id,action:'DETAIL',url_action:url_action},
            success: function (data) {

                var result = JSON.parse(data);

                var detail = result.menuList;
                $('#code_1').text(result.code);
                $('#name').text(result.name);
                oTable.clear();

                $.each(detail, function (idx, obj){
                            oTable.row.add([
                                '<span id="parent_menu_name" class="parent_menu_name">'+obj.parentMenuName +'</span>',
                                '<span id="menu_name" class="menu_name">'+obj.menuName+'</span>'
                        ]).draw(false);

                });

            }, error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            },
            complete: function(data) {
                $('.table-hidden').show();
                groupColumn();
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

    function groupColumn(){
        $("#list").find("tbody tr:visible").each(function () {

            var current_value = $(this).children().eq(0).find('span').text();
            var next_value = $(this).next().children().eq(0).find('span').text();

            if (next_value==current_value) {
                $(this).next().children().eq(0).find('span').hide();
            }
        });
    }

</script>