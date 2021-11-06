<div class="container my-3">
    <nav class="navbar navbar-expand-lg navbar-dark custom-nav sticky-top bg-transparent">
        <div class="container">
            <a class="navbar-brand" href="#">
                <h4><?php echo $landing_page['']?></h4>
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