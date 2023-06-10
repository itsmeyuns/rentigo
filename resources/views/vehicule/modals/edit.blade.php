<div class="form-container">
  <h3 class="form-title">Modifier Véhicule</h3>
  <form id="edit-vehicule-form" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="editVehiculeId">
    <div class="form-item">
      <label for="edit_matricule">matricule <span class="star">*</span> </label>
      <input type="text" name="matricule" id="edit_matricule">
      <div class="error matricule_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_marque">marque <span class="star">*</span> </label>
      <input type="text" name="marque" id="edit_marque">
      <div class="error marque_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_modele">modèle <span class="star">*</span> </label>
      <input type="text" name="modele" id="edit_modele">
      <div class="error modele_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_kilometrage">kilométrage <span class="star">*</span> </label>
      <input type="text" name="kilometrage" id="edit_kilometrage">
      <div class="error kilometrage_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_prix_location">prix location <span class="star">*</span> </label>
      <input type="text" name="prix_location" id="edit_prix_location">
      <div class="error prix_location_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_couleur">couleur <span class="star">*</span> </label>
      <input type="text" name="couleur" id="edit_couleur">
      <div class="error couleur_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_carburant">carburant <span class="star">*</span> </label>
      <select name="carburant" id="edit_carburant">
        <option value="Essence">Essence</option>
        <option value="Diesel">Diesel</option>Diesel
      </select>
      <div class="error carburant_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_automatique">automatique <span class="star">*</span> </label>
      <select name="automatique" id="edit_automatique">
        <option value="0">Non</option>
        <option value="1">Oui</option>
      </select>
      <div class="error automatique_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_status">disponibilité <span class="star">*</span> </label>
      <select name="status" id="edit_status">
        <option value="Disponible">Disponible</option>
        <option value="Loué">Loué</option>
        <option value="En panne">En panne</option>
      </select>
      <div class="error status_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_nombre_portes">nombre portes <span class="star">*</span> </label>
      <input type="text" name="nombre_portes" id="edit_nombre_portes">
      <div class="error nombre_portes_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_nombre_places">nombre places <span class="star">*</span> </label>
      <input type="text" name="nombre_places" id="edit_nombre_places">
      <div class="error nombre_places_error"></div>
    </div>
    <div class="extras-container">
        {{-- <div class="extra-box">
          <input type="checkbox" name="extras[]" id="edit_gps" value="gps">
          <label for="gps">GPS</label>
        </div>
        <div class="extra-box">
          <input type="checkbox" name="extras[]" id="edit_triangleDePanne" value="triangle de panne">
          <label for="triangleDePanne">Triangle de panne</label>
        </div>
        <div class="extra-box">
          <input type="checkbox" name="extras[]" id="edit_gilet" value="gilet">
          <label for="gilet">Gilet</label>
        </div>
        <div class="extra-box">
          <input type="checkbox" name="extras[]" id="edit_cameraDeRecul" value="Caméra de recul">
          <label for="cameraDeRecul">Caméra de recul</label>
        </div>
        <div class="extra-box">
          <input type="checkbox" name="extras[]" id="edit_extincteur" value="extincteur">
          <label for="extincteur">Extincteur</label>
        </div>
        <div class="extra-box">
          <input type="checkbox" name="extras[]" id="edit_regulateurDeVitesse" value="Régulateur de vitesse">
          <label for="regulateurDeVitesse">Régulateur de vitesse</label>
        </div>
        <div class="extra-box">
          <input type="checkbox" name="extras[]" id="edit_siegeBebe" value="Siège bébé">
          <label for="siegeBebe">Siège bébé</label>
        </div> --}}
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
        <input type="file" name="photo" id="edit_photo">
      </div>
      <div class="imgPreview" id="edit_imgPreview">
        <img src="" id="edit_uploadedImage">
      </div>
    </div>
    <div class="form-item">
      <button id="edit-vehicule-button" type="submit">Modifier</button>
    </div>
  </form>
</div>