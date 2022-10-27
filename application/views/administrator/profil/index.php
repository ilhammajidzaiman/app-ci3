<div class="content-header text-capitalize">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?= $title . ' ' . $controller; ?></h1>
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
                <h5 class="font-italic"><i class="fa-fw fas <?= $icon; ?>"></i> Informasi</h5>
                <?= $flash; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <div class="row">






            <div class="col-md-4">
                <div class="card card-widget widget-user">
                    <div class="widget-user-header bg-secondary">
                        <h3 class="widget-user-username"><?= $profil['level']; ?></h3>
                        <h5 class="widget-user-desc"><?= $profil['name']; ?></h5>
                    </div>

                    <div class="widget-user-image">
                        <img class="img-circle elevation-2" src="<?= base_url('') . 'assets/admin/thumbnail/' . $profil['image']; ?>" alt="User Avatar">
                    </div>

                    <div class="card-body">
                        <ul class="list-group list-group-unbordered mt-5 mb-3">
                            <li class="list-group-item">
                                <b>Email</b> <span class="float-right"><?= $profil['email']; ?></span>
                            </li>
                            <li class="list-group-item">
                                <b>Name</b> <span class="float-right"><?= $profil['name']; ?></span>
                            </li>
                            <li class="list-group-item">
                                <b>Updated</b> <span class="float-right"><?= date('d-m-Y H:i:s', strtotime($profil['updated_at'])); ?></span>
                            </li>
                        </ul>
                        <a href="<?= base_url('') . $controller . '/update'; ?>" class="btn btn-primary btn-block">Edit</a>
                    </div>
                </div>
            </div>

            <!-- <div class="col-md-4">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="<?= base_url('') . 'assets/images/admin/thumbnail/' . $profil['foto']; ?>" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?= $profil['nama']; ?></h3>

                <p class="text-muted text-center"><?= $profil['level']; ?></p>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Username</b> <span class="float-right"><?= $profil['username']; ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Email</b> <span class="float-right"><?= $profil['email']; ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Nama</b> <span class="float-right"><?= $profil['nama']; ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Updated</b> <span class="float-right"><?= $profil['updated_at']; ?></span>
                    </li>
                </ul>

                <a href="<?= base_url('') . $controller . '/update'; ?>" class="btn btn-primary btn-block">Edit</a>
            </div>
        </div>
    </div> -->
        </div>
    </div>
</div>