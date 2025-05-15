<?php
require_once("./config/db.php");
require_once("Base.php");

class MyReservation extends Base {
    public function getReservationsByUser($userId) {
        try {
            $sql = "SELECT u.firstName AS firstName, u.lastName AS lastName, c.fullname AS city,
                           car.marke AS marke_car, r.date_reservation, r.date_retour
                    FROM DonkeyVoiture.reservation r
                    JOIN DonkeyVoiture.user u ON r.user_id = u.id
                    JOIN DonkeyVoiture.car car ON r.car_id = car.id
                    JOIN DonkeyVoiture.city c ON car.city_id = c.id
                    WHERE u.id = :user_id";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['user_id' => $userId]);

            $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $reservations;
        } catch (PDOException $ex) {
            // Mostrar el mensaje de error
            echo 'Error: ' . $ex->getMessage();
            return [];
        }
    }
}
?>
