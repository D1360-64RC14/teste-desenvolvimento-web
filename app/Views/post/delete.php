<?= $this->extend('index') ?>

<?= $this->section('body') ?>
<div class="container" style="max-width: var(--bs-breakpoint-sm);">
    <?= view('header', ['backUrl' => '/post/' . $post['id']]) ?>

    <div class="card border-danger mt-3">
        <div class="card-body">
            <p class="card-text">Tem certeza que deseja excluir este post?</p>
            <span class="row g-1">
                <form class="col-12 col-sm-auto" action="<?= esc('/post/' . $post['id'], 'attr') ?>" method="POST">
                    <?= csrf_field() ?>

                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger w-100">Sim, excluir</button>
                </form>
                <span class="col-12 col-sm-auto">
                    <a href="<?= esc('/post/' . $post['id'], 'attr') ?>" class="btn btn-secondary w-100">Não, cancelar</a>
                </span>
            </span>
        </div>
    </div>

    <div class="card mt-3" id="<?= esc('post-' . $post['id'], 'attr') ?>">
        <div class="card-body">
            <h4 class="d-md-none">
                <span class="h5 d-block flex-grow-1 mb-0"><?= esc($post['title']) ?></span>
                <span class="h6 text-secondary mb-0">
                    <?= esc($user['email']) ?>
                </span>
            </h4>
            <h4 class="d-none d-md-flex align-items-center">
                <span class="h5 flex-grow-1 mb-0"><?= esc($post['title']) ?></span>
                <span class="h6 text-secondary mb-0">
                    <?= esc($user['email']) ?>
                </span>
            </h4>
            <p><?= esc($post['body']) ?></p>

            <?php if (!empty($post['image_url'])) : ?>
                <div class="text-center">
                    <img class="img-thumbnail" src="<?= esc($post['image_url'], 'attr') ?>">
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>