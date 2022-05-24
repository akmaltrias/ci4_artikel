<?= $this->extend('layout/template'); ?>

<!-- isi content -->
<?= $this->section('content'); ?>

<div class="main">
    <?= $this->include('layout/navbar'); ?>

    <div class="container-md">
        <div class="row mt-5 justify-content-md-center">
            <div class="col-md-4 card p-4">
                <h2 class="title-auth py-2">Login</h2>
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

                <form action="<?= base_url('auth/check'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group mt-3">
                        <label for="email" class="form-label">Email: </label>
                        <input type="text" name="email" class="form-control" id="email" placeholder="email" value=<?= set_value('email'); ?>>
                        <span class="text-warning"><?= $validation->getError('email') ? $validation->getError('email') : ""; ?></span>
                    </div>

                    <div class="form-group mt-3">
                        <label for="password" class="form-label">Password: </label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="password">
                        <span class="text-danger"><?= $validation->getError('password') ? $validation->getError('password') : ""; ?></span>
                    </div>

                    <div class="form-group mt-4">
                        <button class="btn btn-artikel" type="submit">LOGIN</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>