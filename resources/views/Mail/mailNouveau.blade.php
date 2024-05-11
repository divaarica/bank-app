<!DOCTYPE html>
<html>

<head>
    <title>Inscription</title>
</head>

<body>
    <h2>Bonjour {{ $userData['prenom'] }} {{ $userData['nom'] }},</h2>
    <h2>Un compte a ete ouvert a votre nom </h2>
    <h2>Voici les informations :</h2>
    <ul>
        <p>Type de compte: {{ $userData['compte'] }}</p>
        <p>Numero: {{ $userData['numero'] }}</p>
        <p>Balance: {{ $userData['balance'] }} FCFA</p>
        <p>Date de creation: {{ $userData['Date'] }} </p>
        

        <br>
        <br>
        <h3>Ci-joint, le RIB associe a ce compte</h3>


    </ul>
    <h4>Pour plus d'informations veuillez nous envoyer un mail a l'adresse suivante ricamouele@groupeisi.com</h4>
    <p>Bonne reception!</p>
</body>

</html>