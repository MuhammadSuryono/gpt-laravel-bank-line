@include('_partials.header_content',['breadcrumb'=>['Transaction Fee','detail']])

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <input type="hidden" id="corporateId" value=""/>
            <input type="hidden" id="name" value=""/>
            <div class="box">
                
                <div class="box-header detail" style="display:none">
                    <span id="detail" class="detail" style="color:darkred;"><small><i>Detail</i></small></span>
                </div>
                <div class="box-header">
                    <h3 class="box-title">Transaction Fee Detail</h3><br>
                </div>
                <form class="form-horizontal">
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Corporate ID</label>
                                <div class="col-md-6">
                                    <label id="corporateId_1">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Corporate Name</label>
                                <div class="col-md-6">
                                    <label id="name_1">-</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
                    <div class="box-header">
                        <h3 class="box-title table-hidden">Transaction Charge List</h3>
                    </div>
                    <div class="container-fluid">
                        <div class="box-body">
                           <div class="row table-hidden">
                               <div class="form-group">
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th align="center"><strong>Menu</strong></th>
                                        <th align="center"><strong>Charge Type</strong></th>
                                        <th align="center"><strong>Currency</strong></th>
                                        <th align="center"><strong>Value</strong></th>
                                    </tr>
                                    </thead>
                                    <tbody><tr>
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
                                           <div class="col-md-12 text-center">
                                               <button type="button" id="edit" name="edit" class="btn btn-default">@lang('form.edit')</button>
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
    var id = 'MNU_GPCASH_CORP_CH_PC_DTL';
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
                    width: "30px"
                },
                {
                    targets: 3,
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
                    var corporateId = $('#corporateId').val();
                    var name = $('#name').val();
                    $('#content-ajax').html(data);
                    $('#type').val('edit');
                    $('#corporateId').val(corporateId);
                    $('#corporateid_1').text(corporateId);
                    $('#name_1').text(name);

                }, error: function (xhr, ajaxOptions, thrownError) {
                    $('#edit').prop('disabled',false);
                    console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                }
            });
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

    });

    function getMatrix(){
        var corporateId= $('#corporateId').val();
        var value = {
            "corporateId": corporateId
        };
        var url_action = 'search';
        var action = 'SEARCH';
        var result_key='result';
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data: {
                value : value,
                menu : id,
                url_action : url_action,
                action : action,
                result_key : result_key,
                _token : '{{ csrf_token() }}'
            },
            success: function (data) {
                var result = JSON.parse(data);
                var detail = result.result;
                 oTable.clear();
                var lastServiceName = '';
                $.each(detail, function (idx, obj){
                    var serviceName = '';
                    if(lastServiceName!==obj.serviceName){
                        serviceName = obj.serviceName;
                    }
                            oTable.row.add([
                            serviceName,
                            obj.serviceChargeName,
                            obj.currencyCode,
                            obj.value
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

    function getTableData(){
        var data = [];

        $("#list").find("tbody tr").each(function(){
            var check = ($('td:eq(0)', $(this)).children().is(':checked') ? 1:0);
            var service_code = $('td:eq(1)', $(this)).find('#service_code').val();
            var matrix_id = $('td:eq(2)', $(this)).find('#matrix_id').val();
            var num_trans = $('td:eq(3)', $(this)).find('#num_trans').val();
            var curr_code = $('td:eq(4)', $(this)).find('#currCode').val();
            var max_trans = $('td:eq(5)', $(this)).find('#max_trans').val();

            var obj = {check: check,serviceCode:service_code,serviceCurrencyMatrixId:matrix_id,maxTrxPerDay:num_trans,currencyCode:curr_code,maxTrxAmountPerDay:max_trans};
            data.push(obj);
        });
        return data;
    }

</script>