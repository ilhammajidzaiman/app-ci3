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

        <div class="row text-capitalize">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <img src="<?= base_url('') . 'assets/images/' . $data['image']; ?>" alt="thumbnail" class="img-fluid w-100 mb-4 img-preview">
                            </div>
                            <div class="col-md-10">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-row">
                                        <div class="form-group col-12 col-md-4">
                                            <label for="application">application</label>
                                            <input type="text" class="form-control" name="application" id="application" value="<?= set_value('application', $data['application']); ?>" placeholder="Enter application">
                                            <?= form_error('application', '<small class="form-text text-danger text-capitalize">* ', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-12 col-md-4">
                                            <label for="copyright">copyright</label>
                                            <input type="text" class="form-control" name="copyright" id="copyright" value="<?= set_value('copyright', $data['copyright']); ?>" placeholder="Enter copyright">
                                            <?= form_error('copyright', '<small class="form-text text-danger text-capitalize">* ', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-12 col-md-4">
                                            <label for="powered">powered</label>
                                            <input type="text" class="form-control" name="powered" id="powered" value="<?= set_value('powered', $data['powered']); ?>" placeholder="Enter powered">
                                            <?= form_error('powered', '<small class="form-text text-danger text-capitalize">* ', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label for="description">description</label>
                                            <input type="text" class="form-control" name="description" id="description" value="<?= set_value('description', $data['description']); ?>" placeholder="Enter description">
                                            <?= form_error('description', '<small class="form-text text-danger text-capitalize">* ', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label for="map">map</label>
                                            <input type="text" class="form-control" name="map" id="map" value="<?= set_value('map', $data['map']); ?>" placeholder="Enter map">
                                            <?= form_error('map', '<small class="form-text text-danger text-capitalize">* ', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            <label for="logo">logo</label>
                                            <input type="file" class="form-control-file" name="image" id="image" onchange="previewImg()" accept=".jpg,.jpeg,.png">
                                            <small class="text-secondary text-capitalize">* max file 500kb, ratio (4:3)</small>
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



    </div>
</div>