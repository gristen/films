<?php
/**
 * @var \App\Kernel\View\ViewInterface $view
 * @var \App\Kernel\Session\SessionInterface $session
 * @var array<\App\Models\Category> $categories
 */
?>

<?php $view->components('start');
?>
    <main>
        <div class="container">
            <h3 class="mt-3">Добавление фильма</h3>
            <hr>
        </div>
        <div class="container d-flex justify-content-center">
            <form action="/admin/movies/add" enctype="multipart/form-data" method="post" class="d-flex flex-column justify-content-center w-50 gap-2 mt-5 mb-5">
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input
                                    type="text"
                                    class="form-control <?php echo $session->has('name') ? 'is-invalid' : '' ?>"
                                    id="name"
                                    name="name"
                                    placeholder="Название фильма"
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
                            ></textarea>
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
                            <input
                                    type="file"
                                    class="form-control"
                                    id="image"
                                    name="film"
                            >
                            <label class="form-label" for="formFile">Изображение</label>
                        </div>
                    </div>
                </div>
                <select class="form-select" name="category" aria-label="Default select example">
                    <option disabled selected>Жанр</option>
                    <?php foreach ($categories as $category) { ?>
                        <option value="<?php echo $category->getId()?>"><?= $category->getName()?></option>
                    <?php } ?>
                </select>
                <div class="row g-2">
                    <button class="btn btn-primary">Добавить</button>
                </div>
            </form>
        </div>
    </main>

<?php $view->components('end'); ?>