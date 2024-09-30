<?php if (session()->has('errors')) : ?>
    <div class="alert alert-danger">
        <ul class="m-0">
            <?php foreach (session('errors') as $error) : ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif ?>