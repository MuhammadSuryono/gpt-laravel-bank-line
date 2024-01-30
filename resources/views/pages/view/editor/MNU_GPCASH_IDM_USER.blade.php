<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        User Identification
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#" class="back"><i class="fa fa-dashboard"></i> User Identification</a></li>
        <li class="active">User Identification Editor</li>
    </ol>
</section>

<section class="content">

    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div id="print" class="box">

                <div class="box-header state_view">
                    <span id="preview" class="state_view" style="color:darkred;display:none;"><small><i>Preview</i></small></span>
                </div>
                <div class="box-header">
                     <h3 class="box-title">User Identification Editor</h3>
                </div>
                <div class="box-body">
                <form class="form-horizontal">
                <input type="hidden" id="code_edit" value=""/>
                <input type="hidden" id="type" value=""/>
                <input type="hidden" id="state" value=""/>
                    <div id="exTab" class="container">

                        <ul class="nav nav-pills state_edit">
                            <li class="active">
                                <a href="#tab_detail" data-toggle="tab">User Detail</a>
                            </li>
                            <li><a href="#tab_role" data-toggle="tab">User Role</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_detail">
                                <div class="box-header state_view" style="display:none;">
                                    <h3 class="box-title">User Detail</h3><br>
                                </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">User Id</label>
                                            <div class="col-md-6">
                                                <input type="text" id="code" name="code" class="form-control state_edit" autocomplete="off" value="">
                                                <span id="code_view" class="col-md-2 state_view">-</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">User Name</label>
                                            <div class="col-md-6">
                                                <input type="text" id="name" name="name" class="form-control state_edit" autocomplete="off" value="">
                                                <span id="name_view" class="col-md-2 state_view">-</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Unit</label>
                                            <div class="col-md-6">
                                                <div class="state_edit">
                                                <select class="form-control" id="branchCode" >
                                                    <option></option>
                                                </select>
                                                </div>
                                                <span id="branchCode_view" class="col-md-6 state_view">-</span>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Email Address</label>
                                            <div class="col-md-6">
                                                <input type="text" id="email" name="email" class="form-control state_edit" autocomplete="off" value="">
                                                <span id="email_view" class="col-md-2 state_view">-</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Active From</label>
                                            <div class="col-md-4">
                                                <input type="text" id="activeFrom" name="activeFrom" class="form-control state_edit" autocomplete="off" value="">
                                                <span id="activeFrom_view" class="col-md-2 state_view">-</span>

                                            </div>
                                            <label class="col-md-2 control-label">Active To</label>
                                            <div class="col-md-4">
                                                <input type="text" id="activeTo" name="activeTo" class="form-control state_edit" autocomplete="off" value="">
                                                <span id="activeTo_view" class="col-md-2 state_view">-</span>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Password Never Expired</label>
                                            <div class="col-md-6">
                                                <div class="state_edit">
                                                <input type="checkbox" id="isPwdNeverExpired" name="isPwdNeverExpired" value="Yes"/>
                                                </div>
                                                <span id="isPwdNeverExpired_view" class="col-md-2 state_view">-</span>

                                            </div>
                                        </div>
                                    </div>

                            </div>
                            <div class="tab-pane" id="tab_role">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Role</label>
                                            <div class="col-md-6">
                                                <select class="form-control" id="roleCode">

                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <button type="button" id="addrole" name="addrole" class="btn btn-default">Add to List</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="role_list" class="row">
                                        <div class="role_list">
                                        <div class="box-header state_view" style="display:none;">
                                            <h3 class="box-title">User Role</h3><br>
                                        </div>
                                        <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                               style="border-collapse:collapse;">
                                            <thead>
                                            <tr>
                                                <th><strong>Role</strong></th>
                                                <th><strong>Description</strong></th>
                                                <th><strong>Action</strong></th>
                                            </tr>
                                            </thead>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
                <div class="row state_view">
                    <div class="box-header">
                        <h3 class="box-title">User Role</h3><br>
                    </div>
                    <table id="list_view" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                           style="border-collapse:collapse;">
                        <thead>
                        <tr>
                            <th><strong>Role</strong></th>
                            <th><strong>Description</strong></th>
                        </tr>
                        </thead>
                    </table>
                </div>
                <div class="row table-hidden">
                     <div class="col-md-12 state_edit text-center">
                         <button type="button" id="confirm" name="confirm" class="btn btn-default">@lang('form.confirm')</button>
                         <button type="button" id="back" name="back" class="btn btn-default back">@lang('form.back')</button>
                     </div>
                     <div class="col-md-12 state_view text-center">
                         <button type="button" id="submit_view" name="submit_view" class="btn btn-danger">@lang('form.submit')</button>
                         <button type="button" id="save_screen" name="save_screen" class="btn btn-default" style="display:none">Save Screen</button>
                         <button type="button" id="back_view" name="back_view" class="btn btn-default">@lang('form.back')</button>
                     </div>
                </div>
                </div>
            </div>
        </div>
    </div>

