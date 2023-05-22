<div class="form-container">
  <h3 class="form-title">Modifier Charge</h3>
  <form id="edit-charge-form" action="{{ route('charges.store') }}" method="POST">
    @csrf
    <input type="hidden" id="editChargeId">
    <div class="form-item">
      <label for="edit_date">Date<span class="star">*</span> </label>
      <input type="date" name="date" id="edit_date">
      <div class="error date_error" ></div>
    </div>
    <div class="form-item">
      <label for="edit_type">Type <span class="star">*</span> </label>
      <input type="text" name="type" id="edit_type">
      <div class="error type_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_cout">coût<span class="star">*</span> </label>
      <input type="text" name="cout" id="edit_cout">
      <div class="error cout_error" ></div>
    </div>
    <div class="form-item full-width">
      <label for="edit_observation">Observation</label>
      <textarea name="observation" id="edit_observation"></textarea>
    </div>
    <div class="form-item">
      <button type="submit" id="edit-charge-button">Ajouter</button>
    </div>
  </form>
</div>
