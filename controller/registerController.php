<?php
require_once("./models/MyRegister.php");

class registerController {
    private $userModel;

    public function __construct() {
        $this->userModel = new MyRegister();
    }

    public function register() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $firstName = $_POST["firstName"] ?? '';
            $lastName  = $_POST["lastName"] ?? '';
            $gender    = $_POST["gender"] ?? '';
            $phone     = $_POST["phone"] ?? '';
            $email     = $_POST["email"] ?? '';
            $pass      = $_POST["pass"] ?? '';

            if ($this->userModel->createRegister($firstName, $lastName, $gender, $phone, $email, $pass)) {
            echo "Success register!";
            header('Location: http://localhost:8000/');
            exit;    
        } else {
                echo "Error register";
        }
    }
    include "./views/myRegister.php";
  }
}
?>
