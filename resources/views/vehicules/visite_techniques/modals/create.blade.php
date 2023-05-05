<div class="form-container">
  <h3 class="form-title">Ajouter Visite Technique</h3>
  <form id="add-visite-technique-form" action="{{route('visite-techniques.store')}}" method="POST">
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
      <label for="date_debut_visite_technique">Date début<span class="star">*</span> </label>
      <input type="date" name="date_debut" id="date_debut_visite_technique">
      <div class="error date_debut_error"></div>
    </div>
    <div class="form-item">
      <label for="date_fin_visite_technique">Date Fin<span class="star">*</span> </label>
      <input type="date" name="date_fin" id="date_fin_visite_technique">
      <div class="error date_fin_error"></div>
    </div>
    <div class="form-item">
      <button id="add-visite-technique-button" type="submit">Ajouter</button>
    </div>
  </form>
</div>