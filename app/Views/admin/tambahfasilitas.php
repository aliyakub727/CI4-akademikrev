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
                    <form id="form" action="<?= base_url(); ?>/admin/savefasilitas" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="form-group">
                            <label>Fasilitas</label>
                            <input type="text" class="form-control" name="fasilitas" id="fasilitas" required>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <input type="text" class="form-control" name="deskripsi" id="deskripsi" required>
                        </div>
                        <div class="form-group">
                            <label>Gambar</label>
                            <input type="file" class="form-control" name="gambar" id="gambar">
                        </div>
                        <button class="btn btn-success" type="submit">Ubah Data</button>
                        <button class="btn btn-danger" data-dismiss="modal">Close</button>
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