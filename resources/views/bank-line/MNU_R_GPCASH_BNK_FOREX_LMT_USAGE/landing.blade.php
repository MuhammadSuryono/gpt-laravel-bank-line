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
                    <h3 class="box-title">Bank Forex Limit Usage Listing</h3><br>
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
                                        <th></th>
                                        <th align="center"><strong>Foreign Currency</strong></th>
                                        <th align="right"><strong>Usage</strong></th>
                                        <th align="right"><strong>Usage in IDR</strong></th>
                                        <th align="right"><strong>Maximum Buy Limit in IDR</strong></th>
                                        <th align="right"><strong>Maximum Sell Limit in IDR</strong></th>
                                        <th align="right"><strong>Buy Remaining in IDR</strong></th>
                                        <th align="right"><strong>Sell Remaining in IDR</strong></th>
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
                            <button type="button" id="reset" name="reset" class="btn btn-primary">Reset</button>
                            <button type="button" id="cover" name="cover" class="btn btn-primary">Cover</button>
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
                    width: "15%"
                },
                {
                    targets: 2,
                    sortable: false,
                    width: "20%",
                    className:"dt-right",
                    render: $.fn.dataTable.render.number( ',', '.', 2, '' )
                },
                {
                    targets: 3,
                    sortable: false,
                    width: "20%",
                    className:"dt-right",
                    render: $.fn.dataTable.render.number( ',', '.', 2, '' )
                },
                {
                    targets: 4,
                    sortable: false,
                    width: "20%",
                    className:"dt-right",
                    render: $.fn.dataTable.render.number( ',', '.', 2, '' )

                },
                {
                    targets: 5,
                    sortable: false,
                    width: "20%",
                    className:"dt-right",
                    render: $.fn.dataTable.render.number( ',', '.', 2, '' )
                },
                {
                    targets: 6,
                    sortable: false,
                    width: "20%",
                    className:"dt-right",
                    render: $.fn.dataTable.render.number( ',', '.', 2, '' )

                },
                {
                    targets: 7,
                    sortable: false,
                    width: "20%",
                    className:"dt-right",
                    render: $.fn.dataTable.render.number( ',', '.', 2, '' )
                }
            ]
        });

        getMatrix();


        $('#cover').on('click', function () {
            if(countMenu()==0){
                var content ='{{trans('form.alert_noselect',['label'=>'Currency'])}}';
                $.alert({
                    title: '{{trans('form.warning')}}',
                    content: content
                });
                return;
            }
            if(checkUsage()>0){
                var content ='Cannot cover if Usage is 0';
                $.alert({
                    title: '{{trans('form.warning')}}',
                    content: content
                });
                return;
            }
            submit_data = getTableData();
            $('#temp').attr('data-id','');
            $('#temp').attr('data-id',submit_data);
            var res = app.setView(id,'add');
            //$('#selected-table').val('services');

            if(res=='done'){
                $('#type').val('cover');
                $('#stateType').val('EDIT');
                loadState();
            }
        });

        $('#reset').on('click', function () {
            if(countMenu()==0){
                var content ='{{trans('form.alert_noselect',['label'=>'Currency'])}}';
                $.alert({
                    title: '{{trans('form.warning')}}',
                    content: content
                });
                return;
            }
             if(checkUsage()>0){
                var content ='Cannot reset if Usage is 0';
                $.alert({
                    title: '{{trans('form.warning')}}',
                    content: content
                });
                return;
            }

            submit_data = getTableData();
            $('#temp').attr('data-id','');
            $('#temp').attr('data-id',submit_data);
            var res = app.setView(id,'add');
            //$('#selected-table').val('services');

            if(res=='done'){
                $('#type').val('reset');
                $('#stateType').val('RESET');
                loadState();
            }
        });


    });

    function getMatrix(){
        var value = {
            
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
                    if(result.result[0] == undefined){
                        return;
                    }
                    var detail = result.result;
                    oTable.clear();
                    if(detail){
                    $.each(detail, function (idx, obj){
                        oTable.row.add([
                            '<input id="check" name="check" class="dt-checkboxes state_edit" value="" type="checkbox">',
                            '<span id="currency_code">'+obj.currencyCode +'</span>'+'<input id="limit_id" name="limit_id" class="form-control state_edit" value="' + obj.id + '" type="hidden">'+'<input id="limitUsage" name="limitUsage" class="form-control state_edit" value="' + obj.limitUsage + '" type="hidden">',
                            obj.limitUsage ,
                            obj.limitUsageEquivalent,
                            obj.maxBuyLimit,
                            obj.maxSellLimit,
                            obj.remainingBuyLimit,
                            obj.remainingSellLimit
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

    function getTableData(){
        var data = [];

        $("#list").find("tbody tr").each(function(){
            var check = ($('td:eq(0)', $(this)).children().is(':checked') ? 1:0);
            var idLimit = $('td:eq(1)', $(this)).find('#limit_id').val();
            var limitUsage = $('td:eq(1)', $(this)).find('#limitUsage').val();

            var obj = {id:idLimit};
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

    function checkUsage(){
        var count = 0;

         $("#list").find("tbody tr").each(function(){
             var check = ($('td:eq(0)', $(this)).children().is(':checked') ? 1:0);
            var limitUsage = $('td:eq(1)', $(this)).find('#limitUsage').val();

            if(check==1){
                 if(limitUsage == 0){
                     count++;
                 }
            }
        });
        
        return count;
    }


</script>