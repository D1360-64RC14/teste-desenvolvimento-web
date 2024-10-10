<article class="card" id="<?= esc('post-' . $postWithUser['id'], 'attr') ?>">
    <div class="card-body">
        <h4 class="d-flex align-items-center">
            <a class="h5 flex-grow-1" href="<?= esc('/post/' . $postWithUser['id'], 'attr') ?>">
                <?= esc($postWithUser['title']) ?>
            </a>
            <span class="h6 text-secondary ms-auto">
                <?= esc($postWithUser['email']) ?>
            </span>
        </h4>
        <p><?= esc($postWithUser['body']) ?></p>
    </div>
</article>