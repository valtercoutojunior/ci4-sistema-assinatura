<?= $this->extend('Dashboard/Layout/main') ?>

<?= $this->section('title') ?>
<?= $title ?? ''; ?>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>

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
					<h3 class="widget-header">
						<?= lang('Adverts.title_index'); ?>
					</h3>

					<div class="card-deck">
						<div class="card">
							<div class="card-body text-center">
								<i class="fa fa-database text-primary fa-2x mb-3"></i>
								<p class="card-text">
									<?= lang('Adverts.text_total_adverts'); ?>
								</p>
							</div>
							<div class="card-footer text-center bg-transparent border-top-0">
								<span class="badge badge-pill badge-primary py-2 px-4">
									<?= $totalUserAdverts; ?>
								</span>
							</div>
						</div>

						<div class="card">
							<div class="card-body text-center">
								<i class="fa fa-check-circle text-success fa-2x mb-3"></i>
								<p class="card-text">
									<?= lang('Adverts.text_total_advert_published'); ?>
								</p>
							</div>
							<div class="card-footer text-center bg-transparent border-top-0">
								<span class="badge badge-pill badge-primary py-2 px-4">
									<?= $totalUserPublishedAdverts; ?>
								</span>
							</div>
						</div>

						<div class="card">
							<div class="card-body text-center">
								<i class="fa fa-lock text-warning fa-2x mb-3"></i>
								<p class="card-text">
									<?= lang('Adverts.text_total_waiting_approval'); ?>
								</p>
							</div>
							<div class="card-footer text-center bg-transparent border-top-0">
								<span class="badge badge-pill badge-warning py-2 px-4">
									<?= $totalUserWaitingAdverts; ?>
								</span>
							</div>
						</div>

						<div class="card">
							<div class="card-body text-center">
								<i class="fa fa-archive text-info fa-2x mb-3"></i>
								<p class="card-text">
									<?= lang('Adverts.text_total_archived'); ?>
								</p>
							</div>
							<div class="card-footer text-center bg-transparent border-top-0">
								<span class="badge badge-pill badge-info py-2 px-4">
									<?= $totalUserArchivedAdverts; ?>
								</span>
							</div>
						</div>
					</div>





				</div>
			</div>
		</div>
		<!-- Row End -->
	</div>
	<!-- Container End -->
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<?= $this->endSection() ?>