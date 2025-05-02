<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
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

        <div style="margin-left: 50px;">
            <h2>Find a car </h2>

            <form method="POST" action="index.php">
                <div class="form-group">
                    <label for="city">City:</label>
                    <select name="city" id="city">
                        <option value="">Select a City</option>
                        <?php
                        if (isset($cities) && !empty($cities)) {
                            foreach ($cities as $city) {
                                 echo "<option value='" . htmlspecialchars($city['id']) . "'>" . htmlspecialchars($city['fullname']) . "</option>";
                            }
                        }
                    ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="date_reservation">Booking Date:</label>
                    <select name="date_reservation" id="date_reservation">
                        <option value="">Select a Date</option>
                        <?php
                        if (isset($reservations) && !empty($reservations)) {
                            foreach ($reservations as $reservation) {
                                echo "<option value='" . htmlspecialchars($reservation['date_reservation']) . "'>" . htmlspecialchars($reservation['date_reservation']) . "</option>";
                            }
                        }
                    ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="date_retour">Return Date:</label>
                    <select name="date_retour" id="date_retour">
                        <option value="">Select a Date</option>
                        <?php
                        if (isset($date_retours) && !empty($date_retours)) {
                            foreach ($date_retours as $date_retour) {
                                echo "<option value='" . htmlspecialchars($date_retour['date_retour']) . "'>" . htmlspecialchars($date_retour['date_retour']) . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

               <div class="submit-btn">
                    <button type="submit" class="btn">Submit</button>
                </div>
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