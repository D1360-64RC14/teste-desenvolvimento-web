<a class="text-decoration-none" href="<?= esc('/post/' . $postWithUser['id'], 'attr') ?>">
    <article class="card" id="<?= esc('post-' . $postWithUser['id'], 'attr') ?>">
        <div class="card-body">
            <h4 class="d-flex align-items-center">
                <span class="h5 flex-grow-1">
                    <?= esc($postWithUser['title']) ?>
                </span>
                <span class="h6 text-secondary ms-auto">
                    <?= esc($postWithUser['email']) ?>
                </span>
            </h4>
            <p><?= esc($postWithUser['body']) ?></p>
        </div>
    </article>
</a>