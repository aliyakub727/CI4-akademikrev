<?= $this->extend('template/templateadmin'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <?= $this->include('template/topbar'); ?>


        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="card">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-3 mt-4 ml-4">
                    <h1 class="h3 mb-0 text-gray-800">Data Fasilitas</h1>
                </div>
                <hr>
                <div class="container mb-4">
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col">
                            <?php if (session()->getFlashdata('Pesan')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session()->getFlashdata('Pesan'); ?>
                                </div>
                            <?php endif; ?>
                            <a href="<?= base_url(); ?>/admin/tambahfasilitas" class="btn btn-primary mb-4">Tambah Fasilitas</a>
                            <table class="table table-striped" id="data-list">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Fasilitas</th>
                                        <th scope="col">Deskripsi</th>
                                        <th scope="col">Gambar</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($fasilitas as $k) : ?>
                                        <tr>
                                            <th scope="row"><?= $i++; ?></th>
                                            <td><?= $k['fasilitas']; ?></td>
                                            <td><?= $k['deskripsi']; ?></td>
                                            <td><img width="100px" align="center" class="img-thumbnail" src="<?= base_url() . "/img/fasilitas/" . $k['gambar']; ?>"></td>
                                            <td> <a class="btn btn-primary mb-4 fa fa-edit" href="<?= base_url(); ?>/admin/ubahfasilitas/<?php echo $k['id'] ?>"></a></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->
<!-- End of Content Wrapper -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
    $('#data-list').DataTable();
</script>
<?= $this->endsection(); ?>