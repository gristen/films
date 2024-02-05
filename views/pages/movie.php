<?php
/**
 * @var \App\Kernel\Auth\AuthInterface $auth
 * @var \App\Kernel\View\ViewInterface $view
 * @var \App\Kernel\Session\SessionInterface $session
 * @var \App\Kernel\Storage\StorageInterface $storage
 * @var \App\Models\Movie $movie
 * @var \App\Models\Review $review
 * @var bool $isFavired
 */
?>

<?php $view->components('start'); ?>
    <main>
        <div class="container">
            <div class="one-movie">
                <div class="card mb-3 mt-3 one-movie__item">
                    <div class="row g-3">
                        <div class="col-md-5 position-relative">
                            <img src="<?php echo $storage->url($movie->getPreview()) ?>" class="img-fluid rounded one-movie__image" alt="<?php echo $movie->getName() ?>">
                            <?php if ($isFavired === true) {?>
                            <a id="btn_del" class="star-pass position-absolute" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                            </a>
                          <?php } else { ?>

                                <a id="btn_add" class="star-pass position-absolute" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                        <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                    </svg>
                                </a>
                            <?php } ?>

                        
                        </div>
                        <div class="col-md-7">
                            <div class="card-body d-flex flex-column">
                                <input name="movie_id" type="hidden" value="<?php echo $movie->getId() ?>">
                                <h1 class="card-title">Название: <?php echo $movie->getName()?></h1>
                                <p class="card-text">Оценка: <span class="badge bg-warning warn__badge"><?php echo $movie->avgRating() ?></span></p>
                                <p class="card-text">Описание: <?php echo $movie->getDescription()?></p>
                                <p class="card-text mt-auto"><small class="text-body-secondary">Дата публикации: <?php echo $movie->getCreatedAt()?></small></p>
                            </div>
                        </div>
                    <div class="film">
                        <div class="col-md-12 mt-5 mb-5">
                            <video controls class="img-fluid rounded one-movie__image">
                                <source src="<?php echo $storage->url($movie->getFilm()) ?>" type="video/mp4">
                                Ваш браузер не поддерживает видео.
                            </video>
                        </div>
                    </div>
                        <div class="col-md-5 d-flex justify-content-center m-auto mt-5 ">
                                <form action="/reviews/add" method="post" class="m-3 w-100 form_review">
                                    <input id="movie_id" type="hidden" value="<?php echo $movie->getId() ?>" name="id">
                                    <select
                                            class="form-select <?php echo $session->has('rating') ? 'is-invalid' : '' ?>"
                                            name="rating"
                                            aria-label="Default select example"
                                    >
                                        <option selected>Оценка</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                    <?php if ($session->has('rating')) { ?>
                                        <div id="name" class="invalid-feedback">
                                            <?php echo $session->getFlash('rating')[0] ?>
                                        </div>
                                    <?php } ?>
                                    <div class="form-floating mt-2">
                                    <textarea
                                            class="form-control <?php echo $session->has('comment') ? 'is-invalid' : '' ?>"
                                            name="comment"
                                            placeholder="Укажи свое мнение о фильме"
                                            id="floatingTextarea2"
                                            style="height: 100px"
                                    ></textarea>
                                        <label for="floatingTextarea2">Комментарий</label>
                                        <?php if ($session->has('comment')) { ?>
                                            <div id="name" class="invalid-feedback">
                                                <?php echo $session->getFlash('comment')[0] ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <button class="btn btn-primary mt-2">Оставить отзыв</button>
                                </form>
                        </div>
                                <h4 class="">Отзывы</h4>
                                <?php foreach ($movie->getReviews() as $review) { ?>
                                <div class="one-movie__reviews">
                                    <div class="card">
                                        <div class="card-header">
                                            Пользователь:   <?php echo $review->getUser()->getName() ?>
                                        </div>
                                        <div class="card-body">
                                            <blockquote class="blockquote mb-0">
                                                <p><?php echo $review->getReview()?></p>
                                                <footer class="blockquote-footer">Оценка <span class="badge bg-warning warn__badge"><?php echo $review->getRating()?></span></footer>
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        $(document).ready(function () {

            var starIcon = $(' <a id="btn_add" class="star-pass position-absolute" > <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16"> <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/> </svg></a>');
            var filledStarIcon = $('<a id="btn_del" class="star-pass position-absolute" > <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16"> <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/> </svg> </a>');


            $('body').on('click', '#btn_add', function (event) {
                event.preventDefault();
                var user_id = <?php echo $auth->id()?>;
                var movie_id = $("input[name='id']").val();


                var clonedStarIcon = starIcon.clone();
                var clonedFilledStarIcon = filledStarIcon.clone();

                clonedStarIcon.replaceWith(clonedFilledStarIcon);
                $(this).replaceWith(clonedFilledStarIcon);
                clonedFilledStarIcon.attr('id', 'btn_del');

                $.ajax({
                    method: "GET",
                    url: "/favorites",
                    data: {
                        user_id: user_id,
                        movie_id: movie_id,
                    }
                })
                    .done(function (msg) {
                        console.log(msg);
                    });
            });

            $('body').on('click', '#btn_del', function (event) {
                event.preventDefault();
                var user_id = <?php echo $auth->id()?>;
                var movie_id = $("input[name='id']").val();


                var clonedStarIcon = starIcon.clone();
                var clonedFilledStarIcon = filledStarIcon.clone();

                clonedFilledStarIcon.replaceWith(clonedStarIcon);
                $(this).replaceWith(clonedStarIcon);
                clonedStarIcon.attr('id', 'btn_add');

                $.ajax({
                    method: "GET",
                    url: "/favorites/destroy",
                    data: {
                        user_id: user_id,
                        movie_id: movie_id,
                    }
                })
                    .done(function (msg) {
                        console.log(msg);
                    });
            });
        });



    </script>

<?php $view->components('end'); ?>