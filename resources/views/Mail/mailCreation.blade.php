<!DOCTYPE html>
<html>

<head>
    <title>Inscription</title>
</head>

<body>
    <h2>Bonjour {{ $userData['prenom'] }} {{ $userData['nom'] }},</h2>
    <h2>Votre inscription a été effectuée avec succès.</h2>
    <h2>Voici vos informations :</h2>
    <ul>
        <p>Nom: {{ $userData['nom'] }}</p>
        <p>Prenom: {{ $userData['prenom'] }}</p>
        <p>Adresse: {{ $userData['adresse'] }}</p>
        <p>Téléphone: {{ $userData['tel'] }}</p>
        <p>Email: {{ $userData['email'] }}</p>
        <p>mot de passe: {{ $userData['pass'] }}</p>

        <p>Ci-joint , votre RIB en format PDF</p>

        <h2 class="text-danger">Lors de votre premiere connexion, vous devrez changer votre mot de passe !!</h2>
        <br>
        <br>


    </ul>
    <h4>Pour plus d'informations veuillez nous envoyer un mail a l'adresse suivante ricamouele@groupeisi.com</h4>
    <p>Bonne reception!</p>
</body>

</html>