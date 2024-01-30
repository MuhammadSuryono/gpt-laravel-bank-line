@include('_partials.header_content',['breadcrumb'=>['Fee Updates','Search']])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div class="box">
                <div id="spinner" style="display:none"></div>
                <div class="box-header">
                    <h3 class="box-title">Fee Updates</h3>
                </div>
                <form class="form-horizontal" id="form-area">

                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label"><strong>Fee Updates&ast;</strong></label>
                                <div class="col-md-3">
                                   <input type="radio" id="updateAll-rb" name="updateBy-rb" value="0" checked>
                                   <label for="updateAll-rb" class="control-label">Update All Fee Setup</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group specialFeeRow">
                                 <label class="col-md-3 control-label"></label>
                                <div class="col-md-3 form-inline" style="margin-left: 15px;">
                                    <label class="control-label">Corporate with Special Fee</label>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" id="specialFee">
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
                                   <label for="updateSpc-rb">Update Specific Fee Setup</label>
                                </div>
                                <div class="col-md-3 specificFeeRow" style="margin-left: 15px;">
                                    <select class="form-control" id="specificFee">
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
                    <h3 class="box-title">Fee Setup Detail</h3>
                </div>

                <div class="box-body list-title">
                    <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                           style="border-collapse:collapse;">
                        <thead>
                            <tr>
                                <th></th>
                                    <th align="center"><strong>Service</strong></th>
                                    <th align="center"><strong>Fee Type</strong></th>
                                    <th align="center"><strong>Currency</strong></th>
                                    <th align="center"><strong>Fee Amount</strong></th>
                                </tr>
                        </thead>
                    </table>
                </div>
                <div class="box-footer list-title">
                    <div class="float-right">
                        <button type="button" id="confirmBtn" name="confirmBtn" class="btn btn-primary">@lang('form.confirm')</button>        
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<script>
    var service = '{{ $service }}';
    var oTable;
    var currencyOption;
    var feeUpdate = '';
    var isUpdateSpecial = '';
    var specificCode = '';
    var specificName = '';
    var tableData = [];
    var submitData;

    $(document).ready(function () {

        getSpecificFee();
        setDroplistSpc();
        getDroplistCurrency();

        $('.specificFeeRow').hide();
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
                    width: "10%"
                },
                {
                    targets: 4,
                    sortable: false,
                    width: "20%"
                }

            ]
        });


        $('input[name="updateBy-rb"]').on('change', function(e){
            if (this.value=='1') {

                $('.specialFeeRow').hide();
                $('.specificFeeRow').show();
                // $('#form-area').validator('reset');

            } else {

                $('.specialFeeRow').show();
                $('.specificFeeRow').hide();
            }
        });

				
		$('#displayBtn').on('click', function () {
			displayFee();
		});

        $('#confirmBtn').on('click', function () {

            if(countSelected()==0){
                var content ='{{trans('form.alert_noselect',['label'=>'Service'])}}';
                $.alert({
                    title: '{{trans('form.warning')}}',
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
                        $('#updateType').text("Update All Fee Setup");
                        $('#isUpdate').text(isUpdateSpecial);

                        $('.feeSetupCode').hide();
                        $('.feeSetupName').hide();
                        $('.specialFeeRow').show();

                        submitData['isUpdate'] = isUpdateSpecial;

                    } else {
                        $('#updateType').text("Update Specific Fee Setup");
                        $('#feeCode').text(specificCode);
                        $('#feeName').text(specificName);

                        $('.specialFeeRow').hide();
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

            /*$.confirm({
                title: '{{trans('form.confirm')}}',
                content: '{{trans('form.confirm_edit')}}',
                buttons: {
                    
                    cancel: {
                        text: '{{trans('form.cancel')}}',
                        btnClass: 'btn-default',
                        action: function(){
                            $(this).prop('disabled',false);
                        }
                    },
                    confirm: {
                        text: '{{trans('form.confirm')}}',
                        btnClass: 'btn-primary',
                        action: function(){

                            tableData = getTableData();

                            var res = app.setView(service,'detail');
                            if(res=='done'){
                                
                                if (feeUpdate) {
                                    $('#updateType').text("Update All Fee Setup");
                                    $('#isUpdate').text(isUpdateSpecial);

                                    $('.feeSetupCode').hide();
                                    $('.feeSetupName').hide();
                                    $('.specialFeeRow').show();

                                } else {
                                    $('#updateType').text("Update Specific Fee Setup");
                                    $('#feeCode').text(specificCode);
                                    $('#feeName').text(specificName);

                                    $('.specialFeeRow').hide();
                                    $('.feeSetupCode').show();
                                    $('.feeSetupName').show();
                                }

                                prepareTable(tableData, submitData);

                            }
                        }
                    },

                }
            });*/
        });

    });

    function getSpecificFee() {
        var url_action = 'searchAllChargePackage';
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
                _token : '{{ csrf_token() }}'
            },
            success: function (data) {
                var result = JSON.parse(data);
                if (result.status=="200") {
                    unitOption = '';
                    $.each(result.result, function (idx, obj) {
                        unitOption += '<option value="' + obj.code + '" data-name="'+obj.name+'">' + obj.code + " - " + obj.name + '</option>';
                    });
                    $('#specificFee').html(unitOption);
                    $('#specificFee').select2();

                    $('.select2').css('width','100%'); //overwrite style
                } else {
                    flash('warning', result.message);
                }


            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '{{trans('form.conn_error')}}';
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

        $('#specialFee').html(unitOption);
        $('#specialFee').select2();
        
    }

    function displayFee() {


        var value = {
                code : "",
            };

        var updateAll = ($('input[name="updateBy-rb"]:checked').val() == '0' ? true : false);
        var url_action = '';

        feeUpdate = updateAll;

        if (updateAll) {

            url_action = 'searchAll';
            isUpdateSpecial = ($('#specialFee').val() == '0' ? 'Do not update' : 'Update');

        } else {

            url_action = 'searchSpesific';
            value.code = $('#specificFee').val();
            specificCode = $('#specificFee').val();
            specificName = $('#specificFee').find(':selected').attr('data-name');
        }

        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data: {
                value : value,
                menu : service,
                url_action : url_action,
                action : 'SEARCH',
                _token : '{{ csrf_token() }}'
            },
            success: function (data) {

                var result = JSON.parse(data);

                if (result.status=="200") {

                    var lastServiceName = '';

                    oTable.clear();
                    $.each(result.result, function (idx, obj) {
                        
                        var serviceName = '';

                        if (lastServiceName !== obj.serviceName) {
                            serviceName = obj.serviceName;
                        }

                        var currencySelect = '<select id="currCode" class="form-control state_edit">';
                        $.each(currencyOption, function(idx2, obj2){

                            if (updateAll) {

                                if(obj2.code=="IDR") {
                                    currencySelect += '<option value="' + obj2.code + '" selected="selected">' + obj2.code + '</option>';
                                }else{
                                    currencySelect += '<option value="' + obj2.code + '">' + obj2.code + '</option>';
                                }

                            } else {

                                if (obj2.code == obj.currencyCode) {
                                    currencySelect += '<option value="' + obj2.code + '" selected="selected">' + obj2.code + '</option>';
                                } else {
                                    currencySelect += '<option value="' + obj2.code + '">' + obj2.code + '</option>';
                                }
                            }

                        });
                        currencySelect += '</select>';

                        oTable.row.add([
                            '<input id="check" class="dt-checkboxes state_edit" value="" type="checkbox">',
                            '<span id="service_name">' + serviceName + '</span>' + '<input id="service_code" name="service_code" class="form-control state_edit" value="' + obj.serviceCode + '" type="hidden">',
                            '<span id="service_charge_name">' + obj.serviceChargeName + '</span>' + '<input id="service_charge_id" name="service_charge_id" class="form-control state_edit" value="' + obj.serviceChargeId + '" type="hidden">',
                            currencySelect,
                            '<input id="value" name="value" class="form-control state_edit value" value="'+(obj.value !=null ? obj.value : 0)+'" type="text" style="width:100%;text-align: right;">'
                        ]).draw(false);

                        $('#service_code[value="' + obj.serviceCode + '"]').parent().prev().children().attr('name', obj.serviceCode);
                        if (lastServiceName == obj.serviceName) {
                            $('#service_charge_id[value="' + obj.serviceChargeId + '"]').parent().prev().prev().children().css('opacity', '0')
                        }
                        
                        lastServiceName = obj.serviceName;

                    });

                    $('.value').autoNumeric('init',{
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

                // set isChecked for empty serviceCode(second fee from single Service). ex: Domestic Transfer - SKN, update isChecked true for SKN Fee. 
                $('.value').keyup(function (e) {

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
                _token : '{{ csrf_token() }}'
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
                var msg = '{{trans('form.conn_error')}}';
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

            var serviceName = $('td:eq(1)', $(this)).find('#service_name').text();
            // var serviceCode = $('td:eq(1)', $(this)).find('#service_code').val();
            var feeName = $('td:eq(2)', $(this)).find('#service_charge_name').text();
            var currency = $('td:eq(3)', $(this)).find('#currCode').val();
            var amount = $('td:eq(4)', $(this)).find('#value').autoNumeric('get');
            var chargeId = $('td:eq(2)', $(this)).find('#service_charge_id').val();

            var obj = {
                serviceName: serviceName,
                feeType: feeName,
                currency: currency,
                feeAmount: amount,
                chargeId: chargeId,

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
                serviceChargeId: obj.chargeId,
                currencyCode: obj.currency,
                value: obj.feeAmount
            };

            listEdit.push(list);

        });


        var data = {
            isUpdateAll: (feeUpdate == true ? 'Y' : 'N'),
            isUpdateCorporateWithSpecialCharge: (isUpdateSpecial == 'Update' ? 'Y' : 'N' ),
            code: specificCode,
            list: listEdit

        };

        return data;

    }

</script>