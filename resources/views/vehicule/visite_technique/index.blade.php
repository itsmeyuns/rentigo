<div class="section" id="visite-technique-section">
  <div id="AddVisiteTechModal" class="modal">
    @include('vehicule.visite_technique.modals.create')
  </div>
  <div id="DeleteVisiteTechModal" class="modal delete-modal">
    @include('vehicule.visite_technique.modals.delete')
  </div>
  <div id="EditVisiteTechModal" class="modal">
    @include('vehicule.visite_technique.modals.edit')
  </div>
  <div class="section-header">
    <h2 class="main-title">Visite Technique</h2>
    <button id="ajouter-visite-tech" class="material-icons-round ajouter-button" title="Ajouter Visite Technique">add_circle</button>
  </div>
  <div class="section-body"> 
    <div id="visite-tech-loader-container" class="loader-container">
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
  <div class="pagination" id="visite-tech-pagination">
    <div class="details"></div>
    <div class="links">
    </div>
  </div>
</div>