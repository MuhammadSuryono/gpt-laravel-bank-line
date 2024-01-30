<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Ongoing Task
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#" class="back"><i class="fa fa-dashboard"></i> Ongoing Task</a></li>
        <li class="active">Authentication Device</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <input type="hidden" id="referenceNo" value=""/>
            <input type="hidden" id="taskId" value=""/>
            <div class="box">

                <div class="box-header detail">
                    <span id="detail" class="detail" style="color:darkred;"><small><i>Detail</i></small></span>
                </div>
                <div class="box-header">
                    <h3 class="box-title">Corporate Detail</h3><br>
                </div>
                <form class="form-horizontal">
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

                        </div>
                    </div>
                </form>
                <div class="box-header">
                    <h3 class="box-title table-hidden">Device Listing</h3>
                </div>
                <div class="container-fluid">
                    <div class="box-body">
                        <div class="row table-hidden">
                            <div class="form-group">
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th align="left"><strong>Serial Number</strong></th>
                                        <th align="left"><strong>Assigned To</strong></th>
                                        <th align="left"><strong>Assigned By</strong></th>
                                        <th align="left"><strong>Assigned Date</strong></th>
                                        <th align="left"><strong>Status</strong></th>
                                        <th align="left"><strong>Retry</strong></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="form-group">
                                <div class="state_view">
                                    <div class="col-md-12 state_view text-center">
                                        <button type="button" id="approve" name="approve" class="btn btn-success">@lang('form.approve')</button>
                                        <button type="button" id="reject" name="reject" class="btn btn-danger">@lang('form.reject')</button>
                                        <button type="button" id="back" name="back" class="btn btn-default back">@lang('form.back')</button>
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
    var oTable;
    var currencyOption;
    var id = 'MNU_GPCASH_AUTH_DEVICE';
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
                    width: "10%"
                },
                {
                    targets: 1,
                    sortable: true,
                    width: "25%"
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
                },
                {
                    targets: 5,
                    sortable: true,
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
                            $('#approve').prop('disabled',false);
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
                            $('#reject').prop('disabled',false);
                        }
                    }

                }
            });
        });

        $('.back').on('click', function () {
            $(this).prop('disabled',true);
            $.ajax({
                url: 'getView/MNU_GPCASH_PENDING_TASK',
                method: 'post',
                success: function (data) {
                    $('.back').prop('disabled',true);
                    $(window).scrollTop(0);
                    $('#content-ajax').html(data);


                }, error: function (xhr, ajaxOptions, thrownError) {
                    var msg = '{{trans('form.conn_error')}}';
                    flash('warning', msg);
                    $('.back').prop('disabled',true);
                    console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                }
            });
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
                if(result.referenceNo == undefined){
                    return;
                }
                var detail = result.details.tokenList;
                $('#code_1').text(result.details.corporateId+' - '+result.details.corporateName);

                oTable.clear();
                if(detail[0].registeredBy==undefined){
                    $.each(detail, function (idx, obj){
                        oTable.row.add([
                            obj,'','','','',''
                        ]).draw(true);
                    });
                }else{
                $.each(detail, function (idx, obj){
                        oTable.row.add([
                            obj.tokenNo,
                            obj.userId,
                            obj.registeredBy,
                            obj.registeredDate,
                            obj.status,
                            obj.retry
                        ]).draw(true);
                });
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
                $('.detail').show();
                $('#detail').text('ReferenceNo: ' + result.referenceNo);
                $('#approve').hide();
                $('#reject').hide();
                $('#back').html('{{trans('form.done')}}');
                flash('success','{{trans('form.pending_success')}}');
                $('#approve').prop('disabled',false);
                $('#reject').prop('disabled',false);

            }, error: function (xhr, ajaxOptions, thrownError) {
                $(window).scrollTop(0);
                $('#approve').prop('disabled',false);
                $('#reject').prop('disabled',false);
                flash('warning','{{trans('form.pending_error')}}');
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }
        });
    }

</script>