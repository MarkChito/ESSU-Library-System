<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header("HTTP/1.0 403 Forbidden");
    echo "Access Forbidden";
    exit();
}

class model
{
    private function MOD_CONNECT_TO_DATABASE()
    {
        $servername = "localhost";
        $db_username = "root";
        $db_password = "";
        $database = "essu_library_system";

        $conn = new mysqli($servername, $db_username, $db_password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }

    public function MOD_CHECK_USERNAME($username)
    {
        $conn = $this->MOD_CONNECT_TO_DATABASE();

        $sql = $conn->prepare("SELECT * FROM `tbl_info_useraccounts` WHERE username = ?");
        $sql->bind_param("s", $username);
        $sql->execute();

        $result = $sql->get_result();

        $userObjects = array();

        while ($userObject = $result->fetch_object()) {
            $userObjects[] = $userObject;
        }

        $sql->close();
        $conn->close();

        return $userObjects;
    }

    public function MOD_GET_USER_ACCOUNT_DETAILS($user_id)
    {
        $conn = $this->MOD_CONNECT_TO_DATABASE();

        $sql = $conn->prepare("SELECT * FROM `tbl_info_useraccounts` WHERE `id` = ?");
        $sql->bind_param("s", $user_id);
        $sql->execute();

        $result = $sql->get_result();

        $userObjects = array();

        while ($userObject = $result->fetch_object()) {
            $userObjects[] = $userObject;
        }

        $sql->close();
        $conn->close();

        return $userObjects;
    }

    public function MOD_GET_BOOKS()
    {
        $conn = $this->MOD_CONNECT_TO_DATABASE();

        $sql = $conn->prepare("SELECT * FROM `tbl_info_books` ORDER BY `id` DESC");
        $sql->execute();

        $result = $sql->get_result();

        $userObjects = array();

        while ($userObject = $result->fetch_object()) {
            $userObjects[] = $userObject;
        }

        $sql->close();
        $conn->close();

        return $userObjects;
    }

    public function MOD_GET_ALL_ACTIVITY_LOGS()
    {
        $conn = $this->MOD_CONNECT_TO_DATABASE();

        $sql = $conn->prepare("SELECT * FROM `tbl_info_activitylogs` ORDER BY `id` DESC");
        $sql->execute();

        $result = $sql->get_result();

        $userObjects = array();

        while ($userObject = $result->fetch_object()) {
            $userObjects[] = $userObject;
        }

        $sql->close();
        $conn->close();

        return $userObjects;
    }

    public function MOD_GET_SINGLE_ACTIVITY_LOGS($user_id)
    {
        $conn = $this->MOD_CONNECT_TO_DATABASE();

        $sql = $conn->prepare("SELECT * FROM `tbl_info_activitylogs` WHERE `user_id` = ? ORDER BY `id` DESC");
        $sql->bind_param("s", $user_id);
        $sql->execute();

        $result = $sql->get_result();

        $userObjects = array();

        while ($userObject = $result->fetch_object()) {
            $userObjects[] = $userObject;
        }

        $sql->close();
        $conn->close();

        return $userObjects;
    }

    public function MOD_CREATE_AN_ACCOUNT($name, $username, $password)
    {
        $conn = $this->MOD_CONNECT_TO_DATABASE();

        $sql = $conn->prepare("INSERT INTO `tbl_info_useraccounts` (`id`, `name`, `username`, `password`, `user_type`) VALUES (NULL, ?, ?, ?, 'student')");
        $sql->bind_param("sss", $name, $username, $password);
        $sql->execute();

        $sql->close();
        $conn->close();
    }

    public function MOD_ADD_PROFILE($useraccount_id, $student_number, $course, $year, $section, $first_name, $middle_name, $last_name, $birthday, $mobile_number, $email, $address)
    {
        $conn = $this->MOD_CONNECT_TO_DATABASE();

        $sql = $conn->prepare("INSERT INTO `tbl_info_profiles` (`id`, `useraccount_id`, `student_number`, `course`, `year`, `section`, `first_name`, `middle_name`, `last_name`, `birthday`, `mobile_number`, `email`, `address`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param("ssssssssssss", $useraccount_id, $student_number, $course, $year, $section, $first_name, $middle_name, $last_name, $birthday, $mobile_number, $email, $address);
        $sql->execute();

        $sql->close();
        $conn->close();
    }

    public function MOD_ADD_ACTIVITY_LOG($log_date, $user_id, $activity)
    {
        $conn = $this->MOD_CONNECT_TO_DATABASE();

        $sql = $conn->prepare("INSERT INTO `tbl_info_activitylogs` (`id`, `log_date`, `user_id`, `activity`) VALUES (NULL, ?, ?, ?)");
        $sql->bind_param("sss", $log_date, $user_id, $activity);
        $sql->execute();

        $sql->close();
        $conn->close();
    }

    public function MOD_ADD_NEW_BOOK($title, $author, $genre, $year_published, $image, $description)
    {
        $conn = $this->MOD_CONNECT_TO_DATABASE();

        $sql = $conn->prepare("INSERT INTO `tbl_info_books` (`id`, `title`, `author`, `genre`, `year_published`, `image`, `description`) VALUES (NULL, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param("ssssss", $title, $author, $genre, $year_published, $image, $description);
        $sql->execute();

        $sql->close();
        $conn->close();
    }
}

$model = new model();
