<?= $this->extend('Dashboard/Layout/main') ?>

<?= $this->section('title') ?>
<?= lang('Adverts.text_edit_images'); ?>
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
                <!-- Edit Personal Info -->
                <div class="widget personal-info">
                    <h3 class="widget-header user">
                        <?= lang('Adverts.text_edit_images'); ?>
                    </h3>
                    <?= form_open_multipart(route_to('adverts.upload.my', $advert->id), hidden: $hiddens) ?>

                    <div class="alert alert-info" role="alert">
                        <?= lang('Adverts.text_images_info_upload'); ?>
                    </div>


                    <!-- File chooser -->
                    <div class="form-group choose-file">
                        <i class="fa fa-image text-center"></i>
                        <input type="file" name="images[]" multiple accept="image/*" class="form-control-file d-inline" id="input-file">
                    </div>
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-transparent btn-sm">
                        <?= lang('App.btn_save'); ?>
                    </button>
                    <?= form_close() ?>

                    <div class="row mt-4">
                        <div class="col-12">
                            <?php if (empty($advert->images)) : ?>
                                <div class="alert alert-warning bg-warning text-center" role="alert">
                                    <?= lang('Adverts.text_no_images'); ?>
                                </div>
                            <?php else : ?>
                                <div class="row">
                                    <?php foreach ($advert->images as $image) : ?>
                                        <div class="col-12 col-sm-6 col-md-4 col-lg-4 my-3">
                                            <div class="card">
                                                <img src="<?= route_to('web.image', $image->image, 'small'); ?>" class="card-img-top" alt="<?= $advert->title; ?>" style="min-height: 110px !important;">
                                                <div class="card-footer p-0 border-top-0">
                                                    <?= form_open(route_to('adverts.delete.image', $image->image), ['id' => 'formDelete'], $hiddensDelete); ?>
                                                    <button type="submit" class="btn bg-danger btn-main-sm btn-block mx-auto m-0">
                                                        <i class="fa fa-trash fa-2x"></i>
                                                    </button>
                                                    <?= form_close(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).on("click", "#formDelete", function(e) {
        e.preventDefault();
        let $form = $(this);

        Swal.fire({
            title: '<?= lang('App.delete_confirmation'); ?>',
            text: "<?= lang('App.info_delete_confirmation'); ?>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?= lang('App.btn_confirmed_delete'); ?>',
            cancelButtonText: '<?= lang('App.btn_cancel'); ?>'
        }).then((result) => {
            if (result.isConfirmed) {
                $form.submit();
            }
        })
    });
</script>


<script>
    function refreshCSRFToken(token) {
        $('[name="<?= csrf_token(); ?>"]').val(token);
        $('meta[name="<?= csrf_token(); ?>"]').attr('content', token);
    }
</script>
<?= $this->endSection() ?>