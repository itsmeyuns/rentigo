<div class="form-container">
  <h3 class="form-title">Modifier Visite Technique</h3>
  <form id="edit-visite-technique-form" action="{{route('visite-techniques.store')}}" method="POST">
    @csrf
    <input type="hidden" id="editVisitTechId">
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
      <label for="edit_date_debut_visite_technique">Date début<span class="star">*</span> </label>
      <input type="date" name="date_debut" id="edit_date_debut_visite_technique">
      <div class="error date_debut_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_date_fin_visite_technique">Date Fin<span class="star">*</span> </label>
      <input type="date" name="date_fin" id="edit_date_fin_visite_technique">
      <div class="error date_fin_error"></div>
    </div>
    <div class="form-item">
      <button id="edit-visite-technique-button" type="submit">Ajouter</button>
    </div>
  </form>
</div>