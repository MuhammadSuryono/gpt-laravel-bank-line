
<section class="content">
    <div class="panel panel-default">
        <div class="panel-body box-body">
            <input type="hidden" id="referenceNo" value=""/>
                <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Benificiary Information</h3><br>
                </div>
                <div class="box-body deleteDetail" style="display:none">
                    <table id="listDelete" class="table table-bordered table-striped dataTable" border="2" cellpadding="2" style="border-collapse:collapse;">
                        <thead>
                            <tr>
                                <th align="center"><strong>Account Number</strong></th>
                                <th align="center"><strong>Account Name</strong></th>
                                <th align="center"><strong>Alias Name</strong></th>
                                <th align="center"><strong>Currency</strong></th>
                                <th align="center"><strong>Bank</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td align="center"></td>
                                <td align="left"></td>
                                <td align="left"></td>
                                <td align="left"></td>
                                <td align="left"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-body dataDetail">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Beneficiary</label>
                                <div class="col-md-6">
                                    <label id="beneficiary">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Alias Name</label>
                                <div class="col-md-6">
                                    <label id="benAlias">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Account Number</label>
                                <div class="col-md-6">
                                    <label id="benAccountNo">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Account Name</label>
                                <div class="col-md-6">
                                    <label id="benAccountName">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row internalBankType">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Currency</label>
                                <div class="col-md-6">
                                    <label id="benAccountCurrency">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row localOverseasBankType">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Address</label>
                                <div class="col-md-6">
                                    <label id="address1">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row localOverseasBankType">
                            <div class="form-group">
                                <label class="col-md-5 control-label"></label>
                                <div class="col-md-6">
                                    <label id="address2">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row localOverseasBankType">
                            <div class="form-group">
                                <label class="col-md-5 control-label"></label>
                                <div class="col-md-6">
                                    <label id="address3">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row localOverseasBankType">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Status</label>
                                <div class="col-md-6">
                                    <label id="status">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row localOverseasBankType">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Citizenship</label>
                                <div class="col-md-6">
                                    <label id="citizenship">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row overseasBankType">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Identity</label>
                                <div class="col-md-6">
                                    <label id="overseasIdentity">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row overseasBankType">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Transactor Relationship</label>
                                <div class="col-md-6">
                                    <label id="overseasRelation">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row localBankType">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Beneficiary Type</label>
                                <div class="col-md-6">
                                    <label id="beneType">-</label>
                                </div>
                            </div>
                        </div>
                        <hr style="height:1px;border:none;color:#333;background-color:#d2d6de;"/>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Notify the Beneficiary</label>
                                <div class="col-md-6">
                                    <label id="notify">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row notifyEmail" style="display:none">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Beneficiary Email Address</label>
                                <div class="col-md-6">
                                    <label id="email">-</label>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="box-header localOverseasBankType dataDetail">
                    <h3 class="box-title">Bank Information</h3><br>
                </div>
                <div class="box-body dataDetail">
                    <div class="container-fluid localOverseasBankType">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Beneficiary Bank</label>
                                <div class="col-md-6">
                                    <label id="beneBank">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">SKN Code</label>
                                <div class="col-md-6">
                                    <label id="sknCode">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">RTGS Code</label>
                                <div class="col-md-6">
                                    <label id="rtgsCode">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Branch</label>
                                <div class="col-md-6">
                                    <label id="branchName">-</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">City</label>
                                <div class="col-md-6">
                                    <label id="cityName">-</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid overseasBankType">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Country</label>
                                <div class="col-md-6">
                                    <label id="overseasCountry">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Beneficiary Bank</label>
                                <div class="col-md-6">
                                    <label id="overseasBank">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">SWIFT Code</label>
                                <div class="col-md-6">
                                    <label id="overseasSwift">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Branch</label>
                                <div class="col-md-6">
                                    <label id="overseasBranch">-</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-5 control-label">Address</label>
                                <div class="col-md-6">
                                    <label id="overseasAddress">-</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<script>
    var oTable;
    var listDelete;
    var service = '{{ $service }}';
    $(document).ready(function () {

        listDelete = $('#listDelete').DataTable({
            "paging" : false,
            "ordering" : false,
            "info": false,
            "destroy": true,
            "searching": false,
            "autoWidth":false,
            "columnDefs": [
               {
                    sortable: false,
                    width: "20%",
                    targets: 0,
               },
               {
                    targets: 1,
                    sortable: false,
                    width: "20%"
                },
                {
                    targets: 2,
                    sortable: false,
                    width: "20%"
                },
                {
                    targets: 3,
                    sortable: false,
                    className: 'dt-center',
                    width: "20%"
                },
                {
                    targets: 4,
                    sortable: false,
                    width: "20%"
                }

            ]
        });

    });

    function getDetailData(refNo){
        var value = {
            referenceNo : refNo
        };
        var url_action = 'detailPendingTask';
        var action = 'DETAIL';
        var menu = service;
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
                    var detail = result.details;
                    var confirm_data = detail.confirm_data;

                    deleteList = detail.dataDelete;
                    if (detail.stateView) {
                        prepareDeleteDetail(deleteList);
                        $('.deleteDetail').show();
                        $('.dataDetail').hide();

                    } else {

                        $('.deleteDetail').hide();

                        var beneMenuType = confirm_data.beneficiary;

                        $('#beneficiary').text(beneMenuType !='Overseas' ? confirm_data.beneficiary : confirm_data.beneListType);
                        $('#benAlias').text(confirm_data.alias_name);
                        $('#benAccountNo').text(confirm_data.account_number);
                        $('#benAccountName').text(confirm_data.account_name);

                        $('#notify').text(confirm_data.notify_benificiary);
                        if (detail.isNotify == 'Y' || confirm_data.isNotify == 'Y') {
                            $('#email').text(confirm_data.benificiary_email);
                            $('.notifyEmail').show();
                        }

                        if (beneMenuType == 'Internal Bank') {

                            $('#benAccountCurrency').text(confirm_data.account_currency);

                            $('.internalBankType').show();
                            $('.localOverseasBankType').hide();
                            $('.overseasBankType').hide();

                        } else {
                            $('.internalBankType').hide();

                            $('#address1').text(confirm_data.address1);
                            $('#address2').text(confirm_data.address2);
                            $('#address3').text(confirm_data.address3);
                            $('#status').text(confirm_data.status);
                            $('#citizenship').text(confirm_data.citizenship);

                            // $('#remark').text(detail.remark1);
                            // $('#paymentSchedule').text(confirm_data.payment_schedule);
                            

                            if (beneMenuType == 'Overseas') {
                                $('#overseasIdentity').text(confirm_data.overseas_identity);
                                $('#overseasRelation').text(confirm_data.overseas_relation);
                                $('#overseasCountry').text(detail.overseas_country != '' ? detail.overseas_country :confirm_data.overseas_country);
                                $('#overseasBank').text(detail.overseas_bank != '' ? detail.overseas_bank : confirm_data.overseas_bank);
                                $('#overseasSwift').text(detail.overseas_swift != '' ? detail.overseas_swift : confirm_data.overseas_swift);
                                $('#overseasBranch').text(detail.overseas_branch != '' ? detail.overseas_branch : confirm_data.overseas_branch);
                                $('#overseasAddress').text(detail.overseas_address != '' ? detail.overseas_address : confirm_data.overseas_address);

                                $('.overseasBankType').show();
                                $('.localBankType').hide();

                            }

                            if (beneMenuType == 'Local Bank') {
                                $('#beneType').text(confirm_data.beneficiary_type);
                                $('#beneBank').text(confirm_data.beneficiary_bank);
                                $('#sknCode').text(confirm_data.skn_code);
                                $('#rtgsCode').text(confirm_data.rtgs_code);
                                $('#branchName').text(confirm_data.branch);
                                $('#cityName').text(confirm_data.city);


                                $('.localBankType').show();
                                $('.overseasBankType').hide();

                            }


                        }
                        
                        

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

            }
        });
    }

    function prepareDeleteDetail(deleteList){

        listDelete.clear();
        $.each(deleteList, function (idx, obj) {
                listDelete.row.add([
                                obj.benAccountNo,
                                obj.benAccountName,
                                obj.benAliasName,
                                obj.benAccountCurrency,
                                obj.bankName
                ]).draw(false);
        });

    }


</script>