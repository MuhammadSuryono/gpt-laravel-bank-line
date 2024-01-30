@include('_partials.header_content',['breadcrumb'=>['corporate maintenance','detail']])

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <input type="hidden" id="code" value=""/>
            <input type="hidden" id="name" value=""/>
            <input type="hidden" id="countryCode" value=""/>
            <input type="hidden" id="stateCode" value=""/>
            <input type="hidden" id="substateCode" value=""/>
            <div class="box">

                <div class="box-header">
                    <h3 class="box-title">Corporate Detail</h3><br>
                </div>
                <form id="form-area" class="form-horizontal form-area">
                    <div class="box-body">
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">CIF</label>
                                    <div class="col-md-6">
                                        <label id="cifid">-</label>
                                    </div>
                                </div>
                            </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Corporate ID</label>
                                <div class="col-md-6">
                                    <label id="corporateId">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Corporate Name</label>
                                <div class="col-md-6">
                                    <label id="corporateName">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Address</label>
                                <div class="col-md-6">
                                    <label id="address1">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-6">
                                    <label id="address2">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-6">
                                    <label id="address3">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Country</label>
                                <div class="col-md-6">
                                    <label id="countryName">-</label>
                                </div>
                            </div>
                        </div>
                        
                      	<div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">State</label>
                                <div class="col-md-6">
                                    <label id="stateName">-</label>
                                </div>
                           </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Substate</label>
                                <div class="col-md-6">
                                    <label id="substateName">-</label>
                                </div>
                            </div>
                        </div>
                       
                       <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">City</label>
                                <div class="col-md-6">
                                    <label id="cityName">-</label>
                                </div>
                            </div>
                        </div>                        
                       
                       <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Post Code</label>
                                <div class="col-md-6">
                                    <label id="postcode">-</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Email Address</label>
                                <div class="col-md-6">
                                    <label id="email1">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Alternate Email Address</label>
                                <div class="col-md-6">
                                    <label id="email2">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Phone No.</label>
                                <div class="col-md-3">
                                    <label id="phoneNo">-</label>
                                </div>
                                <label class="col-md-2 control-label">Ext No.</label>
                                <div class="col-md-2">
                                    <label id="extNo">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Fax No.</label>
                                <div class="col-md-6">
                                    <label id="faxNo">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Servicing Branch</label>
                                <div class="col-md-6">
                                    <label id="servicingBranch">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Industry Segment</label>
                                <div class="col-md-6">
                                    <label id="industrySegmentName">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Business Unit</label>
                                <div class="col-md-6">
                                    <label id="businessUnitName">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Tax ID</label>
                                <div class="col-md-6">
                                    <label id="taxIdNo">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Handling Officer</label>
                                <div class="col-md-6">
                                    <label id="handlingOfficer">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row non-status">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Residential Status</label>
                                <div class="col-md-6">
                                    <label id="residentialStatus">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row non-status">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Citizenship</label>
                                <div class="col-md-6">
                                    <label id="citizenship">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row non-status">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Remitter Type</label>
                                <div class="col-md-6">
                                    <label id="remitterType">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Status</label>
                                <div class="col-md-6">
                                    <div class="state_update">
                                    <select id="inActiveFlag" style="width: 50%;margin-top: 10px;padding-left:5px">
                                        <option value="N">Active</option>
                                        <option value="Y">Inactive</option>
                                    </select>
                                    </div>
                                    <label id="status" class="state_normal">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row reason">
                            <div class="form-group">
                                <label class="col-md-3 control-label"><strong>Reason&ast;</strong></label>
                                <div class="col-md-6">
                                    <textarea id="inactiveReason" class="form-control" rows="5" maxlength="255" style="margin-top: 10px;height:200px !important;" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
                    <div class="box-header table-hidden">
                        <h3 class="box-title">Contact Person</h3>
                    </div>
                    <div class="box-body table-hidden">
                        <table id="list_cp" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                       <th align="left"><strong>No</strong></th>
                                        <th align="left"><strong>Name</strong></th>
                                        <th align="left"><strong>Phone</strong></th>
                                        <th align="left"><strong>Mobile</strong></th>
                                        <th align="left"><strong>Email Address</strong></th>
                                        <th align="left"><strong>Fax No.</strong></th>
                                    </tr>
                                    </thead>
                                </table>
                    </div>
                    <div class="box-header table-hidden">
                        <h3 class="box-title">Services</h3>
                    </div>
                    <div class="box-body table-hidden">
                         <div class="row">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Service Setup</label>
                                    <div class="col-md-6">
                                        <label id="servicePackageName">-</label>
                                    </div>
                                </div>
                            </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Special Limit</label>
                                <div class="col-md-6">
                                    <label id="specialLimitFlag">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Special Fee</label>
                                <div class="col-md-6">
                                    <label id="specialChargeFlag">-</label>
                                </div>
                            </div>
                        </div>
                            <div class="row">
                                <div class="form-group">
                                <label class="col-md-3 control-label">Corporate SME</label>
                                <div class="col-md-6">
                                    <label id="smeFlag">-</label>
                                </div>
                            </div>
                        </div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Maximum Number of User</label>
                                    <div class="col-md-6">
                                        <label id="maxCorporateUser">-</label>
                                    </div>
                                </div>
                            </div>

                            
                    </div>
                    
                    <div class="box-header table-hidden">
                        <h3 class="box-title">Corporate Admin</h3>
                    </div>
                    <div class="box-body table-hidden">
                        <div class="form-group">
                                <label class="col-md-3 control-label">OutsourceAdmin</label>
                                <div class="col-md-6">
                                    <label id="outsourceAdminFlag">-</label>
                                </div>
                            </div>

                        <table id="list_admin" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                               style="border-collapse:collapse;">
                            <thead>
                            <tr>
                                <th align="left"><strong>Role</strong></th>
                                <th align="left"><strong>User ID</strong></th>
                                <th align="left"><strong>User Name</strong></th>
                                <th align="left"><strong>Email Address</strong></th>
                                <th align="left"><strong>Mobile Phone</strong></th>
                                <th align="left"><strong>Authentication</strong></th>
                                <th align="left"><strong>Serial Number</strong></th>
                                <th align="left"><strong>Reset Password</strong></th>
                                <th align="left"><strong>Lock/Unlock</strong></th>
                            </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="box-footer">
                        <div class="col-md-12 state_success text-center">
                            <button type="button" id="back_view" name="back_view" class="btn btn-default back float-left">@lang('form.done')</button>
                        </div>
                        <div class="col-md-12 state_update text-center">
                            <button type="button" id="back_update" name="back_update" class="btn btn-default float-left">@lang('form.back')</button>
                            <button type="button" id="confirm" name="confirm" class="btn btn-primary float-right ">@lang('form.confirm')</button>
                        </div>
                       <div class="state_normal">
                               <div class="float-left">
                                    <button type="button" id="back" name="back" class="btn btn-default back">@lang('form.back')</button>
                                    <button type="button" id="save_screen" name="save_screen" class="btn btn-default" style="display:none" onclick="save_pdf();">@lang('form.save_pdf')</button>
                               </div>
                               <div class="float-right">
                                   <button type="button" id="delete" name="delete" class="btn btn-danger">@lang('form.delete')</button>
                                    <button type="button" id="update_status" name="update_status" class="btn btn-primary">Update Status</button>
                                    <button type="button" id="edit" name="edit" class="btn btn-primary">@lang('form.edit')</button>
                                    <button type="button" id="next_user" name="next_user" class="btn btn-info">@lang('form.next_user')</button>
                                    <button type="button" id="done" name="done" class="btn btn-primary back">@lang('form.done')</button>
                               </div>
                       </div>
                   </div>
                   @include('_partials.next_user')
            </div>
        </div>
    </div>

