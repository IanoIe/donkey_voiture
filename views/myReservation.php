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
    <title>My Reservation</title>
</head>

<style>
    .table th {
        color:rgb(96, 178, 233);;
       }
</style>
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

    <main style="min-height: 125px;">
        <nav style="background-color: #73AD48; height: 100px;">
             <div>
                <h1 class="text-white text-center mt-4" id="donkey_titre">DONKEY VOITURE</h1>
            </div>
        </nav>
        <h2 class="mt-5" style="margin-left: 90px;">My Reservation</h2>
        <div class="table-responsive custom-table-wrapper">
            <table class="table table-bordered table-striped mx-auto mt-4" style="width: 80%;">
                <thead class="table">
                    <tr>
                        <th>City</th>
                        <th>Car</th>
                        <th>Reservation Date</th>
                        <th>Return Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($myReservations)): ?>
                        <?php foreach ($myReservations as $reservation): ?>
                            <tr>
                                <td><?= htmlspecialchars($reservation['city']) ?></td>
                                <td><?= htmlspecialchars($reservation['marke_car']) ?></td>
                                <td><?= htmlspecialchars($reservation['date_reservation']) ?></td>
                                <td><?= htmlspecialchars($reservation['date_retour']) ?></td>
                                <td>
                                    <a class="btn btn-primary btn-sm me-1" href="edit.php?id=<?= urlencode($reservation['id']) ?>">Edit</a>
                                    <a class="btn btn-warning btn-sm" href="cancel.php?id=<?= urlencode($reservation['id']) ?>">Cancel</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">No reservation found or query error.</td>
                            </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

    <footer style="background-color: #73AD48; height: 70px; position: fixed; left: 0; bottom: 0; width: 100%;"></footer>
</body>
</html>
