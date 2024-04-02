<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

$current_url = $_SERVER["REQUEST_URI"];
$splitted_url = explode("/", $current_url);

$base_url = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_NAME"] . "/" . $splitted_url[1] . "/";

$_SESSION["base_url"] = $base_url;
$_SESSION["server"] = $base_url . "server/server.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ESSU Library System - Create an Account</title>

    <link rel="shortcut icon" href="<?= $_SESSION["base_url"] ?>dist/img/logo.png" type="image/x-icon">

    <link rel="stylesheet" href="<?= $_SESSION["base_url"] ?>plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= $_SESSION["base_url"] ?>dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= $_SESSION["base_url"] ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="<?= $_SESSION["base_url"] ?>dist/css/styles.css">
</head>

<body class="login">
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="d-block">
            <div class="alert alert-success mb-2 text-center d-none" id="register_error">
                Registration is successful. You can now <a href="<?= $_SESSION["base_url"] ?>" style="text-decoration: none;"><strong>sign in</strong></a> your account!
            </div>

            <form action="javascript:void(0)" id="register_form">
                <div class="card glass-card">
                    <div class="card-body" style="color: white;">
                        <div class="w-100 text-center">
                            <img src="<?= $_SESSION["base_url"] ?>dist/img/logo.png" style="width: 150px; height: 150px;" alt="ESSU Logo">

                            <div class="mt-3 mb-3">
                                <h1>LIBRARY SYSTEM</h1>
                                <h6>Eastern Samar State University</h6>
                            </div>

                            <hr>

                            <p>Create an Account</p>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="register_student_number" class="mb-0">Student Number</label>
                                    <input type="text" class="form-control" id="register_student_number" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="register_course" class="mb-0">Course</label>
                                    <select id="register_course" class="custom-select" required>
                                        <option value="" selected disabled></option>
                                        <option value="BSIT">BSIT</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="register_year" class="mb-0">Year</label>
                                    <select id="register_year" class="custom-select" required>
                                        <option value="" selected disabled></option>
                                        <option value="1">1st</option>
                                        <option value="2">2nd</option>
                                        <option value="3">3rd</option>
                                        <option value="4">4th</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="register_section" class="mb-0">Section</label>
                                    <input type="text" class="form-control" id="register_section" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="register_first_name" class="mb-0">First Name</label>
                                    <input type="text" class="form-control" id="register_first_name" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="register_middle_name" class="mb-0">Middle Name</label>
                                    <input type="text" class="form-control" id="register_middle_name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="register_last_name" class="mb-0">Last Name</label>
                                    <input type="text" class="form-control" id="register_last_name" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="register_birthday" class="mb-0">Birthday</label>
                                    <input type="date" class="form-control" id="register_birthday" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="register_mobile_number" class="mb-0">Mobile Number</label>
                                    <input type="number" class="form-control" id="register_mobile_number" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="register_email" class="mb-0">Email</label>
                                    <input type="email" class="form-control" id="register_email" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="register_address" class="mb-0">Address</label>
                                    <textarea class="form-control" id="register_address" rows="2" required></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="register_username" class="mb-0">Username</label>
                                    <input type="text" class="form-control" id="register_username" required>
                                    <small class="d-none" id="error_register_username">Username is already in use</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="register_password" class="mb-0">Password</label>
                                    <input type="password" class="form-control" id="register_password" required>
                                    <small class="d-none" id="error_register_password">Passwords do not match</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="register_confirm_password" class="mb-0">Confirm Password</label>
                                    <input type="password" class="form-control" id="register_confirm_password" required>
                                </div>
                            </div>
                        </div>

                        <button class="w-100 btn btn-lg btn-primary mb-3" type="submit" id="register_submit">Sign up</button>

                        <div class="text-center">
                            Already have an account?
                            <a href="<?= $_SESSION["base_url"] ?>" style="text-decoration: none;">
                                <strong class="text-white">Sign in</strong>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="<?= $_SESSION["base_url"] ?>plugins/jquery/jquery.min.js"></script>
    <script src="<?= $_SESSION["base_url"] ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= $_SESSION["base_url"] ?>dist/js/adminlte.js"></script>

    <script>
        $(document).ready(function() {
            const base_url = "<?= $_SESSION["base_url"] ?>";
            const server = "<?= $_SESSION["server"] ?>";

            disable_developer_functions(true);

            $("#register_form").submit(function() {
                const student_number = $("#register_student_number").val();
                const course = $("#register_course").val();
                const year = $("#register_year").val();
                const section = $("#register_section").val();
                const first_name = $("#register_first_name").val();
                const middle_name = $("#register_middle_name").val();
                const last_name = $("#register_last_name").val();
                const birthday = $("#register_birthday").val();
                const mobile_number = $("#register_mobile_number").val();
                const email = $("#register_email").val();
                const address = $("#register_address").val();
                const username = $("#register_username").val();
                const password = $("#register_password").val();
                const confirm_password = $("#register_confirm_password").val();

                const middle_initial = middle_name ? ' ' + middle_name.charAt(0) + '.' : '';
                const name = first_name + middle_initial + ' ' + last_name;

                if (password != confirm_password) {
                    $("#register_password").addClass("is-invalid");
                    $("#register_confirm_password").addClass("is-invalid");
                    $("#error_register_password").removeClass("d-none");
                } else {
                    $("#register_submit").html("Please Wait...");
                    $("#register_submit").attr("disabled", true);

                    var formData = new FormData();

                    formData.append('student_number', student_number);
                    formData.append('course', course);
                    formData.append('year', year);
                    formData.append('section', section);
                    formData.append('first_name', first_name);
                    formData.append('middle_name', middle_name);
                    formData.append('last_name', last_name);
                    formData.append('birthday', birthday);
                    formData.append('mobile_number', mobile_number);
                    formData.append('email', email);
                    formData.append('address', address);

                    formData.append('name', name);
                    formData.append('username', username);
                    formData.append('password', password);

                    formData.append('register', true);

                    $.ajax({
                        url: server,
                        data: formData,
                        type: 'POST',
                        dataType: 'JSON',
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response) {
                                $("#register_error").removeClass("d-none");

                                $("#register_student_number").val("");
                                $("#register_course").val("");
                                $("#register_year").val("");
                                $("#register_section").val("");
                                $("#register_first_name").val("");
                                $("#register_middle_name").val("");
                                $("#register_last_name").val("");
                                $("#register_birthday").val("");
                                $("#register_mobile_number").val("");
                                $("#register_email").val("");
                                $("#register_address").val("");
                                $("#register_username").val("");
                                $("#register_password").val("");
                                $("#register_confirm_password").val("");
                            } else {
                                $("#register_username").addClass("is-invalid");
                                $("#error_register_username").removeClass("d-none");
                            }

                            $("#register_submit").html("Sign up");
                            $("#register_submit").removeAttr("disabled");
                        },
                        error: function(_, _, error) {
                            console.error(error);
                        }
                    });
                }
            })

            $("#register_username").keydown(function() {
                $("#register_username").removeClass("is-invalid");
                $("#error_register_username").addClass("d-none");
            })

            $("#register_password").keydown(function() {
                $("#register_password").removeClass("is-invalid");
                $("#register_confirm_password").removeClass("is-invalid");
                $("#error_register_password").addClass("d-none");
            })

            $("#register_confirm_password").keydown(function() {
                $("#register_password").removeClass("is-invalid");
                $("#register_confirm_password").removeClass("is-invalid");
                $("#error_register_password").addClass("d-none");
            })

            function disable_developer_functions(enabled) {
                if (enabled) {
                    $(document).on('contextmenu', function() {
                        return false;
                    });

                    $(document).on('keydown', function(event) {
                        if (event.ctrlKey && event.shiftKey) {
                            if (event.keyCode === 74) {
                                return false;
                            }

                            if (event.keyCode === 67) {
                                return false;
                            }

                            if (event.keyCode === 73) {
                                return false;
                            }
                        }

                        if (event.ctrlKey && event.keyCode === 85) {
                            return false;
                        }
                    });
                }
            }
        })
    </script>
</body>

</html>