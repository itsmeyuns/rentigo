<div class="form-container">
  <h3 class="form-title">Modifier Contrat</h3>
  <form id="edit-contrat-form" action="{{route('contrats.store')}}" method="POST">
    @csrf
    <input type="hidden" id="editContratId">
    <div class="form-item">
      <label for="edit_date_contrat">Date contrat <span class="star">*</span> </label>
      <input type="date" name="date_contrat" id="edit_date_contrat" class="readonly-input"edit_ readonly>
      <div class="error date_contrat_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_clients">client <span class="star">*</span> </label>
      <select name="client_id" id="edit_clients">
      </select>
      <div class="error client_id_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_vehicules">vehicule <span class="star">*</span> </label>
      <select name="vehicule_id" id="edit_vehicules">
      </select>
      <div class="error vehicule_id_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_prix_location">Prix Location<span class="star">*</span> </label>
      <input type="text" name="prix_location" id="edit_prix_location" data-label="edit_prix_location"  class="readonly-input" readonly>
      <div class="error prix_location_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_date_debut">Date début <span class="star">*</span> </label>
      <input type="datetime-local" name="date_debut" id="edit_date_debut">
      <div class="error date_debut_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_date_fin">Date fin <span class="star">*</span> </label>
      <input type="datetime-local" name="date_fin" id="edit_date_fin">
      <div class="error date_fin_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_montant">Montant <span class="star">*</span> </label>
      <input type="text" name="montant" id="edit_montant" class="readonly-input" readonly value="">
      <div class="error montant_error"></div>
    </div>
    <div class="form-item">
      <label for="terminee">Terminée <span class="star">*</span> </label>
      <select name="terminee" id="terminee">
        <option value="0">Non</option>
        <option value="1">Oui</option>
      </select>
      <div class="error client_id_error"></div>
    </div>
    <div class="form-item full-width">
      <button id="edit-contrat-button" type="submit">Modifier</button>
    </div>
  </form>
</div>