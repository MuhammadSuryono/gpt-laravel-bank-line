<?php echo $__env->make('_partials.header_content',['breadcrumb'=>['Charging Report','Search']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div class="box">
                <div id="spinner" style="display:none"></div>
                <div class="box-header">
                    <h3 class="box-title">Report Filter</h3>
                </div>
                <form class="form-horizontal" id="form-area">

                <div class="box-body">
                    <div class="container-fluid">
                            <div class="row">
								<div class="form-group">
									<label class="col-md-2 control-label"><strong>Menu</strong></label>

									<div class="col-md-6">
										<select class="form-control" id="searchMenu" data-error="please select menu" required>
											<option>select menu</option>
										</select>
										<div class="help-block with-errors"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<label class="col-md-2 control-label"><strong>Transaction Date</strong></label>
									<div class="col-md-6">
										<div class="col-xs-5 no-padding">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<input type="text" id="dateFrom" name="dateFrom" class="form-control datepicker detail numeric" autocomplete="off" value="" >
											</div>		
										</div>
										<div>
											<label class="col-md-2 text-center control-label"><strong>to</strong></label>
										</div>
										<div class="col-xs-5 no-padding">
											<div class="input-group">
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
												<input type="text" id="dateTo" name="dateTo" class="form-control datepicker numeric" autocomplete="off" value="" >
											</div>
										</div>
									</div>
								</div>
							</div>
					</div>
                </div>
                <div class="box-footer">
                    <!-- <div class="float-left">
                        <button type="button" id="search" name="search" class="btn btn-primary"><?php echo app('translator')->get('form.save_pdf'); ?></button>
                    </div> -->
                    <div >
                        <div class="float-left">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Request Download
                                <span class="fa fa-caret-down"></span>
                            </button>
							
							<ul class="dropdown-menu" id="downloadFormat">
							
                            </ul>
                        </div>
						<div class="float-right">
							<button type="button" id="search" name="search" class="btn btn-primary">Refresh                               
							</button>				
						</div>
                    </div>
					
                </div>
                </form>
            </div>
			<div class="box-header list-title">
					<h3 class="box-title">Pending Download</h3>
                </div>
                
				<div class="box-body list-title">
                    <div class="container-fluid">
                        <div class="row">
                            <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                <thead>
									<tr>
										<th align="center"><strong>No</strong></th>
										<th align="center"><strong>Request Date Time</strong></th>
										<th align="center"><strong>File Type</strong></th>
										<th align="center"><strong>File Name</strong></th>
										<th align="center"><strong>File Status</strong></th>
										<th align="center"><strong></strong></th>
											
									</tr>
                                </thead>
                                <tbody>
                                    <tr>
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

        getSearchMenu();
		getFormatDroplist();
		searchReport();

        $('.datepicker').datepicker({
            format: "dd/mm/yyyy",
            locale: 'id'
        });

        // $('#dateFrom').val(moment(new Date(),"DD/MM/YYYY hh:mm").format("DD/MM/YYYY")); //start from today
        // $('#dateTo').val(moment(new Date()).add(1, 'days').format("DD/MM/YYYY"));    // end tommorow
        $('#dateFrom').val(moment(new Date()).subtract(3, 'months').format("DD/MM/YYYY"));
        $('#dateTo').val(moment(new Date(),"DD/MM/YYYY hh:mm").format("DD/MM/YYYY"));

        setTimeout(function(){
                    window.$('.dropdown-toggle').dropdown();
                },200)

		//setInterval(function(){ 
			//searchReport();
		//}, 10000);//time in milliseconds 

		$('#search').on('click', function () {
			searchReport();
		});
    });

	function searchReport() {
		setTimeout(function(){
                
                   var validate = true;
			
					
					var value = {};
		var url_action = 'search';
        var action = 'SEARCH';
        var result_key = 'result';
        var custom_order = '';
		
					value = {
						
						orderBy: {"createdDate": "ASC"},
						currentPage: "1",
						pageSize: "20"
					};
					
					

				if(validate){
					$('#list').show();
					$('.list-title').show();
					var index = 1;
					$('#list').DataTable({
						"destroy": true,
						"initComplete": function(settings, json) {
							
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
                                data: "indexNo",
                                className: 'dt-center',
                            },
							{
								targets: 1,
								data: "createdDate",
								orderable: false
							},
							{
								targets: 2,
								data: "fileType",
								orderable: false
							},
							{
								targets: 3,
								data: "fileName",
								orderable: false
							},
							{
								targets: 4,
								data: "statusDescription",
								orderable: false
							},
							{
								targets: 5,
								data: {isReadyForDownload:"isReadyForDownload", id: "id"},
								width: "15%",
								render: function ( data, type, full, meta ) {
									var disabled = 'disabled';
									if(data.isReadyForDownload == 'Y'){
										disabled = '';
									}
									return '<button data-id="'+data.id+'" class="btn btn-primary" style="width:125px;" align="center" onClick="downloadReport(\''+data.id+'\');"' +disabled+'>Download</button>';
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
							}
						}
					});
                }
            });
	}
	
    function getSearchMenu() {
        var value = {
            code: "",
			mennuCode:menu
        };
        var url_action = 'searchMenu';
        var action = 'SEARCH';
        var menu = service;
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data: {
                value : value,
                menu : menu,
                url_action : url_action,
                action : action,
                _token : '<?php echo e(csrf_token()); ?>'
            },
            success: function (data) {
                var result = JSON.parse(data);
                if (result.status=="200") {
                    unitOption = '<option value="">select menu</option>';
                    $.each(result.result, function (idx, obj) {
                        unitOption += '<option value="' + obj.menuCode + '">' + obj.menuName + '</option>';
                    });
                    $('#searchMenu').html(unitOption);
                    $('#searchMenu').select2();
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

	
    function getFormatDroplist() {

        var url_action = 'fileFormat';
        var action = 'SEARCH';
        var menu = service;
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data: {
                value : '',
                menu : menu,
                url_action : url_action,
                action : action,
                _token : '<?php echo e(csrf_token()); ?>'
            },
            success: function (data) {
                var result = JSON.parse(data);
                if (result.status=="200") {
                    formats = '';
                    $.each(result.fileFormats, function (idx, obj) {
                        formats += '<li><a data-code="' + obj.ext +'" href="javascript:requestDownload(\''+obj.name+'\')">' + obj.name + '</a></li>';
                    });
                    $('#downloadFormat').html(formats);
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

	function requestDownload(fileFormat){
		var value = {
                        searchMenuCode : "",
                        fromDate : "",
                        toDate : "",
						statusCode:"",
                        fileFormat: fileFormat,
                };

				$('#form-area').validator('validate');
				
                var validate = true;
                
				value.searchMenuCode = $('#searchMenu').val();
				
				if($('#searchMenu').val() == ''){
					validate = false;
					return;
				}
				
				if ($('#dateFrom').val() == '') {
						validate = false;
                        return;
                }
				if ($('#dateTo').val() == '') {
						validate = false;
                        return;
                }
                
                if(checkDate()>0){
                    var content ='<?php echo e(trans('form.alert_date_compare_report')); ?>';
                    $.alert({
                        title: '<?php echo e(trans('form.warning')); ?>',
                        content: content
                    });
                    return;
                }

                value.fromDate = $('#dateFrom').val();
                value.toDate = $('#dateTo').val();

			if(validate){
				$.ajax({
					url: 'getAPIData',
					method: 'post',
					data: {
						value : value,
						menu : service,
						url_action : 'submit',
						action : 'REQUEST_DOWNLOAD',
						_token : '<?php echo e(csrf_token()); ?>'
					},
					success: function (data) {
						var result = JSON.parse(data);
						if (result.status=="200") {
							noRef=result.referenceNo;
							flash('success', result.message+'<br>'+'ReferenceNo: '+ result.referenceNo+'<br>'+result.dateTimeInfo);
							searchReport();
						} else {
							flash('warning', result.message);
						}

					}, error: function (xhr, ajaxOptions, thrownError) {
						flash('warning', 'Form Submit Failed');
						console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
					}
				});
		}
	}

    function checkDate(){
        
        var count = 0;
        var date1 = $("#dateFrom").data('datepicker').getFormattedDate('yyyy/mm/dd');
        var date2 = $("#dateTo").data('datepicker').getFormattedDate('yyyy/mm/dd');

        if(date1 == '')
            date1 = moment(new Date()).subtract(3, 'month').format("YYYY/MM/DD");

        if(date2 == '')
            date2 = moment(new Date(),"DD/MM/YYYY hh:mm").format("YYYY/MM/DD")
            
        if(date2!=''){
            var x = new Date(date1);
            var y = new Date(date2);
            if(x>y){
                count = 1;
            }
        }
        return count;

    }
	
    function downloadReport(downloadId) {

            
                var value = {
                        downloadId : downloadId,
                };


                    $.ajax({
                        url: 'getAPIData',
                        method: 'post',
                        data: {
                            value : value,
                            menu : service,
                            url_action : 'downloadReport',
                            action : 'DOWNLOAD',
                            _token : '<?php echo e(csrf_token()); ?>'
                        },
                        success: function (data) {

                            $.ajax({
                                url: 'downloadFile',
                                method: 'POST',
                                cache: false,
                                data:{
                                    url_action : 'download',
                                    // value:'EXECUTE',
                                    service:service,
                                },
                                xhrFields: {
                                    withCredentials: true,
                                    responseType:'arraybuffer'
                                },
                               success: function (response, status, xhr) {
                                   var filename = "";
                                   var disposition = xhr.getResponseHeader('Content-Disposition');
                                   if (disposition && disposition.indexOf('attachment') !== -1) {
                                       var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                                       var matches = filenameRegex.exec(disposition);
                                       if (matches != null && matches[1]) filename = matches[1].replace(/['"]/g, '');
                                   }

                                   var type = xhr.getResponseHeader('Content-Type');
                                   var blob = new Blob([response], { type: type });
                                   saveAs(blob, filename);


                                }

                            });

                        }, error: function (xhr, ajaxOptions, thrownError) {
                            var msg = '<?php echo e(trans('form.conn_error')); ?>';
                            flash('warning', msg);
                            console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                        }, complete: function (data) {

                        }
                    });

    }

</script><?php /**PATH C:\xampp8\htdocs\bank-line\resources\views/bank-line/MNU_GPCASH_BO_RPT_CHG/landing.blade.php ENDPATH**/ ?>