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
                    <div class="col-8 col-sm-8 col-md-9 col-lg-9">
                        <div class="card mb-3">
                            <div class="row">
                                <div class="col-12 my-5 ml-5 mr-5">
                                    <?php
                                    if (in_groups('guru')) {
                                    ?>
                                        <form id="form" action="<?= base_url(); ?>/Guru/updateguru" method="post">
                                            <input type="hidden" name="id_guru" value="<?= user()->id ?>">
                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="form-group">
                                                        <label>Nama Guru</label>
                                                        <input type="text" value="<?= (old('nama_guru')) ? old('nama_guru') : $guru['nama_guru']; ?>" class="form-control nama_guru" name="nama_guru" id="nama_guru">
                                                    </div>
                                                </div>
                                                <div class="col-5">
                                                    <div class="form-group">
                                                        <label>Nomor Telepon</label>
                                                        <input type="tel" name="no_telp" value="<?= (old('no_telp')) ? old('no_telp') : $guru['no_telp']; ?>" pattern=" ^\d{12}$" title="12 numeric characters only" id="no_telp" class="form-control no_telp" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-10">
                                                    <div class="form-group">
                                                        <label>Alamat</label>
                                                        <textarea class="form-control alamat" name="alamat" id="alamat" cols="30" rows="5" required=""><?= (old('alamat')) ? old('alamat') : $guru['alamat']; ?></textarea>
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
                                    <?php
                                    } elseif (in_groups('admin')) { ?>
                                        <h2>admin</h2>
                                    <?php } elseif (in_groups('operator')) { ?>
                                        <form id="form" action="<?= base_url(); ?>/Operator/saveoperator" method="post">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" value="<?= user_id() ?>" name="id">
                                            <div class="row">
                                                <div class="col-9">
                                                    <div class="form-group">
                                                        <label>Nama Lengkap</label>
                                                        <input autofocus type="text" value="<?= old('nama_lengkap') ?>" class="form-control <?= ($validation->hasError('nama_lengkap')) ? 'is-invalid' : ''; ?>" name="nama_lengkap" id="nama_lengkap">
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
                                                            <option selected value=""></option>
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
                                                        <input type="text" value="<?= old('tempat_lahir') ?>" name="tempat_lahir" id="tempat_lahir" class="form-control <?= ($validation->hasError('tempat_lahir')) ? 'is-invalid' : ''; ?>">
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('tempat_lahir'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label>Tanggal Lahir</label>
                                                        <input type="text" name="tgl_lahir" id="tgl_lahir" class="form-control <?= ($validation->hasError('tgl_lahir')) ? 'is-invalid' : ''; ?>">
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
                                                            <option selected value=""></option>
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
                                                        <input type="tel" name="no_telp" value="<?= old('no_telp') ?>" pattern="^\d{12}$" title="12 numeric characters only" id="no_telp" class="form-control <?= ($validation->hasError('no_telp')) ? 'is-invalid' : ''; ?>">
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
                                                        <textarea class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" name="alamat" id="alamat" cols="30" rows="5"><?= old('alamat') ?></textarea>
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


</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!-- End of Content Wrapper -->
<?= $this->endsection(); ?>