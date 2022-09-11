<?= $this->extend('Manager/Layout/main') ?>

<?= $this->section('title') ?>
<?= $title ?? ''; ?>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>

<?= $this->endSection() ?>


<?= $this->section('breadcrumb') ?>
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section dashboard">

</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<?= $this->endSection() ?>