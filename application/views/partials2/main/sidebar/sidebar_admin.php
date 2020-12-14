<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">DMS</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="<?php echo base_url("admin/home") ?>">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Home</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Daftar Menu
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="<?php echo base_url("admin/user")?>" aria-expanded="true"
      aria-controls="collapseTwo">
      <i class="fas fa-fw fa-user"></i>
      <span>User</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="<?php echo base_url("admin/privilege")?>" aria-expanded="true"
      aria-controls="collapseTwo">
      <i class="fas fa-fw fa-user"></i>
      <span>Privilege</span>
    </a>
  </li>

  <!-- Nav Item - Utilities Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="<?php echo base_url("admin/project")?>" aria-expanded="true"
      aria-controls="collapseUtilities">
      <i class="fas fa-fw fa-briefcase"></i>
      <span>Project</span>
    </a>
  </li>

  <!-- Nav Item - Utilities Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="<?php echo base_url("admin/module")?>" aria-expanded="true"
      aria-controls="collapseUtilities">
      <i class="fas fa-fw fa-folder"></i>
      <span>Module</span>
    </a>
  </li>

  <!-- Nav Item - Utilities Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="<?php echo base_url("admin/menu")?>" aria-expanded="true"
      aria-controls="collapseUtilities">
      <i class="fas fa-fw fa-folder-open"></i>
      <span>Menu</span>
    </a>
  </li>

  <!-- Nav Item - Utilities Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="<?php echo base_url("admin/group")?>" aria-expanded="true"
      aria-controls="collapseUtilities">
      <i class="fas fa-fw fa-users"></i>
      <span>Group</span>
    </a>
  </li>

  <!-- Nav Item - Utilities Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="<?php echo base_url("admin/groupmenu")?>" aria-expanded="true"
      aria-controls="collapseUtilities">
      <i class="fas fa-fw fa-copy"></i>
      <span>Group Menu</span>
    </a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>
<!-- End of Sidebar -->