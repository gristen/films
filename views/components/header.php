<?php
/**`
 * @var \App\Kernel\auth\AuthInterface $auth
 */
$user = $auth->user();

?>
<header>
    <h3>
<?php if ($auth->check()) { ?>
     <h3>user:<?php echo $user->getEmail() ?></h3>
    </h3>
    <form action="/logout" method="post">
        <button>logout</button>
    </form>

    <?php } ?>
    <hr>
</header>