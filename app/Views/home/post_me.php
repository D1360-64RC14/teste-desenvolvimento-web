<article class="card bg-tertiary" id="post-<?= $post['id'] ?>">
    <div class="card-body">
        <h4 class="d-flex align-items-center">
            <span class="h5 flex-grow-1"><?= $post['user'] ?></span>
            <span class="h6 text-secondary ms-auto">
                <?= $post['email'] ?>
            </span>
        </h4>
        <p><?= $post['message'] ?></p>
    </div>
</article>