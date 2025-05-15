<?php
session_start();
if (!isset($_SESSION['user']['id'])) {
    header("Location: /MyLogin.php");
    exit;
}
// Check if the reservation data is available
if (!isset($_SESSION['car_id'], $_SESSION['marke'], $_SESSION['price'], $_SESSION['date_reservation'], $_SESSION['date_retour'])) {
    echo "Booking information not found.";
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
        <nav class="navbar navbar-expand-lg navbar-light bg-warning">
            <div class="container-fluid">
                <ul class="navbar-nav me-auto">
                    <?php if (isset($_SESSION['user'])): ?>
                        <li class="nav-item">
                            <a class="nav-link text-white">
                                Mr. <?php echo htmlspecialchars($_SESSION['user']['firstName'] . ' ' . $_SESSION['user']['lastName']); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
                <ul class="navbar-nav ms-5" style="width: 35%;">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/myAccountIndex.php">My Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/MyReservationIndex.php">My Reservations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/location.php">Find a Car</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
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
                            <p><?= htmlspecialchars($_SESSION['price']) ?> €/day</p>
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
                    <p>User information not available.</p>
                <?php endif; ?>
                <p><strong>Toral : <?= htmlspecialchars($_SESSION['price'])?>€</strong></p>
            </div>
        </div>

        <div class="container mt-25">
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
                <input type="hidden" name="id" value="<?= $_SESSION['user']['id'] ?>">
                <button type="submit" class="btn btn-warning mb-5">Réserver</button>
            </form>
        </div>

    </main>

    <footer style="background-color: #73AD48; 
                  height: 60px; 
                  position: fixed;
                  left: 0;
                  bottom: 0;
                  width: 100%;">
    </footer>
    
</body>
</html>