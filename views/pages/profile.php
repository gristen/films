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
                <?php if ($_GET['id']==$auth->id()){ ?>
                <button type="button" class="btn btn-primary btn btn-success p-3  btn-sm btn-block"
                        data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Редактировать профиль</button>
                <?php } ?>
           </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" enctype="multipart/form-data" action="/user/update">
                            <div class="mb-3">
                                <input type="hidden" name="id" value="<?php echo $user->getId(); ?>">
                                <label for="recipient-name" class="col-form-label">Имя пользователя</label>
                                <input name="name" value="<?php echo $user->getName()?>" type="text" class="form-control" id="recipient-name">
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Выберите аватар</label>
                                <input class="form-control" type="file" name="image" id="formFile">
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <h2 class="text-white mb-4">Профиль пользователя</h2>
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title" style="color:<?php echo $user->getNicknameStyle()?>;">Имя пользователя: <?php echo $user->getName(); ?></h5>
                    <p class="card-text">Email: <?php echo $user->getEmail(); ?></p>
                    <p class="card-text">Статус: <?php echo $user->getUserRole(); ?></p>
                    <p class="card-text">Дата регистрации: <?php echo $user->getCreateAt(); ?></p>

                </div>
            </div>
            <h2 class="text-white mb-4">Избранные фильмы</h2>
            <div class="row">
                <?php foreach ($favorites as $favoriteMovie) { ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="<?php echo $storage->url($favoriteMovie->getPreview()) ?>" class="card-img-top" alt="<?php echo $favoriteMovie->getName() ?>">
                            <div class="card-body">
                                <input name="movie_id" type="hidden" value="<?php echo $favoriteMovie->getId() ?>">
                                <h5 class="card-title"><?php echo $favoriteMovie->getName() ?></h5>
                                <p class="card-text"><?php echo $favoriteMovie->getDescription() ?></p>
                                <?php if ($user->getRole() == 2 || $user->getId() === $auth->user()->getId()) { ?>
                                    <button class="btn btn-danger btn_del">Удалить из избранного</button>
                                <?php } ?>
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
