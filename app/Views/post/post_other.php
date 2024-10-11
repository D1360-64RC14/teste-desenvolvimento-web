<?= $this->extend('index') ?>

<?= $this->section('body') ?>
<div class="container" style="max-width: var(--bs-breakpoint-sm);">
    <?= view('header') ?>

    <main class="card mt-3 mb-5" id="<?= esc('post-' . $postWithUser['id'], 'attr') ?>">
        <div class="card-body">
            <h4 class="d-flex align-items-center">
                <span class="h5 flex-grow-1 mb-0"><?= esc($postWithUser['title']) ?></span>
                <span class="h6 text-secondary mb-0">
                    <?= esc($postWithUser['user_email']) ?>
                </span>
            </h4>
            <p><?= esc($postWithUser['body']) ?></p>

            <?php if (!empty($postWithUser['image_url'])) : ?>
                <div class="text-center">
                    <img class="img-thumbnail" src="<?= esc($postWithUser['image_url'], 'attr') ?>">
                </div>
            <?php endif; ?>
        </div>
    </main>
</div>
<?= $this->endSection() ?>