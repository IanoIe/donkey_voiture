<?php
require_once("./config/db.php");
require_once("Base.php");

     class ReservInfo extends Base {
        public function getReservInfoUnik($carId) {
            try {
                $sql = "SELECT c.id AS car_id, c.marke, c.model, r.date_reservation, r.date_retour,
                        o.lavagePrix, o.assurancePrix, o.chauffeurPrix 
                        FROM DonkeyVoiture.car c
                        JOIN DonkeyVoiture.reservation r ON c.id = r.car_id
                        LEFT JOIN DonkeyVoiture.options o ON c.id = o.car_id
                        WHERE c.id = :car_id";
    
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':car_id', $carId, PDO::PARAM_INT);
                $stmt->execute();
    
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($result) {
                    return $result;
                } else {
                    return null; // Or throw a custom exception
                }
            } catch (PDOException $ex) {
                // Log the error
                error_log("Error retrieving booking information: " . $ex->getMessage());
                // Throw a custom exception
                throw new Exception("Error retrieving booking information.");
            }
        }

        public function getUser($idUser) {
            try {
                $sql = "SELECT lastName, firstName, phone FROM user WHERE id = :id";
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':id', $idUser, PDO::PARAM_INT);
                $stmt->execute();

                 $result = $stmt->fetch(PDO::FETCH_ASSOC);
                 return $result ?: null;
            } catch (Exception $ex) {
                error_log("Erro ao recuperar usuário: " . $ex->getMessage());
                throw new Exception("Erro ao recuperar informações do usuário.");
            }
        }
    }   
?>