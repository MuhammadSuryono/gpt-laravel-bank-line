@include('_partials.header_content',['breadcrumb'=>[str_replace('-',' ',$menu),'Search']])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div class="box">
                <div id="spinner" style="display:none"></div>
                <div class="box-header">
                    <h3 class="box-title">Transaction Fee Filter</h3>
                </div>
                <form class="form-horizontal">

                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">User ID</label>

                                <div class="col-md-6">
                                    <input type="text" id="userId" name="userId" class="form-control" autocomplete="off" value="" maxlength="40">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Customer Name</label>

                                <div class="col-md-6">
                                    <input type="text" id="name" name="name" class="form-control" autocomplete="off" value="" maxlength="100">

                                </div>
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
                        <h3 class="box-title">Customer Listing</h3>
                    </div>
                    <div class="box-body list-title">
                        
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th align="center"><strong>Customer ID</strong></th>
                                        <th align="center"><strong>Customer Name</strong></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
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


    $(document).ready(function () {
        var id = '{{ $service }}';

        var url_action = 'searchCustomer';
        var action = 'SEARCH';
        var result_key = 'result';
         var custom_order = {"cifId": "ASC"};

        $('#list').hide();
        $('.list-title').hide();

        $('#search').on('click', function () {

            $(this).prop("disabled",true);
            $('#list').show();
            $('.list-title').show();
            var value = {
                "userId": $('#userId').val(),
                "name": $('#name').val()
            };

            $('#list').DataTable({
                "destroy": true,
                "initComplete": function(settings, json) {
                    $('#search').prop("disabled",false);

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
                        data: {customerId:"customerId",userId:"userId"},
                        render: function ( data, type, full, meta ) {
                            return '<a href="javascript:void(0)" data-customerid="'+data.customerId+'" data-userid ="'+data.userId+'" >'+data.customerId+'</a>';
                        },
                        orderable: true
                    },
                    {
                        targets: 1,
                        data: "name",
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
                        $('#list').hide();
                        $('.list-title').hide();
                        $('#search').prop("disabled",false);
                    }
                }
            });
        });


        $('#list tbody').on('click', 'a', function (e) {
            if(e.handled !== true) // This will prevent event triggering more then once
            {
                e.handled = true;
            }
            var customerId = $(this).data('customerid');
            var userId = $(this).data('userid');
            var name = $(this).parent().next().html();

            if (customerId !== undefined) {
                var res = app.setView(id,'detail');
                if(res=='done'){
                    $('#customerId').val(customerId);
                    $('#userId').text(userId);
                    $('#name').val(name);
                    $('#name_1').text(name);
                    getMatrix();
                }
                
            }
        });

        $('input[type="text"]').not('.numeric').alphanum({
            allowSpace: true,
            allow : ',._!@'
        });

    });




</script>