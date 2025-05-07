<?php
     require_once("./config/db.php");
     require_once("Base.php");
class MyReservation extends Base {
    public function getReservationsByUser() {
        try {
            $sql = "SELECT city.fullname, car.marke, reservation.date_reservation, reservation.date_retour
                    FROM city
                    INNER JOIN car ON city.id = car.city_id
                    INNER JOIN reservation ON reservation.car_id = car.id
                    WHERE reservation.user_id = :user_id";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            throw new Exception("Error : " . $ex->getMessage());
        }
    }   
}
?>
