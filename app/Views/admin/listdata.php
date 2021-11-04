<?= $this->extend('template/templateadmin'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <?= $this->include('template/topbar'); ?>


        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Data Akun </h1>
            </div>

            <div class="container">
                <!-- Content Row -->
                <div class="row">
                    <div class="col">
                        <a class="btn btn-primary mb-4" href="<?= base_url(); ?>/acoount/createakun">Tambah Siswa</a>
                        <?php if (session()->getFlashdata('Pesan')) : ?>
                            <div class="alert alert-success" role="alert">
                                <?= session()->getFlashdata('Pesan'); ?>
                            </div>
                        <?php endif; ?>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($users as $k) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><?= $k['email']; ?></td>
                                        <td><?= $k['username']; ?></td>
                                        <td><?= $k['name']; ?></td>
                                        <td>
                                            <a href="<?= base_url(); ?>/acoount/editakun/<?= $k['userid']; ?>" class="btn btn-info btn-sm btn-edit">Edit</a>
                                            <a href="<?= base_url(); ?>/acoount/deleteakun/<?= $k['userid']; ?>" class="btn btn-danger btn-sm btn-delete">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- update -->


                <form action="/product/update" method="post">
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input type="text" class="form-control nama_lengkap" name="nama_lengkap" id="nama_lengkap" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select class="form-select form-control jenis_kelamin" name="jenis_kelamin" id="jenis_kelamin">
                                            <option selected>Pilih Jenis Kelamin</option>
                                            <option value="Laki-Laki">Laki-Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Nomer Induk Siswa (NIS) </label>
                                        <input type="text" name="nis" id="nis" class="form-control nis">
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea class="form-control alamat" name="alamat" id="alamat" cols="30" rows="5"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor Telepon</label>
                                        <input type="text" name="no_telp" id="no_telp" class="form-control no_telp">
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                        <input type="text" name="tgl_lahir" id="tgl_lahir" class="form-control tgl_lahir">
                                    </div>
                                    <div class="form-group">
                                        <label>Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control tempat_lahir">
                                    </div>
                                    <div class="form-group">
                                        <label>Agama</label>
                                        <select class="form-select form-control agama" name="agama" id="agama">
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
                                        <input type="text" name="nama_orangtua" id="nama_orangtua" class="form-control nama_orangtua">
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat Orangtua</label>
                                        <textarea class="form-control alamat_orangtua" name="alamat_orangtua" id="alamat_orangtua" cols="30" rows="5"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>NO Telp Orangtua</label>
                                        <input type="text" name="no_telp_orangtua" id="no_telp_orangtua" class="form-control no_telp_orangtua">
                                    </div>
                                    <div class="form-group">
                                        <label>Jurusan</label>
                                        <select class="form-select form-control jurusan" name="jurusan" id="jurusan">
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
                                    <input type="hidden" name="product_id" class="product_id">
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
                                <form id="form" action="<?= base_url(); ?>/Siswa/edit_siswa" method="post">

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
</div>
<!-- End of Main Content -->

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $("#tgl_lahir").datepicker({
        dateFormat: "yy-mm-dd"
    });
    $(document).ready(function() {
        $('.btn-edit').on('click', function() {
            // get data from button edit
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
    });
</script>
<!-- End of Content Wrapper -->
<?= $this->endsection(); ?>