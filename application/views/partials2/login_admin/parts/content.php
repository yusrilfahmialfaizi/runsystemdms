<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center" style="margin-top: 10%;">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Admin Login!</h1>
                                    <div id="wrong" class="form-group"></div>
                                    </div>
                                    <form action="javascript:login()">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="usercode" name="usercode" aria-describedby="usercode" placeholder="Usercode">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="pwd" name="pwd" placeholder="Password">
                                        </div>
                                        <button type="submit" id="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#submit").on("click", function() {
                login();
            });

            function login() {
                var usercode = $('#usercode').val();
                var pwd = $("#pwd").val();
                var url = 'http://127.0.0.1:8080/runsystemdms/loginadmin';
                $.ajax({
                    type: "POST",
                    url: url,
                    dataType: "JSON",
                    data: {
                        usercode: usercode,
                        pwd: pwd
                    },
                    cache: false,
                    success: function(data) {
                        if (data.token != null) {
                            console.log(data)
                            var base64Url = data.token.split('.')[1];
                            var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
                            var jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
                                return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
                            }).join(''));

                            var result = JSON.parse(jsonPayload);
                            session(result);
                        } else if (data.message == "username tidak terdaftar") {
                            var text = "Username anda belum terdaftar atau salah !!!"
                            document.getElementById("wrong").innerHTML = text;
                            document.getElementById("wrong").style.color = "#ff0000";
                            document.getElementById("pwd").style.color = "#ff0000";
                            document.getElementById("usercode").style.color = "#ff0000";
                        } else if (data.message == "password salah") {
                            var text = "Password anda salah !!!"
                            document.getElementById("wrong").innerHTML = text;
                            document.getElementById("wrong").style.color = "#ff0000";
                            document.getElementById("pwd").style.color = "#ff0000";
                            document.getElementById("usercode").style.color = "#ff0000";
                        } else if (data.message == "role anda bukan admin") {
                            var text = "Anda bukan admin !!!"
                            document.getElementById("wrong").innerHTML = text;
                            document.getElementById("wrong").style.color = "#ff0000";
                            document.getElementById("pwd").style.color = "#ff0000";
                            document.getElementById("usercode").style.color = "#ff0000";
                        }
                    }        
                }).fail(function () {
                    var text = "CONNECTION TO SERVER REFUSED"
                    document.getElementById("wrong").innerHTML = text;
                    document.getElementById("wrong").style.color = "#FF0000";
                });
            }

            function session(result) {
                var usercode        = result.usercode;
                var username        = result.username;
                var privilegecode   = result.privilegecode;
                var grpcode         = result.grpcode;
                var status          = "login"
                $.ajax({
                    type: "POST",
                    url: "http://localhost/runsystemdms/login/session",
                    dataType: "JSON",
                    data: {
                        usercode: usercode,
                        username: username,
                        privilegecode: privilegecode,
                        grpcode: grpcode,
                        status: status
                    },
                    cache: false,
                    success: function(data) {
                        if (data.message == true) {
                            if (privilegecode == '001' ) {
                                window.location.href = "<?php echo base_url("admin/home") ?>";
                            }
                        }
                    }
                });
            }
        });
    </script>