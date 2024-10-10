<?= $this->extend('index') ?>

<?= $this->section('body') ?>
<div class="container" style="max-width: var(--bs-breakpoint-sm);">
    <?= view('header') ?>

    <div class="card mt-3" id="<?= esc('post-' . $post['id'], 'attr') ?>">
        <div class="card-body">
            <h4 class="d-flex align-items-center">
                <span class="h5 flex-grow-1"><?= esc($post['title']) ?></span>
                <span class="h6 text-secondary ms-auto">
                    <?= esc($user['email']) ?>
                </span>
            </h4>
            <p><?= esc($post['body']) ?></p>

            <div class="text-center">
                <img class="img-thumbnail" src="<?= esc($post['image_url'], 'attr') ?>">
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>