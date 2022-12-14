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
  <link href="<?= site_url('manager_assets/assets/vendor/toastr/toastr.min.css'); ?>" rel="stylesheet" />

  <!-- Para o autocomplete -->
  <link rel="stylesheet" href="<?= site_url('web/plugins/auto-complete/jquery-ui.css'); ?>" />

  <!-- CUSTOM CSS -->
  <link href="<?= site_url('web/css/style.css'); ?>" rel="stylesheet">

  <?= $this->renderSection('styles'); ?>
  <style>
    .btn-sm {
      padding: 6px 20px;
      font-size: .875rem;
      line-height: 1.5;
      border-radius: .2rem;
    }

    /* Muda o backgroud do autocomplete */
    .ui-menu-item .ui-menu-item-wrapper.ui-state-active {
      background: #fff !important;
      color: #007bff !important;
      border: none;

    }

    /*** Para a imagem do autocomplete */
    .image-autocomplete {
      max-width: 65px !important;
      padding-left: 10px !important;
      margin-top: 15px !important;
      margin-bottom: 12px !important;
      margin-left: 5px !important;
    }

    li.ui-menu-item:hover {
      background-color: #fafafa !important;
    }


    #myDataTable_filter .form-control {
      height: 30px !important;
    }

    .btn-sm {
      padding: 6px 20px;
      font-size: .875rem;
      line-height: 1.5;
      border-radius: .2rem;
    }

    .img-custom {
      max-width: 50% !important;
    }

    select {
      height: 50px !important;
    }


    @media (min-width: 1200px) {
      .modal-xl {
        max-width: 1140px;
      }
    }
  </style>
</head>

<body class="body-wrapper">
  <!-- navbar -->
  <?= $this->include('Dashboard/Layout/dashboard_navbar'); ?>
  <!-- end navbar -->

  <!-- search -->
  <?= $this->include('Dashboard/Layout/dashboard_search'); ?>
  <!-- end search -->

  <?= $this->include('Dashboard/Layout/_session_messages'); ?>
  <?= $this->renderSection('content'); ?>

  <!-- dashboard_first_footer -->
  <?= $this->include('Dashboard/Layout/dashboard_first_footer'); ?>
  <!-- end dashboard_first_footer -->

  <!-- dashboard_secondary_footer -->
  <?= $this->include('Dashboard/Layout/dashboard_secondary_footer'); ?>
  <!-- end dashboard_secondary_footer -->
  <!-- JAVASCRIPTS -->
  <script src="<?= site_url('web/plugins/jquery/jquery.min.js'); ?>"></script>
  <script src="<?= site_url('web/plugins/bootstrap/dist/js/popper.min.js'); ?>"></script>
  <script src="<?= site_url('web/plugins/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
  <script src="<?= site_url('web/plugins/fancybox/jquery.fancybox.pack.js'); ?>"></script>
  <script src="<?= site_url('web/plugins/smoothscroll/SmoothScroll.min.js'); ?>"></script>
  <script src="<?= site_url('web/js/scripts.js'); ?>"></script>
  <script src="<?= site_url('manager_assets/assets/vendor/toastr/toastr.min.js'); ?>"></script>
  <script src="<?= site_url('web/plugins/loadingoverlay/loadingoverlay.min.js'); ?>"></script>

  <?php echo $this->include('Web/Layout/Scripts/_autocomplete'); ?>
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