<?= $this->extend('template/template'); ?>

<?= $this->section('content'); ?>
<style>
    .custom {
        margin-top: -8em;
    }
</style>
<?php foreach ($landing_page as $k) : ?>
<div class="container my-3">
    <nav class="navbar navbar-expand-lg navbar-dark custom-nav sticky-top bg-transparent">
        <div class="container">
            <a class="navbar-brand" href="#">
                <h4><?= $k['title']; ?></h4>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url(); ?>/Home/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url(); ?>/Home/about">About</a>
                    </li>
                    <li class="nav-item">
                        <?php if (logged_in()) : ?>
                            <a class="nav-link tombol" href="/logout">Logout</a>
                        <?php else : ?>
                            <a class="nav-link tombol" href="/login">Login</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
<?php endforeach ?>
<div id="carouselExampleCaptions" class="carousel slide custom" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="/img/<?= $slider1['gambar_slider']?>" class="d-block" width="100%" height="50%"  alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5><?= $slider1['title']?></h5>
                <p><?= $slider1['deskripsi']?></p>
            </div>
        </div>
        <div class="carousel-item ">
            <img src="/img/<?= $slider2['gambar_slider']?>" class="d-block w-100" width="100%" height="50%" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5><?= $slider2['title']?></h5>
                <p><?= $slider2['deskripsi']?></p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="/img/<?= $slider3['gambar_slider']?>" class="d-block w-100" width="100%" height="50%" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5><?= $slider3['title']?></h5>
                <p><?= $slider3['deskripsi']?></p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>



<div class="custom-about2">
    <div class="container">
        <hr>
        <div class="row g-0 penjelasan">
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">Kantin</h5>
                    <p class="card-text">
                        Di sekolahan kita terdapat kantin yang menjual beberapa menu sehat dan juga terdapat tempat luas yang
                        bisa untuk murid-murid mengerjakan tugas di halaman kantin
                    </p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
            <div class="col-md-4">
                <img src="/img/kantin.png" class="img-fluid rounded-end" alt="...">
            </div>
        </div>
        <hr>
        <div class="row g-0 penjelasan">
            <div class="col-md-4">
                <img src="/img/lab.png" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">LAB Komputer </h5>
                    <p class="card-text">Di sekolah ini juga terdapat beberapa lab yang sesuai dengan jurusan
                        masing-masing dan contohnya adalah lab Komputer,dengan adanya fasilitas lab ini maka
                        siswa akan mudah dalam proses pembelajaran
                    </p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
        </div>
        <hr>
        <div class="row g-0 penjelasan">
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">Aula </h5>
                    <p class="card-text">Salah satu fasilitas yang kami banggakan adalah memiliki aula sebagai tempat perkumpulan rapat antara sisa dan guru ataupun dengan orangtua serta dapat digunakan untuk acara yang lain nya.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
            <div class="col-md-4">
                <img src="/img/aula.png" class="img-fluid rounded-end" alt="...">
            </div>
        </div>
    </div>
</div>

<?= $this->include('template/footer'); ?>
<?= $this->endsection(); ?>