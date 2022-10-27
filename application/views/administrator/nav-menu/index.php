<div class="content-header text-capitalize">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?= $title . ' ' . $function; ?></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('') . $controller; ?>/create"><i class="fa-fw fa fa-plus-circle"></i> new <?= $function; ?></a></li>
                </ol>
            </div>
        </div>
    </div>
</div>



<div class="content">
    <div class="container-fluid">
        <?php
        // tampil flashdata
        if ($this->session->flashdata('flash')) :
            $flash = $this->session->flashdata('flash');
            $alert = $this->session->flashdata('alert');
            $icon = $this->session->flashdata('icon');
        ?>
            <div class="alert alert-<?= $alert; ?> alert-dismissible fade show" role="alert">
                <h5 class="font-italic"><i class="fa-fw fas <?= $icon; ?>"></i> Info</h5>
                <?= $flash; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php
        endif;
        // end flashdata
        ?>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <?php
                        if (empty($data)) : ?>
                            <div class="text-danger">data not found...</div>
                            <?php
                        else :
                            // MENU_1
                            foreach ($data as $data) :
                                $sub1 = $this->NavMenuModel->readSubMenu($data['id']);
                            ?>
                                <ul class="fa-ul border-left m-0 py-2">
                                    <li>
                                        <i class="fa-fw fas fa-folder"></i>
                                        <span class="font-weight-bold"><?= $data['menu']; ?></span>
                                        <span class="ml-3">
                                            <a href="<?= base_url('') . $controller . '/create-sub/' . $data['slug']; ?>" class="badge badge-pill badge-primary"><i class="fa-fw fas fa-plus"></i></a>
                                            <a href="<?= base_url('') . $controller . '/update/' . $data['slug']; ?>" class="badge badge-pill badge-success"><i class="fa-fw fas fa-edit"></i></a>
                                            <?php if (empty($sub1)) : ?>
                                                <a href="<?= base_url('') . $controller . '/delete/' . $data['slug']; ?>" class="badge badge-pill badge-danger" onclick="return confirm('DELETE ? <?= $data['menu']; ?>');"><i class="fa-fw fas fa-trash"></i></a>
                                            <?php endif; ?>
                                        </span>
                                        <?php
                                        // MENU_2
                                        $sub1 = $this->NavMenuModel->readSubMenu($data['id']);
                                        if (!empty($sub1)) :
                                            foreach ($sub1 as $data) :
                                                $sub2 = $this->NavMenuModel->readSubMenu($data['id']);
                                        ?>
                                                <ul class="fa-ul border-left">
                                                    <li>
                                                        <i class="fa-fw fas fa-folder-plus"></i>
                                                        <?= $data['menu']; ?>
                                                        <span class="ml-3">
                                                            <a href="<?= base_url('') . $controller . '/create-sub/' . $data['slug']; ?>" class="badge badge-pill badge-primary"><i class="fa-fw fas fa-plus"></i></a>
                                                            <a href="<?= base_url('') . $controller . '/update/' . $data['slug']; ?>" class="badge badge-pill badge-success"><i class="fa-fw fas fa-edit"></i></a>
                                                            <?php if (empty($sub2)) : ?>
                                                                <a href="<?= base_url('') . $controller . '/delete/' . $data['slug']; ?>" class="badge badge-pill badge-danger" onclick="return confirm('DELETE ? <?= $data['menu']; ?>');"><i class="fa-fw fas fa-trash"></i></a>
                                                            <?php endif; ?>
                                                        </span>
                                                        <ul class="fa-ul border-left">
                                                            <?php
                                                            // MENU_3
                                                            $sub2 = $this->NavMenuModel->readSubMenu($data['id']);
                                                            if (!empty($sub2)) :
                                                                foreach ($sub2 as $data) :
                                                            ?>
                                                                    <li>
                                                                        <i class="fa-fw fas fa-folder-minus"></i>
                                                                        <?= $data['menu']; ?>
                                                                        <span class="ml-3">
                                                                            <a href="<?= base_url('') . $controller . '/update/' . $data['slug']; ?>" class="badge badge-pill badge-success"><i class="fa-fw fas fa-edit"></i></a>
                                                                            <a href="<?= base_url('') . $controller . '/delete/' . $data['slug']; ?>" class="badge badge-pill badge-danger" onclick="return confirm('DELETE ? <?= $data['menu']; ?>');"><i class="fa-fw fas fa-trash"></i></a>
                                                                        </span>
                                                                    </li>
                                                            <?php
                                                                endforeach;
                                                            endif;
                                                            // END MENU_3
                                                            ?>
                                                        </ul>
                                                    </li>
                                                </ul>
                                        <?php
                                            endforeach;
                                        endif;
                                        // END MENU_2
                                        ?>
                                    </li>
                                </ul>
                        <?php
                            endforeach;
                        endif;
                        // END MENU_1
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>