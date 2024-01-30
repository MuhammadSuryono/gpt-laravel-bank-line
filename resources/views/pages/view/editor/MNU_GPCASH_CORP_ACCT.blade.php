@include('_partials.header_content',['breadcrumb'=>['corporate account','add']])

<section class="content">
    <div  class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <input type="hidden" id="code" value=""/>
            <div id="print" class="box">
                <div id="spinner" style="display:none"></div>
                <div class="box-header state_view">
                    <span id="preview" class="state_view" style="color:darkred;display:none;"><small><i>Preview</i></small></span>
                </div>
                <div class="box-header">
                     <h3 class="box-title">Corporate Detail</h3>
                </div>
                <form class="form-horizontal">
                <input type="hidden" id="code_edit" value=""/>
                <input type="hidden" id="name" value=""/>
                <input type="hidden" id="type" value=""/>
                <input type="hidden" id="state" value=""/>
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Corporate</label>
                                <div class="col-md-6">
                                    <label id="code_1" name="code">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">CIF</label>
                                <div class="col-md-6">
                                    <label id="cifid" name="cifid">-</label>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                </form>
                <div class="box-header list_add">
                    <h3 class="box-title table-hidden">Account Filter</h3>
                </div>
                <div class="container-fluid list_add">
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Search By</label>
                                <div class="col-md-6">
                                    <input type="radio" id="rb_filter_cif" name="rb_filter" value="cif" checked> CIF
                                    <div class="filter_cif_container">
                                    <select class="form-control" id="filter_cif" name="filter_cif"></select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label"></label>
                                <div class="col-md-6">
                                    <input type="radio" id="rb_filter_accountNo" name="rb_filter" value="accountNo"> Account No
                                    <input type="text" id="filter_accountNo" name="filter_accountNo" class="form-control" autocomplete="off" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label"></label>
                                    <div class="col-md-6">
                                        <button type="button" id="filter_submit" name="filter_submit" class="btn btn-default">Search</button>
                                    </div>
                            </div>
                        </div>
                        <div class="row table-hidden">
                            <div class="form-group">
                                <table id="list_add" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th align="center"><strong>Account Number</strong></th>
                                        <th align="center"><strong>Account Name</strong></th>
                                        <th align="center"><strong>Currency</strong></th>
                                        <th align="center"><strong>Account Type</strong></th>
                                        <th align="center"><strong>Allow Inquiry</strong></th>
                                        <th align="center"><strong>Allow Debit</strong></th>
                                        <th align="center"><strong>Allow Credit</strong></th>
                                        <th align="center"><strong>Status</strong></th>
                                        <th align="center"><strong><button id="add_all" class="btn btn-primary">Add ALL to List</button></strong></th>
                                     </tr>
                                    </thead>

                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="box-header">
                    <h3 class="box-title table-hidden">Account Listing</h3>
                </div>
                <div class="container-fluid">
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group">
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th align="center"><strong>Account Number</strong></th>
                                        <th align="center"><strong>Account Name</strong></th>
                                        <th align="center"><strong>Currency</strong></th>
                                        <th align="center"><strong>Account Type</strong></th>
                                        <th align="center"><strong>Allow Inquiry</strong></th>
                                        <th align="center"><strong>Allow Debit</strong></th>
                                        <th align="center"><strong>Allow Credit</strong></th>
                                        <th align="center" colspan="2"><strong>Status</strong></th>

                                    </tr>
                                    </thead>

                                </table>
                            </div>
                            <div class="row">
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
        </div>
    </div>

</section>

