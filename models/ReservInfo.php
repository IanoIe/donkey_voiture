<?php
session_start();
require_once("Base.php");

/** Class ReservInfo
 * Handles retrieval of reservation and user information from the database. */
class ReservInfo extends Base {
     /** Retrieves detailed reservation information for a specific car.
      * This method fetches the car's brand, reservation price, reservation date,
      * and return date by joining the `car` and `reservation` tables based on the
      * provided car ID.
      * @param int $carId The ID of the car associated with the reservation.
      * @return array|null An associative array containing the reservation details (`marke`, `price`, `date_reservation`,
      * `date_retour`) if found, or null if no reservation exists for the given car ID.
      *
      * @throws Exception If a database error occurs during the retrieval process.  */
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


    /** Inserts a new reservation into the database.
     * This method first checks if a car with the specified brand, price, and city exists.
     * If the car exists, it uses the existing car ID; otherwise, it inserts a new car record
     * and uses the newly generated car ID. Then, it creates a reservation record associated
     * with the car and user.
     * @param string $marke The brand of the car.
     * @param float $price The price of the car.
     * @param string $date_reservation The reservation date.
     * @param string $date_retour The return date.
     * @param int $user_id The ID of the user making the reservation.
     * @param int $city_id The ID of the city where the car is located.
     * @return bool Returns true if the reservation was successfully inserted; false otherwise.
     * @throws Exception If a database error occurs during the insertion process. */
    public function insertReservationToDatabase($marke, $price, $date_reservation, $date_retour, $user_id, $city_id) {
        try {
            $this->pdo->beginTransaction();
            // Check if the car already exists
            $sqlCheckCar = "SELECT id FROM car WHERE marke = :marke AND price = :price AND city_id = :city_id LIMIT 1";
            $stmtCheckCar = $this->pdo->prepare($sqlCheckCar);
            $stmtCheckCar->execute([':marke' => $marke, ':price' => $price, ':city_id' => $city_id]);
            $existingCar = $stmtCheckCar->fetch(PDO::FETCH_ASSOC);
            if ($existingCar) {
                $car_id = $existingCar['id'];
            } else {
                $sqlInsertCar = "INSERT INTO car (marke, price, city_id) VALUES (:marke, :price, :city_id)";
                $stmtInsertCar = $this->pdo->prepare($sqlInsertCar);
                $stmtInsertCar->execute([':marke' => $marke,':price' => $price,':city_id' => $city_id]);
                $car_id = $this->pdo->lastInsertId();
            }
            // Check if the car already exists
            $sqlInsertReservation = "INSERT INTO reservation (car_id, date_reservation, date_retour, user_id)
                                     VALUES (:car_id, :date_reservation, :date_retour, :user_id)";
            $stmtInsertReservation = $this->pdo->prepare($sqlInsertReservation);
            $stmtInsertReservation->execute([':car_id' => $car_id, ':date_reservation' => $date_reservation,':date_retour' => $date_retour, ':user_id' => $user_id]);
            $this->pdo->commit();
            return true;

        } catch (PDOException $e) {
            $this->pdo->rollBack();
            error_log("Error inserting reservation:" . $e->getMessage());
            return false;
        }
    }

    /** Inserts a reservation into the database for an existing car.
     * This method associates an existing car, identified by its ID, with a reservation.
     * It inserts the reservation details into the `reservation` table, linking it to the
     * specified car and user.
     * @param int $car_id The ID of the car to be reserved.
     * @param string $date_reservation The date when the reservation is made.
     * @param string $date_retour The date when the car is to be returned.
     * @param int $user_id The ID of the user making the reservation.
     * @return bool Returns true if the reservation was successfully inserted; false otherwise.
     * @throws Exception If a database error occurs during the insertion process.  */
    public function insertReservationWithCarId($car_id, $date_reservation, $date_retour, $user_id) {
        try {
            $sql = "INSERT INTO reservation (car_id, date_reservation, date_retour, user_id)
                    VALUES (:car_id, :date_reservation, :date_retour, :user_id)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':car_id' => $car_id, ':date_reservation' => $date_reservation, ':date_retour' => $date_retour, ':user_id' => $user_id]);
            return true;
        } catch (PDOException $e) {
            error_log("Error inserting reservation: " . $e->getMessage());
            return false;
        }
    }
}
?>
