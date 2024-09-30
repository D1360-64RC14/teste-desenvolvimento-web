<?php if (session()->has('successes')) : ?>
    <div class="alert alert-success">
        <ul class="m-0">
            <?php foreach (session('successes') as $success) : ?>
                <li><?= esc($success) ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif ?>