<?php
require_once("./models/Base.php");
require_once("./models/MyRegister.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstName = $_POST["firstName"] ?? '';
    $lastName  = $_POST["lastName"] ?? '';
    $gender    = $_POST["gender"] ?? '';
    $phone     = $_POST["phone"] ?? '';
    $email     = $_POST["email"] ?? '';
    $pass      = $_POST["pass"] ?? '';

    $myRegister = new MyRegister(); 
    if ($myRegister->createRegister($firstName, $lastName, $gender, $phone, $email, $pass)) {
        echo "Success register!";
        header('Location: http://localhost:8000/');
    } else {
        echo "Error register";
    }
}

include "./views/myRegister.php";
