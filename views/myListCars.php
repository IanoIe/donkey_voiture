<?php
// Start the session to access session variables
session_start();
// Check if the user is logged in by verifying the 'id' in the session
if (!isset($_SESSION['user']['id'])) {
    // If not logged in, redirect to the login page
    header("Location: /MyLogin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css">
    <title>My List Cars</title>
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

        <div>
            <h3 style="transform: translateX(15%);">City: <?php echo $_SESSION['fullname'] ?> </h3>
        </div>

        <div class="container-fluid mt-4 min-vh-100">
           <div class="row" style="max-width: 1300px; margin: 0 auto;">
                <?php foreach ($cars as $car): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body border border-3">
                                <form method="POST" action="/reservInfoIndex.php">
                                    <h5 class="card-title"><?= htmlspecialchars($car['marke']) ?></h5>
                                    <p class="card-text">
                                        <strong>Date of Reservation:</strong> <?= $_SESSION['date_reservation']; ?>
                                    </p>
                                    <p class="card-text">
                                        <strong>Date of Retour:</strong> <?= $_SESSION['date_retour']; ?>
                                    </p>
                                    <!-- Send div information to next page -->
                                    <input type="hidden" name="car_id" value="<?= $car['car_id'] ?>">
                                    <input type="hidden" name="marke" value="<?= $car['marke'] ?>">
                                    <input type="hidden" name="price" value="<?= htmlspecialchars($car['price']) ?>"> 
                                    <input type="hidden" name="date_reservation" value="<?= $_SESSION['date_reservation'] ?>">
                                    <input type="hidden" name="date_retour" value="<?= $_SESSION['date_retour'] ?>">
                                    <button type="submit" class="btn btn-warning float-end">Réserver</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
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
