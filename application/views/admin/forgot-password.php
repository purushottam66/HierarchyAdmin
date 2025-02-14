<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Forgot Password</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('admin/assets/img/favicon.png'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('admin/assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('admin/assets/css/fontawesome/all.min.css'); ?>">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('admin/assets/css/style.css'); ?>">

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
                <img src="<?= base_url("assets/welcome.png") ?>" width="500" alt="...">
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


                    <form action="<?php echo base_url('admin/forgotpassword'); ?>" method="post">
                        <div class="login-logo align-items-center text-center pb-4">
                            <img class="logo_imgsw" style="width: 50%;" src="assets/image.png" alt="Login Logo">
                        </div>

                        <div class="fxt-middle-content">
                            <div class="text-center">
                                <h5 class="h5 mt-3">Reset Password</h5>
                            </div>
                            <div class="fxt-switcher-description1">Enter the email address
                                associated</div>
                        </div>

                        <div class="mt-3">
                            <label for="email">Enter Your Email </label>
                            <div class="pt-1 input-group">
                                <input type="text" id="email" class="form-control" name="email_or_mobile"
                                    placeholder="Enter Email " required="required">
                                <span class="input-group-text">
                                    <span class="fa fa-envelope"></span>
                                </span>
                            </div>
                        </div>



                        <div class="form-group mt-3">
                            <div class="fxt-switcher-description2 text-right">
                                <div class="fxt-switcher-description3 fxt-switcher-text ms-1">Return to?<a href="login" class="fw-bold"> Log in</a></div>
                            </div>
                        </div>

                        <div class="login-btn d-flex justify-content-center pb-3 mt-3">
                            <button type="submit" id="submitButton" class="button">SUBMIT</button>
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

</body>

</html>