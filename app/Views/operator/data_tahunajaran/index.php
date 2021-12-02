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
                        <table class="table table-striped" id="data-list">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Jurusan</th>
                                    <th scope="col">TAHUN AJARAN</th>
                                    <th scope="col">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($tahun_ajaran as $k) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><?= $k['jurusan']; ?></td>
                                        <td><?= $k['tahun_ajaran']; ?></td>
                                        <td>
                                            <a href="<?= base_url(); ?>/operator/edittahunajaran/<?= $k['id_ajaran']; ?>" style="color:#ffffff" class="btn btn-primary fa fa-edit"></a>
                                            <a data-id_tahun="<?= $k['id_ajaran']; ?>" style="color:#ffffff;padding-top:6px;size: 2px" class="btn btn-danger btn-delete fa fa-trash "></a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <form action="/operator/deletedatatahunajaran" method="post">
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Tahun Ajaran</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <h4>Are you sure want to delete this Jurusan?</h4>

                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="id_ajaran" class="id_ajaran">
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
    $(document).ready(function() {

        $('.btn-delete').on('click', function() {
            // get data from button edit
            const id_tahun = $(this).data('id_tahun');
            // Set data to Form Edit
            $('.id_ajaran').val(id_tahun);
            // Call Modal Edit
            $('#deleteModal').modal('show');
        });
    });
</script>
<!-- End of Content Wrapper -->
<?= $this->endsection(); ?>