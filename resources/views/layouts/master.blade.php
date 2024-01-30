@include('_partials._tag_head')

<body class="hold-transition skin-black sidebar-mini {{ env('APP_TYPE') }}">
	
	<div id="vm">
		<div class="wrapper">
			 
		 	@include('_partials.header')
		 	@include('_partials.sidebar')
		 	
		 	<div class="content-wrapper">
		 		
		 		<div id="preloader-content" v-cloak v-if="submit.process"><div class="preloader"></div></div>
		 		<div id="content-ajax">
					@yield('content')
				</div>
				@if(env('APP_TYPE')=='bank')
				    <footer class="footer relative">
				        @include('_partials.footer')
				    </footer>
			    @endif
			</div>

	    </div>
		
		
	</div>
	

	@include('_partials._tag_script')

</body>
</html>