@include('_partials.header_content',['breadcrumb'=>['Domestic Transfer Report','Search']])


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
                                <div class="col-md-2">
                                   <input type="radio" id="corporate-rb" name="searchBy-rb" value="0" checked>
                                   <label for="corporate-rb"><strong>Corporate</strong></label>
                                </div>
                                <div class="col-md-7 row-corporate" style="margin-left: 15px;">
                                    <select class="form-control" id="corporate" data-error="please select corporate" required>
                                        <option></option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-service">
                            <div class="form-group">
                                <div class="col-md-2" style="margin-left: 15px;">
                                    <label>Service</label>
                                </div>
                                <div class="col-md-7">
                                    <select class="form-control" id="domService">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row row-corpaccount">
                            <div class="form-group">
                                <div class="col-md-2" style="margin-left: 15px;">
                                    <label>Corporate Account</label>
                                </div>
                                <div class="col-md-7">
                                    <select class="form-control" id="corpAccount">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row row-date">
                            <div class="form-group" style="margin-left: 15px;">
                                <label class="col-md-2">Date Range</label>
                                <div class="col-md-2 form-inline">
                                    <select class="form-control " id="dateType">
                                        <option value="0">Creation Date</option>
                                        <option value="1">Payment Date</option>
                                    </select>
                                </div>
                                <div class="form-inline dateSelect">
                                    <div class="col-md-8" style="margin-left:-25px">
                                        <div class="col-xs-5 col-md-3 no-padding">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type="text" id="dateFrom" name="dateFrom" class="form-control datepicker detail numeric" autocomplete="off" value="">
                                            </div>
                                        </div>
                                        <div>
                                            <label class="col-md-1 text-center control-label"><strong>to</strong></label>
                                        </div>
                                        <div class="col-xs-5 col-md-3 no-padding">
                                            <div class="input-group state_edit">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type="text" id="dateTo" name="dateTo" class="form-control datepicker numeric" autocomplete="off" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-status">
                            <div class="form-group">
                                <div class="col-md-2" style="margin-left: 15px;">
                                    <label>Transaction Status</label>
                                </div>
                                <div class="col-md-7">
                                    <select class="form-control" id="trxStatus">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-3">
                                   <input type="radio" id="refNo-rb" name="searchBy-rb" value="1">
                                   <label for="refNo-rb">Reference Number</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" id="refNo" name="refNo" class="form-control" autocomplete="off" value="" maxlength="40" style="display: none">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="box-footer">
                    <div >
                        <div class="float-left">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Request Download
                                <span class="fa fa-caret-down"></span>
                            </button>
							
							<ul class="dropdown-menu" style="top: inherit; left: inherit;"id="downloadFormat"></ul>
                        </div>
						<div class="float-right">
							<button type="button" id="search" name="search" class="btn btn-primary">Refresh                               
							</button>				
						</div>
                    </div>
                </div>
                </form>

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
    </div>

</section>

