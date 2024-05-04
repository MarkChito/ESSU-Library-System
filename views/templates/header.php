<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header("HTTP/1.0 403 Forbidden");
    echo "Access Forbidden";
    exit();
}

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION["user_id"])) {
    $_SESSION["login_error"] = array("type" => "alert-danger", "message" => "You must login first!");

    header("location: login");

    exit();
}

$current_url = $_SERVER["REQUEST_URI"];
$splitted_url = explode("/", $current_url);

$base_url = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_NAME"] . "/" . $splitted_url[1] . "/";

$_SESSION["base_url"] = $base_url;
$_SESSION["server"] = $base_url . "server/server.php";

$current_tab = $_SESSION["current_tab"];

include("../../../model/model.php");

$user_data = $model->MOD_GET_USER_ACCOUNT_DETAILS($_SESSION["user_id"]);

$name = $user_data[0]->name;
$username = $user_data[0]->username;
$password = $user_data[0]->password;
$user_type = $user_data[0]->user_type;

if ($user_type == "student") {
    $student_data = $model->MOD_GET_STUDENT_DATA($_SESSION["user_id"]);

    $student_number = $student_data[0]->student_number;
    $course = $student_data[0]->course;
    $year = $student_data[0]->year;
    $section = $student_data[0]->section;
    $first_name = $student_data[0]->first_name;
    $middle_name = $student_data[0]->middle_name;
    $last_name = $student_data[0]->last_name;
    $birthday = $student_data[0]->birthday;
    $mobile_number = $student_data[0]->mobile_number;
    $email = $student_data[0]->email;
    $address = $student_data[0]->address;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ESSU Library System - <?= $current_tab ?></title>

    <link rel="shortcut icon" href="<?= $_SESSION["base_url"] ?>dist/img/logo.png" type="image/x-icon">

    <link rel="stylesheet" href="<?= $_SESSION["base_url"] ?>plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= $_SESSION["base_url"] ?>dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= $_SESSION["base_url"] ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="<?= $_SESSION["base_url"] ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= $_SESSION["base_url"] ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= $_SESSION["base_url"] ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= $_SESSION["base_url"] ?>plugins/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="<?= $_SESSION["base_url"] ?>plugins/bootstrap-select/css/bootstrap-select.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= $_SESSION["base_url"] ?>dist/img/logo.png" alt="ESSU Logo" height="60" width="60">
            <p class="mt-3">Eastern Samar State University</p>
        </div>

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?= $current_tab != "Available Books" ? "d-none" : null ?>">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline" id="search_form" action="javascript:void(0)">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search Title, Author, or Genre" aria-label="Search" id="search_input">

                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="submit" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link account_settings" href="javascript:void(0)" role="button" account_id="<?= $_SESSION["user_id"] ?>" account_name="<?= $name ?>" username="<?= $username ?>">
                        <i class="fas fa-cog"></i>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-danger sidebar-links" location_link="logout" href="javascript:void(0)" role="button">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="available_books" class="brand-link">
                <img src="<?= $_SESSION["base_url"] ?>dist/img/logo.png" alt="ESSU Logo" class="brand-image img-circle elevation-3">
                <span class="brand-text font-weight-light">ESSU Library System</span>
            </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= $_SESSION["base_url"] ?>dist/img/default_user_image.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <span class="d-block text-truncate text-white"><?= $name ?></span>
                    </div>
                </div>

                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search Tabs" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="javascript:void(0)" location_link="available_books" class="nav-link sidebar-links <?= $current_tab == "Available Books" ? "active" : null ?>">
                                <i class="nav-icon fas fa-list"></i>
                                <p>Available Books</p>
                            </a>
                        </li>

                        <li class="nav-header">LIBRARY CATALOG</li>
                        <?php if ($user_type == "admin") : ?>
                            <li class="nav-item disabled">
                                <a href="javascript:void(0)" location_link="books_management" class="nav-link sidebar-links <?= $current_tab == "Books Management" ? "active" : null ?>">
                                    <i class="nav-icon fas fa-book-open"></i>
                                    <p>Books Management</p>
                                </a>
                            </li>
                            <li class="nav-item disabled">
                                <a href="javascript:void(0)" location_link="books_inventory" class="nav-link sidebar-links <?= $current_tab == "Books Inventory" ? "active" : null ?>">
                                    <i class="nav-icon fas fa-box"></i>
                                    <p>Books Inventory</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0)" location_link="students_management" class="nav-link sidebar-links <?= $current_tab == "Students Management" ? "active" : null ?>">
                                    <i class="nav-icon fas fa-graduation-cap"></i>
                                    <p>Students Management</p>
                                </a>
                            </li>
                        <?php endif ?>

                        <li class="nav-item">
                            <a href="javascript:void(0)" location_link="borrowed_books" class="nav-link sidebar-links <?= $current_tab == "Borrowed Books" ? "active" : null ?>">
                                <i class="nav-icon fas fa-book"></i>
                                <p>Borrowed Books</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="javascript:void(0)" location_link="activity_logs" class="nav-link sidebar-links <?= $current_tab == "Activity Logs" ? "active" : null ?>">
                                <i class="nav-icon fas fa-history"></i>
                                <p>Activity Logs</p>
                            </a>
                        </li>

                        <li class="nav-header">ACCOUNT SETTINGS</li>
                        <?php if ($user_type == "student") : ?>
                            <li class="nav-item">
                                <a href="javascript:void(0)" location_link="profile" class="nav-link sidebar-links <?= $current_tab == "My Profile" ? "active" : null ?>">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>Profile</p>
                                </a>
                            </li>
                        <?php endif ?>
                        <li class="nav-item">
                            <a href="javascript:void(0)" location_link="logout" class="nav-link sidebar-links">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>