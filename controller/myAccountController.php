<?php
//Starts the session to access the user's session variables
session_start();
// Includes the model that contains the database access logic
require_once("./models/MyAccount.php");


/** Controller class for managing user account functionalities.
 * Handles user authentication, displaying account details, and account deletion. */
class myAccountController {
    private $model;
    private $userId;

    /** Constructor to initialize the controller.
     * Checks if the user is authenticated by verifying the session.
     * If not authenticated, redirects to the login page. */
    public function __construct() {
        if (!isset($_SESSION['user']['id'])) {
            header("Location: /MyLogin.php");
            exit;
        }
        $this->userId = $_SESSION['user']['id'];
        $this->model = new MyAccount();
    }

    /** Displays the user's account information.
     * Retrieves user details from the model and includes the view to display them. */
    public function myAccount() {
        $user = $this->model->readMyAccount($this->userId);
        require("./views/myAccount.php");
    }

    /** Deletes the user's account.
     * Attempts to delete the user via the model.
     * If successful, destroys the session and redirects to a goodbye page.
     * If unsuccessful, displays an error message. */
    public function delete() {
        if ($this->model->deleteUser($this->userId)) {
            session_destroy();
            header('Location: /MyLogin.php');
            exit;
        } else {
            echo "Error: Unable to delete your account.";
            exit;
        }
    }
}
?>



