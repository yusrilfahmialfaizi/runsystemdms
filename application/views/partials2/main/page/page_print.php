<!DOCTYPE html>
<html>
<head>
  <style>
    .line-title {
      border: 0;
      border-style: inset;
      border-top: 1px solid #000;
    }
  </style>
  <script>
    .disable - select {
      -webkit - touch - callout: none; -
      webkit - user - select: none; -
      khtml - user - select: none; -
      moz - user - select: none; -
      ms - user - select: none;
      user - select: none;
    }
    @media print {
      .disable - select {
        display: none
      }
    }
    $(document).bind('contextmenu cut copy', function (e) {
      e.preventDefault();
    });
  </script>
  <script>
    document.onkeypress = function (event) {
      event = (event || window.event);
      if (event.keyCode == 123) {
        return false;
      }
    }
    document.onmousedown = function (event) {
      event = (event || window.event);
      if (event.keyCode == 123) {
        return false;
      }
    }
    document.onkeydown = function (event) {
      event = (event || window.event);
      if (event.keyCode == 123) {
        return false;
      }
    }
  </script>
</head>

<body class="disable-select" onmousedown="return false" onselectstart="return false"
  style="margin-left:4cm; margin-right:3cm; margin-top:4cm; margin-bottom:3cm;">
  <table style="width: 100%;">
    <td align="center">
      <span style="line-height: 1.6; font-weight: bold;">
        Document Management System
        <br>Yogyakarta
        <hr class="line-title">
      </span>
      <!-- <span style="line-height: 1.2;"> -->
        <?php foreach($data as $dt){ ?>
        <h5 style="text-align:left"> <?php echo str_replace("0", ".",intVal($dt['menucode'])) ?>
          <?php echo $dt["menudesc"] ?></h5>
        <p style="text-align:left"><?php echo $dt['menucode'] ?></p>
        <br>
      <?php } ?>
      <!-- </span> -->
      asdasda
    </td>
    </tr>
</body>

</html>