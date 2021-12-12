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
                    <h1 class="h3 mb-0 text-gray-800" >Input Nilai</h1>
                </div>
                <hr>


                <div class="container">
                    <!-- Content Row -->
                        <table class="table table-hover" id="users-list">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Lengkap</th>                   
                                    <th scope="col">Sakit</th>
                                    <th scope="col">Izin</th>
                                    <th scope="col">Alpha</th> 
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($absen as $k) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><?= $k['nama_lengkap']; ?></td>
                                        <td><input type="numeric" size="5" id="row-sakit<?= $k['id_detail_absen']?>" name="rowsakit" value="<?= $k['sakit']; ?>"></td>
                                        <td><input type="numeric" size="5" id="row-izin<?= $k['id_detail_absen']?>" name="rowizin" value="<?= $k['izin']; ?>"></td>
                                        <td><input type="numeric" size="5" id="row-alpha<?= $k['id_detail_absen']?>" name="rowalpha" value="<?= $k['alpha']; ?>"></td>
                                        <td>
                                            <button type="button"  style="color:#ffffff" class="btn btn-primary  btn-edit fa fa-save btn-save " id="<?= $k['id_detail_absen']; ?>"></button>
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
        var sakit = $("#row-sakit"+id).val();
        var izin = $("#row-izin"+id).val();
        var alpha = $("#row-alpha"+id).val();
        console.log(id,sakit,izin,alpha);      
        $.ajax({
            type:'POST',
            url:'<?= base_url("/NilaiController/saveabsen"); ?>',
            data:{
                'id': id,
                'sakit': sakit,
                'izin': izin,
                'alpha': alpha,
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