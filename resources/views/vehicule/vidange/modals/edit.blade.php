<div class="form-container">
  <h3 class="form-title">Modifier Vidange</h3>
  <form id="edit-vidange-form" method="POST">
    @csrf
    <input type="hidden" id="editVidangeId">
    <input type="hidden" name="vehicule_id" value="{{$vehicule->id}}">
    <div class="form-item">
      <label for="matricule">Matricule </label>
      <input type="text" name="matricule" class='readonly-input' id="matricule" readonly value="{{$vehicule->matricule}}">
      <div class="error matricule_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_km_actuel">Km </label>
      <input type="text" name="km_actuel" id="edit_km_actuel" class='readonly-input' readonly>
      <div class="error km_actuel_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_date">Date <span class="star">*</span> </label>
      <input type="date" name="date" id="edit_date">
      <div class="error date_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_type">Type de vidange <span class="star">*</span> </label>
      <input type="text" name="type" id="edit_type">
      <div class="error type_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_km_prochain_vidange">Km Prochain vidange <span class="star">*</span> </label>
      <input type="text" name="km_prochain_vidange" id="edit_km_prochain_vidange" class='readonly-input' readonly>
      <div class="error km_prochain_vidange_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_cout">Coût <span class="star">*</span> </label>
      <input type="text" name="cout" id="edit_cout">
      <div class="error cout_error"></div>
    </div>
    <div class="form-item full-width">
      <label for="edit_observation">Observation</label>
      <textarea name="observation" id="edit_observation"></textarea>
    </div>
    <div class="form-item">
      <button id="edit-vidange-button" type="submit">Modifier</button>
    </div>
  </form>
</div>