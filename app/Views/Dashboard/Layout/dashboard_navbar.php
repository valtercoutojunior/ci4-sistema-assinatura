<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg  navigation">
                    <a class="navbar-brand" href="<?= route_to('home'); ?>">
                        <img src="<?= site_url('web/images/logo.png'); ?>" alt="Logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                        <ul class="navbar-nav ml-auto main-nav ">
                            <li class="nav-item active">
                                <a class="nav-link" href="<?= route_to('home'); ?>">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= route_to('pricing'); ?>">Nossos Planos</a>
                            </li>

                            <?php if (auth()->check()) : ?>
                                <?php if (!auth()->user()->isSuperadmin()) : ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= route_to('dashboard'); ?>">Dashboard</a>
                                    </li>
                                <?php else : ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?= route_to('manager'); ?>">Manager</a>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>

                            <!-- Selecione o idioma -->
                            <li class="nav-item dropdown dropdown-slide">
                                <a class="nav-link dropdown-toggle" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?= $language; ?>
                                    <span><i class="fa fa-angle-down"></i></span>
                                </a>
                                <!-- Dropdown list -->
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="<?= $urls->url_en; ?>">English</a>
                                    <a class="dropdown-item" href="<?= $urls->url_es; ?>">Españhol</a>
                                    <a class="dropdown-item" href="<?= $urls->url_pt_br; ?>">Português Brasil</a>
                                </div>
                            </li>
                            <!-- end Selecione o idioma -->

                        </ul>

                        <ul class="navbar-nav ml-auto mt-10">

                            <?php if (!auth()->check()) : ?>
                                <li class="nav-item">
                                    <a class="nav-link login-button" href="<?= route_to('login'); ?>">
                                        Login
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link login-button" href="<?= route_to('register'); ?>">
                                        Criar Conta
                                    </a>
                                </li>
                            <?php endif; ?>

                            <li class="nav-item">
                                <a class="nav-link add-button" href="<?= route_to('dashboard'); ?>">
                                    <i class="fa fa-plus-circle mr-2"></i>Criar Anúncio
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</section>