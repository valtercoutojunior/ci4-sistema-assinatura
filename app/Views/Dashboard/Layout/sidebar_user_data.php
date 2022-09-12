<div class="col-md-10 offset-md-1 col-lg-4 offset-lg-0">
    <div class="sidebar">
        <!-- User Widget -->
        <div class="widget user-dashboard-profile">
            <!-- User Image -->
            <div class="profile-thumb">
                <img src="images/user/user-thumb.jpg" alt="" class="rounded-circle">
            </div>
            <!-- User Name -->
            <h5 class="text-center">Samanta Doe</h5>
            <p>Joined February 06, 2017</p>
            <a href="<?= route_to('profile'); ?>" class="btn btn-main-sm">Edit Profile</a>
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
                        <i class="fa fa-bookmark-o mr-2"></i>
                        <?= lang('App.sidebar.dashboard.my_plan'); ?>
                    </a>
                </li>

                <li class="<?= url_is("{$locale}/dashboard/adverts/my") ? 'active' : ''; ?>">
                    <a href="<?= route_to('adverts.my'); ?>">
                        <i class="fa fa-external-link mr-2"></i>
                        <?= lang('App.sidebar.dashboard.my_adverts'); ?>
                    </a>
                </li>

                <li>
                    <a href="">
                        <i class="fa fa-bookmark-o mr-2">
                        </i>Favourite Ads <span>5</span>
                    </a>
                </li>

                <li>
                    <a href=""><i class="fa fa-file-archive-o mr-2">
                        </i>Archived Ads <span>12</span>
                    </a>
                </li>
                <li>
                    <a href=""><i class="fa fa-bolt mr-2">
                        </i>Pending Approval<span>23</span>
                    </a>
                </li>

                <?= form_open('logout'); ?>
                <button type="submit" class="btn btn-default bg-white py-2 pl-2 text-dark">
                    <i class="fa fa-cog mr-2"></i><?= lang('App.btn_logout'); ?>
                </button>

                <?= form_close(); ?>
                <li><a href=""><i class="fa fa-power-off"></i>Delete Account</a></li>
            </ul>
        </div>
    </div>
</div>