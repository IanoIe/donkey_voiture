<?php
session_start();
$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <title>Change Password</title>
</head>
<body class="bg-light">
     <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-warning">
            <div class="container-fluid">
                <ul class="navbar-nav me-auto">
                    <?php if (isset($_SESSION['user'])): ?>
                        <li class="nav-item">
                            <a class="nav-link text-white">
                                Mr. <?= htmlspecialchars($_SESSION['user']['firstName'] . ' ' . $_SESSION['user']['lastName']) ?>
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
    <section style="background-color: #73AD48; height: 140px; width:100%;">
        <h1 class="text-white text-center" style="padding-top: 40px;">DONKEY VOITURE</h1>
    </section>

    <div class="container vh-80 d-flex justify-content-center align-items-center">
        <div class="mx-auto" style="width: 350px;">
            <form method="POST" action="/myAccountIndex.php?action=changePassword" class="border rounded p-4 shadow bg-white">
                <?php if (!empty($message)): ?>
                <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
                <?php endif; ?>

                <h4 class="text-center mb-4">Change Password</h4>

                <div class="form-group mb-3">
                    <label for="current_password"><strong> Password: </strong></label>
                    <input type="password" name="current_password" id="current_password" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label for="new_password"><strong> Password:</strong></label>
                    <input type="password" name="new_password" id="new_password" class="form-control" required>
                </div>

                <div class="form-group mb-4">
                    <label for="confirm_password"><strong> New Password:</strong></label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn text-white w-100" style="background-color: #73AD48" name="change_password"><strong> Password </strong></button>
                </div>
            </form>
        </div>
    </div>

    <footer style="background-color: #73AD48; height: 70px; position: fixed; left: 0; bottom: 0; width: 100%;"></footer>
</body>
</html>