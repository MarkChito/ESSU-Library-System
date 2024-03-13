<?php include_once("../../templates/header.php") ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $current_tab ?></h1>
                </div>
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
                                    <p class="card-text mb-0" title="Author:  <?= $book->author ?>"><span class="font-weight-bold text-truncate w-100">Author:</span> <?= $book->author ?></p>
                                    <p class="card-text mb-0" title="Genre: <?= $book->genre ?>"><span class="font-weight-bold text-truncate w-100">Genre:</span> <?= $book->genre ?></p>
                                    <p class="card-text mb-0" title="Year Published: <?= $book->year_published ?>"><span class="font-weight-bold text-truncate w-100">Year Published:</span> <?= $book->year_published ?></p>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-success mt-3 w-100 book_details">Book Details</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-primary mt-3 w-100 borrow_this_book" <?= $user_type != "student" ? "disabled" : null ?>>Borrow Book</button>
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
    </section>
</div>

<?php include_once("../../templates/footer.php") ?>