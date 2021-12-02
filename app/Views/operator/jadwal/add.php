<?= $this->extend('template/templateadmin'); ?>
<?= $this->section('content'); ?>

<head>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
                    <div class="card">
                        <div class="card-header">
                            Data Mapel
                        </div>
                        <div class="card-body">
                            <form id="form" action="<?= base_url(); ?>/operator/savetahunajaran" method="post">
                                <?= csrf_field(); ?>
                                <div class="form-group">
                                    <label>Tahun Ajaran</label>
                                    <input type="text" class="form-control" name="tahun_ajaran" id="tahun_ajaran" required>
                                </div>
                                <label>Kelas</label>
                                <select name="kelas" id="kelas" class="selectpicker form-control select2 form-select " data-live-search="true">
                                    <option selected value="">---</option>
                                    <?php foreach ($kelas as $kelas) : ?>
                                        <option value="<?= $kelas['id_kelas']; ?>"><?= $kelas['nama_kelas']; ?></option>
                                    <?php endforeach ?>
                                </select>
                                <label>Mapel</label>
                                <select name="mapel" id="mapel" class="selectpicker form-control form-select " data-live-search="true">


                                </select>
                                <button class="btn btn-success" type="submit">Tambah</button>
                                <button class="btn btn-danger" data-dismiss="modal">Close</button>
                            </form>
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


<script>
    $("#kelas").change(function() {

        // variabel dari nilai combo box kelas
        var id_kelas = $("#kelas").val();

        // Menggunakan ajax untuk mengirim dan dan menerima data dari server
        $.ajax({
            url: "<?php echo base_url(); ?>/Operator/getkelas",
            method: "POST",
            data: {
                id_kelas: id_kelas
            },
            async: false,
            dataType: 'json',
            success: function(data) {
                var html = '';
                var i;

                for (i = 0; i < data.length; i++) {
                    html += '<option value=' + data[i].id_mapel + '>' + data[i].nama_mapel + '</option>';
                }
                $('#mapel').html(html);

            }
        });
    });

    $("#merk").change(function() {

        // variabel dari nilai combo box kendaraan
        var id_merk = $("#merk").val();

        // Menggunakan ajax untuk mengirim dan dan menerima data dari server
        $.ajax({
            url: "<?php echo base_url(); ?>/kendaraan/get_tipe",
            method: "POST",
            data: {
                id_merk: id_merk
            },
            async: false,
            dataType: 'json',
            success: function(data) {
                var html = '';
                var i;

                for (i = 0; i < data.length; i++) {
                    html += '<option value=' + data[i].id_tipe_kendaraan + '>' + data[i].tipe_kendaraan + '</option>';
                }
                $('#tipe').html(html);

            }
        });
    });
</script>
<!-- End of Content Wrapper -->
<?= $this->endsection(); ?>