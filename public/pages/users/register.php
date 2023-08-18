<?php

use app\Services\Page;
use app\Views\Views;

?>
<!doctype html>
<html lang="en">
<?php Page::part("header"); ?>
<body>
<?php Page::part("nav"); ?>
<div class="container">
    <div class="error">
        <?php if (!empty($error)): ?>
            <div style="background-color: red;padding: 5px;margin: 15px"><?= $error ?></div>
        <?php endif; ?>
    </div>
            <div class="col-lg-12 mt-5">
                <form action="/users/register" method="post">
                <div class="mb-3">
                    <div class="msg"></div>
                    <label for="exampleInputEmail1" class="form-label text">  Email</label>
                    <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">Мы никогда не будем делиться вашей электронной почтой с кем-либо еще.</div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label text">Имя</label>
                    <input name="username" type="text" class="form-control" id="username" aria-describedby="emailHelp">
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label text">Пароль</label>
                    <input name="password" type="password" class="form-control" id="password">
            </div>
                <!--           <div class="mb-3">-->
<!--                    <label for="exampleInputPassword1" class="form-label text">Повторите пароль</label>-->
<!--                    <input name="pass_conf" type="password" class="form-control" id="pass_conf">-->
<!--                </div>-->
<!--                <div class="mb-3">-->
<!--                    <label for="exampleInputEmail1" class="form-label text">Фото</label>-->
<!--                    <input type="file" name="avatar" class="form-control" id="avatar" aria-describedby="emailHelp">-->
<!--                </div>-->
                <button type="submit" id="register" class="btn btn-primary">Войти</button>
    </form>

</div>
</div>
        </div>

        


<!--<script src="../../assets/js/ajax.js"></script>-->


</body>
</html>