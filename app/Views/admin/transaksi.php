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
                <h1 class="h3 mb-0 text-gray-800">Transaksi</h1>
            </div>

            <!-- Content Row -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <form class="form-inline mr-auto w-100 navbar-search" method="POST">
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-light border-1 small" placeholder="Cari Data...." name="keyword">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit" name="submit">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-6 d-flex justify-content-end text-right nota">
                                    <div>
                                        <div class="mb-0">
                                            <b class="mr-2">Nota</b> <span id="nota"></span>
                                        </div>
                                        <span id="" onkeyup="total();" style="font-size: 80px; line-height: 1" class="text-danger"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-sm-6">
                                    <a href="transaksi/bayar/<?= old('keyword'); ?>" id="bayar" class="btn btn-success" hred data-toggle="modal" data-target="#modal">Bayar</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="data" class="table w-100 table-bordered table-hover" id="transaksi">
                                <thead>
                                    <tr>
                                        <th>Barcode</th>
                                        <th>Nama</th>
                                        <th>keterangan</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Subs Total</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total = 0;
                                    $tot_bayar = 0;
                                    $pelanggan = "";
                                    ?>
                                    <?php foreach ($order as $a) {
                                        $total = $a['harga'] * $a['jumlah_pesanan'];
                                        $pelanggan = $a['username'];
                                    ?>
                                        <tr>
                                            <td><?= $a['id_menu']; ?></td>
                                            <td><?= $a['nama_menu']; ?></td>
                                            <td><?= $a['keterangan']; ?></td>
                                            <td><?= $a['harga']; ?></td>
                                            <td><?= $a['jumlah_pesanan']; ?></td>
                                            <td>Rp. <?= $total; ?></td>

                                            <td>
                                                <form action="/transaksi/delete/<?= $a['id']; ?>" class="d-inline" method="POST">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-danger" onclick=" return confirm('Apakah Anda yakin?');">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php
                                        $tot_bayar += $total;
                                    }

                                    ?>
                                </tbody>
                                <tr>
                                    <th colspan="5">SubTotal</th>
                                    <th onkeyup="total();" colspan="2">Rp. <span id="total"><?php echo $tot_bayar; ?></span></th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

    </div>
    <div class="modal fade" id="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bayar</h5>
                    <button class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form" action="/transaksi/save" method="post">
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="text" class="form-control" name="tanggal" id="tanggal" required>
                        </div>
                        <div class="form-group">
                            <label>Pelanggan</label>
                            <input name="username" value="<?= (old('username')) ? "old('username')" : $pelanggan ?>" id="username" class="form-control username">
                        </div>
                        <div class="form-group">
                            <label>Jumlah Uang</label>
                            <input placeholder="Jumlah Uang" id="jumlah_uang" type="number" class="form-control" name="jumlah_uang" onchange="kembalian()" required>
                        </div>
                        <div class="form-group">
                            <b>Total Bayar:</b> <span class="total_bayar"><?= $tot_bayar; ?></span>
                            <input type="hidden" name="total_bayar" value="<?= $tot_bayar; ?>" id="">
                        </div>
                        <div class="form-group">
                            <b>Kembalian:</b> <span class="kembalian"></span><br>
                            <input type="hidden" class="bijak" name="kembali">
                        </div>
                        <button id="add" class="btn btn-success" type="submit" disabled>Bayar</button>
                        <button class="btn btn-danger" data-dismiss="modal">Close</button>
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
    $("#tanggal").datepicker({
        dateFormat: "yy-mm-dd"
    });

    function kembalian() {
        let total = $("#total").html(),
            jumlah_uang = $('[name="jumlah_uang"]').val();
        // diskon = $('[name="diskon"]').val();
        $(".kembalian").html(jumlah_uang - total);
        $(".bijak").val(jumlah_uang - total);
        checkUang()
    }

    function checkUang() {
        let jumlah_uang = $('[name="jumlah_uang"').val(),
            total_bayar = parseInt($(".total_bayar").html());
        if (jumlah_uang !== "" && jumlah_uang >= total_bayar) {
            $("#add").removeAttr("disabled");
        } else {
            $("#add").attr("disabled", "disabled");
        }
    }

    $('#delete').on('click', function() {
        // get data from button edit
        const username = $(this).data('username');
        // Set data to Form Edit
        $('.username').val(username);
    });

    $('#add').on('click', function() {
        // get data from button edit
        const username = $(this).data('username');
    });
</script>

<?= $this->endsection(); ?>