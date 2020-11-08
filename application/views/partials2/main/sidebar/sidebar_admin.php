        <!-- Page Sidebar Start-->
        <div id="sidebar" class="iconsidebar-menu iconbar-second-close">
          <div class="sidebar">
            <ul id="module" class="iconMenu-bar custom-scrollbar">
              <?php foreach ($sidebar as $key) { 
                      for ($i=0; $i < count($key); $i++) { 
                        for ($j=0; $j < count($key[$i]["modul"]); $j++) { 
                            
              ?>
              <li id="<?php echo $j ?>">
                <div class="dropdown-basic">
                  <div class="dropdown">
                    <div class="btn-group mb-0">
                      <button class="dropbtn btn-primary" type="button"><?php echo $key[$i]["modul"][$j]["modulname"] ?> 
                        <span><i class="icofont icofont-arrow-down"></i></span>
                      </button>
                      <div class="dropdown-content">
                        <a href="<?php echo base_url("tabel")?>">Add Document</a>
                        <a href="javascript:modules('<?php echo $j ?>')">Open Submodules</a>
                      </div>
                    </div>
                  </div>
                </div>
                <ul class="iconbar-mainmenu custom-scrollbar">
                  <li class="iconbar-header">Sub Module</li>
                  <li id="<?php echo $key[$i]["modul"][$j]["modulcode"] ?>"></li>
                </ul>
              </li>
              <?php }}} ?>
            </ul>
          </div>
        </div>
        <!-- Page Sidebar Ends-->