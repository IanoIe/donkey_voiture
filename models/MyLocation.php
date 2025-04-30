<?php
    require_once("./config/db.php");
    require_once("Base.php");
    
    class MyLocation extends Base {
        public function getMyLocation() {
            $sql = "SELECT city.fullname AS city, reservation.date_reservation, reservation.date_retour
                    FROM city 
                    INNER JOIN car ON city.id = car.city_id
                    INNER JOIN reservation ON reservation.car_id = car.id";
    
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
    
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    ?>
    
?>
