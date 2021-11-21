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
                    <form id="form" action="<?= base_url(); ?>/operator/saveeditguru" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" value="<?= $guru['id_guru']; ?>" name="id_guru">
                        <div class="card mt-3">
                            <div class="card-header">
                                Hubungkan Akun
                            </div>
                            <div class="card-body">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>ID Akun</label>
                                        <select name="id_akun" id="id_akun" class="selectpicker form-control form-select <?= ($validation->hasError('id_akun')) ? 'is-invalid' : ''; ?> " data-live-search="true">
                                            <option selected value="">Pilih Akun</option>
                                            <?php foreach ($user as $as) : ?>
                                                <option selected hidden value="<?= (old('id_akun')) ? old('id_akun') : $as->id ?>"><?= (old('id_akun')) ? old('id_akun') : $as->username ?></option>
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
                        <div class="card mt-3 mb-5">
                            <div class="card-header">
                                Data Guru
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>ID MAPEL yang diampu</label>
                                            <select name="id_mapel" id="id_mapel" class="selectpicker form-control form-select <?= ($validation->hasError('id_mapel')) ? 'is-invalid' : ''; ?>" data-live-search="true">
                                                <option selected value="">Pilih id Mata pelajaran</option>
                                                <?php foreach ($mapel as $ak) : ?>
                                                    <option selected hidden value="<?= (old('id_mapel')) ? old('id_mapel') : $ak['id_mapel'] ?>"><?= (old('id_mapel')) ? old('id_mapel') : $ak['nama_mapel'] ?></option>
                                                    <option value="<?= $ak['id_mapel']; ?>"><?= $ak['nama_mapel']; ?></option>
                                                <?php endforeach ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('id_mapel'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Nama Guru</label>
                                            <input type="text" value="<?= (old('nama_guru')) ? old('nama_guru') : $guru['nama_guru'] ?>" class="form-control <?= ($validation->hasError('nama_guru')) ? 'is-invalid' : ''; ?>" name="nama_guru" id="nama_guru">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('nama_guru'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" name="alamat" id="alamat" cols="30" rows="5"><?php echo (old('alamat')) ? old('alamat') : $guru['alamat'] ?></textarea>
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
                                            <input type="tel" value="<?= (old('no_telp')) ? old('no_telp') : $guru['no_telp'] ?>" name="no_telp" pattern="^\d{12}$" title="12 numeric characters only" id="no_telp" class="form-control <?= ($validation->hasError('no_telp')) ? 'is-invalid' : ''; ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('no_telp'); ?>
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