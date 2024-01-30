@include('_partials.header_content',['breadcrumb'=>['bank global limit']])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <input type="hidden" id="code" value=""/>
            <div class="box">
                <div id="spinner" style="display:none"></div>
                <div class="box-header detail" style="display:none">
                    <span id="detail" class="detail" style="color:darkred;"><small><i>Detail</i></small></span>
                </div>
                <div class="box-header">
                    <h3 class="box-title">Bank Global Limit Listing</h3><br>
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
                                        <th align="center" rowspan="2"><strong>Currency</strong></th>
                                        <th align="center"><strong>Minimum</strong></th>
                                        <th align="center"><strong>Maximum</strong></th>
                                    </tr>
                                    <tr>
                                        <th align="center"><strong>Trx Limit</strong></th>
                                        <th align="center"><strong>Trx Limit</strong></th>
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
                               <form class="form-horizontal">
                               <div class="form-group">
                                   <div class="state_view">
                                           <div class="col-md-12 state_view text-center">
                                               <button type="button" id="edit" name="edit" class="btn btn-default">@lang('form.edit')</button>
                                           </div>
                                   </div>
                               </div>
                               </form>

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
    var id = 'MNU_GPCASH_BANK_TRX_LMT';
    $(document).ready(function () {
        oTable = $('#list').DataTable({
            "paging" : false,
            "ordering" : false,
            "info": false,
            "destroy": true,
            "select": false,
            "searching": false,
            "autoWidth":false,
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
                    render: $.fn.dataTable.render.number( '.', ',', 0, '' )

                },
                {
                    targets: 4,
                    sortable: false,
                    width: "100px",
                    render: $.fn.dataTable.render.number( '.', ',', 2, '' )
                }

            ]
        });

        getCurrency();

        $('#edit').on('click', function () {
            $(this).prop('disabled',true);
            $.ajax({
                url: 'getEditor/' + id,
                method: 'post',
                success: function (data) {
                    $('#edit').prop('disabled',false);
                    $(window).scrollTop(0);
                     $('#content-ajax').html(data);
                    $('#type').val('edit');


                }, error: function (xhr, ajaxOptions, thrownError) {
                    $('#edit').prop('disabled',false);
                    console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                }
            });
        });



    });

    function getMatrix(){
        var value = {};
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
                if(result.result[0] == undefined){
                    return;
                }
                var detail = result.result;
                oTable.clear();
                $.each(detail, function (idx, obj){
                            oTable.row.add([
                            obj.serviceName,
                            obj.currencyMatrixName,
                            obj.currencyCode,
                            obj.minAmountLimit,
                            obj.maxAmountLimit
                        ]).draw(false);

                });

            }, error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            },
            complete: function(data) {

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