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
                            <form id="form" action="<?= base_url(); ?>/operator/savejadwal" method="post">
                                <?= csrf_field(); ?>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Kelas</label>
                                            <select name="kelas" id="kelas" class="select-picker form-control  form-select " data-live-search="true">
                                                <option selected value="">---</option>
                                                <?php foreach ($kelas as $kelas) : ?>
                                                    <option value="<?= $kelas['id_kelas']; ?>"><?= $kelas['nama_kelas']; ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Nama Guru</label>
                                            <input type="hidden" name="id_guru" id="id_guru">
                                            <input type="text" readonly class="form-control" name="nama_guru" id="nama_guru">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Mapel</label>
                                            <select name="mapel" id="mapel" class="select-picker form-control form-select " data-live-search="true">
                                                <option selected value="">---</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Hari</label>
                                            <select name="jadwal" id="jadwal" class="select-picker form-control form-select " data-live-search="true">
                                                <option selected value="">---</option>
                                                <option value="senin">Senin</option>
                                                <option value="selasa">Selasa</option>
                                                <option value="rabu">Rabu</option>
                                                <option value="kamis">Kamis</option>
                                                <option value="jumat">Jumat</option>
                                                <option value="Sabtu">Sabtu</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Jam Mulai</label>
                                            <input type="text" class="form-control" name="jam_mulai" id="jam_mulai">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Jam Selesai</label>
                                            <input type="text" class="form-control" name="jam_selesai" id="jam_selesai">
                                        </div>
                                    </div>
                                </div>
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
    $(document).ready(function() {
        $("#kelas").change(function() {

            // variabel dari nilai combo box kelas
            var id_kelas = $(this).val();

            // Menggunakan ajax untuk mengirim dan dan menerima data dari server
            $.ajax({
                method: "POST",
                url: "<?php echo base_url('Operator/getkelas'); ?>",
                data: {
                    id_kelas: id_kelas
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    // $('#mapel').html(data);
                    var html = '<option value="">---</option>';
                    var i;

                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].id_mapel + '>' + data[i].nama_mapel + '</option>';
                    }
                    $('#mapel').html(html);
                }
            });
        });
        $("#mapel").change(function() {

            // variabel dari nilai combo box kelas
            var id_mapel = $(this).val();

            // Menggunakan ajax untuk mengirim dan dan menerima data dari server
            $.ajax({
                method: "POST",
                url: "<?php echo base_url('Operator/getmapel'); ?>",
                data: {
                    id_mapel: id_mapel
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    // $('#mapel').html(data);
                    // var html = data.id_mapel;

                    $('#nama_guru').val(data['nama_guru']);
                    $('#id_guru').val(data['id_guru']);
                }
            });
        });
    });
</script>
<!-- End of Content Wrapper -->
<?= $this->endsection(); ?>