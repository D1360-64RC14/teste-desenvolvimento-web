<?= $this->extend('auth/auth_layout') ?>

<?= $this->section('card') ?>
<h1 class="card-title">Criar Conta</h1>

<form action="/signin" method="POST">
    <?= csrf_field() ?>

    <div class="row g-3">
        <div>
            <label class="form-label" for="signinEmail">Email</label>
            <input class="form-control" type="email" name="email" id="signinEmail" minlength="3" value="<?= set_value('email') ?>" autofocus>
        </div>

        <div>
            <label class="form-label" for="signinPassword">Senha</label>
            <input class="form-control" type="password" name="password" id="signinPassword" minlength="8">
        </div>

        <div>
            <label class="form-label" for="signinVerifyPassword">Confirmar Senha</label>
            <input class="form-control" type="password" name="password" id="signinVerifyPassword" minlength="8">
        </div>

        <div>
            <button class="btn btn-primary w-100" type="submit">Criar</button>
        </div>
    </div>
</form>
<?= $this->endSection() ?>