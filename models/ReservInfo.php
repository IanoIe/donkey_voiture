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
                    return null; // ou lançar uma exceção personalizada
                }
            } catch (PDOException $ex) {
                // Logar o erro
                error_log("Erro ao recuperar informações de reserva: " . $ex->getMessage());
                // Lançar uma exceção personalizada
                throw new Exception("Erro ao recuperar informações de reserva.");
            }
        }
    }
    
?>