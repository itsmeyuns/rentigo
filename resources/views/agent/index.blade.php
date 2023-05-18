@extends('layouts.master')
@section('css')
  <link rel="stylesheet" href="{{ asset('css/table.css') }}">
  <link rel="stylesheet" href="{{ asset('css/agents.css') }}">
@endsection
@section('title', 'Agents')

@section('content')

<div id="agents-section">

  {{-- Start Modals --}}

    <div id="AddAgentModal" class="modal">
      @include('agent.modals.create')
    </div>
    <div id="DeleteAgentModal" class="modal delete-modal">
      @include('agent.modals.delete')
    </div>
    <div id="EditAgentModal" class="modal">
      @include('agent.modals.edit')
    </div>
    <div id="ShowAgentModal" class="modal show-modal">
      @include('agent.modals.show')
    </div>

  {{-- End Modals --}}

  <div class="agents-section-header">
    <div class="bar">
      <form action="">
        <div class="input-holder">
          <input type="text" name="rechercher" placeholder="Rechercher" id="rechercher">
          <button type="button">
            <span class="material-icons-round">
              search
            </span>
          </button>
        </div>
        <div class="material-icons-round ajouter" id="ajouter-agent">
          person_add
        </div>
      </form>
    </div>
  </div>
  <div class="agents-section-body">
    <div class="table-container">
      <table class="table">
        <thead>
          <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>CIN</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
      <div id="agents-loader-container" class="loader-container">
        <div class="loader"></div>
      </div>
      <div id="agents-no-result" class="no-result">
        <img src="{{asset('pics/no-data.svg')}}" alt="">
        <p class="text">Aucun résultat trouvé</p>
      </div>
    </div>
  </div>
  <div class="agents-section-footer">
    <div class="pagination" id="agents-pagination">
      <div class="details"></div>
      <div class="links">
        
      </div>
    </div>
  </div>
</div>





@stop
@section('js')
  {{-- <script src="{{ asset('js/agent/agent.js') }}"></script> --}}
  <script src="{{ asset('js/agent/ajax.js') }}"></script>
@endsection


