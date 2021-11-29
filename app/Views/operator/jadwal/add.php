<?= $this->extend('template/templateadmin'); ?>
<?= $this->section('content'); ?>

<head>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <?= $this->include('template/topbar'); ?>


        <!-- Begin Page Content -->
        <div class="container-fluid">

            <div class="container-fluid">
                <div class="container">
                    <div class="card">
                        <div class="card-header">
                            Data Mapel
                        </div>
                        <div class="card-body">
                            <form id="form" action="<?= base_url(); ?>/operator/savetahunajaran" method="post">
                                <?= csrf_field(); ?>
                                <div class="form-group">
                                    <label>Tahun Ajaran</label>
                                    <input type="text" class="form-control" name="tahun_ajaran" id="tahun_ajaran" required>
                                </div>
                                <label>Kelas</label>
                                <select name="kelas" id="kelas" class="selectpicker form-control select2 form-select " data-live-search="true">
                                    <option selected value="">---</option>
                                </select>
                                <label>Mapel</label>
                                <select name="id_jurusan" id="id_jurusan" class="selectpicker form-control form-select " data-live-search="true">
                                    <option selected value="">---</option>

                                </select>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<script type="text/javascript">
    // Provinsi
    $(document).ready(function() {
        $("#kelas").select2({
            ajax: {
                url: '<?= base_url() ?>operator/getdataprov',
                type: "post",
                dataType: 'json',
                delay: 200,
                data: function(params) {
                    return {
                        searchTerm: params.term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
    });
</script>
<!-- End of Content Wrapper -->
<?= $this->endsection(); ?>