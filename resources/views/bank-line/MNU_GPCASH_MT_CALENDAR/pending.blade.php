@include('_partials.header_content',['breadcrumb'=>['Ongoing task','Calendar Detail']])


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
                    <h3 class="box-title">BANK CALENDAR</h3><br>
                </div>

                    <div class="box-body form_add">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-md-2 control-label"><strong>From Date</strong></label>
                                    <div class="col-md-3">
                                        <label id="holidayDateFrom_view" class="state_view"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-md-2 control-label"><strong>To Date</strong></label>
                                    <div class="col-md-3">
                                       <label id="holidayDateTo_view" class="state_view"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-md-2 control-label"><strong>Description</strong></label>
                                    <div class="col-md-6">
                                       <label id="dscp_view" class="state_view"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-md-2 control-label"><strong>Type</strong></label>
                                    <div class="col-md-6">
                                       <label id="type_view" class="state_view"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body form_edit">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label"></label>
                                <div class="col-md-9">
                                    <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                           style="border-collapse:collapse;">
                                        <thead>
                                        <tr>
                                            <th align="left"><strong>Date</strong></th>
                                            <th align="left"><strong>Description</strong></th>
                                            <th align="left"><strong>Type</strong></th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>

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
    var currencyOption;
    var noRef = 'OT'+$('#referenceNo').val();
    $(document).ready(function () {


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
                //console.log(result);
                if (result.status=="200") {
                    var detail = result.details;
                    if(detail.action=='CREATE') {
                        var dscp = detail.dscp;
                        var holidayDateFrom = moment(detail.holidayDateFrom, 'DD-MM-YYYY').format("dddd, DD-MMMM-YYYY");
                        var holidayDateTo = moment(detail.holidayDateTo, 'DD-MM-YYYY').format("dddd, DD-MMMM-YYYY");
                        var type = detail.type;
                        var currency = detail.currencyCode;


                        $('#type_view').text(type);
                        if (type == 'CURRENCY') {
                            $('#type_view').text(type + ' HOLIDAY ' + ' - ' + currency);
                        }
                        $('#dscp_view').text(dscp);
                        $('#holidayDateFrom_view').text(holidayDateFrom);
                        $('#holidayDateTo_view').text(holidayDateTo);
                        $('.form_edit').hide();
                        $('.form_add').show();

                    }else {
                        $('.form_add').hide();
                        oTable = $('#list').DataTable({
                            "paging" : false,
                            "ordering" : false,
                            "info": false,
                            "destroy": true,

                            "searching": false,
                            "autoWidth":false,
                            "columnDefs": [

                                {
                                    targets: 0,
                                    sortable: false,
                                    width: "200px"
                                },
                                {
                                    targets: 1,
                                    sortable: false,
                                    width: "350px"
                                },
                                {
                                    targets: 2,
                                    sortable: false,
                                    width: "100px"
                                }

                            ]
                        });
                        $.each(detail.holidayList, function (idx, obj){

                            oTable.row.add([
                                moment(detail.holidayDate, 'DD/MM/YYYY').format("dddd, DD-MMMM-YYYY"),
                                obj.dscp,
                                (obj.type != 'CURRENCY' ? obj.type : (obj.type + '  -  ' + obj.currencyCode)),
                                ''

                            ]).draw(true);
                        });

                    }
                    //$('#code_1').text(detail.code);
                    //$('#name').text(detail.name);
                    //$('#dscp').text(detail.dscp);

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
                    flash('success', result.message+'<br>'+result.dateTimeInfo);
                    $(window).scrollTop(0);
                    $('#approve').hide();
                    $('#reject').hide();
                    $('#save_screen').show();
                    $('#back').html('{{trans('form.done')}}');
                    $('#approve').prop('disabled',false);
                    $('#reject').prop('disabled',false);
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