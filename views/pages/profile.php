<?php
/**
 * @var \App\Kernel\Auth\AuthInterface $auth
 * @var \App\Kernel\View\ViewInterface $view
 * @var \App\Kernel\Session\SessionInterface $session
 * @var \App\Kernel\Storage\StorageInterface $storage
 * @var \App\Models\Movie $movie
 * @var \App\Models\Review $review
 * @var \App\Kernel\auth\User $user
 */
?>
<?php $view->components('start'); ?>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6">
                <h2>Профиль пользователя</h2>
                <ul>
                    <li><strong>Имя:</strong> <?php echo $user->getName(); ?></li>
                    <li><strong>Email:</strong> <?php echo $user->getEmail(); ?></li>
                    <li><strong>Зарегистрирован:</strong> <?php echo $user->getCreateAt(); ?></li>
                    <li><strong>Статус:</strong> <?php echo $user->getIsAdmin() ? 'Администратор' : 'Пользователь'; ?></li>
                </ul>
            </div>
            <div class="col-md-6">
                <img src="<?php echo $storage->url($user->getAvatar()) ?>" alt="">
            </div>
        </div>
    </div>
<?php $view->components('end'); ?>