<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #73AD48">
    <h1 class="text-white text-center mt-5">DONKEY VOITURE</h1>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="mt-4"> 
                        <p class="text-black text-center">Formulaire d’inscription</p>
                    </div>
                    <div class="card-body">
                        <form id="registrationForm" action="" method="POST">

                            <div class="form-group">
                                <input type="text" class="form-control" name="firstName" placeholder="First Name" required />
                            </div><br>
                            <div class="form-group">
                                <input type="text" class="form-control" name="lastName" placeholder="Last Name" required />
                            </div><br>
                            <div class="form-group">
                                <input type="text" class="form-control" name="civilite" placeholder="Gender" required />
                            </div><br>
                            <div class="form-group">
                                <input type="number" class="form-control" name="phone" placeholder="Phone" required />
                            </div><br>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="E-mail" required />
                            </div><br>
                            <div class="form-group"> 
                                <input type="password" class="form-control" name="pass" placeholder="Password" required />
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" name="create" class="btn text-white border-0" style="background-color: #73AD48">Inscription</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>   
</body>
</html>
