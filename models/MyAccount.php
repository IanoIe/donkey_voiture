<?php
require_once("./config/db.php");
require_once("Base.php");

/** Class MyAccount
 * This class provides methods to interact with user account information in the database.
 * It extends the Base class to utilize the PDO database connection. */
class MyAccount extends Base {

    public $firstName;
    public $lastName;
    public $email;
    public $phone;

     /** Retrieves the account details of a user by their ID.
     * This method executes a SQL query to fetch the user's first name, last name, email, and phone number
     * from the 'user' table where the user ID matches the provided parameter.
     * @param int $userId The ID of the user whose account details are to be retrieved.
     * @return array|null An associative array containing the user's account details, or null if no user is found. */
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
