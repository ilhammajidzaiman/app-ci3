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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3>category: <?= $data['category']; ?></h3>
                        <small class="text-secondary">
                            <div>created at: <?= $data['created_at']; ?></div>
                            <div>updated at: <?= $data['updated_at']; ?></div>
                        </small>
                        <a href="<?= base_url('') . $controller . '/update/' . $data['slug']; ?>" class="btn btn-success mt-3">update</a>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>