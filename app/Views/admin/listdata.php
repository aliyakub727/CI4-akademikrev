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
                        <a href="<?= base_url() ?>/admin/exportusersxlxs" class="btn btn-primary">Export</a>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#import">Import</button>
                        <br>
                        <a class="btn btn-primary mb-4" href="<?= base_url(); ?>/admin/buatakun">Tambah Akun</a>
                        <?php if (session()->getFlashdata('Pesan')) : ?>
                            <div class="alert alert-success" role="alert">
                                <?= session()->getFlashdata('Pesan'); ?>
                            </div>
                        <?php endif; ?>
                        <table class="table table-striped" id="data-list">
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
                                            <a href="<?= base_url(); ?>/admin/editakun/<?= $k['userid']; ?>" class="btn btn-info btn-sm btn-edit">Edit</a>
                                            <a data-user="<?= $k['userid'] ?>" data-name="<?= $k['name'] ?>" class="btn btn-danger btn-sm btn-delete">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->
<!-- End of Content Wrapper -->
<form action="/admin/deleteakun" method="post">
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Akun</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <h4>Are you sure want to delete ?</h4>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="userid" class="userid">
                    <input type="hidden" name="name" class="name">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>
</form>


<div class="modal fade" id="import" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <form method="post" action="/admin/uploadusers" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Import Users</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group">
                            <label>File Excel</label>
                            <input type="file" name="fileexcel" class="form-control" id="file" required accept=".xls, .xlsx" /></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </div>
        </div>
    </form>
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
            const userid = $(this).data('userid');
            const name = $(this).data('name');
            // Set data to Form Edit
            $('.userid').val(userid);
            $('.name').val(name);
            // Call Modal Edit
            $('#deleteModal').modal('show');
        });
    });
</script>
<?= $this->endsection(); ?>