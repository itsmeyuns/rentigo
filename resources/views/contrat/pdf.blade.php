<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contrat</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&family=Poppins:wght@200;300;400;500;600;700&display=swap');

    * {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
      font-family: 'Open Sans', sans-serif;
      overflow: hidden;
    }

    .contrat-container {
      border: 1px solid;
      width: 200px
      margin: 10px auto;
    }

    .contrat-container > p {
      text-align: center;
    }

    .contrat-container table {
      border: 1px solid;
      text-align: center;
      border-collapse: collapse;
      width: 100%;
    }

    .contrat-container table td {
      text-transform: capitalize;
    }

    .contrat-container table td:not(td:last-child),
    .contrat-container table th:not(th:last-child)
    {
      border-right: 1px solid;
    }

    .contrat-header td {
      padding: 10px;
    } 

    .contrat-header table td img {
      width: 130px;
    }

    .contrat-container p {
      margin: 10px 0 ;
    }
    .contrat-container .title {
      text-align: center;
      text-transform: uppercase;
      font-size: 18px;
      font-weight: 600;
      margin: 2px 0;
    } 

    .contrat-body {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
    }

    .contrat-body .box {
      display: none
      width: calc(200px - 10px) ;
      min-height: 200px;
      margin: 10px 0;
      border: 1px solid;
    }

    .contrat-body img {
      margin: auto;
    }

    .contrat-body .box-title {
      border-bottom: 1px solid;
    }

    .contrat-body .infos {
      padding: 10px;
    }

    .contrat-body .label {
      font-style: italic;
      font-weight: 600;
      text-transform: capitalize;
    }

    .contrat-body .extras {
      margin-left: 50px;
    }

    .contrat-footer .title {
      border: 1px solid;
    }

    .contrat-footer table {
      margin-top: 5px;
    }

    .contrat-footer table td {
      padding: 40px;
    }

  </style>
</head>
<body>
  <div class="contrat-container">
    <div class="contrat-header">
      <table>
        <tr>
          <td>
            <img src="https://placehold.co/600x400?font=roboto" alt="">
          </td>
          <td>
            <p>36 Hay Hassani, Casablanca</p>
            <p>+212767893210</p>
            <p>+212767893210</p>
          </td>
          <td>
            <p>Contrat N°: {{$contrat->id}}</p>
            <p>Le: {{$contrat->date_contrat}}</p>
            <p>à: Casablanca</p>
          </td>
        </tr>
      </table>
    </div>
    <div class="contrat-body">
      <div class="box">
        <div class="title box-title">Locataire</div>
        <div class="infos">
          <p><span class="label">Nom & Prénom:</span> {{$contrat->client->nom}} {{$contrat->client->prenom}}</p>
          <p><span class="label">Date et lieu de naissance:</span> {{$contrat->client->date_naissance}} à {{$contrat->client->lieu_naissnace}}</p>
          <p><span class="label">Adresse:</span>  {{$contrat->client->adresse}} </p>
          <p><span class="label">CIN:</span>  {{$contrat->client->cin}}</p>
          <p><span class="label">Permis:</span> {{$contrat->client->numero_permis}}</p>
          <p><span class="label">Tél (GSM):</span> {{$contrat->client->telephone}}</p>
        </div>
      </div>
      <div class="box">
        <div class="title box-title">description du vehicule</div>
        <div class="infos">
          <p><span class="label">Marque & Modéle: </span> {{$contrat->vehicule->marque}} {{$contrat->vehicule->modele}}</p>
          <p><span class="label">Matricule: </span> {{$contrat->vehicule->matricule}}</p>
          <p><span class="label">Date & heur de départ: </span>  {{$contrat->date_debut}} à {{$contrat->heure_debut}}</p>
          <p><span class="label">KM de départ: </span>  {{$contrat->vehicule->kilometrage}}</p>
          <p><span class="label">Date & heur de retour: </span> {{$contrat->date_fin}} à {{$contrat->heure_fin}}</p>
          <p><span class="label">montant de location: </span> 300MAD</p>
          <span class="label">Extras:</span>
          <div class="extras">
            @foreach ($contrat->vehicule->extras as $extra)
              -{{$extra->nom}}
            @endforeach
          </div>
        </div>
      </div>
      <div class="box">
        <div class="title box-title">état de véhicule à la livraison</div>
        <div class="infos">
          <img src="{{public_path('pics/contrats/etat_livraison.PNG')}}">
        </div>
      </div>
      <div class="box">
        <div class="title box-title">état de véhicule à la reprise</div>
        <div class="infos">
          <img src="{{public_path('pics/contrats/etat_reprise.PNG')}}">
        </div>
      </div>
    </div>
    <div class="contrat-footer">
      <div class="title">SIGNATURES</div>
      <table>
        <tr>
          <th>Locataire</th>
          <th>Société</th>
        </tr>
        <tr>
          <td></td>
          <td></td>
        </tr>
      </table>
    </div>
    <p>R.C 99809 IF:000003 PATENTE:0001 ICE:000000000003 C.N.S.S:00000001</p>
  </div>
</body>
</html>