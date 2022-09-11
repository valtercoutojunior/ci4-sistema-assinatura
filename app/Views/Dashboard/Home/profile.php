<?= $this->extend('Dashboard/Layout/main'); ?>
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
			<?= $this->include('Dashboard/Layout/sidebar_user_data'); ?>
			<div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
				<!-- Edit Personal Info -->
				<div class="widget personal-info">
					<h3 class="widget-header user">Meus dados</h3>
					<div class="mb-4">
						<a href="<?= route_to('access'); ?>" class="btn btn-primary btn btn-main-sm bg-info border-info mb-2">
							<i class="lni lni-lock mr-2"></i>Minha senha
						</a>
					</div>

					<?= form_open(route_to('profile.update'), hidden: $hiddens); ?>

					<div class="row">
						<div class="col-md-6 mb-3">
							<label>Seu nome</label>
							<input type="text" name="name" class="form-control" value="<?= old('name', auth()->user()->name); ?>">
							<span class="text-danger error-text name"></span>
						</div>

						<div class="col-md-6 mb-3">
							<label>Seu sobrenome</label>
							<input type="text" name="last_name" class="form-control" value="<?= old('last_name', auth()->user()->last_name); ?>">
						</div>

						<div class="col-md-6 mb-3">
							<label>Seu e-mail de acesso </label>
							<input type="email" name="email" class="form-control" value="<?= old('email', auth()->user()->email); ?>">
						</div>

						<div class="col-md-6 mb-3">
							<label>Seu CPF </label>

							<input type="text" name="cpf" class="form-control cpf" value="<?= old('cpf', auth()->user()->cpf); ?>">
						</div>

						<div class="col-md-6 mb-3">
							<label>Seu telefone celular</label>
							<input type="tel" name="phone" class="form-control sp_celphones" value="<?= old('phone', auth()->user()->phone); ?>">
						</div>

						<div class="col-md-6 mb-3">
							<label>Data de nascimento</label>
							<input type="date" name="birth" class="form-control" value="<?= old('birth', auth()->user()->birth); ?>">
						</div>
					</div>

					<div class="form-check">
						<label class="form-check-label" for="display_phone">
							<?= form_hidden('display_phone', '0') ?>
							<input type="checkbox" name="display_phone" value="1" <?= set_checkbox('display_phone', '1', auth()->user()->display_phone); ?> class="form-check-input" id="display_phone">
							Exibir meu telefone nos meus anúncios
						</label>
					</div>

					<button type="submit" class="btn btn-success">
						<?= lang('App.btn_save'); ?>
					</button>
					<?= form_close(); ?>
				</div>

			</div>
		</div>
		<!-- Row End -->
	</div>
	<!-- Container End -->
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script type="text/javascript" src="<?= site_url('manager_assets/assets/vendor/mask/jquery.mask.min.js') ?>"></script>
<script type="text/javascript" src="<?= site_url('manager_assets/assets/vendor/mask/app.js') ?>"></script>
<?= $this->endSection() ?>