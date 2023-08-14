<?php
use app\Services\Page;
?>
<!doctype html>
<html lang="en">
<?php Page::part("header"); ?>
<body class="custom-bg">>
<?php Page::part("nav"); ?>
<div class="container">
    <div class="main">
    <div class="line"></div>
    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item  active" data-bs-interval="10000">
      <img src="https://media.licdn.com/dms/image/C4D12AQF_41j5aVcKew/article-cover_image-shrink_600_2000/0/1520136585968?e=2147483647&v=beta&t=pUQ64IdWdX9X8qOLrdjHRMB_ODT7fgr2DW4n4VXvrLI" class="d-block w-100 carusel-image-size " alt="...">
    </div>
   <!-- <div class="carousel-item" data-bs-interval="2000">
      <img src="https://ixbt.online/gametech/covers/2022/04/22/nova-filepond-ya9NlO.jpg" class="d-block w-100 h-50" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://n1s1.hsmedia.ru/a8/47/3b/a8473bbc298e0208d26a2c695bae8a2e/728x409_0xac120004_2025919661677512805.jpeg" class="d-block w-100" alt="...">
    </div>--!>
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
        <h1 class="Films mb-5 mt-2 text-white">  Смотреть кино</h1>
        <div class="col-lg-12 d-flex justify-content-around">
            <?php foreach ($films as $film): ?>
                <a  class="text-decoration-none" href="film/<?=$film->getId();?>">
                    <div class="card-custom" style="width: 18rem;">
                        <img src="/uploads/preview-films/<?=$film->getFilmPreviewPath()?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title mt-1  text-white"><?=$film->getName();?></h5>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

</body>
</html>