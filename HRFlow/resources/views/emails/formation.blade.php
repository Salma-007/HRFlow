<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formation Assignée</title>
</head>
<body>
    <p>Bonjour {{ $user->name }},</p>
    <p>Nous avons le plaisir de vous informer que vous avez été assigné à la formation suivante :</p>
    <h3>{{ $formation->name }}</h3> 
    <p>Merci de prendre connaissance des détails et de vous préparer à suivre cette formation.</p>
    <p>Cordialement,</p>
    <p>HRFlow</p>
</body>
</html>
