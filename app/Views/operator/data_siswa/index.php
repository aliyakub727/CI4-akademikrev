<?= $this->extend('template/templateadmin'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper -->

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <?= $this->include('template/topbar'); ?>


        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="card">
                <div class="d-sm-flex align-items-center justify-content-between mb-4" style="margin-left: 20px;margin-top: 20px">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800" style="font-family: 'Annie Use Your Telescope', cursive;
font-family: 'Holtwood One SC', serif; ">Data Siswa</h1>
                    </div>
                </div>
                <hr>

                <div class="container">
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col">
                            <a class="btn btn-primary mb-4" href="<?= base_url(); ?>/operator/tambahsiswa">Tambah Siswa</a>
                            <?php if (session()->getFlashdata('Pesan')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session()->getFlashdata('Pesan'); ?>
                                </div>
                            <?php endif; ?>
                            <div style="padding-right: 20px;padding-left: 20px;padding-bottom: 50px">
                                <table class="table table-striped" id="data-list">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nomer Induk Siswa</th>
                                            <th scope="col">Nama Lengkap</th>
                                            <th scope="col">Jenis Kelamin</th>
                                            <th scope="col">Jurusan</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($siswa as $k) : ?>
                                            <tr>
                                                <th scope="row"><?= $i++; ?></th>
                                                <td><?= $k['nis']; ?></td>
                                                <td><?= $k['nama_lengkap']; ?></td>
                                                <td><?= $k['jenis_kelamin']; ?></td>
                                                <td><?= $k['jurusan']; ?></td>
                                                <td>
                                                    <a href="<?= base_url(); ?>/operator/editsiswa" style="color:#ffffff" class="btn btn-primary  btn-edit fa fa-edit "></a>
                                                    <a href="<?= base_url(); ?>/operator/hapussiswa" style="color:#ffffff;padding-top:6px;size: 2px" class="btn btn-danger btn-delete fa fa-trash "></a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- tambah -->
                    <div class=" modal fade" id="modal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Data Siswa</h5>
                                    <button class="close" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="form" action="<?= base_url(); ?>/Siswa/tambahsiswa" method="post">
                                        <div class="form-group">
                                            <label>Nama Lengkap</label>
                                            <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <select class="form-select form-control" name="jenis_kelamin" id="jenis_kelamin">
                                                <option selected>Pilih Jenis Kelamin</option>
                                                <option value="Laki-Laki">Laki-Laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Nomer Induk Siswa (NIS) </label>
                                            <input type="text" name="nis" id="nis" class="form-control" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="5" required=""></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Nomor Telepon</label>
                                            <input type="tel" name="no_telp" pattern="^\d{12}$" title="12 numeric characters only" id="no_telp" class="form-control" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <input type="text" name="tgl_lahir" id="tgl_lahir" class="form-control" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Tempat Lahir</label>
                                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Agama</label>
                                            <select class="form-select form-control" name="agama" id="agama" required="">
                                                <option selected>Pilih Agama</option>
                                                <option value="Islam">Islam</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Kristen">Kristen</option>
                                                <option value="Budha">Budha</option>
                                                <option value="Konghucu">Konghucu</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Orangtua</label>
                                            <input type="text" name="nama_orangtua" id="nama_orangtua" class="form-control" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat Orangtua</label>
                                            <textarea class="form-control" name="alamat_orangtua" id="alamat_orangtua" cols="30" rows="5" required=""></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>NO Telp Orangtua</label>
                                            <input type="tel" name="no_telp_orangtua" pattern="^\d{12}$" title="12 numeric characters only" id="no_telp_orangtua" class="form-control" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Jurusan</label>
                                            <select class="form-select form-control" name="jurusan" id="jurusan">
                                                <option selected>Pilih jurusan</option>
                                                <option value="Teknik Komputer Jaringan">Teknik Komputer Jaringan (TKJ)</option>
                                                <option value="Akuntansi">Akuntansi (AK)</option>
                                                <option value="Administrasi Perkantoran">Administrasi Perkantoran (AP)</option>
                                                <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak (RPL)</option>
                                                <option value="Multimedia">Multimedia (MM)</option>
                                            </select>
                                        </div>
                                        <button class="btn btn-success" type="submit">Tambah</button>
                                        <button class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- update -->


                    <form id="form" action="<?= base_url(); ?>/Siswa/updatesiswa" method="post">
                        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ubah Data Siswa</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <input type="hidden" name="id" id="id">

                                        <div class="form-group">
                                            <label>Nama Lengkap</label>
                                            <input type="text" class="form-control nama_lengkap" name="nama_lengkap" id="nama_lengkap" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <select class="form-select form-control jenis_kelamin" name="jenis_kelamin" id="jenis_kelamin" required="">
                                                <option selected>Pilih Jenis Kelamin</option>
                                                <option value="Laki-Laki">Laki-Laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Nomer Induk Siswa (NIS) </label>
                                            <input type="text" name="nis" id="nis" class="form-control nis" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea class="form-control alamat" name="alamat" id="alamat" cols="30" rows="5" required=""></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Nomor Telepon</label>
                                            <input type="tel" name="no_telp" pattern="^\d{12}$" title="12 numeric characters only" id="no_telp" class="form-control" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <input type="text" name="tgl_lahir" id="tgl_lahir" class="form-control tgl_lahir" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Tempat Lahir</label>
                                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control tempat_lahir" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Agama</label>
                                            <select class="form-select form-control agama" name="agama" id="agama" required="">
                                                <option selected>Pilih Agama</option>
                                                <option value="Islam">Islam</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Kristen">Kristen</option>
                                                <option value="Budha">Budha</option>
                                                <option value="Konghucu">Konghucu</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Orangtua</label>
                                            <input type="text" name="nama_orangtua" id="nama_orangtua" class="form-control nama_orangtua" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat Orangtua</label>
                                            <textarea class="form-control alamat_orangtua" name="alamat_orangtua" id="alamat_orangtua" cols="30" rows="5" required=""></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>NO Telp Orangtua</label>
                                            <input type="tel" name="no_telp_orangtua" pattern="^\d{12}$" title="12 numeric characters only" id="no_telp_orangtua" class="form-control" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Jurusan</label>
                                            <select class="form-select form-control jurusan" name="jurusan" id="jurusan" required="">
                                                <option selected>Pilih jurusan</option>
                                                <option value="Teknik Komputer Jaringan">Teknik Komputer Jaringan (TKJ)</option>
                                                <option value="Akuntansi">Akuntansi (AK)</option>
                                                <option value="Administrasi Perkantoran">Administrasi Perkantoran (AP)</option>
                                                <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak (RPL)</option>
                                                <option value="Multimedia">Multimedia (MM)</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="id" class="id">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Data Siswa</h5>
                                    <button class="close" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="form" action="<?= base_url(); ?>/Siswa/updatesiswa" method="post">

                                        <button class="btn btn-success" type="submit">Tambah</button>
                                        <button class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="/Siswa/deletesiswa" method="post">
                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete Siswa</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <h4>Are you sure want to delete this Data Siswa?</h4>

                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="id" class="siswaid">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                        <button type="submit" class="btn btn-primary">Yes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Main Content -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
    $('#data-list').DataTable();
    $("#tgl_lahir").datepicker({
        dateFormat: "yy-mm-dd"
    });

    $(document).ready(function() {
        $('.btn-edit').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const nama_lengkap = $(this).data('nama_lengkap');
            const jenis_kelamin = $(this).data('jenis_kelamin');
            const nis = $(this).data('nis');
            const alamat = $(this).data('alamat');
            const no_telp = $(this).data('no_telp');
            const tgl_lahir = $(this).data('tgl_lahir');
            const tempat_lahir = $(this).data('tempat_lahir');
            const agama = $(this).data('agama');
            const nama_orangtua = $(this).data('nama_orangtua');
            const alamat_orangtua = $(this).data('alamat_orangtua');
            const no_telp_orangtua = $(this).data('no_telp_orangtua');
            const jurusan = $(this).data('jurusan');
            // Set data to Form Edit
            $('.id').val(id);
            $('.nama_lengkap').val(nama_lengkap);
            $('.jenis_kelamin').val(jenis_kelamin);
            $('.nis').val(nis);
            $('.alamat').val(alamat);
            $('.no_telp').val(no_telp);
            $('.tgl_lahir').val(tgl_lahir);
            $('.tempat_lahir').val(tempat_lahir);
            $('.agama').val(agama);
            $('.nama_orangtua').val(nama_orangtua);
            $('.alamat_orangtua').val(alamat_orangtua);
            $('.no_telp_orangtua').val(no_telp_orangtua);
            $('.jurusan').val(jurusan);



            // Call Modal Edit
            $('#editModal').modal('show');
        });
        $('.btn-delete').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            // Set data to Form Edit
            $('.siswaid').val(id);
            // Call Modal Edit
            $('#deleteModal').modal('show');
        });


    });
    $(document).ready(function() {
        $('#data-siswa').DataTable();
    });
</script>
<!-- End of Content Wrapper -->
<?= $this->endsection(); ?>