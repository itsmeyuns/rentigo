<div class="form-container">
  <h3 class="form-title">Ajouter Vehicule</h3>
  <form id="add-vehicule-form" action="{{route('vehicules.store')}}" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="form-item">
      <label for="matricule">matricule <span class="star">*</span> </label>
      <input type="text" name="matricule" id="matricule">
      <div class="error matricule_error"></div>
    </div>
    <div class="form-item">
      <label for="marque">marque <span class="star">*</span> </label>
      <input type="text" name="marque" id="marque">
      <div class="error marque_error"></div>
    </div>
    <div class="form-item">
      <label for="modele">modèle <span class="star">*</span> </label>
      <input type="text" name="modele" id="modele">
      <div class="error modele_error"></div>
    </div>
    <div class="form-item">
      <label for="kilometrage">kilométrage <span class="star">*</span> </label>
      <input type="text" name="kilometrage" id="kilometrage">
      <div class="error kilometrage_error"></div>
    </div>
    <div class="form-item">
      <label for="prix_location">prix location <span class="star">*</span> </label>
      <input type="text" name="prix_location" id="prix_location">
      <div class="error prix_location_error"></div>
    </div>
    <div class="form-item">
      <label for="couleur">couleur <span class="star">*</span> </label>
      <input type="text" name="couleur" id="couleur">
      <div class="error couleur_error"></div>
    </div>
    <div class="form-item">
      <label for="carburant">carburant <span class="star">*</span> </label>
      <select name="carburant" id="carburant">
        <option value="Essence">Essence</option>
        <option value="Diesel">Diesel</option>Diesel
      </select>
    </div>
    <div class="form-item">
      <label for="automatique">automatique <span class="star">*</span> </label>
      <select name="automatique" id="automatique">
        <option value="non">Non</option>
        <option value="oui">Oui</option>
      </select>
    </div>
    <div class="form-item">
      <label for="disponibilite">disponibilité <span class="star">*</span> </label>
      <select name="disponibilite" id="disponibilite">
        <option value="disponible">Disponible</option>
        <option value="louer">Loué</option>
        <option value="en panne">En panne</option>
      </select>
    </div>
    <div class="form-item">
      <label for="nombre_portes">nombre portes <span class="star">*</span> </label>
      <input type="text" name="nombre_portes" id="nombre_portes">
      <div class="error nombre_portes_error"></div>
    </div>
    <div class="form-item">
      <label for="nombre_places">nombre places <span class="star">*</span> </label>
      <input type="text" name="nombre_places" id="nombre_places">
      <div class="error nombre_places_error"></div>
    </div>
    <div class="checkboxes">
      <div class="left-boxes">
        <div class="box-field">
          <input type="checkbox" name="extras[]" id="gps" value="gps">
          <label for="gps">GPS</label>
        </div>
        <div class="box-field">
          <input type="checkbox" name="extras[]" id="triangleDePanne" value="triangle de panne">
          <label for="triangleDePanne">Triangle de panne</label>
        </div>
        <div class="box-field">
          <input type="checkbox" name="extras[]" id="gilet" value="gilet">
          <label for="gilet">Gilet</label>
        </div>
        <div class="box-field">
          <input type="checkbox" name="extras[]" id="cameraDeRecul" value="Caméra de recul">
          <label for="cameraDeRecul">Caméra de recul</label>
        </div>
      </div>
      <div class="right-boxes">
        <div class="box-field">
          <input type="checkbox" name="extras[]" id="extincteur" value="extincteur">
          <label for="extincteur">Extincteur</label>
        </div>
        <div class="box-field">
          <input type="checkbox" name="extras[]" id="regulateurDeVitesse" value="Régulateur de vitesse">
          <label for="regulateurDeVitesse">Régulateur de vitesse</label>
        </div>
        <div class="box-field">
          <input type="checkbox" name="extras[]" id="siegeBebe" value="Siège bébé">
          <label for="siegeBebe">Siège bébé</label>
        </div>
      </div>
    </div>
    <div class="form-item input-file-holder">
      <div class="img-container">
        <div class="file-label">
          <span class="material-icons-round icon">
            add_photo_alternate
          </span>
          <span>photo véhicule</span>
        </div>
        <div class="error photo_error"></div>
        <input type="file" name="photo" id="photo">
      </div>
      <div class="imgPreview" id="imgPreview">
        <img src="" id="uploadedImage">
      </div>
    </div>
    <div class="form-item">
      <button id="add-vehicule-button" type="submit">Ajouter</button>
    </div>
  </form>
</div>