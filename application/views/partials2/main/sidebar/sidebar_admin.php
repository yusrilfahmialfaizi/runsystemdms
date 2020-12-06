        <!-- Page Sidebar Start-->
        <?php 
          $uri3 = $this->uri->segment("3");
          if ($uri3 == null) {
        ?>
        <div id="side" class="iconsidebar-menu iconbar-mainmenu-close">
          <div class="sidebar">
            <ul class="iconMenu-bar custom-scrollbar">
              <li id="home" >
                <a class="bar-icons" href="javascript:void(0)">
                  <i class="pe-7s-home"></i>
                  <span>Home</span>
                </a>
              </li>
              <li id="user" >
                <a class="bar-icons" href="<?php echo base_url("admin/user") ?>">
                  <i class="pe-7s-home"></i>
                  <span>User</span>
                </a>
              </li>
              <li id="project"  >
                <a class="bar-icons" href="<?php echo base_url("admin/project") ?>">
                  <i class="pe-7s-home"></i>
                  <span>Project</span>
                </a>
              </li>
              <li id="module"  >
                <a class="bar-icons" href="<?php echo base_url("admin/module") ?>">
                  <i class="pe-7s-home"></i>
                  <span>Module</span>
                </a>
              </li>
              <li id="group"  >
                <a class="bar-icons" href="javascript:void(0)">
                  <i class="pe-7s-home"></i>
                  <span>Group</span>
                </a>
              </li>
              <li id="menu"  >
                <a class="bar-icons" href="<?php echo base_url("admin/menu") ?>">
                  <i class="pe-7s-home"></i>
                  <span>Menu</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <?php }else {?>
        <div id="side" class="iconsidebar-menu iconbar-second-close">
          <div class="sidebar">
          </div>
        </div>
        <?php } ?>
        <!-- Page Sidebar Ends -->