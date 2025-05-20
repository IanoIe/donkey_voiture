<?php
require_once("./config/db.php");  

/** Abstract Base class to establish a PDO database connection.
  * Other classes can extend this class to inherit the $pdo property for database operations.*/
abstract class Base {

    protected $pdo;

    /** Constructor method that initializes the PDO connection.
     * It attempts to connect to the MySQL database using the provided credentials.
     * If the connection fails, it catches the PDOException and displays an error message. */
    public function __construct() {
        try {
            // Create a new PDO instance with the specified host, database name, charset, username, and password
            $this->pdo = new PDO("mysql:host=" . HOST . ";dbname=" . DB . ";charset=utf8", USER, PASS);
            // Set the PDO error mode to exception to enable exception handling for database errors
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error of connection: " . $e->getMessage();
        }
    } 
}
?>
