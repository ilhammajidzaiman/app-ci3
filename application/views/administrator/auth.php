<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= ucwords($controller . " " . $title); ?></title>
	<link rel="shortcut icon" href="<?= base_url('') . 'assets/images/' . $configs['image']; ?>" type="image/x-icon">
	<link rel="stylesheet" href="<?= base_url(''); ?>assets/admin-lte/plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="<?= base_url(''); ?>assets/admin-lte/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
	<div class="login-box">

		<div class="text-center">
			<img src="<?= base_url('') . 'assets/images/' . $configs['image']; ?>" alt="logo" width="100" class="my-2">
			<h3 class="text-uppercase"><?= $configs['application']; ?></h3>
			<p class="text-secondary"><?= $configs['description']; ?></p>
		</div>

		<div class="card">
			<div class="card-body login-card-bodyy">

				<?php
				// tampil flashdata
				if ($this->session->flashdata('flash')) :
					$flash = $this->session->flashdata('flash');
				?>
					<p class="login-box-msg font-italic text-danger"><?= $flash; ?></p>
				<?php else : ?>
					<p class="login-box-msg">Login</p>
				<?php endif; ?>

				<form action="<?= base_url('auth'); ?>" method="post">
					<div class="input-group mb-3">
						<input type="text" class="form-control" name="email" value="<?= set_value('email'); ?>" placeholder="email">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<?= form_error('email', '<p class="form-text text-danger text-capitalize text-xs">* ', '</p>'); ?>
					<div class="input-group mb-3">
						<input type="password" class="form-control" name="password" placeholder="password">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<?= form_error('password', '<p class="form-text text-danger text-capitalize text-xs">* ', '</p>'); ?>
					<div class="row">
						<div class="col">
							<button type="submit" class="btn btn-primary btn-block">Login</button>
						</div>
					</div>
				</form>

				<div class="text-center text-xs mt-4">
					<div> <?= $configs['application']; ?></div>
					<a href="<?= base_url(''); ?>">
						Copyright &copy; <?= date('Y'); ?>
						<b><?= $configs['copyright']; ?></b>
					</a>
					<div>powered by-<i><?= $configs['powered']; ?></i>.</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>