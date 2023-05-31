<div class="form-container">
  <h3 class="form-title">Ajouter Réservation</h3>
  <form id="add-reservation-form" action="{{route('reservations.store')}}" method="POST">
    @csrf
    <div class="form-item">
      <label for="date_reservation">Date Réservation <span class="star">*</span> </label>
      <input type="date" name="date_reservation" id="date_reservation" class="readonly-input" value="{{ date('Y-m-d') }}" readonly>
      <div class="error date_reservation_error"></div>
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
      <label for="date_debut">Date début <span class="star">*</span> </label>
      <input type="datetime-local" name="date_debut" id="date_debut" value="{{ now()->format('Y-m-d\TH:i') }}">
      <div class="error date_debut_error"></div>
    </div>
    <div class="form-item">
      <label for="date_fin">Date fin <span class="star">*</span> </label>
      <input type="datetime-local" name="date_fin" id="date_fin">
      <div class="error date_fin_error"></div>
    </div>
    <div class="form-item">
      <label for="status">status réservation <span class="star">*</span> </label>
      <select name="status" id="status">
        <option value="" disabled selected>Choisir...</option>
        <option value="En attente">En attente</option>
        <option value="Confirmée">Confirmée</option>
        <option value="Annulée">Annulée</option>
        <option value="Terminée">Terminée</option>
        <option value="En cours">En cours</option>
      </select>
      <div class="error status_error"></div>
    </div>
    <div class="form-item full-width">
      <label for="commentaire">commentaire</label>
      <textarea name="commentaire" id="commentaire"></textarea>
    </div>
    <div class="form-item">
      <button id="add-reservation-button" type="submit">Ajouter</button>
    </div>
  </form>
</div>