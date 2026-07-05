    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?=base_url('admin'); ?>">
        <div class="sidebar-brand-icon">
          <img src="<?php echo base_url('public/assets/images/logo.png') ?>">
        </div>
        <div class="sidebar-brand-text mx-3">myGateway</div>
      </a>
      <hr class="sidebar-divider my-0">
      <?php 
        $request = \Config\Services::request();
        $uri = $request->getUri();
        $segment1 = $uri->getSegment(1);
        $segment2 = $uri->getSegment(2);
        if($segment1 == 'authentication-failed'){
          helper('custom');
        }
      ?>
      <li class="nav-item active">
        <a class="nav-link" href="<?=base_url('admin'); ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Navigation
      </div>

      <?php if(is_privilege(1) || is_privilege(2)){
        $collapsed = 'collapsed'; $show = '';
        if($segment2 == 'users' || $segment2 == 'user_groups'){
          $collapsed = ''; $show = 'show';
        }
      ?>
      <li class="nav-item">
        <a class="nav-link <?=$collapsed?>" href="#" data-toggle="collapse" data-target="#collapseForm" aria-expanded="true"
          aria-controls="collapseForm">
          <i class="fab fa-fw fa-wpforms"></i>
          <span>Users</span>
        </a>
        <div id="collapseForm" class="collapse <?=$show?>" aria-labelledby="headingForm" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!-- <h6 class="collapse-header">Users</h6> -->
            <?php if(is_privilege(1)){ ?>
            <a class="collapse-item <?=($segment2=='users')?'active':''?>" href="<?=base_url('admin/users')?>">Users</a>
            <?php } ?>
            <?php if(is_privilege(2)){ ?>
            <a class="collapse-item <?=($segment2=='user_groups')?'active':''?>" href="<?=base_url('admin/user_groups')?>">User Groups</a>
            <?php } ?>
          </div>
        </div>
      </li>
      <?php } ?>

      <?php if(is_privilege(100)){ ?>
      <li class="nav-item">
        <a class="nav-link" href="ui-colors.html">
          <i class="fas fa-fw fa-palette"></i>
          <span>UI Colors</span>
        </a>
      </li>
      <?php } ?>
    </ul>
    <!-- Sidebar -->
