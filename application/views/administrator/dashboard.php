<div class="content-header text-capitalize">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?= $controller; ?></h1>
            </div>
        </div>
    </div>
</div>



<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="text-center pt-5 my-3">
                    <img src="<?= base_url('') . 'assets/images/' . $configs['image']; ?>" alt="logo" width="200" class="mb-3">
                    <h1><span class="badge badge-pill badge-dark text-uppercase"><?= $configs['application']; ?></span></h1>
                    <h5 class="text-uppercase"><?= $configs['description']; ?></h5>
                    <div class="text-center text-xs mt-4">
                        <div> <?= $configs['application']; ?></div>
                        <a href="<?= base_url(''); ?>">
                            Copyright &copy; <?= date('Y'); ?>
                            <b><?= $configs['copyright']; ?></b>
                        </a>
                        <div>powered by-<i><?= $configs['powered']; ?></i>.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>