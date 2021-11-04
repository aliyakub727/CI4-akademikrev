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
            <?php d($users) ?>
            <div class="container mb-3">
                <div class="row g-0">
                    <div class="col-md-3">
                        <div class="card">
                            <img src="<?= base_url(); ?>/img/fotoprofil/<?= $users->user_image; ?>" class="img-fluid rounded-start" alt="<?= $users->username; ?>">
                            <a href="" class="btn btn-primary">Ganti Gambar</a>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card" id="m-account">
                            <form action="/acoount/update/<?= $users->userid; ?>" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="id" value="<?= $users->userid; ?>">
                                <div class="row  ml-4 mt-4">
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label>Fullname</label>
                                            <input type="text" class="form-control" name="fullname" value="<?= (old('fullname')) ? old('fullname') : $users->fullname ?>">
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" class="form-control" name="username" value="<?= (old('username')) ? old('username') : $users->username ?>">
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" value="<?= (old('email')) ? old('email') : $users->email ?>">
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label>password</label>
                                            <input type="password" class="form-control" name="password_hash" value="<?= (old('password_hash')) ? old('password_hash') : $users->password_hash ?>">
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label>Role</label>
                                            <input readonly type="text" class="form-control" name="description" value="<?= (old('description')) ? old('description') : $users->description ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 ml-4 mt-1 mb-5">
                                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
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