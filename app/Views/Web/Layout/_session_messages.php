<div class="container">
    <?php if (session()->has('primary')) : ?>
        <div class="alert alert-primary bg-primary text-light border-0 alert-dismissible fade show" role="alert">
            <?= session('primary'); ?>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->has('secondary')) : ?>
        <div class="alert alert-secondary bg-secondary text-light border-0 alert-dismissible fade show" role="alert">
            <?= session('secondary'); ?>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->has('success')) : ?>
        <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
            <?= session('success'); ?>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->has('danger')) : ?>
        <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
            <?= session('danger'); ?>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->has('error')) : ?>
        <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
            <?= session('error'); ?>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->has('warning')) : ?>
        <div class="alert alert-warning bg-warning border-0 alert-dismissible fade show" role="alert">
            <?= session('warning'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->has('info')) : ?>
        <div class="alert alert-info bg-info border-0 alert-dismissible fade show" role="alert">
            <?= session('info'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->has('light')) : ?>
        <div class="alert alert-light bg-light border-0 alert-dismissible fade show" role="alert">
            <?= session('light'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->has('dark')) : ?>
        <div class="alert alert-dark bg-dark text-light border-0 alert-dismissible fade show" role="alert">
            <?= session('dark'); ?>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
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