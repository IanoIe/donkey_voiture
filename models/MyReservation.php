<?php
require_once("./config/db.php");
require_once("Base.php");

/** Class MyReservation
 * This class handles operations related to user reservations.
 * It extends the Base class to utilize the PDO database connection.*/
class MyReservation extends Base {
    /** Retrieves all reservations associated with a specific user.
     * This method executes a SQL query to fetch the user's first name, last name,
     * city name, car brand, reservation date, and return date from the 'reservation',
     * 'user', 'car', and 'city' tables where the user ID matches the provided parameter.
     * @param int $userId The ID of the user whose reservations are to be retrieved.
     * @return array An associative array containing the user's reservation details. Returns an empty array if no reservations are found or an error occurs.*/
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
            // Display the error message
            echo 'Error: ' . $ex->getMessage();
            return [];
        }
    }
}
?>
