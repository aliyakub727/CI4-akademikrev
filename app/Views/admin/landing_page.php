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
                <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-4 ml-4">
                    <h1 class="h3 mb-0 text-gray-800">Data Landing Page</h1>
                </div>
                <hr>
                <div class="container mb-3">
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col">
                            <a class="btn btn-primary mb-4" href="<?= base_url(); ?>/admin/ubahpage/1">Ubah Data</a>
                            <?php if (session()->getFlashdata('Pesan')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session()->getFlashdata('Pesan'); ?>
                                </div>
                            <?php endif; ?>
                            <table class="table table-striped" id="data-list">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">Isi</th>
                                        <th scope="col">Background</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($landing_page as $k) : ?>
                                        <tr>
                                            <th scope="row"><?= $i++; ?></th>
                                            <td><?= $k['title']; ?></td>
                                            <td><?= $k['judul']; ?></td>
                                            <td><?= $k['isi']; ?></td>
                                            <td><img width="100px" align="center" class="img-thumbnail" src="<?= base_url() . "/img/landingpage/" . $k['background']; ?>"></td>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
    $('#data-list').DataTable();
</script>
<!-- End of Main Content -->
<!-- End of Content Wrapper -->
<?= $this->endsection(); ?>