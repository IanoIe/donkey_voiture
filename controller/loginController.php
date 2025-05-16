<?php
session_start();
require_once("./models/MyLogin.php");

class loginController {
    /** Verifies if the user is authenticated.
    * This method checks whether the user's ID is stored in the session. If not,
    * it redirects the user to the login page to ensure that only authenticated
    * users can access the protected resources.
    * @return void  */
    public function verificarLogin() {
        if (!isset($_SESSION['user']['id'])) {
            header("Location: MyLogin.php");
            exit;
        }
    }

    /** Handles user login process.
    * This method processes the login form submission. It validates the provided
    * email and password, attempts to authenticate the user, and sets up the
    * session with the user's data upon successful login. If authentication fails,
    * it sets an error message in the session.
    * @return void  */
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'] ?? '';
            $pass = $_POST['pass'] ?? '';

            $login = new MyLogin();
            $userId = $login->login($email, $pass);

            if ($userId) {
                $userData = $login->getUserById($userId); 

                if ($userData) {
                    $_SESSION['user'] = $userData; 
                    header("Location: http://localhost:8000/location.php");
                    exit;
                } else {
                    $_SESSION['error'] = "Error fetching user data.";
                }
            } else {
                $_SESSION['error'] = "Incorrect email or password.";
            }
        }
        include("./views/myLogin.php");
    }

    /** Logs out the user and redirects to the login page.
    * This method clears the session data and destroys the session to log out the
    * user. After logging out, it redirects the user to the login page.
    * @return void */
    public function logout() {
        session_unset();  
        session_destroy(); 
        header("Location: /MyLogin.php");
        exit;
    }
}
?>