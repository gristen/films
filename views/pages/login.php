<?php
/**
 * @var \App\Kernel\View\ViewInterface $view
 * @var \App\Kernel\Session\SessionInterface $session
 */
?>

<?php $view->components('start'); ?>

    <main class="form-signin w-100 m-auto">
        <form action="/login" method="post">
            <?php if ($session->has('error')) { ?>
                <div class="alert alert-danger">
                    <?php echo $session->getFlash('error') ?>
                </div>
            <?php } ?>
            <div class="d-flex" style="align-items: center; justify-content: space-between">
                <h2 class="text-white text-center ">Вход</h2>

            </div>
            <div class="form-floating mt-3">
                <input
                        type="email"
                        class="form-control"
                        name="email"
                        id="floatingInput"
                        placeholder="name@areaweb.su"
                >
                <label for="floatingInput">E-mail</label>
            </div>
            <div class="form-floating">
                <input
                        type="password"
                        name="password"
                        class="form-control"
                        id="floatingPassword"
                        placeholder="Пароль"
                >
                <label for="floatingPassword">Пароль</label>
            </div>
            <button class="btn btn-primary w-100 py-2" type="submit">Войти</button>
            <p class="mt-5 mb-3 text-body-secondary">&copy; Кинопоиск Lite 2023</p>
        </form>
    </main>

<?php $view->components('end'); ?>