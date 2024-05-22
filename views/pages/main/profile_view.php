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
                <div class="col-md-4">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img role="button" class="profile-user-img clickable_image" style="width: 100px; height: 100px; border-radius: 50%;" src="<?= $base_url ?>dist/img/users/<?= $image ?>" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"><?= $name ?></h3>

                            <p class="text-muted text-center"><?= $course . " " . $year . "-" . $section ?></p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Student Number</b> <a class="float-right"><?= $student_number ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right"><?= $email ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Mobile Number</b> <a class="float-right"><?= $mobile_number ?></a>
                                </li>
                            </ul>

                            <a href="javascript:void(0)" class="btn btn-primary btn-block account_settings" account_id="<?= $_SESSION["user_id"] ?>" account_name="<?= $name ?>" username="<?= $username ?>" image="<?= $image ?>"><b>Account Settings</b></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="settings">
                                    <form class="form-horizontal" action="javascript:void(0)" id="update_profile_form">
                                        <div class="form-group row">
                                            <label for="update_profile_student_number" class="col-sm-3 col-form-label">Student Number</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="update_profile_student_number" value="<?= $student_number ?>" required>
                                                <small class="text-danger d-none" id="error_update_profile_student_number">Student Number is already in use</small>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="update_profile_course" class="col-sm-3 col-form-label">Course</label>
                                            <div class="col-sm-9">
                                                <select id="update_profile_course" class="custom-select" required>
                                                    <option value disabled selected></option>
                                                    <option value="BSIT" <?= $course == "BSIT" ? "selected" : null ?>>BS Information Technology</option>
                                                    <option value="BSC" <?= $course == "BSC" ? "selected" : null ?>>BS Criminology</option>
                                                    <option value="BSA" <?= $course == "BSA" ? "selected" : null ?>>BS Agriculture</option>
                                                    <option value="BSBA" <?= $course == "BSBA" ? "selected" : null ?>>BS Business Adminsitration</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="update_profile_year" class="col-sm-3 col-form-label">Year</label>
                                            <div class="col-sm-9">
                                                <select id="update_profile_year" class="custom-select" required>
                                                    <option value disabled selected></option>
                                                    <option value="1" <?= $year == "1" ? "selected" : null ?>>1st Year</option>
                                                    <option value="2" <?= $year == "2" ? "selected" : null ?>>2nd Year</option>
                                                    <option value="3" <?= $year == "3" ? "selected" : null ?>>3rd Year</option>
                                                    <option value="4" <?= $year == "4" ? "selected" : null ?>>4th Year</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="update_profile_section" class="col-sm-3 col-form-label">Section</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="update_profile_section" maxlength="1" value="<?= $section ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="update_profile_first_name" class="col-sm-3 col-form-label">First Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="update_profile_first_name" value="<?= $first_name ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="update_profile_middle_name" class="col-sm-3 col-form-label">Middle Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="update_profile_middle_name" value="<?= $middle_name ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="update_profile_last_name" class="col-sm-3 col-form-label">Last Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="update_profile_last_name" value="<?= $last_name ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="update_profile_birthday" class="col-sm-3 col-form-label">Birthday</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" id="update_profile_birthday" value="<?= $birthday ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="update_profile_mobile_number" class="col-sm-3 col-form-label">Mobile Number</label>
                                            <div class="col-sm-9">
                                                <input type="number" class="form-control" id="update_profile_mobile_number" value="<?= $mobile_number ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="update_profile_email" class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" id="update_profile_email" value="<?= $email ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="update_profile_address" class="col-sm-3 col-form-label">Address</label>
                                            <div class="col-sm-9">
                                                <textarea id="update_profile_address" rows="2" class="form-control" required><?= $address ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <input type="hidden" id="update_profile_id" value="<?= $_SESSION["user_id"] ?>">
                                            <input type="hidden" id="update_profile_old_student_number" value="<?= $student_number ?>">

                                            <div class="offset-sm-3 col-sm-9">
                                                <button type="submit" class="btn btn-primary w-100" id="update_profile_submit">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include_once("../../templates/footer.php") ?>