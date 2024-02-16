<?php
/**
 * @var \App\Kernel\View\ViewInterface $view
 * @var \App\Kernel\Session\Session $session
 * @var array<\App\Models\Category> $catigories
 */
?>
<?php $view->components('start'); ?>

<main>
    <div class="container">
        <h3 class="mt-3">Добавление жанра</h3>
        <hr>
    </div>
    <div class="container d-flex justify-content-center">
        <form action="/admin/categories/add" method="post" enctype="multipart/form-data" class="d-flex flex-column justify-content-center w-50 gap-2 mt-5 mb-5">
            <div class="row g-2">
                <div class="col-md">
                    <div class="form-floating">
                        <input
                            type="text"
                            class="form-control <?php echo $session->has('name') ? 'is-invalid' : '' ?>"
                            id="name"
                            name="name"
                            placeholder="Иван Иванов"
                        >

                        <input
                                type="file"
                                class="form-control"
                                id="image"
                                name="image"

                        >

                        <div id="passwordHelpBlock" class="form-text">
                           Картина для превью категории
                        </div>

                        <label for="name">Название категории</label>
                        <?php if ($session->has('name')) { ?>
                            <div id="name" class="invalid-feedback">
                                <?php echo $session->getFlash('name')[0] ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="row g-2">
                <button class="btn btn-primary">Добавить категорию</button>
            </div>
        </form>
    </div>
</main>
<?php $view->components('end'); ?>