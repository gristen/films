<?php
/**
 * @var \App\Kernel\View\ViewInterface $view
 * @var \App\Kernel\Storage\StorageInterface $storage
 * @var array<\App\Models\Movie> $newMovies
 * @var array<\App\Models\Category> $categories
 * @var array<\App\Models\Movie> $bests
 *
 */


?>
<?php $view->components('start'); ?>
<main>

    <div class="container">
        <h1 class="text-white">новые</h1>
        <div class="new d-flex">
            <?php foreach ($newMovies as $movie) { ?>
                <a href="/movie?id=<?php echo $movie->getId()?>" class="card text-decoration-none movies__item mx-2">
                    <img    src="<?php echo $storage->url($movie->getPreview()); ?>" height="150px" class="card-img-top" alt="">
                    <div  class="card-body">
                        <h5 class="card-title"><?php echo $movie->getName(); ?></h5>
                        <p class="card-text">Оценка <span class="badge bg-warning warn__badge"><?php echo $movie->avgRating() ?></span></p>
                        <p class="card-text"><?php echo $movie->getDescription(); ?></p>
                    </div>
                </a>
            <?php } ?>
        </div>
        <h1 class="text-white">лучшиее</h1>
        <div class="new d-flex">
            <?php foreach ($bests as $best) { ?>
                <a href="/movie?id=<?php echo $best->getId()?>" class="card text-decoration-none movies__item mx-2">
                    <img    src="<?php echo $storage->url($movie->getPreview()); ?>" height="150px" class="card-img-top" alt="">
                    <div  class="card-body">
                        <h5 class="card-title"><?php echo $movie->getName(); ?></h5>
                        <p class="card-text">Оценка <span class="badge bg-warning warn__badge"><?php echo $movie->avgRating() ?></span></p>
                        <p class="card-text"><?php echo $movie->getDescription(); ?></p>
                    </div>
                </a>
            <?php } ?>
        </div>
        <h1 class="text-white">категории</h1>
        <div class="new d-flex">
            <?php foreach ($categories as $category){ ?>

                <a href="/category?filter=<?php echo $category->getName()?>" class="card text-decoration-none movies__item">
                    <img src="<?php echo $storage->url($category->getPreview())?>" height="200px" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $category->getName() ?>></h5>
                        <!-- <p class="card-text">Фильмов <span class="badge bg-info warn__badge">10</span></p>-->
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>
</main>
<?php $view->components('end'); ?>