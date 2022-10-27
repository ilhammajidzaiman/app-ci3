<section class="wrapper bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mb-5 px-5">
                <img class="w-100" src="<?= base_url('') . 'assets/article/' . $data['image']; ?>" alt="<?= $data['image']; ?>">
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

            <div class="col-md-4 mb-4 px-5">
                <div class="mb-5">
                    <h5 class="border-bottom">New</h5>
                    <ul class="fa-ul ml-4">
                        <?php foreach ($news as $data) : ?>
                            <li class="list-group-ite">
                                <span class="fa-li mr-3"><i class="fa-fw fas fa-caret-right"></i></span>
                                <a class="text-secondary" href="<?= base_url('') . $data['slug']; ?>"><?= $data['title']; ?>.</a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="mb-3">
                    <h5 class="border-bottom">Popular</h5>
                    <ul class="fa-ul ml-4">
                        <?php foreach ($populars as $datas) : ?>
                            <li class="list-group-ite">
                                <span class="fa-li mr-3"><i class="fa-fw fas fa-caret-right"></i></span>
                                <a class="text-secondary" href="<?= base_url('') . $datas['slug']; ?>"><?= $datas['title']; ?>.</a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>