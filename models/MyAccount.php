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

    /** Updates the password for a specific user in the database.
     * @param int $userId The ID of the user whose password is to be updated.
     * @param string $newPassword The new plaintext password to be set.
     * @return bool Returns true if the password was successfully updated; false otherwise. */
    public function updatePassword($userId, $newPassword){
        // Hash the new password using the default algorithm (currently BCRYPT).
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        // Prepare the SQL statement to update the user's password.
        $stmt = $this->pdo->prepare("UPDATE user SET pass = ? WHERE id = ?");
        // Execute the statement with the hashed password and user ID as parameters.
        $stmt->execute([$hashedPassword, $userId]);
        // Return true if at least one row was affected (i.e., the password was updated).
        return $stmt->rowCount() > 0;
    }

    /** Verifies whether the provided current password matches the stored password for the user.
     * If the stored hash needs to be rehashed (e.g., due to updated algorithm parameters), it rehashes and updates it.
     * @param int $userId The ID of the user whose password is to be verified.
     * @param string $currentPassword The plaintext password provided by the user.
     * @return bool Returns true if the password is correct; false otherwise. */
    public function checkPassword($userId, $currentPassword) {
        // Prepare the SQL statement to retrieve the stored password hash for the user.
        $stmt = $this->pdo->prepare("SELECT pass FROM user WHERE id = ?");
        $stmt->execute([$userId]);
        // Fetch the user's data as an associative array.
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // If the user exists and the provided password matches the stored hash.
        if ($user && password_verify($currentPassword, $user['pass'])) {
            // Check if the hash needs to be rehashed according to current algorithm parameters
            if (password_needs_rehash($user['pass'], PASSWORD_DEFAULT)) {
                // Rehash the password.
                $newHash = password_hash($currentPassword, PASSWORD_DEFAULT);
                // Prepare the SQL statement to update the user's password hash.
                $updateStmt = $this->pdo->prepare("UPDATE user SET pass = ? WHERE id = ?");
                $updateStmt->execute([$newHash, $userId]);
            }
            // Password is correct.
            return true;
        }
        // Password is incorrect or user not found.
        return false;
    }
}
?>
