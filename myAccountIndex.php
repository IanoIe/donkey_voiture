<?php
// Include the controller file
require_once('./controller/myAccountController.php'); 
// Instantiate the controller
$controller = new myAccountController();

// Check if the form to delete the account was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_account'])) {
        // Call the delete method to handle account deletion
        $controller->delete();
    } elseif (isset($_POST['change_password'])) {
        $controller->changePassword();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
    if ($_GET['action'] === 'changePassword') {
        $controller->changePassword();
    } else {
        // Otherwise, display the user's account information
        $controller->myAccount();
    }
} else {
    $controller->myAccount();
}
?>
