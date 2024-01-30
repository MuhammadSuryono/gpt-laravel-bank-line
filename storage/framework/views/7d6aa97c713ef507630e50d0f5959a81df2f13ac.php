 <header class="main-header">
    <!-- Logo -->

<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
  <!-- Sidebar toggle button-->
  <a href="#" id="header-toogle-large" class="sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>
  <div id="header-logo-area">
    <a href="javascript:void(0)" v-on:click="setView('dashboard')" class="logo-header">
      <?php if(env('APP_TYPE')=='bank'): ?>
        <img src="<?php echo e(assets_url('images/def-logo-bank2.png')); ?>"/>
      <?php else: ?>
        <img src="<?php echo e(assets_url('images/def-logo2.svg')); ?>"/>
      <?php endif; ?>
      
    </a>
  </div>

  <div class="navbar-custom-menu">
    <a id="header-toogle-small" href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <ul class="nav navbar-nav">
      
      <!-- Messages: style can be found in dropdown.less-->


      <!--<li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
              <div class="flag-header-area">
                <img src="<?php echo e(assets_url('images/flag_en.png')); ?>"/>
              </div>
            </a>
            <ul class="dropdown-menu">
              
              <li>-->
                <!-- inner menu: contains the actual data -->
                <!--<ul class="menu">
                  <li>
                    <a href="#">
                      English
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      Indonesia
                    </a>
                  </li>
                </ul>
              </li>
              
            </ul>
          </li>-->
      
      <li class="dropdown notifications-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" title="profile">
          <i class="fa fa-user-circle-o"></i> <?php if(isset($user_name)): ?> <?php echo e($user_name); ?> <?php endif; ?>
        </a>
          <ul class="dropdown-menu">
              
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a id="profile-btn" href="javascript:void(0)"  v-on:click="setView('profile-btn')" data-service="user-profile/change-password" data-menu="change-password" data-parent-menu="user-profile">
                      Change Password
                    </a>
                  </li>
                </ul>
              </li>
              
            </ul>
      </li>
      
      <li>
        <a href="<?php echo e(route('logout')); ?>" title="logout"><i class="fa fa-sign-out"></i> Logout</a>
      </li>
    </ul>
  </div>
</nav>
</header><?php /**PATH D:\Downloads\Upgrade Laravel Framework\bank-line\resources\views/_partials/header.blade.php ENDPATH**/ ?>