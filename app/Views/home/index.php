<?= $this->extend('index') ?>

<?= $this->section('body') ?>
<div class="container" style="max-width: var(--bs-breakpoint-sm);">
    <?= view('header', ['action' => 'createPost']) ?>

    <main class="mt-3 vstack gap-2">
        <?php foreach ($postsWithUser as $postWithUser) : ?>
            <?php if ($postWithUser['user_id'] === $user['id']) : ?>
                <?= view('home/post_me', compact('postWithUser')) ?>
            <?php else: ?>
                <?= view('home/post_other', compact('postWithUser')) ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </main>
</div>
<?= $this->endSection() ?>