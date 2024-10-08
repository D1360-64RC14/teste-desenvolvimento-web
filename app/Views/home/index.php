<?= $this->extend('index') ?>

<?= $this->section('body') ?>
<div class="container" style="max-width: var(--bs-breakpoint-sm);">
    <?= view('header') ?>

    <main class="mt-3 vstack gap-2">
        <?php foreach ($posts as $post) : ?>
            <?php if ($post['id'] === session('user')['id']) : ?>
                <?= view('home/post_me', compact('post')) ?>
            <?php else: ?>
                <?= view('home/post_other', compact('post')) ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </main>
</div>
<?= $this->endSection() ?>