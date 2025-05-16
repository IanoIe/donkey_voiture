<?php
     // Include the location controller class file
     require_once('./controller/myAccountController.php');
     // Create an instance of the locationController class
     $myAccounts = new myAccountController();
     // Call the myAccount method to handle the location functionality
     $myAccounts->myAccount();
?>