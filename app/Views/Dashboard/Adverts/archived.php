<?= $this->extend('Dashboard/Layout/main') ?>

<?= $this->section('title') ?>
<?= lang('Adverts.title_index'); ?>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.12.1/r-2.3.0/datatables.min.css" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="dashboard section">
    <!-- Container Start -->
    <div class="container">
        <!-- Row Start -->
        <div class="row">
            <!-- sidebar user data -->
            <?= $this->include('Dashboard/Layout/sidebar_user_data'); ?>
            <!-- end sidebar user data -->

            <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
                <!-- Recently Favorited -->
                <div class="widget dashboard-container my-adslist">
                    <h3 class="widget-header"><?= lang('Adverts.title_index'); ?></h3>
                    <div class="row">
                        <div class="col-12 mb-4">
                            <a href="<?= route_to('adverts.my'); ?>" class="btn btn-main-sm add-button float-right">
                                <?= lang('App.btn_back'); ?>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-striped table-hover" id="myDataTable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="all"><?= lang('Adverts.label_title'); ?></th>
                                        <th scope="col" class="none"><?= lang('Adverts.label_code'); ?></th>
                                        <th scope="col" class="all text-center"><?= lang('App.btn_actions'); ?></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/r-2.3.0/datatables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?= $this->include('Dashboard/Adverts/Scripts/_datatable_all_archived'); ?>
<?= $this->include('Dashboard/Adverts/Scripts/_recover_advert'); ?>
<?= $this->include('Dashboard/Adverts/Scripts/_delete_advert'); ?>
<script>
    function refreshCSRFToken(token) {
        $('[name="<?= csrf_token(); ?>"]').val(token);
        $('meta[name="<?= csrf_token(); ?>"]').attr('content', token);
    }
</script>
<?= $this->endSection() ?>