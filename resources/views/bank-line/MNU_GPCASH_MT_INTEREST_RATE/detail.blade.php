@include('_partials.header_content',['breadcrumb'=>['Interest Rate','detail']])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <input type="hidden" id="prodCode" value=""/>
            <input type="hidden" id="prodName" value=""/>
            <input type="hidden" id="intId" value=""/>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Rate Detail</h3><br>
                </div>
                <form class="form-horizontal">
                    <div class="box-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Product Code</label>
                                    <div class="col-md-6">
                                        <label id="productCode">-</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Product Name</label>
                                    <div class="col-md-6">
                                        <label id="productName">-</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-header detail_view">
                        <h3 class="box-title">Rate Listing</h3><br>
                    </div>
                    <div class="box-body detail_view">
                        <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                            <thead>
                                <tr>
                                    <th align="left"><strong>Balance</strong></th>
                                    <th align="left"><strong>Period</strong></th>
                                    <th align="left"><strong>Interest Rate (% pa)</strong></th>
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
                                <button type="button" id="edit" name="edit" class="btn btn-primary">@lang('form.edit')</button>
                            </div>
                            <div class="float-right">
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
                    targets: 0,
                    sortable: true,
                    width: "40%"
                },
                {
                    targets: 1,
                    sortable: true,
                    width: "30%"
                },
                {
                    targets: 2,
                    sortable: true,
                    width: "30%"
                }
            ],
        });

        $('div.dt-buttons').css('float','right');
        $('a.dt-button').addClass('btn btn-primary');

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
                            deleteData = getTableData();
                            submit_delete();
                        }
                    },

                }
            });
        });

        function submit_delete () {

            var value = {
                "id": $('#intId').val(),
                "rateList": deleteData,
                "productCode": $('#productCode').text(),
                "productName": $('#productName').text()
            };
            $.ajax({
                url: 'delete',
                method: 'post',
                data: {"_token": "{{ csrf_token() }}", menu: id, value: value,url_action:'submit'},
                success: function (data) {
                    $('#delete').prop('disabled',false);
                    var result = JSON.parse(data);
                    if (result.status=="200") {
                        noRef = result.referenceNo;
                        flash('success', result.message+'<br>'+'ReferenceNo: '+ result.referenceNo+'<br>'+result.dateTimeInfo);
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

        $('.back').on('click', function () {
            var res = app.setView(id,'landing');
        });

        $('#save_screen').hide();
        $('#next_user').hide();
        $('#done').hide();
                        
        
        $('#done').on('click', function () {
            var res = app.setView(id,'landing');
        });

        $('#edit').on('click', function () {
            var productCode = $('#productCode').text();
            var productName = $('#productName').text();
            var intId = $('#intId').val();
            var res = app.setView(id,'add');
            if(res=='done'){
                $('#type').val('edit');
                $('#breadcrumb-action').html('edit');
                $('#productCode_1').val(productCode);
                $('#productName_1').val(productName);
                $('#intRateId').val(intId);
                getDetailEdit(intId);
            }
            
        });


    });

    function getDetail(){

        var url_action= 'searchInterestDetailById';
        var value ={
            id: $('#intId').val(),
            currentPage: "1",
            pageSize: "20",
        };
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data:{value:value,menu:id,action:'DETAIL',url_action:url_action, _token : '{{ csrf_token() }}'},
            success: function (data) {
                var result = JSON.parse(data);
                var detail = result.result;

                if (result.status=="200") {
                    
                    $('#productCode').text($('#prodCode').val());
                    $('#productName').text($('#prodName').val());

                    if (detail) {

                        $.each(detail, function (idx, obj){
                            oTable.row.add([
                                obj.balance+'<input type=hidden id="balanceHidden" value="'+obj.balance+'">',
                                obj.period+'<input type=hidden id="periodHidden" value="'+obj.period+'">',
                                obj.interestRate+'<input type=hidden id="rateHidden" value="'+obj.interestRate+'">'
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

    function getTableData() {
        var data = [];
        var idx = 0;

        $("#list").find("tbody tr").each(function () {
            
            var balance = $('td:eq(0)', $(this)).find('#balanceHidden').val();
            var period = $('td:eq(1)', $(this)).find('#periodHidden').val();
            var rate = $('td:eq(2)', $(this)).find('#rateHidden').val();

            var obj = {
                balance: balance,
                period:period,
                interestRate:rate,
                idx: idx++,

            };

            data.push(obj);

        });

        return data;
    }

</script>