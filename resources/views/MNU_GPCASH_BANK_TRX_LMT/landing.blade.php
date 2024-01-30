@include('_partials.header_content',['breadcrumb'=>[str_replace('-',' ',$menu)]])


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
                    <form class="form-horizontal">
                      <div class="box-body">
                        <div class="container-fluid">
                           <div class="table-hidden">
                               <div class="form-group">
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th rowspan="2"></th>
                                        <th align="center" rowspan="2"><strong>Service</strong></th>
                                        <th align="center" rowspan="2"><strong>Currency matrix</strong></th>
                                        <th align="center" rowspan="2"><strong>Currency</strong></th>
                                        <th align="right"><strong>Minimum Transaction</strong></th>
                                        <th align="right"><strong>Maximum Transaction</strong></th>
                                    </tr>
                                    <tr>
                                        <th align="center"><strong>Amount Transaction</strong></th>
                                        <th align="center"><strong>Amount Transaction</strong></th>
                                    </tr>
                                    </thead>

                                </table>
                               </div>

                            </div>

                        </div>
                    </div>

                    <div class="box-footer">
                        <div class="float-left">
                        </div>
                        <div class="float-right">
                            <button type="button" id="edit" name="edit" class="btn btn-primary">@lang('form.edit')</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

</section>

<script>
    var oTable;
    var currencyOption;
    var submit_data;
    var id = '{{ $service }}';
    $(document).ready(function () {
        oTable = $('#list').DataTable({
            "paging" : false,
            "ordering" : false,
            "info": false,
            "destroy": true,
            "select": {
                style: 'multi',
                selector: 'input.dt-checkboxes'
            },
            "searching": false,
            "autoWidth":false,
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
                    sortable: false,
                    width: "250px"
                },
                {
                    targets: 2,
                    sortable: false,
                    width: "100px"
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
                    className:"dt-right",
                    render: $.fn.dataTable.render.number( ',', '.', 0, '' )

                },
                {
                    targets: 5,
                    sortable: false,
                    width: "100px",
                    className:"dt-right",
                    render: $.fn.dataTable.render.number( ',', '.', 2, '' )
                }

            ]
        });

        getCurrency();

        $('#edit').on('click', function () {
            if(countMenu()==0){
                var content ='{{trans('form.alert_noselect',['label'=>'Services'])}}';
                $.alert({
                    title: '{{trans('form.warning')}}',
                    content: content
                });
                return;
            }
            submit_data = getTableData();
            $('#temp').attr('data-services','');
            $('#temp').attr('data-services',submit_data);
            var res = app.setView(id,'add');
            //$('#selected-table').val('services');

            if(res=='done'){
                $('#type').val('edit');

            }
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
                if (result.status=="200") {
                    if(result.result[0] == undefined){
                        return;
                    }
                    var detail = result.result;
                    oTable.clear();
                    if(detail){
                    $.each(detail, function (idx, obj){
                        oTable.row.add([
                            '<input id="check" name="check" class="dt-checkboxes state_edit" value="" type="checkbox">',
                            '<span id="service_name">'+obj.serviceName +'</span>'+'<input id="service_code" name="service_code" class="form-control state_edit" value="' + obj.serviceCode + '" type="hidden">',
                            '<span id="currency_matrix_name">'+obj.currencyMatrixName +'</span>'+'<input id="currencyMatrixName" name="service_code" class="form-control state_edit" value="' + obj.currencyMatrixName + '" type="hidden">',
                            obj.currencyCode,
                            obj.minAmountLimit,
                            obj.maxAmountLimit
                        ]).draw(false);

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

               //$('th.sorting_disabled.dt-checkboxes-select-all').children('input').click();
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
                if (result.status=="200") {
                    currencyOption = '<select id="currCode">';
                    $.each(result.result, function (idx, obj) {
                        if(obj.code=="IDR") {
                            currencyOption += '<option value="' + obj.code + '" selected="selected">' + obj.code + '</option>';
                        }else{
                            currencyOption += '<option value="' + obj.code + '">' + obj.code + '</option>';
                        }
                    });
                    currencyOption += '</select>';
                } else {
                    flash('warning', result.message);
                }



            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '{{trans('form.conn_error')}}';
                flash('warning', msg);
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
            var currencyMatrixName = $('td:eq(2)', $(this)).find('#currencyMatrixName').val();

            var obj = {serviceCode:service_code,currencyMatrixName:currencyMatrixName};
            if(check==1){
            data.push(obj);
            }
        });

        return JSON.stringify(data);
    }

    function countMenu(){
        var count = 0;
        $("#list").find("tbody tr").each(function () {
            var check = ($('td:eq(0)', $(this)).children().is(':checked') ? 1 : 0);

            if (check == 1) {
                count++;
            }
        });
        return count;
    }

</script>