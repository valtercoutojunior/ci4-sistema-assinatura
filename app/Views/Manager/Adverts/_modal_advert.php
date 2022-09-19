<div class="modal fade" id="modalAdvert" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    <?= lang('Adverts.title_new'); ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?= form_open(route_to('adverts.manager.update'), ['id' => 'adverts-form'], ['id' => '', '_method' => 'PUT']); ?>

            <div class="modal-body">

                <div class="row g-3">

                    <!-- Linha1 -->
                    <div class="col-12">
                        <label for="title" class="form-label">
                            <?= lang('Adverts.label_title'); ?>
                        </label>
                        <input type="text" class="form-control form-control-lg" name="title" id="title" placeholder="<?= lang('Adverts.label_title'); ?>" autofocus>
                        <span class="text-danger error-text title"></span>
                    </div>
                    <!-- end Linha1 -->


                    <!-- Linha2 -->
                    <div class="col-md-4">
                        <label class="form-label" for="situation">
                            <?= lang('Adverts.label_situation'); ?>
                        </label>
                        <!-- Será preenchido pelo javascript -->
                        <span id="boxSituations"></span>
                        <span class="text-danger error-text situation"></span>
                    </div>


                    <div class="col-md-5">
                        <label class="form-label" for="category_id">
                            <?= lang('Adverts.label_category'); ?>
                        </label>
                        <!-- Será preenchido pelo javascript -->
                        <span id="boxCategories"></span>
                        <span class="text-danger error-text category_id"></span>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label" for="price">
                            <?= lang('Adverts.label_price'); ?>
                        </label>
                        <input type="text" class="form-control money" name="price" id="price" placeholder="<?= lang('Adverts.label_price'); ?>">
                        <span class="text-danger error-text price"></span>
                    </div>
                    <!-- end Linha2 -->




                    <!-- Linha3 -->
                    <div class="col-md-2">
                        <label class="form-label" for="zipcode">
                            <?= lang('Adverts.label_zipcode'); ?>
                        </label>
                        <input type="text" class="form-control cep" name="zipcode" id="zipcode" placeholder="<?= lang('Adverts.label_zipcode'); ?>">
                        <span class="text-danger error-text zipcode"></span>
                    </div>

                    <div class="col-md-8">
                        <label class="form-label" for="street">
                            <?= lang('Adverts.label_street'); ?>
                        </label>
                        <input type="text" class="form-control" name="street" id="street" placeholder="<?= lang('Adverts.label_street'); ?>">
                        <span class="text-danger error-text street"></span>
                    </div>


                    <div class="col-md-2">
                        <label class="form-label" for="number">
                            <?= lang('Adverts.label_number'); ?>
                        </label>
                        <input type="text" class="form-control" name="number" id="number" placeholder="<?= lang('Adverts.label_number'); ?>">
                        <span class="text-danger error-text number"></span>
                    </div>
                    <!-- end Linha3 -->

                    <!-- Linha4 -->

                    <div class="col-md-5">

                        <label class="form-label" for="neighboorhood">
                            <?= lang('Adverts.label_neighborhood'); ?>
                        </label>
                        <input type="text" class="form-control" name="neighborhood" id="neighborhood" placeholder="<?= lang('Adverts.label_neighborhood'); ?>">
                        <span class="text-danger error-text neighborhood"></span>
                    </div>

                    <div class="col-md-5">
                        <label class="form-label" for="city">
                            <?= lang('Adverts.label_city'); ?>
                        </label>
                        <input type="text" class="form-control" name="city" id="city" placeholder="<?= lang('Adverts.label_city'); ?>">
                        <span class="text-danger error-text city"></span>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label" for="state">
                            <?= lang('Adverts.label_state'); ?>
                        </label>
                        <input type="text" class="form-control uf" name="state" id="state" placeholder="<?= lang('Adverts.label_state'); ?>">
                        <span class="text-danger error-text state"></span>
                    </div>
                    <!-- end Linha4 -->

                    <!-- Linha5 -->
                    <div class="col-md-12">
                        <label class="form-label" for="description">
                            <?= lang('Adverts.label_description'); ?>
                        </label>
                        <textarea class="form-control" name="description" id="description" cols="10" rows="5" style="min-height: 100px; resize: none;" placeholder="<?= lang('Adverts.label_description'); ?>"></textarea>
                        <span class="text-danger error-text description"></span>
                    </div>
                    <!-- end Linha5 -->
                </div>

                <div class="form-check form-switch mt-3">
                    <?= form_hidden('is_published', 0); ?>
                    <input class="form-check-input" type="checkbox" name="is_published" role="switch" id="is_published">
                    <label class="form-check-label" for="is_published">
                        <?= lang('Adverts.label_published'); ?>
                    </label>
                </div>


            </div><!-- fim modal-body-->
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