<!DOCTYPE html>
<html>

<head>
    <title>Detail de la transaction</title>
</head>

<body>
    <h4>Bonjour {{ $transactionData['prenom'] }} {{ $transactionData['nom'] }},</h4>
    <h4>{{ $transactionData['dire']}} {{ $transactionData['montant'] }} FCFA {{ $transactionData['dire']}} {{ $transactionData['prenom2'] }} {{ $transactionData['prenom2'] }}</h4>
    <h4>Voici Les informations :</h4>
    <ul>
        <p>Type de transaction: {{ $transactionData['type'] }}</p>
        <p>Code transaction: {{ $transactionData['code'] }}</p>
        <p>Montant: {{ $transactionData['montant'] }} FCFA</p>
        <p>Numero compte debiter: {{ $transactionData['compte'] }}</p>
        <p>Nouvelle Balance: {{ $transactionData['balance'] }} FCFA</p>
        <p>Date: {{ $transactionData['Date'] }}</p>
        <br>
        <br>
    </ul>
    <h4>Pour plus d'informations veuillez nous envoyer un mail a l'adresse suivante ricamouele@groupeisi.com</h4>
    <p>Bonne reception!</p>
</body>

</html>