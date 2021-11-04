<?= $this->extend('template/templateadmin'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <?= $this->include('template/topbar'); ?>


        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Data Akun </h1>
            </div>

            <div class="container">
                <div class="card">
                    <?= view('Myth\Auth\Views\_message_block') ?>
                    <form action="<?= route_to('register') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="row  ml-4 mt-4">
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="email"><?= lang('Auth.email') ?></label>
                                    <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>">
                                    <small id="emailHelp" class="form-text text-muted"><?= lang('Auth.weNeverShare') ?></small>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="username"><?= lang('Auth.username') ?></label>
                                    <input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row  ml-4 mt-1">
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="password"><?= lang('Auth.password') ?></label>
                                    <input type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="pass_confirm"><?= lang('Auth.repeatPassword') ?></label>
                                    <input type="password" name="pass_confirm" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-5  ml-4 mt-1">
                            <div class="form-group">
                                <label>Role</label>
                                <select class="form-select form-control" name="kesaktian" id="kesaktian">
                                    <option readonly selected>Pilih nama Role</option>
                                    <option value="admin">Administrasi</option>
                                    <option value="operator">Operator</option>
                                    <option value="guru">Guru</option>
                                    <option value="siswa">Siswa</option>
                                    <option value="kepala_sekolah">Kepala Sekolah</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4 ml-4 mt-1 mb-5">
                            <button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.register') ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
</script>
<!-- End of Content Wrapper -->
<?= $this->endsection(); ?>