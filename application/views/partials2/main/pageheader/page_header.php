<!-- Page Header Start-->
<div class="page-main-header">
  <div class="main-header-right">
    <div class="main-header-left text-center">
      <div class="logo-wrapper"><a href="<?php echo base_url("home")?>"><img src="<?php echo base_url("assets/images/logo/dms.png") ?>" alt=""></a></div>
    </div>
    <div class="mobile-sidebar">
      <div class="media-body text-right switch-sm">
      <?php 
        $uri1 = $this->uri->segment("1");
        $uri2 = $this->uri->segment("2");
        $uri3 = $this->uri->segment("3");
      ?>
      <?php if ($uri1 != "home") { ?>
        <?php if ($uri3 == null) { ?>
          <label class="switch ml-3"><i class="font-primary" onClick="sidebar_toggle()" id="sidebar-toggle" data-feather="align-center"></i></label>
        <?php } ?>
      <?php } ?>
      </div>
    </div>
    <div class="vertical-mobile-sidebar"><i class="fa fa-bars sidebar-bar"> </i></div>
    <div class="nav-right col pull-right right-menu">
      <ul class="nav-menus">
        <li>
        </li>
        <li><a class="text-dark" href="#" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
        <li class="onhover-dropdown"> <span class="media user-header"><img class="img-fluid" src="<?php echo base_url("assets/images/dashboard/user.png") ?>" alt=""></span>
          <ul class="onhover-show-div profile-dropdown">
            <li class="gradient-primary">
              <h5 class="f-w-600 mb-0"><?php echo $this->session->userdata('username') ?></h5><span>Admin</span>
            </li>
            <li><i data-feather="user"> </i>Profile</li>
            <li><a href="<?php echo base_url('login/logout') ?>"><i data-feather="log-out"></i>Logout</a></li>
          </ul>
        </li>
      </ul>
      <div class="d-lg-none mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div>
    </div>
  </div>
</div>
<!-- Page Header Ends -->