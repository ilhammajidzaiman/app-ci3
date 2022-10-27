<div class="content-header text-capitalize">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?= $title . ' ' . $function; ?></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('') . $controller; ?>/create"><i class="fa-fw fa fa-plus-circle"></i> new <?= $function; ?></a></li>
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

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive-sm">
                            <table class="table m-0">
                                <thead class="text-capitalize">
                                    <tr>
                                        <th scope="col">no</th>
                                        <th scope="col">title</th>
                                        <th scope="col" width="150">created at</th>
                                        <th scope="col" width="200">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    // jika data kosong
                                    if (empty($data)) : ?>
                                        <tr>
                                            <td colspan="4" class="text-danger">data not found...</td>
                                        </tr>
                                        <?php
                                    // jika data ada
                                    else :
                                        $no = $start;
                                        foreach ($data as $data) :
                                        ?>
                                            <tr>
                                                <td><?= ++$no; ?></td>
                                                <td><?= $data['title']; ?></td>
                                                <td><small class="text-secondary"><?= $data['created_at']; ?></small>
                                                </td>
                                                <td class="text-right text-capitalize">
                                                    <a href="<?= base_url('') . $controller . '/' . $data['slug']; ?>" class="badge badge-pill badge-primary">detail</a>
                                                    <a href="<?= base_url('') . $controller . '/update/' . $data['slug']; ?>" class="badge badge-pill badge-success">update</a>
                                                    <a href="<?= base_url('') . $controller . '/delete/' . $data['slug']; ?>" onclick="return confirm('DELETE <?= $data['title']; ?> ?');" class="badge badge-pill badge-danger">delete</a>
                                                </td>
                                            </tr>

                                    <?php
                                        endforeach;
                                    endif; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer border-top">
                        <div class="row">
                            <div class="col-12">
                                <p class="text-center"><b><?= $total_result; ?></b> result</p>
                                <?= $this->pagination->create_links(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>