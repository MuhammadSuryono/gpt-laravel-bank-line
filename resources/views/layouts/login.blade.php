@include('_partials._tag_head')

<body class="login-page {{ env('APP_TYPE') }}">
		
			@if(env('APP_TYPE')!='bank')
				@include('_partials.header_login')
			@endif


		 	@yield('content')
	 	
		
		 @if(env('APP_TYPE')=='bank')
		    <footer class="footer">
		        @include('_partials.footer')
		    </footer>
	    @endif
    

	@include('_partials._tag_script')

</body>
</html>