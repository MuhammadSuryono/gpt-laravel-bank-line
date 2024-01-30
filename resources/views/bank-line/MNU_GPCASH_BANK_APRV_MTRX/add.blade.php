@include('_partials.header_content',['breadcrumb'=>[str_replace('-',' ','Approval Mechanism'),$type]])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Approval Mechanism Detail</h3>
                </div>
                <form id="form-area" class="form-horizontal form-area">
                <input type="hidden" id="appMenuCode_1" value=""/>
                <input type="hidden" id="appMenuName_1" value=""/>
                <input type="hidden" id="noOfApprover_1" value=""/>
                <input type="hidden" id="appMatrixId" value=""/>
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label"><strong>Bank Approval Matrix Menu&ast;</strong></label>
                                <div class="col-md-5">
                                    <input type="text" id="appMenuCode" name="appMenuCode" class="form-control state_edit" autocomplete="off" value="" maxlength="40" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                    <label id="appMenuCode_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label"><strong>Number of Approver&ast;</strong></label>
                                <div class="col-md-5">
                                    <input type="text" id="noOfApprover" name="noOfApprover" class="form-control state_edit numeric" autocomplete="off" value="" maxlength="2" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                    <label id="noOfApprover_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-header state_edit">
                    <h3 class="box-title">Approval Matrix Listing</h3><br>
                </div>
                <div class="box-body state_edit">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label"><strong>Number of User&ast;</strong></label>
                                <div class="col-md-5">
                                    <input type="text" id="noOfUser" name="noOfUser" class="form-control state_edit numeric" autocomplete="off" value="" maxlength="2" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                    <label id="noOfUser_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label"><strong>Approval Level&ast;</strong></label>
                                <div class="col-md-5">
                                    <select class="form-control" id="appLevel">
                                        <option></option>
                                    </select>
                                    <label id="appLevel_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label"><strong>Target Branch&ast;</strong></label>
                                <div class="col-md-5">
                                    <select class="form-control" id="branch">
                                        <option value="SAME">Same Branch</option>
                                        <option value="PARENT">Parent Branch</option>
                                    </select>
                                    <label id="branch_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label"><strong></strong></label>
                                <div class="col-md-5">
                                   <button type="button" id="add_list" class="btn btn-default">Add to List</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-header">
                    <h3 class="box-title">Approval Matrix Detail Listing</h3><br>
                </div>
                <div class="box-body">
                    <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                        <thead>
                            <tr>
                                <th align="left"><strong>Sequence</strong></th>
                                <th align="left"><strong>Number of User</strong></th>
                                <th align="left"><strong>Approval Level</strong></th>
                                <th align="left"><strong>Target Branch </strong></th>
                                <th align="left" class="state_edit"><strong></strong></th>
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
                </form>
            </div>
        </div>
    </div>

</section>

