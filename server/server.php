<?php
if ((basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) && ($_SERVER["REQUEST_METHOD"] !== "POST")) {
    header("HTTP/1.0 403 Forbidden");
    echo "Access Forbidden";
    exit();
}

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

date_default_timezone_set('Asia/Manila');

include_once("../model/model.php");

function upload_image($image, $upload_directory)
{
    $uploadDirectory = $upload_directory;

    $uploadedFile = $image;
    $fileName = $uploadedFile['name'];
    $targetPath = $uploadDirectory . $fileName;

    $counter = 1;

    while (file_exists($targetPath)) {
        $fileName = pathinfo($uploadedFile['name'], PATHINFO_FILENAME) . '_' . $counter . '.' . pathinfo($uploadedFile['name'], PATHINFO_EXTENSION);
        $targetPath = $uploadDirectory . $fileName;
        $counter++;
    }

    if (move_uploaded_file($uploadedFile['tmp_name'], $targetPath)) {
        return $fileName;
    } else {
        return false;
    }
}

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $remember_me = $_POST["remember_me"];

    $username_exists = $model->MOD_CHECK_USERNAME($username);

    $response = false;

    if ($username_exists) {
        if (password_verify($password, $username_exists[0]->password)) {
            if ($remember_me == "true") {
                $_SESSION["remember_username"] = $username;
                $_SESSION["remember_password"] = $password;
            } else {
                unset($_SESSION["remember_username"]);
                unset($_SESSION["remember_password"]);
            }

            $_SESSION["user_id"] = $username_exists[0]->id;
            $_SESSION["current_tab"] = "Available Books";

            $log_date = date('Y-m-d H:i:s');
            $user_id = $username_exists[0]->id;
            $activity = $username_exists[0]->name . " logged in to the system.";

            $model->MOD_ADD_ACTIVITY_LOG($log_date, $user_id, $activity);

            $response = true;
        }
    }

    echo json_encode($response);
}

if (isset($_POST["register"])) {
    $student_number = $_POST["student_number"];
    $course = $_POST["course"];
    $year = $_POST["year"];
    $section = $_POST["section"];
    $first_name = $_POST["first_name"];
    $middle_name = $_POST["middle_name"];
    $last_name = $_POST["last_name"];
    $birthday = $_POST["birthday"];
    $mobile_number = $_POST["mobile_number"];
    $email = $_POST["email"];
    $address = $_POST["address"];

    $name = $_POST["name"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    $username_exists = $model->MOD_CHECK_USERNAME($username);

    $response = false;

    if (!$username_exists) {
        $model->MOD_CREATE_AN_ACCOUNT($name, $username, $password);

        $username_exists = $model->MOD_CHECK_USERNAME($username);

        $model->MOD_ADD_PROFILE($username_exists[0]->id, $student_number, $course, $year, $section, $first_name, $middle_name, $last_name, $birthday, $mobile_number, $email, $address);

        $log_date = date('Y-m-d H:i:s');
        $activity = $name . " created an account.";
        $user_id = $username_exists[0]->id;

        $model->MOD_ADD_ACTIVITY_LOG($log_date, $user_id, $activity);

        $response = true;
    }

    echo json_encode($response);
}

if (isset($_POST["location_link"])) {
    $location_link = $_POST["location_link"];

    if ($location_link != "logout") {
        $response = $location_link;

        if ($location_link == "available_books") {
            $current_tab = "Available Books";
        }

        if ($location_link == "books_management") {
            $current_tab = "Books Management";
        }

        if ($location_link == "activity_logs") {
            $current_tab = "Activity Logs";
        }

        $_SESSION["current_tab"] = $current_tab;
    } else {
        $response = "login";

        $user_details = $model->MOD_GET_USER_ACCOUNT_DETAILS($_SESSION["user_id"]);

        $log_date = date('Y-m-d H:i:s');
        $activity = $user_details[0]->name . " logged out from the system.";
        $user_id = $user_details[0]->id;

        $model->MOD_ADD_ACTIVITY_LOG($log_date, $user_id, $activity);

        unset($_SESSION["user_id"]);

        $_SESSION["login_error"] = array("type" => "alert-success", "message" => "You had been signed out.");
    }

    echo json_encode($response);
}

if (isset($_POST["new_book"])) {
    $title = $_POST["title"];
    $author = $_POST["author"];
    $genre = $_POST["genre"];
    $year_published = $_POST["year_published"];
    $description = $_POST["description"];
    $image = $_FILES['image'];

    $uploaded_image = upload_image($image, "../dist/img/books/");

    $response = false;

    if ($uploaded_image) {
        $_SESSION["notification"] = array(
            "title" => "Success!",
            "text" => "New book has been saved.",
            "icon" => "success"
        );

        $model->MOD_ADD_NEW_BOOK($title, $author, $genre, $year_published, $uploaded_image, $description);

        $user_details = $model->MOD_GET_USER_ACCOUNT_DETAILS($_SESSION["user_id"]);

        $log_date = date('Y-m-d H:i:s');
        $activity = $user_details[0]->name . " added a new book entitled " . $title;
        $user_id = $user_details[0]->id;

        $model->MOD_ADD_ACTIVITY_LOG($log_date, $user_id, $activity);

        $response = true;
    }

    echo json_encode($response);
}
