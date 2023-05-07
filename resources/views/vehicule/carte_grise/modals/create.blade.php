<div class="form-container">
  <h3 class="form-title">Ajouter Carte Grise</h3>
  <form id="add-carte-g-form" action="{{route('carte-grises.store')}}" method="POST">
    @csrf
    <input type="hidden" name="vehicule_id" value="{{$vehicule->id}}">
    <div class="form-item">
      <label for="matricule">Matricule </label>
      <input type="text" name="matricule" class='readonly-input' id="matricule" readonly value="{{$vehicule->matricule}}">
      <div class="error matricule_error"></div>
    </div>
    <div class="form-item">
      <label for="marque">Marque </label>
      <input type="text" name="marque" id="marque" class='readonly-input' readonly value="{{$vehicule->marque}}">
      <div class="error km_actuel_error"></div>
    </div>
    <div class="form-item">
      <label for="date_debut_carte_grise">Date début<span class="star">*</span> </label>
      <input type="date" name="date_debut" id="date_debut_carte_grise">
      <div class="error date_debut_error"></div>
    </div>
    <div class="form-item">
      <label for="date_fin_carte_grise">Date Fin<span class="star">*</span> </label>
      <input type="date" name="date_fin" id="date_fin_carte_grise">
      <div class="error date_fin_error"></div>
    </div>
    <div class="form-item">
      <button id="add-carte-g-button" type="submit">Ajouter</button>
    </div>
  </form>
</div>