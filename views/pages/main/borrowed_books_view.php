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
                                <th>Date</th>
                                <?php if ($user_type == "admin") : ?>
                                    <th>Student Name</th>
                                <?php endif ?>
                                <th>Book Title</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <?php if ($user_type == "admin") : ?>
                                    <th class="text-center">Actions</th>
                                <?php endif ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($user_type == "admin") {
                                $offtake_data = $model->MOD_GET_ALL_OFFTAKE();
                            } else {
                                $offtake_data = $model->MOD_GET_STUDENT_OFFTAKE($_SESSION["user_id"]);
                            }
                            ?>
                            <?php if ($offtake_data) : ?>
                                <?php foreach ($offtake_data as $offtake_data_row) : ?>
                                    <?php $book_data = $model->MOD_GET_BOOK_DETAILS($offtake_data_row->book_id) ?>
                                    <?php $student_data = $model->MOD_GET_USER_ACCOUNT_DETAILS($offtake_data_row->user_id) ?>

                                    <?php
                                    if ($offtake_data_row->status == "Pending") {
                                        $color = "text-success";
                                    }
                                    if ($offtake_data_row->status == "Approved") {
                                        $color = "text-primary";
                                    }
                                    if ($offtake_data_row->status == "Rejected") {
                                        $color = "text-danger";
                                    }
                                    if ($offtake_data_row->status == "Returned") {
                                        $color = "text-warning";
                                    }
                                    ?>
                                    <tr>
                                        <td><?= date("F j, Y g:i A", strtotime($offtake_data_row->date_created)) ?></td>
                                        <?php if ($user_type == "admin") : ?>
                                            <td><?= $student_data[0]->name ?></td>
                                        <?php endif ?>
                                        <td><?= $book_data[0]->title ?></td>
                                        <td><?= $offtake_data_row->quantity ?> <?= $offtake_data_row->quantity > 1 ? "Copies" : "Copy" ?></td>
                                        <td class="<?= $color ?>"><?= $offtake_data_row->status ?></td>
                                        <?php if ($user_type == "admin") : ?>
                                            <td class="text-center">
                                                <?php if ($offtake_data_row->status == "Pending") : ?>
                                                    <i class="fas fa-thumbs-up mr-2 text-primary approve_request" title="Approve Request" role="button" offtake_id="<?= $offtake_data_row->id ?>"></i>
                                                    <i class="fas fa-thumbs-down text-danger reject_request" title="Reject Request" role="button" offtake_id="<?= $offtake_data_row->id ?>"></i>
                                                <?php elseif ($offtake_data_row->status == "Approved") : ?>
                                                    <a href="javascript:void(0)" class="btn btn-primary btn-sm set_as_returned" offtake_id="<?= $offtake_data_row->id ?>">Set as Returned</a>
                                                <?php else : ?>
                                                    <i class="fas fa-info text-warning offtake_request" role="button" offtake_status="<?= $offtake_data_row->status ?>"></i>
                                                <?php endif ?>
                                            </td>
                                        <?php endif ?>
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