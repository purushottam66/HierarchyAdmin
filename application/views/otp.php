<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> Login </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/fontawesome/all.min.css'); ?>">

    <!-- Flaticon CSS -->

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>

<body>

    <section class="fxt-template-animation fxt-template-layout34"
        data-bg-image="<?php echo base_url('assets/img/elements/bg1.png'); ?>">
        <div class="fxt-shape">
            <div class="fxt-transformX-L-50 fxt-transition-delay-1">
                <img src="<?php echo base_url('assets/img/elements/Rectangle.png'); ?>" alt="Shape">
            </div>

        </div>

        <div class="fxt-shape">
            <div class="fxt-transformX-L-50 fxt-transition-delay-2">
                <img src="<?php echo base_url('assets/img/elements/Rectangl.png'); ?>" alt="Shape">
            </div>


        </div>


        <div class="container-fluid">
            <div class="row">


                <div class="d-flex" style="z-index: 9999;">
                    <div class="p-2 flex-grow-1"> <a href="login" class="fxt-logo"><img src="assets/img/logo.png"
                                alt="Logo" style="height: 80px; object-fit: contain;"></a></div>
                    <div class="p-2 fxt-main-title" style="font-size: 20px;">About Us</div>
                    <div class="p-2 fxt-main-title" style="font-size: 20px;">Contact Us</div>
                </div>
                <div class="col-lg-8 " style="z-index: 9999;">
                    <div class="fxt-column-wrap justify-content-between mt-5">
                        <div class="fxt-animated-img">
                            <div class="fxt-transformX-L-50 fxt-transition-delay-10">
                                <!-- <img src="1.jpeg" alt="Animated Image"> -->
                                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-indicators">
                                        <button type="button" data-bs-target="#carouselExampleIndicators"
                                            data-bs-slide-to="0" class="active" aria-current="true"
                                            aria-label="Slide 1"></button>
                                        <button type="button" data-bs-target="#carouselExampleIndicators"
                                            data-bs-slide-to="1" aria-label="Slide 2"></button>
                                        <button type="button" data-bs-target="#carouselExampleIndicators"
                                            data-bs-slide-to="2" aria-label="Slide 3"></button>
                                    </div>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="<?php echo base_url('assets/1.jpeg'); ?>" class="d-block w-100"
                                                alt="./1.jpeg">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="<?php echo base_url('assets/2.jpeg'); ?>" class="d-block w-100"
                                                alt="./1.jpeg">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="<?php echo base_url('assets/3.jpeg'); ?>" class="d-block w-100"
                                                alt="./1.jpeg">
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="col-lg-4">
                    <h1 class="fxt-main-title">Validate OTP</h1>

                    <div class="fxt-column-wrap justify-content-center">
                        <div class="fxt-form">
                            <!-- <a href="#" class="fxt-otp-logo"><img
                                    src="<?php echo base_url('assets/img/elements/otp-icon.png'); ?>"
                                    alt="Otp Logo"></a> -->
                            <div class="">Please enter the OTP (one time password)
                                to
                                verify your account. </div>
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
                            <form action="<?php echo base_url('verifyotp'); ?>" method="post" id="otp-form">

                                <label for="reset" class="fxt-label">Enter OTP Code Here</label>
                                <div class="fxt-otp-row">
                                    <input type="text" class="fxt-otp-col otp-input form-control" name="otp_digit1"
                                        maxlength="1" required="required" inputmode="numeric" pattern="[0-9]*">
                                    <input type="text" class="fxt-otp-col otp-input form-control" name="otp_digit2"
                                        maxlength="1" required="required" inputmode="numeric" pattern="[0-9]*">
                                    <input type="text" class="fxt-otp-col otp-input form-control" name="otp_digit3"
                                        maxlength="1" required="required" inputmode="numeric" pattern="[0-9]*">
                                    <input type="text" class="fxt-otp-col otp-input form-control" name="otp_digit4"
                                        maxlength="1" required="required" inputmode="numeric" pattern="[0-9]*">
                                </div>
                                <!-- Hidden field for combined OTP -->
                                <input type="hidden" name="otp" id="combined-otp">
                                <div class="fxt-otp-btn">
                                    <button type="submit" class="fxt-btn-fill">Verify</button>
                                </div>
                            </form>

                            <div class="fxt-switcher-description3">Not received your code?<a href="?"
                                    class="fxt-switcher-text ms-1">Resend code</a></div>
                            <p id="countdown"></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- jquery-->
    <script src="<?php echo base_url('assets/js/jquery-3.5.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/imagesloaded.pkgd.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/validator.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/main.js'); ?>"></script>

    <script>
        function startCountdown(expirationTime) {
            const countdownElement = document.getElementById('countdown');
            const endTime = new Date(expirationTime).getTime();

            const updateCountdown = () => {
                const now = new Date().getTime();
                const distance = endTime - now;

                if (distance <= 0) {
                    countdownElement.innerHTML = "OTP expired";
                    clearInterval(timerInterval);
                } else {
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    countdownElement.innerHTML = `${minutes}m ${seconds}s`;
                }
            };

            // Update countdown every second
            const timerInterval = setInterval(updateCountdown, 1000);
            updateCountdown(); // Initial call
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Pass expiration time from PHP to JavaScript
            const expirationTime = "<?php echo $expiration_time; ?>";
            console.log("Expiration Time from PHP:", expirationTime); // Check the value
            startCountdown(expirationTime);
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