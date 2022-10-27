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
        <div class="row text-capitalize pb-3">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
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
                                            <div class="col-6 col-sm-6 col-md-4 col-xl-3">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="status<?= $n; ?>" name="status" class="custom-control-input" value="<?= $n; ?>" <?php
                                                                                                                                                            if ($n == '1') :
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
                                <div class="form-group col-12 col-md-6">
                                    <label for="level">level</label>
                                    <select class="custom-select" id="level" name="level">
                                        <?php
                                        if (!empty($level)) :
                                            foreach ($level as $l) :
                                        ?>
                                                <option value="<?= $l['id']; ?>"><?= $l['level']; ?></option>
                                        <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-12 col-md-6">
                                    <label for="name">name</label>
                                    <input type="text" class="form-control" name="name" id="name" value="<?= set_value('name'); ?>" placeholder="name">
                                    <?= form_error('name', '<small class="form-text text-danger text-capitalize">* ', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12 col-md-6">
                                    <label for="email">email</label>
                                    <input type="text" class="form-control" name="email" id="email" value="<?= set_value('email'); ?>" placeholder="email">
                                    <?= form_error('email', '<small class="form-text text-danger text-capitalize">* ', '</small>'); ?>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-12 col-md-6">
                                    <label for="password">password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="password">
                                    <?= form_error('password', '<small class="form-text text-danger text-capitalize">* ', '</small>'); ?>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="confirm">confirm</label>
                                    <input type="password" class="form-control" name="confirm" id="confirm" placeholder="confirm">
                                    <?= form_error('confirm', '<small class="form-text text-danger text-capitalize">* ', '</small>'); ?>
                                </div>
                            </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="">menu access</label>
                                <div class="row">
                                    <?php
                                    if (empty($data)) : ?>
                                        <div class="alert alert-danger">data not found...</div>
                                        <?php
                                    else :
                                        foreach ($data as $data1) :
                                        ?>
                                            <div class="col-md-12">
                                                <div class="custom-control custom-checkbox my-1">
                                                    <input type="checkbox" class="custom-control-input" id="<?= $data1['id']; ?>" name="access[]" value="<?= $data1['id']; ?>" <?php
                                                                                                                                                                                if (($data1['id'] == '1') || ($data1['id'] == '2')) :
                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                endif; ?>>
                                                    <label class="custom-control-label" for="<?= $data1['id']; ?>"><?= $data1['menu']; ?></label>
                                                </div>
                                            </div>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </div>
                                <?= form_error('access[]', '<small class="form-text text-danger text-capitalize">* ', '</small>'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-12">
                        <img src="<?= base_url('') . 'assets/admin/default.svg'; ?>" alt="thumbnail" class="img-fluid img-thumbnail w-100 img-preview">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-12">
                        <input type="file" class="form-control-file" name="image" id="image" onchange="previewImg()" accept=".jpg,.jpeg,.png">
                        <small class="text-secondary text-capitalize">* max file 500kb, ratio (4:3)</small>
                    </div>
                </div>

                <button type="submit" class="btn btn-block btn-primary"><i class="fa-fw fas fa-save"></i> save</button>
                </form>
            </div>
        </div>
    </div>
</div>