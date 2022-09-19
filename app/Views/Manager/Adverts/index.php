<?= $this->extend('Manager/Layout/main') ?>

<?= $this->section('title') ?>
<?= lang('Adverts.title_index'); ?>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/r-2.3.0/datatables.min.css" />
<?= $this->endSection() ?>

<?= $this->section('breadcrumb') ?>
<div class="pagetitle">
	<div class="container">
		<h1 class="mb-2"><?= lang('Adverts.title_index'); ?></h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= route_to('manager'); ?>">Home</a></li>
				<li class="breadcrumb-item active"><?= lang('Adverts.title_index'); ?></li>
			</ol>
		</nav>
	</div>
</div><!-- End Page Title -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
	<div class="container">
		<div class="card">

			<div class="card-header">
				<div class="d-flex flex-column flex-sm-row px-2 py-0 ">
					<div class="p-2 flex-column flex-md-fill">
						<h3 class="card-title py-0 my-1">
							<?= lang('Adverts.title_index') ?>
						</h3>
					</div>
					<div class="p-2 flex-fill text-sm-end">
						<a href="<?= route_to('adverts.manager.archived') ?>" class="btn btn-outline-secondary my-1">
							<i class="bi bi-archive me-1"></i><?= lang('App.btn_all_archive'); ?>
						</a>
					</div>
				</div>
			</div>

			<div class="card-body">
				<div class="table-responsive mt-3">
					<table class="table table-striped table-hover" id="myDataTable" style="width: 100%;">
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
	<!-- Container End -->
	<?= $this->include('manager/Adverts/_modal_advert'); ?>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/r-2.3.0/datatables.min.js"></script>

<script type="text/javascript" src="<?= site_url('manager_assets/assets/vendor/mask/jquery.mask.min.js') ?>"></script>
<script type="text/javascript" src="<?= site_url('manager_assets/assets/vendor/mask/app.js') ?>"></script>

<?= $this->include('Manager/Adverts/Scripts/_datatable_all'); ?>
<?= $this->include('Manager/Adverts/Scripts/_get_manage_advert'); ?>
<?= $this->include('Manager/Adverts/Scripts/_show_modal_create'); ?>
<?= $this->include('Manager/Adverts/Scripts/_submit_modal_update'); ?>
<?= $this->include('Manager/Adverts/Scripts/_viacep'); ?>
<?= $this->include('Manager/Adverts/Scripts/_archive_advert'); ?>

<script>
	function refreshCSRFToken(token) {
		$('[name="<?= csrf_token(); ?>"]').val(token);
		$('meta[name="<?= csrf_token(); ?>"]').attr('content', token);
	}
</script>
<?= $this->endSection() ?>