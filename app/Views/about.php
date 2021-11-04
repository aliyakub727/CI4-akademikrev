<?= $this->extend('template/template'); ?>

<?= $this->section('content'); ?>
<style>
    .custom {
        margin-top: -8em;
    }
</style>
<div id="carouselExampleCaptions" class="carousel slide custom" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="/img/bg6.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>Suzuran High School</h5>
                <p>Temukan Jati dirimu di sekolah ini !.</p>
            </div>
        </div>
        <div class="carousel-item ">
            <img src="/img/bg5.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>Enterprenuer</h5>
                <p>Di dalam sekolah kami terdapat ekstrakulikuler yang membantu siswa dalam pemahan membangun usaha nya sendiri.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="/img/bg7.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>Perpustakaan</h5>
                <p>Temukan Berbagai Buku yang menarik disini .</p>
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