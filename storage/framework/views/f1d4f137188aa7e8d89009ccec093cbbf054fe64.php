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
                                <label class="col-md-2 control-label">SKN Code</label>
                                <div class="col-md-6">
                                    <label id="organizationUnitCode">-</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">City</h3><br>
                    </div>

                    <form id="form-area" class="form-horizontal form-area">
                        <div class="box-body list-title">
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">City</label>
                                    <div class="col-md-6">
                                        <div class="city_setup state_edit">
                                            <select class="form-control"></select>
                                        </div>
                                        <label id="city_setup_view" class="state_view"></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label"><strong></strong></label>
                                    <div class="col-md-5">
                                        <button type="button" id="add_list" class="btn btn-default">Add to List</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
                </form>
                <div class="box-footer">
                    <div class="float-left">
                        <button type="button" id="back" name="back" class="btn btn-default back"><?php echo app('translator')->get('form.back'); ?></button>
                    </div>
                    <div class="float-right">
                        <button type="button" id="save_screen" name="save_screen" class="btn btn-primary" ><?php echo app('translator')->get('form.confirm'); ?></button>
                    </div>
                </div>
                <?php echo $__env->make('_partials.next_user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>

</section>

<script>
    var oTable;
    var currencyOption;
    var id = 'MNU_GPCASH_MT_DOM_BANK';
    var noRef;
    var url_action = 'search';
    var action = 'SEARCH';
    var result_key = 'result';
    var custom_order = '';
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


        $('#add_list').on('click', function () {
            // $(this).prop('disabled',true);

            $('#form-area').validator('validate');
            // setTimeout(function(){
            if($('#form-area').validator('validate').has('.has-error').length==0){
                var cityData = $('.state_edit').find(":selected").val();
                var cityName = $('.state_edit').find(":selected").text();
                validateAddList(cityData, cityName);
            }
            // });

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

    });

    function getDataBankCity(bankCode) {
        var value = {
            bankCode: bankCode,
            currentPage: "1",
            pageSize: "20",
            orderBy: {"bankCode": "ASC"}
        };

        oTable = $('#list').DataTable({
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
                    d.action = action;
                    d.result_key = result_key;
                    d.custom_order = custom_order;
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

    function getCityDropList() {

        var url_action = 'searchCityForDroplist';
        var action = 'SEARCH';
        var menu = 'MNU_GPCASH_MT_BRANCH';
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            type: 'json',
            data: {
                menu : menu,
                url_action : url_action,
                action : action,
                _token : '<?php echo e(csrf_token()); ?>'
            },
            success: function (data) {
                var result = JSON.parse(data);
                if (result.status=="200") {
                    cityOption = '<select id="city_list" class="form-control state_edit" required>';
                    cityOption += '<option value="" selected="selected">--Select City--</option>';
                    $.each(result.result, function (idx, obj) {
                        cityOption += '<option value="' + obj.code + '">' + obj.name + '</option>';

                    });
                    cityOption += '</select>';
                    cityOption += '<div class="help-block with-errors"></div>';
                } else {
                    flash('warning', result.message);
                }



            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '<?php echo e(trans('form.conn_error')); ?>';
                flash('warning', msg);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {
                $('.city_setup').html(cityOption);
            }
        });
    }

    function validateAddList(cityCode, cityName){

        var value = {
            cityCode: cityCode,
            cityName: cityName
        };

        $.ajax({
            url: 'getAPIData',
            method: 'post',
            // type: 'json',
            data: {
                value : value,
                menu : id,
                url_action : 'validateDetail',
                action : 'VALIDATE',
                _token : '<?php echo e(csrf_token()); ?>'
            },
            success: function (data) {
                var result = JSON.parse(data);

                console.log(result);
                if (result.status=="200") {

                    if(checkDuplicateList(cityCode)) {

                        var intRate = $('#rate').val();

                        oTable.row.add([
                            result.cityName + '<input type=hidden id="cityCode" value="' + result.cityCode + '">',
                            ''

                        ]).draw(true);
                    } else {
                        flash('warning', 'City is already added in list');
                    }

                } else {
                    flash('warning', result.message);
                }

            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '<?php echo e(trans('form.conn_error')); ?>';
                flash('warning', msg);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {
                // $('#add_list').prop('disabled',false);

            }
        });

    }

    function checkDuplicateList(cityCode){
        var duplicate = 0;

        $("#list").find("tbody tr").each(function (idx, obj) {

            var code = $('td:eq(0)', $(this)).find('#cityCode').val();

            if(cityCode==code){
                duplicate = 1;
            }


            /*$('td').each(function(){
                var balance = $(this).find('#balanceHidden').val();

                console.log("balanceExist: " + balance);

                if(bal==balance){
                    if(period == code){
                        duplicate = 1;
                    }
                }
                // console.log("acctNo"+ idx, acctNo);
            })*/
        });

        if(duplicate==1){
            return false;
        }else{
            return true;
        }
    }

    function removeRow(el){
        var row = $(el).parent().parent();
        oTable.row(row).remove().draw(true);
    }



</script>
<?php /**PATH D:\Downloads\Upgrade Laravel Framework\bank-line\resources\views/bank-line/MNU_GPCASH_MT_DOM_BANK/detail-city.blade.php ENDPATH**/ ?>