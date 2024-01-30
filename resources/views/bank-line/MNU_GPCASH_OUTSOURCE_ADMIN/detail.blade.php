@include('_partials.header_content',['breadcrumb'=>['Outsource Admin','detail']])

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <input type="hidden" id="code" value=""/>
            <input type="hidden" id="name" value=""/>
            <input type="hidden" id="sIdMaker" value=""/>
            <input type="hidden" id="sIdApprover" value=""/>
            <div class="box">
    
                    <div class="box-header table-hidden">
                        <h3 class="box-title">Corporate Admin</h3>
                    </div>
                    <div class="box-body table-hidden">
                        <table id="list_admin" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                               style="border-collapse:collapse;">
                            <thead>
                            <tr>
                                <th align="left"><strong>Role</strong></th>
                                <th align="left"><strong>User ID</strong></th>
                                <th align="left"><strong></strong></th>
                            </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="box-footer">
 
                       <div class="state_normal">
                               <div class="float-left">
                                    <button type="button" id="back" name="back" class="btn btn-default back">@lang('form.back')</button>
                               </div>                              
                       </div>
                   </div>
            </div>
        </div>
    </div>

</section>


<script>

    var oTable_admin;
    var data_detail;
    var id = '{{ $service }}';

    $(document).ready(function () {
        stateNormal();


        oTable_admin = $('#list_admin').DataTable({
            "paging" : false,
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
                    width: "30%"
                },
                {
                    targets: 1,
                    sortable: true,
                    width: "40%"
                },
                {
                    targets: 2,
                    sortable: true,
                    width: "30%"
                },
            ]
        });

        $('#edit').on('click', function () {

        });

        $('.back').on('click', function () {
           var res = app.setView(id,'landing');
        });
        $('div.dt-buttons').css('float','right');
        $('a.dt-button').addClass('btn btn-primary');


    });



    function getData(code,name){
        $('#code').val(code);
        $('#name').val(name);
        var value = {
            corporateId: code,
            name: "",
            currentPage: "1",
            pageSize: "20",
            orderBy: {"id": "ASC"}
        };
        var url_action = 'search';
        var action = 'DETAIL';
        var menu = id;
        $.ajax({
            url: 'getAPIData',
            method: 'post',
            data: {
                value : value,
                menu : 'MNU_GPCASH_OUTSOURCE_ADMIN',
                url_action : url_action,
                action : action,
                _token : '{{ csrf_token() }}'
            },
            success: function (data) {

                var result = JSON.parse(data);
                if (result.status=="200") {
                    var index = result.result.map(function(o) { return o.corporateId; }).indexOf(code.toString());

                    var detail = result.result;
                    data_detail = detail[index];

                    var adminList = detail[index].adminList;
                    $('#corporateId').text(detail[index].corporateId);
                    $('#sIdMaker').val(result.sIdMaker);
                    $('#sIdApprover').val(result.sIdApp);

                    oTable_admin.clear();
                    if(adminList){
                    $.each(adminList, function (idx, obj){
                        oTable_admin.row.add([
                            obj.role,
                            obj.userId,
                            '<button id="" class="btn btn-default login" onClick="loginAs(\''+obj.role+'\');">Login as '+  obj.userId + ' </button>',
                            
                        ]).draw(true);
                    });
                        console.log(data_detail);
                    }
                } else {
                    flash('warning', result.message);
                }


            }, error: function (xhr, ajaxOptions, thrownError) {
                var msg = '{{trans('form.conn_error')}}';
                flash('warning', msg);
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            },
            complete: function(data) {

            }
        });
    }

    

    function loginAs(role){
        var content ='Confirmation Login As Outsource Admin?';

        var sIdMaker = $('#sIdMaker').val();
        var sIdApprover = $('#sIdApprover').val();

         var url = "http://localhost:8080?q=" + sIdApprover

        if(role == "maker"){
            url = "http://localhost:8080?q=" + sIdMaker
        }
       



        $.confirm({
            title: 'Login As',
            content: content,
            buttons: {
                cancel: {
                    text: '{{trans('form.cancel')}}',
                    btnClass: 'btn-default',
                    action: function(){

                    }
                },
                confirm: {
                    text: '{{trans('form.confirm')}}',
                    btnClass: 'btn-primary',
                    action: function(){
                       window.open(url);
                    }
                }
            }
        });


    }

   
    


    function stateNormal(){

        $('.table-hidden').show();
        $('.state_normal').show();
    }

</script>