<script>
    var service = '{{ $service }}';

    $(document).ready(function () {
		
		var url_action = '';
        var action = 'SEARCH';
        var result_key = 'result';
        var custom_order = {"referenceNo": "DESC"};
        var data_code = '';

        getCorporate();
		getFormatDroplist();
		searchReport();

        getDomService(this.value);
        getStatusDroplist(this.value);
        
        $('.datepicker').datepicker({
            format: "dd/mm/yyyy",
            locale: 'id'
        });

        $('#dateFrom').val(moment(new Date(),"DD/MM/YYYY hh:mm").format("DD/MM/YYYY")); // start from today
        // $('#dateTo').val(moment(new Date()).add(1, 'days').format("DD/MM/YYYY"));    // end to tommorow
        // $('#dateFrom').val(moment(new Date()).subtract(3, 'month').format("DD/MM/YYYY")); //start from last 3 month
        $('#dateTo').val(moment(new Date(),"DD/MM/YYYY hh:mm").format("DD/MM/YYYY")); // end to today

        setTimeout(function(){
                    window.$('.dropdown-toggle').dropdown();
                },200)

		//setInterval(function(){ 
			//searchReport();
		//}, 10000);//time in milliseconds 

		$('#search').on('click', function () {
			searchReport();
		});

        $('input[name="searchBy-rb"]').on('change', function(e){
            if (this.value=='1') {
                $('.row-corporate').hide();
                $('.row-service').hide();
                $('.row-corpaccount').hide();
                $('.row-date').hide();
                $('.row-status').hide();
                $('#refNo').show();

                $('#form-area').validator('reset');

            } else {
                $('.row-corporate').show();
                $('.row-service').show();
                $('.row-corpaccount').show();
                $('.row-date').show();
                $('.row-status').show();
                $('#refNo').hide();
            }
        });

        // $('#domService').prop("disabled",true);
        $('#corpAccount').prop("disabled",true);
        // $('#dateType').prop("disabled",true);
        // $('#dateFrom').prop("disabled",true);
        // $('#dateTo').prop("disabled",true);
        // $('#trxStatus').prop("disabled",true);

        $('select[id="corporate"]').on('change', function(e) {         
            // $('#domService').prop("disabled",false);
            $('#corpAccount').prop("disabled",false);
            // $('#dateType').prop("disabled",false);
            // $('#dateFrom').prop("disabled",false);
            // $('#dateTo').prop("disabled",false);
            // $('#trxStatus').prop("disabled",false);
            // getDomService(this.value);
            getCorporateAccountDroplist(this.value);
            // getStatusDroplist(this.value);
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
                            data: "createdDate",
                            render: function ( data, type, full, meta ) {
                                return index++;
                            },						
                            orderable: false
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
                            d._token = '{{ csrf_token() }}';
                        },
                        error:function (jqXHR, textStatus, errorThrown) {

                            var msg = '{{trans('form.conn_error')}}';
                            flash('warning', msg);
                            $('#list').hide();
                            $('.list-title').hide();
                        }
                    }
                });
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
                _token : '{{ csrf_token() }}'
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
                var msg = '{{trans('form.conn_error')}}';
                flash('warning', msg);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {

            }
        });

    }

	function requestDownload(fileFormat){
        var value = {
                        referenceNo : "",
                        corporateId : "",
                        service : "",
                        corpAccount : "",
                        dateType : "",
                        fromDate : "",
                        toDate : "",
                        status : "",
                        fileFormat: fileFormat,
                };
        var validate = true;

        // $('.row-corporate').validator('validate');
        // if ($('#corporate').val() == "") {
        //     validate = false;
        //     return;
        // }

        if ($('#dateFrom').val() == '') {
            validate = false;
            return;
        }
        if ($('#dateTo').val() == '') {
            validate = false;
            return;
        }
        
        value.referenceNo = $('#refNo').val();
        value.corporateId = $('#corporate').val();
        value.service = $('#domService').val();
        value.corpAccount = $('#corpAccount').val();
        value.dateType = $('#dateType').val();
        value.fromDate = $('#dateFrom').val();
        value.toDate = $('#dateTo').val();
        value.status = $('#trxStatus').val();
    
		$.ajax({
			url: 'getAPIData',
            method: 'post',
            data: {
                value : value,
                menu : service,
                url_action : 'submit',
                action : 'REQUEST_DOWNLOAD',
                _token : '{{ csrf_token() }}'
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
                            _token : '{{ csrf_token() }}'
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
                            var msg = '{{trans('form.conn_error')}}';
                            flash('warning', msg);
                            console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                        }, complete: function (data) {

                        }
                    });

    }

    function getStatusDroplist(corpId) {

        var value = {
            corporateId: corpId
        };
        var url_action = 'getTransactionStatus';
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
                _token : '{{ csrf_token() }}'
            },
            success: function (data) {
                var result = JSON.parse(data);
                if (result) {
                    unitOption = '<option value="">All Status</option>';
                    $.each(result, function (idx, obj) {
                        unitOption += '<option value="' + obj.key + '">' + obj.value + '</option>';
                    });
                    $('#trxStatus').html(unitOption);
                    $('#trxStatus').select2();
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

    function getCorporateAccountDroplist(corpId) {

        var value = {
            corporateId: corpId
        };
        var url_action = 'searchSourceAccount';
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
                _token : '{{ csrf_token() }}'
            },
            success: function (data) {
                var result = JSON.parse(data);
                if (result.status=="200") {
                    unitOption = '<option value="">All Account</option>';
                    $.each(result.accounts, function (idx, obj) {
                        unitOption += '<option value="' + obj.accountNo + '">' + obj.accountNo + ' / ' + obj.accountName + ' (' + obj.accountCurrencyName + ')' + '</option>';
                    });
                    $('#corpAccount').html(unitOption);
                    $('#corpAccount').select2();
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

    function getCorporate() {
        var value = {
            code: "",
        };
        var url_action = 'searchCorporate';
        var action = 'SEARCH';
        var menu = service;
        // var menu = 'MNU_GPCASH_BO_RPT_TRX_STS'; 
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
                    unitOption = '<option value="">All Corporate</option>';
                    $.each(result.result, function (idx, obj) {
                        unitOption += '<option value="' + obj.corporateId + '">' + obj.corporateName + '</option>';
                    });
                    $('#corporate').html(unitOption);
                    $('#corporate').select2();
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

    function getDomService() {
        var value = {
            code: "",
        };
        var url_action = 'searchDomServiceList';
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
                _token : '{{ csrf_token() }}'
            },
            success: function (data) {
                var result = JSON.parse(data);
                if (result.status=="200") {
                    unitOption = '<option value="">All Domestic Services</option>';
                    $.each(result.result, function (idx, obj) {
                        unitOption += '<option value="' + obj.srvcCd + '">' + obj.srvcNm + '</option>';
                    });
                    $('#domService').html(unitOption);
                    $('#domService').select2();
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


</script>