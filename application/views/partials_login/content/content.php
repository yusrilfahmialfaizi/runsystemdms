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
            <div class="col-lg-6 align-self-center pad-0">
                <div class="form-section align-self-center">
                    <h3>Sign into your account</h3>
                    <div class="btn-section clearfix">
                        <a href="login-5.html" class="link-btn active btn-1 active-bg">Login</a>
                        <a href="register-5.html" class="link-btn btn-2 default-bg">Register</a>
                    </div>
                    <div class="clearfix"></div>
                    <form action="#" method="GET">
                        <div class="form-group form-box">
                            <input type="text" id="usercode" name="usercode" class="input-text" placeholder="Email Address">
                        </div>
                        <div class="form-group form-box clearfix">
                            <input type="password" id="pwd" name="pwd" class="input-text" placeholder="Password">
                        </div>
                        <div class="form-group clearfix mb-0">
                            <button type="button" id="submit" class="btn-md btn-theme float-left">Login</button>
                            <a href="forgot-password-5.html" class="forgot-password">Forgot Password</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 bg-color-15 align-self-center pad-0 none-992 bg-img">
                <div class="info clearfix">
                    <div class="logo-2">
                        <a href="login-5.html">
                            <img src="<?php echo base_url('assets_login/img/logos/logo.png')?>" alt="logo">
                        </a>
                    </div>
                    <h3>Welcome to Logdy</h3>
                    <div class="social-list">
                        <a href="#" class="facebook-bg">
                            <i class="fa fa-facebook"></i>
                        </a>
                        <a href="#" class="twitter-bg">
                            <i class="fa fa-twitter"></i>
                        </a>
                        <a href="#" class="google-bg">
                            <i class="fa fa-google"></i>
                        </a>
                        <a href="#" class="linkedin-bg">
                            <i class="fa fa-linkedin"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        // var url = 'http://127.0.0.1:8080/runsystemdms/getUsers';
        // $.ajax({ 
        //     type: 'GET', 
        //     url: url,
        //     dataType: 'json',
        //     cache :false,
        //     success: function (data) {
        //             data = JSON.parse(JSON.stringify(data));
        //             console.log(data.user[0].usercode)
        //             data = data.user;
        //             for (i = 0; i < data.length; i++){
        //                 // $('#jancok').val(data.id_user);
        //                 // $("#result").html(data['user'].id_user);
        //                 // alert(data[i].id_user);
        //             }
        //     }
        // });
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
                        // window.location.href = "home";
                        // console.log(data)
                        var base64Url = data.token.split('.')[1];
                        var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
                        var jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
                            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
                        }).join(''));

                        var result = JSON.parse(jsonPayload);
                        alert(result.name)
                    }
                        // data = JSON.parse(JSON.stringify(data));
                        // // console.log(data.user[0].id_user)
                        // data = data.user;
                        // for (i = 0; i < data.length; i++){
                        //     // $('#jancok').val(data.id_user);
                        //     // $("#result").html(data['user'].id_user);
                        //     var email = $('#email').val();
                        //     var password = $("#password").val();
                        //     alert(data[i].username +' '+ email );
                        //     // if (data[i].username == email && password_verify(data[i].password, password)) {
                        //     //     alert("cocok");
                        //     // }else{
                        //     //     alert("tidak cocok");
                        //     // }
                        // }
                }
            });
        });
    });
</script>
