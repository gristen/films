<?php
/**
 * @var \App\Kernel\Auth\AuthInterface $auth
 * @var \App\Kernel\View\ViewInterface $view
 * @var \App\Kernel\Session\SessionInterface $session
 * @var \App\Kernel\Storage\StorageInterface $storage
 * @var \App\Models\Movie $movie
 * @var \App\Models\Review $review
 */
?>

<?php $view->components('start'); ?>
    <main>
        <div class="container">
            <div class="one-movie">
                <div class="card mb-3 mt-3 one-movie__item">
                    <div class="row g-3">
                        <div class="col-md-5">
                            <img src="<?php echo $storage->url($movie->getPreview()) ?>" class="img-fluid rounded one-movie__image" alt="<?php echo $movie->getName() ?>">
                            <?php if ($auth->check()) { ?>
                                <button class="btn btn-warning favorite-button" id="btn_fa">
                                    В избранное
                                </button>
                            <?php } else { ?>
                                <div class="alert alert-warning m-3 w-100">
                                    Для того, чтобы оставить отзыв, необходимо <a href="/login">авторизоваться</a>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-md-7">
                            <div class="card-body d-flex flex-column">
                                <input type="hidden" value="<?php echo $movie->getId() ?>">
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
        $(document).ready(function (){
       

            $('#btn_fa').on('click',function (event){
                event.preventDefault();
                let user_id = <?php echo $auth->id()?>;
                var movie_id = $("input[name='id']").val();

                $.ajax({
                    method: "GET",
                    url: "/favorites",
                    data: {
                        user_id:user_id,
                        movie_id: movie_id,
                    }
                })
                    .done(function( msg ) {
                        alert("complete")

                    });
            })
            })

        
        
    </script>

<?php $view->components('end'); ?>