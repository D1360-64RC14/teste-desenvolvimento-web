<a class="text-decoration-none" href="<?= esc('/post/' . $postWithUser['id'], 'attr') ?>">
    <article
        class="card"
        id="<?= esc('post-' . $postWithUser['id'], 'attr') ?>"
        style="background-color: var(--bs-tertiary-bg)">
        <div class="card-body">
            <h4 class="d-flex align-items-center">
                <span class="h5 flex-grow-1 mb-0">
                    <?= esc($postWithUser['title']) ?>
                </span>
                <span class="h6 text-secondary ms-auto mb-0">
                    <?= esc($postWithUser['email']) ?>
                </span>
            </h4>
            <p><?= esc($postWithUser['body']) ?></p>

            <?php if (!empty($postWithUser['image_url'])) : ?>
                <div class="text-center">
                    <img class="img-thumbnail" src="<?= esc($postWithUser['image_url'], 'attr') ?>">
                </div>
            <?php endif; ?>
        </div>
    </article>
</a>