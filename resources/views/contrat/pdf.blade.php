<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Test</title>
  <style>
    html {
      font-size: 18px
    }
    .blue { color: blue}
    .label {
      font-weight: 600;
      text-transform: capitalize;
    }
    .article .blue {
      margin: 0
    }
    .article p {
      margin: 8px 0;
    }
    table {
      padding: 10px;
      max-width: 300px;
      margin: auto auto 10px;
      text-align: center;
      border-collapse: collapse;
    }
    table td {
      border: 1px solid;
      padding: 10px
    }
    table td.empty-td {padding: 30px}
    .footer {
      max-width: 500px;
      margin: 20px auto;
      text-align: center;
    }
    .footer p {margin: 0;}
    .container {
      border-bottom: 1px solid;
    }
  </style>
</head>
<body>
  <h3 class="blue" style="text-align: center">Contrat de location</h3>
  <p>Contrat <span class="label">N°:{{$contrat->id}}</span></p>
  <p>ENTRE LES SOUSSIGNES,</p>
  <br>
  <br>
  <div>
    <h4 class="blue">Informations de <b>locataire</b></h4>
    <p><span class="label">Nom & Prénom:</span> {{$contrat->client->nom}} {{$contrat->client->prenom}}</p>
    <p><span class="label">Date et lieu de naissance:</span> {{$contrat->client->date_naissance}} à {{$contrat->client->lieu_naissance}}</p>
    <p><span class="label">Adresse:</span>  {{$contrat->client->adresse}} </p>
    <p><span class="label">CIN:</span>  {{$contrat->client->cin}}</p>
    <p><span class="label">Permis:</span> {{$contrat->client->numero_permis}}</p>
    <p><span class="label">Tél (GSM):</span> {{$contrat->client->telephone}}</p>
  </div>
  <p>IL A ETE CONVENU CE QUI SUIT;</p>
  <div class="container">
    <div class='article'>
      <h4 class="blue">1-1 Nature et date d'effet du contrat</h4>
      <p>Le <span class="label">loueur</span> met à disposition du locataire, un véhicule de marque {{$contrat->vehicule->marque}}, immatriculé {{$contrat->vehicule->matricule}}, à titre onéreux et à compter du {{$contrat->date_debut}} {{date('H:i', strtotime($contrat->heure_debut))}} à {{$contrat->date_fin}} {{date('H:i', strtotime($contrat->heure_fin))}}.
      <br>Kilométrage du véhicule : {{$contrat->vehicule->kilometrage}}kms</p>
    </div>
    <div class='article'>
      <h4 class="blue">1.2 - Etat du véhicule</h4>
      <p>
        Lors de la remise du véhicule et lors de sa restitution, un procès-verbal de l'état du véhicule sera établi entre le locataire et le loueur.
        Le véhicule devra être restitué le même état que lors de sa remise. Toutes les détériorations sur le véhicule constatées sur le PV de sortie seront à la charge du locataire.
        Le locataire certifie être en possession du permis l'autorisant à conduire le présent véhicule.
      </p>
    </div>
    <div class='article'>
      <h4 class="blue">1.3 - Prix de la location du de la voiture</h4>
      <p>Les parties s'entendent sur un prix de location {{$contrat->vehicule->prix_location}} dirhams par jour (calendaires)</p>
    </div>
    <div class='article'>
      <h4 class="blue">1.4 - Durée et restitution de la voiture</h4>
      <p>Le contrat est à durée indéterminée. Il pourra y être mis fin par chacune des parties à tout moment en adressant un courrier recommandé en respectant un préavis d'un mois.</p>
    </div>
    <div class='article'>
      <h4 class="blue">1.5 - Autres éléments et accessoires</h4>
      <p>Le locataire prendra en charge l'ensemble des charges afférentes à la mise à disposition du véhicule :
        <ul>
          <li>Frais d'entretien du véhicule,</li>
          <li>Impôts et taxes liés au véhicule,</li>
          <li>Les frais d'essence,</li>
          <li>L'assurance du véhicule.</li>
        </ul>
      </p>
    </div>
    <div class="article">
      <h4 class="blue">1.6 - Clause en cas de litige</h4>
      <p>Les parties conviennent expressément que tout litige pouvant naître de l'exécution du présent contrat
        relèvera de la compétence du tribunal de commerce de {{$agence->ville}}<br>
        Fait en deux exemplaires originaux remis à chacune des parties,
        <br><br>
        Fait en deux exemplaires originaux remis à chacune des parties,
        <br>
        A {{$agence->ville}}, le {{date('d-m-Y', strtotime($contrat->date_contrat))}}</p>
    </div>
    <table>
      <tr>
        <td>SIGNATEUR DU LOCATAIRE LU ET APPROUVÉ</td>
        <td>SIGNATEUR ET CACHET DE L'AGENCE</td>
      </tr>
      <tr>
        <td class="empty-td"></td>
        <td class="empty-td"></td>
      </tr>
    </table>
  </div>
  <div class="footer">
    <p>{{$agence->raison_sociale}}, {{$agence->adresse}}</p>
    <p>Fax: {{$agence->fax}} - GSM: {{$agence->telephone}}</p>
    <p>RC N°: {{$agence->RC}} - Patent: {{$agence->patent}} - IF: {{$agence->IF}} - ICE: {{$agence->ICE}} - CNSS: {{$agence->CNSS}}</p>
  </div>
</body>
</html>