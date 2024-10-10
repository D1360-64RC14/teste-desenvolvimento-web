<?= $this->extend('index') ?>

<?= $this->section('body') ?>
<div class="container" style="max-width: var(--bs-breakpoint-sm);">
    <?= view('header') ?>

    <main class="mt-3">
        <div class="card">
            <div class="card-body">
                <?php $editing = isset($post['id']) ?>

                <?= $this->include('error_list') ?>
                <?= $this->include('success_list') ?>

                <form
                    action="<?= $editing ? esc('/post/' . $post['id'], 'attr') : '/post' ?>"
                    method="post">
                    <?= csrf_field() ?>

                    <?php if ($editing) : ?>
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" id="postId" value="<?= $post['id'] ?>">
                    <?php endif; ?>

                    <div class="vstack gap-2">
                        <div>
                            <input
                                class="form-control"
                                type="text"
                                name="title"
                                id="postTitle"
                                placeholder="Título"
                                value="<?= set_value('title', $post['title']) ?>"
                                required
                                autofocus>
                        </div>
                        <div>
                            <textarea
                                class="w-100 form-control"
                                name="body"
                                id="postContent"
                                placeholder="Conteúdo"
                                style="min-height: 25vh;"><?= set_value('body', $post['body']) ?></textarea>
                        </div>
                        <div>
                            <input
                                class="form-control"
                                type="url"
                                name="imageUrl"
                                id="postImage"
                                placeholder="https://imagem.com"
                                minlength="3"
                                maxlength="245"
                                oninput="loadImagePreview(this.value)"
                                value="<?= set_value('imageUrl', $post['imageUrl']) ?>">
                            <div class="invalid-feedback">
                                Link para a imagem inválido
                            </div>
                        </div>
                        <div class="text-center d-none" id="postImageContainer">
                            <img class="img-thumbnail" id="postImagePreview">
                        </div>

                        <div class="mt-2">
                            <?php if ($editing) : ?>
                                <button class="btn btn-success w-100" type="submit">
                                    Salvar
                                </button>
                            <?php else : ?>
                                <button class="btn btn-primary w-100" type="submit">
                                    Publicar
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>

<script>
    postImagePreview.addEventListener("error", () => {
        if (postImagePreview.src === window.location.href) return;
        invalidImage();
    });

    postImagePreview.addEventListener("load", () => {
        validImage();
    });

    /** @param {string} url */
    function loadImagePreview(url) {
        validImage();
        postImagePreview.src = "";
        postImageContainer.classList.add("d-none");

        if (url.length <= 0) return;
        let isURLValid = false;

        try {
            new URL(url);
            isURLValid = true;
        } catch {
            invalidImage();
        }

        if (isURLValid) {
            postImagePreview.src = url;
        }
    }

    function invalidImage() {
        postImage.classList.add("is-invalid");
        postImage.setCustomValidity("Imagem inválida");
        postImageContainer.classList.add("d-none");
    }

    function validImage() {
        postImage.classList.remove("is-invalid");
        postImage.setCustomValidity("");
        postImageContainer.classList.remove("d-none");
    }
</script>
<?= $this->endSection() ?>