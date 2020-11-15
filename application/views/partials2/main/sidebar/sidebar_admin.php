        <!-- Page Sidebar Start-->
        <div id="sidebar" class="iconsidebar-menu iconbar-second-close">
          <div class="sidebar">
            <ul id="module" class="iconMenu-bar custom-scrollbar">
              <?php 
                foreach ($sidebar as $key) { 
                  for ($i=0; $i < count($key); $i++) {
                    if ($i == 0 && $this->uri->segment("1") != "home"){ ?>
                      <li id="<?php echo $key[$i]["modulname"]  ?>" class="open">
                  <?php  }else{ ?>
                      <li id="<?php echo $key[$i]["modulname"]  ?>">
                  <?php  }  ?>
                <div class="dropdown-basic">
                  <div class="dropdown">
                    <div class="btn-group mb-0">
                      <a class="bar-icons" href="#">
                        <i></i><span><?php echo $key[$i]["modulname"] ?></span>
                      </a>
                    </div>
                  </div>
                </div>
                <ul class="iconbar-mainmenu custom-scrollbar">
                  <li class="iconbar-header">
                    <b><p id="sub-header-<?php echo $key[$i]["modulcode"] ?>">Sub Module</p></b>
                    <span>Final 
                      <input class="checkbox_animated" id="statushdr" name="statushdr-<?php echo $key[$i]["modulcode"] ?>" type="checkbox" data-code="<?php echo $key[$i]["modulcode"] ?>">
                    </span>
                  </li>
                  <ul id="modul-menu-<?php echo $key[$i]["modulcode"] ?>"></ul>
                </ul>
              </li>
              <?php }} ?>
            </ul>
          </div>
        </div>
        <!-- Page Sidebar Ends-->