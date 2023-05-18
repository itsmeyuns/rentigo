<div class="form-container">
  <h3 class="form-title">Modifier Agent</h3>
  <form class="add-form" id="edit-agent-form" action="{{ route('agents.store') }}" method="POST">
    @csrf
    <input type="hidden" id="editAgentId">
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
      <label for="edit_date_naissance">Né(e) Le<span class="star">*</span> </label>
      <input type="date" name="date_naissance" id="edit_date_naissance">
      <div class="error date_naissance_error" ></div>
    </div>
    <div class="form-item">
      <label for="edit_lieu_naissance">Né(e) à<span class="star">*</span> </label>
      <input type="text" name="lieu_naissance" id="edit_lieu_naissance">
      <div class="error lieu_naissance_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_adresse">Adresse<span class="star">*</span> </label>
      <input type="text" name="adresse" id="edit_adresse">
      <div class="error adresse_error" ></div>
    </div>
    <div class="form-item">
      <label for="edit_cin">CIN <span class="star">*</span> </label>
      <input type="text" name="cin" id="edit_cin">
      <div class="error cin_error" ></div>
    </div>
    <div class="form-item">
      <label for="edit_telephone">Télephone <span class="star">*</span> </label>
      <input type="text" name="telephone" id="edit_telephone">
      <div class="error telephone_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_email">Email <span class="star">*</span> </label>
      <input type="email" name="email" id="edit_email">
      <div class="error email_error"></div>
    </div>
    <div class="login-infos-container full-width">
      <h3 class="form-title">Informations de connexion</h3>
      <div class="login-infos">
        <div class="form-item">
          <label for="edit_login">Login <span class="star">*</span> </label>
          <input type="text" name="login" id="edit_login">
          <div class="error login_error"></div>
        </div>
        <div class="form-item">
          <label for="edit_password">Mot de Pass <span class="star">*</span> </label>
          <input type="password" name="password" id="edit_password">
          <div class="error password_error"></div>
          <div class="material-icons-round show-password" id="editShowPassword">visibility</div>
        </div>
        
      </div>
    </div>
    <div class="form-item full-width">
      <button type="submit" id="edit-agent-button">Modifier</button>
    </div>
  </form>
</div>
