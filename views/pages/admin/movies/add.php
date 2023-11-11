<?php
/**
 * @var \App\Kernel\View\View $view
 */
?>

<?php $view->components('start') ?>
<h1>add page</h1>
<form action="/admin/movies/add" method="POST">
    <p>name</p>
    <input name="name" type="text">
    <button>Добавить</button>
</form>
<?php $view->components('end') ?>
