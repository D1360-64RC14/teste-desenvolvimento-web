<?= $this->extend('index') ?>

<?= $this->section('body') ?>
<div class="container" style="max-width: var(--bs-breakpoint-sm);">
    <?= view('header') ?>

    <?php if ($postWithUser['user_id'] === $user['id']) : ?>
        <?= view('post/post_me', compact('postWithUser')) ?>
    <?php else: ?>
        <?= view('post/post_other', compact('postWithUser')) ?>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>