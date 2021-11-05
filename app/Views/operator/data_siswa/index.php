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
                                                    <a href="<?= base_url(); ?>/operator/editsiswa/<?= $k['id']; ?>" style="color:#ffffff" class="btn btn-primary fa fa-edit "></a>
                                                    <a data-id="<?= $k['id'] ?>" style="color:#ffffff;padding-top:6px;size: 2px" class="btn btn-delete btn-danger fa fa-trash "></a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <form action="/operator/deletesiswa" method="post">
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