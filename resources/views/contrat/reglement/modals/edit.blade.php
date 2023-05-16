<div class="form-container">
  <h3 class="form-title">Modifier Réglement</h3>
  <form id="edit-reglement-form">
    @csrf
    <input type="hidden" id="editReglementId">
    <input type="hidden" name="contrat_id" value="{{$contrat->id}}">
    <div class="form-item">
      <label for="edit_contrat_id">Contrat N°<span class="star">*</span> </label>
      <input type="text" name="contrat_id" class='readonly-input' id="edit_contrat_id" readonly value="{{$contrat->id}}">
      <div class="error contrat_id_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_date_reglement">Date réglement<span class="star">*</span> </label>
      <input type="date" name="date_reglement" id="edit_date_reglement">
      <div class="error date_reglement_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_montant">montant <span class="star">*</span></label>
      <input type="text" name="montant" id="edit_montant">
      <div class="error montant_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_type">type <span class="star">*</span></label>
      <select name="type" id="edit_type">
        <option value="" disabled selected>Selectionner le type</option>
        <option value="espèce">Espèce</option>
        <option value="virement bancaire">Virement Bancaire</option>
        <option value="chèque">Chèque</option>
      </select>
      <div class="error type_error"></div>
    </div>
    <div class="form-item">
      <button id="edit-reglement-button" type="submit">Modifier</button>
    </div>
  </form>
</div>