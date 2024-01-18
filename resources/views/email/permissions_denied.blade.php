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
        }

        /* Style pour le motif de refus */
        .motif-refus {
            margin-top: 20px;
            font-size: 16px;
            color: #FF0000;
            font-family: 'Arial', sans-serif;
        }
    </style>
</head>
<body>
<p class="message">Votre demande de port d'armes sur FINAC a malheureusement été refusée.</p>
<p class="message">Pour le(s) motif(s) suivant(s).</p>

<div class="motif-refus">
    <p><strong>{{$motifRefus}}</strong></p>
</div>

<p class="message">Si vous avez des questions ou des préoccupations, veuillez vous rendre dans un services approprie pour plus de details et d'eclaircissement </p>
</body>
</html>