</section>

<script>
    var oTable;
    var oTable_view;
    var unitOption;
    var roleOption;
    var id = 'MNU_GPCASH_IDM_USER';
    $(document).ready(function () {

        var submit_data;
        $('#isPwdNeverExpired').lc_switch();
        $('#activeTo').datepicker({
            format: "dd/mm/yyyy",
            locale: 'id'
        });
        $('#activeFrom').datepicker({
            format: "dd/mm/yyyy",
            locale: 'id'
        });

        oTable = $('#list').DataTable({
            "paging": false,
            "ordering": false,
            "info": false,
            "destroy": true,

            "searching": false,
            "autoWidth": false,
            "ScrollX": '100%',
            "lengthMenu": [[10, 25, 50], [10, 25, 50]],
            "columnDefs": [
                {
                    sortable: true,
                    width: "33%",
                    targets: 0
                },
                {
                    targets: 1,
                    sortable: true,
                    width: "33%"
                },
                {
                    targets: 2,
                    sortable: true,
                    width: "34%"
                }
            ]
        });

        oTable_view = $('#list_view').DataTable({
            "paging": false,
            "ordering": false,
            "info": false,
            "destroy": true,

            "searching": false,
            "autoWidth": false,
            "ScrollX": '100%',
            "lengthMenu": [[10, 25, 50], [10, 25, 50]],
            "columnDefs": [
                {
                    sortable: true,
                    width: "33%",
                    targets: 0
                },
                {
                    targets: 1,
                    sortable: true,
                    width: "33%"
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
                "branchCode" : $('#branchCode').val(),
                "activeFrom" : ($('#activeFrom').val() == '' ? '-' : $("#activeFrom").data('datepicker').getFormattedDate('yyyy/mm/dd')+' 00:00:00'),
                "activeTo" : ($('#activeTo').val() == '' ? '-' : $("#activeTo").data('datepicker').getFormattedDate('yyyy/mm/dd')+' 00:00:00'),
                "email" : $('#email').val(),
                "isPwdNeverExpired" : ($('#isPwdNeverExpired').is(':checked') ? 'Y' : 'N'),
                "roleCodeList": submit_data
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
            }else{
                $.ajax({
                    url: 'edit',
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
        }



        $('#confirm').on('click', function () {
            submit_data = getTableData();
            stateView(submit_data);
        });

        $('#back_view').on('click', function () {
            $(this).prop('disabled',true);
            if($('#state').val() == 'success'){
                $.ajax({
                    url: 'getView/MNU_GPCASH_PRO_CH_PC',
                    method: 'post',
                    success: function (data) {
                        $('#back_view').prop('disabled',false);
                        $(window).scrollTop(0);
                        $('.content-wrapper').html(data);


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
                        $('.content-wrapper').html(data);


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
                        $('.content-wrapper').html(data);
                        $('#code').val(code);
                        getData(code);

                    }, error: function (xhr, ajaxOptions, thrownError) {
                        $('.back').prop('disabled',false);
                        console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                    }
                });
            }
        });

        $('#addrole').on('click', function () {
            var role_added = [];

            $("#list").find("tbody tr").each(function () {
                var role_name = $('td:eq(0)', $(this)).find('#role_name').text();
                role_added.push(role_name);
            });


            var code = $('#roleCode').val();
            var name = $('#roleCode option:selected').text();
            var dscp = $('#roleCode option:selected').attr('data-dscp');

            if(jQuery.inArray(name, role_added)!==-1){
                $.alert({
                    title: 'Attention',
                    content: 'Role already exist in the list'
                });
                return;
            }
            if(code==''){
                $.alert({
                    title: 'Attention',
                    content: 'Please select a role'
                });
                return;
            }

            oTable.row.add([
                '<span id="role_name">'+name+'</span>',
                '<span id="role_dscp">'+dscp+'</span>',
                '<button id="'+code+'" class="btn btn-danger removerole" onClick="removeRole();">Remove</button>'
            ]).draw(false);


        });

        getBranchCode();
        getRoleCode();
    });
        function removeRole(){
            oTable.row($(this).closest("tr").get(0)).remove().draw(true);
        }

        function getData(code) {

            var value = {
                code: code,
                name: "",
                branchCode: "",
                currentPage: "1",
                pageSize: "20",
                orderBy: {"code": "ASC"}
            };
            var url_action = 'search';
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
                    var detail = data.result[0].roleCodeList;

                    $('#code').val(data.result[0].code);
                    $('#code').attr('readonly', true);
                    $('#name').val(data.result[0].name);
                    $('#branchCode').val(data.result[0].branchCode);
                    $('#activeFrom').val(data.result[0].activeFrom);
                    $('#activeTo').val(data.result[0].activeTo);
                    $('#email').val(data.result[0].email);
                    if(data.result[0].isPwdNeverExpired=="Y"){
                        $('isPwdNeverExpired').lcs_on();
                    }else{
                        $('isPwdNeverExpired').lcs_off();
                    }
                    oTable.clear();
                    //console.log(detail);
                    $.each(detail, function (idx, obj) {
                        oTable.row.add([
                            '<span id="role_name">'+obj.roleName+'</span>',
                            '<span id="role_dscp">'+obj.roleDscp+'</span>',
                            '<button id="'+obj.roleCode+'" class="btn btn-danger removerole" onClick="removeRole();">Remove</button>'
                        ]).draw(true);
                    });

                    stateEdit();

                }, error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                },
                complete: function (data) {

                }
            });
        }


        function getTableData() {
            var data = [];

            $("#list").find("tbody tr").each(function () {

                var role_code = $('td:eq(2)', $(this)).find('button').attr('id');
                var role_name = $('td:eq(0)', $(this)).find('#role_name').text();
                var role_dscp = $('td:eq(1)', $(this)).find('#role_dscp').text();
                var obj = {
                    roleCode: role_code,
                    roleName: role_name,
                    roleDscp: role_dscp
                };
                data.push(obj);

            });
            return data;
        }

    function getBranchCode() {
        var value = {
            code: "",
            name: ""
        };
        var url_action = 'searchBranch';
        var action = 'SEARCH';
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
                var result = JSON.parse(data);
                unitOption = '<option value=""></option>';
                $.each(result.result, function (idx, obj) {
                    unitOption += '<option value="' + obj.code + '">' + obj.name + '</option>';
                });
                $('#branchCode').html(unitOption);
                $('#branchCode').select2({ width: '100%' });


            }, error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {

            }
        });
    }

    function getRoleCode() {
        var value = {
            code: "",
            name: ""
        };
        var url_action = 'searchRole';
        var action = 'SEARCH';
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
                var result = JSON.parse(data);
                roleOption = '<option value=""></option>';
                $.each(result.result, function (idx, obj) {
                    roleOption += '<option data-dscp="'+obj.dscp+'" value="' + obj.code + '">' + obj.name + '</option>';
                });
                $('#roleCode').html(roleOption);
                $('#roleCode').select2({ width: '100%',placeholder: "Select a role" });


            }, error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {
                //$('#roleCode :nth-child(1)').prop('selected', true);
            }
        });
    }

        function stateEdit() {

            $('#state').val('edit');
            $('.state_view').hide();
            $('.state_edit').show();
            $('span.state_view').text('-');
            $("#list").find("tbody tr").each(function () {

                $('td:eq(0)', $(this)).parent().show();

            });
        }

        function stateView(submit_data) {
            $('#state').val('view');
            $('a[href="#tab_detail"]').click();
           // $('.role_list').appendTo('.role_view');
            //oTable.column(2).visible(false);
            var code = ($('#code').val() == '' ? '-' : $('#code').val());
            var name = ($('#name').val() == '' ? '-' : $('#name').val());
            var branch = ($('#branchCode :selected').text() == '' ? '-' : $('#branchCode :selected').text());
            var email = ($('#email').val() == '' ? '-' : $('#email').val());
            var activeFrom = ($('#activeFrom').val() == '' ? '-' : $('#activeFrom').val());
            var activeTo = ($('#activeTo').val() == '' ? '-' : $('#activeTo').val());
            var isPwdNeverExpired = ($('#isPwdNeverExpired').is(':checked') ? 'Yes' : 'No');

            oTable_view.clear();
            $.each(submit_data, function (idx, obj) {
                oTable_view.row.add([
                    '<span id="role_name">'+obj.roleName+'</span>',
                    '<span id="role_dscp">'+obj.roleDscp+'</span>',
                ]).draw(true);
            });


            $('#preview').text('Preview');
            $('.state_edit').hide();
            $('.state_view').show();
            $('#code_view').text(code);
            $('#name_view').text(name);
            $('#activeFrom_view').text(activeFrom);
            $('#activeTo_view').text(activeTo);
            $('#branchCode_view').text(branch);
            $('#email_view').text(email);
            $('#isPwdNeverExpired_view').text(isPwdNeverExpired);

        }

        function stateSuccess() {
            $('#state').val('success');
            $('#code_1').val('');
            $('#name').val('');
            $('input.state_edit').val('');
            $('input.check').attr('checked', '');
            $('#back_view').html('{{trans('form.done')}}');
            $('save_screen').show();
        }


</script>