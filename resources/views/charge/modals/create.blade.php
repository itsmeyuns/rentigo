<div class="form-container">
  <h3 class="form-title">Ajouter Charge</h3>
  <form class="add-form" id="add-charge-form" action="{{ route('charges.store') }}" method="POST">
    @csrf
    <div class="form-item">
      <label for="date">Date<span class="star">*</span> </label>
      <input type="date" name="date" id="date">
      <div class="error date_error" ></div>
    </div>
    <div class="form-item">
      <label for="type">Type <span class="star">*</span> </label>
      <input type="text" name="type" id="type">
      <div class="error type_error"></div>
    </div>
    <div class="form-item">
      <label for="cout">coût<span class="star">*</span> </label>
      <input type="text" name="cout" id="cout">
      <div class="error cout_error" ></div>
    </div>
    <div class="form-item full-width">
      <label for="observation">Observation</label>
      <textarea name="observation" id="observation"></textarea>
    </div>
    <div class="form-item">
      <button type="submit" id="add-charge-button">Ajouter</button>
    </div>
  </form>
</div>
