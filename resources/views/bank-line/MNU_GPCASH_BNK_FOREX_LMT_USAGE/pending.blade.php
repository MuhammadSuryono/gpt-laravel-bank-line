@include('_partials.header_content',['breadcrumb'=>['Ongoing task','Bank Forex Limit Usage']])

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <input type="hidden" id="referenceNo" value=""/>
            <input type="hidden" id="taskId" value=""/>
            <form class="form-horizontal">
                <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Ongoing Task Detail</h3><br>
                </div>
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Menu</label>
                                <div class="col-md-6">
                                    <label id="menu_text">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Activity</label>
                                <div class="col-md-6">
                                    <label id="activity_text">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Reference Number</label>
                                <div class="col-md-6">
                                    <label id="noref_text">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Activity Date Time</label>
                                <div class="col-md-6">
                                    <label id="datetime_text">-</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="box-header">
                    <h3 class="box-title ">Bank Forex Limit Usage Listing</h3><br>
                </div>

                      <div class="box-body">
                        <div class="form-group editState">
                            <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                           style="border-collapse:collapse;">
                                <thead>
                                    <tr>
                                        <th align="center"><strong>Foreign Currency</strong></th>
                                        <th align="right"><strong>Usage</strong></th>
                                        <th align="right"><strong>Maximum Buy Limit in IDR</strong></th>
                                        <th align="right"><strong>Maximum Sell Limit in IDR</strong></th>
                                        <th align="right"><strong>Cover Usage</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td align="left"></td>
                                        <td align="left"></td>
                                        <td align="left"></td>
                                        <td align="left"></td>
                                        <td align="left"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group resetState">
                            <table id="list_reset" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                           style="border-collapse:collapse;">
                                <thead>
                                    <tr>
                                        <th align="center"><strong>Foreign Currency</strong></th>
                                        <th align="right"><strong>Usage</strong></th>
                                        <th align="right"><strong>Usage in IDR</strong></th>
                                        <th align="right"><strong>Maximum Buy Limit in IDR</strong></th>
                                        <th align="right"><strong>Maximum Sell Limit in IDR</strong></th>
                                        <th align="right"><strong>Buy Remaining in IDR</strong></th>
                                        <th align="right"><strong>Sell Remaining in IDR</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td align="left"></td>
                                        <td align="left"></td>
                                        <td align="left"></td>
                                        <td align="left"></td>
                                        <td align="left"></td>
                                        <td align="left"></td>
                                        <td align="left"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                           
                    </div>
                    <div class="box-footer">
                            <div class="state_view" data-html2canvas-ignore="true">
                                <div class="float-left">
                                    <button type="button" id="back" name="back" class="btn btn-default back">@lang('form.back')</button>
                                </div>
                                <div class="float-right">
                                    <button type="button" id="save_screen" name="save_screen" class="btn btn-default" style="display:none" onclick="save_pdf();">@lang('form.save_pdf')</button>
                                    <button type="button" id="reject" name="reject" class="btn btn-danger">@lang('form.reject')</button>
                                    <button type="button" id="approve" name="approve" class="btn btn-primary">@lang('form.approve')</button>
                                </div>
                            </div>
                    </div>
            </div>
            </form>
        </div>
    </div>

</section>

