@include('_partials.header_content',['breadcrumb'=>[str_replace('-',' ',$menu)]])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">User Filter</h3>
                </div>
                <form class="form-horizontal">

                <div class="box-body">
                    
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">User Id</label>

                                <div class="col-md-6">
                                    <input type="text" id="code" name="code" class="form-control" autocomplete="off" value="" maxlength="40">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Active Session</label>
                                <div class="col-md-6">
                                    <label id="stillLoginFlag" name="stillLoginFlag">Y</label>
                                </div>
                            </div>
                        </div>

                </div>

                <div class="box-footer">
                    
                        <div class="float-left">
                            <button type="button" id="search" name="search" class="btn btn-primary">@lang('form.search')</button>
                        </div>
                    
                </div>
                </form>
                    <div class="box-header list-title">
                        <h3 class="box-title">User Listing</h3>
                    </div>
                    <div class="box-body list-title">
                        
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th align="center"><strong>User Id</strong></th>
                                        <th align="center"><strong>User Name</strong></th>
                                        <th align="center"><strong>Session</strong></th>
                                        <th align="center"></th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
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

</section>

<script>

    var unitOption;
    var oTable;
    var id = '{{ $service }}';
    $(document).ready(function () {

        var url_action = 'search';
        var action = 'SEARCH';
        var result_key = 'result';
        var custom_order = '';

        $('#list').hide();
        $('.list-title').hide();


        $('#search').on('click', function () {

            $(this).prop("disabled",true);
            $('#list').show();
            $('.list-title').show();
            var value = {
                code: $('#code').val(),
                stillLoginFlag : $('#stillLoginFlag').text(),
                currentPage: "1",
                pageSize: "20"
            };

         oTable = $('#list').DataTable({
                 "destroy": true,
                 "dom": "lfBrtip",
                 "buttons": [{
                     text: 'Release All Users',
                     action: function ( e, dt, node, config ) {
                         $.confirm({
                             title: 'Release Session',
                             content: 'Release all user session? ',
                             buttons: {
                                 confirm: {
                                     text: '{{trans('form.confirm')}}',
                                     btnClass: 'btn-danger',
                                     action: function(){
                                         submitReleaseAll();
                                     }
                                 },
                                 cancel: {
                                     text: '{{trans('form.cancel')}}',
                                     btnClass: 'btn-default',
                                     action: function(){
                                         //$('#submit_view').prop('disabled',false);
                                     }
                                 }

                             }
                         });

                     }
                 }],
                "drawCallback": function( settings ) {
                    $('#search').prop("disabled",false);
                    $('.release').on('click', function () {
                       var user = $(this).attr('data-code');
                       var content ='{{trans('form.user_msg_release',['user'=>'$user'])}}';

                        $.confirm({
                            title: 'Release Session',
                            content: content.replace('$user',user),
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
                                        submitRelease(user);
                                    }
                                },

                            }
                        });
                    });

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
                        data: "code",
                        width: "30%",
                        orderable: true
                    },
                    {
                        targets: 1,
                        data: "name",
                        width: "30%",
                        orderable: true
                    },
                    {
                        targets: 2,
                        data: "stillLoginFlag",
                        width: "25%",
                        render: function ( data, type, full, meta ) {
                            return (data=="Y"?'Active':'Inactive');
                        },
                        orderable: true
                    },
                    {
                        targets: 3,
                        data: "id",
                        width: "15%",
                        render: function ( data, type, full, meta ) {

                            return '<button data-code="'+data+'" class="btn btn-default release" style="width:150px;">Release Session</button>';
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
            $('div.dt-buttons').css('float','right');
            $('a.dt-button').addClass('btn btn-primary');
        });

        $('input[type="text"]').not('.numeric').alphanum({
            allowSpace: true,
            allow : ',._!@'
        });

    });


    function submitRelease(code) {
        var user_list = [];
        user_list[0] = code;
        var value = {
            userList: user_list
        };
        var url_action = 'updateStillLoginFlag';
        var action = 'UPDATE';
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
                flash('warning', 'Submit Failed');
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {
                oTable.ajax.reload();
            }
        });
    }

    function submitReleaseAll() {
        var value = {};
        var url_action = 'updateStillLoginFlagALL';
        var action = 'UPDATE';
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
                flash('warning', 'Submit Failed');
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {
                oTable.ajax.reload();
            }
        });
    }

</script>