<div class="section"id="assurance-section">
  <div id="AddAssuranceModal" class="modal">
    @include('vehicule.assurance.modals.create')
  </div>
  <div id="DeleteAssuranceModal" class="modal delete-modal">
    @include('vehicule.assurance.modals.delete')
  </div>
  <div id="EditAssuranceModal" class="modal">
    @include('vehicule.assurance.modals.edit')
  </div>
  <div class="section-header">
    <h2 class="main-title">Assurance</h2>
    <button id="ajouter-assurance" class="material-icons-round ajouter-button" title="Ajouter Assurance">add_circle</button>
  </div>
  <div class="section-body"> 
    <div id="assurance-loader-container" class="loader-container">
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
  <div class="pagination" id="assurance-pagination">
    <div class="details"></div>
    <div class="links">
    </div>
  </div>
</div>