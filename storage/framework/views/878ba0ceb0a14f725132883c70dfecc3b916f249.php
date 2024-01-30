
<?php echo $__env->make('_partials.header_content',['breadcrumb'=>[ str_replace('-',' ',$menu),$type ]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content">

    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div id="print" class="box">

                <form id="form-area" class="form-horizontal form-area">
                    <input type="hidden" id="code_edit" value=""/>
                    <input type="hidden" id="type" value=""/>
                    <input type="hidden" id="state" value=""/>
                    <div id="exTab" class="">

                        <ul class="nav nav-tabs state_edit">
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
                                <div class="box-body">  
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><strong>User Id&ast;</strong></label>
                                            <div class="col-md-6">
                                                <input type="text" id="code" name="code" class="form-control state_edit detail" autocomplete="off" value="" maxlength="40" data-error="This field is required." required>
                                                <div class="help-block with-errors"></div>
                                                <label id="code_view" class="state_view">-</label>

                                            </div>
                                        </div>
                                    
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><strong>User Name&ast;</strong></label>
                                            <div class="col-md-6">
                                                <input type="text" id="name" name="name" class="form-control state_edit detail" autocomplete="off" value="" maxlength="100" data-error="This field is required." required>
                                                <div class="help-block with-errors"></div>
                                                <label id="name_view" class="state_view">-</label>
                                            </div>
                                        </div>
                                    
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><strong>Unit&ast;</strong></label>
                                            <div class="col-md-6">
                                                <div class="state_edit">
                                                <select class="form-control detail" id="branchCode" data-error="This field is required." required>
                                                    <option></option>
                                                </select>
                                                </div>
                                                <div class="help-block with-errors"></div>
                                                <label id="branchCode_view" class="state_view">-</label>

                                            </div>
                                        </div>
                                    
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><strong>Email Address&ast;</strong></label>
                                            <div class="col-md-6">
                                                <input type="email" id="email" name="email" class="form-control state_edit detail" autocomplete="off" value="" maxlength="100" data-error="This field is required." required>
                                                <div class="help-block with-errors"></div>
                                                <label id="email_view" class="state_view">-</label>
                                            </div>
                                        </div>
                                    
                                    
                                        <div class="form-group">

                                            <label class="col-md-3 control-label"><strong>Active From&ast;</strong></label>
                                            <div class="col-md-9">
                                                <div class="col-xs-5 col-md-3 no-padding">
                                                    <div class="input-group state_edit">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        <input type="text" id="activeFrom" name="activeFrom" class="form-control datepicker detail numeric" autocomplete="off" value="" data-error="This field is required." required>
                                                      </div>
                                                    <div class="help-block with-errors"></div>
                                                    <label id="activeFrom_view" class="state_view">-</label>
                                                </div>
                                                <label class="col-md-1 text-center control-label"><strong>to</strong></label>
                                                <div class="col-xs-5 col-md-3 no-padding">
                                                    <div class="input-group state_edit">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        <input type="text" id="activeTo" name="activeTo" class="form-control datepicker numeric" autocomplete="off" value="">
                                                      </div>
                                                    <label id="activeTo_view" class="state_view">-</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Password Never Expired</label>
                                            <div class="col-md-6">
                                                <div class="state_edit">
                                                <input type="checkbox" id="isPwdNeverExpired" name="isPwdNeverExpired" value="Yes"/>
                                                </div>
                                                <label id="isPwdNeverExpired_view" class="state_view">-</label>

                                            </div>
                                        </div>
                                    
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_role">
                                <div class="container-fluid box-body">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Role</label>
                                            <div class="col-md-4">
                                                <select class="form-control" id="roleCode">

                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <button type="button" id="addrole" name="addrole" class="btn wire-btn-primary">Add to List</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="role_list" class="row">
                                        <div class="role_list">
                                        <div class="box-header state_view" style="display:none;">
                                            <h3 class="box-title">User Role</h3><br>
                                        </div>
                                        <div class="col-xs-12">
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
                    </div>

                </form>
                <div class="state_view">
                    
                        <div class="box-header">
                            <h3 class="box-title">User Role</h3><br>
                        </div>
                        <div class="box-body col-xs-12">
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
                </div>
                <div class="row table-hidden">
                     
                </div>

                 <div class="box-footer">
                     <div class="col-md-12 state_edit text-center">
                         <button type="button" id="back" name="back" class="btn btn-default back float-left"><?php echo app('translator')->get('form.cancel'); ?></button>
                        <button type="button" id="confirm" name="confirm" class="btn btn-primary float-right "><?php echo app('translator')->get('form.confirm'); ?></button>
                     </div>
                     <div class="col-md-12 state_view text-center" data-html2canvas-ignore="true">
                         <div class="float-left">
                            <button type="button" id="back_view" name="back_view" class="btn btn-default"><?php echo app('translator')->get('form.cancel'); ?></button>
                            <button type="button" id="save_screen" name="save_screen" class="btn btn-default" style="display:none" onclick="save_pdf();"><?php echo app('translator')->get('form.save_pdf'); ?></button>
                         </div>
                         <div class="float-right" style="display:inline;">
                            <button type="button" id="next_user" name="next_user" class="btn btn-info"><?php echo app('translator')->get('form.next_user'); ?></button>
                            <button type="button" id="done" name="done" class="btn btn-primary" style="display:none"><?php echo app('translator')->get('form.done'); ?></button>
                            <button type="button" id="submit_view" name="submit_view" class="btn btn-primary"><?php echo app('translator')->get('form.submit'); ?></button>
                         </div>
                     </div>
                </div>
                <?php echo $__env->make('_partials.next_user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            </div>
        </div>
</section>

<script>
    var oTable;
    var oTable_view;
    var oTable_next_user;
    var unitOption;
    var roleOption;
    var id = '<?php echo e($service); ?>';
    var noRef;
    $(document).ready(function () {

        var submit_data;
        $('#isPwdNeverExpired').lc_switch();
        /*$('#activeTo').datepicker({
            format: "dd/mm/yyyy",
            locale: 'id'
        });*/
        $('.datepicker').datepicker({
            format: "dd/mm/yyyy",
            locale: 'id'
        });

        $('#form-area').validator().on('submit', function (e) {
          if (e.isDefaultPrevented()) {
            // handle the invalid form...
          } else {
            // everything looks good!
            //console.log('valid')
          }
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
                    width: "30%",
                    targets: 0
                },
                {
                    targets: 1,
                    sortable: true,
                    width: "60%"
                },
                {
                    targets: 2,
                    sortable: true,
                    width: "10%"
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
                    width: "66%"
                }
            ]
        });

        oTable_next_user = $('#nextUserList').DataTable({
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
                    width: "50%",
                    targets: 0
                },
                {
                    targets: 1,
                    sortable: true,
                    width: "50%"
                }
            ]
        });

        stateEdit();

        $('#submit_view').on('click', function () {
            $(this).prop('disabled',true);
            var content ='';
            if ($('#type').val() == 'add'){
                content='<?php echo e(trans('form.confirm_add')); ?>';
            }else{
                content='<?php echo e(trans('form.confirm_edit')); ?>';
            }

            $.confirm({
                title: '<?php echo e(trans('form.submit')); ?>',
                content: content,
                buttons: {
                    
                    cancel: {
                        text: '<?php echo e(trans('form.cancel')); ?>',
                        btnClass: 'btn-default',
                        action: function(){
                            $('#submit_view').prop('disabled',false);
                        }
                    },

                    confirm: {
                        text: '<?php echo e(trans('form.confirm')); ?>',
                        btnClass: 'btn-primary',
                        action: function(){
                            submitData();
                        }
                    }

                }
            });

        });

        function submitData(){
            //console.log('activeFrom',$('#activeFrom').val());
            //exit;
            var value = {
                "code": $('#code').val(),
                "name": $('#name').val(),
                "branchCode" : $('#branchCode').val(),
                "branchName" : $('#branchCode option:selected').attr('data-name'),
                "activeFrom" : ($('#activeFrom').val() == '' ? '' : $("#activeFrom").val()+' 00:00:00'),
                "activeTo" : ($('#activeTo').val() == '' ? '' : $("#activeTo").val()+' 00:00:00'),
                "email" : $('#email').val(),
                "isPwdNeverExpired" : ($('#isPwdNeverExpired').is(':checked') ? 'Y' : 'N'),
                "roleCodeList": submit_data
            };
            //console.log(value);
            //return;
            if($('#type').val() == 'add'){
                $.ajax({
                    url: 'add',
                    method: 'post',
                    data: {"_token": "<?php echo e(csrf_token()); ?>", menu: id, value: value},
                    success: function (data) {
                        $('#submit_view').prop('disabled',false);
                        var result = JSON.parse(data);
                        if (result.status=="200") {
                            noRef=result.referenceNo;
                            flash('success', result.message+'<br>'+'ReferenceNo: '+ result.referenceNo+'<br>'+result.dateTimeInfo);
                            $('#submit_view').hide();
                            getNextUserData(noRef);
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
                    data: {"_token": "<?php echo e(csrf_token()); ?>", menu: id, value: value},
                    success: function (data) {
                        $('#submit_view').prop('disabled',false);
                        var result = JSON.parse(data);
                        if (result.status=="200") {
                            noRef=result.referenceNo;
                            flash('success', result.message+'<br>'+'ReferenceNo: '+ result.referenceNo+'<br>'+result.dateTimeInfo);
                            $('#submit_view').hide();
                            getNextUserData(noRef);
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
            if(checkDate()>0){
                $('a[href="#tab_detail"]').click();
                var content ='<?php echo e(trans('form.alert_date_compare')); ?>';
                $.alert({
                    title: '<?php echo e(trans('form.warning')); ?>',
                    content: content
                });
                return;
            }
            $('#form-area').validator('validate');
            if($('.detail').val()==''){
                $('a[href="#tab_detail"]').click();
                return;
            }
            if($('#activeFrom').val()==''){
                $('a[href="#tab_detail"]').click();
                $('#activeFrom').trigger('input');
                return;
            }
            if($('#form-area').validator('validate').has('.has-error').length!=0){
                return;
            }
            var currentTabTitle = $('div[id="exTab"] ul li.active > a').attr("href");
            if(currentTabTitle=='#tab_detail'){
                $('a[href="#tab_role"]').click();
                return;
            }
            if(countRole()==0){
                var content ='<?php echo e(trans('form.alert_empty',['label'=>'Role'])); ?>';

                $.alert({
                    title: '<?php echo e(trans('form.warning')); ?>',
                    content: content
                });
                return;
            }


            setTimeout(function(){
                submit_data = getTableData();
                stateView(submit_data);
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
                app.setView(id,'landing');
            } else {
                var code = $('#code_edit').val();
                var res = app.setView(id,'detail');
                if(res=='done'){
                    $('#code').val(code);
                    getData(code);
                }
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
                '<button type="button" id="'+code+'" class="btn wire-btn-alert removerole" onClick="return removeRole(\''+code+'\');return false;">Remove</button>'
            ]).draw(false);

        });


        $('#done').on('click', function () {
            $(this).prop('disabled',true);
            app.setView(id,'landing');
        });

        $('input[type="text"]').not('.numeric').alphanum({
            allowSpace: true,
            allow : ',._!@'
        });

        $('#code').alphanum({
            allowSpace: false
        });
        
    });

        function countRole(){
            var count = oTable.data().count();
            return count;
        }

        function removeRole(code){
            //console.log($('#'+code));
            oTable.row($('#'+code).closest("tr").get(0)).remove().draw(true);
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
                    _token : '<?php echo e(csrf_token()); ?>'
                },
                success: function (data) {
                    var data = JSON.parse(data);
                    if (data.status=="200") {
						var index = data.result.map(function(o) { return o.code; }).indexOf(code.toString());
                        var detail = data.result[index].roleCodeList;

                        $('#code').val(data.result[index].code);
                        $('#code').attr('readonly', true);
                        $('#name').val(data.result[index].name);
                        $('#branchCode').val(data.result[index].branchCode).trigger('change');
                        $('#activeFrom').val(moment(data.result[index].activeFrom,"DD/MM/YYYY hh:mm").format("DD/MM/YYYY"));
                        if(data.result[index].activeTo){
                            $('#activeTo').val(moment(data.result[index].activeTo,"DD/MM/YYYY hh:mm").format("DD/MM/YYYY"));
                        }
                        $('#email').val(data.result[index].email);
                        if(data.result[index].isPwdNeverExpired=="Y"){
                            $('#isPwdNeverExpired').lcs_on();
                        }else{
                            $('#isPwdNeverExpired').lcs_off();
                        }
                        oTable.clear();
                        //console.log(detail);
                        if(detail) {
                            $.each(detail, function (idx, obj) {
                                oTable.row.add([
                                    '<span id="role_name">' + obj.roleName + '</span>',
                                    '<span id="role_dscp">' + obj.roleDscp + '</span>',
                                    '<button type="button" id="' + obj.roleCode + '" class="btn btn-danger removerole" onClick="return removeRole(\''+obj.roleCode+'\');return false;">Remove</button>'
                                ]).draw(true);
                            });
                        }
                        stateEdit();
                    } else {
                        flash('warning', data.message);
                    }


                }, error: function (xhr, ajaxOptions, thrownError) {
                    var msg = '<?php echo e(trans('form.conn_error')); ?>';
                    flash('warning', msg);
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
                _token : '<?php echo e(csrf_token()); ?>'
            },
            success: function (data) {
                var result = JSON.parse(data);
                if (result.status=="200") {
                    unitOption = '<option value=""></option>';
                    $.each(result.result, function (idx, obj) {
                        unitOption += '<option value="' + obj.code + '" data-name="'+obj.name+'">' + obj.code + ' - ' +  obj.name + '</option>';
                    });
                    $('#branchCode').html(unitOption);
                    $('#branchCode').select2({ width: '100%' });
                } else {
                    flash('warning', result.message);
                }



            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '<?php echo e(trans('form.conn_error')); ?>';
                flash('warning', msg);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {

            }
        });
    }

    function getRoleCode(code) {
        getBranchCode();
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
                _token : '<?php echo e(csrf_token()); ?>'
            },
            success: function (data) {
                var result = JSON.parse(data);
                if (result.status=="200") {
                    roleOption = '<option value=""></option>';
                    $.each(result.result, function (idx, obj) {
                        roleOption += '<option data-dscp="'+obj.dscp+'" value="' + obj.code + '">' + obj.name + '</option>';
                    });
                    $('#roleCode').html(roleOption);
                    $('#roleCode').select2({ width: '100%',placeholder: "Select a role" });
                } else {
                    flash('warning', result.message);
                }



            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '<?php echo e(trans('form.conn_error')); ?>';
                flash('warning', msg);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {
                //$('#roleCode :nth-child(1)').prop('selected', true);				
                if ($('#type').val() == 'edit'){
                getData(code);
                }
            }
        });
    }

        function stateEdit() {

            $('#state').val('edit');
            $('.state_view').hide();
            $('.state_edit').show();
            $('label.state_view').text('-');
            $('#save_screen').hide();
            $('.help-block').show();
            $('#done').hide();
            $('#next_user').hide();
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
                    '<span id="role_dscp">'+obj.roleDscp+'</span>'
                ]).draw(true);
            });


            $('.state_edit').hide();
            $('.state_view').show();

            $('#code_view').text(code);
            $('#name_view').text(name);
            $('#activeFrom_view').text(activeFrom);
            $('#activeTo_view').text(activeTo);
            $('#branchCode_view').text(branch);
            $('#email_view').text(email);
            $('#isPwdNeverExpired_view').text(isPwdNeverExpired);
            $('#save_screen').hide();
            $('.help-block').hide();
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

    function checkDate(){
        var count = 0;
        var date1 = $("#activeFrom").data('datepicker').getFormattedDate('yyyy/mm/dd');
        var date2 = $("#activeTo").data('datepicker').getFormattedDate('yyyy/mm/dd');

        if(date2!=''){
            var x = new Date(date1);
            var y = new Date(date2);
            if(x>y){
                count = 1;
            }
        }
        return count;

    }


</script><?php /**PATH C:\xampp8\htdocs\bank-line\resources\views/bank-line/MNU_GPCASH_IDM_USER/add.blade.php ENDPATH**/ ?>