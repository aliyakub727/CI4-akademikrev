<?= $this->extend('template/templateadmin'); ?>

<?= $this->section('content'); ?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <?= $this->include('template/topbar'); ?>


        <!-- Begin Page Content -->
        <div class="container-fluid">

            <div class="container">
                <!-- Content Row -->
                <div class="card">
                    <div class="card-header">
                        <h3>
                            Data Kelas
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <a class="btn btn-primary mb-4" href="<?= base_url(); ?>/operator/tambahkelas">Tambah
                                    Kelas</a>
                                <?php if (session()->getFlashdata('Pesan')) : ?>
                                    <div class="alert alert-success" role="alert">
                                        <?= session()->getFlashdata('Pesan'); ?>
                                    </div>
                                <?php endif; ?>
                                <table class="table table-hover" id="users-list">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Kelas</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($kelas as $k) : ?>
                                            <tr>
                                                <th scope="row"><?= $i++; ?></th>
                                                <td><?= $k['nama_kelas']; ?></td>
                                                <td>

                                                    <a href="<?= base_url(); ?>/operator/editdatakelas/<?= $k['id_kelas']; ?>" class="btn btn-info btn-sm">Edit</a>
                                                    <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?= $k['id_kelas'] ?>">Delete</a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <form action="/operator/deletekelas" method="post">
                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete Kelas</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <h4>Are you sure want to delete this Kelas?</h4>

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

    $(document).ready(function() {
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