<?= $this->extend('template/templateadmin'); ?>
<?= $this->section('content'); ?>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <?= $this->include('template/topbar'); ?>


        <!-- Begin Page Content -->
        <div class="container-fluid">

            <div class="container-fluid">
                <div class="container">
                    <form id="form" action="<?= base_url(); ?>/operator/savesiswa" method="post">
                        <?= csrf_field(); ?>
                        <div class="card mt-3">
                            <div class="card-header">
                                Hubungkan Akun
                            </div>
                            <div class="card-body">
                                <div class="col-6">
                                    <div class="form-group">
                                        <input type="hidden" name="idid" value="<?= user_id() ?>">
                                        <label>ID Akun</label>
                                        <select name="id_akun" id="id_akun" class="selectpicker form-control form-select <?= ($validation->hasError('id_akun')) ? 'is-invalid' : ''; ?> " data-live-search="true">
                                            <option selected value="">Pilih Akun Siswa</option>
                                            <?php foreach ($user as $as) : ?>
                                                <option value="<?= $as->userid; ?>"><?= $as->username; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('id_akun'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-header">
                                Data Pribadi Siswa
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Nama Lengkap</label>
                                            <input autofocus type="text" value="<?= old('nama_lengkap'); ?>" class="form-control <?= ($validation->hasError('nama_lengkap')) ? 'is-invalid' : ''; ?>" name="nama_lengkap" id="nama_lengkap">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('nama_lengkap'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Nomer Induk Siswa (NIS) </label>
                                            <input type="text" value="<?= old('nis'); ?>" name="nis" id="nis" class="form-control <?= ($validation->hasError('nis')) ? 'is-invalid' : ''; ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('nis'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <select class="form-select form-control <?= ($validation->hasError('jenis_kelamin')) ? 'is-invalid' : ''; ?>" name="jenis_kelamin" id="jenis_kelamin">
                                                <option selected>Pilih Jenis Kelamin</option>
                                                <option value="Laki-Laki">Laki-Laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('jenis_kelamin'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Tempat Lahir</label>
                                            <input type="text" value="<?= old('tempat_lahir'); ?>" name="tempat_lahir" id="tempat_lahir" class="form-control <?= ($validation->hasError('tempat_lahir')) ? 'is-invalid' : ''; ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('tempat_lahir'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <input type="text" value="tgl_lahir" name="tgl_lahir" id="tgl_lahir" class="form-control <?= ($validation->hasError('tgl_lahir')) ? 'is-invalid' : ''; ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('tgl_lahir'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Agama</label>
                                            <select class="form-select form-control <?= ($validation->hasError('agama')) ? 'is-invalid' : ''; ?>" name="agama" id="agama">
                                                <option selected>Pilih Agama</option>
                                                <option value="Islam">Islam</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Kristen">Kristen</option>
                                                <option value="Budha">Budha</option>
                                                <option value="Konghucu">Konghucu</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('agama'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" name="alamat" id="alamat" cols="30" rows="5"><?php echo old('alamat') ?></textarea>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('alamat'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Nomor Telepon</label>
                                            <input type="tel" value="<?= old('no_telp'); ?>" name="no_telp" pattern="^\d{12}$" title="12 numeric characters only" id="no_telp" class="form-control <?= ($validation->hasError('no_telp')) ? 'is-invalid' : ''; ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('no_telp'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Jurusan</label>
                                            <select class="form-select form-control <?= ($validation->hasError('jurusan')) ? 'is-invalid' : ''; ?>" name="jurusan" id="jurusan">
                                                <option selected>Pilih jurusan</option>
                                                <option value="Teknik Komputer Jaringan">Teknik Komputer Jaringan (TKJ)</option>
                                                <option value="Akuntansi">Akuntansi (AK)</option>
                                                <option value="Administrasi Perkantoran">Administrasi Perkantoran (AP)</option>
                                                <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak (RPL)</option>
                                                <option value="Multimedia">Multimedia (MM)</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('jurusan'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3 mb-5">
                            <div class="card-header">
                                Data Orangtua/wali
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Nama Orangtua</label>
                                            <input value="<?= old('nama_orangtua'); ?>" type="text" name="nama_orangtua" id="nama_orangtua" class="form-control <?= ($validation->hasError('nama_orangtua')) ? 'is-invalid' : ''; ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('nama_orangtua'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>NO Telp Orangtua</label>
                                            <input type="tel" value="<?= old('no_telp_orangtua'); ?>" name="no_telp_orangtua" pattern="^\d{12}$" title="12 numeric characters only" id="no_telp_orangtua" class="form-control <?= ($validation->hasError('no_telp_orangtua')) ? 'is-invalid' : ''; ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('no_telp_orangtua'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Alamat Orangtua</label>
                                            <textarea class="form-control <?= ($validation->hasError('alamat_orangtua')) ? 'is-invalid' : ''; ?>" name="alamat_orangtua" id="alamat_orangtua" cols="30" rows="5"><?php echo old('alamat_orangtua') ?></textarea>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('alamat_orangtua'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-success" type="submit">Tambah</button>
                                <button class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $("#tgl_lahir").datepicker({
        dateFormat: "yy-mm-dd"
    });
</script>
<!-- End of Content Wrapper -->
<?= $this->endsection(); ?>