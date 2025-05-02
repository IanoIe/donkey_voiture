<?php

require_once("./config/db.php");
require_once("Base.php");

class MyLocation extends Base  {
    private $city;
    private $date_reservation;
    private $date_retour;

    public function __construct($city, $date_reservation, $date_retour) {
        $this->city = $city;
        $this->date_reservation = $date_reservation;
        $this->date_retour = $date_retour;

    }

    public function validateFields() {
        if (empty($this->city) || empty($this->date_reservation) || empty($this->date_retour)) {
            return false;
        }
        return true;
    }

    public function getMyLocation() {
        try {
            $sql = "SELECT city.fullname AS city, reservation.date_reservation, reservation.date_retour
                    FROM city
                    INNER JOIN car ON city.id = car.city_id
                    INNER JOIN reservation ON reservation.car_id = car.id
                    WHERE city.fullname = :city AND reservation.date_reservation = :date_reservation AND reservation.date_retour = :date_retour";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':city', $this->city);
            $stmt->bindParam(':date_reservation', $this->date_reservation);
            $stmt->bindParam(':date_retour', $this->date_retour);
            $stmt->execute();

            // Return results
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo "Error : " . $ex->getMessage();
            return [];
        }
    }

    // Getters
    public function getCity() {
        return $this->city;
    }

    public function getDateReservation() {
        return $this->date_reservation;
    }

    public function getDateRetour() {
        return $this->date_retour;
    }
}
?>
