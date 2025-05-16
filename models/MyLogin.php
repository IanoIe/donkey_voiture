<?php
require_once("./config/db.php");
require_once("Base.php");
class MyLogin extends Base {

    public function __construct() {
        parent::__construct(); // calls the Base constructor and initializes $pdo
    }
    /** Verifies user credentials and returns the user ID upon successful authentication.
    * This method accepts a user's email and password, retrieves the corresponding user record from the database,
    * and verifies the password using `password_verify()`. If the credentials are valid, it returns the user's ID.
    * Otherwise, it returns `false`.
    * @param string $email The user's email address.
    * @param string $pass The user's password.
    * @return int|false The user's ID if authentication is successful, or `false` if not. */
    public function login($email, $pass) {
        $stmt = $this->pdo->prepare("SELECT id, firstName, lastName, phone, pass FROM user WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($pass, $user['pass'])) {
            return $user['id'];
        }
        return false;
    }  
    /** Retrieves a user's details by their ID.
    * This method executes a `SELECT` query to fetch a single record from the 'user' table
    * based on the provided user ID. It returns an associative array containing the user's details.
    * @param int $id The ID of the user to retrieve.
    * @return array|null An associative array containing the user's details, or `null` if no user is found. */
    public function getUserById($id) {
        $stmt = $this->pdo->prepare("SELECT id, firstName, lastName, phone FROM user WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>


