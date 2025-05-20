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
    <section style="background-color: #73AD48; height: 200px; width:100%;">
        <h1 class="text-white text-center mt-5">DONKEY VOITURE</h1>
    </section>

    <div class="container vh-80 d-flex justify-content-center align-items-center">
        <div class="mx-auto" style="width: 350px;">
            <form method="POST" action="/myAccountIndex.php?action=changePassword" class="border rounded p-4 shadow bg-white">
                <?php if (!empty($message)): ?>
                <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
                <?php endif; ?>

                <h4 class="text-center mb-4">Change Password</h4>

                <div class="form-group mb-3">
                    <label for="current_password">Current Password:</label>
                    <input type="password" name="current_password" id="current_password" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label for="new_password">New Password:</label>
                    <input type="password" name="new_password" id="new_password" class="form-control" required>
                </div>

                <div class="form-group mb-4">
                    <label for="confirm_password">Confirm New Password:</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn text-white w-100" style="background-color: #73AD48" name="change_password">Change Password </button>
                </div>
            </form>
        </div>
    </div>
 
    
</body>
</html>