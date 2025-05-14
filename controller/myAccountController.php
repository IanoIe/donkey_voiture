<?php 
session_start();

if (!isset($_SESSION['user']['id'])) {
    header("Location: /MyLogin.php");
    exit;
}  

require("./models/MyAccount.php");

class myAccountController {

    public function myAccount() {
        $myAccountObj = new MyAccount();
        $userId = $_SESSION['user']['id'];
        $user = $myAccountObj->readMyAccount($userId);

        require("./views/myAccount.php");
    }
}
?>

