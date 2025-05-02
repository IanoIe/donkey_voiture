<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/style.css">
    <title>My Reservation</title>
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
                        <a class="nav-link text-white" href="#">Mon compte</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Mes réservations</a>
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
            <h2 class="mb-4">My Reservation</h2>
            <div class="table-responsive custom-table-wrapper">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th>City</th>
                            <th>Car</th>
                            <th>Reservation date</th>
                            <th>Return date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($reservations && count($reservations) > 0) {
                            foreach ($reservations as $ligne) {
                                echo "<tr>
                                         <td>{$ligne['fullname']}</td>
                                         <td>{$ligne['marke']}</td>
                                         <td>{$ligne['date_reservation']}</td>
                                         <td>{$ligne['date_retour']}</td>
                                         <td>
                                            <a class='btn btn-primary btn-sm me-1' href='edit.php?id={$ligne['id']}'>Edit</a>
                                            <a class='btn btn-warning btn-sm' href='cancel.php?id={$ligne['id']}'>Cancel</a>
                                         </td>
                                     </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center'>No reservation found or query error.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
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