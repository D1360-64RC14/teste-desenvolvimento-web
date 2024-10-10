<header class="mt-2">
    <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center px-3 py-2">
            <?php if (! isset($action)) : ?>
                <a href="/" class="btn btn-sm btn-secondary" title="Voltar">
                    <i class="bi bi-chevron-left"></i>
                </a>
            <?php elseif ($action === 'createPost') : ?>
                <a href="/post" class="btn btn-sm btn-primary" title="Postar algo...">
                    <i class="bi bi-plus-circle"></i>
                </a>
            <?php endif; ?>
            <span>
                Olá, <?= esc(session('user')['name']) ?>!
            </span>
            <a href="/logout" class="btn btn-sm btn-danger" title="Sair">
                <i class="bi bi-box-arrow-right"></i>
            </a>
        </div>
    </div>
</header>