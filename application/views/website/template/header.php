<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ucwords($title); ?></title>
    <link rel="shortcut icon" href="<?= base_url('') . 'assets/images/' . $configs['image']; ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url(''); ?>assets/bootstrap4/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(''); ?>assets/fontawesome5/css/all.css">
    <link rel="stylesheet" href="<?= base_url(''); ?>assets/css/style.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light shadow-sm text-capitalize" style="background-color: #e3f2fd;">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url(''); ?>">
                <img src="<?= base_url('') . 'assets/images/' . $configs['image']; ?>" width="30" height="30" alt="logo">
                <?= $configs['application']; ?>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav mr-auto">
                    <?php foreach ($menus as $menu) : ?>
                        <a class="nav-item nav-link" href="<?= $menu['link']; ?>"><?= $menu['menu']; ?></a>
                    <?php endforeach; ?>

                </div>
                <?php $value = $this->session->userdata('keyword'); ?>
                <form action="<?= base_url(''); ?>" method="post" class="form-inline my-2 my-lg-0">
                    <div class="input-group">
                        <input type="text" class="form-control border-secondary" name="keyword" value="<?= $value; ?>" placeholder="search here">
                        <div class="input-group-append">
                            <input type="submit" class="btn btn-outline-secondary" value="search" name="search">
                            <a href="<?= base_url('') . 'reset'; ?>" class="btn btn-outline-secondary text-secondary"><i class="fa-fw fas fa-sync"></i></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </nav>