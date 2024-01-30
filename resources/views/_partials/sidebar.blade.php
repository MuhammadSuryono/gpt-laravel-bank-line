
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- sidebar menu: : style can be found in sidebar.less -->
      {{-- <div id="profile-sidebar">
            <div class="col-xs-3">
            </div>
            <div class="col-xs-9">
              <h5><strong>Saraswati</strong></h5>
              <p class="uppercase">
                pt. xyz securitas
              </p>
            </div>
          </div> --}}

      <div id="temp"></div>
      <ul class="sidebar-menu">
        @if(env('APP_TYPE')!='bank')
                <!--<li id="profile-sidebar" class="treeview">
                  <div class="row">
                    <div class="col-xs-4" style="padding-right:0px;">
                      <div id="profile-img">
                        <img src="{{ assets_url('images/avatar04.png') }}"/>
                </div>
              </div>
              <div class="col-xs-8">
                <h5><strong>Saraswati</strong></h5>
                <p class="uppercase">PT. Maju Jaya</p>
              </div>
            </div>
          </li>-->
          @endif
          <li>
            <a href="javascript:void(0)" onclick="app.setView('dashboard')">
              <i class="fa fa-home"></i>
                <span> Dashboard</span>
            </a>
          </li>

          @foreach($menu as $item)
            @if($item->lvl=='1')
                @php $hasChild = false @endphp
                    @if($menu)
                    @foreach($menu as $child)
                        @if($child->lvl=='2' && $child->parentMenuCode==$item->menuCode)
                            @php $hasChild = true @endphp
                        @endif
                    @endforeach
                    @endif
                @if(!$hasChild)
                <li>
                <a id="{{ $item->menuCode }}" data-service="{{ $item->menuCode }}" data-parent-menu="" data-menu="{{ strtolower(str_replace(' ','-',$item->menuName)) }}" href="javascript:void(0)" v-on:click="setView('{{ $item->menuCode }}')">
                <i class="fa {{ $item->icon }}"></i> {{ $item->menuName }}
                </a>
                </li>
                @else
              <li class="treeview">
                <a href="#">
                <i class="fa {{ $item->icon }}"></i>
                <span> {{ $item->menuName }}</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                @endif
                <ul class="treeview-menu">

                @foreach($menu as $child)
                  @if($child->lvl=='2' && $child->parentMenuCode==$item->menuCode)
                    <li>
                      
                      <a id="{{ $child->menuCode }}" data-service="{{ $child->menuCode }}" data-parent-menu="{{ strtolower(str_replace(' ','-',$child->parentMenuName)) }}" data-menu="{{ strtolower(str_replace(' ','-',$child->menuName)) }}" href="javascript:void(0)" v-on:click="setView('{{ $child->menuCode }}')">

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        @if(isset($child->icon) && $child->icon!='')
                          <i class="fa {{ $child->icon }}"></i>
                        @endif {{ $child->menuName }}

                      </a>
                    </li>
                  @endif
                @endforeach

                </ul>


              </li>
            @endif
          @endforeach

          <!--<a href="#">
            <i class="fa fa-edit"></i> <span>Forms</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-circle-o"></i> General Elements</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Editors</a></li>
          </ul>-->

      </ul>

    </section>

    <!-- /.sidebar -->
  </aside>
