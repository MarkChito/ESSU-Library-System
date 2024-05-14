<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

date_default_timezone_set('Asia/Manila');

include_once("../model/model.php");

if (isset($_POST["check_connection"])) {
    $response = array(
        "status" => 200,
        "message" => "Connected!",
    );

    echo json_encode($response);
}
