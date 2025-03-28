<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Login</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('admin/assets/img/favicon.png'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('admin/assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('admin/assets/css/fontawesome/all.min.css'); ?>">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('admin/assets/css/style.css'); ?>">


    <script src="https://www.google.com/recaptcha/enterprise.js?render=6LeBggIrAAAAAGG4rxNONrTxW-5HahxgedGGUBOe"></script>
    <style>
        #submitButton {
            background-color: #444444;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #submitButton:hover {
            background-color: #555555;
        }

        #submitButton:disabled {
            background-color: #777777;
            cursor: not-allowed;
        }
    </style>
    <style>
        .login-main-panel .login-content .form-control {
            padding: 0.90rem 0.75rem;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .carousel-indicators {
            display: none;
        }


        .login-main-panel {

            width: 100%;
            padding-right: 25px !important;
            padding-left: 25px !important;
            margin-right: auto;
            margin-left: auto;
            box-sizing: border-box;
        }

        .login-main-panel .login-content {
            width: 100%;
            border-radius: 20px;
            border-radius: 12px;
            background: linear-gradient(145deg, rgba(255, 218, 133, 0.40) 0.37%, rgba(255, 205, 174, 0.40) 99.63%);
            padding: 3rem 3rem;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            margin-bottom: 0px;
            height: 100%;
            left: 20px;
            position: relative;
        }

        .login-content {
            margin-top: 30px;
        }



        .login-content h5 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .login-content p {
            font-size: 14px;
            margin-bottom: 20px;
        }

        .forgot-password {
            float: right;
            font-size: 12px;
            color: #f26522;
        }

        .or-login {
            margin: 15px 0;
            font-size: 14px;
            font-weight: bold;
        }

        .help-links {
            margin-top: 20px;
            font-size: 12px;
        }

        .help-links a {
            color: #f26522;
        }

        .login-img {
            width: 100%;
            height: 100%;

        }

        .carousel {
            width: 100%;
        }

        .carousel-inner {
            width: 100%;
            height: 100%;
        }

        .carousel-indicators li {
            background-color: #f26522;
        }

        .carousel-indicators .active {
            background-color: #ff6f33;
        }

        body {
            background-image: url("../assets/bg.png");
            height: 100vh;
            background-position: center;
            background-repeat: repeat;
            background-size: cover;
            /* overflow: hidden; */
        }

        .login-main-panel .login-img img {
            width: 95%;
            border-radius: 20px;
            margin-top: 4px;
            height: auto;
        }

        .button {
            padding: 10px;
            border-radius: 4.104px;
            background: linear-gradient(90deg, #F9AD02 0%, #EE5A00 100%);
            box-shadow: 0px 2.052px 0px 0px #9F430A;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            width: 50% !important;
        }

        .button:hover {
            background-color: #e67e22 !important;
        }

        .h5 {
            font-family: Inter;
            font-size: 24px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
            background: linear-gradient(90deg, #EE5A00 0%, #EF6400 100%);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .pb-6 {
            padding-bottom: 3.3rem;
        }

        .bg-image {
            position: absolute;
            right: 0;
            z-index: 1;
        }

        .input-group input {
            padding: 10px !important;
        }

        .input-group-text {
            background: #e97f25;
            color: #fff;
        }
    </style>

</head>



<body class="body">
    <div class="login-main-panel">
        <div class="bg-image">
            <img src="assets/Bloom.png" width="210" alt="">
        </div>
        <div class="row justify-content-center py-0">
            <div class="col-md-7 col-12 p-0 mt-0 text-center">
                <img src="<?= base_url("admin/assets/logo_1.png") ?>" width="500" alt="...">
                <div class="login-img">
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel"
                        data-bs-wrap="true" data-bs-interval="2000">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="assets/Frame1.png" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Frame2.png" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Frame3.png" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="assets/Frame4.png" class="d-block w-100" alt="...">
                            </div>
                        </div>

                        <ol class="carousel-indicators">
                            <li data-bs-target="#carouselExampleSlidesOnly" data-bs-slide-to="0" class="active"></li>
                            <li data-bs-target="#carouselExampleSlidesOnly" data-bs-slide-to="1"></li>
                            <li data-bs-target="#carouselExampleSlidesOnly" data-bs-slide-to="2"></li>
                            <li data-bs-target="#carouselExampleSlidesOnly" data-bs-slide-to="3"></li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12 mt-3">
                <div class="login-content">

                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success">
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php endif; ?>

                    <style>
                        #form .indicator {
                            width: 10px;
                            height: 10px;
                            background: #555;
                            border-radius: 50%;
                        }

                        #form.valid .indicator {
                            background: #0f0;
                            box-shadow: 0 0 5px #0f0, 0 0 10px #0f0, 0 0 20px #0f0, 0 0 40px #0f0;
                        }

                        #form.invalid .indicator {
                            background: #f00;
                            box-shadow: 0 0 5px #f00, 0 0 10px #f00, 0 0 20px #f00, 0 0 40px #f00;
                        }
                    </style>


                    <form action="<?php echo base_url('admin/login'); ?>" method="post" id="form">

                    <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">


                        <div class="login-logo align-items-center text-center pb-1">
                            <img class="logo_imgsw" style="width: 50%;" src="assets/image.png" alt="Login Logo">
                        </div>

                        <div class="text-center">
                            <h5 class="h5 mt-3"> Please enter your Login details</h5>
                        </div>

                        <div class="mb-3 mt-4">
                            <label>Please Enter Your Email</label>
                            <div class="input-group pt-1">
                                <input type="text" onkeyup="validate();" id="email" class="form-control" name="email"
                                    placeholder="Enter Email" required="required">
                                <span class="input-group-text">
                                    <span class="fa fa-envelope"></span>
                                </span>

                            </div>
                        </div>


                        <div class="mb-2 mt-4">
                            <label>Please Enter Your Password</label>
                            <div class="input-group pt-1">
                                <input id="new_password" type="password" class="form-control"
                                    autocomplete="new-password" name="password" placeholder="********" required>
                                <span class="input-group-text"
                                    onclick="togglePassword('new_password', 'newPasswordToggle')">
                                    <i id="newPasswordToggle" class="fa fa-eye-slash"></i>
                                </span>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="fxt-switcher-description2 text-right">
                                <a href="<?php echo base_url('admin/forgot-password'); ?>"
                                    class="fxt-switcher-text"> <i class="fa fa-key"></i> Recovery Password</a>
                            </div>
                        </div>

                        <div class="login-btn d-flex justify-content-center pt-2 pb-2">
                            <button type="submit" id="submitButton" disabled class="button">Login</button>
                        </div>


                        <div class="text-center">
                            <img src="assets/Bloom_2.gif" alt="" width="100">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid login-main-panel">
        <div class="container" style="width: 100%;">
        </div>
    </div>

    <script src="<?php echo base_url('admin/assets/js/jquery-3.5.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('admin/assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('admin/assets/js/imagesloaded.pkgd.min.js'); ?>"></script>
    <script src="<?php echo base_url('admin/assets/js/validator.min.js'); ?>"></script>
    <script src="<?php echo base_url('admin/assets/js/main.js'); ?>"></script>
  




    <script>
        function togglePassword(inputId, iconId) {
            var passwordField = document.getElementById(inputId);
            var icon = document.getElementById(iconId);

            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            } else {
                passwordField.type = "password";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $(".alert").fadeOut("slow");
            }, 5000); // 5000ms = 5 seconds
        });
    </script>

    <script>
        function validate() {
            const form = document.getElementById("form");
            const emailInput = document.getElementById("email");
            const submitButton = document.getElementById("submitButton");
            const email = emailInput.value;
            const pattern = /^[^\s@]+@[^\s@]+\.[a-z]{2,3}$/;

            if (email.match(pattern)) {
                form.classList.add("valid");
                form.classList.remove("invalid");
                submitButton.disabled = false;
            } else {
                form.classList.add("invalid");
                form.classList.remove("valid");
                submitButton.disabled = true;
            }

            if (email === "") {
                form.classList.remove("invalid");
                form.classList.remove("valid");
                submitButton.disabled = true;
            }
        }
    </script>




<script>

        grecaptcha.enterprise.ready(function() {
            grecaptcha.enterprise.execute('6LeBggIrAAAAAGG4rxNONrTxW-5HahxgedGGUBOe', {
                action: 'login'
            }).then(function(token) {
        
                document.getElementById('g-recaptcha-response').value = token;
            });
        });
    </script>

</body>

</html>