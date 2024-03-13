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
                                <th>Name</th>
                                <th>Activity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($user_type == "admin") {
                                $activity_logs = $model->MOD_GET_ALL_ACTIVITY_LOGS();
                            } else {
                                $activity_logs = $model->MOD_GET_SINGLE_ACTIVITY_LOGS($_SESSION["user_id"]);
                            }
                            ?>
                            <?php if ($activity_logs) : ?>
                                <?php foreach ($activity_logs as $activity_log) : ?>
                                    <?php $user_data = $model->MOD_GET_USER_ACCOUNT_DETAILS($activity_log->user_id) ?>
                                    <tr>
                                        <td><?= date("F j, Y g:i A", strtotime($activity_log->log_date)) ?></td>
                                        <td><?= $user_data[0]->name ?></td>
                                        <td><?= str_replace($name, "You", $activity_log->activity) ?></td>
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