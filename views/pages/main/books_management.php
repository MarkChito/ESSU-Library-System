<?php include_once("../../templates/header.php") ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $current_tab ?></h1>
                </div>
                <div class="col-sm-6">
                    <button type="button" class="btn btn-primary float-right" id="new_book">
                        <i class="fas fa-plus mr-1"></i>
                        New Book
                    </button>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <table id="data_table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Genre</th>
                                <th>Year Published</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $books = $model->MOD_GET_BOOKS() ?>

                            <?php if ($books) : ?>
                                <?php foreach ($books as $book) : ?>
                                    <tr>
                                        <td><?= $book->title ?></td>
                                        <td><?= $book->author ?></td>
                                        <td><?= str_replace(",", ", ", $book->genre) ?></td>
                                        <td><?= $book->year_published ?></td>
                                        <td class="text-center">
                                            <i class="fas fa-edit mr-1 text-success" role="button"></i>
                                            <i class="fas fa-trash-alt text-danger" role="button"></i>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include_once("../../templates/footer.php") ?>