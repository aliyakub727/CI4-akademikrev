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

                    <div class="card">
                        <div class="card-header">
                            Data Jurusan
                        </div>
                        <div class="card-body">
                            <form id="form" action="<?= base_url(); ?>/operator/saveeditmapel" method="post">
                                <?= csrf_field(); ?>
                                <input type="hidden" value="<?= $mapel['id_mapel']; ?>" name="id_mapel">
                                <div class="form-group">
                                    <label>Nama Mapel</label>
                                    <input type="text" value="<?= (old('nama_mapel')) ? old('nama_mapel') : $mapel['nama_mapel'] ?>" class="form-control <?= ($validation->hasError('nama_mapel')) ? 'is-invalid' : ''; ?>" name="nama_mapel" id="nama_mapel">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nama_mapel'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>ID Kelas</label>
                                    <select name="id_kelas" id="id_kelas" class="selectpicker form-control form-select <?= ($validation->hasError('id_kelas')) ? 'is-invalid' : ''; ?>" data-live-search="true">
                                        <option selected value="">Pilih id Kelas</option>
                                        <?php foreach ($kelas as $ak) : ?>
                                            <option selected hidden value="<?= (old('id_kelas')) ? old('id_kelas') : $ak['id_kelas'] ?>"><?= (old('nama_kelas')) ? old('nama_kelas') : $ak['nama_kelas'] ?></option>
                                            <option value="<?= $ak['id_kelas']; ?>"><?= $ak['nama_kelas']; ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <button class="btn btn-success" type="submit">Tambah</button>
                                <button class="btn btn-danger" data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- End of Content Wrapper -->
<?= $this->endsection(); ?>