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
<body style="height: 750px;">
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

    <main style="height: 50%;">
        <div style="background-color: #73AD48; padding: 1rem 0; height: 100px;">
            <h1 class="text-white text-center mt-1" id="donkey_titre">DONKEY VOITURE</h1>
        </div>

        <div class="container mt-4 bg-white p-4 rounded shadow w-25 mx-auto" style="height: 400px;">
            <h2 style="font-weight: bold;">Edit My Account</h2>
            <?php if (isset($error) && !empty($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST" action="/myAccountIndex.php?action=editMyAccount">
                <div class="mb-3">
                    <label for="lastName" class="form-label"><strong> Last Name </strong></label>
                    <input type="text" class="form-control" id="lastName" name="lastName" value="<?= htmlspecialchars($user['lastName'] ?? '') ?>" required>
                </div>
                <div class="mb-3">
                    <label for="firstName" class="form-label"><strong> First Name </strong></label>
                    <input type="text" class="form-control" id="firstName" name="firstName" value="<?= htmlspecialchars($user['firstName'] ?? '') ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label"><strong> Email </strong></label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label"><strong> Phone Number </strong></label>
                    <input type="text" class="form-control" id="phone" name="phone" value="<?= htmlspecialchars($user['phone'] ?? '') ?>">
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary"><strong> Update </strong></button>
                </div>
            </form>
        </div>
    </main>

    <footer style="background-color: #73AD48; height: 70px; position: fixed; left: 0; bottom: 0; width: 100%;"></footer>
</body>
</html>
