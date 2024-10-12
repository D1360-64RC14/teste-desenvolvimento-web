<a class="text-decoration-none" href="<?= esc('/post/' . $postWithUser['id'], 'attr') ?>">
    <article class="card" id="<?= esc('post-' . $postWithUser['id'], 'attr') ?>">
        <div class="card-body">
            <h4 class="d-md-none">
                <span class="h5 d-block flex-grow-1 mb-0"><?= esc($postWithUser['title']) ?></span>
                <span class="h6 text-secondary mb-0">
                    <?= esc($postWithUser['user_email']) ?>
                </span>
            </h4>
            <h4 class="d-none d-md-flex align-items-center">
                <span class="h5 flex-grow-1 mb-0">
                    <?= esc($postWithUser['title']) ?>
                </span>
                <span class="h6 text-secondary ms-auto mb-0">
                    <?= esc($postWithUser['user_email']) ?>
                </span>
            </h4>
            <p style="white-space: pre-wrap;"><?= esc($postWithUser['body']) ?></p>

            <?php if (!empty($postWithUser['image_url'])) : ?>
                <div class="text-center">
                    <img class="img-thumbnail" src="<?= esc($postWithUser['image_url'], 'attr') ?>">
                </div>
            <?php endif; ?>
        </div>
    </article>
</a>