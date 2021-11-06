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
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Data Landing Page</h1>
            </div>

            <div class="container">
                <!-- Content Row -->
                <div class="row">
                    <div class="col">
                        <?php if (session()->getFlashdata('Pesan')) : ?>
                            <div class="alert alert-success" role="alert">
                                <?= session()->getFlashdata('Pesan'); ?>
                            </div>
                        <?php endif; ?>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($slider as $k) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><?= $k['title']; ?></td>
                                        <td><?= $k['deskripsi']; ?></td>
                                        <td><img width="100px" align="center" class="img-thumbnail" src="<?= base_url() . "/img/".$k['gambar_slider'];?>"></td>
                                    <td> <a class="btn btn-primary mb-4 fa fa-edit" href="<?= base_url(); ?>/admin/ubahslider/<?php  echo $k['id_slider']?>"></a></td>
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
<!-- End of Main Content -->
<!-- End of Content Wrapper -->
<?= $this->endsection(); ?>