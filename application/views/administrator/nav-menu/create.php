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
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <ol>
                <li>Jika ingin Menambahkan SubMenu link harus kosong atau tidak diisi, cukup hanya mengisi nama Menu.</li>
                <li>
                    link di copy/salin dari url artikel atau link website lain yang akan diarahkan.
                </li>
            </ol>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>

        <div class="row text-capitalize pb-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <form action="" method="post" enctype="multipart/form-data">

                            <div class="form-row">
                                <div class="form-group col-12 col-md-4">
                                    <label for="menu">menu</label>
                                    <input type="text" class="form-control" name="menu" id="menu" placeholder="menu" value="<?= set_value('menu'); ?>">
                                    <?= form_error('menu', '<small class="form-text text-danger text-capitalize">* ', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="link">link</label>
                                    <input type="text" class="form-control" name="link" id="link" placeholder="link" value="<?= set_value('link'); ?>">
                                    <?= form_error('link', '<small class="form-text text-danger text-capitalize">* ', '</small>'); ?>
                                </div>
                            </div>



                            <button type="submit" class="btn btn-primary"><i class="fa-fw fas fa-save"></i> save</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>