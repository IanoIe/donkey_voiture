<?php
    require_once("./config/db.php");
    require_once("Base.php");
    

   class MyAccount extends Base {

    public $firstName;
    public $lastName;
    public $email;
    public $phone;

    public function readMyAccount(){
        $sql = "SELECT firstName, lastName, email, phone FROM user";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   }

   //$user = new MyAccount();
   //var_dump($user->readMyAccount());

?>