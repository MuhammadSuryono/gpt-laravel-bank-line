@include('_partials.header_content',['breadcrumb'=>[str_replace('-',' ',$menu),$type]])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div class="box">
                <div id="spinner" style="display:none"></div>
                
                <div class="box-header">
                     <h3 class="box-title">Menu Setup Detail</h3>
                </div>
                <form id="form-area" class="form-horizontal form-area">
                <input type="hidden" id="code_edit" value=""/>
                <input type="hidden" id="type" value=""/>
                <input type="hidden" id="state" value=""/>
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label"><strong>Menu Setup Code&ast;</strong></label>
                                <div class="col-md-6">
                                    <input type="text" id="code" name="code" class="form-control state_edit" autocomplete="off" value="" maxlength="40" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                    <label id="code_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label"><strong>Menu Setup Name&ast;</strong></label>

                                <div class="col-md-6">
                                    <input type="text" id="name" name="name" class="form-control state_edit" autocomplete="off" value="" maxlength="100" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                    <label id="name_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                </form>
                    <div class="box-header">
                        <h3 class="box-title table-hidden">Menu Setup Listing</h3>
                    </div>
                    <div class="box-body">
                        
                           
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>

                                        <th align="center"><strong>Menu Group</strong></th>
                                        <th align="center"><strong>Menu</strong></th>
                                        <th align="center"></th>

                                    </tr>
                                    </thead>
                                </table>
                           
                        
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
            </div>
        </div>
    </div>

</section>

