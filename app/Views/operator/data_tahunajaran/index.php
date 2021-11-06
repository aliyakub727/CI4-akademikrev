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
                <h1 class="h3 mb-0 text-gray-800">Tambah Data Tahun Ajaran</h1>
            </div>

            <div class="container">
                <!-- Content Row -->
                <div class="row">
                    <div class="col">
                        <a class="btn btn-primary mb-4" href="<?= base_url(); ?>/operator/tambahtahunajaran">Tambah Siswa</a>
                        <?php if (session()->getFlashdata('Pesan')) : ?>
                            <div class="alert alert-success" role="alert">
                                <?= session()->getFlashdata('Pesan'); ?>
                            </div>
                        <?php endif; ?>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ID JURUSAN</th>
                                    <th scope="col">TAHUN AJARAN</th>
                                    <th scope="col">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($tahun_ajaran as $k) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><?= $k['id_jurusan']; ?></td>
                                        <td><?= $k['tahun_ajaran']; ?></td>
                                        <td>
                                            <a href="<?= base_url(); ?>/operator/edittahunajaran/<?= $k['id_ajaran']; ?>" style="color:#ffffff" class="btn btn-primary  btn-edit fa fa-edit"></a>
                                            <a href="<?= base_url(); ?>/operator/deletedatatahunajaran/<?= $k['id_ajaran']; ?>" style="color:#ffffff;padding-top:6px;size: 2px" class="btn btn-danger btn-delete fa fa-trash "></a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- tambah -->
                <div class=" modal fade" id="modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Data Tahun ajaran</h5>
                                <button class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="form" action="<?= base_url(); ?>/tahunajaran/tambahtahun" method="post">
                                    <div class="form-group">
                                        <label>ID Tahun Ajaran</label>
                                        <input type="text" class="form-control" name="id_tahun" id="id_tahun" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Tahun Ajaran</label>
                                        <input type="text" class="form-control" name="tahunajaran" id="tahunajaran" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <input type="text" class="form-control" name="status" id="status" required>
                                    </div>
                                    <button class="btn btn-success" type="submit">Tambah</button>
                                    <button class="btn btn-danger" data-dismiss="modal">Close</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- update -->


                <form action="/tahunajaran/update" method="post">
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Jurusan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label>ID tahun ajaran</label>

                                        <input type="text" class="form-control id_tahun" name="id_tahun" id="id_tahun" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Tahun ajaran</label>

                                        <input type="text" class="form-control tahunajaran" name="tahunajaran" id="tahunajaran" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>

                                        <input type="text" class="form-control status" name="status" id="status" required>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <form action="/tahunajaran/delete" method="post">
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Jurusan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <h4>Are you sure want to delete this Jurusan?</h4>

                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="id_tahun" class="id_tahun">
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
<script>
    $(document).ready(function() {
        $('.btn-edit').on('click', function() {
            // get data from button edit
            const id_tahun = $(this).data('id_tahun');
            const tahunajaran = $(this).data('tahunajaran');
            const status = $(this).data('status');


            // Set data to Form Edit
            $('.id_tahun').val(id_tahun);
            $('.tahunajaran').val(tahunajaran);
            $('.status').val(status);



            // Call Modal Edit
            $('#editModal').modal('show');
        });
        $('.btn-delete').on('click', function() {
            // get data from button edit
            const id_tahun = $(this).data('id_tahun');
            // Set data to Form Edit
            $('.id_tahun').val(id_tahun);
            // Call Modal Edit
            $('#deleteModal').modal('show');
        });
    });
</script>
<!-- End of Content Wrapper -->
<?= $this->endsection(); ?>