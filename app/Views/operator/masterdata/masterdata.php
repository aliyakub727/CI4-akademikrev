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
                    <h1 class="h3 mb-0 text-gray-800">Masterdata Pelajaran</h1>
                </div>
                <hr>
                <div class="container mb-5">
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col">
                            <a class="btn btn-primary mb-4" href="/operator/tambahmasterdatapelajaran">Tambah Siswa</a>
                            <?php if (session()->getFlashdata('Pesan')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session()->getFlashdata('Pesan'); ?>
                                </div>
                            <?php endif; ?>
                            <table class="table table-hover" id="users-list">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tahun Ajaran</th>
                                        <th scope="col">Nomer Induk Siswa</th>
                                        <th scope="col">Nama Lengkap</th>
                                        <th scope="col">Kelas</th>
                                        <th scope="col">Jurusan</th>
                                        <th scope="col">Nama Wali Kelas</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($masterdata as $k) : ?>
                                        <tr>
                                            <th scope="row"><?= $i++; ?></th>
                                            <td><?= $k['tahun_ajaran']; ?></td>
                                            <td><?= $k['nis']; ?></td>
                                            <td><?= $k['nama_lengkap']; ?></td>
                                            <td><?= $k['nama_kelas']; ?></td>
                                            <td><?= $k['jurusan']; ?></td>
                                            <td><?= $k['nama_guru']; ?></td>
                                            <td>
                                                <a href="<?= base_url(); ?>/operator/editmasterdatapelajaran/<?= $k['id_master']; ?>" style="color:#ffffff" class="btn btn-primary  btn-edit fa fa-edit "></a>
                                                <a class="btn btn-danger btn-delete fa fa-trash" data-id="<?= $k['id_master']; ?>"></a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <!-- Delete -->

                <form action="/operator/deletemasterdatapelajaran" method="post">
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <h4>Are you sure want to delete this Data?</h4>

                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="id" class="id">
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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.js"></script>
<script>
    $('#users-list').DataTable();
    $('.nis').selectpicker('click', function() {
        const nama = $(this).data('nama');
        $('#nama_lengkap').val(nama);
    });


    $(document).ready(function() {
        $('.btn-edit').on('click', function() {

            // get data from button edit
            const id = $(this).data('id');
            const tahun_ajaran = $(this).data('tahun_ajaran');
            const nis = $(this).data('nis');
            const nama_lengkap = $(this).data('nama_lengkap');
            const kelas = $(this).data('kelas');
            const jurusan = $(this).data('jurusan');
            const nama_walikelas = $(this).data('nama_walikelas');

            // Set data to Form Edit
            $('.id').val(id);
            $('.tahun_ajaran').val(tahun_ajaran);
            $('.nis').val(nis);
            $('.nama_lengkap').val(nama_lengkap);
            $('.kelas').val(kelas);
            $('.jurusan').val(jurusan);
            $('.nama_walikelas').val(nama_walikelas);

            // Call Modal Edit
            $('#editModal').modal('show');
        });

        $('.btn-delete').on('click', function() {

            // get data from button edit
            const id = $(this).data('id');

            // Set data to Form Edit
            $('.id').val(id);

            // Call Modal Edit
            $('#deleteModal').modal('show');
        });
    });
</script>
<!-- End of Content Wrapper -->
<?= $this->endsection(); ?>