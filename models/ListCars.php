<?php
require_once("./config/db.php");
require_once("./models/Base.php");

class ListCars extends Base {
    public function getCarsByCityName($city_id) {
        try {
            $sql = "SELECT city.fullname, car.id AS car_id, car.marke FROM car
                    INNER JOIN city ON car.city_id = city.id
                    LEFT JOIN reservation r ON car.id = r.car_id
                    AND STR_TO_DATE(r.date_reservation, '%Y-%m-%d') <= CURDATE()
                    AND (r.date_retour IS NULL OR r.date_retour >= CURDATE())
                    WHERE city.id = :city_id
                    AND r.id IS NULL";
                    
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':city_id', $city_id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            throw new Exception("Erro ao buscar carros: " . $ex->getMessage());
        }
    }
}
?>