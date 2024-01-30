
@include('_partials.header_content',['breadcrumb'=>[ str_replace('-',' ',$menu),$type ]])

<section class="content">

    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div id="print" class="box">

                <form id="form-area" class="form-horizontal form-area">
                    <input type="hidden" id="code_edit" value=""/>
                    <input type="hidden" id="type" value=""/>
                    <input type="hidden" id="state" value=""/>

                    <input type="hidden" id="maker_userId_edit" value=""/>
                    <input type="hidden" id="maker_name_edit" value=""/>
                    <input type="hidden" id="maker_email_edit" value=""/>
                    <input type="hidden" id="maker_mobileNo_edit" value=""/>
                    <input type="hidden" id="approver_userId_edit" value=""/>
                    <input type="hidden" id="approver_name_edit" value=""/>
                    <input type="hidden" id="approver_email_edit" value=""/>
                    <input type="hidden" id="approver_mobileNo_edit" value=""/>


                    <div id="exTab" class="">

                        <ul class="nav nav-tabs state_edit">
                            <li class="active">
                                <a href="#tab_detail" data-toggle="tab">Corporate Detail</a>
                            </li>
                            <li><a href="#tab_services" data-toggle="tab">Services</a>
                            <li><a href="#tab_admin" data-toggle="tab">Corporate Admin</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_detail">
                                <div class="box-header state_view" style="display:none;">
                                    <h3 class="box-title">Corporate Detail</h3><br>
                                </div>
                                <div class="box-body">  
                                        <div class="form-group corporate_filter">
                                            <label class="col-md-3 control-label"><strong>Corporate - CIF</strong></label>
                                            <div class="col-md-5">
                                                <div class="form-inline">
                                                    <input type="text" id="cifid_filter" name="cifid_filter" class="form-control state_edit" autocomplete="off" value="">
                                                    <label id="cifid_filter_view" class="state_view">-</label>
                                                    <span class="form-control-feedback"></span>
                                                    <button type="button" id="cifid_search" name="cifid_search" class="btn btn-default">Load Corporate Detail</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">CIF</label>
                                            <div class="col-md-5">
                                                <div class="form-inline">
                                                    <input type="text" id="cifid" name="cifid" class="form-control state_edit" autocomplete="off" value="" readonly>
                                                    <label id="cifid_view" class="state_view">-</label>
                                                    <span class="form-control-feedback"></span>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><strong>Corporate Id&ast;</strong></label>
                                            <div class="col-md-5">
                                                <input type="text" id="corporateId" name="corporateId" class="form-control state_edit detail" autocomplete="off" value="" maxlength="20" data-error="This field is required." required>
                                                <div class="help-block with-errors"></div>
                                                <label id="corporateId_view" class="state_view">-</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><strong>Corporate Name&ast;</strong></label>
                                            <div class="col-md-5">
                                                <input type="text" id="corporateName" name="corporateName" class="form-control state_edit detail" autocomplete="off" value="" maxlength="100" data-error="This field is required." required>
                                                <div class="help-block with-errors"></div>
                                                <label id="corporateName_view" class="state_view">-</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><strong>Address&ast;</strong></label>
                                            <div class="col-md-5">
                                                <input type="text" id="address1" name="address1" class="form-control state_edit detail" autocomplete="off" value="" maxlength="100" data-error="This field is required." required>
                                                <div class="help-block with-errors"></div>
                                                <label id="address1_view" class="state_view">-</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"></label>
                                            <div class="col-md-5">
                                                <input type="text" id="address2" name="address2" class="form-control state_edit" autocomplete="off" value="" maxlength="100">

                                                <label id="address2_view" class="state_view">-</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"></label>
                                            <div class="col-md-5">
                                                <input type="text" id="address3" name="address3" class="form-control state_edit" autocomplete="off" value="" maxlength="100">
                                                <label id="address3_view" class="state_view">-</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><strong>Country&ast;</strong></label>
                                            <div class="col-md-5">
                                                <div class="state_edit">
                                                    <select class="form-control state_edit detail" id="country" data-error="This field is required." onchange="getDroplist('country')" required>
                                                        <option></option>
                                                    </select>
                                                </div>
                                                <div class="help-block with-errors"></div>
                                                <label id="country_view" class="state_view">-</label>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><strong>State&ast;</strong></label>
                                            <div class="col-md-5">
                                                <div class="state_edit">
                                                    <select class="form-control state_edit detail" id="states" data-error="This field is required." onchange="getDroplist('state')" required>
                                                        <option></option>
                                                    </select>
                                                </div>
                                                <div class="help-block with-errors"></div>
                                                <label id="states_view" class="state_view">-</label>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><strong>Substate&ast;</strong></label>
                                            <div class="col-md-5">
                                                <div class="state_edit">
                                                    <select class="form-control state_edit detail" id="substate" data-error="This field is required." onchange="getDroplist('substate')" required>
                                                        <option></option>
                                                    </select>
                                                </div>
                                                <div class="help-block with-errors"></div>
                                                <label id="substate_view" class="state_view">-</label>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><strong>City&ast;</strong></label>
                                            <div class="col-md-5">
                                                <div class="state_edit">
                                                    <select class="form-control state_edit detail" id="city" data-error="This field is required." required>
                                                        <option></option>
                                                    </select>
                                                </div>
                                                <div class="help-block with-errors"></div>
                                                <label id="city_view" class="state_view">-</label>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><strong>Post Code&ast;</strong></label>
                                            <div class="col-md-5">
                                                <div class="state_edit">
                                                <select class="form-control state_edit detail" id="postcode" data-error="This field is required." required>
                                                    <option></option>
                                                </select>
                                                </div>
                                                <div class="help-block with-errors"></div>
                                                <label id="postcode_view" class="state_view">-</label>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><strong>Email Address&ast;</strong></label>
                                            <div class="col-md-5">
                                                <input type="email" id="email1" name="email1" class="form-control state_edit detail" autocomplete="off" value="" maxlength="100" data-error="Invalid Email Address." required>
                                                <div class="help-block with-errors"></div>
                                                <label id="email1_view" class="state_view">-</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Alternate Email Address</label>
                                            <div class="col-md-5">
                                                <input type="email" id="email2" name="email2" class="form-control state_edit" autocomplete="off" maxlength="100" data-error="Invalid Email Address." value="">
                                                <div class="help-block with-errors"></div>
                                                <label id="email2_view" class="state_view">-</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><strong>Phone No.&ast;</strong></label>
                                            <div class="col-md-3">
                                                <input type="text" id="phoneNo" name="phoneNo" class="form-control state_edit detail numeric phone" autocomplete="off" value="" maxlength="40" data-error="This field is required." required>
                                                <div class="help-block with-errors"></div>
                                                <label id="phoneNo_view" class="state_view numeric phone">-</label>
                                            </div>
                                            <label class="col-md-2 control-label">Ext No.</label>
                                            <div class="col-md-2">
                                                <input type="text" id="extNo" name="extNo" class="form-control state_edit" autocomplete="off" value="" maxlength="40">
                                                <label id="extNo_view" class="state_view numeric phone">-</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Fax No.</label>
                                            <div class="col-md-5">
                                                <input type="text" id="faxNo" name="faxNo" class="form-control state_edit numeric phone" autocomplete="off" value="" maxlength="40">
                                                <label id="faxNo_view" class="state_view numeric phone">-</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        <label class="col-md-3 control-label"><strong>Servicing Branch&ast;</strong></label>
                                        <div class="col-md-5">
                                            <div class="state_edit">
                                                <select class="form-control state_edit detail" id="branch" data-error="This field is required." required>
                                                    <option></option>
                                                </select>
                                            </div>
                                            <div class="help-block with-errors"></div>
                                            <label id="branch_view" class="state_view">-</label>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Industry Segment</label>
                                            <div class="col-md-5">
                                                <div class="state_edit">
                                                    <select class="form-control state_edit" id="industrySegment">
                                                        <option></option>
                                                    </select>
                                                </div>
                                                <label id="industrySegment_view" class="state_view">-</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Business Unit</label>
                                            <div class="col-md-5">
                                                <div class="state_edit">
                                                    <select class="form-control state_edit" id="businessUnit">
                                                        <option></option>
                                                    </select>
                                                </div>
                                                <label id="businessUnit_view" class="state_view">-</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><strong>Tax ID&ast;</strong></label>
                                            <div class="col-md-5">
                                                <input type="text" id="taxId" name="taxId" class="form-control state_edit detail" autocomplete="off" value="" maxlength="40" data-error="This field is required." required>
                                                <div class="help-block with-errors"></div>
                                                <label id="taxId_view" class="state_view">-</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Handling Officer</label>
                                            <div class="col-md-5">
                                                <div class="state_edit">
                                                    <select class="form-control state_edit" id="handlingOfficer">
                                                        <option></option>
                                                    </select>
                                                </div>
                                                <div class="help-block with-errors"></div>
                                                <label id="handlingOfficer_view" class="state_view">-</label>
                                            </div>
                                        </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Residential Status</label>
                                        <div class="col-md-5">
                                            <div class="state_edit">
                                                <input type="radio" id="resident-rb" name="resident-rb" value="0" checked>
                                                <label for="resident-rb">Resident</label>
                                            </div>
                                            <div class="help-block with-errors"></div>
                                            <label id="residential_view" class="state_view"></label>
                                        </div>
                                    </div>
                                    <div class="form-group state_edit">
                                        <label class="col-md-3 control-label"></label>
                                        <div class="col-md-6">
                                            <div class="state_edit">
                                                <div class="col-md-4 form-inline" style="padding-left: 0px;padding-right: 0px;">
                                                <input class="state_edit" type="radio" id="nonresident-rb" name="resident-rb" value="1">
                                                <label for="nonresident-rb">Non Resident</label>
                                                </div>
                                                <div id="resident_container" class="col-md-6 form-inline" style="padding-left: 0px;padding-right: 0px;display:none;">
                                                <select class="form-control state_edit" id="residential" style="width:100%;">
                                                    <option></option>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="help-block with-errors"></div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Citizenship</label>
                                        <div class="col-md-5">
                                            <div class="state_edit">
                                                <input type="radio" id="citizen-rb" name="citizen-rb" value="0" checked>
                                                <label for="citizen-rb">Citizen</label>
                                            </div>
                                            <div class="help-block with-errors"></div>
                                            <label id="citizenship_view" class="state_view"></label>
                                        </div>
                                    </div>
                                    <div class="form-group state_edit">
                                        <label class="col-md-3 control-label"></label>
                                        <div class="col-md-6">
                                            <div class="state_edit">
                                                <div class="col-md-4 form-inline" style="padding-left: 0px;padding-right: 0px;">
                                                    <input class="state_edit" type="radio" id="noncitizen-rb" name="citizen-rb" value="1">
                                                    <label for="noncitizen-rb">Non Citizen</label>
                                                </div>
                                                <div id="citizenship_container" class="col-md-6 form-inline" style="padding-left: 0px;padding-right: 0px;display:none;">
                                                    <select class="form-control state_edit" id="citizenship" style="width:100%;">
                                                        <option></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Remitter Type</label>
                                        <div class="col-md-5">
                                            <div class="state_edit">
                                                <select class="form-control state_edit" id="remitterType">
                                                    <option></option>
                                                </select>
                                            </div>
                                            <div class="help-block with-errors"></div>
                                            <label id="remitterType_view" class="state_view">-</label>
                                        </div>
                                    </div>
                                        <div class="form-group">
                                                <label class="col-md-3 control-label">Status</label>
                                                <div class="col-md-5">
                                                    <label id="status">-</label>
                                                </div>
                                        </div>


                                </div>
                                <div class="box-header">
                                    <h3 class="box-title table-hidden">Contact Person</h3>
                                </div>
                                <div class="box-body">
                                    <table id="list_cp" class="table table-bordered dataTable" border="2" cellpadding="2"
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
                                <div class="state_view">
                                    <div class="box-header auth-device">
                                        <h3 class="box-title">Service</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Service Setup</label>
                                                <div class="col-md-5">
                                                    <label id="servicePackageName">-</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Special Limit</label>
                                                <div class="col-md-5">
                                                    <label id="specialLimitFlag_view">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Special Fee</label>
                                                <div class="col-md-5">
                                                    <label id="specialChargeFlag_view">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Corporate SME</label>
                                                <div class="col-md-5">
                                                    <label id="smeFlag_view">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row token-list">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Default Approval Matrix</label>
                                                <div class="col-md-5">
                                                    <label id="defAppMatrixFlag_view">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Maximum Number of User</label>
                                                <div class="col-md-5">
                                                    <label id="maxCorporateUser">-</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-header auth-device token-list">
                                        <h3 class="box-title">Authentication Device</h3>
                                    </div>
                                    <div class="box-body auth-device token-list">
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Authentication Device Type</label>
                                                <div class="col-md-5">
                                                    <label id="tokenType_view">Hard Token</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-md-3 control-label"></label>
                                            <div class="col-md-5">
                                                <table id="list_token_view" class="table table-bordered table-striped dataTable float-left" border="2" cellpadding="2"
                                                       style="border-collapse:collapse;">
                                                    <thead>
                                                    <tr>
                                                        <th align="left"><strong>Serial Number</strong></th>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Total Number of Token</label>
                                                <div class="col-md-5">
                                                    <label id="tokenNum_view">-</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-header">
                                        <h3 class="box-title table-hidden">Corporate Admin</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label class="col-md-2 ">Outsource Admin</label>
                                            <div class="col-md-6">
                                                <label id="outsourceAdminFlag_view">No</label>
                                            </div>
                                        </div>

                                        <table id="list_admin_view" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
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
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_services">
                                <div class="container-fluid box-body">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><strong>Service Setup&ast;</strong></label>
                                            <div class="col-md-5">
                                                <select class="form-control state_edit" id="servicePackage" data-error="This field is required." required>
                                                </select>
                                            </div>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Special Limit</label>
                                            <div class="col-md-6">
                                                <div class="state_edit">
                                                    <input type="checkbox" id="specialLimitFlag" name="specialLimitFlag" value="Yes"/>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Special Fee</label>
                                            <div class="col-md-6">
                                                <div class="state_edit">
                                                    <input type="checkbox" id="specialChargeFlag" name="specialChargeFlag" value="Yes"/>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Corporate SME</label>
                                            <div class="col-md-6">
                                                <div class="state_edit">
                                                    <input type="checkbox" id="smeFlag" name="smeFlag" value="Yes"/>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group token-list">
                                            <label class="col-md-3 control-label">Default Approval Matrix</label>
                                            <div class="col-md-6">
                                                <div class="state_edit">
                                                    <input type="checkbox" id="defAppMatrixFlag" name="defAppMatrixFlag" value="Yes"/>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><strong>Maximum Number of User&ast;</strong></label>
                                            <div class="col-md-5">
                                                <input type="text" id="maximumUser" name="maximumUser" class="form-control state_edit numeric" autocomplete="off" value="999999999" maxlength="9" data-error="This field is required." required>
                                                <div class="help-block with-errors"></div>
                                                <label id="maximumUser_view" class="state_view">-</label>
                                            </div>
                                        </div>

                                        <div class="box-header auth-device token-list">
                                            <h3 class="box-title">Authentication Device</h3>
                                        </div>
                                        <div class="box-body auth-device token-list">
                                            <div class="row">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Authentication Device Type</label>
                                                    <div class="col-md-6">
                                                        <label id="tokenType">Hard Token</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Serial Number</label>
                                                    <div class="col-md-6 form-inline">
                                                        <input type="text" id="serialNumber" name="serialNumber" class="form-control state_edit" autocomplete="off" value="" maxlength="40">
                                                        <button type="button" id="serialNumber_add" name="serialNumber_add" class="btn btn-default">Add to List</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                    <label class="col-md-3 control-label"></label>
                                                    <div class="col-md-6">
                                                    <table id="list_token" class="table table-bordered table-striped dataTable float-left" border="2" cellpadding="2"
                                                       style="border-collapse:collapse;">
                                                    <thead>
                                                    <tr>
                                                        <th align="left"><strong>Serial Number</strong></th>
                                                        <th align="left"></th>
                                                    </tr>
                                                    </thead>
                                                    </table>
                                                    </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Total Number of Token</label>
                                                    <div class="col-md-6">
                                                        <label id="tokenNum">-</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="tab-pane" id="tab_admin">
                                <div class="container-fluid box-body">
                                    <div class="col-xs-12">
                                        
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label class="col-md-2 ">Outsource Admin</label>
                                                <div class="col-md-6">
                                                    <div class="state_edit">
                                                        <input type="checkbox" id="outsourceAdminFlag" name="outsourceAdminFlag"  value="Yes"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <table id="list_admin" class="table table-bordered dataTable" border="2" cellpadding="2"
                                                   style="border-collapse:collapse;">
                                                <thead>
                                                <tr>
                                                    <th align="left"><strong>Role</strong></th>
                                                    <th align="left"><strong>User ID*</strong></th>
                                                    <th align="left"><strong>User Name*</strong></th>
                                                    <th align="left"><strong>Email Address*</strong></th>
                                                    <th align="left"><strong>Mobile Phone*</strong></th>
                                                    <th align="left"><strong>Authentication</strong></th>
                                                    <th align="left"><strong>Serial Number</strong></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>Admin Maker</td>
                                                    <td><div class="form-group maker" style="margin: 0"><input type="text" id="maker_userId" class="form-control state_edit" style="width: 100%;" maxlength="20" data-error="This field is required." required><div class="help-block with-errors"></div></div></td>
                                                    <td><div class="form-group maker" style="margin: 0"><input type="text" id="maker_name" class="form-control state_edit" style="width: 100%;" maxlength="100" data-error="This field is required." required><div class="help-block with-errors"></div></div></td>
                                                    <td><div class="form-group maker" style="margin: 0"><input type="email" id="maker_email" class="form-control state_edit" style="width: 100%;" maxlength="100" data-error="This field is invalid." required><div class="help-block with-errors"></div></div></td>
                                                    <td><div class="form-group approver" style="margin: 0"><input type="text" id="maker_mobileNo" class="form-control state_edit numeric phone" style="width: 100%;" maxlength="40" data-error="This field is required." required><div class="help-block with-errors"></div></div></td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                </tr>
                                                <tr>
                                                    <td>Admin Approver</td>
                                                    <td><div class="form-group approver" style="margin: 0"><input type="text" id="approver_userId" class="form-control state_edit" style="width: 100%;" maxlength="20" data-error="This field is required." required><div class="help-block with-errors"></div></div></td>
                                                    <td><div class="form-group approver" style="margin: 0"><input type="text" id="approver_name" class="form-control state_edit" style="width: 100%;" maxlength="100" data-error="This field is required." required><div class="help-block with-errors"></div></div></td>
                                                    <td><div class="form-group approver" style="margin: 0"><input type="email" id="approver_email" class="form-control state_edit" style="width: 100%;" maxlength="100" data-error="This field is invalid." required><div class="help-block with-errors"></div></div></td>
                                                    <td><div class="form-group approver" style="margin: 0"><input type="text" id="approver_mobileNo" class="form-control state_edit numeric phone" style="width: 100%;" maxlength="40" data-error="This field is required." required><div class="help-block with-errors"></div></div></td>
                                                    <td>Hard Token</td>
                                                    <td id="list_admin_token"></td>
                                                </tr>
                                                </tbody>
                                            </table>

                                            <div class="form-group pendingTrxNote">
                                                <label class="col-md-10 ">Please Make Sure there is no pending transactions in Admin Ongoing task before update the Outsource Admin Flag</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>

                <div class="box-footer">
                    <div class="col-md-12 state_edit text-center">
                        <button type="button" id="back" name="back" class="btn btn-default back float-left">@lang('form.cancel')</button>
                        <button type="button" id="confirm" name="confirm" class="btn btn-primary float-right ">@lang('form.confirm')</button>
                    </div>
                    <div class="col-md-12 state_view text-center" data-html2canvas-ignore="true">
                        <div class="float-left">
                            <button type="button" id="back_view" name="back_view" class="btn btn-default">@lang('form.cancel')</button>
                            <button type="button" id="save_screen" name="save_screen" class="btn btn-default" style="display:none" onclick="save_pdf();">@lang('form.save_pdf')</button>
                        </div>
                        <div class="float-right" style="display:inline;">
                            <button type="button" id="next_user" name="next_user" class="btn btn-info">@lang('form.next_user')</button>
                            <button type="button" id="done" name="done" class="btn btn-primary" style="display:none">@lang('form.done')</button>
                            <button type="button" id="submit_view" name="submit_view" class="btn btn-primary">@lang('form.submit')</button>
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
    var oTable_admin;
    var oTable_token;
    var oTable_token_view;
    var oTable_admin_view;
    var postCodeOption;
    var cityOption;
    var substateOption;
    var stateOption;
    var countryOption;
    var branchOption;
    var industryOption;
    var businessOption;
    var officerOption;
    var serviceOption;
    var remitterOption;
    var id = '{{ $service }}';
    var submit_data;
    var noRef;
    var token_list;
    $(document).ready(function () {



        $('#specialLimitFlag').lc_switch();
        $('#specialChargeFlag').lc_switch();
        $('#outsourceAdminFlag').lc_switch();
        $('#smeFlag').lc_switch();
        $('#defAppMatrixFlag').lc_switch();

        $('.pendingTrxNote').hide();

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

        var cp_count = 1;
        for (i = 0; i < 5; i++) {
            oTable_cp.row.add([
                cp_count,
                '<input type="text" id="cp_name" class="form-control state_edit" style="width: 100%;" maxlength="100"><label id="cp_name_view" class="state_view">-</label>',
                '<input type="text" id="cp_phoneNo" class="form-control state_edit numeric phone" style="width: 100%;" maxlength="40"><label id="cp_phoneNo_view" class="state_view numeric phone">-</label>',
                '<input type="text" id="cp_mobileNo" class="form-control state_edit numeric phone" style="width: 100%;" maxlength="40"><label id="cp_mobileNo_view" class="state_view numeric phone">-</label>',
                '<div class="form-group maker" style="margin: 0"><input type="email" id="cp_email" data-error="Invalid Email Address." class="cp_email form-control state_edit" style="width: 100%;" maxlength="100"><div class="help-block with-errors"></div><label id="cp_email_view" class="state_view">-</label></div>',
                '<input type="text" id="cp_faxNo" class="form-control state_edit numeric" style="width: 100%;" maxlength="40"><label id="cp_faxNo_view" class="state_view">-</label>'
            ]).draw(true);
            cp_count++;
        }

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
                    width: "15%"
                },
                {
                    targets: 2,
                    sortable: true,
                    width: "15%"
                },
                {
                    targets: 3,
                    sortable: true,
                    width: "15%"
                },
                {
                    targets: 4,
                    sortable: true,
                    width: "15%"
                },
                {
                    targets: 5,
                    sortable: true,
                    width: "10%"
                },
                {
                    targets: 6,
                    sortable: true,
                    width: "15%"
                }
            ]
        });

        oTable_admin_view = $('#list_admin_view').DataTable({
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
                    width: "20%"
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
                }
            ]
        });

        /*oTable_admin.row.add([
            'Admin Maker',
            '<input type="text" id="maker_userId" class="state_edit maker" style="width: 100%;" maxlength="40" required>',
            '<input type="text" id="maker_name" class="state_edit maker" style="width: 100%;" maxlength="100" required>',
            '<input type="email" id="maker_email" class="state_edit maker" style="width: 100%;" maxlength="100" required>',
            '<input type="text" id="maker_mobileNo" class="state_edit numeric" style="width: 100%;" maxlength="40">',
            '-'
        ]).draw(true);

        oTable_admin.row.add([
            'Admin Approver',
            '<input type="text" id="approver_userId" class="state_edit approver" style="width: 100%;" maxlength="40" required>',
            '<input type="text" id="approver_name" class="state_edit approver" style="width: 100%;" maxlength="100" required>',
            '<input type="email" id="approver_email" class="state_edit approver" style="width: 100%;" maxlength="100" required>',
            '<input type="text" id="approver_mobileNo" class="state_edit numeric" style="width: 100%;" maxlength="40">',
            'Hard Token'
        ]).draw(true);*/
        //$('.numeric').autoNumeric('init', {decimalPlacesOverride: '0',digitGroupSeparator: '',minimumValue:'0',maximumValue:'999999999999' });
        if($('#type').val()=='add'){

            oTable_admin.column(6).visible(false);
        }
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
                    width: "80%"
                },
                {
                    targets: 1,
                    sortable: true,
                    width: "20%",
                    className: "dt-center",
                    render: function ( data, type, full, meta ) {
                        return '<button data-cif="'+data+'" class="btn btn-danger" onClick="removeRow(this);" style="width:100px;">Remove</button>';
                    }
                }
            ],
            "drawCallback": function( settings ) {
                tokenCount();
            }
        });

        oTable_token_view = $('#list_token_view').DataTable({
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
            ]
        });

        stateEdit();

        $('#submit_view').on('click', function () {
            $(this).prop('disabled',true);
            /*if($('#approver_tokenNo').val()==null||$('#approver_tokenNo').val()==''){
                var content ='{{trans('form.alert_empty',['label'=>'Serial Number'])}}';
                $.alert({
                    title: '{{trans('form.warning')}}',
                    content: content
                });
                $('#submit_view').prop('disabled',false);
                return;
            }*/
            var content ='';
            if ($('#type').val() == 'add'){
                content='{{trans('form.confirm_add')}}';
            }else{
                content='{{trans('form.confirm_edit')}}';
            }

            $.confirm({
                title: '{{trans('form.submit')}}',
                content: content,
                buttons: {
                    
                    cancel: {
                        text: '{{trans('form.cancel')}}',
                        btnClass: 'btn-default',
                        action: function(){
                            $('#submit_view').prop('disabled',false);
                        }
                    },

                    confirm: {
                        text: '{{trans('form.confirm')}}',
                        btnClass: 'btn-primary',
                        action: function(){
                            submitData();
                        }
                    }

                }
            });

        });

        function submitData(){
            var value = submit_data;

            if($('#type').val() == 'add'){
                $.ajax({
                    url: 'add',
                    async:false,
                    method: 'post',
                    data: {"_token": "{{ csrf_token() }}", menu: id, value: value},
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
            }else{
                submit_data.adminList[1].tokenNo = $('#approver_tokenNo').val();
                $.ajax({
                    url: 'edit',
                    async:false,
                    method: 'post',
                    data: {"_token": "{{ csrf_token() }}", menu: id, value: value},
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
        }



        $('#confirm').on('click', function () {
            var currentTabTitle = $('div[id="exTab"] ul li.active > a').attr("href");
            if(currentTabTitle=='#tab_detail'){
                $('a[href="#tab_services"]').click();
                return;
            }
            if(currentTabTitle=='#tab_services'){
                $('a[href="#tab_admin"]').click();
                return;
            }
            $('#form-area').validator('validate');
            var detail = 0;
            $(".detail").each(function(i){
                if ($(this).val() == "")
                    detail++;
            });
            //console.log(detail);
            if(detail>0){
                $('a[href="#tab_detail"]').click();
                return;
            }else if($('#servicePackage').val()==''){
                $('a[href="#tab_services"]').click();
                return;
            }else if($('#maximumUser').val()==''){
                $('a[href="#tab_services"]').click();
                return;
            }else if($('.maker').hasClass("has-error")||$('.approver').hasClass("has-error")){
                $('a[href="#tab_admin"]').click();
                return;
            }
            var token_count = oTable_token.data().count();
            if(token_count==0&&$('#type').val()=='add'){
                var content ='{{trans('form.alert_empty',['label'=>'Serial Number'])}}';
                $.alert({
                    title: '{{trans('form.warning')}}',
                    content: content
                });
                $('a[href="#tab_services"]').click();
                $('#serialNumber').focus();
                return;
            }

            setTimeout(function(){
                if($('#form-area').validator('validate').has('.has-error').length==0){
                    //submit_data = getTableData();
                    stateView();
                }
            });
        });

        $('#cifid_search').on('click', function () {

            if($('#cifid_filter').val()!==''){
                $(this).prop('disabled',true);
                searchCorporate($('#cifid_filter').val());
            }else{
                var content ='{{trans('form.alert_empty',['label'=>'CIF ID'])}}';
                $.alert({
                    title: '{{trans('form.warning')}}',
                    content: content
                });
                return;
            }

        });

        $('#back_view').on('click', function () {
            $(this).prop('disabled',true);
            if($('#state').val() == 'success'){
                app.setView(id,'landing')
            }else{
            $('#back_view').prop('disabled',false);
            stateEdit();
            }
        });



        $('.back').on('click', function () {
            $(this).prop('disabled',true);
            var corporateId = $('#code_edit').val();
            var name = $('#corporateName').val();
            if($('#type').val() == 'add') {
                app.setView(id,'landing');
            } else {
                var res = app.setView(id,'detail');
                if(res=='done'){
                    $('#code').val(corporateId);
                    getData(corporateId,name);
                }
            }
        });

        $('#serialNumber_add').on('click', function () {
            if($('#serialNumber').val()!==''){
            $(this).prop('disabled',true);
            searchToken();
            }else{
                var content ='{{trans('form.alert_empty',['label'=>'Serial Number'])}}';
                $.alert({
                    title: '{{trans('form.warning')}}',
                    content: content
                });
                return;
            }

        });

        $('.state_edit').not('#cifid_filter').prop('disabled',true);
        $('#form-area').validator().on('submit', function (e) {
            if (e.isDefaultPrevented()) {
                // handle the invalid form...
            } else {
                // everything looks good!
                console.log('valid')
            }
        });

        //resetFormValidator('#form-area');


        $('input[name="resident-rb"]').on('change', function(e) {
            if(this.value=='1'){
                $('#resident_container').show();
            }else{
                $('#resident_container').hide();
            }
        });

        $('input[name="citizen-rb"]').on('change', function(e) {
            if(this.value=='1'){
                $('#citizenship_container').show();
                
            }else{
                $('#citizenship_container').hide();
            }
        });


        $('input[name="outsourceAdminFlag"]').on('lcs-on', function(e) {
             $('#list_admin').hide();
                $('#list_admin_view').hide();
                
                    $('#maker_userId_edit').val($('#maker_userId').val()); 
                    $('#maker_name_edit').val($('#maker_name').val());
                    $('#maker_mobileNo_edit').val($('#maker_mobileNo').val());
                    $('#maker_email_edit').val($('#maker_email').val());
                    $('#approver_userId_edit').val($('#approver_userId').val()) ;
                    $('#approver_name_edit').val($('#approver_name').val());
                    $('#approver_mobileNo_edit').val($('#approver_mobileNo').val());
                    $('#approver_email_edit').val($('#approver_email').val());
                

                $('#maker_userId').val('OSAdminMaker'); 
                $('#maker_name').val('Outsouce Admin Maker');
                $('#maker_mobileNo').val('0000000000');
                $('#maker_email').val('test@gmail.com');
                $('#approver_userId').val('OSAdminApprover') ;
                $('#approver_name').val('Outsouce Admin Approver');
                $('#approver_mobileNo').val('0000000000');
                $('#approver_email').val('test2@gmail.com');

        });

         $('input[name="outsourceAdminFlag"]').on('lcs-off', function(e) {

             $('#list_admin').show();
              $('#list_admin_view').show();

            $('#maker_userId').val($('#maker_userId_edit').val()); 
            $('#maker_name').val($('#maker_name_edit').val());
            $('#maker_mobileNo').val($('#maker_mobileNo_edit').val());
            $('#maker_email').val($('#maker_email_edit').val());
            $('#approver_userId').val($('#approver_userId_edit').val()) ;
            $('#approver_name').val($('#approver_name_edit').val());
            $('#approver_mobileNo').val($('#approver_mobileNo_edit').val());
            $('#approver_email').val($('#approver_email_edit').val());
            
        });


        $('#done').on('click', function () {
            $(this).prop('disabled',true);
            app.setView(id,'landing');
        });

        $('input[type="text"]').not('.numeric').not('#cifid_filter').not('#corporateId').alphanum({
            allowSpace: true,
            allow : ',._!@'
        });

        $('#cifid_filter').not('.numeric').alphanum({
            allowSpace: false,
            allow : ''
        });

        $('#corporateId').not('.numeric').alphanum({
            allowSpace: false,
            allow : ''
        });


        $('#extNo').numeric({
            allowSpace: false,
           allow : ''
        })
        $('#maximumUser').numeric({
            allowSpace: false,
            allow : ''
        });
        $('.phone').mask('(00)000000000000000000000000000000000000');

        $('#maker_userId').not('.numeric').alphanum({
            allowSpace: false,
            allow : ''
        });

        $('#approver_userId').not('.numeric').alphanum({
            allowSpace: false,
            allow : ''
        });

    });


    function removeRow(el){
        var row = $(el).parent().parent();
        oTable_token.row(row).remove().draw(true);
        //tokenCount();
    }

    function checkDuplicateList(tokenNo){
        var duplicate = 0;
        $("#list_token").find("tbody tr").each(function () {
            var serialNo = $('td:eq(0)', $(this)).find('#serialNo').val();
            if(tokenNo==serialNo){
                duplicate = 1;
            }
        });

        if(duplicate==1){
            return false;
        }else{
            return true;
        }

    }

    function getData(code,name) {
        if($('#type').val() == 'edit') {
        $('.corporate_filter').hide();
        $('#cifid_search').hide();
        $('#maker_userId').prop('readonly',true);
        $('#approver_userId').prop('readonly',true);
        $('.token-list').hide();
        }else{
            $('.token-list').show();
        }
        getPostCode();
        getCountry();
        getState()
        getSubstate();
        getCity();
        getBranch();
        getRemitter();        
        getIndustrySegment();
        getBusinessUnit();
        getHandlingOfficer();
        getServicePackage(code,name);
    }

    function getDataEdit(code,name,countryCode,stateCode,substateCode,osAdminFlag) {
        if($('#type').val() == 'edit') {
        $('.corporate_filter').hide();
        $('#cifid_search').hide();
       
        $('.pendingTrxNote').show();

        if(osAdminFlag != 'Yes'){
            $('#maker_userId').prop('readonly',true);
            $('#approver_userId').prop('readonly',true);
        }
        $('.token-list').hide();
        }else{
            $('.token-list').show();
        }
        getPostCode();
        getCountry(countryCode);
        getState(countryCode)
        getSubstate(stateCode);
        getCity(substateCode);
        getBranch();
        getRemitter();        
        getIndustrySegment();
        getBusinessUnit();
        getHandlingOfficer();
        getServicePackage(code,name);
    }
    
    function getAllData(code,name){
        var tokenNo ='';
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
            async:false,
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
                    var contactList = detail[index].contactList;
                    //token_list = detail[0].tokenList;
                    //token_list = ["1111","2222","33333"];
                    var adminList = detail[index].adminList;

                    tokenNo = adminList[1].tokenNo;

                    $('#cifid').val(detail[index].cifId);
                    $('#cifid_view').text(detail[index].cifId);
                    $('#corporateId').val(detail[index].corporateId);
                    $('#corporateName').val(name);
                    $('#address1').val(detail[index].address1);
                    $('#address2').val(detail[index].address2);
                    $('#address3').val(detail[index].address3);
                    $('#postcode').val(detail[index].postcode).trigger('change');
                    $('#city').val(detail[index].cityCode);
                    $('#substate').val(detail[index].substateCode);
                    $('#states').val(detail[index].stateCode);
                    $('#country').val(detail[index].countryCode).trigger('change');
                    $('#email1').val(detail[index].email1);
                    $('#email2').val(detail[index].email2);
                    $('#phoneNo').val(detail[index].phoneNo);
                    $('#extNo').val(detail[index].extNo);
                    $('#faxNo').val(detail[index].faxNo);
                    $('#branch').val(detail[index].branchCode).trigger('change');
                    $('#industrySegment').val(detail[index].industrySegmentCode).trigger('change');
                    $('#businessUnit').val(detail[index].businessUnitCode).trigger('change');
                    $('#taxId').val(detail[index].taxIdNo);
                    $('#maximumUser').val(detail[index].maxCorporateUser);
                    $('#servicePackage').val(detail[index].servicePackageCode).trigger('change');
                    $('#handlingOfficer').val(detail[index].handlingOfficerCode).trigger('change');
                    $('#remitterType').val(detail[index].lldCategory).trigger('change');
                    $('#status').text((detail[index].inactiveFlag=="N"?"Active":"Inactive"));
                    if(detail[index].specialChargeFlag=="Y"){
                        $('#specialChargeFlag').lcs_on();
                    }else{
                        $('#specialChargeFlag').lcs_off();
                    }
                    if(detail[index].specialLimitFlag=="Y"){
                        $('#specialLimitFlag').lcs_on();
                    }else{
                        $('#specialLimitFlag').lcs_off();
                    }

                    if(detail[index].smeFlag=="Y"){
                        $('#smeFlag').lcs_on();
                    }else{
                        $('#smeFlag').lcs_off();
                    }

                    if(detail[index].defAppMatrixFlag=="Y"){
                        $('#defAppMatrixFlag').lcs_on();
                    }else{
                        $('#defAppMatrixFlag').lcs_off();
                    }

                    if(detail[index].outsourceAdminFlag=="Y"){
                        $('#outsourceAdminFlag').lcs_on();
                    }else{
                        $('#outsourceAdminFlag').lcs_off();
                    }

                    if(contactList){
                        $.each(contactList, function (idx, obj){
                            $('#list_cp tr:eq('+(idx+1)+') td:eq(1)').find('#cp_name').val(obj.name);
                            $('#list_cp tr:eq('+(idx+1)+') td:eq(2)').find('#cp_phoneNo').val(obj.phoneNo);
                            $('#list_cp tr:eq('+(idx+1)+') td:eq(3)').find('#cp_mobileNo').val(obj.mobileNo);
                            $('#list_cp tr:eq('+(idx+1)+') td:eq(4)').find('#cp_email').val(obj.email);
                            $('#list_cp tr:eq('+(idx+1)+') td:eq(5)').find('#cp_faxNo').val(obj.faxNo);
                        });
                    }
                    if(token_list){
                        oTable_token.clear();
                        $.each(token_list, function (idx, obj){
                            var tokenNo = obj;
                            if(tokenNo){
                                oTable_token.row.add([
                                    tokenNo
                                ]).draw(true);

                            }
                        });
                    }

                    if(adminList){
                        $.each(adminList, function (idx, obj){
                            if(obj.role=='maker'){
                                $('#list_admin tr:eq('+(idx+1)+') td:eq(1)').find('#maker_userId').val(obj.userId);
                                $('#list_admin tr:eq('+(idx+1)+') td:eq(2)').find('#maker_name').val(obj.name);
                                $('#list_admin tr:eq('+(idx+1)+') td:eq(3)').find('#maker_email').val(obj.email);
                                $('#list_admin tr:eq('+(idx+1)+') td:eq(4)').find('#maker_mobileNo').val(obj.mobileNo);
                                $('#list_admin tr:eq('+(idx+1)+') td:eq(5)').val('Hard Token');
                            }else
                            if(obj.role=='checker'){
                                $('#list_admin tr:eq('+(idx+1)+') td:eq(1)').find('#approver_userId').val(obj.userId);
                                $('#list_admin tr:eq('+(idx+1)+') td:eq(2)').find('#approver_name').val(obj.name);
                                $('#list_admin tr:eq('+(idx+1)+') td:eq(3)').find('#approver_email').val(obj.email);
                                $('#list_admin tr:eq('+(idx+1)+') td:eq(4)').find('#approver_mobileNo').val(obj.mobileNo);
                                $('#list_admin tr:eq('+(idx+1)+') td:eq(5)').val('-');
                            }

                        });
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
                $('.table-hidden').show();
                getAdminTokenEdit(tokenNo);
            }
        });
    }

    function getAdminTokenEdit(tokenNo) {
        var loginId = '<?php echo Session::get('userId') ?>';
        var corporateId = $('#corporateId').val();
        var adminId= $('#approver_userId').val();
        var value = {
            adminId : adminId,
            corporateId : corporateId,
            loginId:loginId,
            tokenType: "TKN"
        };
        var url_action = 'searchTokenUserForEditAdmin';
        var action = 'SEARCH';
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            async:false,
            data: {
                value : value,
                menu : id,
                url_action : url_action,
                action : action,
                _token : '{{ csrf_token() }}'
            },
            success: function (data) {
                var result = JSON.parse(data);
                if (result.status=="200") {
                    token_list = result.tokenList;
                    var tokenOption = '<select class="form-control" id="approver_tokenNo">';

                    $.each(token_list,function (index, item) {
                        tokenOption += '<option value="'+item+'" '+(tokenNo==item? 'selected':'')+'>'+item+'</option>';
                    });
                    tokenOption += '</select>';
                    //console.log(tokenOption);
                    $('#list_admin_token').html(tokenOption);
                    //$('#list_admin_token').select2({ width: '100%',placeholder: 'Select Token' });
                } else {
                    app.setView(id);
                    flash('warning', result.message);
                }



            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '{{trans('form.conn_error')}}';
                flash('warning', msg);
                app.setView(id);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {

            }
        });
    }


    function getPostCode() {
        var value = {
            code: "",
            name: "",
            modelCode: "COM_MT_POSTCODE"
        };
        var url_action = 'searchModelForDroplist';
        var action = 'SEARCH';
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            async:false,
            data: {
                value : value,
                menu : 'MNU_GPCASH_MT_PARAMETER',
                url_action : url_action,
                action : action,
                _token : '{{ csrf_token() }}'
            },
            success: function (data) {
                var result = JSON.parse(data);
                if (result.status=="200") {
                    postCodeOption = '<option value=""></option>';
                    $.each(result.result, function (idx, obj) {
                        postCodeOption += '<option value="' + obj.code + '">' + obj.code +' - '+ obj.name + '</option>';
                    });
                    $('#postcode').html(postCodeOption);
                    $('#postcode').select2({ width: '100%',placeholder: 'Select Post Code' });
                } else {
                    app.setView(id);
                    flash('warning', result.message);
                }



            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '{{trans('form.conn_error')}}';
                flash('warning', msg);
                app.setView(id);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {

            }
        });
    }

    function getCity(substate_code,cityCode) {    	
        var value = {
            code: "",
            name: "",
            modelCode: "COM_MT_CITY",
            parentProperty:"substate",
            parentPropertySearchCode:substate_code
        };
        var url_action = 'searchModelForDroplist';
        var action = 'SEARCH';
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            async:false,
            data: {
                value : value,
                menu : 'MNU_GPCASH_MT_PARAMETER',
                url_action : url_action,
                action : action,
                _token : '{{ csrf_token() }}'
            },
            success: function (data) {
                var result = JSON.parse(data);
                if (result.status=="200") {
                    cityOption = '<option value=""></option>';
                    $.each(result.result, function (idx, obj) {
                        cityOption += '<option value="' + obj.code + '">' + obj.name + '</option>';
                    });
                    $('#city').html(cityOption);
                    $('#city').val(cityCode);
                    $('#city').select2({ width: '100%',placeholder: 'Select City' });
                } else {
                    flash('warning', result.message);
                }



            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '{{trans('form.conn_error')}}';
                flash('warning', msg);
                app.setView(id);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {

            }
        });
    }

    function getSubstate(state_code,substateCode) {      
        var value = {
            code: "",
            name: "",
            modelCode: "COM_MT_SUBSTATE",
            parentProperty:"state",
            parentPropertySearchCode:state_code
        };
        
        var url_action = 'searchModelForDroplist';
        var action = 'SEARCH';
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            async:false,
            data: {
                value : value,
                menu : 'MNU_GPCASH_MT_PARAMETER',
                url_action : url_action,
                action : action,
                _token : '{{ csrf_token() }}'
            },
            success: function (data) {
                var result = JSON.parse(data);
                if (result.status=="200") {
                    substateOption = '<option value=""></option>';
                    $.each(result.result, function (idx, obj) {
                        substateOption += '<option value="' + obj.code + '">' + obj.name + '</option>';
                    });
                    $('#substate').html(substateOption);
                    $('#substate').val(substateCode);
                    $('#substate').select2({ width: '100%',placeholder: 'Select Substate' });
                } else {
                    flash('warning', result.message);
                }



            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '{{trans('form.conn_error')}}';
                flash('warning', msg);
                app.setView(id);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {

            }
        });
    }

    function getState(country_code,stateCode) {
        var value = {
            code: "",
            name: "",
            modelCode: "COM_MT_STATE",
            parentProperty:"country",
            parentPropertySearchCode:country_code
        };
        var url_action = 'searchModelForDroplist';
        var action = 'SEARCH';
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            async:false,
            data: {
                value : value,
                menu : 'MNU_GPCASH_MT_PARAMETER',
                url_action : url_action,
                action : action,
                _token : '{{ csrf_token() }}'
            },
            success: function (data) {
                var result = JSON.parse(data);
                if (result.status=="200") {
                    stateOption = '<option value=""></option>';
                    $.each(result.result, function (idx, obj) {
                        stateOption += '<option value="' + obj.code + '">' + obj.name + '</option>';
                    });
                    $('#states').html(stateOption);
                    $('#states').val(stateCode);
                    $('#states').select2({ width: '100%',placeholder: 'Select State' });
                } else {
                    flash('warning', result.message);
                }



            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '{{trans('form.conn_error')}}';
                flash('warning', msg);
                app.setView(id);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {

            }
        });
    }

    function getCountry(countryCode) {
        var value = {
            code: "",
            name: "",
            modelCode: "COM_MT_COUNTRY"
        };
        var url_action = 'searchModelForDroplist';
        var action = 'SEARCH';
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            async:false,
            data: {
                value : value,
                menu : 'MNU_GPCASH_MT_PARAMETER',
                url_action : url_action,
                action : action,
                _token : '{{ csrf_token() }}'
            },
            success: function (data) {
                var result = JSON.parse(data);
                if (result.status=="200") {
                    countryOption = '<option value=""></option>';
                    $.each(result.result, function (idx, obj) {
                        countryOption += '<option value="' + obj.code + '">' + obj.name + '</option>';
                    });
                    $('#country').html(countryOption);
                    $('#country').select2({ width: '100%',placeholder: 'Select Country' });
                    $('#country').val(countryCode);
                    $('#residential').html(countryOption);
                    $('#residential').select2({ width: '100%',placeholder: 'Select Country' });
                    $('#residential').val('ID').trigger('change');
                    $('#citizenship').html(countryOption);
                    $('#citizenship').select2({ width: '100%',placeholder: 'Select Country' });
                    $('#citizenship').val('ID').trigger('change');
                } else {
                    flash('warning', result.message);
                }



            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '{{trans('form.conn_error')}}';
                flash('warning', msg);
                app.setView(id);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {
                if($('#type').val()=='add'){
                    $('#country').val('ID').trigger('change');
                    $('#residential').val('ID').trigger('change');
                    $('#citizenship').val('ID').trigger('change');
                }
            }
        });
    }

    function getRemitter() {
        var value = {
            loginId : '<?php echo Session::get('userId') ?>',
        };
        var url_action = 'searchBeneficiaryTypeForDroplist';
        var action = 'SEARCH';
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            async:false,
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
                    remitterOption = '<option value=""></option>';
                    $.each(result.result, function (idx, obj) {
                        remitterOption += '<option value="' + obj.code + '">' + obj.name + '</option>';
                    });
                    $('#remitterType').html(remitterOption);
                    $('#remitterType').select2({ width: '100%',placeholder: 'Select Remitter Type' });

                } else {
                    flash('warning', result.message);
                }



            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '{{trans('form.conn_error')}}';
                flash('warning', msg);
                app.setView(id);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {
                if($('#remitterType').val()==''){
                    $('#remitterType').val('2').trigger('change');
                }
            }
        });
    }

    function getDroplist2(currentDroplist){
    }
    
		function getDroplist(currentDroplist){
			if(currentDroplist == "country"){
					getState($('#country').val(),$('#states').val());
					getSubstate($('#states').val(),$('#substate').val());
					getCity($('#substate').val(),$('#city').val());

			}
			
			if(currentDroplist == "state" ){
					getSubstate($('#states').val(),$('#substate').val());
					getCity($('#substate').val(),$('#city').val());
			}
			
			if(currentDroplist == "substate"){
					getCity($('#substate').val(),$('#city').val());    			
			}
			
		}    
        function getBranch() {
        	var value = {
                code: "",
                name: ""
            };
            var url_action = 'searchBranch';
            var action = 'SEARCH';
            $.ajax({
                url: 'getAPIData',
                method: 'post',
                async:false,
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
                        branchOption = '<option value=""></option>';
                        $.each(result.result, function (idx, obj) {
                            branchOption += '<option value="' + obj.code + '">' + obj.name + '</option>';
                        });
                        $('#branch').html(branchOption);
                        $('#branch').select2({ width: '100%',placeholder: 'Select Branch' });
                    } else {
                        flash('warning', result.message);
                    }



                }, error: function (xhr, ajaxOptions, thrownError) {
                    var msg = '{{trans('form.conn_error')}}';
                    flash('warning', msg);
                    app.setView(id);
                    console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                }, complete: function (data) {

                }
            });
        }

    function getIndustrySegment() {
        var value = {
            code: "",
            name: "",
            modelCode: "COM_MT_IDS_SGM"
        };
        var url_action = 'searchModelForDroplist';
        var action = 'SEARCH';
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            async:false,
            data: {
                value : value,
                menu : 'MNU_GPCASH_MT_PARAMETER',
                url_action : url_action,
                action : action,
                _token : '{{ csrf_token() }}'
            },
            success: function (data) {
                var result = JSON.parse(data);
                if (result.status=="200") {
                    industryOption = '<option value=""></option>';
                    $.each(result.result, function (idx, obj) {
                        industryOption += '<option value="' + obj.code + '">' + obj.name + '</option>';
                    });
                    $('#industrySegment').html(industryOption);
                    $('#industrySegment').select2({ width: '100%',placeholder: 'Select Industry Segment' });
                } else {
                    flash('warning', result.message);
                }



            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '{{trans('form.conn_error')}}';
                flash('warning', msg);
                app.setView(id);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {

            }
        });
    }

        function getBusinessUnit() {
            var value = {
                code: "",
                name: "",
                modelCode: "COM_MT_BUSINESS_UNIT"
            };
            var url_action = 'searchModelForDroplist';
            var action = 'SEARCH';
            $.ajax({
                url: 'getAPIData',
                method: 'post',
                async:false,
                data: {
                    value : value,
                    menu : 'MNU_GPCASH_MT_PARAMETER',
                    url_action : url_action,
                    action : action,
                    _token : '{{ csrf_token() }}'
                },
                success: function (data) {
                    var result = JSON.parse(data);
                    if (result.status=="200") {
                        businessOption = '<option value=""></option>';
                        $.each(result.result, function (idx, obj) {
                            businessOption += '<option value="' + obj.code + '">' + obj.name + '</option>';
                        });
                        $('#businessUnit').html(businessOption);
                        $('#businessUnit').select2({ width: '100%',placeholder: 'Select Business Unit' });
                    } else {
                        flash('warning', result.message);
                    }



                }, error: function (xhr, ajaxOptions, thrownError) {
                    var msg = '{{trans('form.conn_error')}}';
                    flash('warning', msg);
                    app.setView(id);
                    console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                }, complete: function (data) {

                }
            });
        }

    function getHandlingOfficer() {
        var value = {
            code: "",
            name: "",
            modelCode: "COM_MT_HANDLING_OFFICER"
        };
        var url_action = 'searchModelForDroplist';
        var action = 'SEARCH';
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            async:false,
            data: {
                value : value,
                menu : 'MNU_GPCASH_MT_PARAMETER',
                url_action : url_action,
                action : action,
                _token : '{{ csrf_token() }}'
            },
            success: function (data) {
                var result = JSON.parse(data);
                if (result.status=="200") {
                    officerOption = '<option value=""></option>';
                    $.each(result.result, function (idx, obj) {
                        officerOption += '<option value="' + obj.code + '">' + obj.name + '</option>';
                    });
                    $('#handlingOfficer').html(officerOption);
                    $('#handlingOfficer').select2({ width: '100%',placeholder: 'Select Officer' });
                } else {
                    flash('warning', result.message);
                }



            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '{{trans('form.conn_error')}}';
                flash('warning', msg);
                app.setView(id);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {

            }
        });
    }

    function getServicePackage(code,name) {
        var value = {
            code: "",
            name: ""
        };
        var url_action = 'searchServicePackageForDroplist';
        var action = 'SEARCH';
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            async:false,
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
                    serviceOption = '<option value=""></option>';
                    $.each(result.result, function (idx, obj) {
                        serviceOption += '<option value="' + obj.code + '">' + obj.name + '</option>';
                    });
                    $('#servicePackage').html(serviceOption);
                    $('#servicePackage').select2({ width: '100%',placeholder: 'Select Service' });
                    if($('#type').val()=='edit'){
                        $('.state_edit').not('#cifid_filter').prop('disabled',false);
                    }
                } else {
                    flash('warning', result.message);
                }


            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '{{trans('form.conn_error')}}';
                flash('warning', msg);
                app.setView(id);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {
                if(code!='') {

                    getAllData(code, name);
                }

            }
        });
    }

    function searchToken() {
        /*var serialNo = $('#serialNumber').val();
        if(checkDuplicateList(serialNo)) {

            oTable_token.row.add([
                serialNo + '<input type=hidden id="serialNo" value="' + serialNo + '">'
            ]).draw(true);
            tokenCount();
            $('#serialNumber_add').prop('disabled',false);
        }
        return;*/
        var serialNo = $('#serialNumber').val();
        var corporateId = $('#corporateId').val();
        var value = {
        corporateId: corporateId,
        tokenNo: serialNo,
        tokenType: "TKN"
        };
        var url_action = 'searchToken';
        var action = 'SEARCH';
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            async:false,
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
                    if(result.tokenNo !== undefined){
                        if(checkDuplicateList(serialNo)) {
                            oTable_token.row.add([
                                serialNo + '<input type=hidden id="serialNo" value="' + serialNo + '">'
                            ]).draw(true);
                            tokenCount();
                        }
                    }else{
                        $.alert({
                            title: 'Attention!',
                            content: 'Serial Number not Found.'
                        });
                    }
                } else {
                    flash('warning', result.message);
                }



            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '{{trans('form.conn_error')}}';
                flash('warning', msg);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {
                $('#serialNumber_add').prop('disabled',false);
            }
        });
    }

    function tokenCount(){
        if(oTable_token !== undefined)
        var token_count = oTable_token.data().count();
        $('#tokenNum').text(token_count);
    }

    function searchCorporate(cifid) {


        var value = {
            cifId: cifid
        };
        var url_action = 'searchOnline';
        var action = 'SEARCH';
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            async:false,
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
                    if(result.cifId !== undefined){
                        $('#cifid').val(result.cifId);
                        $('#corporateName').val(result.name);
                        $('#address1').val(result.address1);
                        $('#address2').val(result.address2);
                        $('#address3').val(result.address3);
                        $('#postcode').val(result.postcode).trigger('change');
                        $('#city').val(result.cityCode).trigger('change');
                        $('#substate').val(result.substateCode).trigger('change');
                        $('#states').val(result.stateCode).trigger('change');
                        $('#country').val(result.countryCode).trigger('change');
                        $('#status').text('Active');
                        $('.state_edit').not('#cifid_filter').prop('disabled',false);
                    }else{
                        $.alert({
                            title: 'Attention!',
                            content: 'Corporate not Found.'
                        });

                    }
                } else {
                    flash('warning', result.message);
                }


            }, error: function (xhr, ajaxOptions, thrownError) {
                //$('#form-area').find("input[type=text]").val("");
                var msg = '{{trans('form.conn_error')}}';
                flash('warning', msg);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {
                $('#cifid_search').prop('disabled',false);
            }
        });
    }

        function stateEdit() {
            $('#state').val('edit');
            if($('#type').val()=='edit'){
                $('#cifid_search').hide();
                $('.token-list').hide();
                //oTable_admin.column(6).visible(true);
            }else{
                //oTable_admin.column(6).visible(false);
                $('.token-list').show();
                $('#cifid_search').show();
            }
            $('.state_view').hide();
            $('.state_edit').show();
            $('label.state_view').text('-');
            $('#save_screen').hide();
            $('.help-block').show();
            $('#done').hide();
            $('#next_user').hide();
        }

        function stateView() {
            var lldIsResidence = ($('input[name="resident-rb"]:checked').val() == '0' ? 'Y' : 'N');
            var lldIsCitizen = ($('input[name="citizen-rb"]:checked').val() == '0' ? 'Y' : 'N');
            if($('#type').val()=='edit'){
                $('.token-list').hide();
            }else{
                $('.token-list').show();
            }
            $('#cifid_search').hide();

            $('#state').val('view');
            $('a[href="#tab_detail"]').click();
           // $('.role_list').appendTo('.role_view');
            //oTable.column(2).visible(false);
            var cifid_filter = ($('#cifid_filter').val() == '' ? '-' : $('#cifid_filter').val());
            $('#cifid_filter_view').text(cifid_filter);
            var cifid = ($('#cifid').val() == '' ? '-' : $('#cifid').val());
            $('#cifid_view').text(cifid);
            var corporateId = ($('#corporateId').val() == '' ? '-' : $('#corporateId').val());
            $('#corporateId_view').text(corporateId);
            var corporateName = ($('#corporateName').val() == '' ? '-' : $('#corporateName').val());
            $('#corporateName_view').text(corporateName);
            var address1 = ($('#address1').val() == '' ? '-' : $('#address1').val());
            $('#address1_view').text(address1);
            var address2 = ($('#address2').val() == '' ? '-' : $('#address2').val());
            $('#address2_view').text(address2);
            var address3 = ($('#address3').val() == '' ? '-' : $('#address3').val());
            $('#address3_view').text(address3);
            var postcode = ($('#postcode :selected').text() == '' ? '-' : $('#postcode :selected').text());
            var postcode_code = $('#postcode').val();
            $('#postcode_view').text(postcode);
            var city = ($('#city :selected').text() == '' ? '-' : $('#city :selected').text());
            var city_code = $('#city').val();
            $('#city_view').text(city);
            var substate = ($('#substate :selected').text() == '' ? '-' : $('#substate :selected').text());
            var substate_code = $('#substate').val();

            $('#substate_view').text(substate);
            var states = ($('#states :selected').text() == '' ? '-' : $('#states :selected').text());
            var states_code = $('#states').val();

            $('#states_view').text(states);
            var country = ($('#country :selected').text() == '' ? '-' : $('#country :selected').text());
            var country_code = $('#country').val();
            $('#country_view').text(country);
            //console.log($('input[name="resident-rb"]:checked').val());
            var residential = ($('input[name="resident-rb"]:checked').val() == '0' ? 'Resident' : 'Non Resident, '+$('#residential :selected').text());
            var residential_code = ($('input[name="resident-rb"]:checked').val() == '0' ? 'ID' : $('#residential').val());
            $('#residential_view').text(residential);

            var citizenship = ($('input[name="citizen-rb"]:checked').val() == '0' ? 'Citizen' : 'Non Citizen, '+$('#citizenship :selected').text());
            var citizenship_code = ($('input[name="citizen-rb"]:checked').val() == '0' ? 'ID' : $('#citizenship').val());
            $('#citizenship_view').text(citizenship);

            var remitter = ($('#remitterType :selected').text() == '' ? '-' : $('#remitterType :selected').text());
            var remitterType_code = $('#remitterType').val();
            $('#remitterType_view').text(remitter);

            var email1 = $('#email1').val();
            $('#email1_view').text(email1);
            var email2 = $('#email2').val();
            $('#email2_view').text(email2);
            var phoneNo = $('#phoneNo').val();
            $('#phoneNo_view').text(phoneNo);
            var extNo = $('#extNo').val();
            $('#extNo_view').text(extNo);
            var faxNo = $('#faxNo').val();
            $('#faxNo_view').text(faxNo);
            var branch = ($('#branch :selected').text() == '' ? '-' : $('#branch :selected').text());
            var branch_code = $('#branch').val();
            $('#branch_view').text(branch);
            var industrySegment = ($('#industrySegment :selected').text() == '' ? '-' : $('#industrySegment :selected').text());
            var industrySegment_code = $('#industrySegment').val();
            $('#industrySegment_view').text(industrySegment);
            var businessUnit = ($('#businessUnit :selected').text() == '' ? '-' : $('#businessUnit :selected').text());
            var businessUnit_code = $('#businessUnit').val();

            $('#businessUnit_view').text(businessUnit);
            var taxId = ($('#taxId').val() == '' ? '-' : $('#taxId').val());
            $('#taxId_view').text(taxId);
            var handlingOfficer = ($('#handlingOfficer :selected').text() == '' ? '-' : $('#handlingOfficer :selected').text());
            var handlingOfficer_code = $('#handlingOfficer').val();

            $('#handlingOfficer_view').text(handlingOfficer);
            var servicePackage = ($('#servicePackage :selected').text() == '' ? '-' : $('#servicePackage :selected').text());
            var servicePackage_code = $('#servicePackage').val();
            var inactiveFlag = $('#status').text();
            $('#servicePackageName').text(servicePackage);
            var maximumUser = ($('#maximumUser').val() == '' ? '-' : $('#maximumUser').val());
            $('#maxCorporateUser').text(maximumUser);

            var tokenNum = $('#tokenNum').text();
            $('#tokenNum_view').text(tokenNum);

            var specialLimit = ($('#specialLimitFlag').is(':checked') ? 'Yes' : 'No');
            $('#specialLimitFlag_view').text(specialLimit);
            var specialLimit_post = ($('#specialLimitFlag').is(':checked') ? 'Y' : 'N');

            var outsourceAdmin = ($('#outsourceAdminFlag').is(':checked') ? 'Yes' : 'No');
            $('#outsourceAdminFlag_view').text(outsourceAdmin);
            var outsourceAdmin_post = ($('#outsourceAdminFlag').is(':checked') ? 'Y' : 'N');

            var specialCharge = ($('#specialChargeFlag').is(':checked') ? 'Yes' : 'No');
            var specialCharge_post = ($('#specialChargeFlag').is(':checked') ? 'Y' : 'N');
            $('#specialChargeFlag_view').text(specialCharge);

            var isSME = ($('#smeFlag').is(':checked') ? 'Yes' : 'No');
            $('#smeFlag_view').text(isSME);
            var isSME_post = ($('#smeFlag').is(':checked') ? 'Y' : 'N');

            var isDefAppMatrix = ($('#defAppMatrixFlag').is(':checked') ? 'Yes' : 'No');
            $('#defAppMatrixFlag_view').text(isDefAppMatrix);
            var isDefAppMatrix_post = ($('#defAppMatrixFlag').is(':checked') ? 'Y' : 'N');

            var contact_list = [];
            $("#list_cp").find("tbody tr").each(function () {

                var name = $('td:eq(1)', $(this)).find('#cp_name').val();
                $('td:eq(1)', $(this)).find('#cp_name_view').text(name);
                var phoneNo = $('td:eq(2)', $(this)).find('#cp_phoneNo').val();
                $('td:eq(2)', $(this)).find('#cp_phoneNo_view').text(phoneNo);
                var mobileNo = $('td:eq(3)', $(this)).find('#cp_mobileNo').val();
                $('td:eq(3)', $(this)).find('#cp_mobileNo_view').text(mobileNo);
                var email = $('td:eq(4)', $(this)).find('#cp_email').val();
                $('td:eq(4)', $(this)).find('#cp_email_view').text(email);
                var faxNo = $('td:eq(5)', $(this)).find('#cp_faxNo').val();
                $('td:eq(5)', $(this)).find('#cp_faxNo_view').text(faxNo);

                var obj = {
                    name: name,
                    phoneNo: phoneNo,
                    mobileNo: mobileNo,
                    email: email,
                    faxNo: faxNo
                };
                contact_list.push(obj);

            });

            var tokenNo_approver ='';
            if($('#type').val()=='add') {

                token_list = [];
                oTable_token_view.clear();
                $("#list_token").find("tbody tr").each(function () {
                    var tokenNo = $('td:eq(0)', $(this)).find('#serialNo').val();
                    if(tokenNo){
                        token_list.push(tokenNo);
                        oTable_token_view.row.add([
                            tokenNo
                        ]).draw(true);
                    }
                });
                tokenNo_approver = token_list[0];
            }else{
                tokenNo_approver = $('#approver_tokenNo').val();
            }

           
            var admin_list = [];
            oTable_admin_view.clear();
            var maker_userId = $('#maker_userId').val();
            var maker_name = $('#maker_name').val();
            var maker_mobileNo = $('#maker_mobileNo').val();
            var maker_email = $('#maker_email').val();
            var approver_userId = $('#approver_userId').val();
            var approver_name = $('#approver_name').val();
            var approver_mobileNo = $('#approver_mobileNo').val();
            var approver_email = $('#approver_email').val();

            if(outsourceAdmin == 'Yes'){
                $('#list_admin_view').hide();
                tokenNo_approver = '';
            }else{
                 $('#list_admin_view').show();
            }

            oTable_admin_view.row.add([
                    'Admin Maker',
                    maker_userId,
                    maker_name,
                    maker_email,
                    maker_mobileNo,
                    '-',
                    ''
                ]).draw(true);
            var maker = {
                userId:maker_userId,
                name:maker_name,
                mobileNo:maker_mobileNo,
                email:maker_email,
                role:'maker'
            };
            admin_list.push(maker);
            
            oTable_admin_view.row.add([
                'Admin Approver',
                approver_userId,
                approver_name,
                approver_email,
                approver_mobileNo,
                'Hard Token',
                tokenNo_approver

            ]).draw(true);
            $('#approver_tokenNo').select2({ width: '100%' });
            var approver = {
                userId:approver_userId,
                name:approver_name,
                mobileNo:approver_mobileNo,
                email:approver_email,
                tokenType:'TKN',
                tokenNo:tokenNo_approver,
                role:'checker'
            };

            admin_list.push(approver);
            //console.log(admin_list);
            submit_data = {
                corporateId:corporateId,
                name:corporateName,
                cifId:cifid,
                address1:address1,
                address2:address2,
                address3:address3,
                postcode:postcode_code,
                postName:postcode,
                cityCode:city_code,
                cityName:city,
                substateCode:substate_code,
                substateName:substate,
                stateCode:states_code,
                stateName:states,
                countryCode:country_code,
                countryName:country,
                email1:email1,
                email2:email2,
                phoneNo:phoneNo,
                extNo:extNo,
                faxNo:faxNo,
                branchCode:branch_code,
                branchName:branch,
                industrySegmentCode:industrySegment_code,
                industrySegmentName:industrySegment,
                servicePackageCode:servicePackage_code,
                servicePackageName:servicePackage,
                businessUnitCode:businessUnit_code,
                businessUnitName:businessUnit,
                taxIdNo:taxId,
                handlingOfficerCode:handlingOfficer_code,
                handlingOfficerName:handlingOfficer,
                maxCorporateUser:maximumUser,
                specialLimitFlag:specialLimit_post,
                outsourceAdminFlag:outsourceAdmin_post,
                specialChargeFlag:specialCharge_post,
                smeFlag:isSME_post,
                defAppMatrixFlag:isDefAppMatrix_post,
                tokenList:token_list,
                contactList:contact_list,
                adminList:admin_list,
                lldIsResidence: lldIsResidence,
                isResidenceText: residential,
                lldIsCitizen: lldIsCitizen,
                isCitizenText: citizenship,
                lldCategory: remitterType_code,
                isCategoryText: remitter,
                citizenCountryCode: citizenship_code,
                residenceCountryCode: residential_code,
                inactiveFlag:inactiveFlag

            };
            console.log(submit_data);
            $('.state_edit').hide();
            $('.state_view').show();
            $('#save_screen').hide();
            $('.help-block').hide();
            $('#done').hide();
            $('#next_user').hide();
        }

        function stateSuccess() {
            $('#state').val('success');

            $('input.state_edit').val('');
            $('input.check').attr('checked', '');
            $('#back_view').hide();
            $('#save_screen').show();
            $('#done').show();
            $('#next_user').show();
        }

        function resetFormValidator(formId) {
            $(formId).removeData('validator');
            $(formId).removeData('unobtrusiveValidation');
            $.validator.unobtrusive.parse(formId);
        }

</script>