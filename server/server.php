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

if (isset($_POST["location_link"])) {
    $location_link = $_POST["location_link"];

    if ($location_link != "logout") {
        $response = $location_link;

        switch ($location_link) {
            case "available_books":
                $current_tab = "Available Books";

                break;

            case "books_management":
                $current_tab = "Books Management";

                break;

            case "students_management":
                $current_tab = "Students Management";

                break;

            case "profile":
                $current_tab = "My Profile";

                break;

            case "activity_logs":
                $current_tab = "Activity Logs";

                break;

            case "borrowed_books":
                $current_tab = "Borrowed Books";

                break;

            case "books_inventory":
                $current_tab = "Books Inventory";

                break;
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

    $error_username = array("error_username" => false);
    $error_student_number = array("error_student_number" => false);
    $errors = 0;

    if ($model->MOD_CHECK_USERNAME($username)) {
        $errors++;

        $error_username = array("error_username" => true);
    }

    if ($model->MOD_GET_STUDENT_DATA_BY_STUDENT_NUMBER($student_number)) {
        $error_student_number = array("error_student_number" => true);

        $errors++;
    }

    $response = array_merge($error_username, $error_student_number);

    if ($errors == 0) {
        $model->MOD_CREATE_AN_ACCOUNT($name, $username, password_hash($password, PASSWORD_BCRYPT));

        $username_exists = $model->MOD_CHECK_USERNAME($username);

        $model->MOD_ADD_PROFILE($username_exists[0]->id, $student_number, $course, $year, $section, $first_name, $middle_name, $last_name, $birthday, $mobile_number, $email, $address);

        $log_date = date('Y-m-d H:i:s');
        $activity = $name . " created an account.";
        $user_id = $username_exists[0]->id;

        $model->MOD_ADD_ACTIVITY_LOG($log_date, $user_id, $activity);
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

        $book_data = $model->MOD_GET_RECENTLY_ADDEDD_BOOK();

        $model->MOD_ADD_NEW_INVENTORY($book_data[0]->id, "10");

        $user_details = $model->MOD_GET_USER_ACCOUNT_DETAILS($_SESSION["user_id"]);

        $log_date = date('Y-m-d H:i:s');
        $activity = $user_details[0]->name . " added a new book entitled " . $title;
        $user_id = $user_details[0]->id;

        $model->MOD_ADD_ACTIVITY_LOG($log_date, $user_id, $activity);

        $response = true;
    }

    echo json_encode($response);
}

if (isset($_POST["edit_book"])) {
    $id = $_POST["id"];
    $title = $_POST["title"];
    $author = $_POST["author"];
    $genre = $_POST["genre"];
    $year_published = $_POST["year_published"];
    $description = $_POST["description"];
    $image = isset($_FILES['image']) ? $_FILES['image'] : null;

    $response = false;

    if ($image) {
        $uploaded_image = upload_image($image, "../dist/img/books/");

        if ($uploaded_image) {
            $_SESSION["notification"] = array(
                "title" => "Success!",
                "text" => "A book has been updated.",
                "icon" => "success"
            );

            $model->MOD_UPDATE_BOOK($title, $author, $genre, $year_published, $uploaded_image, $description, $id);

            $user_details = $model->MOD_GET_USER_ACCOUNT_DETAILS($_SESSION["user_id"]);

            $log_date = date('Y-m-d H:i:s');
            $activity = $user_details[0]->name . " updated a book entitled " . $title;
            $user_id = $user_details[0]->id;

            $model->MOD_ADD_ACTIVITY_LOG($log_date, $user_id, $activity);

            $response = true;
        } else {
            $_SESSION["notification"] = array(
                "title" => "Oops...",
                "text" => "There is an error while processing your request.",
                "icon" => "error"
            );
        }
    } else {
        $_SESSION["notification"] = array(
            "title" => "Success!",
            "text" => "A book has been updated.",
            "icon" => "success"
        );

        $model->MOD_UPDATE_BOOK_NO_IMAGE($title, $author, $genre, $year_published, $description, $id);

        $user_details = $model->MOD_GET_USER_ACCOUNT_DETAILS($_SESSION["user_id"]);

        $log_date = date('Y-m-d H:i:s');
        $activity = $user_details[0]->name . " updated a book entitled " . $title;
        $user_id = $user_details[0]->id;

        $model->MOD_ADD_ACTIVITY_LOG($log_date, $user_id, $activity);

        $response = true;
    }

    echo json_encode($response);
}

if (isset($_POST["book_details"])) {
    $book_id = $_POST["book_id"];

    $book_details = $model->MOD_GET_BOOK_DETAILS($book_id);

    echo json_encode($book_details);
}

if (isset($_POST["delete_book"])) {
    $book_id = $_POST["book_id"];

    $model->MOD_DELETE_BOOK($book_id);

    $user_details = $model->MOD_GET_USER_ACCOUNT_DETAILS($_SESSION["user_id"]);

    $log_date = date('Y-m-d H:i:s');
    $activity = $user_details[0]->name . " deleted a book.";
    $user_id = $user_details[0]->id;

    $model->MOD_ADD_ACTIVITY_LOG($log_date, $user_id, $activity);
    $model->MOD_DELETE_BOOK_INVENTORY($book_id);

    $_SESSION["notification"] = array(
        "title" => "Success!",
        "text" => "A Book has been deleted.",
        "icon" => "success"
    );

    echo json_encode(true);
}

if (isset($_POST["update_account"])) {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $username = $_POST["username"];
    $password = isset($_POST["password"]) && !empty($_POST["password"]) ? $_POST["password"] : null;
    $old_username = $_POST["old_username"];

    $response = false;
    $errors = 0;

    if (($username != $old_username) && $model->MOD_CHECK_USERNAME($username)) {
        $errors++;
    }

    if ($errors == 0) {
        if ($password) {
            $model->MOD_UPDATE_ACCOUNT($name, $username, password_hash($password, PASSWORD_BCRYPT), $id);
        } else {
            $model->MOD_UPDATE_ACCOUNT_NO_PASSWORD($name, $username, $id);
        }

        $user_details = $model->MOD_GET_USER_ACCOUNT_DETAILS($_SESSION["user_id"]);

        $log_date = date('Y-m-d H:i:s');
        $activity = $user_details[0]->name . " updated his/her account.";
        $user_id = $user_details[0]->id;

        $model->MOD_ADD_ACTIVITY_LOG($log_date, $user_id, $activity);

        $_SESSION["notification"] = array(
            "title" => "Success!",
            "text" => "Account has been updated.",
            "icon" => "success"
        );

        $response = true;
    }

    echo json_encode($response);
}

if (isset($_POST["get_student_data"])) {
    $useraccount_id = $_POST["useraccount_id"];

    $student_data = $model->MOD_GET_STUDENT_DATA($useraccount_id);

    echo json_encode($student_data);
}

if (isset($_POST["update_student"])) {
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
    $old_student_number = $_POST["old_student_number"];
    $useraccount_id = $_POST["useraccount_id"];

    $first_name = $first_name;
    $middle_name = $middle_name ? $middle_name[0] . ". " : null;
    $last_name = $last_name;

    $name = $first_name . " " . $middle_name . $last_name;

    $response = false;
    $errors = 0;

    if (($student_number != $old_student_number) && $model->MOD_GET_STUDENT_DATA_BY_STUDENT_NUMBER($student_number)) {
        $errors++;
    }

    if ($errors == 0) {
        $model->MOD_UPDATE_PROFILE($student_number, $course, $year, $section, $first_name, $middle_name, $last_name, $birthday, $mobile_number, $email, $address, $useraccount_id);

        $user_details = $model->MOD_GET_USER_ACCOUNT_DETAILS($_SESSION["user_id"]);

        $log_date = date('Y-m-d H:i:s');
        $activity = $user_details[0]->name . " updated " . $name . "'s profile.";
        $user_id = $user_details[0]->id;

        $model->MOD_ADD_ACTIVITY_LOG($log_date, $user_id, $activity);

        $_SESSION["notification"] = array(
            "title" => "Success!",
            "text" => "Student Profile has been updated.",
            "icon" => "success"
        );

        $response = true;
    }

    echo json_encode($response);
}

if (isset($_POST["delete_student"])) {
    $useraccount_id = $_POST["useraccount_id"];

    $model->MOD_DELETE_STUDENT_PROFILE($useraccount_id);
    $model->MOD_DELETE_USER_ACCOUNT($useraccount_id);

    $user_details = $model->MOD_GET_USER_ACCOUNT_DETAILS($_SESSION["user_id"]);

    $log_date = date('Y-m-d H:i:s');
    $activity = $user_details[0]->name . " deleted an account.";
    $user_id = $user_details[0]->id;

    $model->MOD_ADD_ACTIVITY_LOG($log_date, $user_id, $activity);

    $_SESSION["notification"] = array(
        "title" => "Success!",
        "text" => "Student Profile has been deleted.",
        "icon" => "success"
    );

    echo json_encode(true);
}

if (isset($_POST["update_profile"])) {
    $response = false;

    $id = $_POST["id"];
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
    $old_student_number = $_POST["old_student_number"];

    $middle_initial = $middle_name ? $middle_name[0] . ". " : null;

    $name = $first_name . " " . $middle_initial . $last_name;

    if (($student_number != $old_student_number) && $model->MOD_GET_STUDENT_DATA_BY_STUDENT_NUMBER($student_number)) {
        $response = false;
    } else {
        $model->MOD_UPDATE_PROFILE($student_number, $course, $year, $section, $first_name, $middle_name, $last_name, $birthday, $mobile_number, $email, $address, $id);
        $model->MOD_UPDATE_ACCOUNT_NAME($name, $id);

        $user_details = $model->MOD_GET_USER_ACCOUNT_DETAILS($_SESSION["user_id"]);

        $log_date = date('Y-m-d H:i:s');
        $activity = $user_details[0]->name . " updated his/her profile.";
        $user_id = $user_details[0]->id;

        $model->MOD_ADD_ACTIVITY_LOG($log_date, $user_id, $activity);

        $_SESSION["notification"] = array(
            "title" => "Success!",
            "text" => "Profile has been updated.",
            "icon" => "success"
        );

        $response = true;
    }

    echo json_encode($response);
}

if (isset($_POST["borrow_book"])) {
    $book_id = $_POST["book_id"];
    $user_id = $_POST["user_id"];
    $book_quantity = $_POST["book_quantity"];

    $response = false;

    $remaining_book = $model->MOD_GET_INVENTORY_DATA($book_id)[0]->inventory;

    if ($book_quantity > $remaining_book) {
        $response = array("error" => "insufficient books are available in the library");
    } else {
        $new_inventory = $remaining_book - $book_quantity;

        $model->MOD_ADD_OFFTAKE(date('Y-m-d H:i:s'), $user_id, $book_id, $book_quantity, "Pending");
        $model->MOD_UPDATE_INVENTORY($new_inventory, $book_id);

        $copies = "copy";

        if ($book_quantity > 1) {
            $copies = "copies";
        }

        $book_data = $model->MOD_GET_BOOK_DETAILS($book_id);

        $user_details = $model->MOD_GET_USER_ACCOUNT_DETAILS($_SESSION["user_id"]);

        $log_date = date('Y-m-d H:i:s');
        $activity = $user_details[0]->name . " requested " . $book_quantity . " " . $copies . " of " . $book_data[0]->title . ".";
        $user_id = $user_details[0]->id;

        $model->MOD_ADD_ACTIVITY_LOG($log_date, $user_id, $activity);

        $_SESSION["notification"] = array(
            "title" => "Success!",
            "text" => $book_quantity . " " . $copies . " of " . $book_data[0]->title . " is requested successfully.",
            "icon" => "success"
        );
    }

    echo json_encode($response);
}

if (isset($_POST["reject_request"])) {
    $offtake_id = $_POST["offtake_id"];

    $offtake_data = $model->MOD_GET_OFFTAKE_DATA($offtake_id);
    $inventory_data = $model->MOD_GET_INVENTORY_DATA($offtake_data[0]->book_id);

    $new_inventory = $inventory_data[0]->inventory + $offtake_data[0]->quantity;

    $model->MOD_UPDATE_INVENTORY($new_inventory, $inventory_data[0]->book_id);
    $model->MOD_UPDATE_OFFTAKE("Rejected", $offtake_id);

    $user_details = $model->MOD_GET_USER_ACCOUNT_DETAILS($_SESSION["user_id"]);

    $log_date = date('Y-m-d H:i:s');
    $activity = $user_details[0]->name . " rejected a book request.";
    $user_id = $user_details[0]->id;

    $model->MOD_ADD_ACTIVITY_LOG($log_date, $user_id, $activity);

    $_SESSION["notification"] = array(
        "title" => "Success!",
        "text" => "Book request has been rejected.",
        "icon" => "success"
    );

    echo json_encode(true);
}

if (isset($_POST["approved_request"])) {
    $offtake_id = $_POST["offtake_id"];

    $model->MOD_UPDATE_OFFTAKE("Approved", $offtake_id);

    $user_details = $model->MOD_GET_USER_ACCOUNT_DETAILS($_SESSION["user_id"]);

    $log_date = date('Y-m-d H:i:s');
    $activity = $user_details[0]->name . " approved a book request.";
    $user_id = $user_details[0]->id;

    $model->MOD_ADD_ACTIVITY_LOG($log_date, $user_id, $activity);

    $_SESSION["notification"] = array(
        "title" => "Success!",
        "text" => "Book request has been approved.",
        "icon" => "success"
    );

    echo json_encode(true);
}

if (isset($_POST["inventory_details"])) {
    $book_id = $_POST["book_id"];

    $inventory_data = $model->MOD_GET_INVENTORY_DATA($book_id);

    echo json_encode($inventory_data);
}

if (isset($_POST["update_inventory"])) {
    $book_id = $_POST["book_id"];
    $quantity = $_POST["quantity"];

    $model->MOD_UPDATE_INVENTORY($quantity, $book_id);

    $user_details = $model->MOD_GET_USER_ACCOUNT_DETAILS($_SESSION["user_id"]);

    $log_date = date('Y-m-d H:i:s');
    $activity = $user_details[0]->name . " updated a book inventory.";
    $user_id = $user_details[0]->id;

    $model->MOD_ADD_ACTIVITY_LOG($log_date, $user_id, $activity);

    $_SESSION["notification"] = array(
        "title" => "Success!",
        "text" => "Book inventory has been updated.",
        "icon" => "success"
    );

    echo json_encode(true);
}

if (isset($_POST["set_as_returned"])) {
    $offtake_id = $_POST["offtake_id"];
    
    $offtake_data = $model->MOD_GET_OFFTAKE_DATA($offtake_id);
    $inventory_data = $model->MOD_GET_INVENTORY_DATA($offtake_data[0]->book_id);

    $new_inventory = $inventory_data[0]->inventory + $offtake_data[0]->quantity;

    $model->MOD_UPDATE_INVENTORY($new_inventory, $inventory_data[0]->book_id);
    $model->MOD_UPDATE_OFFTAKE("Returned", $offtake_id);

    $user_details = $model->MOD_GET_USER_ACCOUNT_DETAILS($_SESSION["user_id"]);

    $log_date = date('Y-m-d H:i:s');
    $activity = $user_details[0]->name . " set a book as returned.";
    $user_id = $user_details[0]->id;

    $model->MOD_ADD_ACTIVITY_LOG($log_date, $user_id, $activity);

    $_SESSION["notification"] = array(
        "title" => "Success!",
        "text" => "Book is set as Returned.",
        "icon" => "success"
    );

    echo json_encode(true);
}
