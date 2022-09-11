<?= $this->extend('Manager/Layout/main') ?>

<?= $this->section('title') ?>
<?= lang('Plans.title_index'); ?>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/r-2.3.0/datatables.min.css" />
<?= $this->endSection() ?>

<?= $this->section('breadcrumb') ?>
<div class="pagetitle">
    <div class="container">
        <h1 class="mb-2"><?= lang('Plans.title_index'); ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= route_to('manager'); ?>">Home</a></li>
                <li class="breadcrumb-item active"><?= lang('Plans.breadcrumb_index'); ?></li>
            </ol>
        </nav>
    </div>
</div><!-- End Page Title -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="d-flex flex-column flex-sm-row px-2 py-0 ">
                    <div class="p-2 flex-column flex-md-fill">
                        <h3 class="card-title py-0 my-1">
                            <?= lang('Plans.title_index') ?>
                        </h3>
                    </div>
                    <div class="p-2 flex-fill text-sm-end">
                        <button class="btn btn-primary my-1 me-2" id="btnCreatePlan">
                            <i class="bi bi-plus me-1"></i><?= lang('App.btn_new'); ?>
                        </button>
                        <a href="<?= route_to('plans.archived') ?>" class="btn btn-secondary my-1">
                            <i class="bi bi-archive me-1"></i><?= lang('App.btn_all_archive'); ?>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive mt-3">
                    <table class="table table-striped table-hover" id="myDataTable" style="width: 100%;">
                        <thead>
                            <tr>
                                <th scope="col"><?= lang('Plans.label_code'); ?></th>
                                <th scope="col"><?= lang('Plans.label_name'); ?></th>
                                <th scope="col"><?= lang('Plans.label_is_highlighted'); ?></th>
                                <th scope="col"><?= lang('Plans.label_details'); ?></th>
                                <th scope="col"><?= lang('App.btn_actions'); ?></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <?= $this->include('Manager/Plans/Scripts/_modal_plan'); ?>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/r-2.3.0/datatables.min.js"></script>
<script type="text/javascript" src="<?= site_url('manager_assets/assets/vendor/mask/jquery.mask.min.js') ?>"></script>
<script type="text/javascript" src="<?= site_url('manager_assets/assets/vendor/mask/app.js') ?>"></script>
<?= $this->include('Manager/Plans/Scripts/_datatable_all'); ?>
<?= $this->include('Manager/Plans/Scripts/_show_modal_create'); ?>
<?= $this->include('Manager/Plans/Scripts/_submit_modal_update'); ?>
<?= $this->include('Manager/Plans/Scripts/_get_plan_info'); ?>
<?= $this->include('Manager/Plans/Scripts/_archive_plan'); ?>

<script>
    function refreshCSRFToken(token) {
        $('[name="<?= csrf_token(); ?>"]').val(token);
        $('meta[name="<?= csrf_token(); ?>"]').attr('content', token);
    }
</script>
<?= $this->endSection() ?>