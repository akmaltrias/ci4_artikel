<?= $this->extend('layout/template'); ?>

<!-- isi content -->
<?= $this->section('content'); ?>
<div class="main">
    <?= $this->include('layout/home_nav'); ?>

    <div class="container-md">
        <div class="row mt-5 justify-content-md-center">
            <div class="col-md-8 mb-3">
                <div class="welcome-banner">
                    Selamat Datang,
                    <span id="nama-user"><?= $userLog["nama"]; ?></span>
                </div>
                <div class="body-banner mt-2">
                    Pilih beberapa artikel dibawah untuk mulai membaca :D
                </div>
                <?php if (!empty(session()->getFlashData('success'))) : ?>
                    <div class="alert alert-success mt-3">
                        <?= session()->getFlashdata('success'); ?>
                    </div>
                <?php endif ?>

                <?php if (!empty(session()->getFlashData('fail'))) : ?>
                    <div class="alert alert-danger mt-3">
                        <?= session()->getFlashdata('fail'); ?>
                    </div>
                <?php endif ?>
            </div>


            <?php foreach ($artikel as $a) : ?>
                <div class="card card-artikel col-md-8">
                    <div class="card-body">
                        <h2 class="card-title judul-artikel"><?= $a["judul"]; ?></h2>
                        <p class="card-text penulis-artikel">Ditulis oleh <?= $a["nama"]; ?></p>
                        <a href="/baca-artikel/<?= $a["id_artikel"] ?>" class="btn btn-artikel"><i class="bi bi-arrow-right m-1"></i> Baca</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>