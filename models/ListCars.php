<?php
require_once("./models/Base.php");

class ListCars extends Base {
    public function getCarsByCityName($city_id) {
        try {
            $sql = "SELECT city.fullname, car.marke
                    FROM car
                    INNER JOIN city ON car.city_id = city.id
                    WHERE city.id = :city_id";

            $stmt = $this->pdo->prepare($sql);
            // Corrigido para PDO::PARAM_INT
            $stmt->bindParam(':city_id', $city_id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            var_dump($stmt->fetchAll(PDO::FETCH_ASSOC));
        } catch (PDOException $ex) {
            echo "Erro na consulta: " . $ex->getMessage();
            return [];
        }
    }
}
?>


