        <!-- Page Sidebar Start-->
        <div id="sidebar" class="iconsidebar-menu iconbar-second-close">
          <div class="sidebar">
            <ul id="module" class="iconMenu-bar custom-scrollbar">
              <?php 
                foreach ($sidebar as $key) { 
                  for ($i=0; $i < count($key); $i++) {
                    if ($this->uri->segment("1") == "tabel"){ ?>
                      <?php if($i == 0) {?>
                        <li id="<?php echo $key[$i]["modulcode"]  ?>" class="open">
                      <?php  }else{ ?>
                          <li id="<?php echo $key[$i]["modulcode"]?>" class="">
                      <?php } ?>
                  <?php } elseif ($this->uri->segment("1") == "edit" || $this->uri->segment("1") == "editor") { ?>
                  <li id="<?php echo $key[$i]["modulcode"]  ?>" class="open">
                  <script type="text/javascript">
                    var modulCode = "<?php echo $this->session->userdata("modul") ?>";
                    $("li").removeClass("open");
                      document.getElementById(modulCode).className += "open";
                  </script>
                  <?php } ?>
                <div class="dropdown-basic">
                  <div class="dropdown">
                    <div class="btn-group mb-0">
                    <?php if ($this->uri->segment("1") == "tabel"){ ?>
                      <a class="bar-icons" href="<?php echo base_url("tabel?modulcode=").$key[$i]["modulcode"] ?>" >
                        <i></i><span><?php echo $key[$i]["modulname"] ?></span>
                      </a>
                    <?php }elseif ($this->uri->segment("1") == "edit" || $this->uri->segment("1") == "editor") { ?>
                      <a class="bar-icons" href="javascript:modules('<?php echo $key[$i]["modulcode"] ?>')" >
                        <i></i><span><?php echo $key[$i]["modulname"] ?></span>
                      </a>
                    <?php } ?>
                    </div>
                  </div>
                </div>
                <ul class="iconbar-mainmenu custom-scrollbar">
                  <li class="iconbar-header">
                    <?php if ($this->uri->segment("1") != "tabel"){?>
                    <b><p style="font-size:16.5px;" id="sub-header-<?php echo $key[$i]["modulcode"] ?>"><?php echo $this->session->userdata("docno") ?></p></b>
                    <?php }else{ ?>
                      <b><p style="font-size:16.5px;" id="sub-header-<?php echo $key[$i]["modulcode"] ?>">Sub Module</p></b>
                    <?php } ?>
                    <label><b><p>Final</b>
                        <input class="checkbox_animated" id="statushdr" name="statushdr-<?php echo $key[$i]["modulcode"] ?>" type="checkbox" data-code="<?php echo $key[$i]["modulcode"] ?>"></p>
                    </label>
                  </li>                  
                  <ul id="modul-menu-<?php echo $key[$i]["modulcode"] ?>"></ul>
                </ul>
              </li>
              <?php }} ?>
            </ul>
          </div>
        </div>
        <!-- Page Sidebar Ends-->