<?php
session_start();
require_once("Base.php");

class ReservInfo extends Base {
    /**
     * Get detailed information about a specific reservation.
     * @param int $carId Car ID.
     * @return array|null Reservation details or null if not found.
     */
    public function getReservInfoUnik($carId) {
        try {
            $sql = "SELECT car.marke, reservation.date_reservation, reservation.date_retour
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
            error_log("Erro ao recuperar informações da reserva: " . $ex->getMessage());
            throw new Exception("Erro ao recuperar informações da reserva.");
        }
    }

    /**
     *Gets information about a user by ID.
     * @param int $idUser User ID.
     * @return array|null User data or null if not found.
     */
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
