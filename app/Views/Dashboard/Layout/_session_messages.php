<div class="container mt-3">
    <?php if (session()->has('primary')) : ?>
        <div class="alert alert-primary bg-primary text-white" role="alert">
            <?= session('primary'); ?>
        </div>
    <?php endif; ?>

    <?php if (session()->has('secondary')) : ?>
        <div class="alert alert-secondary bg-secondary" role="alert">
            <?= session('secondary'); ?>
        </div>
    <?php endif; ?>

    <?php if (session()->has('success')) : ?>
        <div class="alert alert-success bg-success text-white" role="alert">
            <?= session('success'); ?>
        </div>
    <?php endif; ?>

    <?php if (session()->has('danger')) : ?>
        <div class="alert alert-danger bg-danger text-white" role="alert">
            <?= session('danger'); ?>
        </div>
    <?php endif; ?>

    <?php if (session()->has('warning')) : ?>
        <div class="alert alert-warning bg-warning text-dark" role="alert">
            <?= session('warning'); ?>
        </div>
    <?php endif; ?>

    <?php if (session()->has('info')) : ?>
        <div class="alert alert-info bg-info text-light" role="alert">
            <?= session('info'); ?>
        </div>
    <?php endif; ?>

    <?php if (session()->has('light')) : ?>
        <div class="alert alert-light" role="alert">
            <?= session('light'); ?>
        </div>
    <?php endif; ?>
    <?php if (session()->has('dark')) : ?>
        <div class="alert alert-dark" role="alert">
            <?= session('dark'); ?>
        </div>
    <?php endif; ?>

    <?php if (session()->has('errors_model')) : ?>
        <ul>
            <?php foreach (session('errors_model') as $error) : ?>
                <li class="text-danger"><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>