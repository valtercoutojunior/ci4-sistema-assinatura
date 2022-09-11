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
                    <h2><?= $title ?? 'Conheça todos os nossos planos'; ?></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php if (empty($plans)) : ?>
                <div class="col-sm-12 col-lg-12">
                    <div class="alert alert-info text-center" role="alert">
                        <h4 class="alert-heading">Ops!!!</h4>
                        <p>No momento nenhum plano para ser apresentado</p>
                    </div>
                </div>
            <?php else : ?>
                <?php foreach ($plans as $plan) : ?>
                    <!-- offer 01 -->
                    <div class="col-sm-12 col-md-6 col-lg-3 mb-5">
                        <!-- product card -->
                        <div class="product-item bg-light card-advert-home">
                            <div class="card ">

                                <div class="card-header bg-transparent">
                                    <h3 class="text-center">
                                        <a href="<?= route_to('choice', $plan->id); ?>">
                                            <?= $plan->name; ?>
                                        </a>
                                    </h3>
                                </div>

                                <div class="card-body">
                                    <ul class="list-inline product-meta">
                                        <div class="row">
                                            <div class="d-flex col-12 justify-content-center align-items-center">
                                                <li class="list-inline-item">
                                                    <?php if ($plan->is_highlighted) : ?>
                                                        <h6 class="text-primary py-0 mt-0">Uma das melhores opções</h6>
                                                    <?php else : ?>
                                                        <h6 class="text-primary py-0">Uma boa opção</h6>
                                                    <?php endif; ?>
                                                </li>
                                            </div>
                                        </div>
                                        <hr class="mt-0 mb-2 py-0">
                                        <li class="list-inline-item">
                                            <i class="fa fa-money fa-lg text-success"></i> <?= $plan->details(); ?>
                                        </li>
                                    </ul>
                                    <p class="card-text"><?= word_limiter($plan->description, 20); ?></p>
                                    <div class="product-ratings">
                                        <ul class="list-inline">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <li class="list-inline-item selected">
                                                    <p class="text-success">Anúncios <?= $plan->adverts(); ?> por mes</p>
                                                </li>
                                            </div>
                                        </ul>
                                    </div>

                                </div>
                                <div class="card-footer bg-transparent">
                                    <a href="<?= route_to('choice', $plan->id); ?>" class="btn btn-transparent btn-block">
                                        <?= lang('Plans.btn_choice'); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<?= $this->endSection() ?>