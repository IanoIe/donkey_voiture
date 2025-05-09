<?php
     session_start();  
     if (isset($_SESSION['car'], $_SESSION['date_reservation'], $_SESSION['date_retour'], $_SESSION['firstName'], $_SESSION['lastName'], $_SESSION['phoneNumber'])):

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
        
        <div class="container mt-5 w-10">
            <div class="row g-5">
            <?php
            // views/reservInfo.php

            // Verifica se as variáveis de sessão estão definidas
            if (isset($_SESSION['car'], $_SESSION['date_reservation'], $_SESSION['date_retour'])):
            ?>
            <div class="col-md-4">
                <div class="card border-primary mb-3">
                    <div class="card-body">
                        <h3 class="text-left"><?= htmlspecialchars($_SESSION['car']) ?></h3>
                        <p><strong>Data da Reserva:</strong> <?= htmlspecialchars($_SESSION['date_reservation']) ?></p>
                        <p><strong>Data de Retorno:</strong> <?= htmlspecialchars($_SESSION['date_retour']) ?></p>
                    </div>
                </div>
            </div>
<?php
else:
    echo '<p class="alert alert-warning">Nenhuma informação de reserva encontrada.</p>';
endif;
?>


                <div class="col-md-4">
                    <div class="mb-3">
                        <h3 class="text-left">Info</h3>
                        <p>First Name: <?= htmlspecialchars($_SESSION['firstName']) ?></p>
                        <p>Last Name: <?= htmlspecialchars($_SESSION['lastName']) ?></p>
                        <p>Phone Number: <?= htmlspecialchars($_SESSION['phoneNumber']) ?></p>
                    </div>
                </div>
                
                <?php
                
else:
    echo '<p>Informações de reserva não disponíveis.</p>';
endif;
?>
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

        <div style="width: 150px;">
            <button type="submit" class="btn btn-warning float-right">Réserver</button>
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