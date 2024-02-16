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
    <h3 class="mt-3">Топ 10 фильмов</h3>
        <div class="movies">
    <?php foreach ($movies as $movie) { ?>
        <a href="/movie?id=<?php echo $movie->getId()?>" class="card text-decoration-none movies__item">
            <img src="<?php echo $storage->url($movie->getPreview()); ?>" height="200px" class="card-img-top" alt="">
            <div class="card-body">
                <h5 class="card-title"><?php echo $movie->getName(); ?></h5>
                <p class="card-text">Оценка <span class="badge bg-warning warn__badge"><?php echo $movie->avgRating() ?></span></p>
                <p class="card-text"><?php echo $movie->getDescription(); ?></p>
            </div>
        </a>
    <?php } ?>
        </div>
    </div>
</main>
<?php $view->components('end'); ?>