<div class="form-container">
  <h3 class="form-title">Modifier Extra</h3>
  <form id="edit-extra-form" action="{{route('extras.store')}}" method="POST">
    @csrf
    <input type="hidden" id="editExtraId">
    <div class="form-item">
      <label for="edit_nom">nom <span class="star">*</span> </label>
      <input type="text" name="nom" id="edit_nom">
      <div class="error nom_error"></div>
    </div>
    <div class="form-item full-width">
      <button id="edit-extra-button" type="submit">Modifier</button>
    </div>
  </form>
</div>