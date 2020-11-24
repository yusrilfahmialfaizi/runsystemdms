<!DOCTYPE html>
<html>
<head>
<script>
function print(ths) {
        var docno = $(ths).attr("data-docno");
        var modulcode = $(ths).attr("data-modulcode");
        console.log(docno + modulcode);
        window.open('tabel/pdf?docno=' + docno + '&modulcode=' + modulcode + '', '_blank');
      }
</script>
<script type="text/javascript">      window.addEventListener("keydown",function(e){
        if(e.ctrlKey && (e.which==80)){
            e.preventDefault();
            alert("Tidak Bisa Print");
        }
    });
</script>
<script type="text/javascript">
var message="Tidak Bisa Klik Kanan";
///////////////////////////////////
function clickIE4(){if (event.button==2){alert(message);return false;}}
function clickNS4(e){if (document.layers||document.getElementById&&!document.all){if (e.which==2||e.which==3){alert(message);return false;}}}
if (document.layers){document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS4;}
else if (document.all&&!document.getElementById){document.onmousedown=clickIE4;}
document.oncontextmenu=new Function("alert(message);return false")
</script>
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
<body class="disable-select" onmousedown="return false" onselectstart="return false"  style="margin-left:4cm; margin-right:3cm; margin-top:4cm; margin-bottom:3cm;">
  <table style="width: 100%;">
  <?php foreach($data as $d){ ?>
  <button width="20" type="button" data-docno="<?php echo $d["docno"]; ?>" data-modulcode="<?php echo $d["modulcode"]; ?>" onClick="print(this)" data-feather="book-open">Preview</button>
  <?php } ?> 
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
    <?php $this->load->view("partials2/main/js/js_admin") ?>

</body>
  
</html>