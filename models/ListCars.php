<?php
require_once("./config/db.php");
require_once("./models/Base.php");

class ListCars extends Base {
    public function getCarsByCityName($city_id) {
        try {
            $sql = "SELECT city.fullname, car.marke FROM car INNER JOIN city ON car.city_id = city.id WHERE city.id = :city_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':city_id', $city_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            throw new Exception("Erro ao buscar carros: " . $ex->getMessage());
        }
    }

    public function getReservationsByCar($car_id) {
        try {
            $sql = "SELECT date_reservation, date_retour
                    FROM reservation
                    WHERE car_id = :car_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':car_id', $car_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }  

    // Function que vai permitir pegar os dados na pagina anterior para pagina seguinte 
    public function showCarsByCity($city_id) {
        try {
            $cars = $this->getCarsByCityName($city_id);
            include __DIR__ . "/../views/myListCars.php";
        }catch (Exception $ex) {
            echo ("Error: ". $ex->getMessage());
        }
    }

    public function reservationCar($car_id) {
        try {
            $reservations = $this->getReservationsByCar($car_id);
        } catch (Exception $ex) {
            echo ("Error: ".$ex->getMessage());
        }
    }
}
?>


