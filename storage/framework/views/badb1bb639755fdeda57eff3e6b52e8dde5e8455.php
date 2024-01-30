<?php echo $__env->make('_partials.header_content',['breadcrumb'=>[str_replace('-',' ','Interest Rate'),$type]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Rate Detail</h3>
                </div>
                <form id="form-area" class="form-horizontal form-area">
                <input type="hidden" id="productCode_1" value=""/>
                <input type="hidden" id="productName_1" value=""/>
                <input type="hidden" id="type" value=""/>
                <input type="hidden" id="state" value=""/>
                <input type="hidden" id="submit_mode" value=""/>
				<input type="hidden" id="intRateId" value=""/>
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label"><strong>Product Code&ast;</strong></label>
                                <div class="col-md-5">
                                    <input type="text" id="productCode" name="productCode" class="form-control state_edit" autocomplete="off" value="" maxlength="40" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                    <label id="productCode_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label"><strong>Product Name&ast;</strong></label>
                                <div class="col-md-5">
                                    <input type="text" id="productName" name="productName" class="form-control state_edit" autocomplete="off" value="" maxlength="100" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                    <label id="productName_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-header state_edit">
                    <h3 class="box-title">Rate Listing</h3><br>
                </div>
                <div class="box-body state_edit">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label"><strong>Balance&ast;</strong></label>
                                <div class="col-md-5">
                                    <input type="text" id="balance" name="balance" class="form-control state_edit numeric" autocomplete="off" value="" maxlength="100" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                    <label id="balance_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Period</label>
                                <div class="col-md-5">
                                    <input type="text" id="period" name="period" class="form-control state_edit numeric" autocomplete="off" value="" maxlength="100">
                                    <label id="period_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label"><strong>Interest Rate (% pa)&ast;</strong></label>
                                <div class="col-md-5">
                                    <input type="text" id="rate" name="rate" class="form-control state_edit numeric" autocomplete="off" value="" maxlength="100" data-error="This field is required." required>
                                    <div class="help-block with-errors"></div>
                                    <label id="rate_view" class="state_view"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-4 control-label"><strong></strong></label>
                                <div class="col-md-5">
                                   <button type="button" id="add_list" class="btn btn-default">Add to List</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-header">
                    <h3 class="box-title">Rate Listing</h3><br>
                </div>
                <div class="box-body">
                    <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                        <thead>
                            <tr>
                                <th align="left"><strong>Balance</strong></th>
                                <th align="left"><strong>Period</strong></th>
                                <th align="left"><strong>Interest Rate (% pa)</strong></th>
                                <th align="left" class="state_edit"><strong></strong></th>
                            </tr>
                        </thead>
                    </table>           
                </div>

                <div class="box-footer">
                        <div class="col-md-12 state_edit text-center">
                            <button type="button" id="back" name="back" class="btn btn-default back float-left"><?php echo app('translator')->get('form.cancel'); ?></button>
                            <button type="button" id="confirm" name="confirm" class="btn btn-primary float-right "><?php echo app('translator')->get('form.confirm'); ?></button>
                        </div>
                        <div class="col-md-12 state_view text-center" data-html2canvas-ignore="true">
                            <div class="float-left">
                                <button type="button" id="back_view" name="back_view" class="btn btn-default"><?php echo app('translator')->get('form.cancel'); ?></button>
                                <button type="button" id="save_screen" name="save_screen" class="btn btn-default" style="display:none" onclick="save_pdf();"><?php echo app('translator')->get('form.save_pdf'); ?></button>
                            </div>
                            <div class="float-right" style="display:inline;">
                                <button type="button" id="next_user" name="next_user" class="btn btn-info"><?php echo app('translator')->get('form.next_user'); ?></button>
                                <button type="button" id="done" name="done" class="btn btn-primary" style="display:none"><?php echo app('translator')->get('form.done'); ?></button>
                                <button type="button" id="submit_view" name="submit_view" class="btn btn-primary"><?php echo app('translator')->get('form.submit'); ?></button>
                            </div>
                        </div>
                </div>
                    <?php echo $__env->make('_partials.next_user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </form>
            </div>
        </div>
    </div>

</section>

<script>
    var oTable;
    var submit_data;
    var id = '<?php echo e($service); ?>';
    var noRef;
    var intRateId;

    $(document).ready(function () {

        $(document).validator().on('#form-area','submit', function (e) {
            if (e.isDefaultPrevented()) {
                // handle the invalid form...
            } else {
                // everything looks good!

            }
        });

        stateEdit();

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
                    sortable: false,
                    width: "30%"
                },
                {
                    targets: 1,
                    sortable: false,
                    width: "25%"
                },
                {
                    targets: 2,
                    sortable: false,
                    width: "25%"
                },
                {
                    targets: 3,
                    sortable: false,
                    width: "20%",
                    className: "dt-center state_edit",
                    render: function ( data, type, full, meta ) {
                        return '<button data-cif="'+data+'" class="btn btn-danger" onClick="removeRow(this);" style="width:100px;">Remove</button>';
                    }
                }
            ],
        });



        $('#submit_view').on('click', function () {
            $(this).prop('disabled',true);
            var content ='';
            var action = '';
            if ($('#type').val() == 'add'){
                content='<?php echo e(trans('form.confirm_add')); ?>';
                action = 'CREATE';
            }else{
                content='<?php echo e(trans('form.confirm_edit')); ?>';
                action = 'UPDATE';
            }

            $.confirm({
                title: '<?php echo e(trans('form.submit')); ?>',
                content: content,
                buttons: {
                    
                    cancel: {
                        text: '<?php echo e(trans('form.cancel')); ?>',
                        btnClass: 'btn-default',
                        action: function(){
                            $('#submit_view').prop('disabled',false);
                        }
                    },
                    confirm: {
                        text: '<?php echo e(trans('form.confirm')); ?>',
                        btnClass: 'btn-primary',
                        action: function(){
                            submitData(action);
                        }
                    },

                }
            });

        });

        $('#add_list').on('click', function () {
            // $(this).prop('disabled',true);
            
            $('#form-area').validator('validate');
            // setTimeout(function(){
                if($('#form-area').validator('validate').has('.has-error').length==0){
                    var inputProdCd = $('#productCode').val();
                    var inputBalance = $('#balance').val();
                    var inputPeriod = $('#period').val();
                    validateAddList(inputProdCd, inputBalance, inputPeriod);
                }
            // });

        });

        function submitData(submitAction){
            var value = {
                "productCode": $('#productCode_1').val(),
                "productName": $('#productName_1').val(),
                "rateList": submit_data,
            };

            if (submitAction == 'UPDATE') {
                value['id'] = $('#intRateId').val();
            }

            // console.log("id= ", intRateId);

            var url_action = "submit";
            
             $.ajax({
                    url: 'getAPIData',
                    method: 'post',
                    data: {"_token": "<?php echo e(csrf_token()); ?>", menu: id, value: value, url_action: url_action, action: submitAction},
                    success: function (data) {
                        $('#submit_view').prop('disabled',false);
                        var result = JSON.parse(data);
                        if (result.status=="200") {
                            noRef=result.referenceNo;
                            flash('success', result.message+'<br>'+'ReferenceNo: '+ result.referenceNo+'<br>'+result.dateTimeInfo);
                            $('#submit_view').hide();
                            stateSuccess();
                        } else {
                            $('#submit_view').prop('disabled',false);
                            flash('warning', result.message);
                        }

                    }, error: function (xhr, ajaxOptions, thrownError) {
                        $('#submit_view').prop('disabled',false);
                        flash('warning', 'Form Submit Failed');
                        console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                    }
                });
            }


        $('#confirm').on('click', function () {

            if(oTable.data().count()<1){
                var content ='<?php echo e(trans('form.alert_empty',['label'=>'Rate'])); ?>';
                $.alert({
                    title: '<?php echo e(trans('form.warning')); ?>',
                    content: content
                });
                return;
            }
            var type = $('#type').val();
            if (type == 'edit') {
                if ($('#productName').val() == '') {
                    $('#productName').focus();
                    return;
                }

            }

            setTimeout(function(){
                $('#submit_type').val('submit');
                submit_data = getTableData();
                stateView();
            });

        });

        $('#back_view').on('click', function () {
            $(this).prop('disabled',true);

            if($('#state').val() == 'success'){
                var action = '';
                if($('#submit_type').val()=='submit'){
                    action = 'landing';
                }else{
                    action = 'add';
                }
                app.setView(id,action)
                return;
            } else {
                $('#back_view').prop('disabled',false);
                stateEdit();
            }
        });

        $('.back').on('click', function () {
            $(this).prop('disabled',true);
           
                /*var code = $('#code_edit').val();
                var cifid = $('#cifDetail').text();
				var corpCode = $('#corpCodeDetail').text();
				var name = $('#name').val();
				var status = $('#statusDetail').text();
				var res = app.setView(id,'detail');
                if(res=='done'){
                    $('#code').val(code);
					$('#cif').val(cifid);
                    $('#name').val(name);
                    $('#codeCorp').val(corpCode);
                    $('#statusCode').val(status);
                    getDetail();
                }*/
                var res = app.setView(id,'landing');
            
        });

        $('#done').on('click', function () {
            $(this).prop('disabled',true);
            app.setView(id,'landing');
        });

        $('.numeric').numeric({
            allowSpace: false,
            allow : ''
        });

        $('input[type="text"]').not('.numeric').alphanum({
            allowSpace: true,
            allow : '<>=,._!@-'
        });
    });
    

        function stateEdit() {

            $('#state').val('edit');
            $('.state_view').hide();
            $('.state_edit').show();
            $('label.state_view').text('-');
            $('#save_screen').hide();
            $('.help-block').show();
            $('#done').hide();
            $('#next_user').hide();
        }

        function stateView() {
            $('#state').val('view');

            $('.state_edit').hide();
            $('.state_view').show();
            
            $('#save_screen').hide();
            $('.help-block').hide();
            $('#done').hide();
            $('#next_user').hide();

        }

        function stateSuccess() {
            $('#state').val('success');
            $('#name').val('');
            $('input.state_edit').val('');
            $('input.check').attr('checked', '');
            $('#back_view').hide();
            $('#save_screen').show();
            $('#done').show();
            $('#next_user').show();
        }

        function validateAddList(productCode, balance, period){

            var value = {
                productCode: productCode,
                balance: balance,
                period: period
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

                    // console.log(result);
                    if (result.status=="200") {
                        
                        if(checkDuplicateList(balance, period)) {

                            var intRate = $('#rate').val();

                            oTable.row.add([
                                    result.balance + '<input type=hidden id="balanceHidden" value="' + result.balance + '">',
                                    result.period + '<input type=hidden id="periodHidden" value="' + result.period + '">',
                                    intRate + '<input type=hidden id="rateHidden" value="' + intRate + '">',

                                ]).draw(true);
                        } else {
                            flash('warning', 'The Combination of Balance and Period has been added to List');
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

        function checkDuplicateList(bal, period){
            var duplicate = 0;

            console.log("=========balanceAdd: " + bal + " ===========periodAd: " + period);

            $("#list").find("tbody tr").each(function (idx, obj) {

                var code = $('td:eq(1)', $(this)).find('#periodHidden').val();

                console.log("periodExist: " + code);

                var balance = $('td:eq(0)', $(this)).find('#balanceHidden').val();

                console.log("balanceExist: " + balance);

                if(bal==balance){
                    if(period == code){
                        duplicate = 1;
                    }
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

        function getTableData() {
            var data = [];

            var idx = 0;

            var productCode = $('#productCode').val();
            var productName = $('#productName').val();

            $('#productCode_1').val(productCode);
            $('#productName_1').val(productName);
            $('#productCode_view').text(productCode);
            $('#productName_view').text(productName);

            $("#list").find("tbody tr").each(function () {
                var balance = $('td:eq(0)', $(this)).find('#balanceHidden').val();
                var period = $('td:eq(1)', $(this)).find('#periodHidden').val();
                var rate = $('td:eq(2)', $(this)).find('#rateHidden').val();

                var obj = {
                    balance: balance,
                    period:period,
                    interestRate:rate,
                    idx: idx++,

                };

                data.push(obj);

            });

            return data;
        }

        function getDetailEdit(intId){

            intRateId = intId; // set untuk edit

            var url_action= 'searchInterestDetailById';
            var value ={
                id:intId,
                currentPage: "1",
                pageSize: "50",
            };
            $.ajax({
                url: 'getAPIData',
                method: 'post',
                data:{value:value,menu:id,action:'DETAIL',url_action:url_action},
                success: function (data) {
                    var result = JSON.parse(data);
                    var detail = result.result;
                    if (result.status=="200") {
                        
                        if (detail) {
                            $.each(detail, function (idx, obj){
                                oTable.row.add([
                                    obj.balance+'<input type=hidden id="balanceHidden" value="'+obj.balance+'">',
                                    obj.period+'<input type=hidden id="periodHidden" value="'+obj.period+'">',
                                    obj.interestRate+'<input type=hidden id="rateHidden" value="'+obj.interestRate+'">'
                                ]).draw(true);
                            });
                        }

                    } else {
                        flash('warning', result.message);
                    }

                }, error: function (xhr, ajaxOptions, thrownError) {
                    var msg = '<?php echo e(trans('form.conn_error')); ?>';
                    flash('warning', msg);
                    console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                },
                complete: function(data) {
                    $('#productCode').val($('#productCode_1').val());
                    $('#productCode').prop('disabled',true);
                    $('#productName').val($('#productName_1').val());
                }
            });
        }


</script><?php /**PATH D:\Downloads\Upgrade Laravel Framework\bank-line\resources\views/bank-line/MNU_GPCASH_MT_INTEREST_RATE/add.blade.php ENDPATH**/ ?>