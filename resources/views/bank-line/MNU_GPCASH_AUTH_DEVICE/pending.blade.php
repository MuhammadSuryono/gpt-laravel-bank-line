@include('_partials.header_content',['breadcrumb'=>['Ongoing task','Authentication Device']])


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
                    <h3 class="box-title">Corporate Detail</h3><br>
                </div>

                    <div class="box-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Corporate</label>
                                    <div class="col-md-6">
                                        <label id="code_1">-</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row unassigned" style="display: none;">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Serial Number</label>
                                    <div class="col-md-6">
                                        <label id="tokenNo">-</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row unassigned" style="display: none;">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Assigned To</label>
                                    <div class="col-md-6">
                                        <label id="assignedTo">-</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row unassigned" style="display: none;">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Assigned By</label>
                                    <div class="col-md-6">
                                        <label id="assignedBy">-</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row unassigned" style="display: none;">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Assigned Date</label>
                                    <div class="col-md-6">
                                        <label id="assignedDate">-</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row unassigned" style="display: none;">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Status</label>
                                    <div class="col-md-6">
                                        <label id="status">-</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                <div class="box-header listing">
                    <h3 class="box-title table-hidden">Device Listing</h3>
                </div>
                <div class="box-body listing">
                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2" style="border-collapse:collapse;">
                                <thead>
                                <tr>
                                    <th align="left"><strong>Serial Number</strong></th>
                                    <th align="left"><strong>Assigned To</strong></th>
                                    <th align="left"><strong>Assigned By</strong></th>
                                    <th align="left"><strong>Assigned Date</strong></th>
                                    <th align="left"><strong>Status</strong></th>
                                </tr>
                                </thead>
                </table>
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
    var id = '{{ $service }}';
    var noRef = 'OT'+$('#referenceNo').val();
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
                    width: "20%"
                },
                {
                    targets: 1,
                    sortable: true,
                    width: "20%"
                },
                {
                    targets: 2,
                    sortable: true,
                    width: "20%"
                },
                {
                    targets: 3,
                    sortable: true,
                    width: "20%"
                },
                {
                    targets: 4,
                    sortable: false,
                    width: "10%"
                }
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
                    }

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
                    var detail = result.details.tokenList;
                    $('#code_1').text(result.details.corporateId+' - '+result.details.name);
                    if(result.details.action=='UNASSIGN'){
                        $('.listing').hide();
                        $('.unassigned').show();
                        $('#tokenNo').text(result.details.tokenNo);
                        $('#assignedTo').text(result.details.userId+' - '+result.details.userName);
                        $('#assignedBy').text(result.details.assignedBy);
                        $('#assignedDate').text(result.details.assignedDate);
                        $('#status').text(result.details.status);
                    }
                    oTable.clear();
                    if(detail[0].assignedBy==undefined){
                        $.each(detail, function (idx, obj){
                            oTable.row.add([
                                obj,'','','','',''
                            ]).draw(true);
                        });
                        oTable.column(1).visible(false);
                        oTable.column(2).visible(false);
                        oTable.column(3).visible(false);
                        oTable.column(4).visible(false);

                    }else{
                        $.each(detail, function (idx, obj){
                            oTable.row.add([
                                obj.tokenNo,
                                obj.userId,
                                obj.assignedBy,
                                obj.assignedDate,
                                obj.status
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
                $(window).scrollTop(0);
                if (result.status=="200") {
                    flash('success', result.message+'<br>'+result.dateTimeInfo);
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