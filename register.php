<?php
     // Include the registerController file to access its functionalities
     require_once('./controller/registerController.php');
      // Creates an instance of the registerController class
     $register = new registerController();
     // Calls the register method of the registerController class
     $register->register();
?>