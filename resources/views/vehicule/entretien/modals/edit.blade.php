<div class="form-container">
  <h3 class="form-title">Modifier Entrentien</h3>
  <form id="edit-entretien-form" method="POST">
    @csrf
    <input type="hidden" id="editEntretienId">
    <input type="hidden" name="vehicule_id" value="{{$vehicule->id}}">
    <div class="form-item">
      <label for="matricule">Matricule </label>
      <input type="text" name="matricule" class='readonly-input' id="matricule" readonly value="{{$vehicule->matricule}}">
      <div class="error matricule_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_km_actuel_entretien">Km Actuel </label>
      <input type="text" name="km_actuel" id="edit_km_actuel_entretien" class='readonly-input' readonlyedit_>
      <div class="error km_actuel_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_date_entretien">Date <span class="star">*</span> </label>
      <input type="date" name="date" id="edit_date_entretien">
      <div class="error date_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_type_entretien">Type d'entretien <span class="star">*</span> </label>
      <input type="text" name="type" id="edit_type_entretien">
      <div class="error type_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_cout_entretien">Coût <span class="star">*</span> </label>
      <input type="text" name="cout" id="edit_cout_entretien">
      <div class="error cout_error"></div>
    </div>
    <div class="form-item full-width">
      <label for="edit_observation_entretien">Observation</label>
      <textarea name="observation" id="edit_observation_entretien"></textarea>
    </div>
    <div class="form-item">
      <button id="edit-entretien-button" type="submit">Modifier</button>
    </div>
  </form>
</div>