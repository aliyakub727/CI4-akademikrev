<?= $this->extend('template/templateadmin'); ?>
<?= $this->section('content'); ?>
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <?= $this->include('template/topbar'); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="card">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4" style="margin-left: 20px;margin-top: 20px">
                    <h1 class="h3 mb-0 text-gray-800" >Add Nilai</h1>
                </div>
                <hr>
                <div class="container">
                    <!-- Content Row -->                    
                    <div class="row">
                        <div class="col">       
                        <a class="btn btn-primary mb-4" href="<?= base_url(); ?>/NilaiController/create">Tambah  Nilai</a>                        
                            <?php if (session()->getFlashdata('Pesan')) : ?>
                            <div class="alert alert-success" role="alert">
                                <?= session()->getFlashdata('Pesan'); ?>
                            </div>
                            
                        <?php endif; ?>
                        <table class="table table-hover" id="users-list">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Mapel</th>
                                    <th scope="col">Nama Kelas</th>                   
                                    <th scope="col">Jurusan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($nilai as $k) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><?= $k['nama_mapel']; ?></td>
                                        <td><?= $k['nama_kelas']; ?></td>
                                        <td><?= $k['jurusan']; ?></td>
                                        <td>
                                            <a href="<?= base_url("/NilaiController/edit/".$k['id_nilai'])?>" class="btn btn-primary">Input Nilai</a>
                                            <a href="<?= base_url("/NilaiController/deletenilai/".$k['id_nilai'])?>" class="btn btn-primary">Delete Nilai</a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- tambah -->
            
        </div>
    </div>
</div>
</div>
<!-- End of Main Content -->

</div>
<script  src="https://www.jqueryscript.net/demo/DataTables-Jquery-Table-Plugin/media/js/jquery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.js"></script>
<script>
    $('#users-list').DataTable({
     
    });
<!-- End of Content Wrapper -->
<?= $this->endsection(); ?>