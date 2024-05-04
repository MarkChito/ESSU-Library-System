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

    <title>ESSU Library System - Login</title>

    <link rel="shortcut icon" href="<?= $_SESSION["base_url"] ?>dist/img/logo.png" type="image/x-icon">

    <link rel="stylesheet" href="<?= $_SESSION["base_url"] ?>plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= $_SESSION["base_url"] ?>dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= $_SESSION["base_url"] ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="<?= $_SESSION["base_url"] ?>dist/css/styles.css">
</head>

<body class="login">
    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="d-block">
            <div style="max-width: 450px;" class="alert mb-2 text-center <?= isset($_SESSION["login_error"]) ? $_SESSION["login_error"]["type"] : null ?> <?= isset($_SESSION["login_error"]) ? null : "d-none" ?>" id="login_error">
                <?= isset($_SESSION["login_error"]) ? $_SESSION["login_error"]["message"] : null ?>
            </div>

            <form action="javascript:void(0)" id="login_form">
                <div class="card glass-card" style="width: 450px; height: auto;">
                    <div class="card-body" style="color: white;">
                        <div class="w-100 text-center">
                            <img src="<?= $_SESSION["base_url"] ?>dist/img/logo.png" style="width: 150px; height: 150px;" alt="ESSU Logo">

                            <div class="mt-3 mb-3">
                                <h1>LIBRARY SYSTEM</h1>
                                <h6>Eastern Samar State University</h6>
                            </div>

                            <hr>

                            <p>Please sign in to proceed</p>
                        </div>

                        <div class="form-group mb-3">
                            <label for="login_username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="login_username" value="<?= isset($_SESSION["remember_username"]) ? $_SESSION["remember_username"] : null ?>" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="login_password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="login_password" value="<?= isset($_SESSION["remember_password"]) ? $_SESSION["remember_password"] : null ?>" required>
                        </div>

                        <div class="checkbox mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <label>
                                        <input type="checkbox" id="login_remember_me">
                                        Remember me
                                    </label>
                                </div>
                                <div class="col-6">
                                    <span class="float-end">
                                        Need an account?
                                        <a href="create_an_account" style="text-decoration: none;">
                                            <strong class="text-white">Sign up</strong>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <button class="w-100 btn btn-lg btn-primary" type="submit" id="login_submit">Sign in</button>
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

            $("#login_form").submit(function() {
                const username = $("#login_username").val();
                const password = $("#login_password").val();
                const remember_me = $("#login_remember_me");

                var is_remember_me = false;

                if (remember_me.is(":checked")) {
                    is_remember_me = true;
                }

                $("#login_submit").html("Please Wait...");
                $("#login_submit").attr("disabled", true);

                $("#login_username").attr("disabled", true);
                $("#login_password").attr("disabled", true);
                $("#login_remember_me").attr("disabled", true);

                var formData = new FormData();

                formData.append('username', username);
                formData.append('password', password);
                formData.append('remember_me', is_remember_me);
                formData.append('login', true);

                $.ajax({
                    url: server,
                    data: formData,
                    type: 'POST',
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response) {
                            location.href = base_url + "available_books";
                        } else {
                            $("#login_submit").html("Sign in");
                            $("#login_submit").removeAttr("disabled");

                            $("#login_username").removeAttr("disabled");
                            $("#login_password").removeAttr("disabled");
                            $("#login_remember_me").removeAttr("disabled");

                            $("#login_error").removeClass("d-none");
                            $("#login_error").addClass("alert-danger");
                            $("#login_error").html("Invalid Username or Password!");

                            back_to_top();
                        }
                    },
                    error: function(_, _, error) {
                        console.error(error);
                    }
                });
            })

            function back_to_top() {
                document.body.scrollTop = 0; // For Safari
                document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
            }

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

    <?php unset($_SESSION["login_error"]) ?>
</body>

</html>