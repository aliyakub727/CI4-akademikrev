<?= $this->extend('template/template'); ?>

<?= $this->section('content'); ?>

<?php foreach ($landing_page as $k) : ?>
	<style>
		body {
			background-image: url(<?= base_url() . "/img/" . $k['background']; ?>);
			background-position: top;
			background-repeat: no-repeat;
			background-size: 100vmax;

		}
	</style>
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
	<div class="custom-cover">
		<div class="container kotak">
			<div class="row kata justify-content-center">

				<div class="col-md-10 col-9 ">
					<h1><?= $k['judul']; ?></h1>
					<p>
						<?= $k['isi']; ?>
					</p>
					<?php if (logged_in()) : ?>
						<?php if (in_groups('admin') == 'admin') { ?>
							<a href="<?= base_url(); ?>/admin" class="tombol">Yuk Kedashboard</a>
						<?php } elseif (in_groups('guru') == 'guru') { ?>
							<a href="<?= base_url(); ?>/guru" class="tombol">Yuk Kedashboard</a>
						<?php } elseif (in_groups('siswa') == 'siswa') { ?>
							<a href="<?= base_url(); ?>/siswa" class="tombol">Yuk Kedashboard</a>
						<?php } elseif (in_groups('kepalasekolah') == 'kepalasekolah') { ?>
							<a href="<?= base_url(); ?>/kepalasekolah" class="tombol">Yuk Kedashboard</a>
						<?php } elseif (in_groups('operator') == 'operator') { ?>
							<a href="<?= base_url(); ?>/operator" class="tombol">Yuk Kedashboard</a>
						<?php } ?>
					<?php else : ?>
						<a href="<?= base_url(); ?>/akun" class="tombol">Get Started</a>
					<?php endif; ?>
				<?php endforeach ?>
				</div>
			</div>
		</div>
	</div>
	<?= $this->endsection(); ?>