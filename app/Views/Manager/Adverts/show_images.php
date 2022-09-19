<?= $this->extend('Manager/Layout/main') ?>

<?= $this->section('title') ?>
<?= lang('Adverts.text_edit_images'); ?>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="dashboard section">
    <!-- Container Start -->
    <div class="container">
        <!-- Row Start -->

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


            <div class="row mt-4">
                <div class="col-12">
                    <?php if (empty($advert->images)) : ?>

                        <div class="alert alert-warning bg-warning text-center" role="alert">
                            <?= lang('Adverts.text_no_images'); ?>
                        </div>

                    <?php else : ?>
                        <div class="list-inline p-3">
                            <?php foreach ($advert->images as $image) : ?>
                                <li class="list-inline-item border p-2 mb-3">
                                    <img src="<?= route_to('web.image', $image->image, 'small'); ?>" class="img-fluid" alt="<?= $advert->title; ?>">
                                </li>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- Row End -->
        </div>



    </div>
    <!-- Container End -->
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<?= $this->endSection() ?>