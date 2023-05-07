<div class="section" id="vidange-section">
  <div id="AddVidangeModal" class="modal">
    @include('vehicule.vidange.modals.create')
  </div>
  <div id="DeleteVidangeModal" class="modal delete-modal">
    @include('vehicule.vidange.modals.delete')
  </div>
  <div id="EditVidangeModal" class="modal">
    @include('vehicule.vidange.modals.edit')
  </div>
  <div class="section-header">
    <h2 class="main-title">Vidange</h2>
    <button id="ajouter-vidange" class="material-icons-round ajouter-button" title="Ajouter Vidange">add_circle</button>
  </div>
  <div class="section-body"> 
    <div id="vidange-loader-container" class="loader-container">
      <div class="loader"></div>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th>Type</th>
          <th>Date</th>
          <th>Km</th>
          <th>Prochain vidange</th>
          <th>Coût</th>
          <th>Observation</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="pagination" id="vidange-pagination">
    <div class="details"></div>
    <div class="links">
    </div>
  </div>
</div>