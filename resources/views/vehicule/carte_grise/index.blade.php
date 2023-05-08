<div class="section" id="carte-grise-section">
  <div id="AddCarteGModal" class="modal">
    @include('vehicule.carte_grise.modals.create')
  </div>
  <div id="DeleteCarteGModal" class="modal delete-modal">
    @include('vehicule.carte_grise.modals.delete')
  </div>
  <div id="EditCarteGModal" class="modal">
    @include('vehicule.carte_grise.modals.edit')
  </div>
  <div class="section-header">
    <h2 class="main-title">Carte Grise</h2>
    <button id="ajouter-carte-g" class="material-icons-round ajouter-button" title="Ajouter Carte Grise">add_circle</button>
  </div>
  <div class="section-body"> 
    <div id="carte-g-loader-container" class="loader-container">
      <div class="loader"></div>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th>Date début</th>
          <th>Date fin</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="pagination" id="carte-g-pagination">
    <div class="details"></div>
    <div class="links">
    </div>
  </div>
</div>