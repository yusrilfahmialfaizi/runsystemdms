<ol class="breadcrumb">

 <?php foreach ($this->uri->segments as $segment ):?>
  <?php
  $url = substr($this->uri->uri_string,0, strpos($this->uri->uri_string, $segment)) . $segment;
  $is_active = $url == $this->uri->uri_string;
  ?>
  <li class="breadcrumb-item <?php echo $is_active ? 'active': '' ?>">

    <?php if ($is_active):?>
      <?php if ($this->uri->segment("1") != "home"):?>
        <?php echo ucfirst($segment) ." / " ?><?php echo $this->session->userdata("menuName") ?> 
      <?php else: ?>
        <a href="#"><i class="pe-7s-home"></i></a>
      <?php endif; ?>
    <?php else: ?>
        <a href="<?php echo site_url($url) ?>"><?php echo ucfirst($segment) ?>\<?php echo $this->session->userdata("menuName") ?></a>
    <?php endif; ?>
  </li>
<?php endforeach; ?>
</ol>