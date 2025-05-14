<?php
require_once("./config/db.php");
require_once("Base.php");

class MyAccount extends Base {

    public $firstName;
    public $lastName;
    public $email;
    public $phone;

    public function readMyAccount($userId){
        $sql = "SELECT firstName, lastName, email, phone 
                FROM user
                WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
