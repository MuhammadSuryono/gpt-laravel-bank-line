<?php echo $__env->make('_partials.header_content',['breadcrumb'=>[str_replace('-',' ',$menu),'Search']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Corporate Filter</h3>
                </div>
                <form class="form-horizontal">

                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Corporate ID</label>

                                <div class="col-md-6">
                                    <input type="text" id="corporateId" name="corporateId" class="form-control" autocomplete="off" value="" maxlength="40">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Corporate Name</label>

                                <div class="col-md-6">
                                    <input type="text" id="name" name="name" class="form-control" autocomplete="off" value="" maxlength="100">

                                </div>
                            </div>
                        </div>
                       </div>
                </div>
                
                <div class="box-footer">
                    <button type="button" id="search" name="search" class="btn  btn-primary float-left"><?php echo app('translator')->get('form.search'); ?></button>
                    <button type="button" id="add" name="add" class="btn  btn-info float-right"><?php echo app('translator')->get('form.add'); ?></button>

                </div>

                </form>
                    <div class="box-header list-title">
                        <h3 class="box-title">Corporate Listing</h3>
                    </div>
                    <div class="box-body list-title">
                        <div class="container-fluid">
                           <div class="row">
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th align="center"><strong>Corporate Id</strong></th>
                                        <th align="center"><strong>Corporate Name</strong></th>
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
        </div>
    </div>

</section>

<script>


    $(document).ready(function () {
        var id = '<?php echo e($service); ?>';

        var url_action = 'search';
        var action = 'SEARCH';
        var result_key = 'result';
        var custom_order = {"id": "ASC"};

        $('#list').hide();
        $('.list-title').hide();

        $('#add').on('click', function () {
            app.setView(id,'add');
            $('#type').val('add');
            getData('','');
        });

        $('#search').on('click', function () {

            $(this).prop("disabled",true);
            $('#list').show();
            $('.list-title').show();
            var corporateId = $('#corporateId').val();
            var name = $('#name').val();

            var value = {
                "corporateId": '%' + corporateId + '%',
                "name": name
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
                        data: {corporateId:"corporateId",cifId:"cifId"},
                        render: function ( data, type, full, meta ) {
                            return '<a href="javascript:void(0)" data-cifid="'+data.cifId+'" data-code="'+data.corporateId+'">'+data.corporateId+'</a>';
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


        $('#list tbody').on('click', 'a', function (e) {
            if(e.handled !== true) // This will prevent event triggering more then once
            {
                e.handled = true;
            }
            var code = $(this).data('code');
            var cifid = $(this).data('cifid');
            var name = $(this).parent().next().text();
            //console.log("name",name);
            preloaderVisible(true);
            if (code !== undefined) {
                var res = app.setView(id,'detail');
                if(res=='done'){
                    $('#code').val(code);
                    getData(code,name);
                }
                
            }
        });
        $('div.dt-buttons').css('float','right');
        $('a.dt-button').addClass('btn btn-primary');
        $('input[type=text]').not('.numeric').alphanum({
            allowSpace: true,
            allow : ',._!@'
        });
    });




</script><?php /**PATH C:\xampp8\htdocs\bank-line\resources\views/bank-line/MNU_GPCASH_CORP/landing.blade.php ENDPATH**/ ?>