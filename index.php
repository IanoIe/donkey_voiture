<?php
     // Include the login controller file to access its functionalities
     require_once('./controller/loginController.php');
     // Instantiate the loginController class
     $login = new loginController();
     // Call the login method to process the login request
     $login->login();        
?>