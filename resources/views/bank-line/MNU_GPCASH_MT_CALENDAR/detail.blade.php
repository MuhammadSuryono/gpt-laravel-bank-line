@include('_partials.header_content',['breadcrumb'=>['Calendar Engine','detail']])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <input type="hidden" id="code" value=""/>
            <div class="box">
                
                
                <div class="box-header">
                    <h3 class="box-title">Bank Calendar</h3><br>
                </div>
                <form class="form-horizontal">
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="table-hidden">
                            <div class="form-group">
                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                       style="border-collapse:collapse;">
                                    <thead>
                                    <tr>
                                        <th align="center" ><strong>Date</strong></th>
                                        <th align="center" ><strong>Description</strong></th>
                                        <th align="center" ><strong>Type</strong></th>
                                    </tr>
                                    </thead>

                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="box-footer">
                            
                                <div class="state_view">
                                    <div class="float-left">
                                        <button type="button" id="back" name="back" class="btn btn-default back">@lang('form.back')</button>
                                        <button type="button" id="save_screen" name="save_screen" class="btn btn-default" style="display:none" onclick="save_pdf();">@lang('form.save_pdf')</button>
                                    </div>
                                    <div class="float-right">
                                        <button type="button" id="delete" name="delete" class="btn btn-danger">@lang('form.delete')</button>
                                        <button type="button" id="edit" name="edit" class="btn btn-primary">@lang('form.edit')</button>
                                        <button type="button" id="next_user" name="next_user" class="btn btn-info" style="display:none">@lang('form.next_user')</button>
                                        <button type="button" id="done" name="done" class="btn btn-primary done" style="display:none">@lang('form.done')</button>

                                    </div>
                                        
                                        
                                    
                                </div>

                        </div>
                @include('_partials.next_user')
                </form>

            </div>
        </div>
    </div>

</section>

<script>
    var oTable;
    var oTable_add;
    var id = '{{ $service }}';
    var noRef;

    var holiday_date;
    var today_event;
    $(document).ready(function () {
        $('.state_delete').hide();
        oTable = $('#list').DataTable({
            "paging" : false,
            "ordering" : false,
            "info": false,
            "destroy": true,

            "searching": false,
            "autoWidth":false,
            "columnDefs": [

                {
                    targets: 0,
                    sortable: false,
                    width: "200px"
                },
                {
                    targets: 1,
                    sortable: false,
                    width: "500px"
                },
                {
                    targets: 2,
                    sortable: false,
                    width: "150px"
                }

            ]
        });

        //getMatrix();




        $('#delete').on('click', function () {
           // $('.state_view').hide();
           // $('.state_delete').show();
            $(this).prop('disabled',true);
            $.confirm({
                title: '{{trans('form.delete')}}',
                content: '{{trans('form.confirm_delete')}}',
                buttons: {
                    
                    cancel: {
                        text: '{{trans('form.cancel')}}',
                        btnClass: 'btn-default',
                        action: function(){
                            $('#delete').prop('disabled',false);
                        }
                    },
                    confirm: {
                        text: '{{trans('form.delete')}}',
                        btnClass: 'btn-primary',
                        action: function(){
                            submit_delete();
                        }
                    },

                }
            });
        });

        function submit_delete () {
            var loginId = '<?php echo Session::get('userId') ?>';
            var holiday_list = getTableData();
            var value = {
                "holidayDate": holiday_date,
                "holidayList": holiday_list,
                "action": "DELETE",
                "loginId":loginId,

            };
            $.ajax({
                url: 'delete',
                method: 'post',
                data: {"_token": "{{ csrf_token() }}", menu: id, value: value,url_action:'submitDelete'},
                success: function (data) {
                    $('#delete').prop('disabled',false);
                    var result = JSON.parse(data);
                    if (result.status=="200") {
                        noRef = result.referenceNo;
                        flash('success', result.message+'<br>'+'ReferenceNo: '+ result.referenceNo+'<br>'+result.dateTimeInfo);
                        $('#submit_view').hide();
                        $('#save_screen').show();
                        $('#next_user').show();
                        $('#done').show();
                        $('#back').hide();
                        $('#delete').hide();
                        $('#edit').hide();
                        $('#back').html('{{trans('form.done')}}');
                    } else {
                        $('#delete').prop('disabled',false);
                        flash('warning', result.message);
                    }

                }, error: function (xhr, ajaxOptions, thrownError) {
                    $('#delete').prop('disabled',false);
                    flash('warning', 'Form Submit Failed');
                   console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
                }
            });
        }

        

        $('#back_delete').on('click', function () {
            $('.state_delete').hide();
            $('.state_view').show();
        });

        $('.back').on('click', function () {
           var res = app.setView(id,'landing');
        });

        $('.done').on('click', function () {
           var res = app.setView(id,'landing');
        });


    });

    function getTableData() {
        var holidayList = [];

        $("#list").find("tbody tr").each(function () {

            var dscp = $('td:eq(1)', $(this)).text();
            var type = $('td:eq(2)', $(this)).text();
            var value = {
                "dscp": dscp,
                "type": type
            };

            holidayList.push(value);

        });
        return holidayList;
    }

    function getMatrix(holidayDate,todayEvent){
        holiday_date = holidayDate;
        today_event = todayEvent;
        //console.log(today_event);
        $('#edit').on('click', function () {

            var res = app.setView(id,'add');
            //console.log(holidayDate);
            //console.log(todayEvent);
            if(res=='done'){
                $('#type').val('edit');
                getCurrency();
                setForm(holidayDate,todayEvent);
                $('#breadcrumb-action').html('edit');

            }
        });

        $.each(todayEvent, function (idx, obj){

            oTable.row.add([
                moment(obj.start, 'DD/MM/YYYY').format("dddd, DD-MMMM-YYYY"),
                obj.title,
                obj.type

            ]).draw(true);
        });
        //var addRow = oTable_add.row(oTable).data();
        //oTable.row.add(oTable_add).draw(true);

    }


</script>