<script>
    var oTable;
    var submit_data;
    var id = '{{ $service }}';
    var noRef;
    var intRateId;

    $(document).ready(function () {

        $(document).validator().on('#form-area','submit', function (e) {
            if (e.isDefaultPrevented()) {
                // handle the invalid form...
            } else {
                // everything looks good!

            }
        });

        stateEdit();
        getApprovalLevelDroplist();

        oTable = $('#list').DataTable({
            //"paging" : false,
            "ordering" : false,
            "info": false,
            "destroy": true,
            "searching": false,
            "autoWidth":false,
            "lengthMenu": [[10, 25, 50], [10, 25, 50]],
            "columnDefs": [

                {
                    targets: 0,
                    sortable: false,
                    width: "15%"
                },
                {
                    targets: 1,
                    sortable: false,
                    width: "20%"
                },
                {
                    targets: 2,
                    sortable: false,
                    width: "20%"
                },
                {
                    targets: 3,
                    sortable: false,
                    width: "25%"
                },
                {
                    targets: 4,
                    sortable: false,
                    width: "20%",
                    className: "dt-center state_edit",
                    render: function ( data, type, full, meta ) {
                        return '<button data-cif="'+data+'" class="btn btn-danger" onClick="removeRow(this);" style="width:100px;">Remove</button>';
                    }
                }
            ],
        });



        $('#submit_view').on('click', function () {
            $(this).prop('disabled',true);
            var content ='';
            var action = '';
            if ($('#type').val() == 'add'){
                content='{{trans('form.confirm_add')}}';
                action = 'CREATE';
            }else{
                content='{{trans('form.confirm_edit')}}';
                action = 'UPDATE';
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
                            submitData(action);
                        }
                    },

                }
            });

        });

        $('#add_list').on('click', function () {
            // $(this).prop('disabled',true);
            
            $('#form-area').validator('validate');
            // setTimeout(function(){
                if($('#form-area').validator('validate').has('.has-error').length==0){
                    var noOfApprover = $('#noOfApprover').val();
                    var noOfUser = $('#noOfUser').val();
                    var appLevel = $('#appLevel').val();
                    var branchOpt = $('#branch').val();
                    validateAddList(noOfApprover, noOfUser, appLevel, branchOpt);
                }
            // });

        });

        function submitData(submitAction){
            var value = {
                "id": $('#appMatrixId').val(),
                "noOfApprover": $('#noOfApprover_1').val(),
                "approvalMatrixMenuCode": $('#appMenuCode_1').val(),
                "approvalMatrixMenuName": $('#appMenuName_1').val(),
                "bankApprovalMatrixDetailList": submit_data,
            };

            var url_action = "submit";
            
             $.ajax({
                    url: 'getAPIData',
                    method: 'post',
                    data: {"_token": "{{ csrf_token() }}", menu: id, value: value, url_action: url_action, action: submitAction},
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


        $('#confirm').on('click', function () {

            if(oTable.data().count()<1){
                var content ='{{trans('form.alert_empty',['label'=>'Detail'])}}';
                $.alert({
                    title: '{{trans('form.warning')}}',
                    content: content
                });
                return;
            }

            setTimeout(function(){
                $('#submit_type').val('submit');
                submit_data = getTableData();
                stateView();
            });

        });

        $('#back_view').on('click', function () {
            $(this).prop('disabled',true);

            if($('#state').val() == 'success'){
                var action = '';
                if($('#submit_type').val()=='submit'){
                    action = 'landing';
                }else{
                    action = 'add';
                }
                app.setView(id,action)
                return;
            } else {
                $('#back_view').prop('disabled',false);
                stateEdit();
            }
        });

        $('.back').on('click', function () {
            $(this).prop('disabled',true);
           
                /*var code = $('#code_edit').val();
                var cifid = $('#cifDetail').text();
				var corpCode = $('#corpCodeDetail').text();
				var name = $('#name').val();
				var status = $('#statusDetail').text();
				var res = app.setView(id,'detail');
                if(res=='done'){
                    $('#code').val(code);
					$('#cif').val(cifid);
                    $('#name').val(name);
                    $('#codeCorp').val(corpCode);
                    $('#statusCode').val(status);
                    getDetail();
                }*/
				

					var menuCode = $('#appMenuCode_1').val();
					var menuName = $('#appMenuName_1').val();

					if (menuCode !== undefined) {
						var res = app.setView(id,'detail');
						if(res=='done'){
							$('#appMenuCode').val(menuCode);
							$('#appMenuName').val(menuName);
							getDetail();
						}
					}
				 
                
            
        });

        $('#done').on('click', function () {
            $(this).prop('disabled',true);
            app.setView(id,'landing');
        });

        $('.numeric').numeric({
            allowSpace: false,
            allowMinus: false,
            allowThouSep : false,
            allowDecSep : false,
            allow : ''
        });

        $('input[type="text"]').not('.numeric').alphanum({
            allowSpace: true,
            allow : '<>=,._!@-'
        });
    });
    

        function stateEdit() {

            $('#state').val('edit');
            $('.state_view').hide();
            $('.state_edit').show();
            $('label.state_view').text('-');
            $('#save_screen').hide();
            $('.help-block').show();
            $('#done').hide();
            $('#next_user').hide();
        }

        function stateView() {
            $('#state').val('view');

            $('.state_edit').hide();
            $('.state_view').show();
            
            $('#save_screen').hide();
            $('.help-block').hide();
            $('#done').hide();
            $('#next_user').hide();

        }

        function stateSuccess() {
            $('#state').val('success');
            $('#name').val('');
            $('input.state_edit').val('');
            $('input.check').attr('checked', '');
            $('#back_view').hide();
            $('#save_screen').show();
            $('#done').show();
            $('#next_user').show();
        }

        function validateAddList(noOfApprover, noOfUser, appLevel, branchOpt){

            if (noOfApprover <= 0) {
                flash('warning', 'Number of Approver must be greater than 0');
                return false;
            }


            var sequenceNo = parseInt(oTable.rows().count());
            var appLevelName = $('#appLevel').find(':selected').attr('data-lvlName');
            var branchName = $('#branch').find(':selected').text();

            oTable.row.add([

                (sequenceNo+1) +'<input type=hidden id="seqCount" value="' + (sequenceNo+1) + '">',
                noOfUser + '<input type=hidden id="noOfUserHidden" value="' + noOfUser + '">',
                appLevel + " - " + appLevelName + '<input type=hidden id="appLevelHidden" value="' + appLevel + '">'+ '<input type=hidden id="appLevelNameHidden" value="' + appLevelName + '">',
                branchName + '<input type=hidden id="branchOptHidden" value="' + branchOpt + '">' + '<input type=hidden id="branchOptNameHidden" value="' + branchName + '">',
            ]).draw(true);


        }

        function removeRow(el){
            var row = $(el).parent().parent();
            oTable.row(row).remove().draw(true);
        }

        function getTableData() {
            var data = [];

            var menuCode = $('#appMenuCode_1').val();
            var menuName = $('#appMenuName_1').val();
            var approverNo = $('#noOfApprover').val();
            $('#appMenuCode_view').text(menuCode + " - " + menuName);
            $('#noOfApprover_view').text(approverNo);
            $('#noOfApprover_1').val(approverNo);

            $("#list").find("tbody tr").each(function () {
                var appLevelCode = $('td:eq(2)', $(this)).find('#appLevelHidden').val();
                var appLevelName = $('td:eq(2)', $(this)).find('#appLevelNameHidden').val();
                var noUser = $('td:eq(1)', $(this)).find('#noOfUserHidden').val();
                var branchOptCode = $('td:eq(3)', $(this)).find('#branchOptHidden').val();
                var branchOptName = $('td:eq(3)', $(this)).find('#branchOptNameHidden').val();

                var obj = {
                    approvalLevelCode: appLevelCode,
                    approvalLevelName: appLevelName,
                    menuCode: menuCode,
                    menuName: menuName,
                    noOfUser: noUser,
                    branchOpt: branchOptCode,
                    branchOptName: branchOptName

                };

                data.push(obj);

            });

            return data;
        }

        function getDetailEdit(){

            var url_action= 'searchBankApprovalMatrixDetail';
            var value ={
                approvalMatrixMenuCode:$('#appMenuCode_1').val(),
                currentPage: "1",
                pageSize: "50",
            };
            $.ajax({
                url: 'getAPIData',
                method: 'post',
                data:{value:value,menu:id,action:'DETAIL',url_action:url_action},
                success: function (data) {
                    var result = JSON.parse(data);
                    var detail = result.result;
                    if (result.status=="200") {
                        
                        if (detail[0].bankApprovalMatrixDetailList) {
                            $.each(detail[0].bankApprovalMatrixDetailList, function (idx, obj){

                                var branchOpt = obj.branchOpt;
                                var branchOpt_view = "";
                                if (branchOpt == "PARENT") {
                                    branchOpt_view = "Parent Branch";
                                } else {
                                    branchOpt_view = "Same Branch"
                                }

                                oTable.row.add([
                                    obj.sequenceNo+'<input type=hidden id="sequenceHidden" value="'+obj.sequenceNo+'">',
                                    obj.noOfUser+'<input type=hidden id="noOfUserHidden" value="'+obj.noOfUser+'">',
                                    obj.approvalLevelCode+ " - " + obj.approvalLevelName+'<input type=hidden id="appLevelHidden" value="'+obj.approvalLevelCode+'">'+'<input type=hidden id="appLevelNameHidden" value="'+obj.approvalLevelName+'">',
                                    branchOpt_view + '<input type=hidden id="branchOptHidden" value="' + obj.branchOpt + '">' + '<input type=hidden id="branchOptNameHidden" value="' + branchOpt_view + '">'
                                ]).draw(true);
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
                    $('#appMenuCode').val($('#appMenuCode_1').val() + " - " + $('#appMenuName_1').val());
                    $('#appMenuCode').prop('disabled',true);
                    $('#noOfApprover').val($('#noOfApprover_1').val());
                }
            });
        }

        function getApprovalLevelDroplist(){

            var value = {
                code: ""
            };
            var url_action = 'getApprovaLevelforDroplist';
            var action = 'SEARCH';
            var menu = '{{ $service }}';
            
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
                        unitOption = '';
                        $.each(result.result, function (idx, obj) {
                          unitOption += '<option value="' + obj.code + '" data-lvlName="'+obj.name+ '">'+ obj.code + ' - ' + obj.name + '</option>';
                        });
                        $('#appLevel').html(unitOption);
                        $('#appLevel').select2();
                    } else {
                        flash('warning', result.message);
                    }
                }, error: function (xhr, ajaxOptions, thrownError) {
                    var msg = '{{trans('form.conn_error')}}';
                    flash('warning', msg);
                    console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                }, complete: function (data) {
                
                }
            });


        }


</script>