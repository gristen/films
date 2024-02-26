<?php
/**
 * @var \App\Kernel\View\ViewInterface $view
 * @var \App\Kernel\Storage\StorageInterface $storage
 * @var array<\App\Models\Category> $categories
 */
?>
<?php $view->components('start'); ?>
<main>

    <div class="container">
        <h3 class="mt-3 text-white">Жанры</h3>
        <hr>
        <div class="movies">
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
