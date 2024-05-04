<?php include_once("../../templates/header.php") ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $current_tab ?></h1>
                </div>
                <?php if (isset($_GET["search"])) : ?>
                    <div class="col-sm-6">
                        <button class="btn btn-primary float-right" onclick="location.href='available_books'">
                            <i class="fas fa-home mr-1"></i>
                            Back to Homepage
                        </button>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <?php if (isset($_GET["search"])) : ?>
                <div class="row">
                    <?php $books = $model->MOD_GET_BOOKS() ?>

                    <?php if ($books) : ?>
                        <?php foreach ($books as $book) : ?>
                            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                                <div class="card bg-dark">
                                    <div class="d-flex justify-content-center">
                                        <img src="<?= $_SESSION["base_url"] ?>dist/img/books/<?= $book->image ?>" style="width: 100%; height: auto;" class="card-img-top p-2 book_cover clickable_image" alt="Book Cover" role="button">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title mb-2 font-weight-bold text-truncate w-100" title="<?= $book->title ?>"><?= $book->title ?></h5>
                                        <p class="card-text mb-0 text-truncate w-100" title="Author:  <?= $book->author ?>"><span class="font-weight-bold">Author:</span> <?= $book->author ?></p>
                                        <p class="card-text mb-0 text-truncate w-100" title="Genre: <?= str_replace(",", ", ", $book->genre) ?>"><span class="font-weight-bold">Genre:</span> <?= str_replace(",", ", ", $book->genre) ?></p>
                                        <p class="card-text mb-0 text-truncate w-100" title="Year Published: <?= $book->year_published ?>"><span class="font-weight-bold">Year Published:</span> <?= $book->year_published ?></p>

                                        <div class="row">
                                            <div class="<?= $user_type != "student" ? "col-12" : "col-md-6" ?>">
                                                <button type="button" class="btn btn-success mt-3 w-100 book_details" book_id="<?= $book->id ?>">Details</button>
                                            </div>
                                            <div class="col-md-6">
                                                <button type="button" class="btn btn-primary mt-3 w-100 borrow_this_book <?= $user_type != "student" ? "d-none" : null ?>" book_id="<?= $book->id ?>">Borrow</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    <?php else : ?>
                        <div class="col-12 d-flex justify-content-center align-items-center no_books">
                            <div class="text-center">
                                <?php if (isset($_GET["search"])) : ?>
                                    <h1>No available search reults for "<?= $_GET["search"] ?>"</h1>
                                <?php else : ?>
                                    <h1>No Books Available</h1>
                                <?php endif ?>
                                <?php if ($user_type == "admin" && !isset($_GET["search"])) : ?>
                                    <button class="btn btn-primary mt-2 px-3" onclick="location.href='books_management'">Add Books Now</button>
                                <?php endif ?>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
            <?php else : ?>
                <div>
                    <h3 class="mb-2">Latest Books</h3>
                    <div class="row">
                        <?php $latest_books = $model->MOD_GET_LATEST_BOOKS() ?>

                        <?php if ($latest_books) : ?>
                            <?php foreach ($latest_books as $latest_book) : ?>
                                <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                                    <div class="card bg-dark">
                                        <div class="d-flex justify-content-center">
                                            <img src="<?= $_SESSION["base_url"] ?>dist/img/books/<?= $latest_book->image ?>" style="width: 100%; height: auto;" class="card-img-top p-2 book_cover clickable_image" alt="Book Cover" role="button">
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title mb-2 font-weight-bold text-truncate w-100" title="<?= $latest_book->title ?>"><?= $latest_book->title ?></h5>
                                            <p class="card-text mb-0 text-truncate w-100" title="Author:  <?= $latest_book->author ?>"><span class="font-weight-bold">Author:</span> <?= $latest_book->author ?></p>
                                            <p class="card-text mb-0 text-truncate w-100" title="Genre: <?= str_replace(",", ", ", $latest_book->genre) ?>"><span class="font-weight-bold">Genre:</span> <?= str_replace(",", ", ", $latest_book->genre) ?></p>
                                            <p class="card-text mb-0 text-truncate w-100" title="Year Published: <?= $latest_book->year_published ?>"><span class="font-weight-bold">Year Published:</span> <?= $latest_book->year_published ?></p>

                                            <div class="row">
                                                <div class="<?= $user_type != "student" ? "col-12" : "col-md-6" ?>">
                                                    <button type="button" class="btn btn-success mt-3 w-100 book_details" book_id="<?= $latest_book->id ?>">Details</button>
                                                </div>
                                                <div class="col-md-6">
                                                    <button type="button" class="btn btn-primary mt-3 w-100 borrow_this_book <?= $user_type != "student" ? "d-none" : null ?>" book_id="<?= $latest_book->id ?>">Borrow</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php else : ?>
                            <div class="col-12 d-flex justify-content-center align-items-center no_books">
                                <div class="text-center">
                                    <h1>No Books Available</h1>

                                    <?php if ($user_type == "admin") : ?>
                                        <button class="btn btn-primary mt-2 px-3" onclick="location.href='books_management'">Add Books Now</button>
                                    <?php endif ?>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                </div>

                <?php
                $all_genre = $model->MOD_GET_REGISTERED_GENRE()[0]->registered_genre;
                $all_genre_array = explode(",", $all_genre);
                $genre = array_unique($all_genre_array);
                ?>

                <?php foreach ($genre as $genre_row) : ?>
                    <?php $books_by_genre = $model->MOD_GET_BOOKS_BY_GENRE($genre_row) ?>

                    <?php if ($books_by_genre) : ?>
                        <div>
                            <h3 class="mb-2"><?= $genre_row ?></h3>
                            <div class="row">
                                <?php foreach ($books_by_genre as $books_by_genre_row) : ?>
                                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                                        <div class="card bg-dark">
                                            <div class="d-flex justify-content-center">
                                                <img src="<?= $_SESSION["base_url"] ?>dist/img/books/<?= $books_by_genre_row->image ?>" style="width: 100%; height: auto;" class="card-img-top p-2 book_cover clickable_image" alt="Book Cover" role="button">
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title mb-2 font-weight-bold text-truncate w-100" title="<?= $books_by_genre_row->title ?>"><?= $books_by_genre_row->title ?></h5>
                                                <p class="card-text mb-0 text-truncate w-100" title="Author:  <?= $books_by_genre_row->author ?>"><span class="font-weight-bold">Author:</span> <?= $books_by_genre_row->author ?></p>
                                                <p class="card-text mb-0 text-truncate w-100" title="Genre: <?= str_replace(",", ", ", $books_by_genre_row->genre) ?>"><span class="font-weight-bold">Genre:</span> <?= str_replace(",", ", ", $books_by_genre_row->genre) ?></p>
                                                <p class="card-text mb-0 text-truncate w-100" title="Year Published: <?= $books_by_genre_row->year_published ?>"><span class="font-weight-bold">Year Published:</span> <?= $books_by_genre_row->year_published ?></p>

                                                <div class="row">
                                                    <div class="<?= $user_type != "student" ? "col-12" : "col-md-6" ?>">
                                                        <button type="button" class="btn btn-success mt-3 w-100 book_details" book_id="<?= $books_by_genre_row->id ?>">Details</button>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button type="button" class="btn btn-primary mt-3 w-100 borrow_this_book <?= $user_type != "student" ? "d-none" : null ?>" book_id="<?= $books_by_genre_row->id ?>">Borrow</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    <?php endif ?>
                <?php endforeach ?>
            <?php endif ?>
        </div>
    </section>
</div>

<?php include_once("../../templates/footer.php") ?>