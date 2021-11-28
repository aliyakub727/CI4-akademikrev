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
            <div class="card">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4" style="margin-left: 20px;margin-top: 20px">
                    <h1 class="h3 mb-0 text-gray-800">Master Pelajaran</h1>
                </div>
                <hr>

                <div class="container mb-3">
                    <!-- Content Row -->
                    <form id="form" action="<?= base_url(); ?>/operator/saveeditmasterdatapelajaran" method="post">
                        <input type="hidden" value="<?= $masterdata['id_master'] ?>" name="id_master" id="id_master">
                        <div class="mb-3 row">
                            <label class="col-sm-4">Tahun Ajaran</label>
                            <div class="col-sm-8">
                                <select name="tahun_ajaran" id="tahun_ajaran" class="selectpicker form-control tahun_ajaran form-select <?= ($validation->hasError('tahun_ajaran')) ? 'is-invalid' : ''; ?>" data-live-search="true">
                                    <?php foreach ($tahunajaran as $tahunajaran) : ?>
                                        <?php
                                        if ($masterdata['id_ajaran'] == $tahunajaran['id_ajaran']) {
                                            $tahun1 = 'selected';
                                        } else {
                                            $tahun1 = '';
                                        } ?>
                                        <option <?= $tahun1 ?> value="<?= $tahunajaran['id_ajaran']; ?>"><?= $tahunajaran['tahun_ajaran']; ?></option>
                                    <?php endforeach ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('tahun_ajaran'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4">Nomer Induk Siswa (NIS) </label>
                            <div class="col-sm-8">
                                <select class="selectpicker nis form-control <?= ($validation->hasError('id')) ? 'is-invalid' : ''; ?>" data-live-search="true" name="id" id="id" onchange='changeValue(this.value)'>
                                    <?php
                                    $jsArray = "var prdName = new Array();\n";
                                    foreach ($nis as $nis) {
                                        if ($masterdata['id_siswa'] == $nis['id']) {
                                            $nis1 = 'selected';
                                        } else {
                                            $nis1 = '';
                                        }
                                        echo '<option ' . $nis1 . ' name="id"  value="' . $nis['id'] . '">' . $nis['nis'] . '</option>';
                                        $jsArray .= "prdName['" . $nis['id'] . "'] = {nama_lengkap:'" . addslashes($nis['nama_lengkap']) . "'};\n";
                                    }
                                    ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('id'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4">Nama Lengkap</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control nama_lengkap" value="<?= (old('nama_lengkap') ? old('nama_lengkap') : $masterdata['nama_lengkap']); ?>" name="nama_lengkap" id="nama_lengkap" required="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4">Kelas</label>
                            <div class="col-sm-8">
                                <select class="selectpicker kelas form-control <?= ($validation->hasError('kelas')) ? 'is-invalid' : ''; ?>" data-live-search="true" name="kelas" id="kelas">
                                    <?php foreach ($kelas as $kelas) : ?>
                                        <?php
                                        if ($masterdata['id_kelas'] == $kelas['id_kelas']) {
                                            $kelas1 = 'selected';
                                        } else {
                                            $kelas1 = '';
                                        } ?>
                                        <option <?= $kelas1 ?> value="<?= $kelas['id_kelas']; ?>"><?= $kelas['nama_kelas']; ?></option>
                                    <?php endforeach ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('kelas'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4">Jurusan</label>
                            <div class="col-sm-8">
                                <select class="selectpicker jurusan form-control <?= ($validation->hasError('jurusan')) ? 'is-invalid' : ''; ?>" data-live-search="true" name="jurusan" id="jurusan">
                                    <?php foreach ($jurusan as $jur) : ?>
                                        <?php
                                        if ($masterdata['id_jurusan'] == $jur['id_jurusan']) {
                                            $jur1 = 'selected';
                                        } else {
                                            $jur1 = '';
                                        } ?>
                                        <option <?= $jur1 ?> value="<?= $jur['id_jurusan']; ?>"><?= $jur['jurusan']; ?></option>
                                    <?php endforeach ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('jurusan'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4">Nama Wali Kelas</label>
                            <div class="col-sm-8">
                                <select class="selectpicker nama_walikelas form-control <?= ($validation->hasError('nama_walikelas')) ? 'is-invalid' : ''; ?>" data-live-search="true" name="nama_walikelas" id="nama_walikelas">
                                    <?php foreach ($guru as $guru) : ?>
                                        <?php
                                        if ($masterdata['id_guru'] == $guru['id_guru']) {
                                            $guru1 = 'selected';
                                        } else {
                                            $guru1 = '';
                                        } ?>
                                        <option <?= $guru1 ?> value="<?= $guru['id_guru']; ?>"><?= $guru['nama_guru']; ?></option>
                                    <?php endforeach ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('nama_walikelas'); ?>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-success fa fa-check-square fa-2x" type="submit"></button>
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