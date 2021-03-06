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
                    <form id="form" action="<?= base_url(); ?>/admin/ubahdatapage" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <input type="hidden" value="<?php echo $landing_page['background']; ?>" name="gambarlama">
                        <input type="hidden" name="id" value="<?php echo $landing_page['id']; ?>" required>
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title" id="title" value="<?php echo $landing_page['title']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" class="form-control" name="judul" id="judul" value="<?php echo $landing_page['judul']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Isi</label>
                            <input type="text" class="form-control" name="isi" id="isi" value="<?php echo $landing_page['isi']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Background</label>
                            <input type="file" class="form-control" name="background" id="background">
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