</section>


<script>
    var oTable_cp;
    var oTable_token;
    var oTable_admin;
    var data_detail;
    var noRef = '';
    var id = '{{ $service }}';

    $(document).ready(function () {
        $('.auth-device').hide();
        $('.state_delete').hide();
        $('#next_user').hide();
        $('#done').hide();
        $('#inactiveFlag').select2({ width: '100%' });
        stateNormal();

        $('#form-area').validator().on('submit', function (e) {
            if (e.isDefaultPrevented()) {
                // handle the invalid form...
            } else {
                // everything looks good!
                console.log('valid')
            }
        });

        oTable_cp = $('#list_cp').DataTable({
            "paging" : false,
            "ordering" : false,
            "info": false,
            "destroy": true,
            "searching": false,
            "autoWidth":false,
            "lengthMenu": [[10, 25, 50], [10, 25, 50]],
            "columnDefs": [
                {
                    targets: 0,
                    sortable: true,
                    width: "5%"
                },
                {
                    targets: 1,
                    sortable: true,
                    width: "15%"
                },
                {
                    targets: 2,
                    sortable: true,
                    width: "20%"
                },
                {
                    targets: 3,
                    sortable: true,
                    width: "15%"
                },
                {
                    targets: 4,
                    sortable: true,
                    width: "30%"
                },
                {
                    targets: 5,
                    sortable: true,
                    width: "15%"
                }
            ]
        });

        oTable_token = $('#list_token').DataTable({
            "paging" : false,
            "ordering" : false,
            "info": false,
            "destroy": true,
            "searching": false,
            "autoWidth":false,
            "lengthMenu": [[10, 25, 50], [10, 25, 50]],
            "columnDefs": [
                {
                    targets: 0,
                    sortable: true,
                    width: "100%"
                }
            ],
            "drawCallback": function( settings ) {
                tokenCount();
            }
        });

        oTable_admin = $('#list_admin').DataTable({
            "paging" : false,
            "ordering" : false,
            "info": false,
            "destroy": true,
            "searching": false,
            "autoWidth":false,
            "lengthMenu": [[10, 25, 50], [10, 25, 50]],
            "columnDefs": [
                {
                    targets: 0,
                    sortable: true,
                    width: "15%"
                },
                {
                    targets: 1,
                    sortable: true,
                    width: "10%"
                },
                {
                    targets: 2,
                    sortable: true,
                    width: "10%"
                },
                {
                    targets: 3,
                    sortable: true,
                    width: "20%"
                },
                {
                    targets: 4,
                    sortable: true,
                    width: "10%"
                },
                {
                    targets: 5,
                    sortable: true,
                    width: "10%"
                },
                {
                    targets: 6,
                    sortable: true,
                    width: "10%"
                },
                {
                    targets: 7,
                    sortable: false,
                    width: "10%"
                },
                {
                    targets: 8,
                    sortable: false,
                    width: "10%"
                }
            ]
        });

        $('#update_status').on('click', function () {
           stateUpdateStatus();
        });

        $('#confirm').on('click', function () {
            $('#form-area').validator('validate');
            setTimeout(function(){
                if($('#form-area').validator('validate').has('.has-error').length==0){
                    $(this).prop('disabled',true);
                    $.confirm({
                        title: '{{trans('form.submit')}}',
                        content: 'Update Status Corporate?',
                        buttons: {

                            cancel: {
                                text: '{{trans('form.cancel')}}',
                                btnClass: 'btn-default',
                                action: function(){
                                    $('#confirm').prop('disabled',false);
                                }
                            },

                            confirm: {
                                text: '{{trans('form.confirm')}}',
                                btnClass: 'btn-primary',
                                action: function(){
                                    updateStatus($('#code').val(),$('#corporateName').text());
                                }
                            }

                        }
                    });
                }
            });


        });


        $('#edit').on('click', function () {
            var submit_data = getTableData();
            var code = $('#code').val();
            var corporate = $('#corporateId').text();
            var cifid = $('#cifid').text();
            var name = $('#name').val();

            var countryCode = $('#countryCode').val();
            var stateCode = $('#stateCode').val();
            var substateCode = $('#substateCode').val();
            var outsourceAdminFlag = $('#outsourceAdminFlag').text();
           
            var res = app.setView(id,'add');
            if(res=='done'){
                $('#type').val('edit');
                $('#breadcrumb-action').html('edit');
                $('#code_edit').val(corporate);
                $('#name').val(name);
                getDataEdit(corporate,name,countryCode,stateCode,substateCode,outsourceAdminFlag);
            }
        });

        $('#delete').on('click', function () {

            $(this).prop('disabled',true);
            $.confirm({
                title: '{{trans('form.delete')}}',
                content: '{{trans('form.confirm_delete')}}',
                buttons: {
                    
                    cancel: {
                        text: '{{trans('form.cancel')}}',
                        btnClass: 'btn-default',
                        action: function(){
                            $('#delete').prop('disabled',false);
                        }
                    },
                    confirm: {
                        text: '{{trans('form.delete')}}',
                        btnClass: 'btn-primary',
                        action: function(){
                            submit_delete();
                        }
                    }

                }
            });
        });

        function submit_delete () {
            var submit_data = data_detail;
            //console.log(submit_data);
            //return;
            var value = {
                "corporateId": $('#code').val(),
                "name": $('#name').val(),
                "cifId": $('#cifid').text()
            };
            $.extend(value,submit_data);

            $.ajax({
                url: 'delete',
                method: 'post',
                data: {"_token": "{{ csrf_token() }}", menu: id, value: value,url_action:'submitDelete'},
                success: function (data) {
                    $('#delete').prop('disabled',false);
                    var result = JSON.parse(data);
                    if (result.status=="200") {
                        flash('success', result.message+'<br>'+'ReferenceNo: '+ result.referenceNo+'<br>'+result.dateTimeInfo);
                        noRef = result.referenceNo;
                        $('#submit_view').hide();
                        $('#edit').hide();
                        $('#delete').hide();
                        $('#update_status').hide();
                        $('#save_screen').show();
                        // $('#back').html('{{trans('form.done')}}');
                        $('#back').hide();

                        $('#next_user').show();
                        $('#done').show();
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

        $('#back_update').on('click', function () {
            stateNormal();
        });

        $('.back').on('click', function () {
           var res = app.setView(id,'landing');
        });
        $('div.dt-buttons').css('float','right');
        $('a.dt-button').addClass('btn btn-primary');


    });



    function getData(code,name){
        $('#code').val(code);
        $('#name').val(name);
        var value = {
            corporateId: code,
            name: "",
            currentPage: "1",
            pageSize: "20",
            orderBy: {"id": "ASC"}
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
                if (result.status=="200") {
                    var index = result.result.map(function(o) { return o.corporateId; }).indexOf(code.toString());

                    var detail = result.result;
                    data_detail = detail[index];

                    var contactList = detail[index].contactList;
                    var adminList = detail[index].adminList;
                    var spesial_limit = detail[index].specialLimitFlag;
                    var outsource_admin = detail[index].outsourceAdminFlag;
                    var spesial_charge = detail[index].specialChargeFlag;
                    var isSME = detail[index].smeFlag;

                    if(spesial_limit=='Y'){
                        spesial_limit='Yes'
                    }
                    if(spesial_limit=='N'){
                        spesial_limit='No'
                    }
                    if(spesial_charge=='Y'){
                        spesial_charge='Yes'
                    }
                    if(spesial_charge=='N'){
                        spesial_charge='No'
                    }
                    if(isSME=='Y'){
                        isSME='Yes'
                    }
                    if(isSME=='N'){
                        isSME='No'
                    }

                    if(outsource_admin=='Y'){
                        outsource_admin='Yes';
                        $('#list_admin').hide();
                    }
                    if(outsource_admin=='N'){
                        outsource_admin='No';
                         $('#list_admin').show();
                    }

                    $('#cifid').text(detail[index].cifId);
                    $('#corporateId').text(detail[index].corporateId);
                    $('#corporateName').text(name);
                    $('#address1').text(detail[index].address1);
                    $('#address2').text(detail[index].address2);
                    $('#address3').text(detail[index].address3);
                    $('#postcode').text(detail[index].postcode);
                    $('#cityName').text(detail[index].cityName);
                    $('#substateCode').val(detail[index].substateCode);
                    $('#substateName').text(detail[index].substateName);
                    $('#stateCode').val(detail[index].stateCode);
                    $('#stateName').text(detail[index].stateName);
                    $('#countryCode').val(detail[index].countryCode);
                    $('#countryName').text(detail[index].countryName);
                    $('#email1').text(detail[index].email1);
                    $('#email2').text(detail[index].email2);
                    $('#phoneNo').text(detail[index].phoneNo);
                    $('#extNo').text(detail[index].extNo);
                    $('#faxNo').text(detail[index].faxNo);
                    $('#servicingBranch').text(detail[index].branchCode +' - '+detail[index].branchName);
                    $('#industrySegmentName').text(detail[index].industrySegmentName);
                    $('#businessUnitName').text(detail[index].businessUnitName);
                    $('#taxIdNo').text(detail[index].taxIdNo);
                    $('#maxCorporateUser').text(detail[index].maxCorporateUser);
                    $('#servicePackageName').text(detail[index].servicePackageName);
                    $('#specialLimitFlag').text(spesial_limit);
                    $('#outsourceAdminFlag').text(outsource_admin);
                    $('#specialChargeFlag').text(spesial_charge);
                    $('#smeFlag').text(isSME);
                    $('#handlingOfficer').text(detail[index].handlingOfficerCode+' - '+detail[index].handlingOfficerName);
                    var residentialStatus = (detail[index].lldIsResidence=='Y'? 'Resident' : 'Non Resident, '+detail[index].residenceCountryName);
                    var citizenship = (detail[index].lldIsCitizen=='Y'? 'Citizen' : 'Non Citizen, '+detail[index].citizenCountryName);
                    data_detail.isResidenceText= residentialStatus;
                    data_detail.isCitizenText= citizenship;
                    data_detail.isCategoryText= detail[index].lldCategoryName;
                    $('#residentialStatus').text(residentialStatus);
                    $('#citizenship').text(citizenship);
                    $('#remitterType').text(detail[index].lldCategoryName);
                    $('#status').text((detail[index].inactiveFlag=="N"?"Active":"Inactive"));
                    $('#inActiveFlag').val(detail[index].inactiveFlag).trigger('change');
                    oTable_cp.clear();
                    if(contactList){
                    var cp_count = 1;
                    $.each(contactList, function (idx, obj){
                        oTable_cp.row.add([
                            cp_count,
                            obj.name,
                            obj.phoneNo,
                            obj.mobileNo,
                            obj.email,
                            obj.faxNo
                        ]).draw(true);
                        cp_count++;
                    });
                    }
                    oTable_admin.clear();
                    if(adminList){
                    $.each(adminList, function (idx, obj){
                        var lock_caption = '';
                        var lock_style = 'btn-default';
                        if(obj.status=='ACTIVE'){
                            lock_caption = 'LOCK';
                            //lock_style = 'btn-danger';
                        }else if(obj.status=='LOCKED'){
                            lock_caption = 'UNLOCK';
                            //lock_style = 'btn-primary';
                        }
                        oTable_admin.row.add([
                            obj.role,
                            obj.userId,
                            obj.name,
                            obj.email,
                            obj.mobileNo,
                            (obj.tokenType=="TKN"?'Hard Token':'-'),
                            (obj.tokenNo === undefined || obj.tokenNo === null?'-':obj.tokenNo),
                            '<button id="" class="btn btn-default reset_password" onClick="resetConfirm(\''+obj.userId+'\');">Reset Password</button>',
                            '<button id="lock-'+obj.userId+'" class="btn '+lock_style+'" onClick="lockUnlockConfirm(\''+obj.userId+'\',\''+obj.status+'\');">'+lock_caption+'</button>',
                        ]).draw(true);
                        cp_count++;
                    });
                        console.log(data_detail);
                    }
                } else {
                    flash('warning', result.message);
                }


            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '{{trans('form.conn_error')}}';
                flash('warning', msg);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            },
            complete: function(data) {

            }
        });
    }

    function lockUnlockConfirm(userId,status){
        var content ='';
        var lock_caption = '';
        if(status=='ACTIVE'){
            lock_caption = 'LOCK User Admin';
            content ='{{trans('form.user_msg_lock',['user'=>'$user','lock'=>'Lock'])}}';
        }else if(status=='LOCKED'){
            lock_caption = 'UNLOCK User Admin';
            content ='{{trans('form.user_msg_lock',['user'=>'$user','lock'=>'Unlock'])}}';
        }

        $.confirm({
            title: lock_caption,
            content: content.replace('$user',userId),
            buttons: {
                cancel: {
                    text: '{{trans('form.cancel')}}',
                    btnClass: 'btn-default',
                    action: function(){

                    }
                },
                confirm: {
                    text: '{{trans('form.confirm')}}',
                    btnClass: 'btn-primary',
                    action: function(){
                        lockUnlock(userId,status)
                    }
                }
            }
        });
    }

    function resetConfirm(userId){
        var content ='{{trans('form.user_msg_reset',['user'=>'$user'])}}';

        $.confirm({
            title: 'Reset password',
            content: content.replace('$user',userId),
            buttons: {
                cancel: {
                    text: '{{trans('form.cancel')}}',
                    btnClass: 'btn-default',
                    action: function(){

                    }
                },
                confirm: {
                    text: '{{trans('form.confirm')}}',
                    btnClass: 'btn-primary',
                    action: function(){
                        resetPassword(userId)
                    }
                }
            }
        });
    }

    function tokenCount(){
        if(oTable_token !== undefined)
            var token_count = oTable_token.data().count();
        $('#tokenNum').text(token_count);
    }

    function lockUnlock(userId,status) {

        var value = {
            userId: userId,
            corporateId: $('#code').val()
        };
        var url_action = '';
        var action = '';
        if(status=='ACTIVE'){
            url_action = 'lockUser';
            action ='LOCK';
        }else if(status=='LOCKED'){
            url_action = 'unlockUser';
            action ='UNLOCK';
        }
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data: {
                value : value,
                menu : 'MNU_GPCASH_CORP',
                url_action : url_action,
                action : action,
                _token : '{{ csrf_token() }}'
            },
            success: function (data) {
                var result = JSON.parse(data);
                if (result.status=="200") {
                    flash('success', result.message);
                } else {
                    flash('warning', result.message);
                }


            }, error: function (xhr, ajaxOptions, thrownError) {
                flash('warning', 'Submit Failed');
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {
                $('#lock-'+userId).prop('disabled',true);
            }
        });
    }


    function resetPassword(userId) {

        var value = {
            userId: userId,
            corporateId: $('#code').val()
        };
        var url_action = 'resetUser';
        var action = 'RESET';
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data: {
                value : value,
                menu : 'MNU_GPCASH_CORP',
                url_action : url_action,
                action : action,
                _token : '{{ csrf_token() }}'
            },
            success: function (data) {
                var result = JSON.parse(data);
                if (result.status=="200") {
                    flash('success', result.message);
                } else {
                    flash('warning', result.message);
                }


            }, error: function (xhr, ajaxOptions, thrownError) {
                flash('warning', 'Submit Failed');
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {

            }
        });
    }

    function updateStatus(corporateId,name) {

        var value = {
            corporateId: corporateId,
            name:name,
            inactiveFlag: $('#inActiveFlag').val(),
            inactiveReason: $('#inactiveReason').val()
        };
        var url_action = 'updateStatusCorporate';
        var action = 'UPDATE_STATUS';
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data: {
                value : value,
                menu : 'MNU_GPCASH_CORP',
                url_action : url_action,
                action : action,
                _token : '{{ csrf_token() }}'
            },
            success: function (data) {
                var result = JSON.parse(data);
                if (result.status=="200") {
                    flash('success', result.message);
                    $('#confirm').prop('disabled',false);
                    $('#inActiveFlag').prop('disabled','disabled');
                    $('#inactiveReason').attr('readonly','readonly');
                    $('#confirm').hide();
                    $('#back_update').hide();
                    $('.state_success').show();
                } else {
                    flash('warning', result.message);
                }


            }, error: function (xhr, ajaxOptions, thrownError) {
                flash('warning', 'Submit Failed');
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {

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
            var accountNo = $('td:eq(3)', $(this)).find('#accountNo').val();
            var accountName = $('td:eq(3)', $(this)).find('#accountName').val();
            var accountCurrencyCode = $('td:eq(4)', $(this)).find('#accountCurrencyCode').val();
            var isAllowInquiry = $('td:eq(6)', $(this)).find('#isAllowInquiry').val();
            var isAllowDebit = $('td:eq(7)', $(this)).find('#isAllowDebit').val();
            var isAllowCredit = $('td:eq(8)', $(this)).find('#isAllowCredit').val();
            var isInactiveFlag = ($('td:eq(9)', $(this)).children().text()=="Active" ? 'N' : 'Y');
            var accountTypeCode = $('td:eq(5)', $(this)).find('#accountTypeCode').val();
            var accountTypeName = $('td:eq(5)', $(this)).find('#accountTypeName').val();
            var accountBranchCode = $('td:eq(5)', $(this)).find('#accountBranchCode').val();
            var cifId = $('td:eq(3)', $(this)).find('#cifId').val();
            var obj = {
                accountNo: accountNo,
                accountName: accountName,
                accountCurrencyCode:accountCurrencyCode,
                isAllowInquiry:isAllowInquiry,
                isAllowDebit:isAllowDebit,
                isAllowCredit:isAllowCredit,
                isInactiveFlag:isInactiveFlag,
                accountTypeCode:accountTypeCode,
                accountBranchCode:accountBranchCode,
                accountTypeName:accountTypeName,
                cifId:cifId
            };
            if (check == 1) {
                data.push(obj);
            }
        });
        return data;
    }
    function stateNormal(){

        $('.table-hidden').show();
        $('.reason').hide();
        $('.state_success').hide();
        $('.state_update').hide();
        $('.state_normal').show();
    }
    function stateUpdateStatus() {
       $('.table-hidden').hide();

        $('.reason').show();
        $('.state_success').hide();
        $('.state_update').show();
        $('.state_normal').hide();
    }




</script>