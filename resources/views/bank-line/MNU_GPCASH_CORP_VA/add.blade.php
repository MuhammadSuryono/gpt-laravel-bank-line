@include('_partials.header_content',['breadcrumb'=>[str_replace('-',' ','Virtual Account'),$type]])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Corporate Detail</h3>
                </div>
                <form id="form-area" class="form-horizontal form-area">
                <input type="hidden" id="code_edit" value=""/>
                <input type="hidden" id="type" value=""/>
                <input type="hidden" id="state" value=""/>
                <input type="hidden" id="submit_mode" value=""/>
				<input type="hidden" id="name" value=""/>
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label">CIF</label>
                                <div class="col-md-6">
                                    <label id="cifDetail">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Corporate</label>
                                <div class="col-md-6">
                                    <label id="corpDetail">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Corporate Code</label>
                                <div class="col-md-6">
                                    <label id="corpCodeDetail">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Status</label>
                                <div class="col-md-6">
                                    <label id="statusDetail">-</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-header state_edit">
                    <h3 class="box-title">Add Account</h3><br>
                </div>
                <div class="box-body state_edit">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label"><strong>Main Account&ast;</strong></label>
                                <div class="col-md-5">
                                    <select class="form-control state_edit" id="acctNo" data-error="please select an account" required>
                                        <option></option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                    <label id="acctNo_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label"><strong>Product Code&ast;</strong></label>
                                <div class="col-md-5">
                                    <input type="text" id="productCode" name="productCode" class="form-control state_edit numeric" autocomplete="off" value="" maxlength="2" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                    <label id="productCode_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label"><strong>Product Name&ast;</strong></label>
                                <div class="col-md-5">
                                    <input type="text" id="productName" name="productName" class="form-control state_edit" autocomplete="off" value="" maxlength="40" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                    <label id="productName_view" class="state_view"></label>
                                </div>
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label"><strong>Product&ast;</strong></label>
                                <div class="col-md-5">
                                    <select class="form-control state_edit" id="productList" data-error="please select a product" required>
                                        <option></option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                    <label id="productList_view" class="state_view"></label>
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
                    <h3 class="box-title">Account Listing</h3><br>
                </div>
                <div class="box-body">
                    <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                        <thead>
                            <tr>
                                <th align="left"><strong>Main Account Number</strong></th>
                                <th align="left"><strong>Main Account Name</strong></th>
                                <th align="left"><strong>Account Currency</strong></th>
                                <th align="left"><strong>Product Code</strong></th>
                                <th align="left"><strong>Product Name</strong></th>
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

    $(document).ready(function () {
        $('.table-hidden').hide();

        $(document).validator().on('#form-area','submit', function (e) {
            if (e.isDefaultPrevented()) {
                // handle the invalid form...
            } else {
                // everything looks good!

            }
        });

        stateEdit();

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
                    width: "16.66%"
                },
                {
                    targets: 1,
                    sortable: false,
                    width: "16.66%"
                },
                {
                    targets: 2,
                    sortable: false,
                    width: "16.66%"
                },
                {
                    targets: 3,
                    sortable: false,
                    width: "16.66%"
                },
                {
                    targets: 4,
                    sortable: false,
                    width: "16.66%"
                },
                {
                    targets: 5,
                    sortable: false,
                    width: "16.66%",
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
                    },

                }
            });

        });

        $('#add_list').on('click', function () {
            // $(this).prop('disabled',true);
            
            $('#form-area').validator('validate');
            // setTimeout(function(){
                if($('#form-area').validator('validate').has('.has-error').length==0){
                    var inputAcctNo = $('#acctNo').val();
                    
                    /* //old spec 
                    var inputProdCd = $('#productCode').val();
                    var inputProdNm = $('#productName').val();
                    */

                    // new spec
                    var inputProdCd = $('#productList').val();
                    var inputProdNm = $('#productList').find(':selected').attr('data-prodName');

                    validateAddList(inputAcctNo, inputProdCd, inputProdNm);
                }
            // });

        });

        function submitData(){
            var value = {
                "corporateId": $('#code_edit').val(),
                "accountList": submit_data,
                "cif": $('#cifDetail').text(),
                "corpCode": $('#corpCodeDetail').text(),
                "status": $('#statusDetail').text()
            };

            var url_action = "submitAccount";
            
             $.ajax({
                    url: 'getAPIData',
                    method: 'post',
                    data: {"_token": "{{ csrf_token() }}", menu: id, value: value, url_action: url_action, action: 'UPDATE'},
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
                var content ='{{trans('form.alert_empty',['label'=>'Account'])}}';
                $.alert({
                    title: '{{trans('form.warning')}}',
                    content: content
                });
                return;
            }
            setTimeout(function(){
                $('#submit_type').val('submit');
                submit_data = getTableData();
                // console.log("submit_data:", submit_data);

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
            }else{
            $('#back_view').prop('disabled',false);
            stateEdit();
            }
        });

        $('.back').on('click', function () {
            $(this).prop('disabled',true);
           
                var code = $('#code_edit').val();
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
                }
            
        });

        $('#done').on('click', function () {
            $(this).prop('disabled',true);
            app.setView(id,'landing');
        });

        $('.numeric').numeric({
            allowSpace: false,
            allow : ''
        });

        $('input[type="text"]').not('.numeric').alphanum({
            allowSpace: true,
            allow : ',._!@'
        });
    });
    

        function stateEdit() {

            $('input:checkbox').prop('disabled','');
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

            $('input:checkbox').prop('disabled','disabled');
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

        function validateAddList(accountNo, productCode, productName){

            var value = {
                corporateId: $('#code_edit').val(),
                mainAccountNo: accountNo,
                productCode: productCode,
                productName: productName
            };

            $.ajax({
                url: 'getAPIData',
                method: 'post',
                // type: 'json',
                data: {
                    value : value,
                    menu : id,
                    url_action : 'validateDetail',
                    action : 'VALIDATE',
                    _token : '{{ csrf_token() }}'
                },
                success: function (data) {
                    var result = JSON.parse(data);

                    // console.log(result);
                    if (result.status=="200") {
                        
                        if(checkDuplicateList(accountNo, productCode)) {

                            var acctNm = $('#acctNo').find(':selected').attr('data-acctNm');
                            var acctCcy = $('#acctNo').find(':selected').attr('data-acctCcy');

                            oTable.row.add([
                                    result.mainAccountNo + '<input type=hidden id="acctNo" value="' + result.mainAccountNo + '">',
                                    acctNm + '<input type=hidden id="acctNmHidden" value="' + acctNm + '">',
                                    acctCcy + '<input type=hidden id="acctCcyHidden" value="' + acctCcy + '">',
                                    result.productCode + '<input type=hidden id="productCodeHidden" value="' + result.productCode + '">',
                                    result.productName + '<input type=hidden id="productNameHidden" value="' + result.productName + '">',
                                    
                                    
                                ]).draw(true);
                        } else {
                            flash('warning', 'The Combination of Main Account and Product Code has been added to List');
                        }
                        
                    } else {
                        flash('warning', result.message);
                    }

                }, error: function (xhr, ajaxOptions, thrownError) {
                    var msg = '{{trans('form.conn_error')}}';
                    flash('warning', msg);
                    console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                }, complete: function (data) {
                    // $('#add_list').prop('disabled',false);

                }
            });

        }

        function checkDuplicateList(accountNo, prodCd){
            var duplicate = 0;
            $("#list").find("tbody tr").each(function (idx, obj) {

                var code = $('td:eq(3)', $(this)).find('#productCodeHidden').val();

                $('td').each(function(){
                    var acctNo = $(this).find('#acctNo').val();

                    if(accountNo==acctNo){
                        if(prodCd == code){

                            duplicate = 1;
                        }
                    }
                    // console.log("acctNo"+ idx, acctNo);
                })
            });

            if(duplicate==1){
                console.log("duplicate");
                return false;
            }else{
                return true;
            }
        }

        function removeRow(el){
            var row = $(el).parent().parent();
            oTable.row(row).remove().draw(true);
        }

        function getTableData() {
            var data = [];

            var idx = 0;

            $("#list").find("tbody tr").each(function () {
                var accountNo = $('td:eq(0)', $(this)).find('#acctNo').val();
                var productCode = $('td:eq(3)', $(this)).find('#productCodeHidden').val();
                var productName = $('td:eq(4)', $(this)).find('#productNameHidden').val();
                var accountNm = $('td:eq(1)', $(this)).find('#acctNmHidden').val();
                var accountCcy = $('td:eq(2)', $(this)).find('#acctCcyHidden').val();

                var obj = {
                    mainAccountNo: accountNo,
                    productCode:productCode,
                    productName:productName,
                    idx: idx++,
                    accountName:accountNm,
                    accountCurrencyCode:accountCcy

                };

                    data.push(obj);

            });

            return data;
        }


        function getAccountDroplist(corpId) {

            var url_action = 'searchCorporateAccount';
            var action = 'SEARCH';
            var menu = id;
            var value = {
                corporateId: corpId
            };

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
                        unitOption = '<option value="">select account</option>';
                        $.each(result.accounts, function (idx, obj) {
                            unitOption += '<option value="' + obj.accountNo + '" data-acctNm="'+obj.accountName+'" data-acctCcy="'+obj.accountCurrencyName+'">' + obj.accountNo + ' / ' + obj.accountName + ' (' + obj.accountCurrencyName + ')' + '</option>';
                        });
                        $('#acctNo').html(unitOption);
                        $('#acctNo').select2();
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


        function getProductsDroplist(cifId) {

            var url_action = 'searchCorporateProducts';
            var action = 'SEARCH';
            var menu = id;
            var value = {
                cifId: cifId
            };

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
                        unitOption = '<option value="">select product</option>';
                        $.each(result.productsList, function (idx, obj) {
                            unitOption += '<option value="' + obj.productCode + '" data-prodName="'+obj.productName+'" data-prodStatus="'+obj.productStatus+'">' + obj.productCode + ' - ' + obj.productName + '</option>';
                        });
                        $('#productList').html(unitOption);
                        $('#productList').select2();
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