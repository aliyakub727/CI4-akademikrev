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
                    <h1 class="h3 mb-0 text-gray-800" >Raport Nilai</h1>
                </div>
                <hr>
                <div class="container">
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col">                               
                            <?php if (session()->getFlashdata('Pesan')) : ?>
                            <div class="alert alert-success" role="alert">
                                <?= session()->getFlashdata('Pesan'); ?>
                            </div>
                            
                        <?php endif; ?>
                        <table class="table table-hover" id="users-list">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Siswa</th>
                                    <th scope="col">Tahun Ajaran</th>                   
                                    <th scope="col">Jurusan</th>
                                    <th scope="col">Nama Kelas</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($raport as $k) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><?= $k['nama_lengkap']; ?></td>
                                        <td><?= $k['tahun_ajaran']; ?></td>
                                        <td><?= $k['jurusan']; ?></td>
                                        <td><?= $k['nama_kelas']; ?></td>
                                        <td>
                                            <a href="<?= base_url("/NilaiController/printpdf/".$k['id_raport'])?>" class="btn btn-primary">SHOW RAPORT Detail</a>
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
    $(document).on('click', '.btn-save', function() {
        var id = $(this).attr("id");
        var tugas = $("#row-tugas").val();
        var uts = $("#row-uts").val();
        var uas = $("#row-uas").val();
        console.log(id,tugas,uts,uas);
       
        $.ajax({
            type:'POST',
            url:'<?= base_url("/Guru/savenilai"); ?>',
            data:{
                'id': id,
                'tugas': tugas,
                'uts': uts,
                'uas': uas,
            },
            success:function(data){
                console.log(data);
                alert(data);
            },
            error:function(data){
                console.log("error");
                console.log(data);
            },
        });        
    });

    $('.nis').selectpicker('click', function() {
        const nama = $(this).data('nama');
        $('#nama_lengkap').val(nama);
    });

    

</script>
<!-- End of Content Wrapper -->
<?= $this->endsection(); ?>