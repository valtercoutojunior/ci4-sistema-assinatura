<!-- Modal -->
<div class="modal fade" id="modalAdvert" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    <?= lang('Adverts.title_new'); ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open(route_to('adverts.create.my'), ['id' => 'adverts-form'], ['id' => '']); ?>

            <div class="modal-body">

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="title">
                            <?= lang('Adverts.label_title'); ?>
                        </label>
                        <input type="text" class="form-control form-control-lg" name="title" id="title" autofocus placeholder="<?= lang('Adverts.label_title'); ?>">
                        <span class="text-danger error-text title"></span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="situation">
                            <?= lang('Adverts.label_situation'); ?>
                        </label>
                        <!-- Será preenchido pelo javascript -->
                        <span id="boxSituations"></span>
                        <span class="text-danger error-text situation"></span>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="category_id">
                            <?= lang('Adverts.label_category'); ?>
                        </label>
                        <!-- Será preenchido pelo javascript -->
                        <span id="boxCategories"></span>
                        <span class="text-danger error-text category_id"></span>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="price">
                            <?= lang('Adverts.label_price'); ?>
                        </label>
                        <input type="text" class="form-control money" name="price" id="price" placeholder="<?= lang('Adverts.label_price'); ?>">
                        <span class="text-danger error-text price"></span>
                    </div>
                </div>

                <!-- Endereço -->
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="zipcode">
                            <?= lang('Adverts.label_zipcode'); ?>
                        </label>
                        <input type="text" class="form-control cep" name="zipcode" id="zipcode" placeholder="<?= lang('Adverts.label_zipcode'); ?>">
                        <span class="text-danger error-text zipcode"></span>
                    </div>

                    <div class="form-group col-md-8">
                        <label for="street">
                            <?= lang('Adverts.label_street'); ?>
                        </label>
                        <input type="text" class="form-control" name="street" id="street" placeholder="<?= lang('Adverts.label_street'); ?>">
                        <span class="text-danger error-text street"></span>
                    </div>


                    <div class="form-group col-md-2">
                        <label for="number">
                            <?= lang('Adverts.label_number'); ?>
                        </label>
                        <input type="text" class="form-control" name="number" id="number" placeholder="<?= lang('Adverts.label_number'); ?>">
                        <span class="text-danger error-text number"></span>
                    </div>

                </div>

                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="neighboorhood">
                            <?= lang('Adverts.label_neighborhood'); ?>
                        </label>
                        <input type="text" class="form-control" name="neighborhood" id="neighborhood" placeholder="<?= lang('Adverts.label_neighborhood'); ?>">
                        <span class="text-danger error-text neighborhood"></span>
                    </div>

                    <div class="form-group col-md-5">
                        <label for="city">
                            <?= lang('Adverts.label_city'); ?>
                        </label>
                        <input type="text" class="form-control" name="city" id="city" placeholder="<?= lang('Adverts.label_city'); ?>">
                        <span class="text-danger error-text city"></span>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="state">
                            <?= lang('Adverts.label_state'); ?>
                        </label>
                        <input type="text" class="form-control uf" name="state" id="state" placeholder="<?= lang('Adverts.label_state'); ?>">
                        <span class="text-danger error-text state"></span>
                    </div>

                </div>
                <!-- Fim Endereço -->

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="description">
                            <?= lang('Adverts.label_description'); ?>
                        </label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="10" style="min-height: 100px;" placeholder="<?= lang('Adverts.label_description'); ?>"></textarea>
                        <span class="text-danger error-text description"></span>
                    </div>
                </div>


            </div>
            <!-- Fim modal body -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm btn-main">
                    <?= lang('Adverts.btn_send_for_approval'); ?>
                </button>

                <button type="button" class="btn btn-sm btn-main-add" data-dismiss="modal">
                    <?= lang('App.btn_cancel'); ?>
                </button>
            </div>

            <?= form_close(); ?>



        </div>
    </div>
</div>