@include('_partials.header_content',['breadcrumb'=>['Ongoing task','Limit Updates Detail']])


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
                    <h3 class="box-title">Limit Updates</h3><br>
                </div>

                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Limit Updates</label>
                                <div class="col-md-6">
                                    <label id="updateType">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row specialLimit">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Corporate with Special Limit</label>
                                <div class="col-md-6">
                                    <label id="isUpdate">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row specificLimit">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Limit Setup Code</label>
                                <div class="col-md-6">
                                    <label id="feeCode">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row specificLimit">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Limit Setup Name</label>
                                <div class="col-md-6">
                                    <label id="feeName">-</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="box-header">
                        <h3 class="box-title table-hidden">Limit Setup Detail</h3>
                    </div>
                    <div class="box-body">
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
    var noRef = 'OT'+$('#referenceNo').val();
    $(document).ready(function () {

        oTable = $('#list').DataTable({
            "paging": false,
            "ordering": false,
            "info": false,
            "destroy": true,
            "searching": false,
            "autoWidth": false,
            "ScrollX": '100%',
            "lengthMenu": [[10, 25, 50], [10, 25, 50]],
            "columnDefs": [
                {
                    targets: 0,
                    sortable: false,
                    width: "25%"
                },
                {
                    targets: 1,
                    sortable: false,
                    width: "20%"
                },
                {
                    targets: 2,
                    sortable: false,
                    width: "20%",
                    render: $.fn.dataTable.render.number( ',', '.', 0, '' ),
                    className:"dt-center"
                },
                {
                    targets: 3,
                    sortable: false,
                    width: "10%",
                    className:"dt-center"
                },
                {
                    targets: 4,
                    sortable: false,
                    width: "20%",
                    render: $.fn.dataTable.render.number( ',', '.', 0, '' ),
                    className:"dt-body-right"
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
                    var detail = result.details;
                    $('#updateType').text(detail.updateType);

                    if (detail.isUpdateAll == 'Y') {
                        $('#isUpdate').text(detail.isUpdate);

                        $('.specificLimit').hide();
                    } else {

                        $('#feeCode').text(detail.feeCode);
                        $('#feeName').text(detail.feeName);
                        $('.specialLimit').hide();
                    }

                    oTable.clear();
                    $.each(detail.dataTable, function (idx, obj){
                        oTable.row.add([
                            obj.serviceName,
                            obj.curMatrixName,
                            obj.maxTrxPerDay,
                            obj.currency,
                            obj.maxTrxAmt
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