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
        // Retrieve the current user's ID from the session
        $userId = $this->userId; 
        // Initialize the message variable to store feedback for the user
        $message = '';

        // Check if the form has been submitted via POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve and sanitize form inputs
            $currentPassword = $_POST['current_password'] ?? '';
            $newPassword = $_POST['new_password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            // Validate that the new password and confirmation match
            if ($newPassword !== $confirmPassword) {
                $message = "The new passwords do not match.";
            }
            // Verify that the current password is correct
            elseif (!$this->model->checkPassword($userId, $currentPassword)) {
                $message = "Incorrect current password.";
            }
            // Proceed to update the password
            else {
                // Attempt to update the password in the database
                if ($this->model->updatePassword($userId, $newPassword)) {
                    // Destroy the current session to log the user out
                    session_destroy();
                    // Redirect the user to the login page
                    header('Location: /MyLogin.php');
                    exit;
                } else {
                    // Set an error message if the password update fails
                    $message = "Error updating the password.";
                }
            }
        }
        // Include the change password view to display the form and any messages
        include("./views/changePassword.php");
    }
}
?>



