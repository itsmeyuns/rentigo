<div class="form-container">
  <h3 class="form-title">Ajouter Vidange</h3>
  <form id="add-vidange-form" action="{{route('vidanges.store')}}" method="POST">
    @csrf
    <input type="hidden" name="vehicule_id" value="{{$vehicule->id}}">
    <div class="form-item">
      <label for="matricule">Matricule </label>
      <input type="text" name="matricule" class='readonly-input' id="matricule" readonly value="{{$vehicule->matricule}}">
      <div class="error matricule_error"></div>
    </div>
    <div class="form-item">
      <label for="km_actuel">Km Actuel </label>
      <input type="text" name="km_actuel" id="km_actuel" class='readonly-input' readonly value="{{$vehicule->kilometrage}}">
      <div class="error km_actuel_error"></div>
    </div>
    <div class="form-item">
      <label for="date">Date <span class="star">*</span> </label>
      <input type="date" name="date" id="date">
      <div class="error date_error"></div>
    </div>
    <div class="form-item">
      <label for="type">Type de vidange <span class="star">*</span> </label>
      <input type="text" name="type" id="type">
      <div class="error type_error"></div>
    </div>
    <div class="form-item">
      <label for="km_prochain_vidange">Km Prochain vidange <span class="star">*</span> </label>
      <input type="text" name="km_prochain_vidange" id="km_prochain_vidange" class='readonly-input' readonly>
      <div class="error km_prochain_vidange_error"></div>
    </div>
    <div class="form-item">
      <label for="cout">Coût <span class="star">*</span> </label>
      <input type="text" name="cout" id="cout">
      <div class="error cout_error"></div>
    </div>
    <div class="form-item full-width">
      <label for="observation">Observation</label>
      <textarea name="observation" id="observation"></textarea>
    </div>
    <div class="form-item">
      <button id="add-vidange-button" type="submit">Ajouter</button>
    </div>
  </form>
</div>