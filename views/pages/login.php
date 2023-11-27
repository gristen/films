<?php
/**
 * @var \App\Kernel\View\View $view
 * @var \App\Kernel\Session\Session $session
 */
?>

<?php $view->components('start') ?>
<h1>login</h1>

<form action="/login" method="post">
    <input name="email" type="text">
    <input name="password" type="text">
    <button>login</button>
</form>


<?php $view->components('end') ?>
