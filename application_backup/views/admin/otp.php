<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> Login </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">

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
            width: 92%;
            border-radius: 20px;
            border-radius: 12px;
            background: linear-gradient(145deg, #FFDA85 0.37%, #FFCDAE 99.63%);
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

        /* Left Side: Login Form */
        /* .login-content {
      width: 100%;
      max-width: 400px;
      padding: 30px;
      border: 1px solid #ddd;
      border-radius: 10px;
      background-color: #fff;
    } */

        /* .login-logo img {
      width: 150px;
    } */

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
            /* display: flex;
      align-items: center;
      justify-content: center; */
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
    </style>
</head>

<body>

    <section class="fxt-template-animation fxt-template-layout34">
        <div class="container">
            <div class="row">
                <div class="col-8 text-center">
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
                                <li data-bs-target="#carouselExampleSlidesOnly" data-bs-slide-to="0" class="active">
                                </li>
                                <li data-bs-target="#carouselExampleSlidesOnly" data-bs-slide-to="1"></li>
                                <li data-bs-target="#carouselExampleSlidesOnly" data-bs-slide-to="2"></li>
                                <li data-bs-target="#carouselExampleSlidesOnly" data-bs-slide-to="3"></li>

                            </ol>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4 mt-5">
                    <div class="fxt-column-wrap justify-content-center">
                        <div class="fxt-form">
                            <a href="#" class="fxt-otp-logo"><img src="assets/img/elements/otp-icon.png"
                                    alt="Otp Logo"></a>

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
                            <form action="<?php echo base_url('admin/verifyotp'); ?>" method="post" id="otp-form">

                                <label for="reset" class="fxt-label">Enter OTP Code Here</label>
                                <div class="fxt-otp-row">
                                    <input type="text" class="fxt-otp-col otp-input form-control" name="otp_digit1"
                                        maxlength="1" required="required" inputmode="numeric" pattern="[0-9]*"
                                        required="required">
                                    <input type="text" class="fxt-otp-col otp-input form-control" name="otp_digit2"
                                        maxlength="1" required="required" inputmode="numeric" pattern="[0-9]*"
                                        required="required">
                                    <input type="text" class="fxt-otp-col otp-input form-control" name="otp_digit3"
                                        maxlength="1" required="required" inputmode="numeric" pattern="[0-9]*"
                                        required="required">
                                    <input type="text" class="fxt-otp-col otp-input form-control" name="otp_digit4"
                                        maxlength="1" required="required" inputmode="numeric" pattern="[0-9]*"
                                        required="required">
                                </div>
                                <input type="hidden" name="otp" id="combined-otp">
                                <div class="fxt-otp-btn">
                                    <button type="submit" class="fxt-btn-fill">Verify</button>
                                </div>
                            </form>

                            <div class="fxt-switcher-description3">Not received your code?

                                <a href="?" id="countdown_hide" class="fxt-switcher-text ms-1">Resend code</a>

                            </div>
                            <div class="text-center">
                                <p id="countdown"></p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="assets/js/validator.min.js"></script>
    <script src="assets/js/main.js"></script>

    <script>
        function startCountdown(expirationTime) {

            const countdownElement = document.getElementById('countdown');
            const countdown_hide = document.getElementById('countdown_hide');

            countdown_hide.style.display = "none";
            const endTime = new Date(expirationTime).getTime();

            const updateCountdown = () => {
                const now = new Date().getTime();
                const distance = endTime - now;

                if (distance <= 0) {
                    countdownElement.innerHTML = "OTP expired";
                    const countdown_hide = document.getElementById('countdown_hide');
                    countdown_hide.style.display = "block";
                    clearInterval(timerInterval);
                } else {

                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    countdownElement.innerHTML = `${minutes}m ${seconds}s`;

                }
            };

            const timerInterval = setInterval(updateCountdown, 1000);
            updateCountdown();
        }

        document.addEventListener('DOMContentLoaded', function() {
            const expirationTime = "<?php echo $expiration_time; ?>";
            startCountdown(expirationTime);
        });
    </script>

    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $(".alert").fadeOut("slow");
            }, 5000);
        });
    </script>


    <style>
        #countdown {
            font-size: 18px;
            color: red;
            margin-top: 20px;
        }
    </style>



</body>


</html>