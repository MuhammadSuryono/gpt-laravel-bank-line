@include('_partials.header_content',['breadcrumb'=>['limit setup']])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div class="box">
                <div id="spinner" style="display:none"></div>
                <div class="box-header">
                    <h3 class="box-title">Limit Setup Search</h3>
                </div>
                <form class="form-horizontal">

                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Limit Setup Code</label>

                                <div class="col-md-6">
                                    <input type="text" id="code" name="code" class="form-control" autocomplete="off" value="">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Limit Setup Name</label>

                                <div class="col-md-6">
                                    <input type="text" id="name" name="name" class="form-control" autocomplete="off" value="">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2"></label>
                                <div class="col-md-6">
                                    <button type="button" id="search" name="search" class="btn btn-default">@lang('form.search')</button>
                                    <button type="button" id="add" name="add" class="btn btn-default">@lang('form.add')</button>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                </form>
                    <div class="box-header list-title">
                        <h3 class="box-title">Limit Setup Listing</h3>
                    </div>
                    <div class="container-fluid list-title">
                        <div class="box-body">
                           <div class="row">
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th align="center"><strong>Limit Setup Code</strong></th>
                                        <th align="center"><strong>Limit Setup Name</strong></th>
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
        var id = 'MNU_GPCASH_PRO_LMT_PC';

        var url_action = 'search';
        var action = 'SEARCH';
        var result_key = 'result';
        var custom_order = '';

        $('#list').hide();
        $('.list-title').hide();

        $('#search').on('click', function () {

            $(this).prop("disabled",true);
            $('#list').show();
            $('.list-title').show();
            var value = {
                "code": $('#code').val(),
                "name": $('#name').val()
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
                        data: "code",
                        render: function ( data, type, full, meta ) {
                            return '<a href="javascript:void(0)" data-code="'+data+'">'+data+'</a>';
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
            $(this).prop("disabled",true);
            $.ajax({
                url: 'getEditor/' + id,
                method: 'post',
                success: function (data) {
                    $('#add').prop("disabled",false);
                    $(window).scrollTop(0);
                    $('#content-ajax').html(data);
                    $('#type').val('add');
                }, error: function (xhr, ajaxOptions, thrownError) {
                    $('#add').prop("disabled",false);
                    console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                }
            });
        });

        $('#list tbody').on('click', 'a', function (e) {
            if(e.handled !== true) // This will prevent event triggering more then once
            {
                e.handled = true;
            }
            var code = $(this).data('code');

            if (code !== undefined) {
                $.ajax({
                    url: 'getDetail/'+id,
                    method: 'post',
                    success: function (data) {
                        $(window).scrollTop(0);
                        $('#content-ajax').html(data);
                        $('#code').val(code);
                        getMatrix();

                    }, error: function (xhr, ajaxOptions, thrownError) {
                        console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                    }
                });
            }
        });

    });




</script>