<?php
session_start();
require_once("Base.php");

/** Class ReservInfo
 * Handles retrieval of reservation and user information from the database. */
class ReservInfo extends Base {
     /** Retrieves detailed information about a specific reservation based on the car ID.
     * @param int $carId The ID of the car associated with the reservation.
     * @return array|null An associative array containing reservation details, or null if not found.
     * @throws Exception If a database error occurs during retrieval. */
    public function getReservInfoUnik($carId) {
        try {
            $sql = "SELECT car.marke, reservation.price, reservation.date_reservation, reservation.date_retour
                    FROM car
                    INNER JOIN reservation ON car.id = reservation.car_id
                    WHERE car.id = :car_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':car_id', $carId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return $result;
            } else {
                return null;
            }
        } catch (PDOException $ex) {
            error_log("Error retrieving booking information: " . $ex->getMessage());
            throw new Exception("Error retrieving booking information.");
        }
    }

    /** Retrieves user information based on the user ID.
     * @param int $idUser The ID of the user.
     * @return array|null An associative array containing user details, or null if not found. */
    public function getUser($idUser) {
        try {
            $sql = "SELECT id, lastName, firstName, phone FROM user WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $idUser, PDO::PARAM_INT);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ?: null;
        } catch (Exception $ex) {
            error_log("Error retrieving user information:" . $ex->getMessage());
            return null;
        }
    }
}
?>
