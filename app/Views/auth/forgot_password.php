<?= $this->extend('auth/auth_layout') ?>

<?= $this->section('card') ?>
<h1 class="card-title">Recuperar Senha</h1>

<form action="/forgot-password" method="POST">
    <?= csrf_field() ?>

    <div class="row g-3">
        <div>
            <label class="form-label" for="forgottenEmail">Email</label>
            <input class="form-control" type="email" name="email" id="forgottenEmail" minlength="3" value="<?= set_value('email') ?>" required autofocus>
        </div>

        <div>
            <button class="btn btn-primary w-100" type="submit">Enviar Código de Recuperação</button>
        </div>
    </div>
</form>
<?= $this->endSection() ?>