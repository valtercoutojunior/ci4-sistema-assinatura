<?= $this->extend('Manager/Layout/main') ?>

<?= $this->section('title') ?>
<?= lang('Plans.title_index_archive'); ?>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/r-2.3.0/datatables.min.css" />
<?= $this->endSection() ?>

<?= $this->section('breadcrumb') ?>
<div class="pagetitle">
    <div class="container">
        <h1 class="mb-2"><?= lang('Plans.title_index_archive'); ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= route_to('manager'); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= route_to('plans'); ?>"><?= lang('Plans.breadcrumb_index') ?></a></li>
                <li class="breadcrumb-item active"><?= lang('Plans.breadcrumb_index_archive'); ?></li>
            </ol>
        </nav>
    </div>
</div><!-- End Page Title -->
<?= $this->endSection() ?>
dd
<?= $this->section('content') ?>
<section class="section">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="d-flex flex-column flex-sm-row px-2 py-0 ">
                    <div class="p-2 flex-column flex-md-fill">
                        <h3 class="card-title py-0 my-1">
                            <?= lang('Plans.title_index_archive'); ?>
                        </h3>
                    </div>
                    <div class="p-2 flex-fill text-sm-end">
                        <a href="<?= route_to('plans') ?>" class="btn btn-secondary my-1">
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
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/r-2.3.0/datatables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?= $this->include('Manager/Plans/Scripts/_datatable_all_archived'); ?>
<?= $this->include('Manager/Plans/Scripts/_recover_plan'); ?>
<?= $this->include('Manager/Plans/Scripts/_delete_plan'); ?>
<script>
    function refreshCSRFToken(token) {
        $('[name="<?= csrf_token(); ?>"]').val(token);
        $('meta[name="<?= csrf_token(); ?>"]').attr('content', token);
    }
</script>
<?= $this->endSection() ?>