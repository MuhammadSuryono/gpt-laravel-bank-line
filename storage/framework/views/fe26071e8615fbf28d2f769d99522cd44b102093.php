<?php echo $__env->make('_partials.header_content',['breadcrumb'=>['Interest Rate','Search']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div class="box">
                <div id="spinner" style="display:none"></div>
                <div class="box-header">
                    <h3 class="box-title">Rate Filter</h3>
                </div>
                <form class="form-horizontal">

                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Product Code</label>

                                <div class="col-md-6">
                                    <input type="text" id="productCode" name="productCode" class="form-control" autocomplete="off" value="" maxlength="40">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Product Name</label>

                                <div class="col-md-6">
                                    <input type="text" id="productName" name="productName" class="form-control" autocomplete="off" value="" maxlength="100">

                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="box-footer">
                   
                    <div class="float-left">
                        <button type="button" id="search" name="search" class="btn btn-primary"><?php echo app('translator')->get('form.search'); ?></button>
                    </div>
                    <div class="float-right">
                        <button type="button" id="add" name="add" class="btn btn-info"><?php echo app('translator')->get('form.add'); ?></button>
                    </div>

                </div>
                </form>
                    <div class="box-header list-title">
                        <h3 class="box-title">Rate Listing</h3>
                    </div>
                    <div class="box-body list-title">
                        
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th align="center"><strong>Product Code</strong></th>
                                        <th align="center"><strong>Product Name</strong></th>
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
        var id = '<?php echo e($service); ?>';

        var url_action = 'search';
        var action = 'SEARCH';
        var result_key = 'result';
        var custom_order = {"productCode": "ASC"};

        $('#list').hide();
        $('.list-title').hide();

        $('#search').on('click', function () {

            $(this).prop("disabled",true);
            $('#list').show();
            $('.list-title').show();
            var value = {
                productCode: $('#productCode').val(),
                productName: $('#productName').val(),
                currentPage: "1",
                pageSize: "50",
                // orderBy: {"id": "ASC"}
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
                        data: {
                            productCode:"productCode",
                            productName:"productName",
                            id:"id"
                        },
                        render: function ( data, type, full, meta ) {
                            return '<a href="javascript:void(0)" data-id="'+data.id+'" data-product-name="'+data.productName+'" data-product-code="'+data.productCode+'">'+data.productCode+'</a>';
                        },
                        orderable: true
                    },
                    {
                        targets: 1,
                        data: "productName",
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
                        d._token = '<?php echo e(csrf_token()); ?>';
                    },
                    error:function (jqXHR, textStatus, errorThrown) {

                        var msg = '<?php echo e(trans('form.conn_error')); ?>';
                        flash('warning', msg);
                        $('#list').hide();
                        $('.list-title').hide();
                        $('#search').prop("disabled",false);
                    }
                }
            });
        });

        $('#add').on('click', function () {
            var res = app.setView(id,'add');
            if(res=='done'){
                $('#type').val('add');
            }
        });

        $('#list tbody').on('click', 'a', function (e) {
            if(e.handled !== true) // This will prevent event triggering more then once
            {
                e.handled = true;
            }
            var productCode = $(this).data('productCode');
            var productName = $(this).data('productName');

            var intId = $(this).data('id');

            if (productCode !== undefined) {
                var res = app.setView(id,'detail');
                if(res=='done'){
                    $('#prodCode').val(productCode);
                    $('#prodName').val(productName);
                    $('#intId').val(intId);
                    getDetail();
                }
            }
        });
        
        $('input[type="text"]').not('.numeric').alphanum({
            allowSpace: true,
            allow : ',._!@'
        });

    });




</script><?php /**PATH D:\Downloads\Upgrade Laravel Framework\bank-line\resources\views/bank-line/MNU_GPCASH_MT_INTEREST_RATE/landing.blade.php ENDPATH**/ ?>