<?php
session_start();
// Verifica se os dados da reserva estão disponíveis
if (!isset($_SESSION['car_id'], $_SESSION['marke'], $_SESSION['date_reservation'], $_SESSION['date_retour'])) {
    echo "Informações da reserva não encontradas.";
    exit;
}
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="../assets/style.css">
    <title>Reservation $ Infor User</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-warning margin:">
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Mr Dupont Durant</a>
                    </li>
                </ul>
                <ul class="navbar-nav text-white">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="myAccount.php">Mon compte</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="myReservation.php">Mes réservations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Trouver une voiture</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" style="background-color: #5b9bd5; margin-right: 20px;" href="/controllers/AuthController.php?logout=true">Déconnexion</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main style="background-color: #73AD48; height: 125px;">
        <div>
            <h1 class="text-white text-center mt-5" id="donkey_titre">DONKEY VOITURE</h1>
        </div>
        
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <p><strong><?= htmlspecialchars($_SESSION['marke']) ?></strong></p>
                            <p>Date of Reservation: <?= htmlspecialchars($_SESSION['date_reservation']) ?></p>
                            <p>Date of Retour: <?= htmlspecialchars($_SESSION['date_retour']) ?></p>
                        </div>
                    </div>
                </div>

            <div class="col-md-4 mb-4">
                <?php if ($user): ?>
                    <h2>Info</h2>
                    <p><strong>Last Name:</strong> <?= htmlspecialchars($user['lastName']) ?></p>
                    <p><strong>First Name:</strong> <?= htmlspecialchars($user['firstName']) ?></p>
                    <p><strong>Phone Number:</strong> <?= htmlspecialchars($user['phone']) ?></p>
                <?php else: ?>
                    <p>Informações do usuário não disponíveis.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="container mt-5">
            <div class="column">
                <input type="checkbox" id="scales" name="scales"/>
                <label for="lavage">Lavage : 15€</label>
            </div>
            <div class="column">
                <input type="checkbox" id="horns" name="horns" />
                <label for="assurance">Assurance : 45€ / jour</label>
            </div>
            <div class="column">
                <input type="checkbox" id="horns" name="horns" />
                <label for="chauffeur">Chauffeur : 20€ / jour</label>
            </div>   
        </div><br>

        <div style="display: flex; justify-content: flex-end; width: 90%;">
            <form method="POST" action="/reservInfo.php">
                <input type="hidden" name="car_id" value="<?= $_SESSION['car_id'] ?>">
                <button type="submit" class="btn btn-warning">Réserver</button>
            </form>
        </div>

    </main>

    <footer style="background-color: #73AD48; 
                  height: 70px; 
                  position: fixed;
                  left: 0;
                  bottom: 0;
                  width: 100%;">
    </footer>
    
</body>
</html>