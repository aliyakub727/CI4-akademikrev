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
                            <form id="form" action="<?= base_url(); ?>/operator/saveeditjurusan" method="post">
                                <?= csrf_field(); ?>
                                <input type="hidden" value="<?= $jurusan['id_jurusan']; ?>" name="id_jurusan">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Nama Jurusan</label>
                                        <input type="text" value="<?= (old('jurusan')) ? old('jurusan') : $jurusan['jurusan']; ?>" class="form-control <?= ($validation->hasError('jurusan')) ? 'is-invalid' : ''; ?>" name="jurusan" id="jurusan">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('jurusan'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Tahun Ajaran</label>
                                        <select name="tahun_ajaran" id="tahun_ajaran" class="selectpicker form-control tahun_ajaran form-select <?= ($validation->hasError('tahun_ajaran')) ? 'is-invalid' : ''; ?>" data-live-search="true">
                                            <?php foreach ($tahunajaran as $tahunajaran) : ?>
                                                <?php
                                                if ($jurusan['id_ajaran'] == $tahunajaran['id_ajaran']) {
                                                    $tahun1 = 'selected';
                                                } else {
                                                    $tahun1 = '';
                                                } ?>
                                                <option <?= $tahun1 ?> value="<?= $tahunajaran['id_ajaran']; ?>"><?= $tahunajaran['tahun_ajaran']; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('tahun_ajaran'); ?>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-success" type="submit">Simpan</button>
                                <button class="btn btn-danger" data-dismiss="modal">Batal</button>
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