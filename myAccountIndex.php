<?php
require_once('./controller/myAccountController.php'); 
$controller = new myAccountController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_account'])) {
        $controller->delete();
    } elseif (isset($_POST['change_password'])) {
        $controller->changePassword();
    } elseif (isset($_GET['action']) && $_GET['action'] === 'editMyAccount') {
        $controller->updateUser();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
    if ($_GET['action'] === 'changePassword') {
        $controller->changePassword();
    } elseif ($_GET['action'] === 'editMyAccount') {
        $controller->updateUser();
    } else {
        $controller->myAccount();
    }
} else {
    $controller->myAccount();
}


?>
