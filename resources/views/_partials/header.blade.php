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
      @if(env('APP_TYPE')=='bank')
        <img src="{{ assets_url('images/def-logo-bank2.png') }}"/>
      @else
        <img src="{{ assets_url('images/def-logo2.svg') }}"/>
      @endif
      
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
                <img src="{{ assets_url('images/flag_en.png') }}"/>
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
          <i class="fa fa-user-circle-o"></i> @if(isset($user_name)) {{ $user_name }} @endif
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
        <a href="{{ route('logout') }}" title="logout"><i class="fa fa-sign-out"></i> Logout</a>
      </li>
    </ul>
  </div>
</nav>
</header>