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
                            <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                   style="border-collapse:collapse;">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th align="left"><strong>ReferenceNo</strong></th>
                                    <th align="left"><strong>Created Date</strong></th>
                                    <th align="left"><strong>Feature</strong></th>
                                    <th align="left"><strong>Maker User Id</strong></th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td></td>
                                    <td align="left"></td>
                                    <td align="left"></td>
                                    <td align="left"></td>
                                    <td align="left"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-xs-12 no-padding">
                            <div class="form-group">
                                <div class="col-md-12 text-center">
                                    <button type="button" id="btn_refresh" name="btn_refresh" class="btn btn-default">
                                        Refresh
                                    </button>
                                    <button type="button" id="btn_approve" name="btn_approve" class="btn btn-success">
                                        @lang('form.approve')
                                    </button>
                                    <button type="button" id="btn_reject" name="btn_reject" class="btn btn-danger">
                                        @lang('form.reject')
                                    </button>
                                </div>
                            </div>
                        </div>
                    
                </div>

                <div class="box-header state_result">
                    <h3 class="box-title">Ongoing Task Submitted</h3>
                </div>
                <div class="box-body state_result">
                    <div class="container-fluid">
                        <div class="row">
                            <table id="result" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                   style="border-collapse:collapse;">
                                <thead>
                                <tr>
                                    <th align="left"><strong>ReferenceNo</strong></th>
                                    <th align="left"><strong>Created Date</strong></th>
                                    <th align="left"><strong>Feature</strong></th>
                                    <th align="left"><strong>Maker User Id</strong></th>
                                    <th align="left"><strong>Result Message</strong></th>
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
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12 text-center">

                                    <button type="button" id="btn_done" name="btn_done" class="btn btn-default">
                                        @lang('form.done')
                                    </button>
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
            $('#btn_approve').prop('disabled',true);
            $.confirm({
                title: '{{trans('form.confirm')}}',
                content: '{{trans('form.confirm_approve')}}',
                buttons: {
                    confirm: {
                        text: '{{trans('form.confirm')}}',
                        btnClass: 'btn-danger',
                        action: function(){
                            submitTask('approve');
                        }
                    },
                    cancel: {
                        text: '{{trans('form.cancel')}}',
                        btnClass: 'btn-default',
                        action: function(){
                            $('#btn_approve').prop('disabled',false);
                        }
                    }

                }
            });

        });
        $('#btn_reject').on('click', function () {
            $('#btn_reject').prop('disabled',true);
            $.confirm({
                title: '{{trans('form.confirm')}}',
                content: '{{trans('form.confirm_reject')}}',
                buttons: {
                    confirm: {
                        text: '{{trans('form.confirm')}}',
                        btnClass: 'btn-danger',
                        action: function(){
                            submitTask('reject');
                        }
                    },
                    cancel: {
                        text: '{{trans('form.cancel')}}',
                        btnClass: 'btn-default',
                        action: function(){
                            $('#btn_reject').prop('disabled',false);
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
        var no_ref = $(this).data('refno');
        var menu_code = $(this).data('menucode');
        var task_id = $(this).data('taskid');
        if ( no_ref !== undefined) {
            $.ajax({
                url: 'getDetail/'+'pending.'+menu_code,
                method: 'post',
                success: function (data) {
                    $(window).scrollTop(0);
                    $('#content-ajax').html(data);
                    $('#referenceNo').val(no_ref);
                    $('#taskId').val(task_id);
                    getData();

                }, error: function (xhr, ajaxOptions, thrownError) {

                    console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                }
            });
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
        var custom_order = {"pt.createdDate":"ASC"};

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
                        return '<input class="dt-checkboxes" type="checkbox"/>';
                    },
                    checkboxes: {
                        selectRow: true,
                        selectAllPages: false
                    },
                    orderable: false
                },
                {
                    targets: 1,
                    data: null,
                    render: function ( data, type, full, meta ) {
                        return '<a href="javascript:void(0)" data-refno="'+full['referenceNo']+'" data-taskid="'+full['taskId']+'" data-menucode="'+full['pendingTaskMenuCode']+'">'+full['referenceNo']+'</a>';

                    },
                    orderable: true
                },
                {
                    targets: 2,
                    data: "startDate",
                    orderable: true
                },
                {
                    targets: 3,
                    data: "pendingTaskMenuName",
                    orderable: true
                },
                {
                    targets: 4,
                    data: "actionBy",
                    orderable: true
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
        $.each(selected, function (index,value) {
            data.push({referenceNo:value.referenceNo,taskId:value.taskId,startDate:value.startDate,pendingTaskMenuName:value.pendingTaskMenuName,actionBy:value.actionBy});
        });

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
                    $.each(result, function (i) {
                        $.each(result[i], function (idx, obj) {

                           oResult.row.add([
                                obj.referenceNo,obj.startDate,obj.pendingTaskMenuName,obj.actionBy,obj.message
                            ]).draw(false);
                        });
                    });
                $(window).scrollTop(0);
                getData();
                flash('success','{{trans('form.pending_success')}}');
                $('#btn_approve').prop('disabled',false);
                $('#btn_reject').prop('disabled',false);
                $('.state_pending').hide();
                $('.state_result').show();

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
</script>