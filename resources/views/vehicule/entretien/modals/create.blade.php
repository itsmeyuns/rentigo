<div class="form-container">
  <h3 class="form-title">Ajouter Entrentien</h3>
  <form id="add-entretien-form" action="{{route('entretiens.store')}}" method="POST">
    @csrf
    <input type="hidden" name="vehicule_id" value="{{$vehicule->id}}">
    <div class="form-item">
      <label for="matricule">Matricule </label>
      <input type="text" name="matricule" class='readonly-input' id="matricule" readonly value="{{$vehicule->matricule}}">
      <div class="error matricule_error"></div>
    </div>
    <div class="form-item">
      <label for="km_actuel_entretien">Km Actuel </label>
      <input type="text" name="km_actuel" id="km_actuel_entretien" class='readonly-input' readonly value="{{$vehicule->kilometrage}}">
      <div class="error km_actuel_error"></div>
    </div>
    <div class="form-item">
      <label for="date_entretien">Date <span class="star">*</span> </label>
      <input type="date" name="date" id="date_entretien">
      <div class="error date_error"></div>
    </div>
    <div class="form-item">
      <label for="type_entretien">Type d'entretien <span class="star">*</span> </label>
      <input type="text" name="type" id="type_entretien">
      <div class="error type_error"></div>
    </div>
    <div class="form-item">
      <label for="cout_entretien">Coût <span class="star">*</span> </label>
      <input type="text" name="cout" id="cout_entretien">
      <div class="error cout_error"></div>
    </div>
    <div class="form-item full-width">
      <label for="observation_entretien">Observation</label>
      <textarea name="observation" id="observation_entretien"></textarea>
    </div>
    <div class="form-item">
      <button id="add-entretien-button" type="submit">Ajouter</button>
    </div>
  </form>
</div>