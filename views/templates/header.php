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
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search Title, Author, or Genre" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <!-- <span class="badge badge-danger navbar-badge">1</span> -->
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- <a href="#" class="dropdown-item">
                            <div class="media">
                                <img src="<?= $_SESSION["base_url"] ?>dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">Brad Diesel</h3>
                                    <p class="text-sm text-truncate">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                        </a>
                        
                        <div class="dropdown-divider"></div>

                        <a href="messages" class="dropdown-item dropdown-footer">See All Messages</a> -->

                        <div class="px-5 py-3 text-center">
                            <strong class="text-muted">No Available Messages</strong>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link sidebar-links" location_link="logout" href="javascript:void(0)" role="button">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="dashboard" class="brand-link">
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

                        <?php if ($user_type == "admin") : ?>
                            <li class="nav-header">LIBRARY CATALOG</li>
                            <li class="nav-item disabled">
                                <a href="javascript:void(0)" location_link="books_management" class="nav-link sidebar-links <?= $current_tab == "Books Management" ? "active" : null ?>">
                                    <i class="nav-icon fas fa-book-open"></i>
                                    <p>Books Management</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link sidebar-links">
                                    <i class="nav-icon fas fa-graduation-cap"></i>
                                    <p>Students Management</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link sidebar-links">
                                    <i class="nav-icon fas fa-exchange-alt"></i>
                                    <p>Borowing & Returning</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link sidebar-links">
                                    <i class="nav-icon fas fa-dollar-sign"></i>
                                    <p>Fines Management</p>
                                </a>
                            </li>
                        <?php endif ?>

                        <?php if ($user_type == "student") : ?>
                            <li class="nav-header">LIBRARY CATALOG</li>
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link sidebar-links">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>Borrowed Books</p>
                                </a>
                            </li>
                        <?php endif ?>

                        <li class="nav-item">
                            <a href="javascript:void(0)" location_link="activity_logs" class="nav-link sidebar-links <?= $current_tab == "Activity Logs" ? "active" : null ?>">
                                <i class="nav-icon fas fa-history"></i>
                                <p>Activity Logs</p>
                            </a>
                        </li>

                        <li class="nav-header">ACCOUNT SETTINGS</li>
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link sidebar-links">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link sidebar-links">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>Account</p>
                            </a>
                        </li>
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