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


                    <h2 class=" text-center "><strong>Sign In</strong></h2>
                    <div class="fxt-column-wrap justify-content-center"
                        style="padding: 0 10px; width: 100%; height: 100%; background: radial-gradient(38.61% 50.88% at 31.45% 51.80%, rgba(255, 255, 255, 0.80) 0%, rgba(255, 255, 255, 0.40) 100%); border-radius: 40px; border: 3.50px #FBB831 solid; backdrop-filter: blur(42px)">


                        <br>
                        <div class="fxt-form">
                            <br>
                            <form action="<?php echo base_url('enterpass'); ?>" method="get">
                                <div class="form-group">
                                    <input type="email" id="email" class="form-control" name="email"
                                        placeholder="Enter Email " required="required">
                                </div>
                                <div class="form-group">
                                    <input id="password" type="password" class="form-control" name="password"
                                        placeholder="********" required="required">

                                </div>
                                <div class="form-group">
                                    <div class="fxt-switcher-description2 text-right">
                                        <a href="<?php echo base_url('forgot_password'); ?>"
                                            class="fxt-switcher-text">Forgot
                                            Password</a>
                                    </div>
                                </div>
                                <div class="form-group">

                                    <button type="submit" class="fxt-btn-fill"
                                        style="color: white;    word-wrap: break-word;width: 100%; height: 100%; padding-left: 40px; padding-right: 40px; padding-top: 16px; padding-bottom: 16px; background: #F78842; border-radius: 12px; justify-content: center; align-items: center; gap: 10px; display: inline-flex">Login</button>
                                </div>
                                <br>

                            </form>
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


</body>


</html>