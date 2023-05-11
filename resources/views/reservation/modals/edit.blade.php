<div class="form-container">
  <h3 class="form-title">Modifier Réservation</h3>
  <form id="edit-reservation-form" method="POST">
    @csrf
    <input type="hidden" name="id" id="editReservationId">
    <div class="form-item">
      <label for="edit_date_reservation">Date Réservation <span class="star">*</span> </label>
      <input type="date" name="date_reservation" id="edit_date_reservation" class="readonly-input" readonly>
      <div class="error date_reservation_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_clients">client <span class="star">*</span> </label>
      <select name="client_id" id="edit_clients">
      </select>
      <div class="error client_id_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_vehicules">vehicule <span class="star">*</span> </label>
      <select name="vehicule_id" id="edit_vehicules">
      </select>
      <div class="error vehicule_id_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_date_debut">Date début <span class="star">*</span> </label>
      <input type="datetime-local" name="date_debut" id="edit_date_debut">
      <div class="error date_debut_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_date_fin">Date fin <span class="star">*</span> </label>
      <input type="datetime-local" name="date_fin" id="edit_date_fin">
      <div class="error date_fin_error"></div>
    </div>
    <div class="form-item">
      <label for="edit_status">status réservation <span class="star">*</span> </label>
      <select name="status" id="edit_status">
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
      <label for="edit_commentaire">commentaire</label>
      <textarea name="commentaire" id="edit_commentaire"></textarea>
    </div>
    <div class="form-item">
      <button id="edit-reservation-button" type="submit">Modifier</button>
    </div>
  </form>
</div>