<?php
/**
 * @var \App\Kernel\View\ViewInterface $view
 * @var \App\Kernel\Session\SessionInterface $session
 * @var array<\App\Models\Category> $categories
 * @var \App\Kernel\auth\User $user
 */
?>

<?php $view->components('start');
?>

<main>
    <div class="container">
        <h1 class="mt-5">Редактирование пользователя</h1>
        <form action="/admin/user/update" enctype="multipart/form-data" method="post" class="d-flex flex-column justify-content-center w-50 gap-2 mt-5 mb-5">

            <input  class="form-control" type="hidden" name="id" value="<?php echo $user->getId() ?>">
            <label for="email">email</label>
            <input  class="form-control" disabled name="email"  value="<?php echo $user->getEmail()?>" type="text">
            <label for="email">Имя</label>
            <input  class="form-control" name="name"  value="<?php echo $user->getName()?>" type="text">
            <label for="email">Фото профиля</label>
            <input
                    type="file"
                    class="form-control"
                    id="image"
                    name="image"
            >
            <div class="row g-2">
                <button class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>
</main>

<?php $view->components('end'); ?>
