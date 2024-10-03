<?= $this->extend('auth/auth_layout') ?>

<?= $this->section('card') ?>
<h1 class="card-title h2 mb-3">Recuperar Senha</h1>

<?= $this->include('error_list') ?>

<form action="/recover-password" method="POST">
    <?= csrf_field() ?>

    <div class="row g-3">
        <div>
            <label class="form-label" for="recoverEmail">Email</label>
            <?php if (isset($email)): ?>
                <input
                    class="form-control"
                    type="email"
                    name="email"
                    id="recoverEmail"
                    minlength="3"
                    value="<?= esc($email) ?>"
                    readonly>
            <?php else: ?>
                <input
                    class="form-control"
                    type="email"
                    name="email"
                    id="recoverEmail"
                    minlength="3"
                    autofocus>
            <?php endif ?>
        </div>

        <div>
            <label class="form-label" for="recoverCode">Código de Recuperação</label>
            <input
                class="form-control"
                type="text"
                name="code"
                id="recoverCode"
                minlength="6"
                maxlength="6"
                value=""
                required
                autofocus>
        </div>

        <div>
            <label class="form-label" for="recoverPassword">Nova Senha</label>
            <input class="form-control" type="password" name="password" id="recoverPassword" minlength="8" required>
        </div>

        <div>
            <label class="form-label" for="recoverVerifyPassword">Verificar Senha</label>
            <input class="form-control" type="password" name="verifyPassword" id="recoverVerifyPassword" minlength="8" required>
        </div>

        <div>
            <button class="btn btn-primary w-100" type="submit">Redefinir Senha</button>
        </div>
    </div>
</form>
<?= $this->endSection() ?>