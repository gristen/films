<?php
/**
 * @var \App\Kernel\View\View $view
 * @var \App\Kernel\Session\Session $session
 */
?>

<?php $view->components('start') ?>
<h1>register</h1>
<?php if ($session->has('email')) {?>
<ul>
    <?php foreach ($session->getFlash('email') as $error) {?>
        <li class="danger">
            <?= $error?>
        </li>
    <?php } ?>

</ul>
<?php } ?>
<form action="/register" method="post">
    <input name="email" type="text">
    <input name="password" type="text">
    <button>register</button>
</form>


<?php $view->components('end') ?>