<script>
    var oTable;
    var oTable_add;
    var currencyOption;
    var id = 'MNU_GPCASH_CORP_ACCT';
    $(document).ready(function () {
        //$('.list_add').hide();
        $('.table-hidden').hide();
        $('#filter_accountNo').hide();
        var submit_data;
        $("input[name='rb_filter']").change(function(){
          if($("input[name='rb_filter']:checked").val()=="accountNo"){
              $('.filter_cif_container').hide();
              $('#filter_accountNo').show();
          }else{
              $('.filter_cif_container').show();
              $('#filter_accountNo').hide();
          }
        });

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
                    sortable: true,
                    width: "20%"
                },
                {
                    targets: 1,
                    sortable: true,
                    width: "20%"
                },

                {
                    targets: 2,
                    sortable: true,
                    width: "5%",
                    className: "dt-center"
                },
                {
                    targets: 3,
                    sortable: true,
                    width: "15%"
                },
                {
                    targets: 4,
                    sortable: false,
                    width: "10%",
                    className: "dt-center",
                    "render": function ( data, type, row ) {
                        if(data=="Y"){
                            return '<input type="checkbox" id="isAllowInquiry" checked><div id="isAllowInquiry_label"></div>'
                        }else{
                            return '<input type="checkbox" id="isAllowInquiry"><div id="isAllowInquiry_label"></div>'
                        }
                    }
                },
                {
                    targets: 5,
                    sortable: false,
                    width: "10%",
                    className: "dt-center",
                    "render": function ( data, type, row ) {
                        if(data=="Y"){
                            return '<input type="checkbox" id="isAllowDebit" checked><div id="isAllowDebit_label"></div>'
                        }else{
                            return '<input type="checkbox" id="isAllowDebit"><div id="isAllowDebit_label"></div>'
                        }
                    }
                },
                {
                    targets: 6,
                    sortable: false,
                    width: "10%",
                    className: "dt-center",
                    "render": function ( data, type, row ) {
                        if(data=="Y"){
                            return '<input type="checkbox" id="isAllowCredit" checked><div id="isAllowCredit_label"></div>'
                        }else{
                            return '<input type="checkbox" id="isAllowCredit"><div id="isAllowCredit_label"></div>'
                        }
                    }
                },
                {
                    targets: 7,
                    sortable: false,
                    width: "10%",
                    className: "dt-center",
                    "render": function ( data, type, row ) {
                        if(data=="1"){
                            return 'Active'
                        }else{
                            return 'In-Active'
                        }
                    }
                },

                {
                    targets: 8,
                    sortable: false,
                    width: "10%",
                    className: "dt-center",
                    render: function ( data, type, full, meta ) {
                        return '<button data-cif="'+data+'" class="btn btn-danger" onClick="removeRow(this);" style="width:100px;">Remove</button>';
                    }
                }

            ]
        });

        oTable_add = $('#list_add').DataTable({
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
                    sortable: true,
                    width: "20%"
                },
                {
                    targets: 1,
                    sortable: true,
                    width: "20%"
                },

                {
                    targets: 2,
                    sortable: true,
                    width: "5%",
                    className: "dt-center"
                },
                {
                    targets: 3,
                    sortable: true,
                    width: "15%"
                },
                {
                    targets: 4,
                    sortable: false,
                    width: "10%",
                    className: "dt-center",
                    "render": function ( data, type, row ) {
                        if(data=="Y"){
                            return '<input type="checkbox" id="isAllowInquiry" onclick="return false;" checked>'
                        }else{
                            return '<input type="checkbox" id="isAllowInquiry" onclick="return false;">'
                        }
                    }
                },
                {
                    targets: 5,
                    sortable: false,
                    width: "10%",
                    className: "dt-center",
                    "render": function ( data, type, row ) {
                        if(data=="Y"){
                            return '<input type="checkbox" id="isAllowDebit" onclick="return false;" checked>'
                        }else{
                            return '<input type="checkbox" id="isAllowDebit" onclick="return false;">'
                        }
                    }
                },
                {
                    targets: 6,
                    sortable: false,
                    width: "10%",
                    className: "dt-center",
                    "render": function ( data, type, row ) {
                        if(data=="Y"){
                            return '<input type="checkbox" id="isAllowCredit" onclick="return false;" checked>'
                        }else{
                            return '<input type="checkbox" id="isAllowCredit" onclick="return false;">'
                        }
                    }
                },

                {
                    targets: 7,
                    sortable: false,
                    width: "10%",
                    className: "dt-center",
                    "render": function ( data, type, row ) {
                        if(data=="1"){
                            return 'Active'
                        }else{
                            return 'In-Active'
                        }
                    }
                },
                {
                    targets: 8,
                    sortable: false,
                    width: "10%",
                    className: "dt-center",
                    render: function ( data, type, full, meta ) {
                        return '<button data-cif="'+data+'" class="btn btn-default add_list" style="width:100px;">Add to List</button>';
                    }
                }

            ],
            "drawCallback": function( settings ) {


            }
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
                "corporateId": $('#code').val(),
                "corporateName": $('#name').val(),
                "cifId": $('#cifid').text(),
                "accountList": submit_data
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

        $("#filter_cif").select2({
            ajax: {
                url: "getAPIData",
                dataType: 'json',
                method: 'post',
                delay: 250,
                data: function (params) {
                    return {
                        value: {corporateId:params.term,name:'',currentPage: '1',
                            pageSize: '20'}, // search term
                        action: 'SEARCH',
                        menu : id,
                        url_action : 'searchCorporate',

                        custom_order : {"id": "ASC"},
                        _token : '{{ csrf_token() }}'
                    };
                },
                processResults: function (data, params) {
                    return {
                        results: $.map(data.result, function(obj) {
                            return { id: obj.cifId, text: obj.corporateId+' - '+obj.name };
                        })
                    };
                },

                cache: true
            },
            escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
            minimumInputLength: 1
        });


        $('#confirm').on('click', function () {
            submit_data = getTableData();
            stateView();
        });

        $('#back_view').on('click', function () {
            $(this).prop('disabled',true);
            if($('#state').val() == 'success'){
                $.ajax({
                    url: 'getView/'+id,
                    method: 'post',
                    success: function (data) {
                        $('#back_view').prop('disabled',false);
                        $(window).scrollTop(0);
                        $('#content-ajax').html(data);


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

        $('#filter_submit').on('click', function () {
            if($("input[name='rb_filter']:checked").val()=="accountNo"){
                var accountNo = $('#filter_accountNo').val();
                getFilterAccountNo(accountNo);
            }else{
                var cifId = $('#filter_cif').val();
                getFilterCIF(cifId);
            }

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
                        $('#content-ajax').html(data);


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
                        var code = $('#code').val();
                        var cifid = $('#cifid').text();
                        var name = $('#name').val();
                        $('#content-ajax').html(data);
                        $('#code').val(code);
                        getData(code,name,cifid);

                    }, error: function (xhr, ajaxOptions, thrownError) {
                        $('.back').prop('disabled',false);
                        console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                    }
                });
            }
        });

        $('#add_all').on('click', function () {
            $("#list_add").find("tbody tr").each(function () {
                var $row = $(this);
                var addRow = oTable_add.row($row).data();
                if(checkDuplicateList(addRow[0])){
                    oTable.row.add(addRow).draw(true);
                    oTable_add.row($row).remove().draw(true);
                }
            });

        });

    });

    function removeRow(el){
        var row = $(el).parent().parent();
        oTable.row(row).remove().draw(true);
    }

    function getFilterCIF(cifid){
        var value = {
            cifId: cifid

        };
        var url_action = 'searchOnlineByCIF';
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
                var detail = result.accountList;
               oTable_add.clear();

                $.each(detail, function (idx, obj){
                    oTable_add.row.add([
                        obj.accountNo+'<input type=hidden id="accountNo" value="'+obj.accountNo+'">'+'<input type=hidden id="cifId" value="'+result.cifId+'">',
                        obj.accountName+'<input type=hidden id="accountName" value="'+obj.accountName+'">',
                        obj.accountCurrencyCode+'<input type=hidden id="accountCurrencyCode" value="'+obj.accountCurrencyCode+'">',
                        obj.accountTypeName+'<input type=hidden id="accountTypeName" value="'+obj.accountTypeName+'">'+'<input type=hidden id="accountTypeCode" value="'+obj.accountTypeCode+'">'+'<input type=hidden id="accountBranchCode" value="'+obj.accountBranchCode+'">',
                        obj.isAllowInquiry,
                        obj.isAllowDebit,
                        obj.isAllowCredit,
                        obj.accountStatus
                    ]).draw(true);
                });


            }, error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            },
            complete: function(data) {
                oTable.clear();
                $('.table-hidden').show();
                $('.add_list').on('click', function () {
                    var $row = $(this).parent().parent();
                    var addRow = oTable_add.row($row).data();
                    if(checkDuplicateList(addRow[0])){

                    oTable.row.add(addRow).draw(true);
                    oTable_add.row($row).remove().draw(true);
                    }
                });
            }
        });
    }

    function getFilterAccountNo(accountNo){
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
                oTable_add.clear();

                    oTable_add.row.add([
                        result.accountNo+'<input type=hidden id="accountNo" value="'+result.accountNo+'">'+'<input type=hidden id="cifId" value="'+result.cifId+'">',
                        result.accountName+'<input type=hidden id="accountName" value="'+result.accountName+'">',
                        result.accountCurrencyCode+'<input type=hidden id="accountCurrencyCode" value="'+result.accountCurrencyCode+'">',
                        result.accountTypeName+'<input type=hidden id="accountTypeName" value="'+result.accountTypeName+'">'+'<input type=hidden id="accountTypeCode" value="'+result.accountTypeCode+'">'+'<input type=hidden id="accountBranchCode" value="'+result.accountBranchCode+'">',
                        result.isAllowInquiry,
                        result.isAllowDebit,
                        result.isAllowCredit,
                        result.accountStatus
                    ]).draw(true);



            }, error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            },
            complete: function(data) {
                oTable.clear();
                $('.table-hidden').show();
                $('.add_list').on('click', function () {
                    var $row = $(this).parent().parent();
                    var addRow = oTable_add.row($row).data();
                    console.log(checkDuplicateList(addRow[0]));
                    if(checkDuplicateList(addRow[0])){
                        oTable.row.add(addRow).draw(true);
                        oTable_add.row($row).remove().draw(true);
                    }
                });
            }
        });
    }

    function checkDuplicateList(accountNo){
        var duplicate = 0;
        $("#list").find("tbody tr").each(function () {
            var list_accountNo = $('td:eq(0)', $(this)).find('#accountNo').val();
            if(accountNo==list_accountNo){
                duplicate = 1;
            }
        });

        if(duplicate==1){
            return false;
        }else{
            return true;
        }

    }


        function getData(data) {
            $('.list_add').hide();
            oTable.clear();
            oTable.column(8).visible(false);
            if(data!=undefined)
            $.each(data, function (idx, obj){
                oTable.row.add([
                    obj.accountNo+'<input type=hidden id="accountNo" value="'+obj.accountNo+'">'+'<input type=hidden id="cifId" value="'+obj.cifId+'">',
                    obj.accountName+'<input type=hidden id="accountName" value="'+obj.accountName+'">',
                    obj.accountCurrencyCode+'<input type=hidden id="accountCurrencyCode" value="'+obj.accountCurrencyCode+'">',
                    obj.accountTypeName+'<input type=hidden id="accountTypeName" value="'+obj.accountTypeName+'">'+'<input type=hidden id="accountTypeCode" value="'+obj.accountTypeCode+'">'+'<input type=hidden id="accountBranchCode" value="'+obj.accountBranchCode+'">',
                    obj.isAllowInquiry,
                    obj.isAllowDebit,
                    obj.isAllowCredit,
                    obj.accountStatus
                ]).draw(true);
            });
        }


        function getTableData() {
            var data = [];

            $("#list").find("tbody tr").each(function () {

                var accountNo = $('td:eq(0)', $(this)).find('#accountNo').val();
                var accountName = $('td:eq(1)', $(this)).find('#accountName').val();
                var accountCurrencyCode = $('td:eq(2)', $(this)).find('#accountCurrencyCode').val();
                var isAllowInquiry = ($('td:eq(4)', $(this)).children().is(':checked') ? 'Y' : 'N');
                var isAllowDebit = ($('td:eq(5)', $(this)).children().is(':checked') ? 'Y' : 'N');
                var isAllowCredit = ($('td:eq(6)', $(this)).children().is(':checked') ? 'Y' : 'N');
                var isInactiveFlag = ($('td:eq(6)', $(this)).children().text()=="Active" ? 'N' : 'Y');
                var accountTypeCode = $('td:eq(3)', $(this)).find('#accountTypeCode').val();
                var accountTypeName = $('td:eq(3)', $(this)).find('#accountTypeName').val();
                var accountBranchCode = $('td:eq(3)', $(this)).find('#accountBranchCode').val();
                var cifId = $('td:eq(0)', $(this)).find('#cifId').val();
                var obj = {
                    accountNo: accountNo,
                    accountName: accountName,
                    accountCurrencyCode:accountCurrencyCode,
                    isAllowInquiry:isAllowInquiry,
                    isAllowDebit:isAllowDebit,
                    isAllowCredit:isAllowCredit,
                    isInactiveFlag:isInactiveFlag,
                    accountTypeCode:accountTypeCode,
                    accountTypeName:accountTypeName,
                    accountBranchCode:accountBranchCode,
                    cifId:cifId
                };

                    data.push(obj);

            });
            return data;
        }

    function addCheckboxLabel() {


        $("#list").find("tbody tr").each(function () {
            var isAllowInquiry = ($('td:eq(4)', $(this)).children().is(':checked') ? 1 : 0);
            var isAllowDebit = ($('td:eq(5)', $(this)).children().is(':checked') ? 1 : 0);
            var isAllowCredit = ($('td:eq(6)', $(this)).children().is(':checked') ? 1 : 0);

            if(isAllowInquiry==1){
                $('td:eq(4)', $(this)).children().eq(0).hide();
                $('td:eq(4)', $(this)).children().eq(1).html('<span class="label label-success">&nbsp;&nbsp;YES&nbsp;&nbsp;</span>');

            }else{
                $('td:eq(4)', $(this)).children().eq(0).hide();
                $('td:eq(4)', $(this)).children().eq(1).html('<span class="label label-danger">&nbsp;&nbsp;NO&nbsp;&nbsp;</span>');

            }
            if(isAllowDebit==1){
                $('td:eq(5)', $(this)).children().eq(0).hide();
                $('td:eq(5)', $(this)).children().eq(1).html('<span class="label label-success">&nbsp;&nbsp;YES&nbsp;&nbsp;</span>');
            }else{
                $('td:eq(5)', $(this)).children().eq(0).hide();
                $('td:eq(5)', $(this)).children().eq(1).html('<span class="label label-danger">&nbsp;&nbsp;NO&nbsp;&nbsp;</span>');

            }
            if(isAllowCredit==1){
                $('td:eq(6)', $(this)).children().eq(0).hide();
                $('td:eq(6)', $(this)).children().eq(1).html('<span class="label label-success">&nbsp;&nbsp;YES&nbsp;&nbsp;</span>');
            }else{
                $('td:eq(6)', $(this)).children().eq(0).hide();
                $('td:eq(6)', $(this)).children().eq(1).html('<span class="label label-danger">&nbsp;&nbsp;NO&nbsp;&nbsp;</span>');

            }
        });

    }

    function removeCheckboxLabel() {

        $("#list").find("tbody tr").each(function () {

                $('td:eq(4)', $(this)).children().eq(0).show();
                $('td:eq(4)', $(this)).children().eq(1).html('');


                $('td:eq(5)', $(this)).children().eq(0).show();
                $('td:eq(5)', $(this)).children().eq(1).html('');

                $('td:eq(6)', $(this)).children().eq(0).show();
                $('td:eq(6)', $(this)).children().eq(1).html('');

        });

    }

        function stateEdit() {
            if($('#type').val()=='add'){
            $('.list_add').show();
            oTable.column(8).visible(true);
            }
            removeCheckboxLabel();

            $('#state').val('edit');
            $('.state_view').hide();
            $('.state_edit').show();
            $('span.state_view').text('-');

        }

        function stateView() {
            $('#state').val('view');
            addCheckboxLabel();

            if($('#type').val()=='add'){
                $('.list_add').hide();
                oTable.column(8).visible(false);
            }
            var code = ($('#code').val() == '' ? '-' : $('#code').val());
            var name = ($('#name').val() == '' ? '-' : $('#name').val());

            $('#preview').text('Preview');
            $('.state_edit').hide();
            $('.state_view').show();
            $('#code_view').text(code);
            $('#name_view').text(name);


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