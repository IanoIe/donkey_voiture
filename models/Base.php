<?php
require_once("./config/db.php");  

abstract class Base {

    protected $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=" . HOST . ";dbname=" . DB . ";charset=utf8", USER, PASS);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error of connection: " . $e->getMessage();
        }
    } 
}
?>
