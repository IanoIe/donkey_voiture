<?php 
session_start();

if (!isset($_SESSION['user']['id'])) {
    header("Location: /MyLogin.php");
    exit;
}  

require("./models/MyAccount.php");

class myAccountController {
    /** Displays the user's account information.
    * This method retrieves the user's details from the database using their user ID,
    * which is stored in the session. It then passes this information to the view for display.
    * @return void  */
    public function myAccount() {
        $myAccountObj = new MyAccount();
        $userId = $_SESSION['user']['id'];
        $user = $myAccountObj->readMyAccount($userId);

        require("./views/myAccount.php");
    }
}
?>

