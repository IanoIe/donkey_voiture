<?php
require_once("./config/db.php");
require_once("Base.php");
class MyLogin extends Base {

    public function __construct() {
        parent::__construct(); // calls the Base constructor and initializes $pdo
    }

    public function login($email, $pass) {
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


