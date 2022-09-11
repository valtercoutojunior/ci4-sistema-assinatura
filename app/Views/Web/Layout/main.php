<!DOCTYPE html>
<html lang="en">

<head>
    <!-- SITE TITTLE -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- FAVICON -->
    <link href="<?= site_url('web/img/favicon.png'); ?>" rel="shortcut icon">
    <meta name="<?= csrf_token(); ?>" content="<?= csrf_hash(); ?>" class="csrf">
    <title><?= $this->renderSection('title'); ?> - <?= env('APP_NAME'); ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- PLUGINS CSS STYLE -->
    <link href="<?php //echo  site_url('web/plugins/jquery-ui/jquery-ui.min.css'); 
                ?>" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="<?= site_url('web/plugins/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= site_url('web/plugins/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
    <!-- Owl Carousel -->
    <link href="<?= site_url('web/plugins/slick-carousel/slick/slick.css'); ?>" rel="stylesheet">
    <link href="<?= site_url('web/plugins/slick-carousel/slick/slick-theme.css'); ?>" rel="stylesheet">
    <!-- Fancy Box -->
    <link href="<?= site_url('web/plugins/fancybox/jquery.fancybox.pack.css'); ?>" rel="stylesheet">
    <link href="<?= site_url('web/plugins/jquery-nice-select/css/nice-select.css'); ?>" rel="stylesheet">
    <link href="<?= site_url('web/plugins/seiyria-bootstrap-slider/dist/css/bootstrap-slider.min.css'); ?>" rel="stylesheet">
    <script src="<?= site_url('manager_assets/assets/vendor/toastr/toastr.min.js'); ?>"></script>
    <!-- CUSTOM CSS -->
    <link href="<?= site_url('web/css/style.css'); ?>" rel="stylesheet">
    <link href="<?= site_url('web/css/my_custom.css'); ?>" rel="stylesheet">



    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    <?= $this->renderSection('styles'); ?>


</head>

<body class="body-wrapper">


    <!-- sidebar -->
    <?= $this->include('Web/Layout/navbar'); ?>
    <!-- end sidebar -->

    <!--===============================
=            Hero Area            =
================================-->

    <section class="hero-area bg-1 text-center overly">
        <!-- Container Start -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Header Contetnt -->
                    <div class="content-block">
                        <h1>Buy & Sell Near You </h1>
                        <p>Join the millions who buy and sell from each other <br> everyday in local communities around
                            the world</p>
                        <div class="short-popular-category-list text-center">
                            <h2>Popular Category</h2>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href=""><i class="fa fa-bed"></i> Hotel</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href=""><i class="fa fa-grav"></i> Fitness</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href=""><i class="fa fa-car"></i> Cars</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href=""><i class="fa fa-cutlery"></i> Restaurants</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href=""><i class="fa fa-coffee"></i> Cafe</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <!-- Advance Search -->
                    <div class="advance-search">
                        <form action="#">
                            <div class="row">
                                <!-- Store Search -->
                                <div class="col-lg-6 col-md-12">
                                    <div class="block d-flex">
                                        <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="search" placeholder="Search for store">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="block d-flex">
                                        <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="search" placeholder="Search for store">
                                        <!-- Search Button -->
                                        <button class="btn btn-main">SEARCH</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
        <!-- Container End -->
    </section>

    <!--===================================
=            Client Slider            =
====================================-->

    <?= $this->include('Web/Layout/_session_messages'); ?>
    <?= $this->renderSection('content'); ?>



    <!--============================
=            Footer            =
=============================-->

    <footer class="footer section section-sm">
        <!-- Container Start -->
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-7 offset-md-1 offset-lg-0">
                    <!-- About -->
                    <div class="block about">
                        <!-- footer logo -->
                        <img src="images/logo-footer.png" alt="">
                        <!-- description -->
                        <p class="alt-color">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                            exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                </div>
                <!-- Link list -->
                <div class="col-lg-2 offset-lg-1 col-md-3">
                    <div class="block">
                        <h4>Site Pages</h4>
                        <ul>
                            <li><a href="#">Boston</a></li>
                            <li><a href="#">How It works</a></li>
                            <li><a href="#">Deals & Coupons</a></li>
                            <li><a href="#">Articls & Tips</a></li>
                            <li><a href="#">Terms of Services</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Link list -->
                <div class="col-lg-2 col-md-3 offset-md-1 offset-lg-0">
                    <div class="block">
                        <h4>Admin Pages</h4>
                        <ul>
                            <li><a href="#">Boston</a></li>
                            <li><a href="#">How It works</a></li>
                            <li><a href="#">Deals & Coupons</a></li>
                            <li><a href="#">Articls & Tips</a></li>
                            <li><a href="#">Terms of Services</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Promotion -->
                <div class="col-lg-4 col-md-7">
                    <!-- App promotion -->
                    <div class="block-2 app-promotion">
                        <a href="">
                            <!-- Icon -->
                            <img src="images/footer/phone-icon.png" alt="mobile-icon">
                        </a>
                        <p>Get the Dealsy Mobile App and Save more</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container End -->
    </footer>
    <!-- Footer Bottom -->
    <footer class="footer-bottom">
        <!-- Container Start -->
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-12">
                    <!-- Copyright -->
                    <div class="copyright">
                        <p>Copyright © 2016. All Rights Reserved</p>
                    </div>
                </div>
                <div class="col-sm-6 col-12">
                    <!-- Social Icons -->
                    <ul class="social-media-icons text-right">
                        <li><a class="fa fa-facebook" href=""></a></li>
                        <li><a class="fa fa-twitter" href=""></a></li>
                        <li><a class="fa fa-pinterest-p" href=""></a></li>
                        <li><a class="fa fa-vimeo" href=""></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Container End -->
        <!-- To Top -->
        <div class="top-to">
            <a id="top" class="" href=""><i class="fa fa-angle-up"></i></a>
        </div>
    </footer>

    <!-- JAVASCRIPTS -->

    <script src="<?= site_url('web/plugins/jquery/jquery.min.js'); ?>"></script>
    <!--
    <script src="<?php //echo site_url('web/plugins/jquery-ui/jquery-ui.min.js'); 
                    ?>"></script>
    <script src="<?php //echo site_url('web/plugins/tether/js/tether.min.js'); 
                    ?>"></script>
    <script src="<?php //echo site_url('web/plugins/raty/jquery.raty-fa.js'); 
                    ?>"></script>
    <script src="<?php //echo site_url('web/plugins/jquery-nice-select/js/jquery.nice-select.min.js'); 
                    ?>"></script>
    -->

    <script src="<?= site_url('web/plugins/bootstrap/dist/js/popper.min.js'); ?>"></script>
    <script src="<?= site_url('web/plugins/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= site_url('web/plugins/slick-carousel/slick/slick.min.js'); ?>"></script>
    <script src="<?= site_url('web/plugins/fancybox/jquery.fancybox.pack.js'); ?>"></script>
    <script src="<?= site_url('web/plugins/smoothscroll/SmoothScroll.min.js'); ?>"></script>
    <script src="<?= site_url('web/js/scripts.js'); ?>"></script>
    <script src="<?= site_url('manager_assets/assets/vendor/toastr/toastr.min.js'); ?>"></script>
    <script src="<?= site_url('web/plugins/loadingoverlay/loadingoverlay.min.js'); ?>"></script>
    <?= $this->renderSection('scripts'); ?>

    <script>
        $(document).ready(function() {

            $('.btn-gn').on('click', function() {
                $.LoadingOverlay("show", {
                    background: "rgba(52, 52, 52, 0.7)"
                });
            });

        });
    </script>
</body>

</html>