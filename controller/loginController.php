<?php
     session_start();
     require_once("./models/Base.php");
     require_once("./models/MyLogin.php");

     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'] ?? '';
        $pass = $_POST['pass'] ?? '';

        $login = new MyLogin();
        $userId = $login->login($email, $pass);

        if ($userId) {
            $_SESSION['id'] = $userId;
            header("Location: http://localhost:8000/location.php");
            exit;
        } else {
            $error = "email ou Passowrd incorrect.";
        }
    }
    include("./views/myLogin.php");
?>