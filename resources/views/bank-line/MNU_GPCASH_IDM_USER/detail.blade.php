@include('_partials.header_content',['breadcrumb'=>[ str_replace('-',' ',$menu),$type ]])

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <input type="hidden" id="code" value=""/>
            <input type="hidden" id="branchCode" value=""/>
            <div class="box">

                
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
                        <div class="row">
                            <span class="state_view float-right">
                                
                                    <button type="button" id="reset" name="reset" class="btn btn-primary">Reset</button>
                                    <button type="button" id="unlock" name="unlock" class="btn btn-primary">Unlock</button>
                                    <button type="button" id="inactivate" name="inactive" class="btn btn-pink">Inactivate</button>
                                    <button type="button" id="activate" name="active" class="btn btn-primary">Activate</button>

                                
                            </span>
                        </div>
                     
                    </div>
                </div>
                </form>
                    <div class="box-header">
                        <h3 class="box-title table-hidden">User Role</h3>
                    </div>
                    <div class="box-body">
                        <div class="container-fluid">
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
                               


                            </div>

                        </div>
                    </div>

                    <div class="box-footer">                        
                        <div class="float-left">
                                <button type="button" id="back" name="back" class="btn btn-default back">@lang('form.back')</button>
								<button type="button" id="save_screen" name="save_screen" class="btn btn-default" style="display:none" onclick="save_pdf();">@lang('form.save_pdf')</button>
                            </div>
						<div class="float-right">
                            <span>
								<button type="button" id="next_user" name="next_user" class="btn btn-info">@lang('form.next_user')</button>
								<button type="button" id="done" name="done" class="btn btn-primary" style="display:none">@lang('form.done')</button>
                               <button type="button" id="delete" name="delete" class="btn btn-pink">@lang('form.delete')</button>
                               <button type="button" id="edit" name="edit" class="btn btn-primary">@lang('form.edit')</button>
                           </span>
                           
                       </div>
                    </div>
					@include('_partials.next_user')
            </div>
        </div>
    </div>

</section>

<script>
    var oTable;
    var id = '{{ $service }}';
	var noRef;
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

        $('.back').on('click', function () {
            app.setView(id,'landing');
        });


        $('#edit').on('click', function () {

            var code = $('#code').val();
            var res = app.setView(id,'add');
            if(res =='done'){
                $('#type').val('edit');
                $('#breadcrumb-action').html('edit');
                $('#code_edit').val(code);
                getRoleCode(code);
            }
        });

        $('#delete').on('click', function () {

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
            var submit_data = getTableData();

            var value = {
                "code": $('#code').val(),
                "name": $('#name').text(),
                "branchName" : $('#unit').text(),
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

        

        $('#reset').on('click', function () {
            var user = $('#code').val();
            var content ='{{trans('form.user_msg_reset',['user'=>'$user'])}}';

            $.confirm({
                title: 'Reset password',
                content: content.replace('$user',user),
                buttons: {
                    
                    cancel: {
                        text: '{{trans('form.cancel')}}',
                        btnClass: 'btn-default',
                        action: function(){
                            //$('#submit_view').prop('disabled',false);
                        }
                    },
                    confirm: {
                        text: '{{trans('form.confirm')}}',
                        btnClass: 'btn-primary',
                        action: function(){
                            submitReset(user);
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
                    
                    cancel: {
                        text: '{{trans('form.cancel')}}',
                        btnClass: 'btn-default',
                        action: function(){
                            //$('#submit_view').prop('disabled',false);
                        }
                    },
                    confirm: {
                        text: '{{trans('form.confirm')}}',
                        btnClass: 'btn-primary',
                        action: function(){
                            submitUnlock(user);
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
                    
                    cancel: {
                        text: '{{trans('form.cancel')}}',
                        btnClass: 'btn-default',
                        action: function(){
                            //$('#submit_view').prop('disabled',false);
                        }
                    },
                    confirm: {
                        text: '{{trans('form.confirm')}}',
                        btnClass: 'btn-primary',
                        action: function(){
                            submitActivate(user);
                        }
                    },

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
                    
                    cancel: {
                        text: '{{trans('form.cancel')}}',
                        btnClass: 'btn-default',
                        action: function(){
                            //$('#submit_view').prop('disabled',false);
                        }
                    },
                    confirm: {
                        text: '{{trans('form.confirm')}}',
                        btnClass: 'btn-primary',
                        action: function(){
                            submitInactivate(user);
                        }
                    },

                }
            });
        });
		
		$('#save_screen').hide();
		$('#next_user').hide();
        $('#done').hide();
						
		
		$('#done').on('click', function () {
            var res = app.setView(id,'landing');
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
                if (result.status=="200") {
                    var index = result.result.map(function(o) { return o.code; }).indexOf(code.toString());
                    var detail = result.result[index].roleCodeList;
                    $('#code_1').text(result.result[index].code);
                    $('#name').text(result.result[index].name);
                    $('#unit').text(result.result[index].branchCode +' - '+result.result[index].branchName);
                    $('#branchCode').val(result.result[index].branchCode);
                    $('#email').text(result.result[index].email);
                    $('#activeFrom').text(moment(result.result[index].activeFrom,"DD/MM/YYYY hh:mm").format("DD/MM/YYYY"));
                    if(result.result[index].activeTo){
                        $('#activeTo').text(moment(result.result[index].activeTo,"DD/MM/YYYY hh:mm").format("DD/MM/YYYY"));
                    }
                    $('#isPwdNeverExpired').text(result.result[index].isPwdNeverExpired);
                    $('#status').text(result.result[index].status);
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
                    if(detail){
                    $.each(detail, function (idx, obj){
                        oTable.row.add([
                            '<span id="role_name">'+obj.roleName+'</span>',
                            '<span id="role_dscp">'+obj.roleDscp+'</span>'
                        ]).draw(false);
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
                if (result.status=="200") {
                    $('#reset').prop('disabled',false);
                    $('#unlock').prop('disabled',true);
                    $('#inactivate').prop('disabled',false);
                    $('#activate').prop('disabled',true);
                        flash('success', result.message);

                } else {
                    flash('warning', result.message);
                }


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
                if (result.status=="200") {
                    $('#reset').prop('disabled',true);
                    $('#unlock').prop('disabled',true);
                    $('#inactivate').prop('disabled',true);
                    $('#activate').prop('disabled',true);
                        flash('success', result.message);
                   // }
                } else {
                    flash('warning', result.message);
                }


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
                if (result.status=="200") {
                    $('#reset').prop('disabled',false);
                    $('#unlock').prop('disabled',true);
                    $('#inactivate').prop('disabled',false);
                    $('#activate').prop('disabled',true);
                        flash('success', result.message);
                   // }
                } else {
                    flash('warning', result.message);
                }

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
                if (result.status=="200") {
                    $('#reset').prop('disabled',true);
                    $('#unlock').prop('disabled',true);
                    $('#inactivate').prop('disabled',true);
                    $('#activate').prop('disabled',false);
                        flash('success', result.message);

                } else {
                    flash('warning', result.message);
                }

            }, error: function (xhr, ajaxOptions, thrownError) {
                flash('warning', 'Submit Failed');
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {
                //oTable.ajax.reload();
            }
        });
    }


</script>