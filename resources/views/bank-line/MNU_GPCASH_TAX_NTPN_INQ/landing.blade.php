@include('_partials.header_content',['breadcrumb'=>[str_replace('-',' ',$menu)]])


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div id="notification"></div>
            <div class="box">
                <div id="spinner" style="display:none"></div>

                <div class="box-header list-title">
                                        <h3 class="box-title">Transaction Listing</h3>
                                    </div>
                                    <div class="box-body list-title">
                                        
                                                <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                                                       style="border-collapse:collapse;">
                                                    <thead>
                                                    <tr>
                                                        <th align="center"><strong>Corporate</strong></th>
                                                        <th align="center"><strong>Payment Date</strong></th>
                                                        <th align="center"><strong>Reference No</strong></th>
                                                        <th align="center"><strong>NPWP</strong></th>
														<th align="center"><strong>Name</strong></th>
														<th align="center"><strong>Source Account</strong></th>
														<th align="center"><strong>NTB</strong></th>
														<th align="center"><strong>NTPN</strong></th>
														<th align="center">
															<button  class="btn btn-default" style="width:125px;" align="center" onClick="inquiryAll();">Inquiry All</button>
														</th>
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
                                                        <td align="left"></td>
                                                        <td align="left"></td>
                                                        <td align="left"></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                    </div>
                </form>
            </div>
        </div>
    </div>

</section>

<script>

    var id = '{{ $service }}';
    var oTable;
    var oTable_status;

   $(document).ready(function () {
        

        

        $('#list').hide();
        $('.list-title').hide();
        $('#list_status').hide();
        $('.list-title-status').hide();


		searchTax();	
        
        $('input[type="text"]').not('.numeric').alphanum({
            allowSpace: true,
            allow : ',._!@'
        });

    });

	function searchTax(){
		var url_action = '';
        var action = 'SEARCH';
        var result_key = 'result';
        var custom_order = '';
         // var info = oTable.page.info();
			
			url_action = 'search';
            custom_order = {"paymentDate":"ASC"};
            $(this).prop("disabled",true);
            $('#list').show();
            $('.list-title').show();
            var value = {
    //             currentPage: "1",
    //             pageSize: "20",
				// loginCorporateId:"GG1",
            };

             // var index = 1;

          oTable = $('#list').DataTable({
                "destroy": true,
                "initComplete": function(settings, json) {
                    $('#search').prop("disabled",false);

                },
               "drawCallback": function( settings ) {


               },

                "select": false,
                "searching": false,
                "lengthMenu": [[10, 25, 50], [10, 25, 50]],
                "processing": true,
                "serverSide": true,
                "autoWidth": false,
                "ScrollX": '100%',
                "columnDefs": [
                    /*{
                        targets: 0,
                        data: null,
                        render: function ( data, type, full, meta ) {
                                    return index++;
                        },
                        orderable: false,
                        className: 'dt-center',
                    },*/
                    {
                        targets: 0,
                        data: "corporateName",
                        orderable: false
                    },
                    {
                        targets: 1,
                        data: "paymentDate",   
                        orderable: false
                    },
					{
                        targets: 2,
                        data: "referenceNo",   
                        orderable: false
                    },
					{
                        targets: 3,
                        data: "npwp",   
                        orderable: false
                    },
					{
                        targets: 4,
                        data: "benName",   
                        orderable: false
                    },
					{
                        targets: 5,
                        data: {accountNo:"accountNo",accountName:"accountName",accountCurrencyCode:"accountCurrencyCode"},
                        width: "15%",
                        render: function ( data, type, full, meta ) {

                            return data.accountNo+ ' / ' + data.accountName + '('+data.accountCurrencyCode+')';
                        },
                    },
					{
                        targets: 6,
                        data: "ntb",   
                        orderable: false
                    },	
					{
                        targets: 7,
                        data: {taxPaymentId:"taxPaymentId"}, 
						render: function ( data, type, full, meta ) {
                            return '';
                        },
                        orderable: false
                    },						
                    {
                        targets: 8,
                        data: {taxPaymentId:"taxPaymentId"},
                        width: "15%",
                        render: function ( data, type, full, meta ) {

                            return '<button data-code="'+data.taxPaymentId+'" class="btn btn-default execute" style="width:125px;" align="center" onClick="inquiryNTPN(\''+data.taxPaymentId+'\');">Inquiry NTPN</button>';
                        },
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

                         // console.log("info: " + info + "\ninfo.page: " + info.page + "\ninfo.pages: " + info.pages);
                    },
                    error:function (jqXHR, textStatus, errorThrown) {

                        var msg = '{{trans('form.conn_error')}}';
                        flash('warning', msg);
                        $('#list').hide();
                        $('.list-title').hide();
						$('#search').prop("disabled",false);
                    }, complete: function (data) {
                        //oTable.ajax.reload();
                       
                    }
                }
            });



	}
	
    function inquiryNTPN(taxPaymentId) {
        //console.log(code);
        var value = {
			taxPaymentId:taxPaymentId,
			loginCorporateId: 'GG1',
        };
        var url_action = 'NTPNInquiry';
        var action = 'EXECUTE';
        var menu = id;

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
                    flash('success', result.message);
					searchTax();
                } else {
                    flash('warning', result.message);
                }


            }, error: function (xhr, ajaxOptions, thrownError) {
                flash('warning', 'Execute Failed');
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {
                //oTable.ajax.reload();
            }
        });
    }

	function inquiryAll() {
        //console.log(code);
        var value = {
			loginCorporateId: 'GG1',
        };
        var url_action = 'NTPNInquiryAll';
        var action = 'EXECUTE';
        var menu = id;

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
                    flash('success', result.message);
					searchTax();
                } else {
                    flash('warning', result.message);
                }


            }, error: function (xhr, ajaxOptions, thrownError) {
                flash('warning', 'Execute Failed');
                console.log(xhr.status + " ," + " " + ajaxOptions + ", " + thrownError);
            }, complete: function (data) {
                //oTable.ajax.reload();
            }
        });
    }
	
    


</script>