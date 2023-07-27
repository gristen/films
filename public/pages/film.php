<?php
use app\Services\Page;
?>

<?php Page::part("header"); ?>
<body>
<?php Page::part("nav"); ?>

<div class="container">
    <div class="row">
        <div class="col-lg-5">
            <video class="w-100 mt-5" src=<?="../uploads/films/".$film['film_path']?> controls muted></video>
        </div>
        <div class="col-lg-7">
            <h1 class="text text-center text-bg-dark"><?=$film["name"]?></h1>
            <p class="text mt-3 text-bg-dark">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque deleniti hic nisi tenetur? A ab adipisci delectus dolorum eos est eveniet harum in iste itaque magnam maxime nesciunt nobis nulla numquam officia officiis optio perferendis quae quas, qui quod reiciendis saepe sequi sint voluptatem, voluptates! Beatae deleniti, impedit iste molestiae odio officia pariatur quaerat? Accusamus adipisci atque commodi cum distinctio exercitationem expedita fugit iusto magni perferendis quisquam quo quod repellat similique, soluta sunt suscipit temporibus unde vel veritatis? Cumque, dignissimos, quas. Ab aperiam, beatae consectetur corporis culpa debitis dolorem eligendi enim error eum fugit hic incidunt itaque iure, labore minima nam nihil nobis quas quia quidem repellat reprehenderit repudiandae saepe sint vel voluptates. Aliquid aperiam cum cumque doloremque dolorum facilis harum ipsam laudantium officia omnis praesentium quaerat rem repellendus repudiandae, sint soluta velit voluptas. Ad iure, iusto laboriosam porro praesentium quasi vitae! Consectetur distinctio dolores error excepturi harum iste itaque iusto maxime molestiae non nulla optio provident quae quis, quo repellendus ut veritatis voluptate. A ad consequuntur corporis culpa distinctio dolorum ea earum eos eum, impedit in incidunt inventore iusto laborum laudantium maiores, molestias necessitatibus nisi odio officia officiis optio possimus quisquam quo reiciendis saepe sed sint sit tempora voluptatibus!</p>
        </div>
    </div>

</div>

</body>
</html>