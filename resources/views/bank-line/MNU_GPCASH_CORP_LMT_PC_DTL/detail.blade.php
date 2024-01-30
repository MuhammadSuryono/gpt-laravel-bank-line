@include('_partials.header_content',['breadcrumb'=>['Transaction limit','detail']])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <input type="hidden" id="corporateId" value=""/>
            <input type="hidden" id="name" value=""/>
            <div class="box">
                
                
                <div class="box-header">
                    <h3 class="box-title">Transaction Limit Detail</h3><br>
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
                        <h3 class="box-title table-hidden">Transaction Limit per Day per Corporate</h3>
                    </div>
                    <div class="box-body">
                        
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th align="center" rowspan="2"></th>
                                        <th align="center" rowspan="2"><strong>Service</strong></th>
                                        <th align="center" rowspan="2"><strong>Currency Matrix</strong></th>
                                        <th align="center" rowspan="2"><strong>Maximum Number of Transaction / Day</strong></th>
                                        <th align="center" colspan="2"><strong>Maximum Transaction Amount / Day</strong></th>
                                    </tr>
                                    <tr>
                                        <th align="center"><strong>Currency</strong></th>
                                        <th align="center"><strong>Value</strong></th>
                                    </tr>
                                    </thead>

                                </table>
                    </div>

                    <div class="box-footer">
                       <div class="state_view">
                               <div class="float-left">
                                   <button type="button" id="back" name="back" class="btn btn-default back">@lang('form.back')</button>
                               </div>
                               <div class="float-right">
                                    <button type="button" id="edit" name="edit" class="btn btn-primary">@lang('form.edit')</button>
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
    var submit_data;
    var id = '{{ $service }}';
    $(document).ready(function () {
        $('.table-hidden').hide();
        $('.state_delete').hide();



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
            "lengthMenu": [[10, 25, 50], [10, 25, 50]],
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
                    width: "225px"
                },
                {
                    targets: 2,
                    sortable: false,
                    width: "100px"
                },
                {
                    targets: 3,
                    sortable: false,
                    width: "75px",
                    className:"dt-right",
                    render: $.fn.dataTable.render.number( ',', '.', 0, '' )

                },
                {
                    targets: 4,
                    sortable: false,
                    width: "30px"
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


        $('#edit').on('click', function () {
            if(countMenu()==0){
                var content ='{{trans('form.alert_noselect',['label'=>'Menu'])}}';
                $.alert({
                    title: '{{trans('form.warning')}}',
                    content: content
                });
                return;
            }
            submit_data = getTableData();

            $('#temp').attr('data-services','');
            $('#temp').attr('data-services',submit_data);
            var corporateId = $('#corporateId').val();
            var name = $('#name').val();
            var res = app.setView(id,'add');
            if(res=='done'){
                $('#type').val('edit');
                $('#corporateId').val(corporateId);
                $('#corporateid_1').text(corporateId);
                $('#name_1').text(name);
            }
        });

        $('.back').on('click', function () {
            app.setView(id,'landing');
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
                if (result.status=="200") {
                    var detail = result.result;
                    oTable.clear();
                    var lastServiceName = '';
                    if(detail){
                    var exclude = [];
                    $.each(detail, function (idx, obj){
                        var serviceName = '';
                        var index = parseInt(idx)+1;
                        /*if(lastServiceName!==obj.serviceName){
                            serviceName = obj.serviceName;
                        }
                        if(serviceName==''){
                            exclude.push(index);

                        }*/

                        serviceName = obj.serviceName;
                        oTable.row.add([
                            '<input id="check" name="check" class="dt-checkboxes state_edit" value="" type="checkbox">',
                            '<span id="service_name">'+serviceName +'</span>'+'<input id="service_code" name="service_code" class="form-control state_edit" value="' + obj.serviceCode + '" type="hidden">',
                            '<span id="currency_matrix_name">'+obj.currencyMatrixName +'</span>'+'<input id="currencyMatrixName" name="service_code" class="form-control state_edit" value="' + obj.currencyMatrixName + '" type="hidden">',
                            obj.maxOccurrenceLimit,
                            obj.currencyCode,
                            obj.maxAmountLimit
                        ]).draw(false);
                        lastServiceName = obj.serviceName;
                    });
                       /* $.each(exclude, function (idx, obj) {
                            $('#list tr:eq('+parseInt(obj)+') > td:eq(0)').html('');
                        });*/
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