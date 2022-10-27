<div class="content-header text-capitalize">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?= $title . ' ' . $function; ?></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('') . $controller; ?>"><i class="fa-fw fas fa-arrow-circle-left"></i> back</a></li>
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
            <div class="col-md-4">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="<?= base_url(''); ?>assets/admin/thumbnail/<?= $data['image'] ?>" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center"><?= $data['name']; ?></h3>

                        <p class="text-muted text-center"><?= $data['level']; ?></p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>name</b> <span class="float-right"><?= $data['name']; ?></span>
                            </li>
                            <li class="list-group-item">
                                <b>email</b> <span class="float-right"><?= $data['email']; ?></span>
                            </li>
                            <li class="list-group-item">
                                <b>created_at</b> <span class="float-right"><?= $data['created_at']; ?></span>
                            </li>
                        </ul>

                        <a href="<?= base_url('') . $controller . '/update/' . $data['id']; ?>" class="btn btn-primary btn-block">Edit</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>