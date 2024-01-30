@include('_partials.header_content',['breadcrumb'=>[str_replace('-',' ',$menu),'Search']])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Parameter Maintenance Filter</h3>
                </div>
                <form class="form-horizontal">

                <div class="box-body">
                    <div class="container-fluid">
						<div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Menu</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="modelCode">
                                        <option></option>
                                   </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Code</label>

                                <div class="col-md-6">
                                    <input type="text" id="code" name="code" class="form-control" autocomplete="off" value="" maxlength="40">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Name</label>

                                <div class="col-md-6">
                                    <input type="text" id="name" name="name" class="form-control" autocomplete="off" value="" maxlength="100">

                                </div>
                            </div>
                        </div>						
                    </div>
                </div>
                
                <div class="box-footer">
                    <button type="button" id="search" name="search" class="btn  btn-primary float-left">@lang('form.search')</button>
                    <button type="button" id="add" name="add" class="btn  btn-info float-right">@lang('form.add')</button>
                </div>

                </form>
                    <div class="box-header list-title">
                        <h3 class="box-title"><label id="modelName"></label> Listing</h3>
                    </div>
                    <div class="box-body list-title">
                        <div class="container-fluid">
                           <div class="row">
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th align="center"><strong>Code</strong></th>
                                        <th align="center"><strong>Name</strong></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
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
		var menu = '{{ $menu }}';

        var url_action = 'searchModel';
        var action = 'SEARCH';
        var result_key = 'result';
        var custom_order = '';

        $('#list').hide();
        $('.list-title').hide();
		getModelCode();

        $('#search').on('click', function () {

            $(this).prop("disabled",true);
            $('#list').show();
            $('.list-title').show();
            var value = {
				code: $('#code').val(),
                name: $('#name').val(),
				modelCode: $('#modelCode').val(),
                currentPage: "1",
                pageSize: "20",
                orderBy: {"code": "ASC"}
            };
			$('#modelName').text($('#modelCode').find(':selected').attr('data-name'));
			
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
                        data: "code",
                        render: function ( data, type, full, meta ) {
                            return '<a href="javascript:void(0)" data-code="'+data+'" data-modelname="'+$('#modelCode').find(':selected').attr('data-name')+'" data-modelcode="'+$('#modelCode').val()+'">'+data+'</a>';
                        },
                        orderable: true
                    },
                    {
                        targets: 1,
                        data: "name",
                        orderable: true
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

        $('#add').on('click', function () {
			var modelCode = $('#modelCode').val();
			var modelName = $('#modelCode').find(':selected').attr('data-name');
            var parentModelCode = $('#modelCode').find(':selected').attr('data-parentModelCode');
			var parentLabel = $('#modelCode').find(':selected').attr('data-parentLabel');
			var res = app.setView(id,'add');
            if(res=='done'){
                $('#type').val('add');
				$('#modelCode').val(modelCode);
				$('#modelName').val(modelName);
				getMappingAdd(parentModelCode,parentLabel);
            }
        });

         $('#list tbody').on('click', 'a', function (e) {
            if(e.handled !== true) // This will prevent event triggering more then once
            {
                e.handled = true;
            }
            var code = $(this).data('code');
            var modelcode = $(this).data('modelcode');
			var modelname = $(this).data('modelname');
			if (code !== undefined) {
                var res = app.setView(id,'detail');
                if(res=='done'){
                    $('#code').val(code);
					$('#modelName').val(modelname);
					$('#modelCode').val(modelcode);
					getDetail();
                }
            }
        });

        $('input[type="text"]').not('.numeric').alphanum({
            allowSpace: true,
            allow : ',._!@'
        });

         $('#code').alphanum({
            allowSpace: false,
            allow : '-'
        });

    });

	function getModelCode() {
		var menu = '{{ $service }}';
        var value = {
            code: "",
            name: "",
        };
        var url_action = 'search';
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
                    unitOption = '';
                    $.each(result.result, function (idx, obj) {
                        unitOption += '<option value="'+ obj.code +'"data-name = "'+obj.name+'"data-parentModelCode="'+ obj.parentModelCode+'" data-parentLabel="'+obj.parentLabel+'">'+ obj.name + '</option>';
                    });
                    $('#modelCode').html(unitOption);
                    $('#modelCode').select2();
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