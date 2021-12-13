<?= $this->extend('template/templateadmin'); ?>
<?= $this->section('content'); ?>

<body>
<p>    
    Raport Nilai <br>
    Bogor, Indonesia <br>
</p>
<hr>

                         <table class="table table-hover" id="users-list">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nomer Induk Siswa</th>
                                    <th scope="col">Nama Lengkap</th>                   
                                    <th scope="col">Tugas</th>
                                    <th scope="col">UTS</th>
                                    <th scope="col">UAS</th> 
                                    <th scope="col">Rata Rata</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($nilai as $k) { ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><?= $k['nis']; ?></td>
                                        <td><?= $k['nama_lengkap']; ?></td>
                                        <td><?= $k['tugas']; ?></td>
                                        <td><?= $k['uts']; ?></td>
                                        <td><?= $k['uas']; ?></td>
                                        <td><?= $k['rata_rata']; ?> </td>
                                        <td>
                                            <button type="button"  style="color:#ffffff" class="btn btn-primary  btn-edit fa fa-save btn-save " id="<?= $k['id_nilai']; ?>"></button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
</body>
<!-- End of Content Wrapper -->
<?= $this->endsection(); ?>