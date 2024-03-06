<?php $view->components('start'); ?>


<div class="container">
    <div class="row">
        <h1 class="mt-5 mb-5">Панель модератора</h1>
        <?php foreach ($reviews as $review): ?>
            <div class="col-lg-6 mb-3">
                <div class="accordion bg-dark accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed text-white" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $review['id'] ?>" aria-expanded="false" aria-controls="flush-collapse<?= $review['id'] ?>">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <img class="img-fluid rounded" src="<?= $storage->url($review['movie_name']) ?>" >
                                    </div>
                                    <div class="col-md-8">
                                        <h4>Название: <?= $review['name'] ?></h4>
                                        <p>ID пользователя, который оставил отзыв: <?= $review['user_id'] ?></p>

                                    </div>
                                </div>
                            </button>
                        </h2>
                        <div id="flush-collapse<?= $review['id'] ?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body bg-dark text-white">
                                <p><strong>Автор:</strong> <?= $review['username'] ?></p>
                                <p><strong>Отзыв:</strong> <?= $review['review'] ?></p>
                                <p><strong>Оценка:</strong> <?= $review['rating'] ?></p>
                                <button class=" btn btn-danger">Удалить отзыв</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php $view->components('end'); ?>
