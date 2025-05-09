<?php
require_once("./config/db.php");
require_once("Base.php");

    class MyRegister extends Base{
        public $firstName;
        public $lastName;
        public $gender;
        public $phone;
        public $email;
        public $pass;

    public function createRegister($firstName, $lastName, $gender, $phone, $email, $pass) {
        $passHash = password_hash($pass, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO user (firstName, lastName, gender, phone, email, pass) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$firstName, $lastName, $gender, $phone, $email, $passHash]);
    }
}


?>