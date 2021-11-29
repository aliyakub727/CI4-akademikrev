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
                    <h1 class="h3 mb-0 text-gray-800">Data Jadwal</h1>
                </div>
                <hr>


                <div class="container">
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col">
                            <a class="btn btn-primary mb-4" href="<?= base_url(); ?>/operator/tambahjadwal">Tambah</a>

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
                                            <th scope="col">Kelas</th>
                                            <th scope="col">Nama Guru</th>
                                            <th scope="col">Mapel</th>
                                            <th scope="col">Hari</th>
                                            <th scope="col">Jam Mulai</th>
                                            <th scope="col">Jam Selesai</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($jadwal as $k) : ?>
                                            <tr>
                                                <th scope="row"><?= $i++; ?></th>
                                                <td><?= $k['nama_kelas']; ?></td>
                                                <td><?= $k['nama_guru']; ?></td>
                                                <td><?= $k['nama_mapel']; ?></td>
                                                <td><?= $k['hari']; ?></td>
                                                <td><?= $k['jam_mulai']; ?></td>
                                                <td><?= $k['jam_selesai']; ?></td>
                                                <td>
                                                    <a href="<?= base_url(); ?>/operator/editguru/<?= $k['id_jadwal']; ?>" style="color:#ffffff" class="btn btn-primary   fa fa-edit "></a>
                                                    <a href="#" style="color:#ffffff;padding-top:6px;size: 2px" class="btn btn-danger btn-delete fa fa-trash " data-id_jadwal="<?= $k['id_jadwal'] ?>"></a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Data Guru</h5>
                                <button class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="form" action="<?= base_url(); ?>/Guru/updateguru" method="post">

                                    <button class="btn btn-success" type="submit">Tambah</button>
                                    <button class="btn btn-danger" data-dismiss="modal">Close</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="/operator/deleteguru" method="post">
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
                                    <input type="hidden" name="id_guru" class="id_guru">
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
            const id_guru = $(this).data('id_guru');
            const id_mapel = $(this).data('id_mapel');
            const nama_guru = $(this).data('nama_guru');
            const alamat = $(this).data('alamat');
            const no_telp = $(this).data('no_telp');
            // Set data to Form Edit
            $('.id_guru').val(id_guru);
            $('.id_mapel').val(id_mapel);
            $('.nama_guru').val(nama_guru);
            $('.alamat').val(alamat);
            $('.no_telp').val(no_telp);

            // Call Modal Edit
            $('#editModal').modal('show');
        });
        $('.btn-delete').on('click', function() {
            // get data from button edit
            const id_guru = $(this).data('id_guru');
            // Set data to Form Edit
            $('.id_guru').val(id_guru);
            // Call Modal Edit
            $('#deleteModal').modal('show');
        });
    });
</script>
<!-- End of Content Wrapper -->
<?= $this->endsection(); ?>