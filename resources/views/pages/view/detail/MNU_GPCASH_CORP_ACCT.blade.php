@include('_partials.header_content',['breadcrumb'=>['corporate account','detail']])

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <input type="hidden" id="code" value=""/>
            <input type="hidden" id="name" value=""/>
            <div class="box">
                
                <div class="box-header detail">
                    <span id="detail" class="detail" style="color:darkred;"><small><i>Detail</i></small></span>
                </div>
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
                    <div class="container-fluid">
                        <div class="box-body">
                           <div class="row table-hidden">
                               <div class="form-group">
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th></th>
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
    var oTable;
    var currencyOption;
    var id = 'MNU_GPCASH_CORP_ACCT';
    $(document).ready(function () {
        $('.table-hidden').hide();
        $('.state_delete').hide();


        oTable = $('#list').DataTable({
            //"paging" : false,
            "ordering" : false,
            "info": false,
            "destroy": true,
            "select": {
                style: 'multi',
                selector: 'input.dt-checkboxes'
            },
            "searching": false,
            "autoWidth":false,
            "lengthMenu": [[10, 25, 50], [10, 25, 50]],
            "columnDefs": [
                {
                    sortable: false,
                    width: "5%",
                    targets: 0,
                    checkboxes: {
                        selectRow: false,
                        selectAllPages: false
                    }
                },
                {
                    targets: 1,
                    sortable: true,
                    width: "12%"
                },
                {
                    targets: 2,
                    sortable: true,
                    width: "15%",
                    render: function ( data, type, full, meta ) {
                        return '<a href="javascript:void(0)" data-accountNo="'+data+'" id="accountNo" onClick="accountNoDetail('+data+');">'+data+'</a>';
                    }
                },
                {
                    targets: 3,
                    sortable: true,
                    width: "20%"
                },

                {
                    targets: 4,
                    sortable: true,
                    width: "5%",
                    className: "dt-center"
                },
                {
                    targets: 5,
                    sortable: true,
                    width: "15%"
                },
                {
                    targets: 6,
                    sortable: false,
                    width: "7%",
                    className: "dt-center",
                    "render": function ( data, type, row ) {
                        if(data=="Y"){
                            return '<input type="hidden" id="isAllowInquiry" value="'+data+'"><span class="label label-success">&nbsp;&nbsp;YES&nbsp;&nbsp;</span>'
                        }else{
                            return '<input type="hidden" id="isAllowInquiry" value="'+data+'"><span class="label label-danger">&nbsp;&nbsp;NO&nbsp;&nbsp;</span>'
                        }
                    }
                },
                {
                    targets: 7,
                    sortable: false,
                    width: "7%",
                    className: "dt-center",
                    "render": function ( data, type, row ) {
                        if(data=="Y"){
                            return '<input type="hidden" id="isAllowDebit" value="'+data+'"><span class="label label-success">&nbsp;&nbsp;YES&nbsp;&nbsp;</span>'
                        }else{
                            return '<input type="hidden" id="isAllowDebit" value="'+data+'"><span class="label label-danger">&nbsp;&nbsp;NO&nbsp;&nbsp;</span>'
                        }
                    }
                },
                {
                    targets: 8,
                    sortable: false,
                    width: "7%",
                    className: "dt-center",
                    "render": function ( data, type, row ) {
                        if(data=="Y"){
                            return '<input type="hidden" id="isAllowCredit" value="'+data+'"><span class="label label-success">&nbsp;&nbsp;YES&nbsp;&nbsp;</span>'
                        }else{
                            return '<input type="hidden" id="isAllowCredit" value="'+data+'"><span class="label label-danger">&nbsp;&nbsp;NO&nbsp;&nbsp;</span>'
                        }
                    }
                },
                {
                    targets: 9,
                    sortable: false,
                    width: "7%",
                    className: "dt-center",
                    "render": function ( data, type, row ) {
                        if(data=="N"){
                            return 'Active'
                        }else{
                            return 'Inactive'
                        }
                    }
                }

            ],
            "dom": "lfBrtip",
            "buttons": [{
                text: 'Add Account',
                action: function ( e, dt, node, config ) {
                    $(this).prop("disabled",true);
                    $.ajax({
                        url: 'getEditor/' + id,
                        method: 'post',
                        success: function (data) {
                            $(this).prop("disabled",false);
                            var code = $('#code').val();
                            var corporate = $('#code_1').text();
                            var cifid = $('#cifid').text();
                            $(window).scrollTop(0);
                            $('#content-ajax').html(data);
                            $('#type').val('add');
                            $('#code').val(code);
                            $('#code_1').text(corporate);
                            $('#cifid').text(cifid);
                        }, error: function (xhr, ajaxOptions, thrownError) {
                            $(this).prop("disabled",false);
                            console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                        }
                    });
                }
            }]
        });


        $('#edit').on('click', function () {
            $(this).prop('disabled',true);
            var submit_data = getTableData();
            $.ajax({
                url: 'getEditor/' + id,
                method: 'post',
                success: function (data) {
                    $('#edit').prop('disabled',false);
                    var code = $('#code').val();
                    var corporate = $('#code_1').text();
                    var cifid = $('#cifid').text();
                    var name = $('#name').val();
                    $(window).scrollTop(0);
                    $('#content-ajax').html(data);
                    $('#code').val(code);
                    $('#code_1').text(corporate);
                    $('#cifid').text(cifid);
                    $('#type').val('edit');
                    $('#name').val(name);
                    getData(submit_data);

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
                "corporateId": $('#code').val(),
                "corporateName": $('#name').val(),
                "cifId": $('#cifid').text(),
                "accountList": submit_data
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
        $('div.dt-buttons').css('float','right');
        $('a.dt-button').addClass('btn btn-primary');


    });

    function accountNoDetail(accountNo){
        getAccountDetail(accountNo);
    }

    function getData(code,name,cifid){
        var value = {
            corporateId: code,
            currentPage: "1",
            pageSize: "20",
            orderBy: {"account.accountNo": "ASC"}
        };
        var url_action = 'search';
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
                var detail = result.result;
                $('#code_1').text(code+' - '+name);
                $('#cifid').text(cifid);
                $('#name').val(name);
                oTable.clear();

                $.each(detail, function (idx, obj){
                    oTable.row.add([
                        '<input id="check" class="dt-checkboxes state_edit" value="" type="checkbox">',
                        obj.cifId,
                        obj.accountNo,
                        obj.accountName+'<input type=hidden id="accountName" value="'+obj.accountName+'">'+'<input type=hidden id="accountNo" value="'+obj.accountNo+'">'+'<input type=hidden id="cifId" value="'+obj.cifId+'">',
                        obj.accountCurrencyCode+'<input type=hidden id="accountCurrencyCode" value="'+obj.accountCurrencyCode+'">',
                        obj.accountTypeName+'<input type=hidden id="accountTypeName" value="'+obj.accountTypeName+'">'+'<input type=hidden id="accountTypeCode" value="'+obj.accountTypeCode+'">'+'<input type=hidden id="accountBranchCode" value="'+obj.accountBranchCode+'">',
                        obj.isAllowInquiry,
                        obj.isAllowDebit,
                        obj.isAllowCredit,
                        obj.isInactiveFlag
                    ]).draw(true);
                });


            }, error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            },
            complete: function(data) {
                $('.table-hidden').show();

            }
        });
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
                _token : '{{ csrf_token() }}'
            },
            success: function (data) {

                var result = JSON.parse(data);
                console.log(result);
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
                $('#modal_accountStatus').text((result.accountStatus=="1"?'Active':'In-Active'));

            }, error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            },
            complete: function(data) {
                $('#accountModal').appendTo("body").modal('show');

            }
        });
    }

    function getTableData() {
        var data = [];

        $("#list").find("tbody tr").each(function () {
            var check = ($('td:eq(0)', $(this)).children().is(':checked') ? 1 : 0);
            if (check == 0) {
                $('td:eq(0)', $(this)).parent().hide();
            }
            var accountNo = $('td:eq(3)', $(this)).find('#accountNo').val();
            var accountName = $('td:eq(3)', $(this)).find('#accountName').val();
            var accountCurrencyCode = $('td:eq(4)', $(this)).find('#accountCurrencyCode').val();
            var isAllowInquiry = $('td:eq(6)', $(this)).find('#isAllowInquiry').val();
            var isAllowDebit = $('td:eq(7)', $(this)).find('#isAllowDebit').val();
            var isAllowCredit = $('td:eq(8)', $(this)).find('#isAllowCredit').val();
            var isInactiveFlag = ($('td:eq(9)', $(this)).children().text()=="Active" ? 'N' : 'Y');
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
        return data;
    }




</script>