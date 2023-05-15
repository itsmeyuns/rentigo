<div class="form-container">
  <h3 class="form-title">Ajouter Contrat</h3>
  <form id="add-contrat-form" action="{{route('contrats.store')}}" method="POST">
    @csrf
    <div class="form-item">
      <label for="date_contrat">Date contrat <span class="star">*</span> </label>
      <input type="date" name="date_contrat" id="date_contrat" class="readonly-input" value="{{ date('Y-m-d') }}" readonly>
      <div class="error date_contrat_error"></div>
    </div>
    <div class="form-item">
      <label for="clients">client <span class="star">*</span> </label>
      <select name="client_id" id="clients">
      </select>
      <div class="error client_id_error"></div>
    </div>
    <div class="form-item">
      <label for="vehicules">vehicule <span class="star">*</span> </label>
      <select name="vehicule_id" id="vehicules">
      </select>
      <div class="error vehicule_id_error"></div>
    </div>
    <div class="form-item">
      <label for="prix_location">Prix Location<span class="star">*</span> </label>
      <input type="text" name="prix_location" id="prix_location" data-label="prix_location" class="readonly-input" readonly>
      <div class="error prix_location_error"></div>
    </div>
    <div class="form-item">
      <label for="date_debut">Date début <span class="star">*</span> </label>
      <input type="datetime-local" name="date_debut" id="date_debut">
      <div class="error date_debut_error"></div>
    </div>
    <div class="form-item">
      <label for="date_fin">Date fin <span class="star">*</span> </label>
      <input type="datetime-local" name="date_fin" id="date_fin">
      <div class="error date_fin_error"></div>
    </div>
    <div class="form-item">
      <label for="montant">Montant <span class="star">*</span> </label>
      <input type="text" name="montant" id="montant" class="readonly-input" readonly value="">
      <div class="error montant_error"></div>
    </div>
    <div class="form-item full-width">
      <button id="add-contrat-button" type="submit">Ajouter</button>
    </div>
  </form>
</div>