<?php
require_once("./config/db.php");
require_once("Base.php");

class MyLocation extends Base {

    public function getMyLocationCity() {
        try {
            $sql = "SELECT * FROM city";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo "Error : " . $ex->getMessage();

        }
    }
   
    /**
    public function getMyLocationReservation() {
        try {
            $sql = "SELECT date_reservation, date_retour FROM reservation";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo "Error: " . $ex->getMessage();
            return [];
        }
    }
         */
}
?>

