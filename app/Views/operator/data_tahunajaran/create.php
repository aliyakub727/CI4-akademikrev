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
                            Data Mapel
                        </div>
                        <div class="card-body">
                            <form id="form" action="<?= base_url(); ?>/operator/savetahunajaran" method="post">
                                <div class="form-group">
                                    <label>Tahun Ajaran</label>
                                    <input type="text" class="form-control" name="tahun_ajaran" id="tahun_ajaran" required>
                                </div>
                                <select name="id_jurusan" id="id_jurusan" class="selectpicker form-control form-select <?= ($validation->hasError('id_jurusan')) ? 'is-invalid' : ''; ?>" data-live-search="true">
                                    <label>ID Jurusan</label>
                                    <option selected value="">Pilih id Jurusan</option>
                                    <?php foreach ($jurusan as $ak) : ?>
                                        <option value="<?= $ak['id_jurusan']; ?>"><?= $ak['jurusan']; ?></option>
                                    <?php endforeach ?>
                                </select>
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