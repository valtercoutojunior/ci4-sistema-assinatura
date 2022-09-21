<div class="col-md-10 offset-md-1 col-lg-4 offset-lg-0">
    <div class="sidebar">
        <!-- User Widget -->
        <div class="widget user-dashboard-profile">
            <!-- User Name -->
            <h5 class="text-center"><?= auth()->user()->name ?? auth()->user()->username; ?></h5>
            <p><?= lang('App.sidebar.dashboard.user_since'); ?><?= auth()->user()->created_at->humanize(); ?></p>
            <a href="<?= route_to('profile'); ?>" class="btn btn-main-sm">
                <?= lang('App.sidebar.dashboard.profile'); ?>
            </a>
        </div>
        <!-- Dashboard Links -->
        <div class="widget user-dashboard-menu">
            <ul>
                <li class="<?= url_is("{$locale}/dashboard") ? 'active' : ''; ?>">
                    <a href="<?= route_to('dashboard'); ?>">
                        <i class="fa fa-home mr-2"></i>
                        <?= lang('App.sidebar.dashboard.dashboard'); ?>
                    </a>
                </li>

                <li class="<?= url_is("{$locale}/dashboard/my-plan") ? 'active' : ''; ?>">
                    <a href="<?= route_to('my.plan'); ?>" class="btn-gn">
                        <i class="fa fa-usd mr-2"></i>
                        <?= lang('App.sidebar.dashboard.my_plan'); ?>
                    </a>
                </li>

                <li class="<?= url_is("{$locale}/dashboard/adverts/my") ? 'active' : ''; ?>">
                    <a href="<?= route_to('adverts.my'); ?>" class="btn-gn">
                        <i class="fa fa-bullhorn mr-2"></i>
                        <?= lang('App.sidebar.dashboard.my_adverts'); ?>
                    </a>
                </li>

                <li class="<?= url_is("{$locale}/dashboard/adverts/my-archived") ? 'active' : ''; ?>">
                    <a href="<?= route_to('my.archived.adverts'); ?>" class="btn-gn">
                        <i class="fa fa-archive mr-2"></i>
                        <?= lang('App.btn_all_archive'); ?>
                    </a>
                </li>



                <?= form_open('logout'); ?>
                <button type="submit" class="btn btn-default bg-white py-2 pl-2 text-dark">
                    <i class="fa fa-cog mr-2"></i><?= lang('App.btn_logout'); ?>
                </button>

                <?= form_close(); ?>


                <li class="<?= url_is("{$locale}/dashboard/confirm-deletion-account") ? 'active' : ''; ?>">
                    <a href="<?= route_to('confirm.deletion.account'); ?>" class="text-danger">
                        <i class="fa fa-power-off mr-2"></i>
                        <?= lang('App.sidebar.dashboard.delete_account'); ?>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>