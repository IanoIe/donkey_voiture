<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/style.css">
    <title>My Account</title>
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
            <h2 style="font-weight: bold;">My Account</h2>
            <div>
                <table>
                    <tbody>
                    <?php
                        if ($user) {
                           foreach ($user as $ligne) {
                                echo "<tr>
                                         <th scope='row'>First Name:</th>
                                         <td>{$ligne['firstName']}</td>
                                      </tr>
                                      <tr>
                                         <th scope='row'>Last Name:</th>
                                         <td>{$ligne['lastName']}</td>
                                      </tr>
                                      <tr>
                                         <th scope='row'>Email:</th>
                                         <td>
                                            <a href='mailto:{$ligne['email']}' style='color: blue; text-decoration: underline;'>
                                             {$ligne['email']} </a>
                                         </td>
                                       </tr>

                                      <tr>
                                         <th scope='row' style='padding-right: 20px;'>Phone Number:</th>
                                         <td>{$ligne['phone']}</td>
                                      </tr>";
                            }
                        } else {
                              die("Query invalid");
                        }
                    ?>
                    </tbody>
                </table>
            </div>
            <div style="display: inline-flex; gap: 10px; margin-top: 10px;">
                <button onclick="window.location.href='modifier.php'">Modifier</button>
                <button onclick="window.location.href='changer_mdp.php'">Changer de mot de passe</button>
                <button onclick="window.location.href='supprimer_compte.php'"> Supprimer mon compte</button>
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