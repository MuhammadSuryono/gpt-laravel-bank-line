@include('_partials.header_content',['breadcrumb'=>['Virtual Account','detail']])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <input type="hidden" id="code" value=""/>
            <input type="hidden" id="name" value=""/>
            <input type="hidden" id="cif" value=""/>
            <input type="hidden" id="codeCorp" value=""/>
            <input type="hidden" id="statusCode" value=""/>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Corporate Detail</h3><br>
                </div>
                <form class="form-horizontal">
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
                                        <button type="button" id="editSts" name="editSts" class="btn btn-primary detail_view">@lang('form.edit_status')</button>
                                        <div class="col-md-4 edit_view">
                                            <select class="form-control" id="stsData">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-header detail_view">
                        <h3 class="box-title">Account Listing</h3><br>
                    </div>
                    <div class="box-body detail_view">
                        <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                            <thead>
                                <tr>
                                    <th align="left"></th>
                                    <th align="left"><strong>Main Account Number</strong></th>
                                    <th align="left"><strong>Main Account Name</strong></th>
                                    <th align="left"><strong>Account Currency</strong></th>
                                    <th align="left"><strong>Product Code</strong></th>
                                    <th align="left"><strong>Product Name</strong></th>
                                    <!-- <th align="left" colspan="3"><strong></strong></th> -->
                                </tr>
                            </thead>
                        </table>           
                    </div>
                </form>
                <div class="box-footer">
                            <div class="float-left">
                                <button type="button" id="back" name="back" class="btn btn-default back">@lang('form.back')</button>
                                <button type="button" id="save_screen" name="save_screen" class="btn btn-default float-left" style="display:none" onclick="save_pdf();">@lang('form.save_pdf')</button>
                            </div>
                            <div class="float-right detail_view">
                                <button type="button" id="delete" name="delete" class="btn btn-danger">@lang('form.delete')</button>
                            </div>
                            <div class="float-right edit_view">
                                <button type="button" id="confirm" name="confirm" class="btn btn-primary">@lang('form.confirm')</button>
                            </div>
                            <div class="float-right">
                                <button type="button" id="submit" name="submit" class="btn btn-primary submit_view">@lang('form.submit')</button>
                                <button type="button" id="next_user" name="next_user" class="btn btn-info">@lang('form.next_user')</button>
                                <button type="button" id="done" name="done" class="btn btn-primary" style="display:none">@lang('form.done')</button>
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
    var deleteData;
    var isEdit = false;
    var acctList = [];

    $(document).ready(function () {
        
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
                    sortable: true,
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
                    width: "19%"
                },
                {
                    targets: 2,
                    sortable: true,
                    width: "19%"
                },
                {
                    targets: 3,
                    sortable: true,
                    width: "19%"
                },
                {
                    targets: 4,
                    sortable: false,
                    width: "19%"
                },
                {
                    targets: 5,
                    sortable: true,
                    width: "19%"
                }
            ],
            "dom": "lfBrtip",
            "buttons": [{
                text: 'Add Account',
                className: 'delete_view',
                action: function ( e, dt, node, config ) {
                    var code = $('#code').val();
                    var name = $('#name').val();
                    var corporate = $('#corpDetail').text();
                    var cifid = $('#cifDetail').text();
                    var corpCode = $('#corpCodeDetail').text();
                    var status = $('#statusDetail').text(); 

                    var res = app.setView(id,'add');
                    if(res=='done'){
                        $('#type').val('add');
                        $('#code_edit').val(code);
                        $('#name').val(name);
                        $('#corpDetail').text(corporate);
                        $('#cifDetail').text(cifid);
                        $('#corpCodeDetail').text(corpCode);
                        $('#statusDetail').text(status);

                        getAccountDroplist(code);
                        getProductsDroplist(cifid);
                    }
                    
                }
            }]
        });

        $('div.dt-buttons').css('float','right');
        $('a.dt-button').addClass('btn btn-primary');

        $('.edit_view').hide();
        $('.submit_view').hide();

        $('#editSts').on('click', function () {

            $('.edit_view').show();
            $('.detail_view').hide();
            $('#statusDetail').hide();

            $('#stsData').val($('#statusCode').val());

            isEdit = true;

        });

        $('#stsData').on('change', function () {
            $('#statusDetail').text(this.value);
        });

        $('#confirm').on('click', function () {

            $('#statusDetail').show();
            $('.edit_view').hide();
            $('.submit_view').show();

        });

        $('#submit').on('click', function () {

            var value = {
                "corporateId": $('#code').val(),
                "vaStatus": $('#stsData').val(),
                "accountList": acctList,
                "cif": $('#cifDetail').text(),
                "corpCode": $('#corpCodeDetail').text(),
            };

            console.log("param", value);
            $.ajax({
                url: 'getAPIData',
                method: 'post',
                data: {"_token": "{{ csrf_token() }}", menu: id, value: value,action:'UPDATE_STATUS', url_action:'submit'},
                success: function (data) {
                    
                    var result = JSON.parse(data);
                    if (result.status=="200") {
                        noRef = result.referenceNo;
                        flash('success', result.message+'<br>'+'ReferenceNo: '+ result.referenceNo+'<br>'+result.dateTimeInfo);
                        $('.submit_view').hide();

                        $('#back').hide();
                        $('#save_screen').show();
                        $('#next_user').show();
                        $('#done').show();
                       
                    } else {
                        flash('warning', result.message);
                    }

                }, error: function (xhr, ajaxOptions, thrownError) {
                   console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                }
            });

        });


        $('#delete').on('click', function () {

            if(countSelected()==0){
                var content ='{{trans('form.alert_noselect',['label'=>'Account'])}}';
                $.alert({
                    title: '{{trans('form.warning')}}',
                    content: content
                });
                return;
            }

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
                            deleteData = getTableData();
                            submit_delete();
                        }
                    },

                }
            });
        });

        function submit_delete () {

            var value = {
                "corporateId": $('#code').val(),
                "accountList": deleteData,
                "cif": $('#cifDetail').text(),
                "corpCode": $('#corpCodeDetail').text(),
                "status": $('#statusDetail').text()
            };
            $.ajax({
                url: 'delete',
                method: 'post',
                data: {"_token": "{{ csrf_token() }}", menu: id, value: value,url_action:'submitDelete'},
                success: function (data) {
                    $('#delete').prop('disabled',false);
                    var result = JSON.parse(data);
                    if (result.status=="200") {
                        noRef = result.referenceNo;
                        flash('success', result.message+'<br>'+'ReferenceNo: '+ result.referenceNo+'<br>'+result.dateTimeInfo);
                        $('.delete_view').hide();
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

        $('.back').on('click', function () {

            if (isEdit) {
                $('.edit_view').hide();
                $('.detail_view').show();
                $('#statusDetail').show();

                $('#statusDetail').text($('#statusCode').val());

                isEdit = false;

            } else {
                var res = app.setView(id,'landing');
            }

        });

        $('#save_screen').hide();
        $('#next_user').hide();
        $('#done').hide();
                        
        
        $('#done').on('click', function () {
            var res = app.setView(id,'landing');
        });

    });

    function getDetail(){
        var corpId= $('#code').val();
        var url_action= 'searchVAByCorporate';
        var value ={
            corporateId:corpId,
            currentPage: "1",
            pageSize: "20",
            // orderBy: {"accountNo": "ASC"}
        };
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data:{value:value,menu:id,action:'DETAIL',url_action:url_action, _token : '{{ csrf_token() }}'},
            success: function (data) {
                var result = JSON.parse(data);
                var detail = result.result;
                var stsCd;

                if (result.status=="200") {
                    
                    $('#corpDetail').text(($('#code').val()).concat(" - ").concat($('#name').val()));
                    $('#cifDetail').text($('#cif').val());
                    $('#corpCodeDetail').text($('#codeCorp').val());
                    $('#statusDetail').text($('#statusCode').val());

                    stsCd = $('#statusCode').val();

                    if (stsCd == 'Unregistered') { //disable button
                        $('#delete').prop('disabled',true);
                        $('a.dt-button').attr('disabled','disabled');
                        $('a.dt-button').css('pointer-events', 'none');
                    }

                    if (detail) {

                        $.each(detail, function (idx, obj){
                            oTable.row.add([
                                '<input id="check" class="dt-checkboxes state_edit" value="" type="checkbox">',
                                obj.accountNo+'<input type=hidden id="acctId" value="'+obj.id+'"><input type=hidden id="acctNo" value="'+obj.accountNo+'">',
                                obj.accountName+'<input type=hidden id="acctNm" value="'+obj.accountName+'">',
                                obj.accountCurrencyCode+'<input type=hidden id="acctCcy" value="'+obj.accountCurrencyCode+'">',
                                obj.productCode+'<input type=hidden id="productCd" value="'+obj.productCode+'">',
                                obj.productName+'<input type=hidden id="productNm" value="'+obj.productName+'">'
                            ]).draw(true);

                            //store accountId in list. Used when update status to Unregistered
                            var acctId = {
                                id : obj.id,
                                accountNo : obj.accountNo,
                                accountName : obj.accountName,
                                accountCurrencyCode : obj.accountCurrencyCode,
                                productCode : obj.productCode,
                                productName : obj.productName
                            }

                            acctList.push(acctId);
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
                getStatusDroplist(corpId);

            }
        });
    }

    function countSelected(){
        var count = 0;
        $("#list").find("tbody tr").each(function () {
            var check = ($('td:eq(0)', $(this)).children().is(':checked') ? 1 : 0);

            if (check == 1) {
                count++;
            }
        });
        return count;
    }

    function getTableData() {
        var data = [];

        $("#list").find("tbody tr").each(function () {
            var check = ($('td:eq(0)', $(this)).children().is(':checked') ? 1 : 0);
            if (check == 0) {
                $('td:eq(0)', $(this)).parent().hide();
            }
            var id = $('td:eq(1)', $(this)).find('#acctId').val();
            var accountNo = $('td:eq(1)', $(this)).find('#acctNo').val();
            var accountName = $('td:eq(2)', $(this)).find('#acctNm').val();
            var productCode = $('td:eq(4)', $(this)).find('#productCd').val();
            var productName = $('td:eq(5)', $(this)).find('#productNm').val();
            var accountCurrencyCode = $('td:eq(3)', $(this)).find('#acctCcy').val();

            var obj = {
                id: id,
                accountNo: accountNo,
                accountName: accountName,
                productCode: productCode,
                productName: productName,
                accountCurrencyCode: accountCurrencyCode
            };
            if (check == 1) {
                data.push(obj);
            }
        });
        // console.log("data",data);
        return data;
    }

    function getStatusDroplist(corpId) {

            var url_action = 'getVAStatus';
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
                        
                        unitOption = '';
                        $.each(result, function (idx, obj) {
                            unitOption += '<option value="' + obj.key + '">' + obj.value + '</option>';
                        });
                        $('#stsData').html(unitOption);
                        // $('#stsData').select2();

                }, error: function (xhr, ajaxOptions, thrownError) {
                    var msg = '{{trans('form.conn_error')}}';
                    flash('warning', msg);
                    console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                }, complete: function (data) {

                }
            });

    }


</script>