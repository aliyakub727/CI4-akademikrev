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
                    <form id="form" action="<?= base_url(); ?>/NilaiController/saveabsensiswa" method="post">
                        <?= csrf_field(); ?>
                        <div class="card mt-3 mb-5">
                            <div class="card-header">
                                Tambah Data Nilai
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <select name="bln">
                                            <option selected="selected">Bulan</option>
                                            <?php
                                            $bulan=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                                            $jlh_bln=count($bulan);
                                            for($c=0; $c<$jlh_bln; $c+=1){
                                                echo"<option value=$bulan[$c]> $bulan[$c] </option>";
                                            }
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Tahun</label>
                                            <input type="text" size="5" id="tahun" name="tahun">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                        <div class="col-6">
                                        <div class="form-group">
                                            <label>Kelas</label>
                                            <select name="id_kelas" id="id_kelas" class="selectpicker form-control form-select <?//= ($validation->hasError('id_kelas')) ? 'is-invalid' : ''; ?>" data-live-search="true">
                                                <option selected value="">Pilih Kelas</option>
                                                <?php foreach ($kelas as $ak) : ?>
                                                    <option value="<?= $ak['id_kelas']; ?>"><?= $ak['nama_kelas']; ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    </div>
                                </div> 
                                <button class="btn btn-success" type="submit">Tambah</button>
                                <button class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $("#tgl_lahir").datepicker({
        dateFormat: "yy-mm-dd"
    });
</script>
<!-- End of Content Wrapper -->
<?= $this->endsection(); ?>