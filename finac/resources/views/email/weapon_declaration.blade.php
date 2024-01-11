<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$subject}}</title>
</head>
<body>
@if (!$isDeclarationOfPossesion)
    <p>Merci d'avoir déclaré la perte de votre arme. Veuillez vous diriger vers le service du gouverneur le plus
        proche.</p>
@else
    <p>Merci d'avoir déclaré la possession de votre arme. Veuillez vous diriger vers le service du gouverneur le plus
        proche.</p>
@endif
</body>
</html>
