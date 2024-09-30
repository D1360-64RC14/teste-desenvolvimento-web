<?= $this->extend('auth/auth_layout') ?>

<?= $this->section('card') ?>
<h1 class="card-title">Criar Conta</h1>

<?= $this->include('error_list') ?>

<form action="/signin" method="POST">
    <?= csrf_field() ?>

    <div class="row g-3">
        <div>
            <label class="form-label" for="signinName">Nome</label>
            <input class="form-control" type="text" name="name" id="signinName" minlength="3" value="<?= set_value('name') ?>" required autofocus>
        </div>

        <div>
            <label class="form-label" for="signinEmail">Email</label>
            <input class="form-control" type="email" name="email" id="signinEmail" minlength="3" value="<?= set_value('email') ?>" required>
        </div>

        <div>
            <label class="form-label" for="signinPassword">Senha</label>
            <input class="form-control" type="password" name="password" id="signinPassword" minlength="8" required>
        </div>

        <div>
            <label class="form-label" for="signinVerifyPassword">Confirmar Senha</label>
            <input class="form-control" type="password" name="verifyPassword" id="signinVerifyPassword" minlength="8" required>
        </div>

        <div>
            <button class="btn btn-primary w-100" type="submit">Criar</button>
        </div>
    </div>
</form>
<?= $this->endSection() ?>