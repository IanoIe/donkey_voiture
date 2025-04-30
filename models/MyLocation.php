<?php
    require_once("./config/db.php");
    require_once("Base.php");

   class MyLocation extends Base {
        public $fullname;
        public $date_reservation;
        public $date_retour;

        public function __construct($pdo) {
            $this->pdo = $pdo;
        }

        public function getMyLocation() {
            $stmt = $this->pdo->query("SELECT city.fullname, reservation.date_reservation, reservation.date_retour
                                       FROM city INNER JOIN car ON city.id = car.city_id
                                       INNER JOIN reservation ON reservation.car_id = car.id;");
        }
   }
?>