<script>
    var oTable;
    var oTableReset
    var currencyOption;
    var noRef = 'OT'+$('#referenceNo').val();
    var viewState;
    $(document).ready(function () {
        
        var id = '{{ $service }}';


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
                    width: "20%"
                },
                {
                    targets: 1,
                    sortable: false,
                    width: "20%",
                    className:"dt-right",
                    render: $.fn.dataTable.render.number( ',', '.', 2, '' )
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
                }

            ]
        });


        oTableReset = $('#list_reset').DataTable({
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
                    width: "10%"
                },
                {
                    targets: 1,
                    sortable: false,
                    width: "15%",
                    className:"dt-right",
                    render: $.fn.dataTable.render.number( ',', '.', 2, '' )
                },
                {
                    targets: 2,
                    sortable: false,
                    width: "15%",
                    className:"dt-right",
                    render: $.fn.dataTable.render.number( ',', '.', 2, '' )
                },
                {
                    targets: 3,
                    sortable: false,
                    width: "15%",
                    className:"dt-right",
                    render: $.fn.dataTable.render.number( ',', '.', 2, '' )
                },
                {
                    targets: 4,
                    sortable: false,
                    width: "15%",
                    className:"dt-right",
                    render: $.fn.dataTable.render.number( ',', '.', 2, '' )

                },
                {
                    targets: 5,
                    sortable: false,
                    width: "15%",
                    className:"dt-right",
                    render: $.fn.dataTable.render.number( ',', '.', 2, '' )
                },
                {
                    targets: 6,
                    sortable: false,
                    width: "15%",
                    className:"dt-right",
                    render: $.fn.dataTable.render.number( ',', '.', 2, '' )

                },               
            ]
        });


        $('#approve').on('click', function () {
            $('#approve').prop('disabled',true);
            $.confirm({
                title: '{{trans('form.confirm')}}',
                content: '{{trans('form.confirm_approve')}}',
                buttons: {
                    
                    cancel: {
                        text: '{{trans('form.cancel')}}',
                        btnClass: 'btn-default',
                        action: function(){
                            $('#approve').prop('disabled',false);
                        }
                    },
                    confirm: {
                        text: '{{trans('form.confirm')}}',
                        btnClass: 'btn-primary',
                        action: function(){
                            submitTask('approve');
                        }
                    },

                }
            });
        });

        $('#reject').on('click', function () {
            $('#reject').prop('disabled',true);
            $.confirm({
                title: '{{trans('form.confirm')}}',
                content: '{{trans('form.confirm_reject')}}',
                buttons: {
                    
                    cancel: {
                        text: '{{trans('form.cancel')}}',
                        btnClass: 'btn-default',
                        action: function(){
                            $('#reject').prop('disabled',false);
                        }
                    },
                    confirm: {
                        text: '{{trans('form.confirm')}}',
                        btnClass: 'btn-primary',
                        action: function(){
                            submitTask('reject');
                        }
                    },

                }
            });
        });

        $('.back').on('click', function () {
            res = app.setView('MNU_GPCASH_PENDING_TASK','landing');
        });



    });

    function getData(){
        var referenceNo = $('#referenceNo').val();
        var value = {
            referenceNo : referenceNo
        };
        var url_action = 'detailPendingTask';
        var action = 'DETAIL';
        var menu = 'MNU_GPCASH_PENDING_TASK';
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
                    var detail = result.details.bankForexLimitList;
                    oTable.clear();
                    if(detail){
                        viewState = result.details.wfAction;
                    $.each(detail, function (idx, obj){
                        if (viewState == 'RESET') {

                            oTableReset.row.add([
                                obj.currencyCode,
                                obj.limitUsage,
                                    obj.limitUsageEquivalent,
                                    obj.maxBuyLimit,
                                    obj.maxSellLimit,                                    
                                    obj.remainingSellLimit,
                                    obj.remainingBuyLimit
                            ]).draw(false); 

                            $('.editState').hide();
                            $('.resetState').show();

                        } else {

                            oTable.row.add([
                                obj.currencyCode,
                                obj.limitUsage,
                                obj.maxBuyLimit,
                                obj.maxSellLimit,
                                obj.coverUsage
                            ]).draw(false); 

                            $('.editState').show();
                            $('.resetState').hide();    
                                
                        }

                        

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
                $('.rate').autoNumeric('init',{
                        emptyInputBehavior: 'zero',
                        digitGroupSeparator        : ',',
                        decimalCharacter           : '.',
                        decimalCharacterAlternative: '.',
                        allowDecimalPadding : false,
                        minimumValue:'0.00',maximumValue:'999999999999999.99'
                });
                
            }
        });
    }

    function submitTask(type){
        var id = 'MNU_GPCASH_PENDING_TASK';
        var value = {
            "referenceNo": $('#referenceNo').val(),
            "taskId": $('#taskId').val()
        };

        var action;
        var url_action;
        if(type=='approve'){
            action = 'APPROVE';
            url_action = 'approve';
        }else if(type=='reject'){
            action = 'REJECT';
            url_action = 'reject';
        }else{
            return;
        }

        $.ajax({
            url: 'detail',
            method: 'post',
            data: {"_token": "{{ csrf_token() }}", menu: id, value: value,url_action:url_action,action:action},
            success: function (data) {
                var result = JSON.parse(data);
                if (result.status=="200") {
                    flash('success', result.message + '<br>' + result.dateTimeInfo);
                    $(window).scrollTop(0);
                    $('#approve').hide();
                    $('#reject').hide();
                    $('#save_screen').show();
                    $('#back').html('{{trans('form.done')}}');
                    $('#approve').prop('disabled', false);
                    $('#reject').prop('disabled', false);
                }else{
                    flash('warning',result.message+'<br>'+result.dateTimeInfo);
                    $('#approve').prop('disabled',false);
                    $('#reject').prop('disabled',false);
                    }
            }, error: function (xhr, ajaxOptions, thrownError) {
                $(window).scrollTop(0);
                $('#approve').prop('disabled',false);
                $('#reject').prop('disabled',false);
                $('#save_screen').hide();
                flash('warning','{{trans('form.pending_error')}}');
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }
        });
    }

</script>