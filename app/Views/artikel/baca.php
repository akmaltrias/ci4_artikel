<!-- extend artinya isi dari halaman lain akan dipakai disini -->
<?= $this->extend('layout/template'); ?>

<!-- pada layout kita telah mendeklarasikan content sehingga start dan end content isinya adalah dibawah ini -->
<?= $this->section('content'); ?>

<div class="main">
    <!-- include artinya kita menambahkan/menyisipkan file lain dibawah ini -->
    <?= $this->include('layout/home_nav'); ?>

    <div class="container-md">
        <div class="row mt-5 justify-content-md-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h1 class="card-title judul-artikel"><?= $artikel["judul"]; ?></h1>
                            <span class="card-text penulis-artikel">Oleh <?= $artikel["nama"]; ?></span>
                        </div>
                        <hr>
                        <div class="card-text isi-artikel p-3">
                            <?= $artikel["isi"]; ?>
                        </div>
                        <div class="card-footer bg-transparent">
                            <a href="/hapus-artikel/<?= $artikel["id_artikel"] ?>" class="btn btn-hapus <?= $user['nama'] == $artikel['nama'] ? "" : "hidden" ?>">
                                <i class="bi bi-trash m-1"></i>
                                Hapus
                            </a>
                            <!-- pada atribut class menambahkan class hidden, jika nama penulis dan nama user yang login tidak sama maka tidak bisa diakses -->
                            <a href="/edit-artikel/<?= $artikel["id_artikel"] ?>" class="btn btn-ubah mx-3 <?= $user['nama'] == $artikel['nama'] ? "" : "hidden" ?>">
                                <i class="bi bi-pencil-square m-1"></i>
                                Ubah
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>