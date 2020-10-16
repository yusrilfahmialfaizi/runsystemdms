<nav class="main-menu">
        <ul>
            <li>
                <a href="<?php echo site_url('home')?>">
                    <i class="fa fa-home nav_icon"></i>
                    <span class="nav-text">
                    Dashboard
                    </span>
                </a>
            </li>
            <li class="has-subnav">
                <a href="javascript:;">
                <i class="fa fa-file-text-o nav_icon" aria-hidden="true"></i>
                <span class="nav-text">
                    Modul
                </span>
                <i class="icon-angle-right"></i><i class="icon-angle-down"></i>
                </a>
                <ul>
                    <li>
                    <a class="subnav-text" href="<?php echo site_url('modul')?>">
                    Modul 1
                    </a>
                    </li>
                    <li>
                    <a class="subnav-text" href="">
                    Modul 2
                    </a>
                    </li>
                </ul>
            </li>

        </ul>   
        <ul class="logout">
            <li>
            <a href="<?php echo base_url("login/logout");?>">
            <i class="icon-off nav-icon"></i>
            <span class="nav-text">
            Logout
            </span>
            </a>
            </li>
        </ul>
    </nav>