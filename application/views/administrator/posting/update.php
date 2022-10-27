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
            <div class="col-md-9">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-12">
                            <input type="text" class="form-control" name="title" id="title" value="<?= set_value('title', $data['title']); ?>" placeholder="Enter Title">
                            <?= form_error('title', '<small class="form-text text-danger text-capitalize">* ', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <textarea class="textarea" name="article" id="article"><?= set_value('article', $data['article']); ?></textarea>
                            <?= form_error('article', '<small class="form-text text-danger text-capitalize">* ', '</small>'); ?>
                        </div>
                    </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="status">status</label>
                                <div class="row py-2">
                                    <?php
                                    $n = 1;
                                    do {
                                        if ($n == 1) :
                                            $sts = 'on';
                                        else :
                                            $sts = 'off';
                                        endif;
                                    ?>
                                        <div class="col">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="status<?= $n; ?>" name="status" class="custom-control-input" value="<?= $n; ?>" <?php
                                                                                                                                                        if ($n == $data['status']) :
                                                                                                                                                            echo 'checked';
                                                                                                                                                        endif; ?>>
                                                <label class="custom-control-label" for="status<?= $n; ?>"><?= $sts; ?></label>
                                            </div>
                                        </div>
                                    <?php
                                        $n--;
                                    } while ($n >= 0);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-12 mb-0">
                                <label for="">category</label>
                                <div class="row">
                                    <?php
                                    if (empty($categorys)) : ?>
                                        <div class="alert alert-danger">data not found...</div>
                                        <?php
                                    else :
                                        foreach ($categorys as $category) :
                                            $selects = $this->PostingModel->readCategory($data['id'], $category['id']);
                                        ?>
                                            <div class="col-md-12">
                                                <div class="custom-control custom-checkbox my-1">
                                                    <input type="checkbox" class="custom-control-input" id="<?= $category['id']; ?>" name="category[]" value="<?= $category['id']; ?>" <?php foreach ($selects as $select) :
                                                                                                                                                                                            if ($category['id'] == $select['id_article_category']) {
                                                                                                                                                                                                echo 'checked';
                                                                                                                                                                                            } else {
                                                                                                                                                                                                echo '';
                                                                                                                                                                                            }
                                                                                                                                                                                        endforeach;
                                                                                                                                                                                        ?>>
                                                    <label class="custom-control-label" for="<?= $category['id']; ?>"><?= $category['category']; ?></label>
                                                </div>
                                            </div>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </div>
                                <?= form_error('category[]', '<small class="form-text text-danger text-capitalize">* ', '</small>'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-12">
                        <img src="<?= base_url('') . 'assets/article/' . $data['image']; ?>" alt="<?= $data['image']; ?>" class="img-fluid img-thumbnail w-100 img-preview">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-12">
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