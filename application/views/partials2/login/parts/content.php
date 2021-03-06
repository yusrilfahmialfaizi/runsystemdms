<body id="top">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="/www.googletagmanager.com/ns.html?id=GTM-W24T6W7" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div class="page_loader"></div>

    <!-- Login 5 start -->
    <div class="login-5">
        <div class="container">
            <div class="row login-box">
                <div class="col-lg-6 bg-color-15 align-self-center pad-0 none-992 bg-img">
                </div>
                <div class="col-lg-6 align-self-center pad-0">

                    <div class="form-section align-self-center">
                        <h3>Masuk Akun</h3>
                        <div id="wrong" class="form-group"></div>
                        <!-- <div class="btn-section clearfix">
                        <a href="login-5.html" class="link-btn active btn-1 active-bg">Login</a>
                        <a href="register-5.html" class="link-btn btn-2 default-bg">Register</a>
                    </div> -->
                        <div class="clearfix"></div>
                        <form action="javascript:login()">
                            <div class="form-group form-box">
                                <input type="text" id="usercode" name="usercode" class="input-text" placeholder="Username">
                            </div>
                            <div class="form-group form-box clearfix">
                                <input type="password" id="pwd" name="pwd" class="input-text" placeholder="Password">
                            </div>
                            <div class="form-group form-box">
                                <button type="submit" id="submit" class="btn-md btn-theme float-right">Login</button>
                                <!--        <a href="forgot-password-5.html" class="forgot-password">Forgot Password</a> -->
                            </div>
                        </form>
                        <a> Belum punya akun? <a href="<?= base_url('register') ?>">Daftar</a></a>
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
                var usercode    = $('#usercode').val();
                var pwd         = $("#pwd").val();
                var url         = 'http://127.0.0.1:8080/runsystemdms/login';
                let current_datetime    = new Date();
                let date = current_datetime.getFullYear() + "" + (("0" + (current_datetime.getMonth() + 1)).slice(-2)) + "" + ("0" + current_datetime.getDate()).slice(-2);
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
                            if (result.expdate > date) {
                                session(result);    
                            }else{
                                var text = "Akun Anda Expired !!!"
                                document.getElementById("wrong").innerHTML = text;
                                document.getElementById("wrong").style.color = "#ff0000";
                                document.getElementById("pwd").style.color = "#ff0000";
                                document.getElementById("usercode").style.color = "#ff0000";
                            }
                        } else if (data.message == "username tidak terdaftar") {
                            var text = "Username anda belum terdaftar atau salah !!!"
                            document.getElementById("wrong").innerHTML = text;
                            document.getElementById("wrong").style.color = "#FFFFFF";
                            document.getElementById("pwd").style.color = "#ff0000";
                            document.getElementById("usercode").style.color = "#ff0000";
                        } else if (data.message == "password salah") {
                            var text = "Password anda salah !!!"
                            document.getElementById("wrong").innerHTML = text;
                            document.getElementById("wrong").style.color = "#FFFFFF";
                            document.getElementById("pwd").style.color = "#ff0000";
                            document.getElementById("usercode").style.color = "#ff0000";
                        }
                    }        
                }).fail(function () {
                    var text = "CONNECTION TO SERVER REFUSED"
                    document.getElementById("wrong").innerHTML = text;
                    document.getElementById("wrong").style.color = "#FF0000";
                })
            }

            function session(result) {
                var usercode            = result.usercode;
                var username            = result.username;
                var privilegecode       = result.privilegecode;
                var grpcode             = result.grpcode;
                var expdate             = result.expdate;
                var status              = "login";
                // alert(moonLanding.getMonth());
                // alert(date.getFullYear());
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
                            if (privilegecode == 'user' ) {
                                window.location.href = "<?php echo base_url("home") ?>";
                            }else if (privilegecode == 'admin'){
                                window.location.href = "<?php echo base_url("admin/home") ?>";
                            }else{
                                var text = "Anda bukan user !!!"
                                document.getElementById("wrong").innerHTML = text;
                                document.getElementById("wrong").style.color = "#ff0000";
                                document.getElementById("pwd").style.color = "#ff0000";
                                document.getElementById("usercode").style.color = "#ff0000";
                            }
                        }
                    }
                });
            }
        });
    </script>