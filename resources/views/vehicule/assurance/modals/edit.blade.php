<div class="form-container">
  <h3 class="form-title">Modifier Assurance</h3>
  <form id="edit-assurance-form" method="POST">
    @csrf
    <input type="hidden" id="editAssuranceId">
    <input type="hidden" name="vehicule_id" value="{{$vehicule->id}}">
    <div class="form-item">
      <label for="matricule">Matricule </label>
      <input type="text" name="matricule" class='readonly-input' id="matricule" readonly value="{{$vehicule->matricule}}">
    </div>
    <div class="form-item">
      <label for="marque">Marque </label>
      <input type="text" name="marque" id="marque" class='readonly-input' readonly value="{{$vehicule->marque}}">
    </div>
    <div class="form-item">
      <label for="edit_date_debut">Date début<span class="star">*</span> </label>
      <input type="date" name="date_debut" id="edit_date_debut">
      <div class="error date_debut_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_date_fin">Date Fin<span class="star">*</span> </label>
      <input type="date" name="date_fin" id="edit_date_fin">
      <div class="error date_fin_error"></div>
    </div>
    <div class="form-item">
      <button id="edit-assurance-button" type="submit">Modifier</button>
    </div>
  </form>
</div>