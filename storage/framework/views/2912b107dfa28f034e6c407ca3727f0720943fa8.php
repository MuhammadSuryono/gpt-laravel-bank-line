<?php echo $__env->make('_partials.header_content',['breadcrumb'=>['Limit Updates','Search']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div class="box">
                <div id="spinner" style="display:none"></div>
                <div class="box-header">
                    <h3 class="box-title">Limit Updates</h3>
                </div>
                <form class="form-horizontal" id="form-area">

                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label"><strong>Limit Updates&ast;</strong></label>
                                <div class="col-md-3">
                                   <input type="radio" id="updateAll-rb" name="updateBy-rb" value="0" checked>
                                   <label for="updateAll-rb" class="control-label">Update All Limit Setup</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group specialLimitRow">
                                 <label class="col-md-3 control-label"></label>
                                <div class="col-md-3 form-inline" style="margin-left: 15px;">
                                    <label class="control-label">Corporate with Special Limit</label>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" id="specialLimit">
                                            <!-- <option value="0">Do Not Update</option>
                                            <option value="1">Update</option> -->
                                    </select>
                                </div>
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-3">
                                   <input type="radio" id="updateSpc-rb" name="updateBy-rb" value="1">
                                   <label for="updateSpc-rb">Update Specific Limit Setup</label>
                                </div>
                                <div class="col-md-3 specificLimitRow" style="margin-left: 15px;">
                                    <select class="form-control" id="specificLimit">
                                            <option></option>
                                    </select>
                                </div>
                            </div>
                        </div>
					</div>
				</div>	
					
                <div class="box-footer">
					<div class="float-right">
						<!-- <button type="button" id="displayBtn" name="displayBtn" class="btn btn-primary">Display</button> -->
                        <button type="button" id="displayBtn" name="displayBtn" style="color:#008CBA; border:1px solid #008CBA; border-radius:5px" class="btn btn-default">Display</button>
					</div>
                </div>
                </form>
                <div class="box-header list-title">
                    <h3 class="box-title">Limit Setup Detail</h3>
                </div>

                <div class="box-body list-title">
                    <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                           style="border-collapse:collapse;">
                        <thead>
                            <tr>
                                <th rowspan="2"></th>
                                <th align="center" rowspan="2"><strong>Service</strong></th>
                                <th align="center" rowspan="2"><strong>Currency matrix</strong></th>
                                <th align="center" rowspan="2"><strong>Max. No. Of Transaction / Day</strong></th>
                                <th align="center" colspan="2"><strong>Maximum Transaction Amount / Day</strong></th>
                            </tr>
                            <tr>
                                <th align="center"><strong>Currency</strong></th>
                                <th align="center"><strong>Value</strong></th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="box-footer list-title">
                    <div class="float-right">
                        <button type="button" id="confirmBtn" name="confirmBtn" class="btn btn-primary"><?php echo app('translator')->get('form.confirm'); ?></button>        
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<script>
    var service = '<?php echo e($service); ?>';
    var oTable;
    var currencyOption;
    var feeUpdate = '';
    var isUpdateSpecial = '';
    var specificCode = '';
    var specificName = '';
    var tableData = [];
    var submitData;

    $(document).ready(function () {

        getSpecificLimit();
        setDroplistSpc();
        getDroplistCurrency();

        $('.specificLimitRow').hide();
        $('.list-title').hide();
        $('#list').hide();


        oTable = $('#list').DataTable({
            "paging": false,
            "ordering": false,
            "info": false,
            "destroy": true,
            "select": {
                style: 'multi',
                selector: 'input.dt-checkboxes'
            },
            "searching": false,
            "autoWidth": false,
            "ScrollX": '100%',
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
                    sortable: false,
                    width: "25%"
                },
                {
                    targets: 2,
                    sortable: false,
                    width: "20%"
                },
                {
                    targets: 3,
                    sortable: false,
                    width: "20%"
                },
                {
                    targets: 4,
                    sortable: false,
                    width: "10%"
                },
                {
                    targets: 5,
                    sortable: false,
                    width: "20%"
                }

            ]
        });


        $('input[name="updateBy-rb"]').on('change', function(e){
            if (this.value=='1') {

                $('.specialLimitRow').hide();
                $('.specificLimitRow').show();
                // $('#form-area').validator('reset');

            } else {

                $('.specialLimitRow').show();
                $('.specificLimitRow').hide();
            }
        });

				
		$('#displayBtn').on('click', function () {
			displayLimit();
		});

        $('#confirmBtn').on('click', function () {

            if(countSelected()==0){
                var content ='<?php echo e(trans('form.alert_noselect',['label'=>'Service'])); ?>';
                $.alert({
                    title: '<?php echo e(trans('form.warning')); ?>',
                    content: content
                });
                return;
            }

            $(this).prop('disabled',true);

            tableData = getTableData();
            submitData = prepareSubmitData(tableData);

            // console.log("submitData", submitData);

            setTimeout(function(){

                var res = app.setView(service,'detail');
                if(res=='done'){
                                
                    if (feeUpdate) {
                        $('#updateType').text("Update All Limit Setup");
                        $('#isUpdate').text(isUpdateSpecial);

                        $('.feeSetupCode').hide();
                        $('.feeSetupName').hide();
                        $('.specialLimitRow').show();

                        submitData['isUpdate'] = isUpdateSpecial;

                    } else {
                        $('#updateType').text("Update Specific Limit Setup");
                        $('#feeCode').text(specificCode);
                        $('#feeName').text(specificName);

                        $('.specialLimitRow').hide();
                        $('.feeSetupCode').show();
                        $('.feeSetupName').show();

                        submitData['feeCode'] = specificCode;
                        submitData['feeName'] = specificName;
                    }

                    submitData['updateType'] = $('#updateType').text();
                    submitData['dataTable'] = tableData;

                    prepareDetail(tableData, submitData);

                }
            });
        });

    });

    function getSpecificLimit() {
        var url_action = 'searchAllLimitPackage';
        var action = 'SEARCH';
        var menu = service;
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data: {
                value : {orderBy:{"name": "ASC"}},
                menu : menu,
                url_action : url_action,
                action : action,
                _token : '<?php echo e(csrf_token()); ?>'
            },
            success: function (data) {
                var result = JSON.parse(data);
                if (result.status=="200") {
                    unitOption = '';
                    $.each(result.result, function (idx, obj) {
                        unitOption += '<option value="' + obj.code + '" data-name="'+obj.name+'">' + obj.code + " - " + obj.name + '</option>';
                    });
                    $('#specificLimit').html(unitOption);
                    $('#specificLimit').select2();

                    $('.select2').css('width','100%'); //overwrite style
                } else {
                    flash('warning', result.message);
                }


            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '<?php echo e(trans('form.conn_error')); ?>';
                flash('warning', msg);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {

            }
        });
    }

    function setDroplistSpc() {

        unitOption = '';
        unitOption +='<option value="' + 0 + '">Do not update</option>';
        unitOption +='<option value="' + 1 + '">Update</option>';

        $('#specialLimit').html(unitOption);
        $('#specialLimit').select2();
        
    }

    function displayLimit() {


        var value = {
                code : "",
            };

        var updateAll = ($('input[name="updateBy-rb"]:checked').val() == '0' ? true : false);
        var url_action = '';

        feeUpdate = updateAll;

        if (updateAll) {

            url_action = 'searchAll';
            isUpdateSpecial = ($('#specialLimit').val() == '0' ? 'Do not update' : 'Update');

        } else {

            url_action = 'searchSpesific';
            value.code = $('#specificLimit').val();
            specificCode = $('#specificLimit').val();
            specificName = $('#specificLimit').find(':selected').attr('data-name');
        }

        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data: {
                value : value,
                menu : service,
                url_action : url_action,
                action : 'SEARCH',
                _token : '<?php echo e(csrf_token()); ?>'
            },
            success: function (data) {

                var result = JSON.parse(data);

                if (result.status=="200") {

                    var lastServiceName = '';

                    oTable.clear();
                    $.each(result.result, function (idx, obj) {
                        
                        var serviceName = '';

                        //if (lastServiceName !== obj.serviceName) {
                            serviceName = obj.serviceName;
                        //}

                        var currencySelect = '<select id="currCode" class="form-control state_edit">';
                        $.each(currencyOption, function(idx2, obj2){

                            if (obj2.code == obj.currencyCode) {
                                currencySelect += '<option value="' + obj2.code + '" selected="selected">' + obj2.code + '</option>';
                            } else {
                                currencySelect += '<option value="' + obj2.code + '">' + obj2.code + '</option>';
                            }
                        });
                        currencySelect += '</select>';

                        oTable.row.add([
                            '<input id="check" class="dt-checkboxes state_edit" value="" type="checkbox">',
                            '<span id="service_name">' + serviceName + '</span>' + '<input id="service_code" name="service_code" class="form-control state_edit" value="' + obj.serviceCode + '" type="hidden">',
                            '<span id="service_limit_name">' + obj.currencyMatrixName + '</span>' + '<input id="service_limit_id" name="service_limit_id" class="form-control state_edit" value="' + obj.serviceCurrencyMatrixId + '" type="hidden">',
                            '<input id="num_trans" name="num_trans" class="form-control state_edit num_trans" value="'+(obj.maxTrxPerDay !=null ? obj.maxTrxPerDay : 0)+'" type="text" style="width:100%;text-align: right;"><span id="num_trans_view" class="state_view" style="float: right;">-</span>',
                            currencySelect,
                            '<input id="max_trans" name="max_trans" class="form-control state_edit max_trans numeric" value="'+(obj.maxTrxAmountPerDay !=null ? obj.maxTrxAmountPerDay : 0)+'" type="text" style="width:100%;text-align: right;"><span id="max_trans_view" class="state_view" style="float: right;">-</span>'
                        ]).draw(false);

                        $('#service_code[value="' + obj.serviceCode + '"]').parent().prev().children().attr('name', obj.serviceCode);
                        /*if (lastServiceName == obj.serviceName) {
                            $('#service_limit_id[value="' + obj.serviceCurrencyMatrixId + '"]').parent().prev().prev().children().css('opacity', '0')
                        }*/
                        
                        lastServiceName = obj.serviceName;

                    });

                    $('.num_trans').autoNumeric('init', {emptyInputBehavior: 'zero',decimalPlacesOverride: '0',minimumValue:'0',maximumValue:'999999999'});
                    $('.max_trans').autoNumeric('init',{
                            emptyInputBehavior: 'zero',
                            digitGroupSeparator        : ',',
                            decimalCharacter           : '.',
                            decimalCharacterAlternative: '.',
                            allowDecimalPadding : false,
                            minimumValue:'0.00',maximumValue:'999999999999999.99'
                    });
                }
                                
            }, error: function (xhr, ajaxOptions, thrownError) {
                    flash('warning', 'Form Submit Failed');
                    console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {
                $('#list').show();
                $('.list-title').show();
                $('.state_view').hide();

                // set isChecked for empty serviceCode(second fee from single Service). ex: Domestic Transfer - SKN, update isChecked true for SKN Limit. 
                $('.num_trans').keyup(function (e) {

                        var check = ($(this).parent().parent().find('td').eq(0).children().is(':checked') ? 1 : 0);

                        if(check==0){
                            $(this).parent().parent().find('td').eq(0).children().prop('checked',true);
                        }
                    });
                $('.max_trans').keyup(function (e) {

                        var check = ($(this).parent().parent().find('td').eq(0).children().is(':checked') ? 1 : 0);

                        if(check==0){
                            $(this).parent().parent().find('td').eq(0).children().prop('checked',true);
                        }
                });

                $('select[id="currCode"]').on('change', function(e){

                    var check = ($(this).parent().parent().find('td').eq(0).children().is(':checked') ? 1 : 0);

                    if(check==0){
                        $(this).parent().parent().find('td').eq(0).children().prop('checked',true);
                    }
                });

            }
        });           

    }

    function getDroplistCurrency() {
        
        var url_action = 'searchCurrencyForDroplist';
        var action = 'SEARCH';
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data: {
                value : '',
                menu : service,
                url_action : url_action,
                action : action,
                _token : '<?php echo e(csrf_token()); ?>'
            },
            success: function (data) {
                var result = JSON.parse(data);
                if (result.status=="200") {
                    /*currencyOption = '<select id="currCode" class="form-control">';
                    $.each(result.result, function (idx, obj) {
                        // if (obj.code == kode) {
                        //     currencyOption += '<option value="' + obj.code + '" selected="selected">' + obj.code + '</option>';
                        // } else {
                            currencyOption += '<option value="' + obj.code + '">' + obj.code + '</option>';
                        // }
                    });
                    currencyOption += '</select>';*/
                    currencyOption = result.result;
                } else {
                    flash('warning', result.message);
                }
            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '<?php echo e(trans('form.conn_error')); ?>';
                flash('warning', msg);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {
                
            }
        });
    }

    function countSelected(){
        var count = 0;
        $("#list").find("tbody tr").each(function () {
            var check = ($('td:eq(0)', $(this)).children().is(':checked') ? 1 : 0);

            if (check == 1) {
                count++;
            }
        });
        return count;
    }

    function getTableData() {
        var data = [];

        $("#list").find("tbody tr").each(function () {
            var check = ($('td:eq(0)', $(this)).children().is(':checked') ? 1 : 0);
            /*if (check == 0) {
                $('td:eq(0)', $(this)).parent().hide();
            }*/

            // var serviceCode = $('td:eq(1)', $(this)).find('#service_code').val();
            var serviceName = $('td:eq(1)', $(this)).find('#service_name').text();
            var curMatrixName = $('td:eq(2)', $(this)).find('#service_limit_name').text();
            var curMatrixId = $('td:eq(2)', $(this)).find('#service_limit_id').val();
            var maxTrxPerDay = $('td:eq(3)', $(this)).find('#num_trans').autoNumeric('get');
            var currency = $('td:eq(4)', $(this)).find('#currCode').val();
            var maxTrxAmt = $('td:eq(5)', $(this)).find('#max_trans').autoNumeric('get');

            var obj = {
                serviceName: serviceName,
                curMatrixName: curMatrixName,
                currency: currency,
                maxTrxAmt: maxTrxAmt,
                maxTrxPerDay: maxTrxPerDay,
                curMatrixId: curMatrixId
            };
            if (check == 1) {
                data.push(obj);
            }
        });
        // console.log("data",data);
        return data;
    }

    function prepareSubmitData(tableData) {

        var listEdit = [];

        $.each(tableData, function (idx, obj) {


            var list = {
                serviceCurrencyMatrixId: obj.curMatrixId,
                currencyCode: obj.currency,
                maxTrxPerDay: obj.maxTrxPerDay,
                maxTrxAmountPerDay: obj.maxTrxAmt
            };

            listEdit.push(list);

        });


        var data = {
            isUpdateAll: (feeUpdate == true ? 'Y' : 'N'),
            isUpdateCorporateWithSpecialLimit: (isUpdateSpecial == 'Update' ? 'Y' : 'N' ),
            code: specificCode,
            list: listEdit

        };

        return data;

    }

</script><?php /**PATH C:\xampp8\htdocs\bank-line\resources\views/bank-line/MNU_GPCASH_PRO_LMT_UPDATE/landing.blade.php ENDPATH**/ ?>