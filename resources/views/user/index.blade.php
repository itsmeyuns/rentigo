@extends('layouts.master')
@section('css')
  <link rel="stylesheet" href="{{ asset('css/table.css') }}">
@endsection
@section('title', 'Utilisateurs')

@section('content')

<div id="users-section">

  {{-- Start Modals --}}

    <div id="AddUserModal" class="modal">
      @include('user.modals.create')
    </div>
    <div id="DeleteUserModal" class="modal delete-modal">
      @include('user.modals.delete')
    </div>
    <div id="EditUserModal" class="modal">
      @include('user.modals.edit')
    </div>
    <div id="ShowUserModal" class="modal show-modal">
      @include('user.modals.show')
    </div>

  {{-- End Modals --}}

  <div class="users-section-header">
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
        <div class="material-icons-round ajouter" id="ajouter-user">
          person_add
        </div>
      </form>
    </div>
  </div>
  <div class="users-section-body">
    <div class="table-container">
      <table class="table">
        <thead>
          <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>CIN</th>
            <th>Téléphone</th>
            <th>Rôle</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
      <div id="users-loader-container" class="loader-container">
        <div class="loader"></div>
      </div>
      <div id="users-no-result" class="no-result">
        <img src="{{asset('pics/no-data.svg')}}" alt="">
        <p class="text">Aucun résultat trouvé</p>
      </div>
    </div>
  </div>
  <div class="users-section-footer">
    <div class="pagination" id="users-pagination">
      <div class="details"></div>
      <div class="links">
        
      </div>
    </div>
  </div>
</div>





@stop
@section('js')
  <script src="{{ asset('js/user/user.js') }}"></script>
  <script src="{{ asset('js/user/ajax.js') }}"></script>
@endsection


