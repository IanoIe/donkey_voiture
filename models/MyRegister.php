<?php
require_once("./config/db.php");
require_once("Base.php");
/** Class MyRegister
 * Handles user registration operations, including creating new user accounts.
 * Extends the Base class to utilize the PDO database connection. */
class MyRegister extends Base{
    public $firstName;
    public $lastName;
    public $gender;
    public $phone;
    public $email;
    public $pass;

    /** Creates a new user account by inserting user details into the database.
     * @param string $firstName User's first name.
     * @param string $lastName  User's last name.
     * @param string $gender    User's gender.
     * @param string $phone     User's phone number.
     * @param string $email     User's email address.
     * @param string $pass      User's password in plain text.
     * @return bool Returns true on successful insertion, false otherwise. */
    public function createRegister($firstName, $lastName, $gender, $phone, $email, $pass) {
        $passHash = password_hash($pass, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO user (firstName, lastName, gender, phone, email, pass) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$firstName, $lastName, $gender, $phone, $email, $passHash]);
    }
}
?>