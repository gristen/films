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
<div class="line"></div>
    <?php if (!empty($error)): ?>
        <div class="erormesg"><?= $error ?></div>
    <?php endif; ?>
    <form method="post" id="FormReg" action="register" enctype="multipart/form-data" >
        <div class="row">
            <div class="col-lg-6 mt-5">
                <img src="https://ixbt.online/gametech/covers/2022/04/22/nova-filepond-ya9NlO.jpg" alt="" class="photu">
            
            </div>
            <div class="col-lg-5 mt-5">
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
                </div> <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label text">Повторите пароль</label>
                    <input name="pass_conf" type="password" class="form-control" id="pass_conf">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label text">Фото</label>
                    <input type="file" name="avatar" class="form-control" id="avatar" aria-describedby="emailHelp">
                </div>
                <button type="submit" id="register" class="btn btn-primary">Войти</button>
    </form>

</div>
</div>
        </div>
        <p class="aft">Почему ты еще не авторизован!</p>
        <div class="wrapper">
            <header class="header">Я фывф</header>  
            <main class="main">Я фывф</main> 
            <footer class="footer">Я фывф</footer> 
        </div>
        </div>
        


<!--<script src="../../assets/js/ajax.js"></script>-->


</body>
</html>