<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?= base_url('') . 'dashboard'; ?>" class="brand-link">
        <img src="<?= base_url('') . 'assets/images/' . $configs['image']; ?>" alt="Logo" class="brand-image img-circle elevation-3 bg-white">
        <span class="brand-text font-weight-light"><?= $configs['application']; ?></span>
    </a>

    <div class="sidebar text-capitalize">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <?php
                // jika data kosong
                if (empty($admin_menu)) : ?>
                    <li class="nav-item">
                        <a href="<?= base_url(''); ?>profil" class="nav-link">
                            <i class="nav-icon fa-fw fas fa-info"></i>
                            <p>Opss...</p>
                        </a>
                    </li>
                    <?php
                // jika data ada
                else :
                    foreach ($admin_menu as $data) :
                        if ($controller == $data['controller']) :
                            $active = 'active';
                        else :
                            $active = '';
                        endif;
                    ?>
                        <li class="nav-item">
                            <a href="<?= base_url('') . $data['controller']; ?>" class="nav-link <?= $active; ?>">
                                <i class="nav-icon fa-fw <?= $data['icon']; ?>"></i>
                                <p><?= $data['menu']; ?></p>
                            </a>
                        </li>
                <?php
                    endforeach;
                endif; ?>

                <li class="nav-item">
                    <a href="<?= base_url(''); ?>logout" class="nav-link">
                        <i class="nav-icon fa-fw fas fa-sign-out-alt"></i>
                        <p>keluar</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<div class="content-wrapper">