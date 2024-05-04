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

    public function MOD_GET_RECENTLY_ADDEDD_BOOK()
    {
        $conn = $this->MOD_CONNECT_TO_DATABASE();

        $sql = $conn->prepare("SELECT `id` FROM `tbl_info_books` ORDER BY `id` DESC LIMIT 1");

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
        $search = isset($_GET["search"]) ? $_GET["search"] : null;

        $conn = $this->MOD_CONNECT_TO_DATABASE();

        if ($search) {
            $sql = $conn->prepare("SELECT * FROM `tbl_info_books` WHERE `title` LIKE '%" . $search . "%' OR `author` LIKE '%" . $search . "%' OR `genre` LIKE '%" . $search . "%' ORDER BY `id` DESC");
        } else {
            $sql = $conn->prepare("SELECT * FROM `tbl_info_books` ORDER BY `id` DESC");
        }

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

    public function MOD_GET_STUDENTS()
    {
        $conn = $this->MOD_CONNECT_TO_DATABASE();

        $sql = $conn->prepare("SELECT * FROM `tbl_info_profiles` ORDER BY `id` DESC");
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

    public function MOD_GET_BOOK_DETAILS($book_id)
    {
        $conn = $this->MOD_CONNECT_TO_DATABASE();

        $sql = $conn->prepare("SELECT * FROM `tbl_info_books` WHERE id = ?");
        $sql->bind_param("s", $book_id);
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

    public function MOD_ADD_NEW_BOOK($title, $author, $genre, $year_published, $image, $description)
    {
        $conn = $this->MOD_CONNECT_TO_DATABASE();

        $sql = $conn->prepare("INSERT INTO `tbl_info_books` (`id`, `title`, `author`, `genre`, `year_published`, `image`, `description`) VALUES (NULL, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param("ssssss", $title, $author, $genre, $year_published, $image, $description);
        $sql->execute();

        $sql->close();
        $conn->close();
    }

    public function MOD_ADD_NEW_INVENTORY($book_id, $inventory)
    {
        $conn = $this->MOD_CONNECT_TO_DATABASE();

        $sql = $conn->prepare("INSERT INTO `tbl_info_inventory` (`id`, `book_id`, `inventory`) VALUES (NULL, ?, ?)");
        $sql->bind_param("ss", $book_id, $inventory);
        $sql->execute();

        $sql->close();
        $conn->close();
    }

    public function MOD_UPDATE_BOOK($title, $author, $genre, $year_published, $image, $description, $id)
    {
        $conn = $this->MOD_CONNECT_TO_DATABASE();

        $sql = $conn->prepare("UPDATE `tbl_info_books` SET `title` = ?, `author` = ?, `genre` = ?, `year_published` = ?, `image` = ?, `description` = ? WHERE `id` = ?");
        $sql->bind_param("sssssss", $title, $author, $genre, $year_published, $image, $description, $id);
        $sql->execute();

        $sql->close();
        $conn->close();
    }

    public function MOD_UPDATE_BOOK_NO_IMAGE($title, $author, $genre, $year_published, $description, $id)
    {
        $conn = $this->MOD_CONNECT_TO_DATABASE();

        $sql = $conn->prepare("UPDATE `tbl_info_books` SET `title` = ?, `author` = ?, `genre` = ?, `year_published` = ?, `description` = ? WHERE `id` = ?");
        $sql->bind_param("ssssss", $title, $author, $genre, $year_published, $description, $id);
        $sql->execute();

        $sql->close();
        $conn->close();
    }

    public function MOD_UPDATE_ACCOUNT($name, $username, $password, $id)
    {
        $conn = $this->MOD_CONNECT_TO_DATABASE();

        $sql = $conn->prepare("UPDATE `tbl_info_useraccounts` SET `name` = ?, `username` = ?, `password` = ? WHERE `id` = ?");
        $sql->bind_param("ssss", $name, $username, $password, $id);
        $sql->execute();

        $sql->close();
        $conn->close();
    }

    public function MOD_UPDATE_ACCOUNT_NAME($name, $id)
    {
        $conn = $this->MOD_CONNECT_TO_DATABASE();

        $sql = $conn->prepare("UPDATE `tbl_info_useraccounts` SET `name` = ? WHERE `id` = ?");
        $sql->bind_param("ss", $name, $id);
        $sql->execute();

        $sql->close();
        $conn->close();
    }
    
    public function MOD_UPDATE_INVENTORY($new_inventory, $book_id)
    {
        $conn = $this->MOD_CONNECT_TO_DATABASE();

        $sql = $conn->prepare("UPDATE `tbl_info_inventory` SET `inventory` = ? WHERE `book_id` = ?");
        $sql->bind_param("ss", $new_inventory, $book_id);
        $sql->execute();

        $sql->close();
        $conn->close();
    }
    
    public function MOD_UPDATE_OFFTAKE($status, $offtake_id)
    {
        $conn = $this->MOD_CONNECT_TO_DATABASE();

        $sql = $conn->prepare("UPDATE `tbl_info_offtake` SET `status` = ? WHERE `id` = ?");
        $sql->bind_param("ss", $status, $offtake_id);
        $sql->execute();

        $sql->close();
        $conn->close();
    }

    public function MOD_UPDATE_PROFILE($student_number, $course, $year, $section, $first_name, $middle_name, $last_name, $birthday, $mobile_number, $email, $address, $useraccount_id)
    {
        $conn = $this->MOD_CONNECT_TO_DATABASE();

        $sql = $conn->prepare("UPDATE `tbl_info_profiles` SET `student_number` = ?, `course` = ?, `year` = ?, `section` = ?, `first_name` = ?, `middle_name` = ?, `last_name` = ?, `birthday` = ?, `mobile_number` = ?, `email` = ?, `address` = ? WHERE `useraccount_id` = ?");
        $sql->bind_param("ssssssssssss", $student_number, $course, $year, $section, $first_name, $middle_name, $last_name, $birthday, $mobile_number, $email, $address, $useraccount_id);
        $sql->execute();

        $sql->close();
        $conn->close();
    }

    public function MOD_UPDATE_ACCOUNT_NO_PASSWORD($name, $username, $id)
    {
        $conn = $this->MOD_CONNECT_TO_DATABASE();

        $sql = $conn->prepare("UPDATE `tbl_info_useraccounts` SET `name` = ?, `username` = ? WHERE `id` = ?");
        $sql->bind_param("sss", $name, $username, $id);
        $sql->execute();

        $sql->close();
        $conn->close();
    }

    public function MOD_DELETE_BOOK($book_id)
    {
        $conn = $this->MOD_CONNECT_TO_DATABASE();

        $sql = $conn->prepare("DELETE FROM `tbl_info_books` WHERE id = ?");
        $sql->bind_param("s", $book_id);
        $sql->execute();
    }

    public function MOD_DELETE_STUDENT_PROFILE($useraccount_id)
    {
        $conn = $this->MOD_CONNECT_TO_DATABASE();

        $sql = $conn->prepare("DELETE FROM `tbl_info_profiles` WHERE useraccount_id = ?");
        $sql->bind_param("s", $useraccount_id);
        $sql->execute();
    }

    public function MOD_DELETE_USER_ACCOUNT($useraccount_id)
    {
        $conn = $this->MOD_CONNECT_TO_DATABASE();

        $sql = $conn->prepare("DELETE FROM `tbl_info_useraccounts` WHERE id = ?");
        $sql->bind_param("s", $useraccount_id);
        $sql->execute();
    }

    public function MOD_DELETE_BOOK_INVENTORY($book_id)
    {
        $conn = $this->MOD_CONNECT_TO_DATABASE();

        $sql = $conn->prepare("DELETE FROM `tbl_info_inventory` WHERE book_id = ?");
        $sql->bind_param("s", $book_id);
        $sql->execute();
    }

    public function MOD_GET_STUDENT_DATA($useraccount_id)
    {
        $conn = $this->MOD_CONNECT_TO_DATABASE();

        $sql = $conn->prepare("SELECT * FROM `tbl_info_profiles` WHERE useraccount_id = ?");
        $sql->bind_param("s", $useraccount_id);
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
    
    public function MOD_GET_STUDENT_OFFTAKE($user_id)
    {
        $conn = $this->MOD_CONNECT_TO_DATABASE();

        $sql = $conn->prepare("SELECT * FROM `tbl_info_offtake` WHERE user_id = ?");
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
    
    public function MOD_GET_ALL_OFFTAKE()
    {
        $conn = $this->MOD_CONNECT_TO_DATABASE();

        $sql = $conn->prepare("SELECT * FROM `tbl_info_offtake` ORDER BY `id` DESC");
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
    
    public function MOD_GET_OFFTAKE_DATA($id)
    {
        $conn = $this->MOD_CONNECT_TO_DATABASE();

        $sql = $conn->prepare("SELECT * FROM `tbl_info_offtake` WHERE `id` = ?");
        $sql->bind_param("s", $id);
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

    public function MOD_GET_STUDENT_DATA_BY_STUDENT_NUMBER($student_number)
    {
        $conn = $this->MOD_CONNECT_TO_DATABASE();

        $sql = $conn->prepare("SELECT * FROM `tbl_info_profiles` WHERE `student_number` = ?");
        $sql->bind_param("s", $student_number);
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

    public function MOD_GET_INVENTORY_DATA($book_id)
    {
        $conn = $this->MOD_CONNECT_TO_DATABASE();

        $sql = $conn->prepare("SELECT * FROM `tbl_info_inventory` WHERE `book_id` = ?");
        $sql->bind_param("s", $book_id);
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
    
    public function MOD_GET_ALL_INVENTORY_DATA()
    {
        $conn = $this->MOD_CONNECT_TO_DATABASE();

        $sql = $conn->prepare("SELECT * FROM `tbl_info_inventory`");
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

    public function MOD_ADD_OFFTAKE($date_created, $user_id, $book_id, $book_quantity, $status)
    {
        $conn = $this->MOD_CONNECT_TO_DATABASE();

        $sql = $conn->prepare("INSERT INTO `tbl_info_offtake` (`id`, `date_created`, `user_id`, `book_id`, `quantity`, `status`) VALUES (NULL, ?, ?, ?, ?, ?)");
        $sql->bind_param("sssss", $date_created, $user_id, $book_id, $book_quantity, $status);
        $sql->execute();

        $sql->close();
        $conn->close();
    }
}

$model = new model();
