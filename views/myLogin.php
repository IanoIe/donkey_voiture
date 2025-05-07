<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Connexion</title>
</head>
<body style="background-color: #73AD48;">
<h1 class="text-white text-center mt-5">DONKEY VOITURE</h1>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="mt-4 text-center">
                        
                    </div>
                    <div class="card-body">
                        <form method="POST" action="">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Votre e-mail" required>
                            </div><br>
                            <div class="form-group">
                                <input type="password" name="pass" class="form-control" placeholder="Votre mot de passe" required>
                            </div><br>
                            <div class="text-center">
                                <button type="submit" class="btn text-white" style="background-color: #73AD48;">Connexion</button>
                            </div>
                        </form>
                        <div class="text-center mt-3">
                            <span>Vous n’avez pas de compte ?</span>
                            <a href="/register.php" style="color: blue; text-decoration: underline;">Inscrivez-vous !</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
