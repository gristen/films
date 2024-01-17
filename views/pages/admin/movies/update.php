<?php
/**
 * @var \App\Kernel\View\ViewInterface $view
 * @var \App\Kernel\Session\SessionInterface $session
 * @var array<\App\Models\Category> $categories
 * @var \App\Models\Movie $movie
 */
?>

<?php $view->components('start');
?>
    <main>
        <div class="container">
            <h3 class="mt-3">Изменение фильма</h3>
            <hr>
        </div>
        <div class="container d-flex justify-content-center">
            <form action="/admin/movies/update" enctype="multipart/form-data" method="post" class="d-flex flex-column justify-content-center w-50 gap-2 mt-5 mb-5">
                <input type="hidden" name="id" value="<?php echo $movie->getId() ?>">
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input
                                type="text"
                                class="form-control <?php echo $session->has('name') ? 'is-invalid' : '' ?>"
                                id="name"
                                name="name"
                                placeholder="Название фильма"
                                value="<?php echo $movie->getName() ?>"
                            >
                            <label for="name">Название фильма</label>
                            <?php if ($session->has('name')) { ?>
                                <div id="name" class="invalid-feedback">
                                    <?php echo $session->getFlash('name')[0] ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <textarea
                                type="text"
                                class="form-control <?php echo $session->has('description') ? 'is-invalid' : '' ?>"
                                name="description"
                                id="description"
                                placeholder="фильм про"
                           
                            ><?php echo $movie->getDescription() ?> </textarea>
                            <label for="email">Описание</label>
                            <?php if ($session->has('description')) { ?>
                                <div id="description" class="invalid-feedback">
                                    <?php echo $session->getFlash('description')[0] ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input
                                type="file"
                                class="form-control"
                                id="image"
                                name="image"

                            >
                            <label class="form-label" for="formFile">Изображение</label>
                        </div>
                    </div>
                </div>

                <select class="form-select" name="category">
                    <option>Жанр</option>
                    <?php foreach ($categories as $category) { ?>
                        <option value="<?php echo $category->getId()?>" <?php echo $category->getId() === $movie->getCategoryId() ? 'selected' : '' ?>>
                            <?php echo $category->getName()?>
                        </option>
                    <?php } ?>
                </select>

                <div class="row g-2">
                    <button class="btn btn-success">Сохранить</button>
                </div>
            </form>
        </div>
    </main>

<?php $view->components('end'); ?>