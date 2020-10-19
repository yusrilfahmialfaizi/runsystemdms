<?php $this->load->view('partials2/main/header/header_admin'); ?>
<script type="text/javascript" src="assets/ckeditor/ckeditor.js"> </script>
<div class="page-body">
  <div class="container-fluid">
    <div class="page-header">
      <div class="row">
        <div class="col-lg-6 main-header">
          <h2>Home<span> Editor</span></h2>
          <h6 class="mb-0">Halaman Editor</h6>
        </div>
      </div>
    </div>
  </div>

  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <h1> Berikut Merupakan Teks Editor :)</h1><br>
      <textarea class="form-control" name="deskripsi"></textarea>
      <button type="button" class="btn btn-lg btn-primary btn-block">Simpan</button>
      <div class="clearfix">
      </div>

      <script type="text/javascript">
        window.onload = function() {
          CKEDITOR.replace('deskripsi');
        }
      </script>

    </div>
  </div>
</div>
<!-- Container-fluid Ends-->
<?php $this->load->view('partials2/main/footer'); ?>
<script type="text/javascript">
  $(document).ready(function() {
    $("#submit").on("click", function() {
      var usercode = $('#usercode').val();
      var pwd = $("#pwd").val();
      var url = 'http://127.0.0.1:8080/runsystemdms/getDataModules/:id';
      $.ajax({
        type: "GET",
        url: url,
        dataType: "JSON",
        data: {
          usercode: usercode,
          pwd: pwd
        },
        cache: false,
        success: function(data) {
          if (data.token != null) {
            // console.log(data)
            var base64Url = data.token.split('.')[1];
            var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
            var jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
              return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
            }).join(''));

            var result = JSON.parse(jsonPayload);
            session(result);
          } else {
            if (data.message == false) {
              var text = "Username atau password salah !!!"
              document.getElementById("wrong").innerHTML = text;
              document.getElementById("wrong").style.color = "#ff6666";
              document.getElementById("pwd").style.color = "#ff6666";
              document.getElementById("usercode").style.color = "#ff6666";
            }
          }
        }
      });
    });

    function session(result) {
      var usercode = result.usercode;
      var username = result.username;
      var grpcode = result.grpcode;
      var status = "login"
      var exp = result.exp;
      $.ajax({
        type: "POST",
        url: "http://localhost/runsystemdms/login/session",
        dataType: "JSON",
        data: {
          usercode: usercode,
          username: username,
          grpcode: grpcode,
          status: status,
          exp: exp
        },
        cache: false,
        success: function(data) {
          if (data.message == true) {
            window.location.href = "home";
          }
        }
      });
    }
  });
</script>