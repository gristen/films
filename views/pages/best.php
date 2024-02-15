<?php
/**
 * @var \App\Kernel\View\ViewInterface $view
 * @var \App\Kernel\Storage\StorageInterface $storage
 * @var array<\App\Models\Movie> $movies
 */
?>
<?php $view->components('start'); ?>
<main>
    <div class="container">
    <h3 class="mt-3">лучшее</h3>
        <p class=" alert alert-info">Вывод топ фильмов по среднему рейтингу</p>
    </div>

</main>
<?php $view->components('end'); ?>