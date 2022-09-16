<?php echo $this->extend('Web/Layout/advert'); ?>

<?php echo $this->section('title') ?>

<?php echo $title ?? ''; ?>

<?= $this->endSection() ?>


<?php echo $this->section('styles') ?>


<?= $this->endSection() ?>


<?php echo $this->section('content') ?>

<section class="section-sm">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="search-result bg-gray">
                    <h2><?php echo $title; ?></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <?php echo $this->include('Web/Home/_sidebar_filters'); ?>
            </div>

            <div class="col-md-9">

                <div class="product-grid-list">
                    <div class="row">
                        <?php if (empty($adverts)) : ?>
                            <div class="col-12">
                                <div class="alert alert-info text-center py-5" role="alert">
                                    <h4>Nenhum anúncio cadastrado para essa categoria ainda</h4>
                                </div>
                            </div>
                        <?php else : ?>
                            <?php foreach ($adverts as $advert) : ?>

                                <!-- offer 01 -->
                                <div class="col-sm-12 col-lg-4 col-md-6">
                                    <!-- product card -->
                                    <div class="product-item bg-light">
                                        <div class="card" style="min-height: 520px; height: 100% !important;">
                                            <div class="thumb-content text-center">
                                                <a href="<?php echo route_to('adverts.detail', $advert->code) ?>">
                                                    <?php echo $advert->image(classImage: 'card-img-top img-fluid', sizeImage: 'small'); ?>
                                                </a>
                                            </div>

                                            <div class="card-body">
                                                <h4 class="card-title">
                                                    <a href="<?php echo route_to('adverts.detail', $advert->code) ?>">
                                                        <?php echo $advert->title; ?>
                                                    </a>
                                                </h4>

                                                <ul class="list-inline product-meta">
                                                    <li class="list-inline-item">
                                                        <a href="<?php echo route_to('adverts.category', $advert->category_slug) ?>">
                                                            <i class="fa fa-folder-open-o"></i>
                                                            <?php echo $advert->category; ?>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="<?php echo route_to('adverts.category.city', $advert->category_slug, $advert->city_slug); ?>">
                                                            <i class="fa fa-location-arrow"></i>
                                                            <?php echo $advert->city; ?>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="jascript:void">
                                                            <i class="fa fa-calendar"></i>
                                                            <?php echo $advert->created_at->humanize(); ?>
                                                        </a>
                                                    </li>
                                                </ul>

                                                <p class="card-text">
                                                    <?php echo $advert->situation(); ?>
                                                </p>

                                                <p class="card-text">
                                                    <?php echo $advert->price(); ?>
                                                </p>

                                                <!-- Não colocamos a descrição aqui -->
                                            </div>
                                            <div class="card-footer bg-transparent border-top-0">
                                                <div class="product-ratings">
                                                    <a class="btn btn-sm btn-outline-primary btn-block" href="<?php echo route_to('adverts.detail', $advert->code) ?>">
                                                        Mais detalhes
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                </div>


                            <?php endforeach; ?>


                            <div class="col-md-12">

                                <!-- Alteramos o arquivo Config/Pager.php para carregar o nosso pagination -->

                                <?php echo $pager->links(); ?>

                            </div>

                        <?php endif; ?>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?= $this->endSection() ?>


<?php echo $this->section('scripts') ?>


<?= $this->endSection() ?>