<script>
    var oTable;
    var currencyOption;
    var id = '{{ $service }}';
    var noRef;
    $(document).ready(function () {
        $('.table-hidden').hide();

        $('#form-area').validator().on('submit', function (e) {
            if (e.isDefaultPrevented()) {
                // handle the invalid form...
            } else {
                // everything looks good!

            }
        });

        var submit_data;
        //getCurrency("IDR");

        oTable = $('#list').DataTable({
            "paging": false,
            "ordering": false,
            "info": false,
            "destroy": true,
            "select": {
                style: 'multi',
                selector: 'input.dt-checkboxes'
            },
            "searching": false,
            "autoWidth": false,
            "ScrollX": '100%',
            "lengthMenu": [[10, 25, 50], [10, 25, 50]],
            "columnDefs": [

                {
                    targets: 0,
                    sortable: false,
                    width: "34%"
                },
                {
                    targets: 1,
                    sortable: false,
                    width: "33%"
                },
                {
                    sortable: false,
                    width: "33%",
                    targets: 2,
                    checkboxes: {
                        selectRow: false,
                        selectAllPages: false
                    }
                }

            ]
        });

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
                    }

                }
            });

        });

        function submitData(){
            var value = {
                "code": $('#code').val(),
                "name": $('#name').val(),
                "menuList": submit_data
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
            if(countMenu()==0){
                var content ='{{trans('form.alert_empty',['label'=>'Menu'])}}';
                $.alert({
                    title: '{{trans('form.warning')}}',
                    content: content
                });
                return;
            }

            setTimeout(function(){
                submit_data = getTableData();
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

        $('input[type="text"]').not('.numeric').alphanum({
            allowSpace: true,
            allow : ',._!@'
        });
    });
        function getMatrixAdd() {

            var url_action = 'searchMenu';
            var action = 'SEARCH';
            var menu = id;
            $.ajax({
                url: 'getAPIData',
                method: 'post',
                async: false,
                data: {menu:menu,url_action:url_action,action:action},
                success: function (data) {

                    var result = JSON.parse(data);
                    if (result.status=="200") {


                            $.each(result.result, function (idx, obj) {

                                oTable.row.add([
                                    '<span id="parent_menu_name" class="parent_menu_name">'+obj.parentMenuName +'</span>'+'<input id="parent_menu_code" name="parent_menu_code" class="form-control state_edit" value="' + obj.parentMenuCode + '" type="hidden">',
                                    '<span id="menu_name">'+obj.menuName +'</span>'+'<input id="menu_code" name="menu_code" class="form-control state_edit" value="' + obj.menuCode + '" type="hidden">',
                                    '<input id="check" class="dt-checkboxes" value="" type="checkbox">'
                                ]).draw(false);
                                $('#menu_code[value="'+obj.menuCode+'"]').parent().next().children().attr('name',obj.menuCode);


                        });

                        stateEdit();
                    } else {
                        flash('warning', result.message);
                    }


                }, error: function (xhr, ajaxOptions, thrownError) {
                    var msg = '{{trans('form.conn_error')}}';
                    flash('warning', msg);
                    console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                },
                complete: function (data) {
                    $('.table-hidden').show();
                    groupColumn();

                }
            });
        }

        function getMatrixEdit(code_id) {
            getMatrixAdd();
            var value ={code:code_id};
            var url_action= 'searchMenuPackageDetailByCode';
            var action = 'DETAIL';
            var menu = id;
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
                    var data = JSON.parse(data);
                    if (data.status=="200") {
                        var detail = data.menuList;

                        $('#code').val(data.code);
                        $('#code').attr('readonly', true);
                        $('#name').val(data.name);
                        //oTable.clear();
                        if(detail){
                        $.each(detail, function (idx, obj) {
                            //$('#list tr').eq(idx+1).find('td').eq(0).find('#parent_menu_name').text(obj.parent_menu_name);
                            //$('#list tr').eq(idx+1).find('td').eq(1).find('#menu_name').text(obj.menuName);
                            $('input[name="'+obj.menuCode+'"]').prop('checked',true);
                        });
                        }

                        stateEdit();
                    } else {
                        flash('warning', data.message);
                    }


                }, error: function (xhr, ajaxOptions, thrownError) {
                    var msg = '{{trans('form.conn_error')}}';
                    flash('warning', msg);
                    console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                },
                complete: function (data) {
                    $('.table-hidden').show();

                }
            });
        }


        function getTableData() {
            var data = [];

            $("#list").find("tbody tr").each(function () {
                var check = ($('td:eq(2)', $(this)).children().is(':checked') ? 1 : 0);
                if (check == 0) {
                    $('td:eq(2)', $(this)).parent().hide();
                }
                var parent_menu_name = $('td:eq(0)', $(this)).find('#parent_menu_name').text();
                var menu_code = $('td:eq(1)', $(this)).find('#menu_code').val();
                var menu_name = $('td:eq(1)', $(this)).find('#menu_name').text();


                var obj = {
                    menuCode: menu_code,
                    menuName: menu_name,
                    parentMenuName: parent_menu_name
                };
                if (check == 1) {
                    data.push(obj);
                }
            });
            return data;
        }

        function countMenu(){
            var count = 0;
            $("#list").find("tbody tr").each(function () {
                var check = ($('td:eq(2)', $(this)).children().is(':checked') ? 1 : 0);

                if (check == 1) {
                    count++;
                }
            });
            return count;
        }

        function stateEdit() {
            oTable.column(0).visible(true);
            $('.parent_menu_name').show();
            $('#save_screen').hide();
            $('input:checkbox').prop('disabled','');
            $('#state').val('edit');
            $('.state_view').hide();
            $('.state_edit').show();
            $('.help-block').show();
            $('label.state_view').text('-');
            $("#list").find("tbody tr").each(function () {

                $('td:eq(0)', $(this)).parent().show();

            });
            $('#done').hide();
            $('#next_user').hide();
            groupColumn();
        }

        function stateView() {
            $('#state').val('view');
            $('#save_screen').hide();
            $('.parent_menu_name').show();
            $('.help-block').hide();
            groupColumn();
            $('input:checkbox').prop('disabled','disabled');
            var code = ($('#code').val() == '' ? '-' : $('#code').val());
            var name = ($('#name').val() == '' ? '-' : $('#name').val());

            $('#preview').text('Preview');
            $('.state_edit').hide();
            $('.state_view').show();
            $('#code_view').text(code);
            $('#name_view').text(name);
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

        function groupColumn(){
            $("#list").find("tbody tr:visible").each(function (idx) {
                var current_value = $(this).children().eq(0).find('span').text();
                var next_value = $(this).next().children().eq(0).find('span').text();
                if (next_value==current_value) {
                    $(this).next().children().eq(0).find('span').hide();
                }
            });
        }




</script>