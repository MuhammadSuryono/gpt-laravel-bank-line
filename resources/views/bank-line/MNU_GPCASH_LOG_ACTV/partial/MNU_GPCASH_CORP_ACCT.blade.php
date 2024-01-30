				<div class="box-header">
                    <h3 class="box-title">Corporate Account Detail</h3><br>
                </div>
                <form class="form-horizontal">
                    <div class="box-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Corporate</label>
                                    <div class="col-md-6">
                                        <label id="code_1">-</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">CIF</label>
                                    <div class="col-md-6">
                                        <label id="cifid">-</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="box-header">
                    <h3 class="box-title table-hidden">Account Listing</h3>
                </div>
                    <div class="box-body">
                     <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th align="center"><strong>Account Number</strong></th>
                                        <th align="center"><strong>Account Name</strong></th>
                                        <th align="center"><strong>Currency</strong></th>
                                        <th align="center"><strong>Account Type</strong></th>
                                        <th align="center"><strong>Allow Inquiry</strong></th>
                                        <th align="center"><strong>Allow Debit</strong></th>
                                        <th align="center"><strong>Allow Credit</strong></th>
                                        <th align="center"><strong>Status</strong></th>
                                    </tr>
                                    </thead>

                                </table>
                     </div>
				
<script>
    var oTable;
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
                    width: "5%",
                    className: "dt-center"
                },
                {
                    targets: 3,
                    sortable: true,
                    width: "15%"
                },
                {
                    targets: 4,
                    sortable: false,
                    width: "7%",
                    className: "dt-center",
                    "render": function ( data, type, row ) {
                        if(data=="Y"){
                            return '<input type="hidden" id="isAllowInquiry" value="'+data+'"><span class="label label-success">&nbsp;&nbsp;YES&nbsp;&nbsp;</span>'
                        }else{
                            return '<input type="hidden" id="isAllowInquiry" value="'+data+'"><span class="label label-danger">&nbsp;&nbsp;NO&nbsp;&nbsp;</span>'
                        }
                    }
                },
                {
                    targets: 5,
                    sortable: false,
                    width: "7%",
                    className: "dt-center",
                    "render": function ( data, type, row ) {
                        if(data=="Y"){
                            return '<input type="hidden" id="isAllowDebit" value="'+data+'"><span class="label label-success">&nbsp;&nbsp;YES&nbsp;&nbsp;</span>'
                        }else{
                            return '<input type="hidden" id="isAllowDebit" value="'+data+'"><span class="label label-danger">&nbsp;&nbsp;NO&nbsp;&nbsp;</span>'
                        }
                    }
                },
                {
                    targets: 6,
                    sortable: false,
                    width: "7%",
                    className: "dt-center",
                    "render": function ( data, type, row ) {
                        if(data=="Y"){
                            return '<input type="hidden" id="isAllowCredit" value="'+data+'"><span class="label label-success">&nbsp;&nbsp;YES&nbsp;&nbsp;</span>'
                        }else{
                            return '<input type="hidden" id="isAllowCredit" value="'+data+'"><span class="label label-danger">&nbsp;&nbsp;NO&nbsp;&nbsp;</span>'
                        }
                    }
                },
                {
                    targets: 7,
                    sortable: false,
                    width: "7%",
                    className: "dt-center",
                    "render": function ( data, type, row ) {
                        if(data=="N"){
                            return 'Inactive'
                        }else{
                            return 'Active'
                        }
                    }
                }

            ]
        });
		
		getDetail('MNU_GPCASH_LOG_ACTV')
    });

    function getDetail(id){
        var pendingTaskId_id= $('#pendingTaskId').val();
        var url_action= 'detailPendingTask';
         var value ={
            pendingTaskId:pendingTaskId_id,
            currentPage: "1",
            pageSize: "20",
            orderBy: {"code": "ASC"}
        };
        var action = 'DETAIL';
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data: {
                value : value,
                menu : id,
                url_action : url_action,
                action : action,
                _token : '{{ csrf_token() }}'
            },
            success: function (data) {

                var result = JSON.parse(data);
                if(result.status == '200'){
                
					var detail = result.details.accountList;
					$('#code_1').text(result.details.corporateId+' - '+result.details.name);
					$('#cifid').text(result.details.cifId);
					oTable.clear();
					if(detail){
						$.each(detail, function (idx, obj){
							oTable.row.add([
								obj.accountNo,
								obj.accountName,
								obj.accountCurrencyCode,
								obj.accountTypeName,
								obj.isAllowInquiry,
								obj.isAllowDebit,
								obj.isAllowCredit,
								obj.accountStatus
							]).draw(true);
						});
					}
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

</script>