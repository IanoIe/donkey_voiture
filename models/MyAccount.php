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

    /** Deletes a user from the database based on their user ID.
     * This method prepares and executes a DELETE SQL statement to remove the user
     * record from the 'user' table where the 'id' matches the provided user ID.
     * It returns true if the deletion is successful (i.e., one or more rows are affected),
     * and false if an error occurs during the process.
     * @param int $userId The ID of the user to be deleted.
     * @return bool Returns true if the deletion was successful, false otherwise. */
    public function deleteUser($userId) {
        try {
            // Prepare the DELETE SQL statement with a named placeholder for the user ID.
            $sql = "DELETE FROM user WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $userId]);
            return $stmt->rowCount() > 0; // Returns true if at least one row was deleted
        } catch (Exception $ex) {
            echo "Erro: " . $ex->getMessage();
            return false;
        }
    }
}
?>
