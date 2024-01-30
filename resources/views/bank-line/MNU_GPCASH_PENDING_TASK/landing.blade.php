<!-- Content Header (Page header) -->
@include('_partials.header_content',['breadcrumb'=>['Ongoing task']])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div class="box">
                <div class="box-header state_pending">
                    <h3 class="box-title">Ongoing Task Listing</h3>

                </div>
                <div class="box-body state_pending">
                    <div class="col-xs-12 no-padding">
                            <table id="list" class="table table-bordered table-striped dataTable" width="100%" border="2" cellpadding="2"
                                   style="border-collapse:collapse;">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th align="left"><strong>Reference Number</strong></th>
                                    <th align="left"><strong>Activity Date Time</strong></th>
                                    <th align="left"><strong>Menu</strong></th>
                                    <th align="left"><strong>Activity</strong></th>
                                    <th align="left"><strong>Description</strong></th>
                                </tr>
                                </thead>

                            </table>
                        </div>
                </div>

                <div class="box-footer">
                    <button type="button" id="btn_refresh" name="btn_refresh" class="btn btn-default float-left state_pending">
                                        Refresh
                    </button>
                    <div class="float-right state_pending">
                        <button type="button" id="btn_reject" name="btn_reject" class="btn btn-danger">
                            @lang('form.reject')
                        </button>
                        <button type="button" id="btn_approve" name="btn_approve" class="btn btn-primary">
                            @lang('form.approve')
                        </button>
                    </div>
                </div>

                <div class="box-header state_result">
                    <h3 class="box-title">Ongoing Task Submitted</h3>
                </div>
                <div class="box-body state_result">
                    <div class="container-fluid">
                        <div class="row">
                            <table id="result" class="table table-bordered table-striped dataTable" width="100%" border="2" cellpadding="2"
                                   style="border-collapse:collapse;">
                                <thead>
                                <tr>
                                    <th align="left"><strong>Reference Number</strong></th>
                                    <th align="left"><strong>Activity Date Time</strong></th>
                                    <th align="left"><strong>Menu</strong></th>
                                    <th align="left"><strong>Activity</strong></th>
                                    <th align="left"><strong>Description</strong></th>
                                    <th align="left"><strong>Result Message</strong></th>
                                </tr>
                                </thead>

                            </table>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12 text-center" data-html2canvas-ignore="true">
                                    <div class="float-right">
                                    <button type="button" id="btn_done" name="btn_done" class="btn btn-primary">
                                        @lang('form.done')
                                    </button>
                                    </div>
                                    <div class="float-left">
                                        <button type="button" id="save_screen" name="save_screen" class="btn btn-default" onclick="save_pdf();">@lang('form.save_pdf')</button>
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
    var oTable = null;
    var oResult = null;
    var noRef = 'OTB';
    $(document).ready(function () {
        $('.state_result').hide();
        getData();
        init_resultTable();



        $('#btn_refresh').on('click', function () {
            $('#btn_refresh').prop("disabled",true);
            getData();
        });

        $('#btn_done').on('click', function () {
            getData();
            $('.state_pending').show();
            $('.state_result').hide();
        });

        $('#btn_approve').on('click', function () {
            if(countMenu()==0){
                var content ='{{trans('form.alert_noselect',['label'=>'Pending Task'])}}';
                $.alert({
                    title: '{{trans('form.warning')}}',
                    content: content
                });
                return;
            }
            $('#btn_approve').prop('disabled',true);
            $.confirm({
                title: '{{trans('form.confirm')}}',
                content: '{{trans('form.confirm_approve')}}',
                buttons: {
                    
                    cancel: {
                        text: '{{trans('form.cancel')}}',
                        btnClass: 'btn-default',
                        action: function(){
                            $('#btn_approve').prop('disabled',false);
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
        $('#btn_reject').on('click', function () {
            if(countMenu()==0){
                var content ='{{trans('form.alert_noselect',['label'=>'Pending Task'])}}';
                $.alert({
                    title: '{{trans('form.warning')}}',
                    content: content
                });
                return;
            }
            $('#btn_reject').prop('disabled',true);
            $.confirm({
                title: '{{trans('form.confirm')}}',
                content: '{{trans('form.confirm_reject')}}',
                buttons: {
                    
                    cancel: {
                        text: '{{trans('form.cancel')}}',
                        btnClass: 'btn-default',
                        action: function(){
                            $('#btn_reject').prop('disabled',false);
                        }
                    },
                    confirm: {
                        text: '{{trans('form.confirm')}}',
                        btnClass: 'btn-primary',
                        action: function(){
                            submitTask('reject');
                        }
                    }

                }
            });
        });
    });

    $('#list tbody').on('click', 'a', function (e) {

        if(e.handled !== true) // This will prevent event triggering more then once
        {
           e.handled = true;
        }
        var no_ref = $(this).attr('data-refno');
        var parent_menu = $(this).attr('data-parent-menu');
        var menu_code = $(this).attr('data-menucode');
        var menu_name = $(this).attr('data-menuname');
        var datetime = $(this).attr('data-datetime');
        var action = $(this).attr('data-action');
        var task_id = $(this).attr('data-taskid');
        if ( no_ref !== undefined) {
            var res = app.setView(task_id,'pending');
            if(res=='done'){
                $('#referenceNo').val(no_ref);
                $('#taskId').val(task_id);
                $('#menu_text').text(menu_name);
                $('#datetime_text').text(datetime);
                $('#noref_text').text(no_ref);
                $('#activity_text').text(action);
                getData();
            }
            
        }
    });


    function getData() {
        var id = 'MNU_GPCASH_PENDING_TASK';
        var value = {
            "referenceNo": "",
            "pendingTaskMenuCode": ""
        };
        var url_action = 'searchPendingTaskByUser';
        var result_key = 'tasks';
        var action = 'SEARCH';
        var custom_order = {"startDate":"ASC"};

        oTable = $('#list').DataTable({
            "info":false,
            "destroy": true,
            "searching": false,
            "initComplete": function(settings, json) {
                $('#btn_refresh').prop("disabled",false);

            },
            "lengthMenu": [[10, 25, 50], [10, 25, 50]],
            "processing": true,
            "serverSide": true,
            "order": [[ 2, "desc" ]],
            "select": {
                style: 'multi',
                selector: 'input.dt-checkboxes'
            },
            "columnDefs": [
                {
                    targets: 0,
                    data: null,
                    render: function ( data, type, full, meta ) {
                        return '<input class="dt-checkboxes"  type="checkbox">';
                    },
                    checkboxes: {
                        selectRow: true,
                        selectAllPages: false
                    },
                    orderable: false,
                    width:'5%'
                },
                {
                    targets: 1,
                    data: null,
                    render: function ( data, type, full, meta ) {
                       return '<a href="javascript:void(0)" id="'+full['taskId']+'" data-parent-menu="" data-service="'+full['pendingTaskMenuCode']+'" data-refno="'+full['referenceNo']+'" data-taskid="'+full['taskId']+'" data-datetime="'+full['startDate']+'" data-menu="'+full['pendingTaskMenuName']+'" data-menucode="'+full['pendingTaskMenuCode']+'" data-menuname="'+full['pendingTaskMenuName']+'" data-action="'+full['action']+'">'+full['referenceNo']+'</a>';

                    },
                    orderable: true,
                    width:'20%'
                },
                {
                    targets: 2,
                    data: "startDate",
                    orderable: true,
                    width:'15%'
                },
                {
                    targets: 3,
                    data: "pendingTaskMenuName",
                    orderable: true,
                    width:'20%'
                },
                {
                    targets: 4,
                    data: "action",
                    orderable: true,
                    width:'15%'
                },
                {
                    targets: 5,
                    data: "uniqueKeyDisplay",
                    orderable: true,
                    width:'25%'
                }

            ],

            "ajax": {
                url: "fetchDataTable",
                type:'POST',
                data: function ( d ) {
                    d.value = value;
                    d.menu = id;
                    d.url_action = url_action;
                    d.action = action;
                    d.result_key = result_key;
                    d.custom_order = custom_order;
                    d._token = '{{ csrf_token() }}';
                },
                error:function (jqXHR, textStatus, errorThrown) {
                    var msg = '{{trans('form.conn_error')}}';
                    flash('warning', msg);
                    $('#list_processing').hide();
                    $('#btn_refresh').prop("disabled",false);

                },complete: function(data) {
                    /*$('input').iCheck({
                        checkboxClass: 'icheckbox_flat-blue',
                        radioClass: 'iradio_flat-blue'
                    });*/

                }
            }
        });

    }

    function submitTask(type){
        var id = 'MNU_GPCASH_PENDING_TASK';
        var selected = $.map(oTable.rows('.selected').data(), function (item) {
            return item;
        });

        var data = [];
        if(selected){
        $.each(selected, function (index,value) {
            data.push({referenceNo:value.referenceNo,taskId:value.taskId,startDate:value.startDate,pendingTaskMenuName:value.pendingTaskMenuName,action:value.action,uniqueKeyDisplay:value.uniqueKeyDisplay});
        });
        }

        var obj = {pendingTaskList:data};
        var action;
        var url_action;
        if(type=='approve'){
            action = 'APPROVE';
            url_action = 'approveList';
        }else if(type=='reject'){
            action = 'REJECT';
            url_action = 'rejectList';
        }else{
            return;
        }


        $.ajax({
            url: 'detail',
            method: 'post',
            data: {"_token": "{{ csrf_token() }}", menu: id, value: obj,url_action:url_action,action:action},
            success: function (data) {
                $('.state_result').show();
                $('#btn_approve').prop('disabled',false);
                $('#btn_reject').prop('disabled',false);
                var result = JSON.parse(data);
                    oResult.clear();
                    if(result){
                    $.each(result, function (i) {
                        $.each(result[i], function (idx, obj) {

                           oResult.row.add([
                                obj.referenceNo,obj.startDate,obj.pendingTaskMenuName,obj.action,obj.uniqueKeyDisplay,obj.message
                            ]).draw(false);
                        });
                    });
                    }
                $(window).scrollTop(0);
                getData();
                flash('success','{{trans('form.pending_success')}}');
                $('#btn_approve').prop('disabled',false);
                $('#btn_reject').prop('disabled',false);
                $('.state_pending').hide();
                $('.state_result').show();
                $('#save_screen').show();


            }, error: function (xhr, ajaxOptions, thrownError) {
                $(window).scrollTop(0);
                $('#btn_approve').prop('disabled',false);
                $('#btn_reject').prop('disabled',false);
                flash('warning','Task Approve Failed');
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }
        });
    }

    function init_resultTable(){
        oResult = $('#result').DataTable({
            "info":false,
            "destroy": true,
            "searching": false,
            "lengthMenu": [[10, 25, 50], [10, 25, 50]],
            "processing": false,
            "serverSide": false

        });
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