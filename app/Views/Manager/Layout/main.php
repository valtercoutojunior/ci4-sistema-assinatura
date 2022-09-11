<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= $this->renderSection('title'); ?> - <?= env('APP_NAME'); ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <meta name="<?= csrf_token(); ?>" content="<?= csrf_hash(); ?>" class="csrf">

    <!-- Favicons -->
    <link href="<?= site_url('manager_assets/assets/img/favicon.png'); ?>" rel="icon">
    <link href="<?= site_url('manager_assets/assets/img/apple-touch-icon.png'); ?>" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= site_url('manager_assets/assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?= site_url('manager_assets/assets/vendor/bootstrap-icons/bootstrap-icons.css'); ?>" rel="stylesheet">
    <link href="<?= site_url('manager_assets/assets/vendor/boxicons/css/boxicons.min.css'); ?>" rel="stylesheet">
    <link href="<?= site_url('manager_assets/assets/vendor/quill/quill.snow.css'); ?>" rel="stylesheet">
    <link href="<?= site_url('manager_assets/assets/vendor/quill/quill.bubble.css'); ?>" rel="stylesheet">
    <link href="<?= site_url('manager_assets/assets/vendor/remixicon/remixicon.css'); ?>" rel="stylesheet">
    <link href="<?= site_url('manager_assets/assets/vendor/toastr/toastr.min.css'); ?>" rel="stylesheet" />
    <!-- Template Main CSS File -->
    <link href="<?= site_url('manager_assets/assets/css/style.css'); ?>" rel="stylesheet">

    <?= $this->renderSection('styles'); ?>

    <!-- =======================================================
  * Template Name: NiceAdmin - v2.3.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="d-flex flex-column wrapper">

    <!-- ======= Header ======= -->
    <?= $this->include('Manager/Layout/header'); ?>
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <?= $this->include('Manager/Layout/sidebar'); ?>
    <!-- End Sidebar-->

    <main id="main" class="main flex-fill">
        <?= $this->renderSection('breadcrumb'); ?>
        <?= $this->include('Manager/Layout/_session_messages'); ?>
        <?= $this->renderSection('content'); ?>
    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <?= $this->include('Manager/Layout/footer'); ?>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <!-- Vendor JS Files -->
    <script src="<?= site_url('manager_assets/assets/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="<?= site_url('manager_assets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?= site_url('manager_assets/assets/vendor/quill/quill.min.js'); ?>"></script>
    <script src="<?= site_url('manager_assets/assets/vendor/toastr/toastr.min.js'); ?>"></script>
    <!-- Template Main JS File -->
    <script src="<?= site_url('manager_assets/assets/js/main.js'); ?>"></script>
    <?= $this->renderSection('scripts'); ?>
</body>

</html>