@include('_partials.header_content',['breadcrumb'=>['authentication device','add']])

<section class="content">
    <div  class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <input type="hidden" id="code" value=""/>
            <div id="print" class="box">
                <div id="spinner" style="display:none"></div>
                <div class="box-header state_view">
                    <span id="preview" class="state_view" style="color:darkred;display:none;"><small><i>Preview</i></small></span>
                </div>
                <div class="box-header">
                     <h3 class="box-title">Corporate Detail</h3>
                </div>
                <form class="form-horizontal">
                <input type="hidden" id="code_edit" value=""/>
                <input type="hidden" id="name" value=""/>
                <input type="hidden" id="type" value=""/>
                <input type="hidden" id="state" value=""/>
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Corporate</label>
                                <div class="col-md-6">
                                    <label id="code_1" name="code">-</label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                </form>

                <div class="box-header">
                    <h3 class="box-title table-hidden">Device Listing</h3>
                </div>
                <div class="container-fluid">
                    <div class="box-body">
                        <div class="row state_edit">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Serial Number</label>
                                <div class="col-md-6">
                                        <input type="text" class="form-control" id="serialNo" name="serialNo" value="">
                                        <button id="add_list" class="btn btn-default">Add to List</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                      <th align="left"><strong>Serial Number</strong></th>
                                      <th align="center"></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-12 state_edit text-center">
                                    <button type="button" id="confirm" name="confirm" class="btn btn-default">@lang('form.confirm')</button>
                                    <button type="button" id="back" name="back" class="btn btn-default back">@lang('form.back')</button>
                                </div>
                                <div class="col-md-12 state_view text-center">
                                    <button type="button" id="submit_view" name="submit_view" class="btn btn-danger">@lang('form.submit')</button>
                                    <button type="button" id="save_screen" name="save_screen" class="btn btn-default" style="display:none">Save Screen</button>
                                    <button type="button" id="back_view" name="back_view" class="btn btn-default">@lang('form.back')</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<script>
    var oTable;
    var oTable_add;
    var currencyOption;
    var id = 'MNU_GPCASH_AUTH_DEVICE';
    $(document).ready(function () {
        //$('.list_add').hide();
        $('.table-hidden').hide();
        $('#filter_accountNo').hide();
        var submit_data;

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
                    width: "85%"
                },
                {
                    targets: 1,
                    sortable: false,
                    width: "15%",
                    className: "dt-center",
                    render: function ( data, type, full, meta ) {
                        return '<button data-cif="'+data+'" class="btn btn-danger" onClick="removeRow(this);" style="width:100px;">Remove</button>';
                    }
                }

            ]
        });

        stateEdit();

        $('#submit_view').on('click', function () {
            $(this).prop('disabled',true);
            var content ='';
            if ($('#type').val() == 'add'){
                content='{{trans('form.confirm_add')}}';
            }else{
                content='{{trans('form.confirm_edit')}}';
            }

            $.confirm({
                title: '{{trans('form.submit')}}',
                content: content,
                buttons: {
                    confirm: {
                        text: '{{trans('form.confirm')}}',
                        btnClass: 'btn-danger',
                        action: function(){
                            submitData();
                        }
                    },
                    cancel: {
                        text: '{{trans('form.cancel')}}',
                        btnClass: 'btn-default',
                        action: function(){
                            $('#submit_view').prop('disabled',false);
                        }
                    }

                }
            });

        });

        function submitData(){
            var value = {
                "corporateId": $('#code').val(),
                "corporateName": $('#name').val(),
                "tokenList": submit_data
            };
            if ($('#type').val() == 'add'){
                $.ajax({
                    url: 'add',
                    method: 'post',
                    data: {"_token": "{{ csrf_token() }}", menu: id, value: value},
                    success: function (data) {
                        $('#submit_view').prop('disabled',false);
                        var result = JSON.parse(data);
                        if (result.hasOwnProperty("referenceNo")) {
                            flash('success', result.message);
                            $('#submit_view').hide();
                            $('#preview').text('ReferenceNo: ' + result.referenceNo);
                            stateSuccess();
                        } else {
                            $('#submit_view').prop('disabled',false);
                            flash('warning', 'Form Submit Failed');
                        }

                    }, error: function (xhr, ajaxOptions, thrownError) {
                        $('#submit_view').prop('disabled',false);
                        flash('warning', 'Form Submit Failed');
                        console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                    }
                });
            }else{
                $.ajax({
                    url: 'edit',
                    method: 'post',
                    data: {"_token": "{{ csrf_token() }}", menu: id, value: value},
                    success: function (data) {
                        $('#submit_view').prop('disabled',false);
                        var result = JSON.parse(data);
                        if (result.hasOwnProperty("referenceNo")) {
                            flash('success', result.message);
                            $('#submit_view').hide();
                            $('#preview').text('ReferenceNo: ' + result.referenceNo);
                            stateSuccess();
                        } else {
                            $('#submit_view').prop('disabled',false);
                            flash('warning', 'Form Submit Failed');
                        }

                    }, error: function (xhr, ajaxOptions, thrownError) {
                        $('#submit_view').prop('disabled',false);
                        flash('warning', 'Form Submit Failed');
                        console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                    }
                });
            }
        }


        $('#confirm').on('click', function () {
            submit_data = getTableData();
            console.log(submit_data);
            stateView();
        });

        $('#back_view').on('click', function () {
            $(this).prop('disabled',true);
            if($('#state').val() == 'success'){
                $.ajax({
                    url: 'getView/'+id,
                    method: 'post',
                    success: function (data) {
                        $('#back_view').prop('disabled',false);
                        $(window).scrollTop(0);
                        $('#content-ajax').html(data);

                    }, error: function (xhr, ajaxOptions, thrownError) {
                        $('#back_view').prop('disabled',false);
                        console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                    }
                });
                return;
            }else{
            $('#back_view').prop('disabled',false);
            stateEdit();
            }
        });

       $('#save_pdf').on('click', function () {
           html2canvas($('#print'), {
               onrendered: function(canvas) {
                   var img = canvas.toDataURL();
                   window.open(img);
               }
           });

        });

        $('#add_list').on('click', function () {
            var serialNo = $('#serialNo').val();
            if(checkDuplicateList(serialNo)) {
                oTable.row.add([
                    serialNo + '<input type=hidden id="serialNo" value="' + serialNo + '">'
                ]).draw(false);
            }
        });

        $('.back').on('click', function () {
            $(this).prop('disabled',true);

                $.ajax({
                    url: 'getDetail/' + id,
                    method: 'post',
                    success: function (data) {
                        $('.back').prop('disabled',false);
                        $(window).scrollTop(0);
                        var code = $('#code').val();
                        var name = $('#name').val();
                        $('#content-ajax').html(data);
                        $('#code').val(code);
                        getData(code,name);

                    }, error: function (xhr, ajaxOptions, thrownError) {
                        $('.back').prop('disabled',false);
                        console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                    }
                });

        });

    });

    function removeRow(el){
        var row = $(el).parent().parent();
        oTable.row(row).remove().draw(true);
    }

    function checkDuplicateList(tokenNo){
        var duplicate = 0;
        $("#list").find("tbody tr").each(function () {
            var serialNo = $('td:eq(0)', $(this)).find('#serialNo').val();
            if(tokenNo==serialNo){
                duplicate = 1;
            }
        });

        if(duplicate==1){
            return false;
        }else{
            return true;
        }

    }

       function getTableData() {
            var data = [];

            $("#list").find("tbody tr").each(function () {

                var tokenNo = $('td:eq(0)', $(this)).find('#serialNo').val();

                data.push(tokenNo);

            });
            return data;
        }


        function stateEdit() {
            if($('#type').val()=='add'){
            oTable.column(1).visible(true);
            }
            $('#state').val('edit');
            $('.state_view').hide();
            $('.state_edit').show();
            $('span.state_view').text('-');

        }

        function stateView() {
            $('#state').val('view');
            if($('#type').val()=='add'){
                oTable.column(1).visible(false);
            }
            $('#preview').text('Preview');
            $('.state_edit').hide();
            $('.state_view').show();

        }

        function stateSuccess() {
            $('#state').val('success');
            $('#code_1').val('');
            $('#name').val('');
            $('input.state_edit').val('');
            $('input.check').attr('checked', '');
            $('#back_view').html('{{trans('form.done')}}');
            $('save_screen').show();
        }

</script>