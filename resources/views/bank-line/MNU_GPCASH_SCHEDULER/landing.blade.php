@include('_partials.header_content',['breadcrumb'=>[str_replace('-',' ',$menu)]])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div class="box">
                <div id="spinner" style="display:none"></div>

                <div id="exTab" class="">
                    <ul class="nav nav-tabs state_edit">
                            <li class="active">
                                <a href="#tab_scheduler" data-toggle="tab">Scheduler</a>
                            </li>
                            <li><a href="#tab_status" data-toggle="tab">Status</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_scheduler">
                                    <div class="container-fluid box-body">
                                        <div class="row">
                                            <form id="form-area-task" class="form-horizontal form-area">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Task Scheduler Code</label>

                                                <div class="col-md-6">

                                                    <input type="text" id="code_task" name="code_task" class="form-control" autocomplete="off" value="">

                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="box-footer">
                                        <div class="float-left">
                                            <button type="button" id="search" name="search" class="btn btn-primary">@lang('form.search')</button>
                                        </div>
                                    </div>

                                    <div class="box-header list-title">
                                        <h3 class="box-title">Scheduler Listing</h3>
                                    </div>
                                    <div class="box-body list-title">
                                        
                                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                                       style="border-collapse:collapse;">
                                                    <thead>
                                                    <tr>
                                                        <th align="center"><strong>Task Code</strong></th>
                                                        <th align="center"><strong>Task Name</strong></th>
                                                        <th align="center"><strong>Cron</strong></th>
                                                        <th align="center"></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td align="left"></td>
                                                        <td align="left"></td>
                                                        <td align="left"></td>
                                                        <td align="center"></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                    </div>
                            </div>

                            <div class="tab-pane" id="tab_status">
                                    <div class="container-fluid box-body">
                                        <div class="row">
                                            <form id="form-area-status" class="form-horizontal form-area">
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Task Status Code&ast;</label>

                                                    <div class="col-md-6">
                                                        <input type="text" id="code_status" name="code_status" class="form-control" autocomplete="off" value="" data-error="This field is required." required>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="box-footer">
                                        <div class="float-left">
                                                <button type="button" id="search_status" name="search" class="btn btn-primary">@lang('form.search')</button>
                                        </div>
                                    </div>

                                    <div class="box-header list-title-status">
                                        <h3 class="box-title">Status Listing</h3>
                                    </div>
                                    <div class="box-body list-title-status">
                                        
                                                <table id="list_status" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                                       style="border-collapse:collapse;">
                                                    <thead>
                                                    <tr>
                                                        <th align="center"><strong>Task Code</strong></th>
                                                        <th align="center"><strong>Task Name</strong></th>
                                                        <th align="center"><strong>Start Date</strong></th>
                                                        <th align="center"><strong>End Date</strong></th>
                                                        <th align="center"><strong>Status</strong></th>
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

                            </div>
                        </div>
                            
                </div>
                </form>
            </div>
        </div>
    </div>

</section>

