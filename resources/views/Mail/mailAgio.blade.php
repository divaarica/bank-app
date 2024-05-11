<!DOCTYPE html>
<html>

<head>
    <title>Detail de la transaction</title>
</head>

<body>
    <h4>Bonjour {{ $transactionData['prenom'] }} {{ $transactionData['nom'] }},</h4>
    <h4>Une Transaction a ete effectuer sur votre compte</h4>
    <h4>Voici Les informations :</h4>
    <ul>
        <p>
            Nous vous informons que votre compte a été débité en raison des agios mensuels liés à votre pack {{ $transactionData['pack'] }} FCFA. Le montant débité ce mois-ci est de {{ $transactionData['montant'] }} FCFA.

        </p>
        <p>
            Veuillez noter que ce débit est effectué chaque mois conformément aux conditions de votre pack. Si vous avez des questions sur ce débit ou sur les fonctionnalités de votre pack, n'hésitez pas à nous contacter. Nous sommes là pour vous aider.
        </p>
        <br>
        <p>Numero compte debiter: {{ $transactionData['compte'] }}</p>
        <p>Nouvelle Balance: {{ $transactionData['balance'] }} FCFA</p>
        <p>Date: {{ $transactionData['Date'] }}</p>
        <br>
        <br>
    </ul>
    <p>Cordialement,</p>
    <br>
    <p>SoftBank</p>
</body>

</html>