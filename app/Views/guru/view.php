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
                    <h1 class="h3 mb-0 text-gray-800" >Pilih </h1>
                </div>
                <hr>
                <div class="row">
                <?php foreach ($guru as $k) : ?>
                <div class="card" style="width:300px;margin-left:20px;margin-bottom:20px">
                <img class="card-img-top" src="img/1636196138_5cb325b66637ae325e6d.jpg" alt="Card image">
                <div class="card-body">
                    <h4 class="card-title"><?= $k['id_mapel']; ?></h4>
                    <p class="card-text"><?=$k['id_mapel'];?></p>
                    <a href="<?= base_url(); ?>/Guru/guru/<?=$k['id_mapel'];?>" class="btn btn-primary">INPUT</a>
                </div>
                </div>
                <?php endforeach ?>
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
<!-- End of Content Wrapper -->
<?= $this->endsection(); ?>