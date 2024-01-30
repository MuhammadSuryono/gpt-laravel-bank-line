<div id="notif-area" >
	<div id="notif-inner" v-if="alert.status!=''" v-cloak>

	<div id="vue-alert" class="alert alert-danger vue-notif" v-if="alert.status=='error'" v-cloak>
	  <button type="button" class="close" aria-hidden="true" onclick="hideParent(this)">×</button>
	  <p><i class="icon fa fa-ban"></i> {{{ alert.msg }}}</p>
	</div>

	<div id="vue-warning" class="alert alert-warning vue-notif" v-if="alert.status=='warning'" v-cloak>
	  <button type="button" class="close" aria-hidden="true" onclick="hideParent(this)">×</button>
	  <p><i class="icon fa fa-warning"></i> {{{ alert.msg }}}</p>
	</div>

	<div id="vue-success" class="alert alert-success vue-notif" v-if="alert.status=='success'" v-cloak>
	  <button type="button" class="close" aria-hidden="true" onclick="hideParent(this)">×</button>
	  <p><i class="icon fa fa-check-circle-o"></i> {{{ alert.msg }}}</p>
	</div>
	</div>
</div><?php /**PATH D:\Downloads\Upgrade Laravel Framework\bank-line\resources\views/_partials/notifications.blade.php ENDPATH**/ ?>