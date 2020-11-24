<!DOCTYPE html>
<html>
<body class="disable-select" onmousedown="return false" onselectstart="return false"  style="margin-left:4cm; margin-right:3cm; margin-top:4cm; margin-bottom:3cm;">
  <table style="width: 100%;">
      <td align="center">
        <span style="line-height: 1.6; font-weight: bold;">
          Document Management System
          <br>Yogyakarta
          <hr class="line-title"> 
        </span>
        <span  style="line-height: 1.2;">
        <?php foreach($data as $dt){ ?>
         <h5 style="text-align:left"> <?php echo str_replace("0", ".",intVal($dt['menucode'])) ?> <?php echo $dt["menudesc"] ?></h5>
         <p style="text-align:left"><?php echo $dt['menucode'] ?></p>
         <br>
        </span>
        <?php } ?>    
      </td>
    </tr>
</body>
  
</html>