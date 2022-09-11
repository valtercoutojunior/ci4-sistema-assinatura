<div class="modal fade" id="modalPlan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    <?= lang('Plans.title_new'); ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?= form_open(route_to('Plans.create'), ['id' => 'plans-form'], ['id' => '']); ?>

            <div class="modal-body">


                <div class="row">
                    <div class="mb-3">
                        <label for="name" class="form-label"><?= lang('Plans.label_name'); ?></label>
                        <input type="text" class="form-control" name="name" id="name">
                        <span class="text-danger error-text name"></span>
                    </div>

                    <div class="mb-3">
                        <label for="recorrence" class="form-label"><?= lang('Plans.label_recorrence'); ?></label>
                        <!-- Será preenchido com o javascript -->
                        <span id="boxRecorrences"></span>
                        <span class="text-danger error-text recorrence"></span>
                    </div>

                    <div class="mb-3">
                        <label for="value" class="form-label"><?= lang('Plans.label_value'); ?></label>
                        <input type="text" class="form-control money" name="value" id="value">
                        <span class="text-danger error-text value"></span>
                    </div>

                    <div class="mb-3">
                        <label for="adverts" class="form-label"><?= lang('Plans.label_adverts'); ?></label>
                        <input type="number" class="form-control" name="adverts" id="adverts">
                        <span class="text-info label_info_small_12"><?= lang('Plans.text_info_adverts'); ?></span>
                        <span class="text-danger error-text adverts"></span>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label"><?= lang('Plans.label_description'); ?></label>
                        <textarea name="description" class="form-control" id="description" rows="5" placeholder="<?= lang('Plans.label_description'); ?>"></textarea>
                        <span class="text-danger error-text description"></span>
                    </div>
                </div>

                <div class="form-check form-switch">
                    <?= form_hidden('is_highlighted', 0) ?>
                    <input type="checkbox" class="form-check-input" name="is_highlighted" id="is_highlighted">
                    <label for="is_highlighted" class="form-check-label"><?= lang('Plans.label_is_highlighted'); ?></label>

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