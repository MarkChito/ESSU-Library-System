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
            <div class="card">
                <div class="card-body">
                    <table id="data_table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Book Title</th>
                                <th>Inventory</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $inventory_data = $model->MOD_GET_ALL_INVENTORY_DATA() ?>

                            <?php if ($inventory_data) : ?>
                                <?php foreach ($inventory_data as $inventory_data_row) : ?>
                                    <?php $book_data = $model->MOD_GET_BOOK_DETAILS($inventory_data_row->book_id) ?>
                                    <tr>
                                        <td><?= $book_data[0]->title ?></td>
                                        <td><?= $inventory_data_row->inventory ?> <?= $inventory_data_row->inventory > 1 ? "Copies" : "Copy" ?></td>
                                        <td class="text-center">
                                            <i class="fas fa-edit text-primary edit_inventory" inventory_id="<?= $inventory_data_row->id ?>" book_id="<?= $inventory_data_row->book_id ?>" role="button"></i>
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