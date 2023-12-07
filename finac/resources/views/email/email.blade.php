<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{asset('asset/images/logo_finac.png')}}">

    <title>FINAC</title>
    <style>
        /* Style pour le message */
        .message {
            margin-top: 20px;
            font-weight: bold;
            color: #333;
            font-family: 'Arial', sans-serif;
            align-content:  center;
            align-items: center;
            justify-content: center;
        }

        /* Style pour le login et le mot de passe */
        .credentials {
            font-size: 16px;
            margin-top: 20px;
            font-family: 'Arial', sans-serif;
        }

        /* Style pour le logo */
        .logo {
            max-width: 100px; /* Ajustez la largeur maximale selon vos besoins */
            height: auto;
        }
    </style>
</head>
<body>

<!-- Ajoutez cette balise img pour afficher le logo -->
<img src="{{env('APP_URL')}} + logo_finac/logo_finac.jpg" alt="Logo FINAC" class="logo">

<p class="message">Bienvenue sur FINAC ! Voici les informations de connexion pour votre armurerie :</p>

<div class="credentials">
    <p>Login : <strong>{{$login}}</strong></p>
    <p>Mot de passe : <strong>{{$password}}</strong></p>
</div>

<p class="message">Veuillez conserver ces informations en toute sécurité.</p>
</body>
</html>
