<?php
require_once("./config/db.php"); 
require_once("Base.php");        

class MyLocation extends Base {
    /** Retrieves all cities from the database.
    * This method executes a SELECT query to fetch all records from the 'city' table.
    * It returns an associative array containing the details of each city.
    * @return array An associative array of cities, where each element represents a city.
    * @throws PDOException If an error occurs during the database query execution. */
    public function getMyLocationCity() {
        try {
            $sql = "SELECT * FROM city";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
        }
    }
    
    /** Retrieves a city by its ID.
    * This method executes a SELECT query to fetch a single record from the 'city' table
    * based on the provided city ID. It returns an associative array containing the city's details.
    * @param int $id The ID of the city to retrieve.
    * @return array|null An associative array containing the city's details, or null if no city is found.
    * @throws PDOException If an error occurs during the database query execution. */
    public function getCityById($id) {
        try {
            $sql = "SELECT * FROM city WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo "Error: ".$ex->getMessage();
        }
    }
}
?>

