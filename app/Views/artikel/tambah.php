<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="main">
    <?= $this->include('layout/home_nav'); ?>

    <div class="container-md">
        <div class="row mt-5 justify-content-md-center">

            <div class="card col-md-8 p-4">
                <h2 class="title-auth">Tambah Data</h2>

                <form action=<?= base_url('artikel/save'); ?> method="post">
                    <?= csrf_field(); ?>
                    <div class="form-group mt-3">
                        <label for="nama-penulis" class="form-label">Nama Penulis: </label>
                        <input type="text" name="nama-penulis" class="form-control" id="nama-penulis" value=<?= $userLog['nama']; ?> disabled>
                    </div>

                    <div class="form-group mt-3">
                        <label for="judul" class="form-label">Judul: </label>
                        <input type="text" name="judul" id="judul" class="form-control" placeholder="buat judul" value=<?= set_value("judul"); ?>>
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'judul') : ''; ?></span>
                    </div>

                    <div class="form-group mt-3">
                        <label for="isi" class="form-label">Isi: </label>
                        <textarea class="form-control" name="isi" id="isi" rows="5" placeholder="isi artikel..." value=<?= set_value('isi'); ?>></textarea>
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'isi') : ''; ?></span>
                    </div>

                    <div class="form-group mt-4">
                        <button class="btn btn-artikel" type="submit">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>