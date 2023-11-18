<?php
/**
 * @var \App\Kernel\View\View $view
 * @var \App\Kernel\Session\Session $session
 */
?>

<?php $view->components('start'); ?>
<h1>add page</h1>
<form action="/admin/movies/add" method="POST">
    <p>name</p>
    <input name="name" type="text">
    <?php

if ($session->has('name')) { ?>

    <ul>
    <?php foreach ($session->getFlash('name') as $error) { ?>
        <li style="color: red" class="danger">
             <?= $error?>
        </li>
        <?php } ?>
    </ul>

    <?php }?>
    <button>Добавить</button>
</form>
<?php $view->components('end') ?>
