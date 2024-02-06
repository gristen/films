<?php
/**
 * @var \App\Kernel\Auth\AuthInterface $auth
 * @var \App\Kernel\View\ViewInterface $view
 * @var \App\Kernel\Session\SessionInterface $session
 * @var \App\Kernel\Storage\StorageInterface $storage
 * @var \App\Models\Movie $movie
 * @var \App\Models\Review $review
 * @var \App\Kernel\auth\User $user
 * @var array<\App\Models\Movie> $favorites
 */
?>

<?php $view->components('start'); ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <img src="<?php echo $storage->url($user->getAvatar()) ?>" class="card-img-top" alt="User Avatar">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $user->getName(); ?></h5>
                    <p class="card-text"><?php echo $user->getEmail(); ?></p>
                    <p class="card-text"><small class="text-muted">Зарегистрирован: <?php echo $user->getCreateAt(); ?></small></p>
                    <p class="card-text"><small class="text-muted">Статус: <?php echo $user->getRole() ? 'Администратор' : 'Пользователь'; ?></small></p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <h2>Избранные фильмы</h2>
            <div class="row">
                <?php foreach ($favorites as $favoriteMovie) { ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="<?php echo $storage->url($favoriteMovie->getPreview()) ?>" class="card-img-top" alt="<?php echo $favoriteMovie->getName() ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $favoriteMovie->getName() ?></h5>
                                <p class="card-text"><?php echo $favoriteMovie->getDescription() ?></p>
                                <p class="card-text btn btn-outline-info"><?php echo $favoriteMovie->avgRating() ?></p>
                                <a href="#" class="btn btn-primary">Подробнее</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php $view->components('end'); ?>
