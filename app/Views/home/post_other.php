<article class="card" id="<?= esc('post-' . $post['id'], 'attr') ?>">
    <div class="card-body">
        <h4 class="d-flex align-items-center">
            <a class="h5 flex-grow-1" href="<?= esc('/post/' . $post['id'], 'attr') ?>">
                <?= esc($post['title']) ?>
            </a>
            <span class="h6 text-secondary ms-auto">
                <?= esc($post['email']) ?>
            </span>
        </h4>
        <p><?= esc($post['body']) ?></p>
    </div>
</article>