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
                                <th>Student Number</th>
                                <th>Name</th>
                                <th>Course, Year and Section</th>
                                <th>Birthday</th>
                                <th>Mobile Number</th>
                                <th>Email</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $students = $model->MOD_GET_STUDENTS() ?>

                            <?php if ($students) : ?>
                                <?php foreach ($students as $student) : ?>
                                    <?php
                                    $first_name = $student->first_name;
                                    $middle_name = $student->middle_name ? $student->middle_name[0] . ". " : null;
                                    $last_name = $student->last_name;

                                    $name = $first_name . " " . $middle_name . $last_name;
                                    ?>

                                    <tr>
                                        <td><?= $student->student_number ?></td>
                                        <td><?= $name ?></td>
                                        <td><?= $student->course . " " . $student->year . "-" . $student->section ?></td>
                                        <td><?= date("F j, Y", strtotime($student->birthday)) ?></td>
                                        <td><?= $student->mobile_number ?></td>
                                        <td><?= $student->email ?></td>

                                        <td class="text-center">
                                            <i class="fas fa-edit mr-1 text-success edit_student" useraccount_id="<?= $student->useraccount_id ?>" role="button"></i>
                                            <i class="fas fa-trash-alt text-danger delete_student" useraccount_id="<?= $student->useraccount_id ?>" role="button"></i>
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