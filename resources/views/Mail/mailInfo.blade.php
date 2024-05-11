<!DOCTYPE html>
<html>

<head>
    <title>Information</title>
</head>

<body>
    <h2>Bonjour,</h2>
    <h2>Vous avez demander les information d'une transaction</h2>
    <h2>Voici les informations :</h2>
    <ul>
        @if($userData['type'] == 1)
        
        <p>Type de transaction : Transfert</p>
        <p>De : {{ $userData['nom1'] }} {{ $userData['prenom1'] }}</p>
        <p>vers: {{ $userData['nom2'] }} {{ $userData['prenom2'] }}</p>
        <p>montant: {{ $userData['montant'] }} FCFA</p>
        <p>Date de transaction: {{ $userData['Date'] }} </p>

        @elseif($userData['type'] == 2)

        <p>Type de transaction : Depot</p>
        <p>De : Agence </p>
        <p>vers: {{ $userData['nom'] }} {{ $userData['prenom'] }}</p>
        <p>montant deposer: {{ $userData['montant'] }} FCFA</p>
        <p>Date de transaction: {{ $userData['Date'] }} </p>

        @else

        <p>Type de transaction : Retrait</p>
        <p>De : Agence </p>
        <p>vers: {{ $userData['nom'] }} {{ $userData['prenom'] }}</p>
        <p>montant retirer: {{ $userData['montant'] }} FCFA</p>
        <p>Date de transaction: {{ $userData['Date'] }} </p>


        @endif


    </ul>
    <h4>Pour plus d'informations veuillez nous envoyer un mail a l'adresse suivante ricamouele@groupeisi.com</h4>
    <p>Bonne reception!</p>
</body>

</html>