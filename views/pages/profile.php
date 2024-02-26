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
        <div class="col-md-3">
            <div class="card">
                <img src="<?php echo $storage->url($user->getAvatar()) ?>" class="card-img-top" alt="User Avatar">
                <div class="card-body">
                    <h5 class="card-title ">Имя пользователя: <span class=""><?php echo $user->getName(); ?></span></h5>
                    <p class="card-text">Емайл: <?php echo $user->getEmail(); ?></p>
                    <p class="card-text ">  Статус: <small>
                      <?php echo $user->getUserRole() ?>

                        </small>

                    <p class="card-text"><small class="text-muted">Дата регистрации: <?php echo $user->getCreateAt(); ?></small></p>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <h2 class="text-white">Избранные фильмы</h2>
            <div class="row">
                <?php foreach ($favorites as $favoriteMovie) { ?>
                    <div class="col-md-4 mb-4">
                        <div style="height: 368px" class="card">
                            <img src="<?php echo $storage->url($favoriteMovie->getPreview()) ?>" style="height: 200px; width: 270px;" class="card-img-top" alt="<?php echo $favoriteMovie->getName() ?>">
                            <div class="card-body">
                                <input name="movie_id" type="hidden" value="<?php echo $favoriteMovie->getId() ?>">
                                <h5 class="card-title"><?php echo $favoriteMovie->getName() ?></h5>
                                <p class="card-text"><?php echo $favoriteMovie->getDescription() ?></p>
                                <?php if ($user->getRole() == 2 || $user->getId() === $auth->user()->getId()) ?>
                                <button class="btn btn-danger btn_del" style="position: absolute;bottom:10px;">Удалить из избранного</button>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
</div>
<script>

    $(document).ready(function () {
        $('body').on('click', '.btn_del', function (event) {
            event.preventDefault();

            // Получение ID фильма из скрытого поля
            var movie_id = $(this).closest('.card-body').find("input[name='movie_id']").val();
            var user_id = <?php echo $auth->user()->getId();?>;

            // Сохранение ссылки на текущий контекст для использования внутри функции обратного вызова AJAX
            var currentButton = $(this);

            // AJAX-запрос на сервер для удаления фильма из избранного
            $.ajax({
                method: "get",
                url: "/favorites/destroy",
                data: {
                    movie_id: movie_id,
                    user_id: user_id,
                }
            })
                .done(function (response) {
                    // Обработка успешного ответа от сервера
                    console.log("Фильм удален из избранного");
                    console.log(response);

                    // Удаление родительского элемента, содержащего информацию о фильме
                    currentButton.closest('.col-md-4').remove();
                });
        });
    });

</script>
<?php $view->components('end'); ?>
