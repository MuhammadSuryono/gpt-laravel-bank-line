<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        User Identification
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#" class="back"><i class="fa fa-dashboard"></i> User Identification</a></li>
        <li class="active"> Detail</li>
    </ol>
</section>

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
                    <h3 class="box-title">User Detail</h3><br>
                </div>
                <form class="form-horizontal">
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">User Id</label>
                                <div class="col-md-6">
                                    <label id="code_1"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">User Name</label>
                                <div class="col-md-6">
                                    <label id="name"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Unit</label>
                                <div class="col-md-6">
                                    <label id="unit"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Email Address</label>
                                <div class="col-md-6">
                                    <label id="email"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Active From</label>
                                <div class="col-md-4">
                                    <label id="activeFrom"></label>
                                </div>
                                <label class="col-md-2 control-label">Active To</label>
                                <div class="col-md-4">
                                    <label id="activeTo"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Password Never Expired</label>
                                <div class="col-md-6">
                                    <label id="isPwdNeverExpired"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Status</label>
                                <div class="col-md-6">
                                    <label id="status"></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="state_view">
                                <label class="col-md-2 control-label"></label>
                                <div class="col-md-10 state_view text-center">
                                    <button type="button" id="reset" name="reset" class="btn btn-default">Reset</button>
                                    <button type="button" id="unlock" name="unlock" class="btn btn-default">Unlock</button>
                                    <button type="button" id="inactivate" name="inactive" class="btn btn-default">Inactivate</button>
                                    <button type="button" id="activate" name="active" class="btn btn-default">Activate</button>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                </form>
                    <div class="box-header">
                        <h3 class="box-title table-hidden">User Role</h3>
                    </div>
                    <div class="container-fluid">
                        <div class="box-body">
                           <div class="row table-hidden">
                               <div class="form-group">
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th align="center"><strong>Role</strong></th>
                                        <th align="center"><strong>Description</strong></th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
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
    var id = 'MNU_GPCASH_IDM_USER';
    $(document).ready(function () {


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
                    $('.content-wrapper').html(data);
                    $('#type').val('edit');
                    $('#code_edit').val(code);
                    getData(code);

                }, error: function (xhr, ajaxOptions, thrownError) {
                    $('#edit').prop('disabled',false);
                    console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                }
            });
        });

        $('#delete').on('click', function () {

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
                "branchCode" : $('#unit').text(),
                "activeFrom" : ($('#activeFrom').text() == '' ? '' : $('#activeFrom').text()),
                "activeTo" : ($('#activeTo').text() == '' ? '' : $('#activeTo').text()),
                "email" : $('#email').text(),
                "isPwdNeverExpired" : ($('#isPwdNeverExpired').text()),
                "roleCodeList": submit_data
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
                    $('.content-wrapper').html(data);


                }, error: function (xhr, ajaxOptions, thrownError) {
                    $('.back').prop('disabled',true);
                    console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                }
            });
        });

        $('#reset').on('click', function () {
            var user = $('#code').val();
            var content ='{{trans('form.user_msg_reset',['user'=>'$user'])}}';

            $.confirm({
                title: 'Reset password',
                content: content.replace('$user',user),
                buttons: {
                    confirm: {
                        text: '{{trans('form.confirm')}}',
                        btnClass: 'btn-danger',
                        action: function(){
                            submitReset(user);
                        }
                    },
                    cancel: {
                        text: '{{trans('form.cancel')}}',
                        btnClass: 'btn-default',
                        action: function(){
                            //$('#submit_view').prop('disabled',false);
                        }
                    }

                }
            });
        });
        $('#unlock').on('click', function () {
            var user = $('#code').val();
            var status = $(this).attr('data-status');

            var content ='{{trans('form.user_msg_lock',['user'=>'$user','lock'=>'Unlock'])}}';
            var content2 = content.replace('$user',user);

            $.confirm({
                title: 'Unlock Account',
                content: content2,
                buttons: {
                    confirm: {
                        text: '{{trans('form.confirm')}}',
                        btnClass: 'btn-danger',
                        action: function(){
                            submitUnlock(user);
                        }
                    },
                    cancel: {
                        text: '{{trans('form.cancel')}}',
                        btnClass: 'btn-default',
                        action: function(){
                            //$('#submit_view').prop('disabled',false);
                        }
                    }

                }
            });
        });

        $('#activate').on('click', function () {
            var user = $('#code').val();


            var content ='{{trans('form.user_msg_lock',['user'=>'$user','lock'=>'Activate'])}}';
            var content2 = content.replace('$user',user);

            $.confirm({
                title: 'Activate User',
                content: content2,
                buttons: {
                    confirm: {
                        text: '{{trans('form.confirm')}}',
                        btnClass: 'btn-danger',
                        action: function(){
                            submitActivate(user);
                        }
                    },
                    cancel: {
                        text: '{{trans('form.cancel')}}',
                        btnClass: 'btn-default',
                        action: function(){
                            //$('#submit_view').prop('disabled',false);
                        }
                    }

                }
            });
        });

        $('#inactivate').on('click', function () {
            var user = $('#code').val();


            var content ='{{trans('form.user_msg_lock',['user'=>'$user','lock'=>'Inactivate'])}}';
            var content2 = content.replace('$user',user);

            $.confirm({
                title: 'Inactivate User',
                content: content2,
                buttons: {
                    confirm: {
                        text: '{{trans('form.confirm')}}',
                        btnClass: 'btn-danger',
                        action: function(){
                            submitInactivate(user);
                        }
                    },
                    cancel: {
                        text: '{{trans('form.cancel')}}',
                        btnClass: 'btn-default',
                        action: function(){
                            //$('#submit_view').prop('disabled',false);
                        }
                    }

                }
            });
        });

    });

    function getData(code){
        var code_id= code;
        var value = {
            code: code_id,
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

                var result = JSON.parse(data);

                var detail = result.result[0].roleCodeList;
                $('#code_1').text(result.result[0].code);
                $('#name').text(result.result[0].name);
                $('#unit').text(result.result[0].branchCode +' - '+result.result[0].branchName);
                $('#email').text(result.result[0].email);
                $('#activeFrom').text(result.result[0].activeFrom);
                $('#activeTo').text(result.result[0].activeTo);
                $('#isPwdNeverExpired').text(result.result[0].isPwdNeverExpired);
                $('#status').text(result.result[0].status);
                var status = $('#status').text();
                if(status=="RESET"){
                    $('#reset').prop('disabled',false);
                    $('#unlock').prop('disabled',true);
                    $('#inactivate').prop('disabled',false);
                    $('#activate').prop('disabled',true);

                }else if(status=="ACTIVE"){
                    $('#reset').prop('disabled',false);
                    $('#unlock').prop('disabled',true);
                    $('#inactivate').prop('disabled',false);
                    $('#activate').prop('disabled',true);
                }else if(status=="INACTIVE"){
                    $('#reset').prop('disabled',true);
                    $('#unlock').prop('disabled',true);
                    $('#inactivate').prop('disabled',true);
                    $('#activate').prop('disabled',false);
                }else if(status=="LOCKED"){
                    $('#reset').prop('disabled',true);
                    $('#unlock').prop('disabled',false);
                    $('#inactivate').prop('disabled',false);
                    $('#activate').prop('disabled',true);
                }else{
                    $('#reset').prop('disabled',true);
                    $('#unlock').prop('disabled',true);
                    $('#inactivate').prop('disabled',true);
                    $('#activate').prop('disabled',true);
                }
                oTable.clear();
                $.each(detail, function (idx, obj){
                            oTable.row.add([
                            '<span id="role_name">'+obj.roleName+'</span>',
                                '<span id="role_dscp">'+obj.roleDscp+'</span>'
                        ]).draw(false);
                });

            }, error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            },
            complete: function(data) {
                $('.table-hidden').show();

            }
        });
    }

    function getTableData() {
        var data = [];

        $("#list").find("tbody tr").each(function () {

            var role_name = $('td:eq(0)', $(this)).find('#role_name').text();
            var role_dscp = $('td:eq(1)', $(this)).find('#role_dscp').text();
            var obj = {
                roleName: role_name,
                roleDscp: role_dscp
            };
            data.push(obj);

        });
        return data;
    }

    function submitReset(code) {
        var value = {
            code: code
        };
        var url_action = 'resetUser';
        var action = 'RESET';
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
                flash('success', result.message);

            }, error: function (xhr, ajaxOptions, thrownError) {
                flash('warning', 'Submit Failed');
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {
                //oTable.ajax.reload();
            }
        });
    }

    function submitUnlock(code) {
        var value = {
            code: code
        };
        var url_action = 'unlockUser';

        var menu = id;
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data: {
                value : value,
                menu : menu,
                url_action : url_action,
                action : 'UNLOCK',
                _token : '{{ csrf_token() }}'
            },
            success: function (data) {
                var result = JSON.parse(data);
                flash('success', result.message);


            }, error: function (xhr, ajaxOptions, thrownError) {
                flash('warning', 'Submit Failed');
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {
                //oTable.ajax.reload();
            }
        });
    }

    function submitActivate(code) {
        var value = {
            code: code
        };
        var url_action = 'activateUser';

        var menu = id;
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data: {
                value : value,
                menu : menu,
                url_action : url_action,
                action : 'ACTIVATE',
                _token : '{{ csrf_token() }}'
            },
            success: function (data) {
                var result = JSON.parse(data);
                flash('success', result.message);

            }, error: function (xhr, ajaxOptions, thrownError) {
                flash('warning', 'Submit Failed');
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {
                //oTable.ajax.reload();
            }
        });
    }

    function submitInactivate(code) {
        var value = {
            code: code
        };
        var url_action = 'inactivateUser';

        var menu = id;
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data: {
                value : value,
                menu : menu,
                url_action : url_action,
                action : 'INACTIVATE',
                _token : '{{ csrf_token() }}'
            },
            success: function (data) {
                var result = JSON.parse(data);
                flash('success', result.message);

            }, error: function (xhr, ajaxOptions, thrownError) {
                flash('warning', 'Submit Failed');
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {
                oTable.ajax.reload();
            }
        });
    }


</script>