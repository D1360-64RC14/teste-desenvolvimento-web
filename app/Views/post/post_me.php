<?= $this->extend('index') ?>

<?= $this->section('body') ?>
<div class="container" style="max-width: var(--bs-breakpoint-sm);">
    <?= view('header') ?>

    <div class="card mt-3" id="<?= esc('post-' . $post['id'], 'attr') ?>">
        <div class="card-body">
            <h4 class="d-flex align-items-center">
                <span class="h5 flex-grow-1 mb-0"><?= esc($post['title']) ?></span>
                <span class="h6 text-secondary mb-0">
                    <?= esc($user['email']) ?>
                </span>
                <div class="dropdown text-secondary ms-1">
                    <button class="btn btn-sm dropdow-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a
                                class="dropdown-item"
                                href="<?= esc('/post/' . $post['id'] . '/edit', 'attr') ?>">Editar</a>
                        </li>
                        <li>
                            <a
                                class="dropdown-item text-danger"
                                href="<?= esc('/post/' . $post['id'] . '/delete', 'attr') ?>">Excluir</a>
                        </li>
                    </ul>
                </div>
            </h4>
            <p><?= esc($post['body']) ?></p>

            <?php if (!empty($post['image_url'])) : ?>
                <div class="text-center">
                    <img class="img-thumbnail" src="<?= esc($post['image_url'], 'attr') ?>">
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>