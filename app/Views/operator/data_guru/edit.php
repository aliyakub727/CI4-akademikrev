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
                    <form id="form" action="<?= base_url(); ?>/operator/saveeditsiswa" method="post">
                        <input type="hidden" value="<?= $siswa['id']; ?>" name="id">
                        <div class="card mt-3">
                            <div class="row mt-3 mr-3 ml-2 mb-3">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>ID Akun</label>
                                        <select name="id_akun" id="id_akun" class="selectpicker form-control form-select <?= ($validation->hasError('id_akun')) ? 'is-invalid' : ''; ?>" data-live-search="true">
                                            <option value="<?= (old('id_akun')) ? old('id_akun') : $siswa['id_akun'] ?>" selected hidden><?= (old('id_akun')) ? old('id_akun') : $siswa['id_akun'] ?></option>
                                            <!-- <option selected value="">Pilih Akun Siswa</option> -->
                                            <?php foreach ($user as $as) : ?>
                                                <option value="<?= $as->id; ?>"><?= $as->username; ?></option>
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
                            <div class="row mt-3 mr-3 ml-2 mb-3">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input autofocus type="text" value="<?= (old('nama_lengkap')) ? old('nama_lengkap') : $siswa['nama_lengkap'] ?>" class="form-control <?= ($validation->hasError('nama_lengkap')) ? 'is-invalid' : ''; ?>" name="nama_lengkap" id="nama_lengkap">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nama_lengkap'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Nomer Induk Siswa (NIS) </label>
                                        <input type="text" value="<?= (old('nis')) ? old('nis') : $siswa['nis'] ?>" name="nis" id="nis" class="form-control <?= ($validation->hasError('nis')) ? 'is-invalid' : ''; ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nis'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3 mr-3 ml-2 mb-3">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select class="form-select form-control <?= ($validation->hasError('jenis_kelamin')) ? 'is-invalid' : ''; ?>" name="jenis_kelamin" id="jenis_kelamin">
                                            <option value="<?= (old('jenis_kelamin')) ? old('jenis_kelamin') : $siswa['jenis_kelamin'] ?>" selected hidden><?= (old('jenis_kelamin')) ? old('jenis_kelamin') : $siswa['jenis_kelamin'] ?></option>
                                            <!-- <option selected>Pilih Jenis Kelamin</option> -->
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
                                        <input type="text" value="<?= (old('tempat_lahir')) ? old('tempat_lahir') : $siswa['tempat_lahir'] ?>" name="tempat_lahir" id="tempat_lahir" class="form-control <?= ($validation->hasError('tempat_lahir')) ? 'is-invalid' : ''; ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('tempat_lahir'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                        <input type="text" value="<?= (old('tgl_lahir')) ? old('tgl_lahir') : $siswa['tgl_lahir'] ?>" name="tgl_lahir" id="tgl_lahir" class="form-control <?= ($validation->hasError('tgl_lahir')) ? 'is-invalid' : ''; ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('tgl_lahir'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Agama</label>
                                        <select class="form-select form-control <?= ($validation->hasError('agama')) ? 'is-invalid' : ''; ?>" name="agama" id="agama">
                                            <option value="<?= (old('agama')) ? old('agama') : $siswa['agama'] ?>" selected hidden><?= (old('agama')) ? old('agama') : $siswa['agama'] ?></option>
                                            <!-- <option selected>Pilih Agama</option> -->
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
                                <div class="row mt-3 mr-3 ml-2 mb-3">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" name="alamat" id="alamat" cols="30" rows="5"><?php echo (old('alamat')) ? old('alamat') : $siswa['alamat'] ?></textarea>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('alamat'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3 mr-3 ml-2 mb-3">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Nomor Telepon</label>
                                            <input type="tel" value="<?= (old('no_telp')) ? old('no_telp') : $siswa['no_telp'] ?>" name="no_telp" pattern="^\d{12}$" title="12 numeric characters only" id="no_telp" class="form-control <?= ($validation->hasError('no_telp')) ? 'is-invalid' : ''; ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('no_telp'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Jurusan</label>
                                            <select class="form-select form-control <?= ($validation->hasError('jurusan')) ? 'is-invalid' : ''; ?>" name="jurusan" id="jurusan">
                                                <option value="<?= (old('jurusan')) ? old('jurusan') : $siswa['jurusan'] ?>" selected hidden><?= (old('jurusan')) ? old('jurusan') : $siswa['jurusan'] ?></option>
                                                <!-- <option selected>Pilih jurusan</option> -->
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
                        <div class="card mt-3">
                            <div class="row mt-3 mr-3 ml-2 mb-3">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Nama Orangtua</label>
                                        <input type="text" value="<?= (old('nama_orangtua')) ? old('nama_orangtua') : $siswa['nama_orang_tua'] ?>" name="nama_orangtua" id="nama_orangtua" class="form-control <?= ($validation->hasError('nama_orangtua')) ? 'is-invalid' : ''; ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nama_orangtua'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>NO Telp Orangtua</label>
                                        <input type="tel" value="<?= (old('no_telporangtua')) ? old('no_telporangtua') : $siswa['no_telp_ortu'] ?>" name="no_telp_orangtua" pattern="^\d{12}$" title="12 numeric characters only" id="no_telp_orangtua" class="form-control <?= ($validation->hasError('no_telp_orangtua')) ? 'is-invalid' : ''; ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('no_telp_orangtua'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3 mr-3 ml-2 mb-3">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Alamat Orangtua</label>
                                        <textarea class="form-control <?= ($validation->hasError('alamat_orangtua')) ? 'is-invalid' : ''; ?>" name="alamat_orangtua" id="alamat_orangtua" cols="30" rows="5"><?php echo (old('alamat_orangtua')) ? old('alamat_orangtua') : $siswa['alamat_ortu'] ?></textarea>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('alamat_orangtua'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3 mr-3 ml-2 mb-3">
                                <div class="col-3">
                                    <button class="btn btn-success" type="submit">Tambah</button>
                                    <button class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
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