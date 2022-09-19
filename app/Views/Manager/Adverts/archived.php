<?= $this->extend('Manager/Layout/main') ?>

<?= $this->section('title') ?>
<?= lang('Adverts.title_index'); ?>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.12.1/r-2.3.0/datatables.min.css" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="container">
        <div class="card">

            <div class="card-header">
                <div class="d-flex flex-column flex-sm-row px-2 py-0 ">
                    <div class="p-2 flex-column flex-md-fill">
                        <h3 class="card-title py-0 my-1">
                            <?= lang('Adverts.title_index') ?>
                        </h3>
                    </div>
                    <div class="p-2 flex-fill text-sm-end">
                        <a href="<?= route_to('adverts.manager') ?>" class="btn btn-outline-secondary my-1">
                            <i class="bi bi-arrow-counterclockwise me-1"></i><?= lang('App.btn_back'); ?>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive mt-3">
                    <table class="table table-striped table-hover" id="myDataTable" style="width: 100%;">
                        <thead>
                            <tr>
                                <th scope="col" class="all"><?= lang('Adverts.label_title'); ?></th>
                                <th scope="col" class="all"><?= lang('Adverts.label_code'); ?></th>
                                <th scope="col" class="all text-center"><?= lang('App.btn_actions'); ?></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Container End -->
    <?= $this->include('manager/Adverts/_modal_advert'); ?>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/r-2.3.0/datatables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?= $this->include('Manager/Adverts/Scripts/_datatable_all_archived'); ?>
<?= $this->include('Manager/Adverts/Scripts/_recover_advert'); ?>
<?= $this->include('Manager/Adverts/Scripts/_delete_advert'); ?>
<script>
    function refreshCSRFToken(token) {
        $('[name="<?= csrf_token(); ?>"]').val(token);
        $('meta[name="<?= csrf_token(); ?>"]').attr('content', token);
    }
</script>
<?= $this->endSection() ?>