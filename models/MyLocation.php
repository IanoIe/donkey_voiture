<?php
require_once("./config/db.php"); 
require_once("Base.php");        

class MyLocation extends Base {

    // Search all available cities
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

