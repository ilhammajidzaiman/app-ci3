<section class="wrapper bg-light py-5">
    <div class="container">
        <h3 class="text-center">Articles</h3>
        <hr class="mb-5">
        <div class="row justify-content-center">

            <?php foreach ($datas as $data) : ?>
                <div class="col-md-3 mb-4">
                    <div class="card shadow border-0 h-100">
                        <img class="card-img-top" src="<?= base_url('') . 'assets/article/thumbnail/' . $data['image']; ?>" alt="<?= $data['image']; ?>">
                        <div class="card-body px-3 py-2">
                            <div class="border-bottom mb-2">
                                <small class="text-secondary">
                                    <i class="fa-fw fas fa-calendar"></i><?= date('d-m-Y.', strtotime($data['created_at'])); ?>
                                    <i class="fa-fw fas fa-clock"></i><?= date('H:i.', strtotime($data['created_at'])); ?>
                                </small>
                            </div>
                            <div class="">
                                <a class="text-dark" href="<?= base_url('') . $data['slug']; ?>"><?= $data['title']; ?></a>
                            </div>
                        </div>
                        <div class="card-footer border-0 bg-white px-3 py-2">
                            <a class="badge badge-pill badge-secondary font-weight-light float-right" href="<?= base_url('') . $data['slug']; ?>">Read More...</a>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>

            <div class="col-12">
                <p class="text-center"><b><?= $total_result; ?></b> result</p>
                <?= $this->pagination->create_links(); ?>
            </div>
        </div>
    </div>
</section>