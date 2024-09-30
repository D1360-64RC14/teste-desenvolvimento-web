<?= $this->extend('auth/auth_layout') ?>

<?= $this->section('card') ?>
<h1 class="card-title">Entrar</h1>

<?= $this->include('error_list') ?>

<form action="/login" method="POST">
    <?= csrf_field() ?>

    <div class="row g-3">
        <div>
            <label class="form-label" for="loginEmail">Email</label>
            <input class="form-control" type="email" name="email" id="loginEmail" minlength="3" value="<?= set_value('email') ?>" required autofocus>
        </div>

        <div>
            <label class="form-label" for="loginPassword">Senha</label>
            <input class="form-control" type="password" name="password" id="loginPassword" minlength="8" required>
        </div>
        <div class="d-flex justify-content-between">
            <a class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="/forgot-password">Esqueci minha senha</a>
            <a class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="/signin">Criar conta</a>
        </div>

        <div>
            <button class="btn btn-primary w-100" type="submit">Entrar</button>
        </div>
    </div>
</form>
<?= $this->endSection() ?>