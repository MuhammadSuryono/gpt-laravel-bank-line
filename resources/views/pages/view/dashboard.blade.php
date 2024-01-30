@include('_partials.notifications')


<section class="content-header">
		<h1 style="margin-bottom:10px;">
			<strong>Welcome @if(isset($user_name)) {{ $user_name }}, @endif</strong>
		</h1>
		<p>Last login @if(isset($user_last_login)) {{ dateFormat($user_last_login,'d M Y H:i:s') }} @endif</p>
		{{-- <ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Dashboard</li>
		</ol> --}}
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12 dataTables_wrapper"> 
				@if($total_activity>0)
					 <table id="list" class="table table-bordered table-striped dataTable" border="2" cellpadding="2"
                           style="border-collapse:collapse;">
                        <thead>
                        <tr>
                            <th align="left"><strong>No</strong></th>
                            <th align="left"><strong>List of Activity</strong></th>
                            <th align="left"><strong>Date / Time</strong></th>
                            <th align="left"><strong>Status</strong></th>

                        </tr>
                        </thead>
                        <tbody>
                        	@foreach($last_activity as $key=>$item)
	                        	<tr>
									<td align="center" style="width: 20px;">{{ $key+1 }}</td>
		                            <td align="left">{{ $item->menuName }}</td>
		                            <td align="left">{{ dateFormat($item->actionDate,'d-m-Y H:i:s') }}</td>
		                            <td align="left">{{ $item->actionType }}</td>
	                        	</tr>
	                        @endforeach
                        </tbody>
                    </table>
						
					</table>
				@else
					<h5>No Activity available</h5>
				@endif
			</div>
		</div>
	</section>
	<script>
		$(document).ready(function(){

		})
	</script>