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

    /** Handles the password change process for the authenticated user.
     * This method performs the following steps:
     * 1. Checks if the request method is POST to process form submission.
     * 2. Retrieves and sanitizes the current, new, and confirmation passwords from the POST data.
     * 3. Validates that the new password and confirmation match.
     * 4. Verifies that the current password is correct using the model's checkPassword method.
     * 5. If validations pass, updates the password using the model's updatePassword method.
     * 6. Upon successful update, destroys the current session and redirects to the login page.
     * 7. If any validation fails, sets an appropriate error message.
     * 8. Includes the change password view to display the form and any messages. */
    public function changePassword() {
        $userId = $this->userId; 
        $message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $currentPassword = $_POST['current_password'] ?? '';
            $newPassword = $_POST['new_password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            if ($newPassword !== $confirmPassword) {
                $message = "The new passwords do not match.";
            }
            elseif (!$this->model->checkPassword($userId, $currentPassword)) {
                $message = "Incorrect current password.";
            }
            else {
                if ($this->model->updatePassword($userId, $newPassword)) {
                    session_destroy();
                    header('Location: /MyLogin.php');
                    exit;
                } else {
                    $message = "Error updating the password.";
                }
            }
        }
        include("./views/changePassword.php");
    }

    /** Handles the user profile update process.
     * This method performs the following actions:
     * 1. Checks if the request method is POST to process form submission.
     * 2. Retrieves the current user data from the database.
     * 3. Compares each submitted field with the current data to identify changes.
     * 4. If changes are detected, updates the user's information in the database.
     * 5. Updates the session data with the new user information.
     * 6. Redirects to the account page upon successful update.
     * 7. If no changes are detected or an error occurs, displays the appropriate message. */
    public function updateUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $currentUser = $this->model->readMyAccount($this->userId);
            $updatedFields = [];

            if (isset($_POST['firstName']) && trim($_POST['firstName']) !== $currentUser['firstName']) {
                $updatedFields['firstName'] = trim($_POST['firstName']);
            }
            if (isset($_POST['lastName']) && trim($_POST['lastName']) !== $currentUser['lastName']) {
                $updatedFields['lastName'] = trim($_POST['lastName']);
            }
            if (isset($_POST['email']) && trim($_POST['email']) !== $currentUser['email']) {
                $updatedFields['email'] = trim($_POST['email']);
            }
            if (isset($_POST['phone']) && trim($_POST['phone']) !== $currentUser['phone']) {
                $updatedFields['phone'] = trim($_POST['phone']);
            }
            if (empty($updatedFields)) {
                $message = "Nenhuma alteração foi feita.";
                $user = $currentUser;
                require("./views/edit.php");
                return;
            }
            $success = $this->model->updateUser($this->userId, $updatedFields);

            if ($success) {
                foreach ($updatedFields as $key => $value) {
                    $_SESSION['user'][$key] = $value;
                }
                header("Location: /myAccountIndex.php?update=success");
                exit;
            } else {
                $message = "Erro ao atualizar os dados.";
                $user = array_merge($currentUser, $updatedFields);
                require("./views/edit.php");
            }
        } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $user = $this->model->readMyAccount($this->userId);
            require("./views/edit.php");
        }
    }
 }
?>



