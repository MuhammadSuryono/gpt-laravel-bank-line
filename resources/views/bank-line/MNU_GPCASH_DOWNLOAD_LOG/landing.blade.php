@include('_partials.header_content',['breadcrumb'=>[str_replace('-',' ',$menu)]])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div class="box">
                <div id="spinner" style="display:none"></div>

                <div id="exTab" class="">
                    <ul class="nav nav-tabs state_edit">
                            <li class="active">
                                <a href="#tab_scheduler" data-toggle="tab">Today</a>
                            </li>
                            <li><a href="#tab_status" data-toggle="tab">Backup</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_scheduler">
                                    <div class="container-fluid box-body">
                                        <div class="row">
                                            <form id="form-area-download" class="form-horizontal form-area">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Log Name&ast;</label>

                                                <div class="col-md-6">

                                                    <input type="text" id="logname" name="logname" class="form-control" autocomplete="off" value="" data-error="This field is required." required>

                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="box-footer">
                                        <div class="float-left">
                                            <button type="button" id="download" name="download" class="btn btn-primary">Download</button>
                                        </div>
                                    </div>
                                </div>

                            <div class="tab-pane" id="tab_status">
                                    <div class="container-fluid box-body">
                                        <div class="row">
                                            <form id="form-area-dbcakup" class="form-horizontal form-area">
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Log Name&ast;</label>

                                                    <div class="col-md-6">
                                                        <input type="text" id="logname_backup" name="logname_backup" class="form-control" autocomplete="off" value="" data-error="This field is required." required>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                        <label class="col-md-2 control-label">Date</label>
                                                    
                                                    <div class="col-md-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                <input type="text" id="logDate" name="logDate" class="form-control numeric datepicker" autocomplete="off" value="" >
                                                        </div>                                   
                                                    </div>                              
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="box-footer">
                                        <div class="float-left">
                                                <button type="button" id="download_backup" name="search" class="btn btn-primary">Download</button>
                                        </div>
                                    </div>                                    

                            </div>
                        </div>
                            
                </div>
                </form>
            </div>
        </div>
    </div>

</section>

<script>

    var id = '{{ $service }}';

    $(document).ready(function () {
        
        $('.datepicker').datepicker({
            format: "dd/mm/yyyy",
            locale: 'en',
            autoclose:true
        });
        
        $('#logDate').val(moment(new Date()).add(-1, 'days').format("DD/MM/YYYY"));

        var url_action = '';
        var action = 'SEARCH';
        var result_key = 'result';
        var custom_order = '';

        $('#list').hide();
        $('.list-title').hide();
        $('#list_status').hide();
        $('.list-title-status').hide();

        $('#download').on('click', function () {
            if($('#form-area-download').validator('validate').has('.has-error').length==0){
                requestDownload($('#logname').val(),'today')
            }          
        });

        $('#download_backup').on('click', function () {
            if($('#form-area-dbcakup').validator('validate').has('.has-error').length==0){
                requestDownload($('#logname_backup').val(),'backup')
            }          
        });

        $('input[type="text"]').not('.numeric').alphanum({
            allowSpace: false,
            allow : '.'
        });

    });

    

    function requestDownload(logName,type){
        var value = {
                        logName : "",
                        logDate : "",
                        type:""
                };

                var validate = true;
               
                if ($('#logDate').val() == '') {
                    var content ='Log Date is mandatory';
                    $.alert({
                        title: '{{trans('form.warning')}}',
                        content: content
                    });
                    return;
                }
                value.logName = logName;
                value.logDate = $('#logDate').val();
                value.type = type;

    
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data: {
            value : value,
            menu : id,
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
                    service:id,
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

</script>