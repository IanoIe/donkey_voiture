<?php
session_start();
require_once("./config/db.php");
require_once("Base.php");

class ReservInfo extends Base {

    /**
     * Obtém informações detalhadas de uma reserva específica.
     *
     * @param int $carId ID do carro.
     * @return array|null Dados da reserva ou null se não encontrado.
     */
    public function getReservInfoUnik($carId) {
        try {
            // Consulta SQL para obter marca do carro, data de reserva e data de retorno
            $sql = "SELECT car.marke, reservation.date_reservation, reservation.date_retour
                    FROM car
                    INNER JOIN reservation ON car.id = reservation.car_id
                    WHERE car.id = :car_id";

            // Preparando a consulta
            $stmt = $this->pdo->prepare($sql);
            // Vinculando o parâmetro :car_id
            $stmt->bindParam(':car_id', $carId, PDO::PARAM_INT);
            // Executando a consulta
            $stmt->execute();

            // Recuperando o resultado
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verificando se o resultado foi encontrado
            if ($result) {
                return $result;
            } else {
                return null; // Nenhuma reserva encontrada para o carro especificado
            }
        } catch (PDOException $ex) {
            // Registrando o erro no log
            error_log("Erro ao recuperar informações da reserva: " . $ex->getMessage());
            // Lançando uma exceção personalizada
            throw new Exception("Erro ao recuperar informações da reserva.");
        }
    }

    /**
     * Obtém informações de um usuário pelo ID.
     *
     * @param int $idUser ID do usuário.
     * @return array|null Dados do usuário ou null se não encontrado.
     */
    public function getUser($idUser) {
        try {
            // Consulta SQL para obter sobrenome, nome e telefone do usuário
            $sql = "SELECT lastName, firstName, phone FROM user WHERE id = :id";
            // Preparando a consulta
            $stmt = $this->pdo->prepare($sql);
            // Vinculando o parâmetro :id
            $stmt->bindParam(':id', $idUser, PDO::PARAM_INT);
            // Executando a consulta
            $stmt->execute();

            // Recuperando o resultado
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // Retornando os dados do usuário ou null se não encontrado
            return $result ?: null;
        } catch (Exception $ex) {
            // Registrando o erro no log
            error_log("Erro ao recuperar informações do usuário: " . $ex->getMessage());
            // Lançando uma exceção personalizada
            throw new Exception("Erro ao recuperar informações do usuário.");
        }
    }
}
?>
