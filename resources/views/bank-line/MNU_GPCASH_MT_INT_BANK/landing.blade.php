@include('_partials.header_content',['breadcrumb'=>['International Bank','Search']])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div class="box">
                <div id="spinner" style="display:none"></div>
                <div class="box-header">
                    <h3 class="box-title">Bank Filter</h3>
                </div>
                <form class="form-horizontal">

                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Country</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="countryCode">
                                        <option></option>
                                   </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Bank Code</label>

                                <div class="col-md-6">
                                    <input type="text" id="code" name="code" class="form-control" autocomplete="off" value="" maxlength="40">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Bank Name</label>

                                <div class="col-md-6">
                                    <input type="text" id="name" name="name" class="form-control" autocomplete="off" value="" maxlength="100">

                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="box-footer">
                   
                    <div class="float-left">
                        <button type="button" id="search" name="search" class="btn btn-primary">@lang('form.search')</button>
                    </div>
                    <div class="float-right">
                        <button type="button" id="add" name="add" class="btn btn-info">@lang('form.add')</button>
                    </div>

                </div>
                </form>
                    <div class="box-header list-title">
                        <h3 class="box-title">Bank Listing</h3>
                    </div>
                    <div class="box-body list-title">
                        
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th align="center"><strong>Organization Type</strong></th>
                                        <th align="center"><strong>Bank Code</strong></th>
                                        <th align="center"><strong>Bank Name</strong></th>
                                        <th align="center"><strong>Country</strong></th>
                                        <th align="center"><strong>City</strong></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
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

</section>

<script>


    $(document).ready(function () {
        var id = '{{ $service }}';

        var url_action = 'search';
        var action = 'SEARCH';
        var result_key = 'result';
        var custom_order = {"code": "ASC"};
        var data_code = '';

        $('#list').hide();
        $('.list-title').hide();
        getCountry();

        $('#search').on('click', function () {

            $(this).prop("disabled",true);
            $('#list').show();
            $('.list-title').show();
            var value = {
                code: $('#code').val(),
                name: $('#name').val(),
                countryCode: $('#countryCode').val(),
                currentPage: "1",
                pageSize: "20",
                // orderBy: {"code": "ASC"}
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
                        data: "internationalBankOrganizationName",                        
                        orderable: false
                    },
                    {
                        targets: 1,
                        data: {code:"code"},
						render: function ( data, type, full, meta ) {
                            return '<a href="javascript:void(0)" data-code="'+data.code+'">'+data.code+'</a>';
                        },
                        orderable: false
                    },
                    {
                        targets: 2,
                        data: "name",
                        orderable: false
                    },
                    {
                        targets: 3,
                        data: "countryName",
                        orderable: false
                    },
                    {
                        targets: 4,
                        data: "cityName",
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

        $('#add').on('click', function () {
            var res = app.setView(id,'add');
            if(res=='done'){
                $('#type').val('add');
                getCountryDropList();
                getStateDroplist();
                getSubstateDroplist();
                getCityDroplist();
                //getMatrixAdd();
            }
        });

        $('#list tbody').on('click', 'a', function (e) {
            if(e.handled !== true) // This will prevent event triggering more then once
            {
                e.handled = true;
            }
            var code = $(this).data('code');

            if (code !== undefined) {
                var res = app.setView(id,'detail');
                if(res=='done'){
                    $('#code').val(code);
                    getMatrix();
                }
            }
        });
        $('input[type="text"]').not('.numeric').alphanum({
            allowSpace: true,
            allow : ',._!@'
        });

    });

    function getCountry() {
        var value = {
            code: "",
            name: "",
            // modelCode: "COM_MT_COUNTRY"
        };
        var url_action = 'searchCountryForDroplist';
        var action = 'SEARCH';
        var menu = 'MNU_GPCASH_MT_INT_BANK'; 
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
                    unitOption = '<option value=""></option>';
                    $.each(result.result, function (idx, obj) {
                        unitOption += '<option value="' + obj.code + '">' + obj.name + '</option>';
                    });
                    $('#countryCode').html(unitOption);
                    $('#countryCode').select2();
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