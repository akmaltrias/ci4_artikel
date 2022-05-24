<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="main">
    <?= $this->include('layout/home_nav'); ?>

    <div class="container-md">
        <div class="row mt-5 justify-content-md-center">

            <div class="card col-md-8 p-4">
                <h2 class="title-auth">Edit Artikel</h2>
                <form action=<?= base_url('artikel/simpanUbah/' . $artikel['id_artikel']) ?> method="post">
                    <div class="form-group mt-3">
                        <label for="nama-penulis" class="form-label">Nama Penulis: </label>
                        <input type="text" name="nama-penulis" class="form-control" id="nama-penulis" value="<?= $artikel['nama'] ?>" disabled>
                    </div>

                    <div class="form-group mt-3">
                        <label for="judul" class="form-label">Judul: </label>
                        <input type="text" name="judul" id="judul" class="form-control" value="<?= (set_value('judul')) ? set_value('judul') : $artikel['judul']; ?>" autocomplete="off">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'judul') : ""; ?></span>

                    </div>

                    <div class="form-group mt-3">
                        <label for="isi" class="form-label">Isi: </label>
                        <textarea class="form-control" name="isi" id="isi" rows="5" placeholder="isi artikel..."><?= $artikel['isi']; ?></textarea>
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'isi') : ""; ?></span>
                    </div>

                    <div class=" form-group mt-4">
                        <button class="btn btn-artikel" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>