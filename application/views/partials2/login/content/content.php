<body id="top">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="/www.googletagmanager.com/ns.html?id=GTM-W24T6W7"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
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
                    <form action="#" method="GET">
                        <div class="form-group form-box">
                            <input type="text" id="usercode" name="usercode" class="input-text" placeholder="Username">
                        </div>
                        <div class="form-group form-box clearfix">
                            <input type="password" id="pwd" name="pwd" class="input-text" placeholder="Password">
                        </div>
                        <div class="form-group form-box">
                        <button type="button" id="submit" class="btn-md btn-theme float-right">Login</button>
                     <!--        <a href="forgot-password-5.html" class="forgot-password">Forgot Password</a> -->
                        </div>
                    </form>
                </div>
            </div>            
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#submit").on("click", function(){
            var usercode = $('#usercode').val();
            var pwd = $("#pwd").val();
            var url = 'http://127.0.0.1:8080/runsystemdms/login';
            $.ajax({
                type : "POST",
                url  : url,
                dataType : "JSON",
                data : {usercode: usercode, pwd : pwd },
                cache:false,
                success: function(data){
                    if (data.token != null){
                        // console.log(data)
                        var base64Url = data.token.split('.')[1];
                        var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
                        var jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
                            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
                        }).join(''));

                        var result = JSON.parse(jsonPayload);
                        session(result);
                    }else{
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
                type : "POST",
                url : "http://localhost/runsystemdms/login/session",
                dataType : "JSON",
                data : {usercode :usercode, username: username, grpcode:grpcode, status : status,exp : exp},
                cache : false,
                success : function(data){
                    if (data.message == true) {
                        window.location.href = "home";
                    }
                }
            });
        }
    });
</script>
