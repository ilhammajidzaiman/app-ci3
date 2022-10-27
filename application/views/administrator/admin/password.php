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
        <div class="row text-capitalize">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">

                            <div class="form-row">
                                <div class="form-group col-12 col-md-6">
                                    <label for="password">password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="password">
                                    <?= form_error('password', '<small class="form-text text-danger">* ', '</small>'); ?>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="confirm">confirm</label>
                                    <input type="password" class="form-control" name="confirm" id="confirm" placeholder="konfirmasi">
                                    <?= form_error('confirm', '<small class="form-text text-danger">* ', '</small>'); ?>
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