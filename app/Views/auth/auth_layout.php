<?= $this->extend('index') ?>

<?= $this->section('body') ?>
<main class="container-md" style="max-width: var(--bs-breakpoint-sm); margin-top: 15vh">
    <div class="card">
        <div class="card-body">
            <?= $this->renderSection('card') ?>
        </div>
    </div>
</main>
<?= $this->endSection() ?>