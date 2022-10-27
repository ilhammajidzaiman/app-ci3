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
        <div class="row">
            <div class="col-md-3">
                <img class="img-fluid img-thumbnail w-100" src="<?= base_url(''); ?>assets/article/<?= $data['image'] ?>" alt="<?= $data['image'] ?>">
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="border-bottom">
                            <div class="text-secondary mb-2">
                                <small>
                                    <i class="fa-fw fas fa-calendar"></i> <?= date('d-m-Y.', strtotime($data['created_at'])); ?>
                                    <i class="fa-fw fas fa-clock"></i> <?= date('H:i.', strtotime($data['created_at'])); ?>
                                    <i class="fa-fw fas fa-eye"></i> <?= $data['counter']; ?>.
                                    <i class="fa-fw fas fa-user"></i><?= $data['name']; ?>.
                                    <i class="fa-fw fas fa-bookmark"></i>
                                    <?php
                                    if (empty($categorys)) : ?>
                                        <span class="text-danger">data not found...</span>
                                        <?php
                                    else :
                                        foreach ($categorys as $category) :
                                        ?>
                                            #<?= $category['category']; ?>
                                            <?php
                                        endforeach;
                                    endif;
                                            ?>.
                                </small>
                            </div>
                            <h5><?= $data['title']; ?></h5>
                        </div>
                        <div><?= $data['article']; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>