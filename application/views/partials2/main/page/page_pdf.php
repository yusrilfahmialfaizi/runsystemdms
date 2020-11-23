<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <style>
    .line-title{
      border: 0;
      border-style: inset;
      border-top: 1px solid #000;
    }
  </style>
  <script>
  .disable-select {
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;    
    -moz-user-select: none;      
    -ms-user-select: none;      
    user-select: none;
}
@media print{
   .disable-select{
       display:none
   }
}
$(document).bind('contextmenu cut copy', function (e) {
    e.preventDefault();
});
  </script>
 </head>
<body class="disable-select" onmousedown="return false" onselectstart="return false" onload="window.print()" style="margin-left:4cm; margin-right:3cm; margin-top:4cm; margin-bottom:3cm;">
  <table style="width: 100%;">
    <tr>
      <td align="center">
        <span style="line-height: 1.6; font-weight: bold;">
          Document Management System
          <br>Yogyakarta
          <hr class="line-title"> 
        </span>
        <span  style="line-height: 1.2;">
        <?php foreach($data as $dt){ ?>
         <h5 style="text-align:left"> <?php echo str_replace("0", ".",intVal($dt['menucode'])) ?> <?php echo $dt["menudesc"] ?></h5>
         <br>
         <p><?php echo $dt['description'] ?></p>
         <br>
        <?php } ?>
        </span>  
      </td>
    </tr>
</body>
  
</html>