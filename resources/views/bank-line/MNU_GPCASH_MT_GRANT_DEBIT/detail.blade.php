@include('_partials.header_content',['breadcrumb'=>['Direct Debit Account','detail']])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <input type="hidden" id="code" value=""/>
            <input type="hidden" id="cif" value=""/>
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
                                    <label class="col-md-4 control-label">Corporate</label>
                                    <div class="col-md-6">
                                        <label id="corpDetail">-</label>
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
                                    <th align="left"></th>
                                    <th align="left"><strong>Account Number</strong></th>
                                    <th align="left"><strong>Maximum Amount</strong></th>
                                    <th align="left"><strong>Expiry Date</strong></th>
                                    <th align="left"><strong>Account Name</strong></th>
                                    <th align="left"><strong>Account Currency</strong></th>
                                    <!-- <th align="left" colspan="3"><strong></strong></th> -->
                                </tr>
                            </thead>
                        </table>           
                    </div>
                    <div class="box-footer">
                        <div class="state_view">
                            <div class="float-left">
                                <button type="button" id="back" name="back" class="btn btn-default back">@lang('form.back')</button>
                                <button type="button" id="save_screen" name="save_screen" class="btn btn-default" style="display:none" onclick="save_pdf();">@lang('form.save_pdf')</button>
                            </div>
                            <div class="float-right">
                                <button type="button" id="delete" name="delete" class="btn btn-danger">@lang('form.delete')</button>
                                <button type="button" id="next_user" name="next_user" class="btn btn-info" style="display:none">@lang('form.next_user')</button>
                                <button type="button" id="done" name="done" class="btn btn-primary done" style="display:none">@lang('form.done')</button>
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
    var id = '{{ $service }}';
    var noRef;
    var deleteData;

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
                    var res = app.setView(id,'add');
                    if(res=='done'){
                        $('#type').val('add');
                        $('#code_edit').val(code);
                        $('#name').val(name);
                        $('#corpDetail').text(corporate);
                    }
                    
                }
            }]
        });

        $('div.dt-buttons').css('float','right');
        $('a.dt-button').addClass('btn btn-primary');

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
                "accountList": deleteData
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
           var res = app.setView(id,'landing');
        });

        $('.done').on('click', function () {
           var res = app.setView(id,'landing');
        });
    });

    function getDetail(){
        var corpId= $('#code').val();
        var url_action= 'search';
        var value ={
            corporateId:corpId,
            currentPage: "1",
            pageSize: "20",
            orderBy: {"accountNo": "ASC"}
        };
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data:{value:value,menu:id,action:'DETAIL',url_action:url_action, _token : '{{ csrf_token() }}'},
            success: function (data) {
                var result = JSON.parse(data);
                 var detail = result.result;

                if (result.status=="200") {
                    // var index = result.result.map(function(o) { return o.code; }).indexOf(code_id.toString());
                    // var detail = result.result[index];
                    
                    $('#corpDetail').text(($('#code').val()).concat(" - ").concat($('#name').val()));
                    
                    if (detail) {

                        $.each(detail, function (idx, obj){

                            var expdate = obj.expiryDate!=null?obj.expiryDate:'';
                            oTable.row.add([
                                '<input id="check" class="dt-checkboxes state_edit" value="" type="checkbox">',
                                obj.accountNo+'<input type=hidden id="acctId" value="'+obj.id+'"><input type=hidden id="acctNo" value="'+obj.accountNo+'">',
                                obj.maxDebitLimit+'<input type=hidden id="maxAmt" value="'+obj.maxDebitLimit+'">',
                                expdate+'<input type=hidden id="expDt" value="'+expdate+'">',
                                obj.accountName+'<input type=hidden id="acctNm" value="'+obj.accountName+'">',
                                obj.accountCurrencyCode+'<input type=hidden id="acctCcy" value="'+obj.accountCurrencyCode+'">'
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
                $('.table-hidden').show();

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
            var accountName = $('td:eq(4)', $(this)).find('#acctNm').val();
            var maxDebitLimit = $('td:eq(2)', $(this)).find('#maxAmt').val();
            var expiryDate = $('td:eq(3)', $(this)).find('#expDt').val();
            var accountCurrencyCode = $('td:eq(5)', $(this)).find('#acctCcy').val();

            var obj = {
                id: id,
                accountNo: accountNo,
                accountName: accountName,
                maxDebitLimit: maxDebitLimit,
                expiryDate: expiryDate,
                accountCurrencyCode: accountCurrencyCode
            };
            if (check == 1) {
                data.push(obj);
            }
        });
        // console.log("data",data);
        return data;
    }


</script>