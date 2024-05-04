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
        </div>
    </section>
</div>

<?php include_once("../../templates/footer.php") ?>