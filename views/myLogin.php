<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
</head>
<body style="background-color: #73AD48;">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="mt-4 text-center">
                        <h3>Connexion</h3>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($error)) : ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                        <?php endif; ?>

                        <form method="POST" action="../index.php">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Votre e-mail" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="pass" class="form-control" placeholder="Votre mot de passe" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn text-white" style="background-color: #73AD48;">Connexion</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
