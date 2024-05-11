<!DOCTYPE html>
<html>

<head>
    <title>Detail de la transaction</title>
</head>

<body>
    <h4>Bonjour {{ $transactionData['prenom'] }} {{ $transactionData['nom'] }},</h4>
    <h4>Cher Client</h4>
    <ul>
        <p>
            Nous tenons à vous informer qu'une erreur s'est produite récemment concernant le débit de certains comptes. Par erreur, des montants ont été débités des comptes de nos clients. Nous tenons à vous assurer qu'il s'agissait d'une erreur, et nos équipes ont travaillé rapidement pour corriger cette situation.
        </p>
        <p>
            Tous les montants débités par erreur ont été recrédités sur les comptes concernés. Veuillez vérifier votre solde pour confirmer que la correction a été apportée avec succès.
        </p>
        <p>
            Nous nous excusons sincèrement pour tout inconvénient que cela a pu causer. La satisfaction de nos clients est notre priorité absolue, et nous prenons des mesures pour éviter que de telles erreurs ne se reproduisent à l'avenir.
        </p>
        <br>
        <p>Numero compte a crediter: {{ $transactionData['compte'] }}</p>
        <p>Nouvelle Balance: {{ $transactionData['balance'] }} FCFA</p>
        <p>Date: {{ $transactionData['Date'] }}</p>
        <br>
        <br>
    </ul>
    <p>Nous vous remercions pour votre compréhension et votre confiance.</p>
    <br>
    <p>Cordialement,</p>
    <br>
    <p>SoftBank</p>
</body>

</html>