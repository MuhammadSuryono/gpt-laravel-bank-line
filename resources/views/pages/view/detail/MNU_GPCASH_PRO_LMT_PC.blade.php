@include('_partials.header_content',['breadcrumb'=>['limit setup','detail']])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <input type="hidden" id="code" value=""/>
            <div class="box">
                
                <div class="box-header detail">
                    <span id="detail" class="detail" style="color:darkred;"><small><i>Detail</i></small></span>
                </div>
                <div class="box-header">
                    <h3 class="box-title">Limit Setup Detail</h3><br>
                </div>
                <form class="form-horizontal">
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Limit Setup Code</label>
                                <div class="col-md-6">
                                    <label id="code_1">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Limit Setup Name</label>
                                <div class="col-md-6">
                                    <label id="name">-</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
                    <div class="box-header">
                        <h3 class="box-title table-hidden">Limit Setup Listing</h3>
                    </div>
                    <div class="container-fluid">
                        <div class="box-body">
                           <div class="row table-hidden">
                               <div class="form-group">
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th align="center" rowspan="2"><strong>Service</strong></th>
                                        <th align="center" rowspan="2"><strong>Currency matrix</strong></th>
                                        <th align="center" rowspan="2"><strong>Max. No. Of Transaction / Day</strong></th>
                                        <th align="center" colspan="2"><strong>Maximum Transaction Amount / Day</strong></th>
                                    </tr>
                                    <tr>
                                        <th align="center"><strong>Currency</strong></th>
                                        <th align="center"><strong>Value</strong></th>
                                    </tr>
                                    </thead>
                                    <tbody><tr>
                                        <td align="left"></td>
                                        <td align="left"></td>
                                        <td align="left"></td>
                                        <td align="left"></td>
                                        <td align="left"></td>
                                    </tr>
                                    </tbody>
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

<script>
    var oTable;
    var currencyOption;
    var id = 'MNU_GPCASH_PRO_LMT_PC';
    $(document).ready(function () {
        $('.table-hidden').hide();
        $('.state_delete').hide();



        oTable = $('#list').DataTable({
            "paging" : false,
            "ordering" : false,
            "info": false,
            "destroy": true,
            "select": false,
            "searching": false,
            "autoWidth":false,
            "lengthMenu": [[10, 25, 50], [10, 25, 50]],
            "columnDefs": [

                {
                    targets: 0,
                    sortable: false,
                    width: "250px"
                },
                {
                    targets: 1,
                    sortable: false,
                    width: "100px"
                },
                {
                    targets: 2,
                    sortable: false,
                    width: "50px",
                    render: $.fn.dataTable.render.number( '.', ',', 0, '' )

                },
                {
                    targets: 3,
                    sortable: false,
                    width: "30px"
                },
                {
                    targets: 4,
                    sortable: false,
                    width: "100px",
                    render: $.fn.dataTable.render.number( '.', ',', 2, '' )
                }

            ]
        });


        $('#edit').on('click', function () {
            $(this).prop('disabled',true);
            $.ajax({
                url: 'getEditor/' + id,
                method: 'post',
                success: function (data) {
                    $('#edit').prop('disabled',false);
                    $(window).scrollTop(0);
                    var code = $('#code_1').text();
                    $('#content-ajax').html(data);
                    $('#type').val('edit');
                    $('#code_edit').val(code);

                }, error: function (xhr, ajaxOptions, thrownError) {
                    $('#edit').prop('disabled',false);
                    console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                }
            });
        });

        $('#delete').on('click', function () {
           // $('.state_view').hide();
           // $('.state_delete').show();
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
                "code": $('#code').val(),
                "name": $('#name').text(),
                "transactionLimitList": submit_data
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
                url: 'getView/MNU_GPCASH_PRO_LMT_PC',
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

    });

    function getMatrix(){
        var code_id= $('#code').val();
        var value = {
            code: code_id,
            name: "",
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
                _token : '{{ csrf_token() }}'
            },
            success: function (data) {

                var result = JSON.parse(data);

                var detail = result.result[0].transactionLimitList;
                $('#code_1').text(result.result[0].code);
                $('#name').text(result.result[0].name);
                oTable.clear();
                var lastServiceName = '';
                $.each(detail, function (idx, obj){
                    var serviceName = '';

                    if(lastServiceName!==obj.serviceName){
                        serviceName = obj.serviceName;
                    }
                            oTable.row.add([
                                serviceName,
                            obj.currencyMatrixName,
                            obj.maxTrxPerDay,
                            obj.currencyCode,
                            obj.maxTrxAmountPerDay
                        ]).draw(false);
                    lastServiceName = obj.serviceName;
                });

            }, error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            },
            complete: function(data) {
                $('.table-hidden').show();

            }
        });
    }

    function getCurrency(){
        var value = {
            code: "",
            name: "",
            modelCode: "COM_MT_CURRENCY"
        };
        var url_action = 'searchModelForDroplist';
        var action = 'SEARCH';
        var menu = 'MNU_GPCASH_MT_PARAMETER';
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
                currencyOption = '<select id="currCode">';
                $.each(result.result, function (idx, obj) {
                    if(obj.code=="IDR") {
                        currencyOption += '<option value="' + obj.code + '" selected="selected">' + obj.code + '</option>';
                    }else{
                        currencyOption += '<option value="' + obj.code + '">' + obj.code + '</option>';
                    }
                });
                currencyOption += '</select>';


            }, error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            },complete: function(data) {
                getMatrix();
            }
        });
    }

    function getTableData() {
        var data = [];

        $("#list").find("tbody tr").each(function () {

            var service_name = $('td:eq(0)', $(this)).text();
            var currency_matrix_name = $('td:eq(1)', $(this)).text();
            var min_trans = $('td:eq(4)', $(this)).text();
            var curr_code = $('td:eq(3)', $(this)).text();
            var max_trans = $('td:eq(4)', $(this)).text();

            var obj = {
                serviceName: service_name,
                currencyMatrixName: currency_matrix_name,
                maxTrxPerDay: min_trans,
                currencyCode: curr_code,
                maxTrxAmountPerDay: max_trans
            };

            data.push(obj);

        });
        return data;
    }

</script>