<?= $this->extend('Dashboard/Layout/main') ?>

<?= $this->section('title') ?>
<?= lang('Adverts.title_index'); ?>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.12.1/r-2.3.0/datatables.min.css" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="dashboard section">
	<!-- Container Start -->
	<div class="container">
		<!-- Row Start -->
		<div class="row">
			<!-- sidebar user data -->
			<?= $this->include('Dashboard/Layout/sidebar_user_data'); ?>
			<!-- end sidebar user data -->

			<div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
				<!-- Recently Favorited -->
				<div class="widget dashboard-container my-adslist">
					<h3 class="widget-header"><?= lang('Adverts.title_index'); ?></h3>

					<div class="row">
						<div class="col-12 col-sm-6 col-md-6 mb-3">
							<a href="<?= route_to('my.archived.adverts'); ?>" class="btn btn-main-sm">
								<?= lang('App.btn_all_archive'); ?>
							</a>
						</div>
						<div class="col-12 col-sm-6 col-md-6 text-md-right mb-3">
							<button type="button" id="btnCreateAdvert" class="btn btn-main-sm add-button">
								<?= lang('App.btn_new'); ?>
							</button>
						</div>
					</div>

					<div class="row">
						<div class="col-12">
							<table class="table table-striped table-hover" id="myDataTable">
								<thead>
									<tr>
										<th scope="col"><?= lang('Adverts.label_image'); ?></th>
										<th scope="col" class="all"><?= lang('Adverts.label_title'); ?></th>
										<th scope="col" class="none"><?= lang('Adverts.label_code'); ?></th>
										<th scope="col" class="none text-center"><?= lang('Adverts.label_category'); ?></th>
										<th scope="col"><?= lang('Adverts.label_status'); ?></th>
										<th scope="col" class="none"><?= lang('Adverts.label_address'); ?></th>
										<th scope="col" class="all text-center"><?= lang('App.btn_actions'); ?></th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Row End -->
	</div>
	<!-- Container End -->
	<?= $this->include('Dashboard/Adverts/_modal_advert'); ?>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/r-2.3.0/datatables.min.js"></script>
<script type="text/javascript" src="<?= site_url('manager_assets/assets/vendor/mask/jquery.mask.min.js') ?>"></script>
<script type="text/javascript" src="<?= site_url('manager_assets/assets/vendor/mask/app.js') ?>"></script>
<?= $this->include('Dashboard/Adverts/Scripts/_datatable_all'); ?>
<?= $this->include('Dashboard/Adverts/Scripts/_get_my_advert'); ?>
<?= $this->include('Dashboard/Adverts/Scripts/_show_modal_create'); ?>
<?= $this->include('Dashboard/Adverts/Scripts/_submit_modal_update'); ?>
<?= $this->include('Dashboard/Adverts/Scripts/_viacep'); ?>
<?= $this->include('Dashboard/Adverts/Scripts/_archive_advert'); ?>

<script>
	function refreshCSRFToken(token) {
		$('[name="<?= csrf_token(); ?>"]').val(token);
		$('meta[name="<?= csrf_token(); ?>"]').attr('content', token);
	}
</script>
<?= $this->endSection() ?>