<div class="form-container">
  <h3 class="form-title">Ajouter Réglement</h3>
  <form id="add-reglement-form" action="{{route('reglements.store')}}" method="POST">
    @csrf
    <input type="hidden" name="contrat_id" value="{{$contrat->id}}">
    <div class="form-item">
      <label for="contrat_id">Contrat N°<span class="star">*</span> </label>
      <input type="text" name="contrat_id" class='readonly-input' id="contrat_id" readonly value="{{$contrat->id}}">
      <div class="error contrat_id_error"></div>
    </div>
    <div class="form-item">
      <label for="date_reglement">Date réglement<span class="star">*</span> </label>
      <input type="date" name="date_reglement" id="date_reglement" value="{{date('Y-m-d')}}">
      <div class="error date_reglement_error"></div>
    </div>
    <div class="form-item">
      <label for="montant">montant <span class="star">*</span></label>
      <input type="text" name="montant" id="montant">
      <div class="error montant_error"></div>
    </div>
    <div class="form-item">
      <label for="type">type <span class="star">*</span></label>
      <select name="type" id="type">
        <option value="" disabled selected>Selectionner le type</option>
        <option value="espèce">Espèce</option>
        <option value="virement bancaire">Virement Bancaire</option>
        <option value="chèque">Chèque</option>
      </select>
      <div class="error montant_error"></div>
    </div>
    <div class="form-item">
      <button id="add-reglement-button" type="submit">Ajouter</button>
    </div>
  </form>
</div>