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

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-body text-capitalize">
                        <form action="" method="post" enctype="multipart/form-data">

                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="password">new password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="new password">
                                    <?= form_error('password', '<small class="form-text text-danger text-capitalize">* ', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="confirm">confirm password</label>
                                    <input type="password" class="form-control" name="confirm" id="confirm" placeholder="confirm password">
                                    <?= form_error('confirm', '<small class="form-text text-danger text-capitalize">* ', '</small>'); ?>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="old_password">old password</label>
                                    <input type="password" class="form-control" name="old_password" id="old_password" placeholder="old password">
                                    <?= form_error('old_password', '<small class="form-text text-danger text-capitalize">* ', '</small>'); ?>
                                </div>
                            </div>

                    </div>
                    <div class="card-footer border-top">
                        <button type="submit" class="btn btn-primary"><i class="fa-fw fas fa-save"></i> save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>