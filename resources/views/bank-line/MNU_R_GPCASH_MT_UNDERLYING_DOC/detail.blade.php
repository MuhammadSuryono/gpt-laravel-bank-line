@include('_partials.header_content',['breadcrumb'=>['Underlying Document','detail']])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <input type="hidden" id="customerId" value=""/>
            <input type="hidden" id="cif" value=""/>
            <input type="hidden" id="name" value=""/>
            <input type="hidden" id="branchCd_1" value=""/>
            <input type="hidden" id="branchNm_1" value=""/>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Customer Detail</h3><br>
                </div>
                <form class="form-horizontal">
                    <div class="box-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Customer</label>
                                    <div class="col-md-6">
                                        <label id="custDetail">-</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-header">
                        <h3 class="box-title">Document Listing</h3><br>
                    </div>
                    <div class="box-body">
                        <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                            <thead>
                                <tr>
                                    <th align="left"></th>
                                    <th align="left"><strong>Document Type</strong></th>
                                    <th align="left"><strong>Underlying Amount</strong></th>
                                    <th align="left"><strong>Remark</strong></th>
                                    <th align="left"><strong>Expiry Date</strong></th>
                                    <th align="left"><strong>Registering Branch</strong></th>
                                    <th align="left"><strong>Underlying Code</strong></th>
                                    <th align="left"><strong>Registered Date</strong></th>
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
                                <button type="button" id="done" name="done" class="btn btn-primary done" style="display:none">@lang('form.done')</button>
                            </div>
                        </div>
                    </div>
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
                    width: "13.57%"
                },
                {
                    targets: 2,
                    sortable: true,
                    width: "13.57%"
                },
                {
                    targets: 3,
                    sortable: true,
                    width: "13.57%"
                },
                {
                    targets: 4,
                    sortable: false,
                    width: "13.57%"
                },
                {
                    targets: 5,
                    sortable: true,
                    width: "13.57%"
                },
                {
                    targets: 6,
                    sortable: true,
                    width: "13.57%"
                },
                {
                    targets: 7,
                    sortable: true,
                    width: "13.57%"
                }
            ],
            "dom": "lfBrtip",
            "buttons": [{
                text: 'Add Document',
                className: 'delete_view',
                action: function ( e, dt, node, config ) {
                    var code = $('#customerId').val();
                    var name = $('#name').val();
                    var customer = $('#custDetail').text();
                    var brCode = $('#branchCd_1').val();
                    var brName = $('#branchNm_1').val();

                    var res = app.setView(id,'add');
                    if(res=='done'){
                        $('#type').val('add');
                        $('#customerId_edit').val(code);
                        $('#name').val(name);
                        $('#custDetail').text(customer);
                        $('#branchCd_add').val(brCode);
                        $('#branchNm_add').val(brName);
                        $('#branch_view').text(brCode + " - " + brName);

                        getDocumentTypeDroplist();
                    }
                    
                }
            }]
        });

        $('div.dt-buttons').css('float','right');
        $('a.dt-button').addClass('btn btn-primary');

        $('#delete').on('click', function () {

            if(countSelected()==0){
                var content ='{{trans('form.alert_noselect',['label'=>'Document'])}}';
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
                "customerId": $('#customerId').val(),
                "documentList": deleteData
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
        var custId= $('#customerId').val();
        var url_action= 'search';
        var value ={
            customerId:custId,
            currentPage: "1",
            pageSize: "20"
        };
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data:{value:value,menu:id,action:'DETAIL',url_action:url_action, _token : '{{ csrf_token() }}'},
            success: function (data) {
                var result = JSON.parse(data);
                 var detail = result.result;
				
				$('#custDetail').text(($('#customerId').val()).concat(" - ").concat($('#name').val()));
                if (result.status=="200") {
                    
                    
                    $('#branchCd_1').val(result.branchCode);
                    $('#branchNm_1').val(result.branchName);

                    if (detail) {

                        $.each(detail, function (idx, obj){

                            var underlyingCode = obj.underlyingCode !=null ? obj.underlyingCode : "-";                    

                            oTable.row.add([
                                '<input id="check" class="dt-checkboxes state_edit" value="" type="checkbox">',
                                obj.documentTypeName+'<input type=hidden id="docId" value="'+obj.id+'"><input type=hidden id="docTypeCode" value="'+obj.documentTypeCode+'"><input type=hidden id="docTypeName" value="'+obj.documentTypeName+'">',
                                obj.currency + ' ' +'<label id="amountView" class="amount">'+ obj.underlyingAmount +'</label><input type=hidden id="underlyingAmt" value="'+obj.underlyingAmount+'">',
                                obj.remark+'<input type=hidden id="remark1" value="'+obj.remark+'">',
                                moment(obj.expiryDate, "DD-MM-YYYY HH:mm:ss").format("DD-MMMM-YYYY")+'<input type=hidden id="expdate" value="'+obj.expiryDate+'">',
                                obj.branchCode+' - '+ obj.branchName +'<input type=hidden id="branchCd" value="'+obj.branchCode+'"><input type=hidden id="branchNm" value="'+obj.branchName+'">',
                                underlyingCode+'<input type=hidden id="underlyingCd" value="'+obj.expiryDate+'">',
                                moment(obj.createdDate, "DD-MM-YYYY HH:mm:ss").format("DD-MMMM-YYYY")+'<input type=hidden id="regisDate" value="'+obj.createdDate+'">'
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
                $('.amount').autoNumeric('init',{
                            digitGroupSeparator        : ',',
                            decimalCharacter           : '.',
                            decimalCharacterAlternative: '.',
                            minimumValue:'0.00',maximumValue:'999999999999999.99'
                });

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
            var id = $('td:eq(1)', $(this)).find('#docId').val();
            var docTypeCode = $('td:eq(1)', $(this)).find('#docTypeCode').val();
            var docTypeName = $('td:eq(1)', $(this)).find('#docTypeName').val();
            var underlyingAmt = $('td:eq(2)', $(this)).find('#underlyingAmt').val();
            var expiryDate = $('td:eq(4)', $(this)).find('#expdate').val();
            var remark = $('td:eq(3)', $(this)).find('#remark1').val();
            var branchCode = $('td:eq(5)', $(this)).find('#branchCd').val();
            var branchName = $('td:eq(5)', $(this)).find('#branchNm').val();

            var obj = {
                id: id,
                documentTypeCode: docTypeCode,
                documentTypeName: docTypeName,
                underlyingAmount: underlyingAmt,
                expiryDate: expiryDate,
                remark: remark,
                branchCode: branchCode,
                branchName: branchName

            };
            if (check == 1) {
                data.push(obj);
            }
        });
        // console.log("data",data);
        return data;
    }


</script>