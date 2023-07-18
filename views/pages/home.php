<?php
use app\Services\Page;
?>
<!doctype html>
<html lang="en">
<?php Page::part("header"); ?>
<body>
<?php Page::part("nav"); ?>
<div class="container">
    <div class="main">
    <div class="line"></div>
    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="10000">
      <img src="https://ixbt.online/gametech/covers/2022/04/22/nova-filepond-ya9NlO.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item" data-bs-interval="2000">
      <img src="https://ixbt.online/gametech/covers/2022/04/22/nova-filepond-ya9NlO.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://n1s1.hsmedia.ru/a8/47/3b/a8473bbc298e0208d26a2c695bae8a2e/728x409_0xac120004_2025919661677512805.jpeg" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"  data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Предыдущий</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"  data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Следующий</span>
  </button>
</div>
    <section class="categoryujas">
        <h1 class="Films mb-5 mt-2">  Смотреть кино</h1>
        <div class="col-lg-12 d-flex justify-content-around">

            <?php foreach ($films as $film):?>
            <a href="">
                <div class="card">
                    <img  src="<?="uploads/preview-films/".$film['Film_path']?>" alt="..."class="scale">
                    <p><?=$film['name']?></p>
                </div>
            </a>

                </section>


                <section class="categoryputy">
        <h1 class="Films mb-5 mt-2">  Лучшие фильмы</h1>
        <div class="col-lg-12 d-flex justify-content-around">
          
                <div class="card">
                    <img  src="<?="uploads/preview-films/".$film['Film_path']?>" alt="..."class="scale">
                    <p><?=$film['name']?></p>
                </div>

                </section>

            <?php endforeach; ?>

        </div>

    </div>

</div>
<div class="wrapper">
            <header class="header">Я фывф</header>  
            <main class="main">Я фывф</main> 
            <footer class="footer">Я фывф</footer> 
        </div>
</body>
</html>