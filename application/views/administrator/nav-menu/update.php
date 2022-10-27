<div class="content-header text-capitalize">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?= $title . ' ' . $function; ?> <i class="font-weight-italic font-weight-light"><?= $data['menu']; ?></i></h1>
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
                                    <input type="text" class="form-control" name="menu" id="menu" value="<?= set_value('menu', $data['menu']); ?>">
                                    <?= form_error('menu', '<small class="form-text text-danger text-capitalize">* ', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="link">link</label>
                                    <input type="text" class="form-control" name="link" id="link" value="<?= set_value('link', $data['link']); ?>">
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