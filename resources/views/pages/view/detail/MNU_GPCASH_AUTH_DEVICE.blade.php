@include('_partials.header_content',['breadcrumb'=>['authentication device','detail']])

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <input type="hidden" id="code" value=""/>
            <input type="hidden" id="name" value=""/>
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
                                        <th></th>
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
                                               <button type="button" id="delete" name="delete" class="btn btn-default">@lang('form.delete')</button>
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
    var id = 'MNU_GPCASH_AUTH_DEVICE';
    $(document).ready(function () {
        $('.table-hidden').hide();
        $('.state_delete').hide();

        oTable = $('#list').DataTable({
            //"paging" : false,
            "ordering" : false,
            "info": false,
            "destroy": true,
            "select": {
                style: 'multi',
                selector: 'input.dt-checkboxes'
            },
            "searching": false,
            "autoWidth":false,
            "lengthMenu": [[10, 25, 50], [10, 25, 50]],
            "columnDefs": [
                {
                    sortable: false,
                    width: "5%",
                    targets: 0,
                    checkboxes: {
                        selectRow: false,
                        selectAllPages: false
                    }
                },
                {
                    targets: 1,
                    sortable: true,
                    width: "10%"
                },
                {
                    targets: 2,
                    sortable: true,
                    width: "25%"
                },
                {
                    targets: 3,
                    sortable: true,
                    width: "20%"
                },
                {
                    targets: 4,
                    sortable: true,
                    width: "20%"
                },
                {
                    targets: 5,
                    sortable: false,
                    width: "10%"
                },
                {
                    targets: 6,
                    sortable: true,
                    width: "10%"
                }
            ],
            "dom": "lfBrtip",
            "buttons": [{
                text: 'Add Device',
                action: function ( e, dt, node, config ) {
                    $(this).prop("disabled",true);
                    $.ajax({
                        url: 'getEditor/' + id,
                        method: 'post',
                        success: function (data) {
                            $(this).prop("disabled",false);
                            var code = $('#code').val();
                            var name = $('#name').val();
                            var corporate = $('#code_1').text();
                            $(window).scrollTop(0);
                            $('#content-ajax').html(data);
                            $('#type').val('add');
                            $('#code').val(code);
                            $('#name').val(name);
                            $('#code_1').text(corporate);

                        }, error: function (xhr, ajaxOptions, thrownError) {
                            $(this).prop("disabled",false);
                            console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                        }
                    });
                }
            }]
        });


        $('#edit').on('click', function () {
            $(this).prop('disabled',true);
            var submit_data = getTableData();
            $.ajax({
                url: 'getEditor/' + id,
                method: 'post',
                success: function (data) {
                    $('#edit').prop('disabled',false);
                    var code = $('#code').val();
                    var corporate = $('#code_1').text();
                    var cifid = $('#cifid').text();
                    var name = $('#name').val();
                    $(window).scrollTop(0);
                    $('#content-ajax').html(data);
                    $('#code').val(code);
                    $('#code_1').text(corporate);
                    $('#cifid').text(cifid);
                    $('#type').val('edit');
                    $('#name').val(name);
                    getData(submit_data);

                }, error: function (xhr, ajaxOptions, thrownError) {
                    $('#edit').prop('disabled',false);
                    console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                }
            });
        });

        $('#delete').on('click', function () {

            $(this).prop('disabled',true);
            if(countChecked()==0){
                $.alert({
                    title: 'Attention!',
                    content: 'No Row is Selected.'
                });
                $(this).prop('disabled',false);
                return;
            }
            $.confirm({
                title: '{{trans('form.delete')}}',
                content: '{{trans('form.confirm_delete')}}',
                buttons: {
                    confirm: {
                        text: '{{trans('form.delete')}}',
                        btnClass: 'btn-danger',
                        action: function(){
                            submit_delete();
                        }
                    },
                    cancel: {
                        text: '{{trans('form.cancel')}}',
                        btnClass: 'btn-default',
                        action: function(){
                            $('#delete').prop('disabled',false);
                        }
                    }
                }
            });
        });

        function submit_delete () {
            var submit_data = getTableData();

            var value = {
                "corporateId": $('#code').val(),
                "corporateName": $('#name').val(),
                "tokenList": submit_data
            };

            $.ajax({
                url: 'delete',
                method: 'post',
                data: {"_token": "{{ csrf_token() }}", menu: id, value: value,url_action:'submitDelete'},
                success: function (data) {
                    $('#delete').prop('disabled',false);
                    var result = JSON.parse(data);
                    if (result.hasOwnProperty("referenceNo")) {
                        flash('success', result.message);
                        $('#submit_view').hide();
                        $('#detail').show();
                        $('#detail').text('ReferenceNo: ' + result.referenceNo);
                        $('#edit').hide();
                        $('#delete').hide();
                        $('#back').html('{{trans('form.done')}}');
                    } else {
                        $('#delete').prop('disabled',false);
                        flash('warning', 'Form Submit Failed');
                    }

                }, error: function (xhr, ajaxOptions, thrownError) {
                    $('#delete').prop('disabled',false);
                    flash('warning', 'Form Submit Failed');
                   console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                }
            });
        }

        $('#back_delete').on('click', function () {
            $('.state_delete').hide();
            $('.state_view').show();
        });

        $('.back').on('click', function () {
            $(this).prop('disabled',true);
            $.ajax({
                url: 'getView/'+id,
                method: 'post',
                success: function (data) {
                    $('.back').prop('disabled',true);
                    $(window).scrollTop(0);
                    $('#content-ajax').html(data);


                }, error: function (xhr, ajaxOptions, thrownError) {
                    $('.back').prop('disabled',true);
                    console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                }
            });
        });
        $('div.dt-buttons').css('float','right');
        $('a.dt-button').addClass('btn btn-primary');


    });

    function accountNoDetail(accountNo){
        getAccountDetail(accountNo);
    }

    function getData(code,name){
        var value = {
            corporateId: code,
            currentPage: "1",
            pageSize: "20",
            orderBy: {"tokenNo": "ASC"}
        };
        var url_action = 'search';
        var action = 'DETAIL';
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
                var detail = result.result;
                $('#code_1').text(code+' - '+name);
                $('#name').val(name);
                oTable.clear();

                $.each(detail, function (idx, obj){
                    oTable.row.add([
                        '<input id="check" class="dt-checkboxes state_edit" value="" type="checkbox">',
                        obj.tokenNo+'<input type=hidden id="tokenNo" value="'+obj.tokenNo+'">',
                        obj.userId+' - '+obj.userName+'<input type=hidden id="userId" value="'+obj.userId+'">'+'<input type=hidden id="userName" value="'+obj.userName+'">',
                        obj.registeredBy+'<input type=hidden id="registeredBy" value="'+obj.registeredBy+'">',
                        obj.registeredDate+'<input type=hidden id="registeredDate" value="'+obj.registeredDate+'">',
                        obj.status+'<input type=hidden id="status" value="'+obj.status+'">',
                        obj.retry+'<input type=hidden id="retry" value="'+obj.retry+'">'
                    ]).draw(true);
                });


            }, error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            },
            complete: function(data) {
                $('.table-hidden').show();

            }
        });
    }


    function getTableData() {
        var data = [];

        $("#list").find("tbody tr").each(function () {
            var check = ($('td:eq(0)', $(this)).children().is(':checked') ? 1 : 0);
            if (check == 0) {
                $('td:eq(0)', $(this)).parent().hide();
            }
            var tokenNo = $('td:eq(1)', $(this)).find('#tokenNo').val();
            var userId = $('td:eq(2)', $(this)).find('#userId').val();
            var registeredBy = $('td:eq(3)', $(this)).find('#registeredBy').val();
            var registeredDate = $('td:eq(4)', $(this)).find('#registeredDate').val();
            var status = $('td:eq(5)', $(this)).find('#status').val();
            var retry = $('td:eq(6)', $(this)).find('#retry').val();

            var obj = {
                tokenNo: tokenNo,
                userId: userId,
                registeredBy:registeredBy,
                registeredDate:registeredDate,
                status:status,
                retry:retry
            };
            if (check == 1) {
                data.push(obj);
            }
        });
        return data;
    }

    function countChecked(){
        var checked = 0;
        $("#list").find("tbody tr").each(function () {
            ($('td:eq(0)', $(this)).children().is(':checked') ? checked++ :'');
        });

        return checked;
    }


</script>