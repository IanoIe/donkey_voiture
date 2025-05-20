<?php
require_once("./config/db.php");
require_once("./models/Base.php");

class ListCars extends Base {
    /**
    * Retrieves available cars in a specified city that are not reserved on the current date.
    * This function accepts a city ID and a reservation date in the 'd/m/Y' format. It returns a list of cars
    * available in the specified city that are not reserved on the current date, including the car's ID, make,
    * and price.
    *
    * @param int $city_id The ID of the city to search for available cars.
    * @param string $date_reservation The reservation date in 'd/m/Y' format.
    * @return array|null Returns an associative array of available cars with keys 'fullname', 'car_id', 'marke' and 'price', or null if no cars are available or an error occurs.
    * @throws Exception If a database error occurs during the query execution.*/
    public function getCarsByCityName($city_id, $date_reservation) {
        try {
            // Convert booking date to Y-m-d format
            $date_reservation = DateTime::createFromFormat('d/m/Y', $date_reservation)->format('Y-m-d');
            $sql = "SELECT city.fullname, car.id AS car_id, car.marke, car.price FROM car 
                    INNER JOIN city ON car.city_id = city.id
                    LEFT JOIN reservation r ON car.id = r.car_id 
                    AND STR_TO_DATE(r.date_reservation, '%Y-%m-%d') <= CURDATE()
                    AND (r.date_retour IS NULL OR r.date_retour >= CURDATE())
                    WHERE city.id = :city_id AND r.id IS NULL"; // Cars not reserved until the current date
            // Prepare the query
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':city_id', $city_id, PDO::PARAM_INT); // Bind the city id
            $stmt->execute();
            // Return the results
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            throw new Exception("Error searching for cars: " . $ex->getMessage());
        }
    }
    /** 
    * Validates if the return date is after the reservation date.
    * This function accepts two dates in the 'd/m/Y' format and checks if the return date
    * occurs after the reservation date. If not, it returns an city null.
    * @param string $date_reservation The reservation date in 'd/m/Y' format.
    * @param string $date_retour The return date in 'd/m/Y' format.
    * @return string|null Returns an error message if the return date is invalid,  or null if the dates are valid.  */
    public function validateDates($date_reservation, $date_retour) {
        // Convert dates to Y-m-d format
        $data_reservation = DateTime::createFromFormat('d/m/Y', $date_reservation)->format('Y-m-d');
        $data_retour = DateTime::createFromFormat('d/m/Y', $date_retour)->format('Y-m-d');
        if ($data_retour <= $data_reservation) {
            return 'The return date must be after the reservation date.';
        }
        return null;
    }
}
?>
