@include('_partials.header_content',['breadcrumb'=>[str_replace('-',' ',$menu),'Search']])

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Transaction Filter</h3>
                </div>
                <form class="form-horizontal">

                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Transaction Reference Number</label>
                                <div class="col-md-6">
                                    <input type="text" id="refNo" name="refNo" maxlength="40" class="form-control" autocomplete="off" value="">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Status</label>
                                <div class="col-md-6">
                                   <select class="form-control" id="status">
                                        <option></option>
                                   </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="box-footer">
                    <button type="button" id="search" name="search" class="btn  btn-primary float-left">@lang('form.search')</button>
                </div>

                </form>
                    <div class="box-header list-title">
                        <h3 class="box-title">Transaction Listing</h3>
                    </div>
                    <div class="box-body list-title">
                        <div class="container-fluid">
                           <div class="row">
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th align="center"><strong>Reference Number</strong></th>
                                        <th align="center"><strong>Corporate</strong></th>
										<th align="center"><strong>Status</strong></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
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


    $(document).ready(function () {
        var id = '{{ $service }}';
        var url_action = 'search';
        var action = 'SEARCH';
        var result_key = 'result';
        var custom_order = {"referenceNo": "ASC"};

        $('#list').hide();
        $('.list-title').hide();
		getStatusDroplist();

        $('#search').on('click', function () {

            $(this).prop("disabled",true);
            $('#list').show();
            $('.list-title').show();
            var value = {
				referenceNo: $('#refNo').val(),
                statusCode: $('#status').val(),
                currentPage: "1",
                pageSize: "50",
                // orderBy: {"referenceNo": "ASC"}
            };

            $('#list').DataTable({
                "destroy": true,
                "initComplete": function(settings, json) {
                    $('#search').prop("disabled",false);

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
                        data: {
                            referenceNo:"refNo", 
                            id :"id"
                        },
                        render: function ( data, type, full, meta ) {
                            return '<a href="javascript:void(0)" data-code="'+data.refNo+'" data-id="'+data.id+'">'+data.refNo+'</a>';
                        },
                        orderable: false
                    },
                    {
                        targets: 1,
						data: {
                            corporateId:"corpId", 
                            corporateName :"corpName"
                        },
                        render: function ( data, type, full, meta ) {
                            return data.corpId + ' - ' + data.corpName
                        },
                        orderable: false
                    },
					{
                        targets: 2,
                        data: "statusName",
                        orderable: false
                    }
                ],
                "ajax": {
                    url: "fetchDataTable",
                    type:'POST',
                    data: function ( d ) {
                        d.value = value;
                        d.menu = id;
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
                        $('#search').prop("disabled",false);
                    }
                }
            });
        });

        
         $('#list tbody').on('click', 'a', function (e) {
            if(e.handled !== true) // This will prevent event triggering more then once
            {
                e.handled = true;
            }
            var refNo = $(this).data('code');
            var idTrx = $(this).data('id');

            if (refNo !== undefined) {
                var res = app.setView(id,'detail');
                if(res=='done'){
                    $('#refNo').val(refNo);
                    $('#idTrx').val(idTrx);
                    getDetail();
                }
            }
        });

    });

	function getStatusDroplist() {
		var menu = '{{ $service }}';
        var value = {
            code: "",
            name: "",
        };
        var url_action = 'getStatusForDroplist';
        var action = 'SEARCH';
        var menu = menu;
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
                    unitOption = '<option value="" data-name = "">'+"all status"+ '</option>';
                    $.each(result.result, function (idx, obj) {
                        unitOption += '<option value="'+ obj.statusCode +'"data-name = "'+obj.statusName+'">'+ obj.statusName + '</option>';
                    });
                    $('#status').html(unitOption);
                    $('#status').select2();
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