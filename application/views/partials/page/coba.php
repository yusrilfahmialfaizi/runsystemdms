<html>
<?php $this->load->view("partials/parts/head"); ?>
<body>
     <h5>DANCOOOK !!!</h5>
     <div id="result"></div>
     <div id="result2"></div>
     <div id="result3"></div>
     <script type="text/javascript">
		$(document).ready(function(){
               var url = 'http://127.0.0.1:8080/runsystemdms/getUsers';
               $.ajax({ 
                    type: 'GET', 
                    url: url,
                    dataType: 'json',
                    cache :false,
                    success: function (data) {
                         data = JSON.parse(JSON.stringify(data));
                         console.log(data.user[0].id_user)
                         data = data.user;
                         for (i = 0; i < data.length; i++){
                              // $('#jancok').val(data.id_user);
                              // $("#result").html(data['user'].id_user);
                              alert(data[i].id_user);
                         }
                    }
               });
          });
     </script>
<?php $this->load->view("partials/parts/script"); ?>
</body>
</html>