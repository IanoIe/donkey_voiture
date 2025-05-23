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
    <title>Find A Car</title>

    <style>
    .form-group {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        max-width: 400px;
    }
    .form-group label {
        width: 130px;
        font-weight: bold;
    }
    .form-group select {
         width: 100%;
         padding: 5px;
    }
    .submit-btn {
        margin-top: 10px;
    }
    .btn {
        padding: 10px 50px;
        background-color: #73AD48;
        color: white;
        border: none;
        cursor: pointer;
        font-size: 16px;
    }
    .btn:hover {
        background-color: #5e913a;
    }
  </style>
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

        <div style="display: flex; justify-content: space-evenly;">
            <div style="margin-left: 50px;">
                <h2>Find a car </h2>

                <form method="POST" action="/listCars.php">
                    <div class="form-group">
                        <label for="city">City:</label>
                        <select name="fullname" id="fullname" required>
                            <option value="">Select a City</option>
                            <?php foreach ($cities as $city): ?>
                                <option value="<?= htmlspecialchars($city['id']) ?>"><?= htmlspecialchars($city['fullname']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date_reservation">Booking Date:</label>
                        <input type="date" id="date_reservation" name="date_reservation" required>
                    </div>

                    <div class="form-group">
                        <label for="date_retour">Return Date:</label>
                        <input type="date" id="date_retour" name="date_retour" required>
                    </div>

                    <div class="submit-btn">
                        <button type="submit" class="btn">Submit</button>
                    </div>
                </form>
            </div>

            <div class="img-car">
                <img style="border-radius: 30px;" src="../img/car.jpg" alt="Car of reservation" width="300" height="250">
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