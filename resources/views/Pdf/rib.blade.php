<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>RIB Example</title>
<style>
  body {
    font-family: Arial, sans-serif;
  }
  .container {
    max-width: 900px;
    margin: 0 auto;
    padding: 20px;
    /* border: 1px solid #ccc;
    border-radius: 5px; */
  }
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }
  th, td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
    text-align: left;
  }
  th {
    background-color: #f2f2f2;
  }
  .bank-logo {
    max-width: 100px;
    margin-bottom: 10px;
  }
</style>
</head>
<body>
  <div class="container">
  <div style="text-align: center;">
      <h2>SoftBank</h2>
    </div>
    <h3 style="text-align: center;">Relevé d'Identité Bancaire (RIB)</h3>
    <table>
      <tr>
        <th>Information</th>
        <th>Valeur</th>
      </tr>
      <tr>
        <td><strong>Titulaire</strong></td>
        <td>{{ $titulaire }}</td>
      </tr>
      <tr>
        <td><strong>IBAN</strong></td>
        <td>{{ $iban }}</td>
      </tr>
      <tr>
        <td><strong>BIC</strong></td>
        <td>{{ $bic }}</td>
      </tr>
      <tr>
        <td><strong>Code Banque</strong></td>
        <td>{{ $code_banque }}</td>
      </tr>
      <tr>
        <td><strong>Code Agence</strong></td>
        <td>{{ $code_agence }}</td>
      </tr>
      <tr>
        <td><strong>Numéro de compte</strong></td>
        <td>{{ $numero_compte }}</td>
      </tr>
      <tr>
        <td><strong>Cle Rib</strong></td>
        <td>{{ $cle }}</td>
      </tr>
    </table>
  </div>
</body>
</html>
