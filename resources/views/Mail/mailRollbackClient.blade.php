<!DOCTYPE html>
<html>

<head>
    <title>Erreur de transaction</title>
</head>

<body>
    <h4>Bonjour {{ $transactionData['prenom'] }} {{ $transactionData['nom'] }},</h4>
    <h4>La transaction {{ $transactionData['code'] }} a ete annuler !</h4>
    <h4>Voici Les informations :</h4>
    <ul>
        <p>Type de l'ancienne transaction: {{ $transactionData['type'] }}</p>
        <p>Montant de la transaction: {{ $transactionData['montant'] }} FCFA</p>
        @if( $transactionData['pass']  == 1  )
            <p>Emetteur: {{ $transactionData['autreClientPrenom'] }} {{ $transactionData['autreClientNom'] }}</p>
            <p>Destinataire: {{ $transactionData['prenom'] }} {{ $transactionData['nom'] }}</p>
        @else
            <p>Emetteur: {{ $transactionData['prenom'] }} {{ $transactionData['nom'] }}</p>
            <p>Destinataire:  {{ $transactionData['autreClientPrenom'] }} {{ $transactionData['autreClientNom'] }}</p>
        @endif
        <p>Nouvelle Balance de votre compte {{ $transactionData['compte'] }}: {{ $transactionData['balance'] }} FCFA</p>
        <p>Date d'annulation: {{ $transactionData['Date'] }}</p>
        <br>
        <br>

    </ul>
    <h4>Pour plus d'informations veuillez nous envoyer un mail a l'adresse suivante ricamouele@groupeisi.com</h4>
    <p>Bonne reception!</p>
</body>

</html>