<script>

    var id = '{{ $service }}';
    var oTable;
    var oTable_status;

    $(document).ready(function () {
        

         $('#form-area-status').validator().on('submit', function (e) {
            if (e.isDefaultPrevented()) {
                // handle the invalid form...
            } else {
                // everything looks good!

            }
        });

        var url_action = '';
        var action = 'SEARCH';
        var result_key = 'result';
        var custom_order = '';

        $('#list').hide();
        $('.list-title').hide();
        $('#list_status').hide();
        $('.list-title-status').hide();

        $('#search').on('click', function () {

            url_action = 'search';
            custom_order = {"taskCode":"ASC"};

            $(this).prop("disabled",true);
            $('#list').show();
            $('.list-title').show();
            var value = {
                taskCode: $('#code_task').val(),
                taskName: "",
                currentPage: "1",
                pageSize: "20"
                //orderBy: {"taskCode": "ASC"}
            };

          oTable = $('#list').DataTable({
                "destroy": true,
                "initComplete": function(settings, json) {
                    $('#search').prop("disabled",false);

                },
               "drawCallback": function( settings ) {


               },
                "select": false,
                "searching": false,
                "lengthMenu": [[10, 25, 50], [10, 25, 50]],
                "processing": true,
                "serverSide": true,
                "autoWidth": false,
                "ScrollX": '100%',
                "columnDefs": [
                    {
                        targets: 0,
                        data: "taskCode",
                        orderable: false
                    },
                    {
                        targets: 1,
                        data: "taskName",
                        orderable: false
                    },
                    {
                        targets: 2,
                        data: "cron",   
                        orderable: false
                    },
                    {
                        targets: 3,
                        data: {taskCode:"taskCode", parameter: "parameter"},
                        width: "15%",
                        render: function ( data, type, full, meta ) {
                            return '<button data-code="'+data.taskCode+'" class="btn btn-default execute" style="width:125px;" align="center" onClick="execute(\''+data.taskCode+'\', \''+data.parameter+'\');">Execute</button>';
                        },
                        orderable: false
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
                        $('#list').hide();
                        $('.list-title').hide();
                        $('#search').prop("disabled",false);
                    }
                }
            });
        });

        // $('.form-area').validator('validate');

        $('#search_status').on('click', function () {

            url_action = 'searchStatus';
            custom_order = {"startDate":"DESC"};

            if($('#form-area-status').validator('validate').has('.has-error').length==0){

                $(this).prop("disabled",true);
                $('#list_status').show();
                $('.list-title-status').show();
                var value = {
                    taskCode: $('#code_status').val(),
                    taskName: "",
                    currentPage: "1",
                    pageSize: "10"
                    //orderBy: {"startDate": "DESC"}
                };

                oTable_status = $('#list_status').DataTable({
                    "destroy": true,
                    "initComplete": function(settings, json) {
                        $('#search_status').prop("disabled",false);

                    },
                    "select": false,
                    "searching": false,
                    "lengthMenu": [[10, 25, 50], [10, 25, 50]],
                    "processing": true,
                    "serverSide": true,
                    "autoWidth": false,
                    "ScrollX": '100%',
                    "columnDefs": [
                        {
                            targets: 0,
                             data: "taskCode",
                            orderable: false
                        },
                        {
                            targets: 1,
                             data: "taskName",
                            orderable: false
                        },
                        {
                            targets: 2,
                             data: "startDate",
                            orderable: false,
                             render: function ( data, type, full, meta ) {

                                var formatted = data.replace(/\//g,"-");

                                return '<span id="startDate" style="float: left;">'+ formatted + '</span>';
                            }
                        },
                        {
                            targets: 3,
                             data: "endDate",
                            orderable: false,
                            render: function ( data, type, full, meta ) {
                                var formatted = data.replace(/\//g,"-");

                                return '<span id="startDate" style="float: left;">'+ formatted + '</span>';
                            }
                        },
                        {
                            targets: 4,
                             data: "status",
                            orderable: false
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
                            $('#list_status').hide();
                            $('.list-title-status').hide();
                            $('#search_status').prop("disabled",false);
                        }
                    }
                });

             }
        });

        
        $('input[type="text"]').not('.numeric').alphanum({
            allowSpace: true,
            allow : ',._!@'
        });

    });

    function executeTask(code, param) {
        //console.log(code);
        var value = {
            taskCode: code,
            parameter: param
        };
        var url_action = 'execute';
        var action = 'EXECUTE';
        var menu = id;

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
                    flash('success', result.message);
                } else {
                    flash('warning', result.message);
                }


            }, error: function (xhr, ajaxOptions, thrownError) {
                flash('warning', 'Execute Failed');
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {
                //oTable.ajax.reload();
            }
        });
    }

    function execute(code, param){
        $('#search').prop("disabled",false);

            //var taskCode = $(this).attr('data-code');
            var content ='{{trans('form.batch_task_execute',['task'=>'$task'])}} </br></br><div class="form-group form-inline"><label class="col-md-3 control-label">Parameter</label><div class="col-md-4"> <input type="text" id="taskParam" name="taskParam" class="form-control" value="'+param+'"></div></div>';

            $.confirm({
                title: 'Execute Task',
                content: content.replace('$task',code),
                buttons: {

                    cancel: {
                        text: '{{trans('form.cancel')}}',
                        btnClass: 'btn-default',
                        action: function(){
                            //$('#submit_view').prop('disabled',false);
                        }
                    },
                    confirm: {
                        text: '{{trans('form.confirm')}}',
                        btnClass: 'btn-primary',
                        action: function(){
                            var param = $('#taskParam').val();
                            executeTask(code, param);
                        }
                    },

                }
            });

    }


</script>