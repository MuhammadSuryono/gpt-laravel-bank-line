<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Ongoing Task
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#" class="back"><i class="fa fa-dashboard"></i> Ongoing Task</a></li>
        <li class="active">User Identification Detail</li>
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
                    <h3 class="box-title">User Identification Detail</h3><br>
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
                                        <button type="button" id="approve" name="approve" class="btn btn-success">@lang('form.approve')</button>
                                        <button type="button" id="reject" name="reject" class="btn btn-danger">@lang('form.reject')</button>
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
                var detail = result.details.roleCodeList;
                $('#code_1').text(result.details.code);
                $('#name').text(result.details.name);
                $('#unit').text(result.details.branchCode +' - '+result.details.branchName);
                $('#email').text(result.details.email);
                $('#activeFrom').text(result.details.activeFrom);
                $('#activeTo').text(result.details.activeTo);
                $('#isPwdNeverExpired').text(result.details.isPwdNeverExpired);
                $('#status').text(result.details.status);
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
                        obj.roleName,
                        obj.roleDscp
                    ]).draw(true);
                });

            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '{{trans('form.conn_error')}}';
                flash('warning', msg);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            },
            complete: function(data) {

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