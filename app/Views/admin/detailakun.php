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
            <div class="">
                <div class="row">
                    <div class="col-4 col-sm-4 col-md-3 col-lg-3">
                        <div class="card mb-3">
                            <img src="<?= base_url(); ?>/img/fotoprofil/<?= $users->user_image; ?>" class="img-fluid rounded-circle" alt="<?= $users->username; ?>">
                            <?php if (in_groups('operator')) { ?>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#operator">Ganti Profile</button>
                            <?php } elseif (in_groups('guru')) { ?>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#guru">Ganti Profile</button>
                            <?php } elseif (in_groups('kepalasekolah')) { ?>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kepsek">Ganti Profile</button>
                            <?php } elseif (in_groups('admin')) { ?>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#admin">Ganti Profile</button>
                            <?php } elseif (in_groups('siswa')) { ?>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#siswa">Ganti Profile</button>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-8 col-sm-8 col-md-9 col-lg-9">
                        <div class="card mb-3">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="card-body" id="m-account">
                                    <form action="<?= base_url() ?>/admin/update" method="post">
                                        <?= csrf_field() ?>
                                        <input type="hidden" value="<?= $users->userid; ?>" name="id">
                                        <div class="row mt-4">
                                            <div class="col-12 col-sm-9 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="username" value="<?= (old('username')) ? old('username') : $users->username ?>">
                                                        <a class="btn btn-outline-secondary" type="button" id="button-addon2">Edit</a>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-9 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" readonly class="form-control" name="email" value="<?= (old('email')) ? old('email') : $users->email ?>">
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-9 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label>Role</label>
                                                    <input readonly type="text" class="form-control" name="description" value="<?= (old('description')) ? old('description') : $users->description ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4 ml-4 mt-1 mb-5">
                                            <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="row">
                                <div class="col-12 my-5 ml-5 mr-5">
                                    <?php
                                    if (in_groups('guru')) {
                                    ?>
                                        <form id="form" action="<?= base_url(); ?>/Guru/saveprofile" method="post">
                                            <input type="hidden" value="<?= $guru['id_guru']; ?>" name="id_guru">
                                            <input type="hidden" name="id" value="<?= $guru['id_akun'] ?>">
                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="form-group">
                                                        <label>Nama Guru</label>
                                                        <input type="text" value="<?= (old('nama_guru')) ? old('nama_guru') : $guru['nama_guru'] ?>" class="form-control <?= ($validation->hasError('nama_guru')) ? 'is-invalid' : ''; ?>" name="nama_guru" id="nama_guru">
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('nama_guru'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-5">
                                                    <div class="form-group">
                                                        <label>Nomor Telepon</label>
                                                        <input type="tel" value="<?= (old('no_telp')) ? old('no_telp') : $guru['no_telp'] ?>" name="no_telp" id="no_telp" class="form-control <?= ($validation->hasError('no_telp')) ? 'is-invalid' : ''; ?>">
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('no_telp'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-10">
                                                    <div class="form-group">
                                                        <label>Alamat</label>
                                                        <textarea class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" name="alamat" id="alamat" cols="30" rows="5"><?php echo (old('alamat')) ? old('alamat') : $guru['alamat'] ?></textarea>
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('alamat'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <button class="btn btn-success" type="submit">Tambah</button>
                                            <button class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </form>
                                    <?php
                                    } elseif (in_groups('siswa')) {
                                    ?>
                                        <form id="form" action="<?= base_url(); ?>/Siswa/tambahsiswa" method="post">
                                            <input type="hidden" value="<?= user()->id; ?>" name="id" id="id">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Nama Lengkap</label>
                                                        <input autofocus type="text" class="form-control <?= ($validation->hasError('nama_lengkap')) ? 'is-invalid' : ''; ?>" value="<?= (old('nama_lengkap')) ? old('nama_lengkap') : $siswa['nama_lengkap']; ?>" name="nama_lengkap" id="nama_lengkap">
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('nama_lengkap'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Nomer Induk Siswa (NIS) </label>
                                                        <input type="text" name="nis" id="nis" value="<?= (old('nis')) ? old('nis') : $siswa['nis']; ?>" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label>Jenis Kelamin</label>
                                                        <select class="form-select form-control" name="jenis_kelamin" id="jenis_kelamin">
                                                            <option selected>Pilih Jenis Kelamin</option>
                                                            <option selected hidden value="<?= (old('jenis_kelamin')) ? old('jenis_kelamin') : $siswa['jenis_kelamin']; ?>"><?= (old('jenis_kelamin')) ? old('jenis_kelamin') : $siswa['jenis_kelamin']; ?></option>
                                                            <option value="Laki-Laki">Laki-Laki</option>
                                                            <option value="Perempuan">Perempuan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label>Tempat Lahir</label>
                                                        <input type="text" value="<?= (old('tempat_lahir')) ? old('tempat_lahir') : $siswa['tempat_lahir']; ?>" name="tempat_lahir" id="tempat_lahir" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label>Tanggal Lahir</label>
                                                        <input type="text" name="tgl_lahir" id="tgl_lahir" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label>Agama</label>
                                                        <select class="form-select form-control" name="agama" id="agama">
                                                            <option selected>Pilih Agama</option>
                                                            <option value="Islam">Islam</option>
                                                            <option value="Hindu">Hindu</option>
                                                            <option value="Kristen">Kristen</option>
                                                            <option value="Budha">Budha</option>
                                                            <option value="Konghucu">Konghucu</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Alamat</label>
                                                        <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="5"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Nomor Telepon</label>
                                                        <input type="tel" name="no_telp" pattern="^\d{12}$" title="12 numeric characters only" id="no_telp" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Jurusan</label>
                                                        <select class="form-select form-control" name="jurusan" id="jurusan">
                                                            <option selected>Pilih jurusan</option>
                                                            <option value="Teknik Komputer Jaringan">Teknik Komputer Jaringan (TKJ)
                                                            </option>
                                                            <option value="Akuntansi">Akuntansi (AK)</option>
                                                            <option value="Administrasi Perkantoran">Administrasi Perkantoran (AP)
                                                            </option>
                                                            <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak (RPL)
                                                            </option>
                                                            <option value="Multimedia">Multimedia (MM)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Nama Orangtua</label>
                                                        <input type="text" name="nama_orangtua" id="nama_orangtua" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>NO Telp Orangtua</label>
                                                        <input type="tel" name="no_telp_orangtua" pattern="^\d{12}$" title="12 numeric characters only" id="no_telp_orangtua" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Alamat Orangtua</label>
                                                        <textarea class="form-control" name="alamat_orangtua" id="alamat_orangtua" cols="30" rows="5"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-success" type="submit">Tambah</button>
                                            <button class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </form>
                                    <?php } elseif (in_groups('operator')) { ?>
                                        <form id="form" action="<?= base_url(); ?>/Operator/editoperator" method="post">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" value="<?= $operator['id_operator'] ?>" name="id_operator">
                                            <input type="hidden" value="<?= user()->id; ?>" name="id" id="id">
                                            <div class="row">
                                                <div class="col-9">
                                                    <div class="form-group">
                                                        <label>Nama Lengkap</label>
                                                        <input autofocus type="text" value="<?= (old('nama_lengkap')) ? old('nama_lengkap') : $operator['nama_lengkap']; ?>" class="form-control <?= ($validation->hasError('nama_lengkap')) ? 'is-invalid' : ''; ?>" name="nama_lengkap" id="nama_lengkap">
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('nama_lengkap'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label>Jenis Kelamin</label>
                                                        <select class="form-select form-control <?= ($validation->hasError('jenis_kelamin')) ? 'is-invalid' : ''; ?>" name="jenis_kelamin" id="jenis_kelamin">
                                                            <option value="<?= (old('jenis_kelamin')) ? old('jenis_kelamin') : $operator['jenis_kelamin'] ?>" selected hidden><?= (old('jenis_kelamin')) ? old('jenis_kelamin') : $operator['jenis_kelamin'] ?></option>
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
                                                        <input type="text" value="<?= (old('tempat_lahir')) ? old('tempat_lahir') : $operator['tempat_lahir']; ?>" name="tempat_lahir" id="tempat_lahir" class="form-control <?= ($validation->hasError('tempat_lahir')) ? 'is-invalid' : ''; ?>">
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('tempat_lahir'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label>Tanggal Lahir</label>
                                                        <input type="text" value="<?= (old('tgl_lahir')) ? old('tgl_lahir') : $operator['tgl_lahir']; ?>" name="tgl_lahir" id="tgl_lahir" class="form-control <?= ($validation->hasError('tgl_lahir')) ? 'is-invalid' : ''; ?>">
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('tgl_lahir'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label>Agama</label>
                                                        <select class="form-select form-control <?= ($validation->hasError('agama')) ? 'is-invalid' : ''; ?>" name="agama" id="agama">
                                                            <option value="<?= (old('agama')) ? old('agama') : $operator['agama'] ?>" selected hidden><?= (old('agama')) ? old('agama') : $operator['agama'] ?></option>
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
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label>Nomor Telepon</label>
                                                        <input type="tel" name="no_telp" value="<?= (old('no_telp')) ? old('no_telp') : $operator['No_Telp']; ?>" pattern="^\d{12}$" title="12 numeric characters only" id="no_telp" class="form-control <?= ($validation->hasError('no_telp')) ? 'is-invalid' : ''; ?>">
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('no_telp'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-9">
                                                    <div class="form-group">
                                                        <label>Alamat</label>
                                                        <textarea class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" name="alamat" id="alamat" cols="30" rows="5"><?= (old('alamat')) ? old('alamat') : $operator['Alamat']; ?></textarea>
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('alamat'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-success" type="submit">Simpan</button>
                                        </form>
                                    <?php } elseif (in_groups('kepalasekolah')) { ?>
                                        <form id="form" action="<?= base_url(); ?>/Kepalasekolah/saveprofile" method="post">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" value="<?= $kepsek['id_kepala_sk'] ?>" name="id_kepsek">
                                            <input type="hidden" value="<?= user()->id; ?>" name="id" id="id">
                                            <div class="row">
                                                <div class="col-9">
                                                    <div class="form-group">
                                                        <label>Nama Lengkap</label>
                                                        <input autofocus type="text" value="<?= (old('nama_lengkap')) ? old('nama_lengkap') : $kepsek['nama_lengkap']; ?>" class="form-control <?= ($validation->hasError('nama_lengkap')) ? 'is-invalid' : ''; ?>" name="nama_lengkap" id="nama_lengkap">
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('nama_lengkap'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label>Jenis Kelamin</label>
                                                        <select class="form-select form-control <?= ($validation->hasError('jenis_kelamin')) ? 'is-invalid' : ''; ?>" name="jenis_kelamin" id="jenis_kelamin">
                                                            <option value="<?= (old('jenis_kelamin')) ? old('jenis_kelamin') : $kepsek['jenis_kelamin'] ?>" selected hidden><?= (old('jenis_kelamin')) ? old('jenis_kelamin') : $kepsek['jenis_kelamin'] ?></option>
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
                                                        <input type="text" value="<?= (old('tempat_lahir')) ? old('tempat_lahir') : $kepsek['tempat_lahir']; ?>" name="tempat_lahir" id="tempat_lahir" class="form-control <?= ($validation->hasError('tempat_lahir')) ? 'is-invalid' : ''; ?>">
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('tempat_lahir'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label>Tanggal Lahir</label>
                                                        <input type="text" value="<?= (old('tgl_lahir')) ? old('tgl_lahir') : $kepsek['tgl_lahir']; ?>" name="tgl_lahir" id="tgl_lahir" class="form-control <?= ($validation->hasError('tgl_lahir')) ? 'is-invalid' : ''; ?>">
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('tgl_lahir'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label>Agama</label>
                                                        <select class="form-select form-control <?= ($validation->hasError('agama')) ? 'is-invalid' : ''; ?>" name="agama" id="agama">
                                                            <option value="<?= (old('agama')) ? old('agama') : $kepsek['agama'] ?>" selected hidden><?= (old('agama')) ? old('agama') : $kepsek['agama'] ?></option>
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
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label>Nomor Telepon</label>
                                                        <input type="tel" name="no_telp" value="<?= (old('no_telp')) ? old('no_telp') : $kepsek['no_telp']; ?>" id="no_telp" class="form-control <?= ($validation->hasError('no_telp')) ? 'is-invalid' : ''; ?>">
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('no_telp'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-9">
                                                    <div class="form-group">
                                                        <label>Alamat</label>
                                                        <textarea class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" name="alamat" id="alamat" cols="30" rows="5"><?= (old('alamat')) ? old('alamat') : $kepsek['alamat']; ?></textarea>
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('alamat'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-success" type="submit">Simpan</button>
                                        </form>
                                    <?php } elseif (in_groups('admin')) { ?>
                                        <form id="form" action="<?= base_url(); ?>/Admin/saveprofile" method="post">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" value="<?= $admin['id_admin'] ?>" name="id_admin">
                                            <input type="hidden" value="<?= user()->id; ?>" name="id" id="id">
                                            <div class="row">
                                                <div class="col-9">
                                                    <div class="form-group">
                                                        <label>Nama Lengkap</label>
                                                        <input autofocus type="text" value="<?= (old('nama_lengkap')) ? old('nama_lengkap') : $admin['nama_lengkap']; ?>" class="form-control <?= ($validation->hasError('nama_lengkap')) ? 'is-invalid' : ''; ?>" name="nama_lengkap" id="nama_lengkap">
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('nama_lengkap'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label>Jenis Kelamin</label>
                                                        <select class="form-select form-control <?= ($validation->hasError('jenis_kelamin')) ? 'is-invalid' : ''; ?>" name="jenis_kelamin" id="jenis_kelamin">
                                                            <option value="<?= (old('jenis_kelamin')) ? old('jenis_kelamin') : $admin['jenis_kelamin'] ?>" selected hidden><?= (old('jenis_kelamin')) ? old('jenis_kelamin') : $admin['jenis_kelamin'] ?></option>
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
                                                        <input type="text" value="<?= (old('tempat_lahir')) ? old('tempat_lahir') : $admin['tempat_lahir']; ?>" name="tempat_lahir" id="tempat_lahir" class="form-control <?= ($validation->hasError('tempat_lahir')) ? 'is-invalid' : ''; ?>">
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('tempat_lahir'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label>Tanggal Lahir</label>
                                                        <input type="text" value="<?= (old('tgl_lahir')) ? old('tgl_lahir') : $admin['tgl_lahir']; ?>" name="tgl_lahir" id="tgl_lahir" class="form-control <?= ($validation->hasError('tgl_lahir')) ? 'is-invalid' : ''; ?>">
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('tgl_lahir'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label>Agama</label>
                                                        <select class="form-select form-control <?= ($validation->hasError('agama')) ? 'is-invalid' : ''; ?>" name="agama" id="agama">
                                                            <option value="<?= (old('agama')) ? old('agama') : $admin['agama'] ?>" selected hidden><?= (old('agama')) ? old('agama') : $admin['agama'] ?></option>
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
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label>Nomor Telepon</label>
                                                        <input type="tel" name="no_telp" value="<?= (old('no_telp')) ? old('no_telp') : $admin['no_telp']; ?>" id="no_telp" class="form-control <?= ($validation->hasError('no_telp')) ? 'is-invalid' : ''; ?>">
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('no_telp'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-9">
                                                    <div class="form-group">
                                                        <label>Alamat</label>
                                                        <textarea class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" name="alamat" id="alamat" cols="30" rows="5"><?= (old('alamat')) ? old('alamat') : $admin['alamat']; ?></textarea>
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('alamat'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-success" type="submit">Simpan</button>
                                        </form>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Main Content -->
    <!-- Modal Operator -->
    <div class="modal fade" id="operator" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <form action="<?php base_url() ?>/operator/gantiprofil/<?= user_id(); ?>" id="form" method="post" enctype="multipart/form-data">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Ganti Foto Profil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <center>
                                <div class="col-5">
                                    <img src="<?= base_url(); ?>/img/fotoprofil/<?= $users->user_image; ?>" class="img-fluid rounded-circle" alt="<?= $users->username; ?>" id="img-preview-Operator">
                                    <label for="userimage_Operator">Pilih Foto Profil</label>
                                    <input type="hidden" name="id" value="<?= user_id() ?>">
                                    <input type="hidden" name="gambarlama" value="<?= $users->user_image; ?>">
                                    <input type="file" name="userimage_Operator" id="userimage_Operator" onchange="previewimgO()">
                                </div>
                            </center>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Ganti</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal Operator -->
    <div class="modal fade" id="guru" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <form action="<?php base_url() ?>/Guru/gantiprofil/<?= user_id(); ?>" id="form" method="post" enctype="multipart/form-data">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Ganti Foto Profil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <center>
                                <div class="col-5">
                                    <img src="<?= base_url(); ?>/img/fotoprofil/<?= $users->user_image; ?>" class="img-fluid rounded-circle" alt="<?= $users->username; ?>" id="img-preview-Guru">
                                    <label for="userimage_Guru">Pilih Foto Profil</label>
                                    <input type="hidden" name="id" value="<?= user_id() ?>">
                                    <input type="hidden" name="gambarlama" value="<?= $users->user_image; ?>">
                                    <input type="file" name="userimage_Guru" id="userimage_Guru" onchange="previewimgG()">
                                </div>
                            </center>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Ganti</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal Kepalasekolah -->
    <div class="modal fade" id="kepsek" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <form action="<?php base_url() ?>/Kepalasekolah/gantiprofil/<?= user_id(); ?>" id="form" method="post" enctype="multipart/form-data">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Ganti Foto Profil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <center>
                                <div class="col-5">
                                    <img src="<?= base_url(); ?>/img/fotoprofil/<?= $users->user_image; ?>" class="img-fluid rounded-circle" alt="<?= $users->username; ?>" id="img-preview-Kepsek">
                                    <label for="userimage_Kepsek">Pilih Foto Profil</label>
                                    <input type="hidden" name="id" value="<?= user_id() ?>">
                                    <input type="hidden" name="gambarlama" value="<?= $users->user_image; ?>">
                                    <input type="file" name="userimage_Kepsek" id="userimage_Kepsek" onchange="previewimgK()">
                                </div>
                            </center>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Ganti</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal Admin -->
    <div class="modal fade" id="admin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <form action="<?php base_url() ?>/Admin/gantiprofil/<?= user_id(); ?>" id="form" method="post" enctype="multipart/form-data">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Ganti Foto Profil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <center>
                                <div class="col-5">
                                    <img src="<?= base_url(); ?>/img/fotoprofil/<?= $users->user_image; ?>" class="img-fluid rounded-circle" alt="<?= $users->username; ?>" id="img-preview-Admin">
                                    <label for="userimage_Admin">Pilih Foto Profil</label>
                                    <input type="hidden" name="id" value="<?= user_id() ?>">
                                    <input type="hidden" name="gambarlama" value="<?= $users->user_image; ?>">
                                    <input type="file" name="userimage_Admin" id="userimage_Admin" onchange="previewimgA()">
                                </div>
                            </center>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Ganti</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal Siswa -->
    <div class="modal fade" id="siswa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <form action="<?php base_url() ?>/Admin/gantiprofil/<?= user_id(); ?>" id="form" method="post" enctype="multipart/form-data">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Ganti Foto Profil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <center>
                                <div class="col-5">
                                    <img src="<?= base_url(); ?>/img/fotoprofil/<?= $users->user_image; ?>" class="img-fluid rounded-circle" alt="<?= $users->username; ?>" id="img-preview-Siswa">
                                    <label for="userimage_Siswa">Pilih Foto Profil</label>
                                    <input type="hidden" name="id" value="<?= user_id() ?>">
                                    <input type="hidden" name="gambarlama" value="<?= $users->user_image; ?>">
                                    <input type="file" name="userimage_Siswa" id="userimage_Siswa" onchange="previewimgS()">
                                </div>
                            </center>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Ganti</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    function previewimgO() {
        const userimageO = document.querySelector('#userimage_Operator');
        const imgpreviwO = document.querySelector('#img-preview-Operator');


        const fileimageO = new FileReader();
        fileimageO.readAsDataURL(userimageO.files[0]);

        fileimageO.onload = function(e) {
            imgpreviwO.src = e.target.result;
        }
    }

    function previewimgG() {
        const userimageG = document.querySelector('#userimage_Guru');
        const imgpreviwG = document.querySelector('#img-preview-Guru');


        const fileimageG = new FileReader();
        fileimageG.readAsDataURL(userimageG.files[0]);

        fileimageG.onload = function(e) {
            imgpreviwG.src = e.target.result;
        }
    }

    function previewimgK() {
        const userimageK = document.querySelector('#userimage_Kepsek');
        const imgpreviwK = document.querySelector('#img-preview-Kepsek');


        const fileimageK = new FileReader();
        fileimageK.readAsDataURL(userimageK.files[0]);

        fileimageK.onload = function(e) {
            imgpreviwK.src = e.target.result;
        }
    }

    function previewimgA() {
        const userimageA = document.querySelector('#userimage_Admin');
        const imgpreviwA = document.querySelector('#img-preview-Admin');


        const fileimageA = new FileReader();
        fileimageA.readAsDataURL(userimageA.files[0]);

        fileimageA.onload = function(e) {
            imgpreviwA.src = e.target.result;
        }
    }

    function previewimgS() {
        const userimageS = document.querySelector('#userimage_Siswa');
        const imgpreviwS = document.querySelector('#img-preview-Siswa');


        const fileimageS = new FileReader();
        fileimageS.readAsDataURL(userimageS.files[0]);

        fileimageS.onload = function(e) {
            imgpreviwS.src = e.target.result;
        }
    }
</script>
<!-- End of Content Wrapper -->
<?= $this->endsection(); ?>