<?= $this->extend('Web/Layout/main') ?>

<?= $this->section('title') ?>
<?= $title ?? ''; ?>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="popular-deals section bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h2>
                        <?= $title ?? 'Anúncios recentes'; ?>
                    </h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas, magnam. asdkjshdfjkshdf</p>
                </div>
            </div>
        </div>


        <?php if (empty($adverts)) : ?>
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="alert alert-info bg-info text-center text-light" role="alert">
                        <h4 class="alert-heading">Opss!!!</h4>
                        <p class="text-light lead">Não há anuncios cadastrado no momento para serem exibidos</p>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <div class="row">
                <?php foreach ($adverts as $advert) : ?>
                    <div class="col-6 col-md-4 col-lg-3 mb-3">
                        <div class="card h-100">
                            <div class="thumb-content mx-auto d-block">
                                <a href="<?= route_to('adverts.detail', $advert->code); ?>">
                                    <?= $advert->image(classImage: 'card-img-top', sizeImage: 'small'); ?>
                                </a>
                            </div>
                            <div class="card-body">
                                <a href="<?= route_to('adverts.detail', $advert->code); ?>">
                                    <h5 class="card-title">
                                        <?= word_limiter($advert->title, '15'); ?>
                                    </h5>
                                </a>

                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                <a href="<?= route_to('adverts.detail', $advert->code); ?>" class="btn btn-outline-primary btn-sm btn-block py-1">
                                    <?= $advert->price; ?>
                                </a>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>

                <div class="col-12 mt-4">
                    <?= $pager->links(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<?= $this->endSection() ?>