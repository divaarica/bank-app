<!DOCTYPE html>
<html>

<head>
    <title>Detail de la transaction</title>
</head>

<body>
    <h4>Bonjour {{ $transactionData['prenom'] }} {{ $transactionData['nom'] }},</h4>
    <h4>Vous avez recu de l'argent a  {{ $transactionData['prenom2'] }} {{ $transactionData['nom2'] }}</h4>
    <h4>Voici Les informations :</h4>
    <ul>
        <p>Type de transaction: {{ $transactionData['type'] }}</p>
        <p>Code transaction: {{ $transactionData['code'] }}</p>
        <p>Montant Recu: {{ $transactionData['montant'] }} FCFA</p>
        <p>Numero de votre compte : {{ $transactionData['compte'] }}</p>
        <p>Numero du compte de l'emmeteur: {{ $transactionData['compte2'] }}</p>
        <p>Nouvelle Balance: {{ $transactionData['balance'] }} FCFA</p>
        <p>Date: {{ $transactionData['Date'] }}</p>
        <br>
        <br>
    </ul>
    <h4>Pour plus d'informations veuillez nous envoyer un mail a l'adresse suivante ricamouele@groupeisi.com</h4>
    <p>Bonne reception!</p>
</body>

</html>