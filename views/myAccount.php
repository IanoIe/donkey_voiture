<?php
session_start();
if (!isset($_SESSION['user']['id'])) {
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
    <title>My Account</title>
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
            <h2 style="font-weight: bold;">My Account</h2>
            <div>
                <table>
                    <tbody>
                        <?php if ($user): ?>
                            <p><strong>Last Name :</strong> <?= htmlspecialchars($user['lastName']) ?></p>
                            <p><strong>First Name :</strong> <?= htmlspecialchars($user['firstName']) ?></p>
                            <p><strong>Email :</strong> <a href="mailto:<?= htmlspecialchars($user['email']) ?>" style="color: #0000FF; text-decoration: underline;"><?= htmlspecialchars($user['email']) ?></a></p>
                            <p><strong>Phone Number :</strong> <?= htmlspecialchars($user['phone']) ?></p>
                            <?php else: ?>
                                <p>User information not available.</p>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="d-flex gap-2 mt-3">
                <a href="modifier.php" class="btn btn-primary">Edit</a>
                <a href="changer_mdp.php" class="btn btn-warning">Change password</a>
                <a href="supprimer_compte.php" class="btn btn-danger">Delete my account</a>
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