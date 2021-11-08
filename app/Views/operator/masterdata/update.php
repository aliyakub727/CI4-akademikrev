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

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Master Pelajaran</h1>
            </div>

            <div class="container">
                <!-- Content Row -->
                <form id="form" action="<?= base_url(); ?>/Masterdata/update" method="post">
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3 row">
                        <label class="col-sm-4">Tahun Ajaran</label>
                        <div class="col-sm-8">
                            <select name="tahun_ajaran" id="tahun_ajaran" class="selectpicker form-control form-select" data-live-search="true">
                                <option selected>Pilih Tahun Ajaran</option>
                                <option value="2019-2020">2019-2020</option>
                                <option value="2020-2021">2020-2021</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-4">Nomer Induk Siswa (NIS) </label>
                        <div class="col-sm-8">
                            <select class="selectpicker nis form-control" data-live-search="true" name="nis" id="nis" onchange='changeValue(this.value)'>
                                <option readonly selected>Pilih nis</option>
                                <?php
                                $jsArray = "var prdName = new Array();\n";
                                foreach ($nis as $nis) {
                                    echo '<option name="nis"  value="' . $nis['nis'] . '">' . $nis['nis'] . '</option>';
                                    $jsArray .= "prdName['" . $nis['nis'] . "'] = {nama_lengkap:'" . addslashes($nis['nama_lengkap']) . "'};\n";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-4">Nama Lengkap</label>
                        <div class="col-sm-8">
                            <input type="text" readonly class="form-control nama_lengkap" name="nama_lengkap" id="nama_lengkap" required="">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-4">Kelas</label>
                        <div class="col-sm-8">
                            <select class="selectpicker kelas form-control" data-live-search="true" name="kelas" id="kelas">
                                <option readonly selected>Pilih kelas</option>
                                <?php foreach ($kelas as $kelas) : ?>
                                    <option value="<?= $kelas['kelas']; ?>"><?= $kelas['kelas']; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-4">Jurusan</label>
                        <div class="col-sm-8">
                            <select class="selectpicker jurusan form-control" data-live-search="true" name="jurusan" id="jurusan">
                                <option readonly selected>Pilih jurusan</option>
                                <?php foreach ($jurusan as $jur) : ?>
                                    <option value="<?= $jur['jurusan']; ?>"><?= $jur['jurusan']; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-4">Nama Wali Kelas</label>
                        <div class="col-sm-8">
                            <select class="selectpicker nama_walikelas form-control" data-live-search="true" name="nama_walikelas" id="nama_walikelas">
                                <option readonly selected>Pilih nama walikelas</option>
                                <?php foreach ($guru as $guru) : ?>
                                    <option value="<?= $guru['nama_guru']; ?>"><?= $guru['nama_guru']; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-success fa fa-check-square fa-2x" type="submit"></button>
                    <a href="<?= base_url(); ?>/Masterdata/index" class="btn btn-danger fa fa-window-close fa-2x"></a>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
    <?php echo $jsArray; ?>

    function changeValue(nis) {
        document.getElementById('nama_lengkap').value = prdName[nis].nama_lengkap;
    };

    $('.nis').selectpicker();
    $('.tahun_ajaran').selectpicker();
    $('.kelas').selectpicker();
    $('.jurusan').selectpicker();
    $('.wali_kelas').selectpicker();
</script>
<!-- End of Content Wrapper -->
<?= $this->endsection(); ?>