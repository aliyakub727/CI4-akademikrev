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
                    <div class="row">
                        <div class="col">
                            <a class="btn btn-primary mb-4" href="/guru/tambah">Input Nilai</a>         
                            <?php if (session()->getFlashdata('Pesan')) : ?>
                            <div class="alert alert-success" role="alert">
                                <?= session()->getFlashdata('Pesan'); ?>
                            </div>
                        <?php endif; ?>
                        <table class="table table-hover" id="users-list">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nomer Induk Siswa</th>
                                    <th scope="col">Nama Lengkap</th>                   
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Jurusan</th>
                                    <th scope="col">Tahun Ajaran</th>
                                    <th scope="col">Nama Guru</th>
                                    <th scope="col">Tugas</th>
                                    <th scope="col">UTS</th>
                                    <th scope="col">UAS</th>  
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($nilai as $k) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><?= $k['nis']; ?></td>
                                        <td><?= $k['nama_lengkap']; ?></td>
                                        <td><?= $k['nama_kelas']; ?></td>
                                        <td><?= $k['jurusan']; ?></td>
                                        <td><?= $k['tahun_ajaran']; ?></td>
                                        <td><?= $k['nama_guru']; ?></td>
                                        <td><input type="numeric" size="5" id="row-tugas" name="rowtugas"></td>
                                        <td><input type="numeric" size="5" id="row-uts" name="rowuts"></td>
                                        <td><input type="numeric" size="5" id="row-uas" name="rowuas"></td>
                                        <td>
                                            <a href="<?= base_url(); ?>/guru/saveguru<?= $k['id_nilai']; ?>" style="color:#ffffff" class="btn btn-primary  btn-edit fa fa-save "></a>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.js"></script>
<script>
    $('#users-list').DataTable();
    $('.nis').selectpicker('click', function() {
        const nama = $(this).data('nama');
        $('#nama_lengkap').val(nama);
    });


</script>
<!-- End of Content Wrapper -->
<?= $this->endsection(); ?>