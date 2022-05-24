<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="main">
    <?= $this->include('layout/navbar'); ?>

    <div class="container-md">
        <div class="row mt-5 justify-content-md-center">
            <div class="col-md-4 card p-4">
                <h2 class="title-auth py-2">Register</h2>
                <?php if (!empty(session()->getFlashData('success'))) : ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success'); ?>
                    </div>
                <?php endif ?>

                <?php if (!empty(session()->getFlashData('fail'))) : ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('fail'); ?>
                    </div>
                <?php endif ?>

                <form action="<?= base_url('auth/save'); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="form-group mt-3">
                        <label for="nama" class="form-label">Nama: </label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="nama" value=<?= set_value('nama'); ?>>
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'nama') : ' '; ?></span>
                    </div>

                    <div class="form-group mt-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="email" value=<?= set_value('email'); ?>>
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'email') : ' '; ?></span>
                    </div>

                    <div class="form-group mt-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="password" value=<?= set_value('password'); ?>>
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'password') : ' '; ?></span>
                    </div>

                    <div class="form-group mt-3">
                        <label for="cpassword" class="form-label">Konfirmasi Password:</label>
                        <input type="password" name="cpassword" class="form-control" id="cpassword" placeholder="konfirmasi password" value=<?= set_value('cpassword'); ?>>
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'cpassword') : ' '; ?></span>
                    </div>

                    <div class="form-group mt-4">
                        <button class="btn btn-artikel" type="submit">REGISTER</button>
                    </div>
            </div>
        </div>

    </div>
</div>
<?= $this->endSection(); ?>