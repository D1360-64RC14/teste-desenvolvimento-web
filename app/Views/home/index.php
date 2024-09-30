<?= $this->extend('index') ?>

<?= $this->section('body') ?>
<main class="container">
    <h1>Hello, <?= session('user')['name'] ?>!</h1>
</main>
<?= $this->endSection() ?>