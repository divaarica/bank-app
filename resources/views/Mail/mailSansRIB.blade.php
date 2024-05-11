<!DOCTYPE html>
<html>

<head>
    <title>Inscription</title>
</head>

<body>
    <h1>Bonjour {{ $userData['prenom'] }} {{ $userData['nom'] }},</h1>
    <h1>Votre inscription a été effectuée avec succès.</h1>
    <h1>Voici vos informations :</h1>
    <ul>
        <p>Nom: {{ $userData['nom'] }}</p>
        <p>Prenom: {{ $userData['prenom'] }}</p>
        <p>Adresse: {{ $userData['adresse'] }}</p>
        <p>Téléphone: {{ $userData['tel'] }}</p>
        <p>Email: {{ $userData['email'] }}</p>
        <p>mot de passe: {{ $userData['pass'] }}</p>

        <br>
        

        <h1>NB: Lors de votre premiere connexion, vous devrez changer votre mot de passe !!</h1>
        <br>
        <br>


    </ul>

    <h4>Pour plus d'informations veuillez nous envoyer un mail a l'adresse suivante ricamouele@groupeisi.com</h4>
    <p>Bonne reception!</p>
</body>

</html>