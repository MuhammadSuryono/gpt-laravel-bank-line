@include('_partials.header_content',['breadcrumb'=>['Approval Mechanism'','detail']])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <input type="hidden" id="appMenuCode" value=""/>
            <input type="hidden" id="appMenuName" value=""/>
            <input type="hidden" id="appMatrixId" value=""/>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Approval Mechanism Detail</h3><br>
                </div>
                <form class="form-horizontal">
                    <div class="box-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Bank Approval Matrix Menu</label>
                                    <div class="col-md-6">
                                        <label id="menuCode">-</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Number of Approver</label>
                                    <div class="col-md-6">
                                        <label id="noApprover">-</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-header detail_view">
                        <h3 class="box-title">Approval Matrix Listing</h3><br>
                    </div>
                    <div class="box-body detail_view">
                        <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                            <thead>
                                <tr>
                                    <th align="left"><strong>Sequence No</strong></th>
                                    <th align="left"><strong>Number Of User</strong></th>
                                    <th align="left"><strong>Approval Level</strong></th>
                                    <th align="left"><strong>Target Branch</strong></th>
                                </tr>
                            </thead>
                        </table>           
                    </div>
                </form>
                <div class="box-footer">
                            <div class="float-left">
                                <button type="button" id="back" name="back" class="btn btn-default back">@lang('form.back')</button>
                                <button type="button" id="save_screen" name="save_screen" class="btn btn-default float-left" style="display:none" onclick="save_pdf();">@lang('form.save_pdf')</button>
                            </div>
                            <div class="float-right detail_view">
                                <button type="button" id="edit" name="edit" class="btn btn-primary">@lang('form.edit')</button>
                            </div>
                            <div class="float-right">
                                <button type="button" id="next_user" name="next_user" class="btn btn-info">@lang('form.next_user')</button>
                                <button type="button" id="done" name="done" class="btn btn-primary" style="display:none">@lang('form.done')</button>
                            </div>
                    </div>
                    @include('_partials.next_user')
            </div>
        </div>
    </div>

</section>

<script>
    var oTable;
    var id = '{{ $service }}';
    var noRef;
    var deleteData;
    var isEdit = false;

    $(document).ready(function () {
        
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
                    sortable: true,
                    width: "20%",
                    className: "dt-center"
                },
                {
                    targets: 1,
                    sortable: true,
                    width: "25%",
                    className: "dt-right"
                },
                {
                    targets: 2,
                    sortable: true,
                    width: "25%",
                    className: "dt-right"
                },
                {
                    targets: 3,
                    sortable: true,
                    width: "30%",
                    className: "dt-right"
                }
            ],
        });

        $('div.dt-buttons').css('float','right');
        $('a.dt-button').addClass('btn btn-primary');

        $('.back').on('click', function () {
            var res = app.setView(id,'landing');
        });

        $('#save_screen').hide();
        $('#next_user').hide();
        $('#done').hide();
                        
        
        $('#done').on('click', function () {
            var res = app.setView(id,'landing');
        });

        $('#edit').on('click', function () {
            var menuName = $('#menuCode').text();
            var noOfApprover = $('#noApprover').text();
            var menuCode = $('#appMenuCode').val();
            var appMatrixId = $('#appMatrixId').val();
            var res = app.setView(id,'add');
            if(res=='done'){
                $('#type').val('edit');
                $('#breadcrumb-action').html('edit');
                $('#appMenuName_1').val(menuName);
                $('#appMenuCode_1').val(menuCode);
                $('#noOfApprover_1').val(noOfApprover);
                $('#appMatrixId').val(appMatrixId);
                getDetailEdit();
            }
            
        });


    });

    function getDetail(){

        var url_action= 'searchBankApprovalMatrixDetail';
        var value ={
            approvalMatrixMenuCode: $('#appMenuCode').val(),
            currentPage: "1",
            pageSize: "20",
        };
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data:{value:value,menu:id,action:'DETAIL',url_action:url_action, _token : '{{ csrf_token() }}'},
            success: function (data) {
                var result = JSON.parse(data);
                var detail = result.result;

                if (result.status=="200") {
                    
                    $('#menuCode').text($('#appMenuName').val());
                    $('#noApprover').text(detail[0].noOfApprover);
                    $('#appMatrixId').val(detail[0].id);

                    if (detail) {
                        var matrixDetailList = detail[0].bankApprovalMatrixDetailList;
                        if (matrixDetailList) {
                            $.each(matrixDetailList, function (idx, obj){

                                var branchOpt = obj.branchOpt;
                                var branchOpt_view = "";
                                if (branchOpt == "PARENT") {
                                    branchOpt_view = "Parent Branch";
                                } else {
                                    branchOpt_view = "Same Branch"
                                }

                                oTable.row.add([
                                    obj.sequenceNo+'<input type=hidden id="sequenceHidden" value="'+obj.sequenceNo+'">',
                                    obj.noOfUser+'<input type=hidden id="noOfUserHidden" value="'+obj.noOfUser+'">',
                                    obj.approvalLevelCode+ " - " + obj.approvalLevelName+'<input type=hidden id="approvalLevelCodeHidden" value="'+obj.approvalLevelCode+'">'+'<input type=hidden id="approvalLevelNameHidden" value="'+obj.approvalLevelName+'">',
                                    branchOpt_view
                                ]).draw(true);
                            });
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

</script>