@include('_partials.header_content',['breadcrumb'=>[str_replace('-',' ',$menu)]])

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Host Error Mapping</h3>
                </div>
                <form class="form-horizontal">
                <div class="box-body">
                    
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Code</label>

                                <div class="col-md-6">
                                    <input type="text" id="code" name="code" class="form-control" autocomplete="off" value="">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Name in English</label>

                                <div class="col-md-6">
                                    <input type="text" id="name" name="name" class="form-control" autocomplete="off" value="">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Name in Indonesia</label>

                                <div class="col-md-6">
                                    <input type="text" id="nameId" name="nameId" class="form-control" autocomplete="off" value="">

                                </div>
                            </div>
                        </div>
                        
                    
                </div>

                <div class="box-footer">
                    <div class="float-left">
                        
                            <button type="button" id="search" name="search" class="btn btn-primary">SEARCH
                            </button>
                        
                    </div>
                    <div class="float-right">
                        <button type="button" id="add" name="add" class="btn btn-info">ADD</button>
                    </div>
                </div>

                </form>
                    <div class="box-header">
                        <h3 class="box-title">Host Error Mapping List</h3>
                    </div>
                    <div class="box-body">
                        
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th align="center"><strong>Code</strong></th>
                                        <th align="center"><strong>Name in English</strong></th>
                                        <th align="center"><strong>Name in Indonesia</strong></th>
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

</section>

<script>

    $(document).ready(function () {
        var id = '{{ $service }}';

        var url_action = 'search';
        var action = 'SEARCH';
        var result_key = 'result';
        var custom_order = '';

        $('#search').on('click', function () {
            var value = {
                "code": $('#code').val(),
                "name": $('#name').val(),
                "nameId": $('#nameId').val()
            };

            var oTable = $('#list').DataTable({
                "destroy": true,
                "select": false,
                "searching": false,
                "lengthMenu": [[10, 25, 50], [10, 25, 50]],
                "processing": true,
                "serverSide": true,
                "columns": [
                    {"data": "code"},
                    {"data": "name"},
                    {"data": "nameId"}
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
                    }
                }
            });
        });

        $('#add').on('click', function () {
            var res = app.setView(id,'add');
            if(res=='done'){
               $('#type').val('add');
            }
        });

    });




</script>