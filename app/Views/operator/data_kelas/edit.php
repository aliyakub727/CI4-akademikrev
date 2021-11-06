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
                    <form id="form" action="<?= base_url(); ?>/operator/saveeditkelas" method="post">
                        <input type="hidden" value="<?= $kelas['id_kelas']; ?>" name="id_kelas" id="id_kelas">
                        <div class="card">
                            <div class="card-header">
                                Data Kelas
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Kelas</label>
                                    <input type="text" value=" <?= (old('nama_kelas') ? old('nama_kelas') : $kelas['nama_kelas']); ?>" class="form-control <?= ($validation->hasError('nama_kelas')) ? 'is-invalid' : ''; ?>" name="nama_kelas" id="nama_kelas">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('nama_kelas'); ?>
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
<!-- End of Content Wrapper -->
<?= $this->endsection(); ?>