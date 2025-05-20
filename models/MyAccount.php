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
            $sql = "DELETE FROM user WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $userId]);
            return $stmt->rowCount() > 0; 
        } catch (Exception $ex) {
            echo "Erro: " . $ex->getMessage();
            return false;
        }
    }

    /** Updates the password for a specific user in the database.
     * @param int $userId The ID of the user whose password is to be updated.
     * @param string $newPassword The new plaintext password to be set.
     * @return bool Returns true if the password was successfully updated; false otherwise. */
    public function updatePassword($userId, $newPassword){
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("UPDATE user SET pass = ? WHERE id = ?");
        $stmt->execute([$hashedPassword, $userId]);
        return $stmt->rowCount() > 0;
    }

    /** Verifies whether the provided current password matches the stored password for the user.
     * If the stored hash needs to be rehashed (e.g., due to updated algorithm parameters), it rehashes and updates it.
     * @param int $userId The ID of the user whose password is to be verified.
     * @param string $currentPassword The plaintext password provided by the user.
     * @return bool Returns true if the password is correct; false otherwise. */
    public function checkPassword($userId, $currentPassword) {
        $stmt = $this->pdo->prepare("SELECT pass FROM user WHERE id = ?");
        $stmt->execute([$userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($currentPassword, $user['pass'])) {
            if (password_needs_rehash($user['pass'], PASSWORD_DEFAULT)) {
                // Rehash the password.
                $newHash = password_hash($currentPassword, PASSWORD_DEFAULT);
                $updateStmt = $this->pdo->prepare("UPDATE user SET pass = ? WHERE id = ?");
                $updateStmt->execute([$newHash, $userId]);
            }
            return true;
        }
        return false;
    }

    /** Updates the user's account information in the database.
     * This method constructs a dynamic SQL UPDATE query based on the fields provided in the $updatedFields array.
     * It prepares and executes the query using PDO to safely update the user's data.
     * @param int $userId The ID of the user whose data is to be updated.
     * @param array $updatedFields An associative array where keys are column names and values are the new values to be set.
     * @return bool Returns true if the update was successful, false otherwise. */
    public function updateUser($userId, $updatedFields) {
        if (empty($updatedFields)) {
            return false;
        }
        // Initialize arrays to hold the SET clause and parameters for the prepared statement
        $setClause = [];
        $params = [];
        // Loop through the updated fields to build the SET clause and parameters
        foreach ($updatedFields as $field => $value) {
            $setClause[] = "$field = :$field";
            $params[":$field"] = $value;
        }

        $params[":id"] = $userId;
        // Combine the SET clauses into a single string
        $setClauseStr = implode(", ", $setClause);
        $sql = "UPDATE user SET $setClauseStr WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }
}
?>
