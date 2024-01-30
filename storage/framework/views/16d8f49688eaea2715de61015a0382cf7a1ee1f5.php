<?php echo $__env->make('_partials.header_content',['breadcrumb'=>[str_replace('-',' ',$menu),'detail']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <input type="hidden" id="code" value=""/>
            <div class="box">


                <div class="box-header">
                    <h3 class="box-title">Domestic Bank Detail</h3><br>
                </div>
                <form class="form-horizontal">
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Bank Code</label>
                                <div class="col-md-6">
                                    <label id="code_1">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Bank Name</label>
                                <div class="col-md-6">
                                    <label id="name">-</label>
                                </div>
                            </div>
                        </div>
						<div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Address</label>
                                <div class="col-md-6">
                                    <label id="address1">-</label>
                                </div>
                            </div>
                        </div>
						<div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label"></label>
                                <div class="col-md-6">
                                    <label id="address2">-</label>
                                </div>
                            </div>
                        </div>
						<div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label"></label>
                                <div class="col-md-6">
                                    <label id="address3">-</label>
                                </div>
                            </div>
                        </div>
						<div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Branch Code</label>
                                <div class="col-md-6">
                                    <label id="organizationUnitCode">-</label>
                                </div>
                            </div>
                        </div>
						<div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Branch Name</label>
                                <div class="col-md-6">
                                    <label id="organizationUnitName">-</label>
                                </div>
                            </div>
                        </div>
						<div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Member Code</label>
                                <div class="col-md-6">
                                    <label id="memberCode">-</label>
                                </div>
                            </div>
                        </div>
						<div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Online Bank Code</label>
                                <div class="col-md-6">
                                    <label id="interBankCode">-</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">City Listing</h3><br>
                    </div>
                    <div class="box-body list-title">
                        <div class="container-fluid">
                            <div class="row">
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th align="center"><strong>City</strong></th>
                                        <th align="center"><strong></strong></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
                        <div class="box-footer">
                            <div class="float-left">
                                <button type="button" id="back" name="back" class="btn btn-default back"><?php echo app('translator')->get('form.back'); ?></button>
                            </div>
                            <div class="float-right">
                                <button type="button" id="delete" name="delete" class="btn btn-danger"><?php echo app('translator')->get('form.delete'); ?></button>
                                <button type="button" id="edit" name="edit" class="btn btn-primary"><?php echo app('translator')->get('form.edit_domestic_bank'); ?></button>
                                <button type="button" id="edit_city" name="edit_city" class="btn btn-primary"><?php echo app('translator')->get('form.edit_city'); ?></button>
                                <button type="button" id="next_user" name="next_user" class="btn btn-info" style="display:none"><?php echo app('translator')->get('form.next_user'); ?></button>
                                <button type="button" id="save_screen" name="save_screen" class="btn btn-default" style="display:none" onclick="save_pdf();"><?php echo app('translator')->get('form.save_pdf'); ?></button>
                            </div>
                        </div>
                        <?php echo $__env->make('_partials.next_user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

            </div>
        </div>
    </div>

</section>

<script>
    var oTable;
    var currencyOption;
    var id = 'MNU_GPCASH_MT_DOM_BANK';
    var noRef;
    $(document).ready(function () {
        $('.state_delete').hide();

        $('#edit').on('click', function () {
            var code = $('#code_1').text();
            var res = app.setView(id,'add');
            if(res=='done'){
                $('#type').val('edit');
                $('#breadcrumb-action').html('edit');
                $('#code_edit').val(code);
                getDomesticBankEdit(code);
            }

        });
        $('#edit_city').on('click', function () {
            var code = $('#code_1').text();
            var res = app.setView(id,'detail-city');
            if(res=='done'){
                $('#code').val(code);
                getCityDropList()
                getMatrix(code);
                getDataBankCity(code);
            }

        });

        $('#delete').on('click', function () {
           // $('.state_view').hide();
           // $('.state_delete').show();
            $(this).prop('disabled',true);
            $.confirm({
                title: '<?php echo e(trans('form.delete')); ?>',
                content: '<?php echo e(trans('form.confirm_delete')); ?>',
                buttons: {

                    cancel: {
                        text: '<?php echo e(trans('form.cancel')); ?>',
                        btnClass: 'btn-default',
                        action: function(){
                            $('#delete').prop('disabled',false);
                        }
                    },
                    confirm: {
                        text: '<?php echo e(trans('form.delete')); ?>',
                        btnClass: 'btn-primary',
                        action: function(){
                            submit_delete();
                        }
                    },

                }
            });
        });

        function submit_delete () {

            var value = {
                "code": $('#code').val(),
				"name": $('#name').text(),
				"address1": $('#address1').text(),
				"address2": $('#address2').text(),
				"address3": $('#address3').text(),
				"organizationUnitCode": $('#organizationUnitCode').text(),
				"organizationUnitName": $('#organizationUnitName').text(),
				"memberCode": $('#memberCode').text(),
				"interBankCode": $('#interBankCode').text()
            };
            $.ajax({
				url: 'delete',
                method: 'post',
                data: {"_token": "<?php echo e(csrf_token()); ?>", menu: id, value: value,url_action:'submitDelete'},
                success: function (data) {
                    $('#delete').prop('disabled',false);
                    var result = JSON.parse(data);
					noRef = result.referenceNo;
                    if (result.status=="200") {
                        flash('success', result.message+'<br>'+'ReferenceNo: '+ result.referenceNo+'<br>'+result.dateTimeInfo);
                        $('#submit_view').hide();
                        $('#save_screen').show();
                        $('#next_user').show();
                        $('#delete').hide();
                        $('#edit').hide();
                        $('#back').html('<?php echo e(trans('form.done')); ?>');
                    } else {
                        $('#delete').prop('disabled',false);
                        flash('warning', result.message);
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
            var res = app.setView(id,'landing');
        });

    });

    function getDataBankCity(bankCode) {
        var value = {
            bankCode: bankCode,
            currentPage: "1",
            pageSize: "20",
            orderBy: {"code": "ASC"}
        };

        $('#list').DataTable({
            "destroy": true,
            "initComplete": function(settings, json) {
                $('#search').prop("disabled",false);
            },
            "select": false,
            "searching": false,
            "lengthMenu": [[50, 25], [50, 25]],
            "processing": true,
            "serverSide": true,
            "autoWidth": false,
            "ScrollX": '100%',
            "columnDefs": [
                {
                    targets: 0,
                    data: "cityName",
                    width: "80%",
                    orderable: true
                },
                {
                    targets: 1,
                    sortable: false,
                    width: "20%",
                    className: "dt-center state_edit",
                    render: function ( data, type, full, meta ) {
                        return '<button data-cif="" class="btn btn-danger" onClick="removeRow(this);" style="width:100px;">Remove</button>';
                    }
                }
            ],
            "ajax": {
                url: "fetchDataTable",
                type:'POST',
                data: function ( d ) {
                    d.value = value;
                    d.menu = id;
                    d.url_action = "searchCity";
                    d.action = "SEARCH";
                    d.result_key = "result";
                    d.custom_order = '';
                    d._token = '<?php echo e(csrf_token()); ?>';
                },
                error:function (jqXHR, textStatus, errorThrown) {

                    var msg = '<?php echo e(trans('form.conn_error')); ?>';
                    flash('warning', msg);
                    $('#search').prop("disabled",false);
                }
            }
        });
    }

    function getMatrix(){
        var code_id= $('#code').val();
        var url_action= 'search';
        var value ={
            code:code_id,
            name:'',
            currentPage: "1",
            pageSize: "20",
            orderBy: {"code": "ASC"}
        };
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data:{value:value,menu:id,action:'DETAIL',url_action:url_action},
            success: function (data) {

                var result = JSON.parse(data);
                if (result.status=="200") {
                    var index = result.result.map(function(o) { return o.bankCode; }).indexOf(code_id.toString());
                    var detail = result.result[index];

                    $('#code_1').text(detail.bankCode);
                    $('#name').text(detail.name);
                        $('#address1').text(detail.address1);
						$('#address2').text(detail.address2);
						$('#address3').text(detail.address3);
						$('#organizationUnitCode').text(detail.organizationUnitCode);
						$('#organizationUnitName').text(detail.organizationUnitName);
						$('#memberCode').text(detail.memberCode);
						$('#interBankCode').text(detail.onlineBankCode);
                } else {
                    flash('warning', result.message);
                }


            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '<?php echo e(trans('form.conn_error')); ?>';
                flash('warning', msg);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            },

        });
    }



</script>
<?php /**PATH D:\Downloads\Upgrade Laravel Framework\bank-line\resources\views/bank-line/MNU_GPCASH_MT_DOM_BANK/detail.blade.php ENDPATH**/ ?>