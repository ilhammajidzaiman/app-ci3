<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <?php
    if (($controller == 'admin') ||
        ($controller == 'category') ||
        ($controller == 'posting')
    ) :
        $value = $this->session->userdata('keyword');
    ?>
        <form action="<?= base_url('') . $controller; ?>" method="post" class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <input type="text" class="form-control form-control-navbar" name="keyword" value="<?= $value; ?>" placeholder="search <?= $controller ?>">
                <div class="input-group-append">
                    <input type="submit" class="btn btn-secondary" value="search" name="search">
                    <a href="<?= base_url('') . $controller . '/reset'; ?>" class="btn btn-secondary"><i class="fa-fw fas fa-sync"></i></a>
                </div>
            </div>
        </form>
    <?php endif; ?>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa-fw fas fa-user-alt mr-2"></i>
                <?= $profil['name']; ?>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="media p-2">
                    <img src="<?= base_url('') . 'assets/admin/thumbnail/' . $profil['image']; ?>" alt="User" class="img-size-50 img-circle mr-3">
                    <div class="media-body">
                        <p class="text-sm"><?= $profil['level']; ?></p>
                        <h3 class="dropdown-item-title"><?= $profil['name']; ?></h3>
                        <a href="<?= base_url('') . 'profil'; ?>" class="text-sm text-muted"><i class="fas fa-cog mr-1"></i> setting</a>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <a href="<?= base_url(''); ?>logout" class="dropdown-item dropdown-footer"><i class="fa-fw fas fa-lock mr-1"></i>logout</a>
            </div>
        </li>
    </ul>
</nav>