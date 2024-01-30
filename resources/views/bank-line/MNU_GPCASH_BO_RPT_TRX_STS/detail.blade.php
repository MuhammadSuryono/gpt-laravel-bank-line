@include('_partials.header_content',['breadcrumb'=>['Transaction Status Listing','detail']])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <input type="hidden" id="pendingTaskId" value=""/>
            <input type="hidden" id="refNo" value=""/>
            <input type="hidden" id="menuCode" value=""/>
            <div class="box">
                
                
            <div class="box-header">
                <h3 class="box-title">Transaction Detail</h3><br>
            </div>
            <form class="form-horizontal">
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Menu</label>
                                <div class="col-md-6">
                                    <label id="menuName">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Transaction Status</label>
                                <div class="col-md-6">
                                    <label id="trxStatus">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Transaction Reference Number</label>
                                <div class="col-md-6">
                                    <label id="trxRefNo">-</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-header">
                    <h3 class="box-title">Transaction Activity</h3><br>
                </div>
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="table-hidden">
                            <div class="form-group">
                                <table id="activityList" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th align="center" ><strong>Activity Date</strong></th>
                                        <th align="center" ><strong>Activity</strong></th>
                                        <th align="center" ><strong>Activity By</strong></th>
                                        <th align="center" ><strong>Approval Count</strong></th>
                                        <th align="center" ><strong>Amount</strong></th>
                                        <th align="center" ><strong>Transaction Status</strong></th>
                                        <th align="center" ><strong></strong></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="actvDetail" style="display:none">
                    <div class="box-header">
                        <h3 class="box-title">Transaction Activity Detail</h3><br>
                    </div>
                    <form class="form-horizontal formDetailInclude">
                        <div class="box-body" id="detailActivity">
                            
                        </div>
                        <div class="box-body" id="detailExecuted">
                            
                        </div>
                    </form>
                    
                </div>
                <div class="box-footer">
                    <div class="state_view">
                        <div class="float-left">
                            <button type="button" id="back" name="back" class="btn btn-default back">@lang('form.back')</button>
                        </div>
                        <div class="float-right">
                            <button type="button" id="save_screen" name="save_screen" class="btn btn-default" onclick="save_pdf();">@lang('form.save_pdf')</button>
                        </div>     
                    </div>
                </div>
            </form>

            </div>
        </div>
    </div>

</section>

<script>
    var activityList;
    var service = '{{ $service }}';
    var noRef;
    $(document).ready(function () {

        
        activityList = $('#activityList').DataTable({
            "paging" : false,
            "ordering" : false,
            "info": false,
            "destroy": true,
            "searching": false,
            "autoWidth":false,
            "columnDefs": [
               {
                    sortable: false,
                    width: "15.83%",
                    targets: 0,
               },
               {
                    targets: 1,
                    sortable: false,
                    width: "15.83%"
                },
                {
                    targets: 2,
                    sortable: false,
                    width: "15.83%"
                },
                {
                    targets: 3,
                    sortable: false,
                    className: 'dt-center',
                    width: "15.83%"
                },
                {
                    targets: 4,
                    sortable: false,
                    width: "15.83%"
                },
                {
                    targets: 5,
                    sortable: false,
                    width: "15.83%"
                },
                {
                    targets: 6,
                    sortable: false,
                    className: 'dt-center',
                    width: "5%"
                }

            ]
        });

        $('.back').on('click', function () {
           var res = app.setView(service,'landing');
        });

    });

    function getDetail(){

        var pendingTaskId= $('#pendingTaskId').val();
        var url_action= 'detailTransactionStatus';
        var value ={
            pendingTaskId: pendingTaskId,
        };
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data:{
                value:value,
                menu:service,
                action:'DETAIL',
                url_action:url_action
            },
            success: function (data) {

                var result = JSON.parse(data);
                if (result.status=="200") {

                    $.each(result.activities, function (idx, obj) {
                            activityList.row.add([
                                obj.activityDate,
                                obj.activity,
                                obj.userId +' - '+ obj.userName,
                                obj.approvalLvCount != '' ? (obj.approvalLvCount +' of '+obj.approvalLvRequired) : '-',
                                obj.amount !='-1' ? (obj.amountCcyCd +' '+currencyFormat(obj.amount)) : '',
                                obj.status,
                                (obj.isCreate == 'Y' ? '<button type="button" id="btnView" name="btnView" class="btn btn-info viewBtn" onclick="viewDetai()">View</button>' : '')||(obj.isExecute == 'Y' ? '<button type="button" id="btnExct" name="btnExct" class="btn btn-info" onclick="viewDetaiExecuted(\''+obj.executedId+'\')">View</button>' : '')
                            ]).draw(false);
                        });

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

                var menuCode = $('#menuCode').val();

                $.ajax({
                        url: 'getTrxStatusDetailView',
                        method: 'post',
                        data:{
                            value:menuCode,
                            service:service,
                        },
                        success: function (data) {
                            $('#detailActivity').html(data);
                        }

                });

            }
        });
    }

    function viewDetai(){

        $('.actvDetail').show();
        $('#detailActivity').show();
        $('#detailExecuted').hide();

         getDetailData($('#refNo').val());
    }

    function viewDetaiExecuted(id) {

        var menuCode = $('#menuCode').val();
        // console.log("masuk viewDetaiExecuted", id + " " + menuCode);

        $('.actvDetail').show();
        $('#detailExecuted').show();
        $('#detailActivity').hide();

        $.ajax({
                url: 'getTrxStatusDetailView',
                method: 'post',
                data:{
                    value:'EXECUTE',
                    service:service,
                },
                success: function (data) {
                    $('#detailExecuted').html(data);
                    getDetailExecuted(id, menuCode);
                }

        });

    }


    function currencyFormat (num) {
        return parseFloat(num).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");  //<--- $1  is a special replacement pattern which holds a value of the first parenthesised submatch string 
    }


</script>