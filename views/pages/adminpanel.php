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

<div class="row">
    <div class="sidebar col-4">
       <ul>
        <li>
            <a href="">Админ панель</a>
        </li>
        <li>
            <a href="">Админ панель</a>
        </li>
       </ul> 
    </div>
    <div class ="posts col-8">
        <div class="row">
         <div class="title col-5">Название</div>
         <div class="red col-2">Редактировать</div> 
         <div class="del col-2">Удалить</div>   
        </div>
        <div class ="row post">
        <div class="row">
         <div class="title col-5">сударь</div>
         <div class="red col-2"><a href=""> edit</a></div> 
         <div class="del col-2"><a href=""> delete</a></div>   
        </div>

    </div>
</div>
</div>


     <!-- <div class="ss col-4">
     <h1 class="admh">Admin panel</h1>   
     <div class="linet"></div>
     <h2 class="admhtwo">Список фильмов</h2>
     </div>


        
        <div class ="posts col-8">
        <div class="title col-5">Название</div>
        <div class="red col-2">Редактировать</div>
        <div class="del col-2">Удалить</div>
     </div> -->
 
 
       
        


<!--<script src="../../assets/js/ajax.js"></script>-->

</div>
</body>
</html>