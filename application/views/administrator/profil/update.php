<div class="content-header text-capitalize">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?= $title . ' ' . $controller; ?></h1>
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
        <?php endif; ?>

        <div class="row text-capitalize pb-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-12 col-md-6">
                                    <label for="name">name</label>
                                    <input type="text" class="form-control" name="name" id="name" value="<?= set_value('name', $profil['name']); ?>" placeholder="name">
                                    <?= form_error('name', '<small class="form-text text-danger text-capitalize">* ', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12 col-md-6">
                                    <label for="email">email</label>
                                    <input type="text" class="form-control" name="email" id="email" value="<?= set_value('email', $profil['email']); ?>" placeholder="email">
                                    <?= form_error('email', '<small class="form-text text-danger text-capitalize">* ', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12 col-md-6">
                                    <label for=" password">password</label>
                                    <div class="form-text">
                                        <a href="<?= base_url('') . $controller . '/password'; ?>">change password</a>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-row">
                    <div class="form-group col-12">
                        <img src="<?= base_url('') . 'assets/admin/' . $profil['image']; ?>" alt="thumbnail" class="img-fluid img-thumbnail img-preview">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-12">
                        <input type="file" class="form-control-file" name="image" id="image" onchange="previewImg()" accept=".jpg,.jpeg,.png">
                        <small class="text-secondary text-capitalize">* max file 500kb, ratio (4:3)</small>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="password">password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="password">
                        <?= form_error('password', '<small class="form-text text-danger text-capitalize">* ', '</small>'); ?>
                        <small class="form-text text-capitalize text-danger">* type password for save update</small>
                    </div>
                </div>

                <button type="submit" class="btn btn-block btn-primary"><i class="fa-fw fas fa-save"></i> save</button>
                </form>
            </div>
        </div>
    </div>
</div>