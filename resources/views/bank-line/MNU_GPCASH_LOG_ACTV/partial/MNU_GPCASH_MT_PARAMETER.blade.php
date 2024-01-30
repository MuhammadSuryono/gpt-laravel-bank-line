				<div class="box-header detail" style="display:none">
                    <span id="detail" class="detail" style="color:darkred;"><small><i>Detail</i></small></span>
                </div>
                <div class="box-header">
                    <h3 class="box-title"><label id="modelName"></label> Detail</h3><br>
                </div>

                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Code</label>
                                <div class="col-md-6">
                                    <label id="code_1">-</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Name</label>
                                <div class="col-md-6">
                                    <label id="name">-</label>
                                </div>
                            </div>
                        </div>
						<div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Description</label>
                                <div class="col-md-6">
                                    <label id="dscp">-</label>
                                </div>
                            </div>
                        </div>
						<div class="row stateParent">
                            <div class="form-group">
                                <label class="col-md-2 control-label" id="parentLabel"></label>
                                <div class="col-md-6">
                                    <label id="parentName">-</label>
                                </div>
                            </div>
                        </div>										
                    </div>
                </div>

<script>
    var oTable;

    $(document).ready(function () {       
		getDetail('MNU_GPCASH_LOG_ACTV');
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
                 if (result.status=="200") {
                    var detail = result.details.menuList;
                    $('#code_1').text(result.details.code);
                    $('#name').text(result.details.name);
                    $('#dscp').text(result.details.dscp);
					$('#modelName').text(result.details.modelName);
					if(result.details.parentLabel){
						$('#parentLabel').text(result.details.parentLabel);
						$('#parentName').text(result.details.parentName);	
						$('.stateParent').show();
					}else{
						$('.stateParent').hide();
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

</script>