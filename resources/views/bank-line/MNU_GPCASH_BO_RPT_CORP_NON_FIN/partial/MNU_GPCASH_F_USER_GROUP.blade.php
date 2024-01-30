				<div class="box-header">
                    <h3 class="box-title">Group Information</h3><br>
                </div>
				<div class="box-body">
                    <div class="container-fluid">
						<div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Corporate</label>
                                <div class="col-md-6">
                                    <label id="corporate">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">User Group Code</label>
                                <div class="col-md-6">
                                    <label id="code">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">User Group Name</label>
                                <div class="col-md-6">
                                    <label id="name">-</label>
                                </div> 
                            </div>
                        </div>
						<div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Account Group</label>
                                <div class="col-md-6">
                                    <label id="accountGroupName">-</label>
                                </div> 
                            </div>
                        </div>						
                    </div>
                </div>
				<div class="box-header">
                    <h3 class="box-title">Menu</h3><br>
                </div>
				<div class="box-body" id="menuList"></div>
				
				<div class="box-header">
                    <h3 class="box-title">Transaction Limit</h3><br>
                </div>
				<div class="box-body list-title">
                    <div class="container-fluid">
                        <div class="row">
                            <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                <thead>
									<tr>
										<th align="center"><strong>Service</strong></th>
										<th align="center"><strong>Currency Schema</strong></th>
										<th align="center" colspan ="2"><strong>Maximum Transaction Amount (Daily)</strong></th>
									</tr>
                                </thead>
                                <tbody>
                                    <tr>
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
<script>
    var oTable;

	$(document).ready(function () {   

		oTable = $('#list').DataTable({
            "paging" : false,
            "ordering" : false,
            "info": false,
            "destroy": true,
            "select": false,
            "searching": false,
            "autoWidth":false,
            "columnDefs": [
                {
                    targets: 0,
                    sortable: false
                },
               {
                    targets: 1,
                    sortable: false
                },
                {
                    targets: 2,
                    sortable: false
                },
                {
                    targets: 3,
                    sortable: false,
					className:"dt-right",
                    render: $.fn.dataTable.render.number( ',', '.', 0, '' )
                },             
            ]
        });
 
        $('.back').on('click', function () {
            var res = app.setView(id,'landing');
        });

		getDetail('MNU_GPCASH_BO_RPT_CORP_NON_FIN');
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
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data:{value:value,menu:id,action:'DETAIL',url_action:url_action},
            success: function (data) {

                var result = JSON.parse(data);
				var detail = result.details;
				console.log(result);
                if (result.status=="200") {                    
                    $('#corporate').text(detail.corporateId + " - " + detail.corporateName);
					$('#code').text(detail.code);
					$('#name').text(detail.name);
					$('#accountGroupName').text(detail.accountGroupName);
					
					var menuList = result.details.menuList;
					var html = ''
					if(menuList){
						$.each(menuList, function (idx, obj){
							html +='<div class="row" style="margin-left:10Px; margin-bottom:-30Px"><div class="form-group">';
							html += '<label><strong>' + obj.menuName + '</strong></label>'					
							html += '</div></div>'
						});
                    }
					$('#menuList').html(html);
					
					var limitList = result.details.limitList;
                    oTable.clear();
                    if(limitList){
						$.each(limitList, function (idx, obj){
					
                        oTable.row.add([                                   
                            obj.serviceName,
                            obj.currencyMatrixName,
                            obj.currencyName,
							obj.maxAmountLimit		
                        ]).draw(false);

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
            
        });
    }

   

</script>