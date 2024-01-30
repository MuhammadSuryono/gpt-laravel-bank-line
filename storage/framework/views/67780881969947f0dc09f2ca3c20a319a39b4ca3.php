<?php echo $__env->make('_partials.header_content',['breadcrumb'=>[str_replace('-',' ',$menu),'Search']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<section class="content">
    <div class="row divLanding">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Corporate Filter</h3>
                </div>
                <form class="form-horizontal">

                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Corporate ID</label>

                                <div class="col-md-6">
                                    <input type="text" id="corporateId" name="corporateId" class="form-control" autocomplete="off" value="" maxlength="40">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Corporate Name</label>

                                <div class="col-md-6">
                                    <input type="text" id="name" name="name" class="form-control" autocomplete="off" value="" maxlength="100">

                                </div>
                            </div>
                        </div>
                       </div>
                </div>
                
                <div class="box-footer">
                    <button type="button" id="search" name="search" class="btn  btn-primary float-left"><?php echo app('translator')->get('form.search'); ?></button>
                </div>

                </form>
                    <div class="box-header list-title">
                        <h3 class="box-title">Corporate Listing</h3>
                    </div>
                    <div class="box-body list-title">
                        <div class="container-fluid">
                           <div class="row">
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th align="center"><strong>Corporate ID</strong></th>
                                        <th align="center"><strong>Corporate Name</strong></th>
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
        </div>
    </div>
    <div class="row divDetail">
        <div class="col-xs-12">
            <div id="notification"></div>
            <input type="hidden" id="code" value=""/>
            <input type="hidden" id="name" value=""/>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Corporate Detail</h3><br>
                </div>
                <form class="form-horizontal">
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Corporate</label>
                                <div class="col-md-6">
                                    <label id="code_1">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">CIF</label>
                                <div class="col-md-6">
                                    <label id="cifid">-</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
                    <div class="box-header">
                        <h3 class="box-title table-hidden">Account Listing</h3>
                    </div>
                    <div class="box-body">
                        
                               
                                <table id="listDetail" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <!-- <th align="center" class="dt-checkboxes-select-all"><input name="select_all" type="checkbox"></th> -->
                                        <th align="center"></th>
                                        <th align="center"><strong>Account CIF</strong></th>
                                        <th align="center"><strong>Account Number</strong></th>
                                        <th align="center"><strong>Account Name</strong></th>
                                        <th align="center"><strong>Currency</strong></th>
                                        <th align="center"><strong>Account Type</strong></th>
                                        <th align="center"><strong>Allow Inquiry</strong></th>
                                        <th align="center"><strong>Allow Debit</strong></th>
                                        <th align="center"><strong>Allow Credit</strong></th>
                                        <th align="center"><strong>Status</strong></th>
                                    </tr>
                                    </thead>

                                </table>
                               
                    </div>

                    <div class="box-footer">
                       <div class="state_view">

                               <div class="float-left">
                                   
                                   <button type="button" id="back" name="back" class="btn btn-default back"><?php echo app('translator')->get('form.back'); ?></button>
                                   <button type="button" id="save_screen" name="save_screen" class="btn btn-default" style="display:none" onclick="save_pdf();"><?php echo app('translator')->get('form.save_pdf'); ?></button>
                               </div>
                               <div class="float-right">
                                   
                                   <button type="button" id="delete" name="delete" class="btn btn-danger"><?php echo app('translator')->get('form.delete'); ?></button>
                                   <button type="button" id="edit" name="edit" class="btn btn-primary"><?php echo app('translator')->get('form.edit'); ?></button>
                                   <button type="button" id="next_user" name="next_user" class="btn btn-info"><?php echo app('translator')->get('form.next_user'); ?></button>
                                    <button type="button" id="done" name="done" class="btn btn-primary back"><?php echo app('translator')->get('form.done'); ?></button>
                               </div>
                       </div>
                   </div>
                   <?php echo $__env->make('_partials.next_user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>

</section>

<div class="modal fade" id="accountModal" tabindex="-1" role="dialog" aria-labelledby="accountModal" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Account Detail</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="row">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Corporate</label>
                            <div class="col-md-6">
                                <label id="modal_corporate">-</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Account CIF</label>
                            <div class="col-md-6">
                                <label id="modal_cif">-</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Account Number</label>
                            <div class="col-md-6">
                                <label id="modal_accountNo">-</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Account Name</label>
                            <div class="col-md-6">
                                <label id="modal_accountName">-</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Account Currency</label>
                            <div class="col-md-6">
                                <label id="modal_accountCurrency">-</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Account Type</label>
                            <div class="col-md-6">
                                <label id="modal_accountType">-</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Opening Branch</label>
                            <div class="col-md-6">
                                <label id="modal_accountBranchName">-</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Allow Inquiry</label>
                            <div class="col-md-6">
                                <label id="modal_isAllowInquiry">-</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Allow Debit</label>
                            <div class="col-md-6">
                                <label id="modal_isAllowDebit">-</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Allow Credit</label>
                            <div class="col-md-6">
                                <label id="modal_isAllowCredit">-</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Status</label>
                            <div class="col-md-6">
                                <label id="modal_accountStatus">-</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>

    var id = '<?php echo e($service); ?>';
    var oTable;

    $(document).ready(function () {
        
        var url_action = 'searchCorporate';
        var action = 'SEARCH';
        var result_key = 'result';
        var custom_order = {"id": "ASC"};

        $('#list').hide();
        $('.list-title').hide();
        $('.divDetail').hide();

        $('#search').on('click', function () {

            $(this).prop("disabled",true);
            $('#list').show();
            $('.list-title').show();
            var corporateId = $('#corporateId').val();
            var name = $('#name').val();

            var value = {
                "corporateId": '%' + corporateId + '%',
                "name": name
            };

            $('#list').DataTable({
                "destroy": true,
                "initComplete": function(settings, json) {
                    $('#search').prop("disabled",false);
                },
                "select": false,
                "searching": false,
                "lengthMenu": [[10, 25, 50], [10, 25, 50]],
                "processing": true,
                "serverSide": true,
                "autoWidth": false,
                "ScrollX": '100%',
                "columnDefs": [
                    {
                        targets: 0,
                        data: {corporateId:"corporateId",cifId:"cifId"},
                        render: function ( data, type, full, meta ) {
                            return '<a href="javascript:void(0)" data-cifid="'+data.cifId+'" data-code="'+data.corporateId+'">'+data.corporateId+'</a>';
                        },
                        orderable: true
                    },
                    {
                        targets: 1,
                        data: "name",
                        orderable: true
                    }
                ],
                "ajax": {
                    url: "fetchDataTable",
                    type:'POST',
                    data: function ( d ) {
                        d.value = value;
                        d.menu = id;
                        d.url_action = url_action;
                        d.action = action;
                        d.result_key = result_key;
                        d.custom_order = custom_order;
                        d._token = '<?php echo e(csrf_token()); ?>';
                    },
                    error:function (jqXHR, textStatus, errorThrown) {
                        var msg = '<?php echo e(trans('form.conn_error')); ?>';
                        flash('warning', msg);
                        $('#list').hide();
                        $('.list-title').hide();
                        $('#search').prop("disabled",false);
                    }
                }
            });
        });


        $('#list tbody').on('click', 'a', function (e) {

            if(e.handled !== true) // This will prevent event triggering more then once
            {
                e.handled = true;
            }
            var code = $(this).data('code');
            var cifid = $(this).data('cifid');
            var name = $(this).parent().next().text();

            preloaderVisible(true);
            getDetailConfiguration(code,cifid,name);
        });

        $('div.dt-buttons').css('float','right');
        $('a.dt-button').addClass('btn btn-primary');
        $('input[type="text"]').not('.numeric').alphanum({
            allowSpace: true,
            allow : ',._!@'
        });
    });

	function getDetailConfiguration(code,cifid,name){
		if (code !== undefined) {
                /*var res = app.setView(id,'detail');
                if(res=='done'){
                    $('#code').val(code);
                    $('#name').val(name);
                    getData(code,name,cifid);
                }*/

                $('#next_user').hide();
                $('#done').hide();

                $('#code_1').text(code+' - '+name);
                $('#cifid').text(cifid);
                $('#name').val(name);
                $('#code').val(code);

                var value = {
                    corporateId: code
                };
                var result_key_detail = "result";
                var url_action_detail = 'search';
                var action_detail = 'SEARCH';
                var custom_order_detail = {"account.accountNo": "ASC"};
                var menu = id;

                oTable = $('#listDetail').DataTable({
                    //"paging" : false,
                    "ordering" : false,
                    "info": false,
                    "destroy": true,
                    "select": {
                        style: 'multi',
                        selector: 'input.dt-checkboxes'
                    },
                    "processing": true,
                    "serverSide": true,
                    "searching": false,
                    "autoWidth":false,
                    "lengthMenu": [[10, 25, 50], [10, 25, 50]],
                    "columnDefs": [
                        {
                            sortable: false,
                            width: "5%",
                            targets: 0,
                            className: "dt-center",
                            checkboxes: {
                                selectRow: false,
                                // selectAllPages: false
                            },
                            data: "cifId",
                            render: function ( data, type, full, meta ) {
                                return '<input id="check" class="dt-checkboxes state_edit" value="" type="checkbox">';
                            }
                        },
                        {
                            targets: 1,
                            sortable: true,
                            width: "12%",
                            data: "cifId"
                        },
                        {
                            targets: 2,
                            sortable: true,
                            width: "15%",
                            data: {
                                accountNo: "accountNo"
                            },
                            render: function ( data, type, full, meta ) {

                                return '<a href="javascript:void(0)" data-accountNo="'+data.accountNo+'" id="accountNo" onClick="accountNoDetail(\''+data.accountNo+'\');">'+data.accountNo+'</a>';
                            }
                        },
                        {
                            targets: 3,
                            sortable: true,
                            width: "20%",
                            data: {
                                accountName: "accountName",
                                accountNo: "accountNo",
                                cifId: "cifId"
                            },
                            render: function ( data, type, full, meta ) {
                                return '<input type=hidden id="accountName" value="'+data.accountName+'">'+data.accountName+'<input type=hidden id="accountNo" value="'+data.accountNo+'">'+'<input type=hidden id="cifId" value="'+data.cifId+'">';
                            }
                        },
                        {
                            targets: 4,
                            sortable: true,
                            width: "5%",
                            className: "dt-center",
                            data: {
                                accountCurrencyCode: "accountCurrencyCode"
                            },
                            render: function ( data, type, full, meta ) {
                                return '<input type=hidden id="accountCurrencyCode" value="'+data.accountCurrencyCode+'">'+data.accountCurrencyCode;
                            }
                        },
                        {
                            targets: 5,
                            sortable: true,
                            width: "15%",
                            data: {
                                accountTypeName: "accountTypeName",
                                accountTypeCode: "accountTypeCode",
                                accountBranchCode: "accountBranchCode"
                            },
                            render: function ( data, type, full, meta ) {
                                return '<input type=hidden id="accountTypeName" value="'+data.accountTypeName+'">'+data.accountTypeName+'<input type=hidden id="accountTypeCode" value="'+data.accountTypeCode+'">'+'<input type=hidden id="accountBranchCode" value="'+data.accountBranchCode+'">';
                            }
                        },
                        {
                            targets: 6,
                            sortable: false,
                            width: "7%",
                            className: "dt-center",
                            data: {
                                isAllowInquiry: "isAllowInquiry",
                                isAllowInquiryMaster: "isAllowInquiryMaster"
                            },
                            render: function ( data, type, full, meta ) {
                                var isAllowInquiry = 'NO';
                                var isAllowInquiryLabel = 'label-danger';

                                if(data.isAllowInquiry=='Y'){
                                    isAllowInquiry = 'YES';
                                    isAllowInquiryLabel = 'label-success';
                                }

                                return '<input type="hidden" id="isAllowInquiry" value="'+data.isAllowInquiry+'" data-master="'+data.isAllowInquiryMaster+'"><span class="label '+isAllowInquiryLabel+'">&nbsp;&nbsp;'+isAllowInquiry+'&nbsp;&nbsp;</span>';

                            }
                        },
                        {
                            targets: 7,
                            sortable: false,
                            width: "7%",
                            className: "dt-center",
                            data: {
                                isAllowDebit: "isAllowDebit",
                                isAllowDebitMaster: "isAllowDebitMaster"
                            },
                            render: function ( data, type, full, meta ) {
                                var isAllowDebit = 'NO';
                                var isAllowDebitLabel = 'label-danger';

                                if(data.isAllowDebit=='Y'){
                                    isAllowDebit = 'YES';
                                    isAllowDebitLabel = 'label-success';
                                }
                                
                                return '<input type="hidden" id="isAllowDebit" value="'+data.isAllowDebit+'" data-master="'+data.isAllowDebitMaster+'"><span class="label '+isAllowDebitLabel+'">&nbsp;&nbsp;'+isAllowDebit+'&nbsp;&nbsp;</span>';

                            }
                        },
                        {
                            targets: 8,
                            sortable: false,
                            width: "7%",
                            className: "dt-center",
                            data: {
                                isAllowCredit: "isAllowCredit",
                                isAllowCreditMaster: "isAllowCreditMaster"
                            },
                            render: function ( data, type, full, meta ) {
                                var isAllowCredit = 'NO';
                                var isAllowCreditLabel = 'label-danger';

                                if(data.isAllowCredit=='Y'){
                                    isAllowCredit = 'YES';
                                    isAllowCreditLabel = 'label-success';
                                }
                                
                                return '<input type="hidden" id="isAllowCredit" value="'+data.isAllowCredit+'" data-master="'+data.isAllowCreditMaster+'"><span class="label '+isAllowCreditLabel+'">&nbsp;&nbsp;'+isAllowCredit+'&nbsp;&nbsp;</span>';

                            }
                        },
                        {
                            targets: 9,
                            sortable: false,
                            width: "7%",
                            className: "dt-center",
                            data: {
                                isInactiveFlag:"isInactiveFlag"
                            },
                            render: function ( data, type, full, meta ) {
                                if(data.isInactiveFlag=="N"){
                                    return 'Active'
                                } else {
                                    return 'Inactive'
                                }
                            }
                        }

                    ],
                    "dom": "lfBrtip",
                    "buttons": [{
                        text: 'Add Account',
                        action: function ( e, dt, node, config ) {
                            var code = $('#code').val();
                            var corporate = $('#code_1').text();
                            var cifid = $('#cifid').text();
                            var name = $('#name').val();
                            var res = app.setView(id,'add');
                            if(res=='done'){
                                $('#type').val('add');
                                $('#code').val(code);
                                $('#name').val(name);
                                $('#code_1').text(corporate);
                                $('#cifid').text(cifid);
                            }
                        }
                    }],
                    "ajax": {
                        url: "fetchDataTable",
                        type:'POST',
                        data: function ( d ) {
                            d.value = value;
                            d.menu = id;
                            d.url_action = url_action_detail;
                            d.action = action_detail;
                            d.result_key = result_key_detail;
                            d.custom_order = custom_order_detail;
                            d._token = '<?php echo e(csrf_token()); ?>';
                        },
                        error:function (jqXHR, textStatus, errorThrown) {
                            var msg = '<?php echo e(trans('form.conn_error')); ?>';
                            flash('warning', msg);
                            console.log(jqXHR.status + " ," + " " + textStatus + ", " + errorThrown);

                        },complete: function(data) {
                            $('.table-hidden').show();
                            $('.divDetail').show();
                            $('.divLanding').hide();
                            $('div.dt-buttons').css('float','right');
                            $('a.dt-button').addClass('btn btn-primary');
                        }
                    }
                });

                $('.back').on('click', function () {
                   var res = app.setView(id,'landing');
                });

                $('#edit').on('click', function () {
                    if(countMenu()==0){
                        var content ='<?php echo e(trans('form.alert_noselect',['label'=>'Account'])); ?>';
                        $.alert({
                            title: '<?php echo e(trans('form.warning')); ?>',
                            content: content
                        });
                        return;
                    }
                    var submit_data = getTableData();
                    var code = $('#code').val();
                    var corporate = $('#code_1').text();
                    var cifid = $('#cifid').text();
                    var name = $('#name').val();

                    // console.log("code=" + code + " corporate="+ corporate + " cifId="+cifid + " name="+name)

                    var res = app.setView(id,'add');
                    if(res=='done'){
                        $('#type').val('edit');
                        $('#breadcrumb-action').html('edit');
                        $('#code').val(code);
                        $('#code_1').text(corporate);
                        $('#cifid').text(cifid);
                        $('#name').val(name);
                        getData(submit_data);
                        
                    }
                });

                $('#delete').on('click', function () {
                    if(countMenu()==0){
                        var content ='<?php echo e(trans('form.alert_noselect',['label'=>'Account'])); ?>';
                        $.alert({
                            title: '<?php echo e(trans('form.warning')); ?>',
                            content: content
                        });
                        return;
                    }

                    $(this).prop('disabled',true);
                    $.confirm({
                        title: '<?php echo e(trans('form.delete')); ?>',
                        content: '<?php echo e(trans('form.confirm_delete')); ?>',
                        buttons: {
                            
                            cancel: {
                                text: '<?php echo e(trans('form.cancel')); ?>',
                                btnClass: 'btn-default',
                                action: function(){
                                    $('#delete').prop('disabled',false);
                                }
                            },
                            confirm: {
                                text: '<?php echo e(trans('form.delete')); ?>',
                                btnClass: 'btn-primary',
                                action: function(){
                                    submit_delete();
                                }
                            }

                        }
                    });
                });

                function submit_delete () {
                    var submit_data = getTableData();

                    var value = {
                        "corporateId": $('#code').val(),
                        "name": $('#name').val(),
                        "cifId": $('#cifid').text(),
                        "accountList": submit_data
                    };

                    $.ajax({
                        url: 'delete',
                        method: 'post',
                        data: {"_token": "<?php echo e(csrf_token()); ?>", menu: id, value: value,url_action:'submitDelete'},
                        success: function (data) {
                            $('#delete').prop('disabled',false);
                            var result = JSON.parse(data);
                            if (result.status=="200") {
                                noRef=result.referenceNo;
                                flash('success', result.message+'<br>'+'ReferenceNo: '+ result.referenceNo+'<br>'+result.dateTimeInfo);
                                $('#submit_view').hide();
                                $('#edit').hide();
                                $('#delete').hide();
                                // $('#back').html('<?php echo e(trans('form.done')); ?>');

                                $('.dt-buttons').hide();
                                $('#back').hide();
                                $('#next_user').show();
                                $('#done').show();
                                $('#save_screen').show();

                                oTable.column(0).visible(false);
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
                
            }
	}
	
    function accountNoDetail(accountNo){
        getAccountDetail(accountNo);
    }

    function getAccountDetail(accountNo){
        var value = {
            accountNo: accountNo
        };
        var url_action = 'searchOnlineByAccountNo';
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
                    $('#modal_corporate').text(result.accountNo+' - '+result.accountName);
                    $('#modal_cif').text(result.cifId);
                    $('#modal_accountNo').text(result.accountNo);
                    $('#modal_accountName').text(result.accountName);
                    $('#modal_accountCurrency').text(result.accountCurrencyName);
                    $('#modal_accountType').text(result.accountTypeName);
                    $('#modal_accountBranchName').text(result.accountBranchName);
                    $('#modal_isAllowInquiry').text((result.isAllowInquiry=="Y"?'Yes':'No'));
                    $('#modal_isAllowDebit').text((result.isAllowDebit=="Y"?'Yes':'No'));
                    $('#modal_isAllowCredit').text((result.isAllowCredit=="Y"?'Yes':'No'));
                    $('#modal_accountStatus').text((result.accountStatus=="N"?'Active':'In-Active'));
                    $('#accountModal').modal('show');
                } else {
                     flash('warning', result.message);
                }


            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '<?php echo e(trans('form.conn_error')); ?>';
                flash('warning', msg);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            },
            complete: function(data) {

            }
        });
    }

    function countMenu(){
        var count = 0;
        $("#listDetail").find("tbody tr").each(function () {
            var check = ($('td:eq(0)', $(this)).children().is(':checked') ? 1 : 0);

            if (check == 1) {
                count++;
            }
        });
        return count;
    }

    function getTableData() {
        var data = [];

        $("#listDetail").find("tbody tr").each(function () {
            var check = ($('td:eq(0)', $(this)).children().is(':checked') ? 1 : 0);
            if (check == 0) {
                $('td:eq(0)', $(this)).parent().hide();
            }
            // var accountNo = $('td:eq(3)', $(this)).find('#accountNo').val();
            var accountNo = $('td:eq(2)', $(this)).find('#accountNo').attr('data-accountNo');
            var accountName = $('td:eq(3)', $(this)).find('#accountName').val();
            var accountCurrencyCode = $('td:eq(4)', $(this)).find('#accountCurrencyCode').val();
            var isAllowInquiry = $('td:eq(6)', $(this)).find('#isAllowInquiry').val();
            var isAllowDebit = $('td:eq(7)', $(this)).find('#isAllowDebit').val();
            var isAllowCredit = $('td:eq(8)', $(this)).find('#isAllowCredit').val();
            var isAllowInquiryMaster = $('td:eq(6)', $(this)).children().attr('data-master');
            var isAllowDebitMaster = $('td:eq(7)', $(this)).children().attr('data-master');
            var isAllowCreditMaster = $('td:eq(8)', $(this)).children().attr('data-master');
            var isInactiveFlag = ($('td:eq(9)', $(this)).html()=="Active" ? 'N' : 'Y');
            var accountTypeCode = $('td:eq(5)', $(this)).find('#accountTypeCode').val();
            var accountTypeName = $('td:eq(5)', $(this)).find('#accountTypeName').val();
            var accountBranchCode = $('td:eq(5)', $(this)).find('#accountBranchCode').val();
            var cifId = $('td:eq(3)', $(this)).find('#cifId').val();
            var obj = {
                accountNo: accountNo,
                accountName: accountName,
                accountCurrencyCode:accountCurrencyCode,
                isAllowInquiry:isAllowInquiry,
                isAllowDebit:isAllowDebit,
                isAllowCredit:isAllowCredit,
                isAllowDebitMaster:isAllowDebitMaster,
                isAllowCreditMaster:isAllowCreditMaster,
                isAllowInquiryMaster:isAllowInquiryMaster,
                isInactiveFlag:isInactiveFlag,
                accountTypeCode:accountTypeCode,
                accountBranchCode:accountBranchCode,
                accountTypeName:accountTypeName,
                cifId:cifId
            };
            if (check == 1) {
                data.push(obj);
            }
        });
        //console.log("data",data);
        return data;
    }

    /*function backEditToDetail(corpId) {

        $('.divLanding').hide();
        $('.divDetail').show();

    }*/


</script><?php /**PATH D:\Downloads\Upgrade Laravel Framework\bank-line\resources\views/bank-line/MNU_GPCASH_CORP_ACCT/landing.blade.php ENDPATH**/ ?>