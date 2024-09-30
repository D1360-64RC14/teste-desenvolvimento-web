<?= $this->extend('auth/auth_layout') ?>

<?= $this->section('card') ?>
<h1 class="card-title">Recuperar Senha</h1>

<form action="/recover-password" method="POST">
    <?= csrf_field() ?>

    <div class="row g-3">
        <div>
            <label class="form-label" for="recoverEmail">Email</label>
            <input class="form-control" type="email" name="email" id="recoverEmail" minlength="3" value="<?= esc($email) ?>" disabled>
        </div>

        <div>
            <label class="form-label" for="recoverCode">Código de Recuperação</label>
            <input class="form-control" type="text" name="code" id="recoverCode" minlength="6" maxlength="6" value="<?= set_value('code') ?>" autofocus>
        </div>

        <div>
            <label class="form-label" for="recoverPassword">Nova Senha</label>
            <input class="form-control" type="password" name="password" id="recoverPassword" minlength="8">
        </div>

        <div>
            <label class="form-label" for="recoverVerifyPassword">Verificar Senha</label>
            <input class="form-control" type="password" name="verifyPassword" id="recoverVerifyPassword" minlength="8">
        </div>

        <div>
            <button class="btn btn-primary w-100" type="submit">Enviar Código de Recuperação</button>
        </div>
    </div>
</form>
<?= $this->endSection() ?>