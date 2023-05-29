<div class="form-container">
  <h3 class="form-title">Ajouter Extra</h3>
  <form id="add-extra-form" action="{{route('extras.store')}}" method="POST">
    @csrf
    <div class="form-item">
      <label for="nom">nom <span class="star">*</span> </label>
      <input type="text" name="nom" id="nom">
      <div class="error nom_error"></div>
    </div>
    <div class="form-item full-width">
      <button id="add-vehicule-button" type="submit">Ajouter</button>
    </div>
  </form>
</div>