<?= $this->extend('Manager/Layout/main') ?>

<?= $this->section('title') ?>
<?= lang('Categories.title_index'); ?>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/r-2.3.0/datatables.min.css" />
<?= $this->endSection() ?>

<?= $this->section('breadcrumb') ?>
<div class="pagetitle">
    <div class="container">
        <h1 class="mb-2"><?= lang('Categories.title_index'); ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= route_to('manager'); ?>">Home</a></li>
                <li class="breadcrumb-item active"><?= lang('Categories.title_index'); ?></li>
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
                            <?= lang('Categories.title_index') ?>
                        </h3>
                    </div>
                    <div class="p-2 flex-fill text-sm-end">
                        <button class="btn btn-primary my-1 me-2" id="btnCreateCategory">
                            <i class="bi bi-plus me-1"></i><?= lang('App.btn_new'); ?>
                        </button>
                        <a href="<?= route_to('categories.archived') ?>" class="btn btn-secondary my-1">
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
                                <th scope="col">#</th>
                                <th scope="col"><?= lang('Categories.label_name'); ?></th>
                                <th scope="col"><?= lang('Categories.label_slug'); ?></th>
                                <th scope="col"><?= lang('App.btn_actions'); ?></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalCategory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        <?= lang('Categories.title_new'); ?>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <?= form_open(route_to('categories.create'), ['id' => 'categories-form'], ['id' => '']); ?>

                <div class="modal-body">

                    <div class="mb-3">
                        <label for="name" class="form-label"><?= lang('Categories.label_name'); ?></label>
                        <input type="text" class="form-control" name="name" id="name">
                        <span class="text-danger error-text name"></span>
                    </div>

                    <div class="mb-3">
                        <label for="parent_id" class="form-label"><?= lang('Categories.label_parent_name'); ?></label>
                        <!-- Será preenchido com o javascript -->
                        <span id="boxParents"></span>
                        <span class="text-danger error-text parent_id"></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnCancel">
                        <i class="bi bi-x-lg me-2"></i><?= lang('App.btn_cancel'); ?>
                    </button>
                    <button type="submit" class="btn" id="btnSalve">
                        <i class="bi bi-save2 me-1"></i><?= lang('App.btn_save'); ?>
                    </button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/r-2.3.0/datatables.min.js"></script>
<?= $this->include('Manager/Categories/Scripts/_datatable_all'); ?>
<?= $this->include('Manager/Categories/Scripts/_get_category_info'); ?>
<?= $this->include('Manager/Categories/Scripts/_submit_modal_update'); ?>
<?= $this->include('Manager/Categories/Scripts/_show_modal_create'); ?>
<?= $this->include('Manager/Categories/Scripts/_archive_category'); ?>

<script>
    function refreshCSRFToken(token) {
        $('[name="<?= csrf_token(); ?>"]').val(token);
        $('meta[name="<?= csrf_token(); ?>"]').attr('content', token);
    }
</script>
<?= $this->endSection() ?>