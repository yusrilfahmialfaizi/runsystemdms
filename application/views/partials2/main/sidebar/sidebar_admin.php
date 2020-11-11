        <!-- Page Sidebar Start-->
        <div id="sidebar" class="iconsidebar-menu iconbar-second-close">
          <div class="sidebar">
            <ul id="module" class="iconMenu-bar custom-scrollbar">
              <?php foreach ($sidebar as $key) { 
                      for ($i=0; $i < count($key); $i++) { 
                        for ($j=0; $j < count($key[$i]["modul"]); $j++) { 
                            
              ?>
              <li id="<?php echo $key[$i]["modul"][$j]["modulname"]  ?>">
              <?php if ($this->uri->segment("1") == "home") { ?>
                <div class="dropdown-basic">
                  <div class="dropdown">
                    <div class="btn-group mb-0">
                    <a class="bar-icons" href="<?php echo base_url("tabel")?>" onClick="modulCode('<?php echo $key[$i]["modul"][$j]["modulcode"] ?>')">
                      <i></i><span><?php echo $key[$i]["modul"][$j]["modulname"] ?></span>
                    </a>
                    </div>
                  </div>
                </div>
              <?php }else{ ?>
                <div class="dropdown-basic">
                  <div class="dropdown">
                    <div class="btn-group mb-0">
                      <a class="bar-icons" href="#" onClick="modulCode('<?php echo $key[$i]["modul"][$j]["modulcode"] ?>')">
                        <i></i><span><?php echo $key[$i]["modul"][$j]["modulname"] ?></span>
                      </a>
                    </div>
                  </div>
                </div>
                <ul class="iconbar-mainmenu custom-scrollbar">
                  <li class="iconbar-header">
                    <b><p id="sub-header-<?php echo $key[$i]["modul"][$j]["modulcode"] ?>">Sub Module</p></b>
                    <span>Status 
                      <input class="checkbox_animated" id="statushdr" name="statushdr-<?php echo $key[$i]["modul"][$j]["modulcode"] ?>" type="checkbox" data-code="<?php echo $key[$i]["modul"][$j]["modulcode"] ?>">
                    </span>
                  </li>
                  <li id="<?php echo $key[$i]["modul"][$j]["modulcode"] ?>"></li>
                </ul>
              <?php } ?>
              </li>
              <?php }}} ?>
            </ul>
          </div>
        </div>
        <!-- Page Sidebar Ends-->