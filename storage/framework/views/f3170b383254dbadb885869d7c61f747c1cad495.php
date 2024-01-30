
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- sidebar menu: : style can be found in sidebar.less -->
      

      <div id="temp"></div>
      <ul class="sidebar-menu">
        <?php if(env('APP_TYPE')!='bank'): ?>
                <!--<li id="profile-sidebar" class="treeview">
                  <div class="row">
                    <div class="col-xs-4" style="padding-right:0px;">
                      <div id="profile-img">
                        <img src="<?php echo e(assets_url('images/avatar04.png')); ?>"/>
                </div>
              </div>
              <div class="col-xs-8">
                <h5><strong>Saraswati</strong></h5>
                <p class="uppercase">PT. Maju Jaya</p>
              </div>
            </div>
          </li>-->
          <?php endif; ?>
          <li>
            <a href="javascript:void(0)" onclick="app.setView('dashboard')">
              <i class="fa fa-home"></i>
                <span> Dashboard</span>
            </a>
          </li>

          <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($item->lvl=='1'): ?>
                <?php $hasChild = false ?>
                    <?php if($menu): ?>
                    <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($child->lvl=='2' && $child->parentMenuCode==$item->menuCode): ?>
                            <?php $hasChild = true ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                <?php if(!$hasChild): ?>
                <li>
                <a id="<?php echo e($item->menuCode); ?>" data-service="<?php echo e($item->menuCode); ?>" data-parent-menu="" data-menu="<?php echo e(strtolower(str_replace(' ','-',$item->menuName))); ?>" href="javascript:void(0)" v-on:click="setView('<?php echo e($item->menuCode); ?>')">
                <i class="fa <?php echo e($item->icon); ?>"></i> <?php echo e($item->menuName); ?>

                </a>
                </li>
                <?php else: ?>
              <li class="treeview">
                <a href="#">
                <i class="fa <?php echo e($item->icon); ?>"></i>
                <span> <?php echo e($item->menuName); ?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <?php endif; ?>
                <ul class="treeview-menu">

                <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($child->lvl=='2' && $child->parentMenuCode==$item->menuCode): ?>
                    <li>
                      
                      <a id="<?php echo e($child->menuCode); ?>" data-service="<?php echo e($child->menuCode); ?>" data-parent-menu="<?php echo e(strtolower(str_replace(' ','-',$child->parentMenuName))); ?>" data-menu="<?php echo e(strtolower(str_replace(' ','-',$child->menuName))); ?>" href="javascript:void(0)" v-on:click="setView('<?php echo e($child->menuCode); ?>')">

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php if(isset($child->icon) && $child->icon!=''): ?>
                          <i class="fa <?php echo e($child->icon); ?>"></i>
                        <?php endif; ?> <?php echo e($child->menuName); ?>


                      </a>
                    </li>
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </ul>


              </li>
            <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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
<?php /**PATH D:\Downloads\Upgrade Laravel Framework\bank-line\resources\views/_partials/sidebar.blade.php ENDPATH**/ ?>