<div class="form-container">
  <h3 class="form-title">Ajouter Utilisateur</h3>
  <form class="add-form" id="add-user-form" action="{{ route('users.store') }}" method="POST">
    @csrf
    <div class="form-item">
      <label for="nom">Nom <span class="star">*</span> </label>
      <input type="text" name="nom" id="nom">
      <div class="error nom_error"></div>
    </div>
    <div class="form-item">
      <label for="prenom">Prénom <span class="star">*</span> </label>
      <input type="text" name="prenom" id="prenom">
      <div class="error prenom_error"></div>
    </div>
    <div class="form-item">
      <label for="sexe">Sexe <span class="star">*</span></label>
      <select name="sexe" id="sexe">
        <option value="" selected disabled>Choisir le sexe</option>
        <option value="H">Homme</option>
        <option value="F">Femme</option>
      </select>
      <div class="error sexe_error"></div>
    </div>
    <div class="form-item">
      <label for="date_naissance">Né(e) Le<span class="star">*</span> </label>
      <input type="date" name="date_naissance" id="date_naissance">
      <div class="error date_naissance_error" ></div>
    </div>
    <div class="form-item">
      <label for="lieu_naissance">Né(e) à<span class="star">*</span> </label>
      <input type="text" name="lieu_naissance" id="lieu_naissance">
      <div class="error lieu_naissance_error"></div>
    </div>
    <div class="form-item">
      <label for="adresse">Adresse<span class="star">*</span> </label>
      <input type="text" name="adresse" id="adresse">
      <div class="error adresse_error" ></div>
    </div>
    <div class="form-item">
      <label for="cin">CIN <span class="star">*</span> </label>
      <input type="text" name="cin" id="cin">
      <div class="error cin_error" ></div>
    </div>
    <div class="form-item">
      <label for="telephone">Télephone <span class="star">*</span> </label>
      <input type="text" name="telephone" id="telephone">
      <div class="error telephone_error"></div>
    </div>
    <div class="form-item">
      <label for="email">Email <span class="star">*</span> </label>
      <input type="email" name="email" id="email">
      <div class="error email_error"></div>
    </div>
    <div class="login-infos-container full-width">
      <h3 class="form-title">Informations de connexion</h3>
      <div class="login-infos">
        <div class="form-item">
          <label for="login">Login <span class="star">*</span> </label>
          <input type="text" name="login" id="login">
          <div class="error login_error"></div>
        </div>
        <div class="form-item">
          <label for="password">Mot de Pass <span class="star">*</span> </label>
          <input type="password" name="password" id="password">
          <div class="error password_error"></div>
          <div class="material-icons-round show-password" id="showPassword">visibility</div>
        </div>
        <div class="form-item">
          <label for="role">rôle <span class="star">*</span></label>
          <select name="role" id="role">
            <option value="" selected disabled>Choisir le rôle</option>
            <option value="admin">Admin</option>
            <option value="agent">Agent</option>
          </select>
          <div class="error role_error"></div>
        </div>
      </div>
    </div>
    <div class="form-item full-width">
      <button type="submit" id="add-user-button">Ajouter</button>
    </div>
  </form>
</div>
