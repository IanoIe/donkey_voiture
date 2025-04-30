<?php
    require_once("Base.php");

    class MyLogin {
        private $pdo;

        public function __construct($pdo) {
            $this->pdo = $pdo;
        }

        public function Login($email, $pass) {
            $stmt = $this->pdo->prepare("SELECT id, pass FROM user WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user && password_verify($pass, $user['pass'])) {
                return $user['id'];
            }
            return false;
        }
    }
?>