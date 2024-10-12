<main class="card mt-3 mb-5" id="<?= esc('post-' . $postWithUser['id'], 'attr') ?>">
    <div class="card-body">
        <h4 class="d-flex align-items-center">
            <span class="h5 flex-grow-1 mb-0"><?= esc($postWithUser['title']) ?></span>
            <span class="h6 text-secondary mb-0">
                <?= esc($postWithUser['user_email']) ?>
            </span>
            <div class="dropdown text-secondary ms-1">
                <button class="btn btn-sm dropdow-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a
                            class="dropdown-item"
                            href="<?= esc('/post/' . $postWithUser['id'] . '/edit', 'attr') ?>">Editar</a>
                    </li>
                    <li>
                        <a
                            class="dropdown-item text-danger"
                            href="<?= esc('/post/' . $postWithUser['id'] . '/delete', 'attr') ?>">Excluir</a>
                    </li>
                </ul>
            </div>
        </h4>
        <p style="white-space: pre-wrap;"><?= esc($postWithUser['body']) ?></p>

        <?php if (!empty($postWithUser['image_url'])) : ?>
            <div class="text-center">
                <img class="img-thumbnail" src="<?= esc($postWithUser['image_url'], 'attr') ?>">
            </div>
        <?php endif; ?>
    </div>
</main>