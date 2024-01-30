


<?php $__env->startSection('content'); ?>
	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

	<script src="<?php echo e(assets_url('js/min/demo.js')); ?> "></script>
	<!--<script src="<?php echo e(assets_url('js/min/dashboard.js')); ?> "></script>-->

	<script>
		var app;
		var pushstate;
		var viewURL = "<?php echo e(route('get.view')); ?>";
		var viewData = new Object();
		var child;
		var notif_top;
		$(document).ready(function(){
			/*pushstate = $('body').pushstate({
				base_url:'<?php echo e(route('all')); ?>',
				onPop:function(data){
					//console.log(data[0]);
					app.setView(data[0].replace( '#!', "" ));
				}
			})*/
			
			Vue.component('notif-view', {
			  template: '#notif-view'
			})

			app = new Vue({
		      // element to mount to
		      el: 'body',
		      // initial data
		      data: {
		        submit:{
		          process:false,
		          error:'',
		          success:false
		        },
		      },
		      
		      // computed property for form validation state
		      computed: {

		          
		      },
		      // methods
		      methods: {
		        setView:function(view,action){
		        	//preloaderVisible(true);
					//console.log(view);

		        	var url='';
		        	var data=new Object();
		        	if(view=='dashboard'){
		        		url = "<?php echo e(route('dashboard.content')); ?>";
		        	}else{
		        		url = viewURL;
		        		viewData.service = $('#'+view).data('service');
		        		//viewData.parent = $('#'+view).data('parent-menu');
		        		viewData.menu = $('#'+view).data('menu');
		        		if(!action){
		        			action='landing';
		        		}
		        		viewData.action = action;
		        		//url = "<?php echo e(route("get.view")); ?>"+'/'+view;
		        	}
		        	//console.log(data.serialize)
		        	$('#vue-alert').removeClass('hide');
		        	var self= this;
		        	
		        	var status = 'process';
		        	preloaderVisible(true);
		        	$.when($.ajax({
				        async: false,
				        type: 'post',
				        url: url,
				        data:viewData,
				        success: function(data) {
				            $(window).scrollTop(0);
							$el = $('#content-ajax').html(data);
							//console.log($el.get(0));
							notif_top = $('#notif-area').offset().top+30;
							$('#type').val(viewData.action);
							child = new Vue({
							  el: '#content-ajax',
							  data: {
							  	alert:{
						        	status:'',
						        	msg:''
						        }
							  },
							})
							setTimeout(function(){
								//app.$compile($('#content-ajax').get(0));
								window.dispatchEvent(new Event('resize'));
							},200)
							
							//self.$mount('#notif-area');
							status = 'done';
				        },
				        error: function() {
				            status = 'false';
				        }
				    })).then(function(data) {
				        return status;
				    });
				    
		        	
		        	return status;
		        },

		       
		      },
		      ready: function () {
		            
		               this.setView('dashboard');
		            
		        }
		    })

			$(document).ajaxStart(function() {
				//app.alert.status = '';
				//app.alert.msg ='';
				preloaderVisible(true);
				//$('#spinner').show();
			}).ajaxComplete(function() {
				//$('#spinner').hide();
				setTimeout(function(){
					preloaderVisible(false);
				},100)
			}).ajaxError(function( event, jqxhr, settings, thrownError ){
				//MISMATCH _TOKEN
				if(jqxhr.status==498){
					window.location = '<?php echo e(route("login")); ?>?error=You session expired.';
				}
			});


			//getDashboardContent('dashboard');
		})

		function flash(type,message){
			$("#vue-warning").show();
			child.alert.status = type;
			child.alert.msg = message;

			//$(".notification").remove();
			//$(".notification").delay(6000).fadeOut("fast", function () { $(this).remove(); });
			window.setTimeout(function() {

					$("#vue-warning").hide();

			}, 5000);

		}
		

		function preloaderVisible(val){
			if(app){
				app.submit.process = val;	
			}
			
		}

		function hideParent(val){
			child.alert.status = '';
			child.alert.msg = '';
		}

		function loadView(action){
			$res = app.getViewResponse(action);
			console.log($res);
		}
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master',['menu'=>$menu], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Downloads\Upgrade Laravel Framework\bank-line\resources\views/pages/home.blade.php ENDPATH**/ ?>