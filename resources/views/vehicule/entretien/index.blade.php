<div class="section" id="entretien-section">
  <div id="AddEntretienModal" class="modal">
    @include('vehicule.entretien.modals.create')
  </div>
  <div id="DeleteEntretienModal" class="modal delete-modal">
    @include('vehicule.entretien.modals.delete')
  </div>
  <div id="EditEntretienModal" class="modal">
    @include('vehicule.entretien.modals.edit')
  </div>
  <div class="section-header">
    <h2 class="main-title">Entretien</h2>
    <button id="ajouter-entretien" class="material-icons-round ajouter-button" title="Ajouter Entretien">add_circle</button>
  </div>
  <div class="section-body"> 
    <div id="entretien-loader-container" class="loader-container">
      <div class="loader"></div>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th>Type</th>
          <th>Date</th>
          <th>Km</th>
          <th>Coût</th>
          <th>Observation</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="pagination" id="entretien-pagination">
    <div class="details"></div>
    <div class="links">
    </div>
  </div>
</div>