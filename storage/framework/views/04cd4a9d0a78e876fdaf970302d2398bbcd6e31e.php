<?php echo $__env->make('_partials.header_content',['breadcrumb'=>['Transaction Holiday Update','Search']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div class="box">
                <div id="spinner" style="display:none"></div>
                <div class="box-header">
                    <h3 class="box-title">Transaction Filter</h3>
                </div>
                <form class="form-horizontal" id="form-area">

                <div class="box-body">
                    <div class="container-fluid">                        
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-3">
                                   <label for="refNo-rb">Reference Number</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" id="refNo" name="refNo" class="form-control" autocomplete="off" value="" maxlength="40" >
                                </div>
                            </div>
                        </div>
                </div>
                <div class="box-footer">
                    <div class="float-left">
                        <button type="button" id="search" name="search" class="btn btn-primary"><?php echo app('translator')->get('form.search'); ?></button>
                    </div>
                </div>
                </form>
                    <div class="box-header list-title">
                        <h3 class="box-title">Transaction Listing</h3>
                    </div>
                    <div class="box-body list-title">
                        
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2" style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th align="center"><strong>No.</strong></th>
                                        <th align="center"><strong>Corporate</strong></th>
                                        <th align="center"><strong>Reference No</strong></th>
                                        <th align="center"><strong>Menu</strong></th>
                                        <th align="center"><strong>Corporate Account</strong></th>
                                        <th align="center"><strong>Transaction Amount</strong></th>
                                        <th align="center"><strong>Created By</strong></th>
                                        <th align="center"><strong>Transaction Status</strong></th>
										<th align="center"><strong>Update Instruction Date</strong></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td align="center"></td>
                                        <td align="left"></td>
                                        <td align="left"></td>
                                        <td align="left"></td>
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

</section>

<script>
    var service = '<?php echo e($service); ?>';

    $(document).ready(function () {

        var url_action = '';
        var action = 'SEARCH';
        var result_key = 'result';
        var custom_order = {"referenceNo": "DESC"};
        var data_code = '';

        $('#list').hide();
        $('.list-title').hide();

        $('#search').on('click', function (){
 
            var validate = true;

            var value = {
                referenceNo : "",
                senderRefNo : "",
                benRefNo : "",
                currentPage: "1",
                pageSize: "20",
            };

    
                url_action = 'searchHolidayTransactionByReferenceNo';
                value.referenceNo = $('#refNo').val();

            $(this).prop("disabled",true);
            $('#list').show();
            $('.list-title').show();

            if (validate) {

                    var index = 1;
                    $('#list').DataTable({
                        "destroy": true,                       
                        "drawCallback": function( settings ) {
                    $('#search').prop("disabled",false);
                    $('.updateprev').on('click', function () {
                       var code = $(this).attr('data-code');
                       var menu = $(this).attr('data-menu');
                       var refno = $(this).attr('data-refno');
                       var content ='Update Instruction Date to Previous Working Day?';

                        $.confirm({
                            title: 'Update',
                            content: content,
                            buttons: {
                                
                                cancel: {
                                    text: '<?php echo e(trans('form.cancel')); ?>',
                                    btnClass: 'btn-default',
                                    action: function(){
                                        //$('#submit_view').prop('disabled',false);
                                    }
                                },
                                confirm: {
                                    text: '<?php echo e(trans('form.confirm')); ?>',
                                    btnClass: 'btn-primary',
                                    action: function(){
                                        submitPrev(code, menu, refno);
                                    }
                                },

                            }
                        });
                    });
                    $('.updatenext').on('click', function () { 
                        var code = $(this).attr('data-code');
                       var menu = $(this).attr('data-menu');
                       var refno = $(this).attr('data-refno');
                       var content ='Update Instruction Date to Next Working Day?';

                        $.confirm({
                            title: 'Release Session',
                            content: content,
                            buttons: {
                                
                                cancel: {
                                    text: '<?php echo e(trans('form.cancel')); ?>',
                                    btnClass: 'btn-default',
                                    action: function(){
                                        //$('#submit_view').prop('disabled',false);
                                    }
                                },
                                confirm: {
                                    text: '<?php echo e(trans('form.confirm')); ?>',
                                    btnClass: 'btn-primary',
                                    action: function(){
                                        submitNext(code, menu, refno);
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
								data: "createdDate",
								render: function ( data, type, full, meta ) {
									return index++;
								},						
								orderable: false
							},
                            {
                                targets: 1,
                                data: {
                                    corporateId: "corporateId",
                                    corporateName: "corporateName"
                                },
                                 render: function ( data, type, full, meta ) {
                                    return data.corporateId +' - '+ data.corporateName;
                                },
                                orderable: false
                            },                    
                            {
                                targets: 2,
                                data: "referenceNo",
                                orderable: false
                            },
                            {
                                targets: 3,
                                data: "menuName",
                                orderable: false
                            },
                            {
                                targets: 4,
                                data: {
                                    sourceAccount: "sourceAccount",
                                    sourceAccountName: "sourceAccountName",
                                    sourceAccountCurrencyName: "sourceAccountCurrencyName",
                                },
                                 render: function ( data, type, full, meta ) {
                                    if (data.sourceAccount !='') {
                                        return data.sourceAccount +' / '+ data.sourceAccountName +' ('+data.sourceAccountCurrencyName+')';
                                    } else {
                                        return '';
                                    }
                                },
                                orderable: false
                            },
                            {
                                targets: 5,
                                // data: "transactionAmount",
                                data: {
                                    transactionAmount: "transactionAmount",
                                    transactionCurrency: "transactionCurrency"
                                },
                                orderable: false,
                                // render: $.fn.dataTable.render.number( ',', '.', 0, 'IDR ' )
                                render: function ( data, type, full, meta ) {
                                    if(data.transactionAmount == '-1'){
                                        return '';
                                    } else {
                                        return data.transactionCurrency +' '+ currencyFormat(data.transactionAmount);
                                    }
                                },
                            },
                            {
                                targets: 6,
                                data: {
                                    createdByUserId: "createdByUserId",
                                    createdByUserName: "createdByUserName"
                                },
                                 render: function ( data, type, full, meta ) {
                                    return data.createdByUserId +' - '+ data.createdByUserName;
                                },
                                orderable: false
                            },
                            {
                                targets: 7,
                                data: "status",
                                orderable: false
                            },
                            {
                        targets: 8,
                        data: {
                                    id: "id",
                                    menuName: "menuName",
                                    referenceNo:"referenceNo"
                                },
                        width: "15%",
                        render: function ( data, type, full, meta ) {

                            return '<button data-code="'+data.id+'" data-menu="'+data.menuName+'" data-refno="'+data.referenceNo+'" class="btn btn-default updateprev" >Previous<button data-code="'+data.id+'" data-menu="'+data.menuName+'" data-refno="'+data.referenceNo+'" class="btn btn-default updatenext" >Next</button>';
                        },
                        orderable: false
                    }
                        ],
                        "ajax": {
                            url: "fetchDataTable",
                            type:'POST',
                            data: function ( d ) {
                                d.value = value;
                                d.menu = service;
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
                            },
                            complete: function (data) {

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

 function submitPrev(code,menu,refno) {
        var url_action = 'submit';
        var action = 'UPDATE_STATUS';

         var value = {
            "holidayTrxId": code,
            "updateType":"PREVIOUS WORKING DAY",
            "trxMenuName":menu,
            "trxRefNo":refno

        };
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data: {"_token": "<?php echo e(csrf_token()); ?>", action:action,url_action:url_action,menu: service, value: value},
            success: function (data) {
                $('#confirm').prop('disabled',false);

                var result = JSON.parse(data);
                if (result.status=="200") {
                    noRef=result.referenceNo;
                    flash('success', result.message+'<br>'+'ReferenceNo: '+ result.referenceNo+'<br>'+result.dateTimeInfo);
                    $('#done').show();
                    $('#update_success').hide();
                    $('#update_failed').hide();
                    $('#back').hide();
                    $('#save_screen').show();
                    $('#next_user').show();

                } else {
                    flash('warning',result.message);
                }
            }, error: function (xhr, ajaxOptions, thrownError) {
                //$('#confirm').prop('disabled',false);
                flash('warning', 'Form Submit Failed');
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }
        });
    }

function submitNext(code,menu,refno) {
    var url_action = 'submit';
        var action = 'UPDATE_STATUS';

        var value = {
            "holidayTrxId": code,
            "updateType":"NEXT WORKING DAY",
            "trxMenuName":menu,
            "trxRefNo":refno

        };
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data: {"_token": "<?php echo e(csrf_token()); ?>", action:action,url_action:url_action,menu: service, value: value},
            success: function (data) {
                $('#confirm').prop('disabled',false);

                var result = JSON.parse(data);
                if (result.status=="200") {
                    noRef=result.referenceNo;
                    flash('success', result.message+'<br>'+'ReferenceNo: '+ result.referenceNo+'<br>'+result.dateTimeInfo);
                    $('#done').show();
                    $('#update_success').hide();
                    $('#update_failed').hide();
                    $('#back').hide();
                    $('#save_screen').show();
                    $('#next_user').show();

                } else {
                    flash('warning',result.message);
                }
            }, error: function (xhr, ajaxOptions, thrownError) {
                //$('#confirm').prop('disabled',false);
                flash('warning', 'Form Submit Failed');
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }
        });
    }
    function currencyFormat (num) {
        return parseFloat(num).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");  //<--- $1  is a special replacement pattern which holds a value of the first parenthesised submatch string 
    }



</script><?php /**PATH C:\xampp8\htdocs\bank-line\resources\views/bank-line/MNU_GPCASH_BO_TRX_HOLIDAY_UPDATE/landing.blade.php ENDPATH**/ ?>