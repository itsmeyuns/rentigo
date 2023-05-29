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
        <option value="Non">Non</option>
        <option value="Oui">Oui</option>
      </select>
    </div>
    <div class="form-item">
      <label for="status">disponibilité <span class="star">*</span> </label>
      <select name="status" id="status">
        <option value="Disponible">Disponible</option>
        <option value="Loué">Loué</option>
        <option value="En panne">En panne</option>
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
    <div class="extras-container">
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