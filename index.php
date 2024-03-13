<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

$splitted_filename = explode("/", $_SERVER["SCRIPT_FILENAME"]);
$base_location = $splitted_filename[0] . "/" . $splitted_filename[1] . "/" . $splitted_filename[2] . "/" . $splitted_filename[3] . "/";

$_SESSION["base_location"] = $base_location;
$_SESSION["server"] = $base_location . "server/server.php";

if (!isset($_SESSION["user_id"])) {
    header("location: login");
} else {
    $_SESSION["current_tab"] = "Available Books";

    header("location: available_books");
}
