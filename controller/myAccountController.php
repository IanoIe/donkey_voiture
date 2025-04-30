<?php
    require("./models/MyAccount.php");

    class myAccountController {
        public function myAccount() {

        $myAccountObj = new MyAccount();
        $user = $myAccountObj->readMyAccount();


        require("./views/myAccount.php");
        }
    }

    $myAccoun = new myAccountController();
    $myAccoun->myAccount();
?>
