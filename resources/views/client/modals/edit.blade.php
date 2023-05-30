<div class="form-container">
  <h3 class="form-title">Modifier Client</h3>
  <form id="edit-client-form">
    @csrf
    <input type="hidden" id="editClientId">
    <div class="form-item">
      <label for="edit_nom">Nom <span class="star">*</span> </label>
      <input type="text" name="nom" id="edit_nom">
      <div class="error nom_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_prenom">Prénom <span class="star">*</span> </label>
      <input type="text" name="prenom" id="edit_prenom">
      <div class="error prenom_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_sexe">Sexe <span class="star">*</span></label>
      <select name="sexe" id="edit_sexe">
        <option value="" selected disabled>Choisir le sexe</option>
        <option value="H">Homme</option>
        <option value="F">Femme</option>
      </select>
      <div class="error sexe_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_date_naissance">Né(e) le<span class="star">*</span> </label>
      <input type="date" name="date_naissance" id="edit_date_naissance">
      <div class="error date_naissance_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_lieu_naissance">Né(e) à<span class="star">*</span> </label>
      <input type="text" name="lieu_naissance" id="edit_lieu_naissance">
      <div class="error lieu_naissance_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_adresse">Adresse <span class="star">*</span> </label>
      <input type="text" name="adresse" id="edit_adresse">
      <div class="error adresse_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_cin">CIN <span class="star">*</span> </label>
      <input type="text" name="cin" id="edit_cin">
      <div class="error cin_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_numero_permis">N° Permis <span class="star">*</span> </label>
      <input type="text" name="numero_permis" id="edit_numero_permis">
      <div class="error numero_permis_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_telephone">Télephone <span class="star">*</span> </label>
      <input type="text" name="telephone" id="edit_telephone">
      <div class="error telephone_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_email">Email</label>
      <input type="email" name="email" id="edit_email">
      <div class="error email_error"></div>
    </div>
    <div class="form-item full-width">
      <label for="edit_observation">Observation</label>
      <textarea name="observation" id="edit_observation"></textarea>
      <div class="error">
        @error('observation')
          {{$message}}
        @enderror
      </div>

    </div>
    <div class="form-item">
      <button id='edit-client-button'>Modifier</button>
    </div>
  </form>
</div>

