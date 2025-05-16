<?php
require_once("./models/MyRegister.php");

/** Class registerController
 * Handles user registration processes, including form submission handling,
 * input validation, and user creation. */
class registerController {
    /** @var MyRegister Instance of the user registration model.*/
    private $userModel;

    /** registerController constructor.
     * Initializes the user registration model. */
    public function __construct() {
        $this->userModel = new MyRegister();
    }

    /** Processes the user registration request.
     * Handles POST requests from the registration form, validates input data,
     * creates a new user record, and redirects upon successful registration.
     * If registration fails, an error message is displayed.
     * @return void */
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
    // Load the registration view
    include "./views/myRegister.php";
  }
}
?>
