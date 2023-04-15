@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{ asset('css/clients.css') }}">
@stop
@section('title', 'Ajouter Client')

@section('content')
<div class="form-container">
  <form id="add-client-form" action="{{route('clients.store')}}" method="POST">
    @csrf
    <div class="form-item">
      <label for="nom">Nom <span class="star">*</span> </label>
      <input type="text" name="nom" id="nom">
      <div class="error nom_error"></div>
    </div>
    <div class="form-item">
      <label for="prenom">Prénom <span class="star">*</span> </label>
      <input type="text" name="prenom" id="prenom">
      <div class="error prenom_error"></div>
    </div>
    <div class="form-item">
      <label for="sexe">Sexe <span class="star">*</span></label>
      <select name="sexe" id="sexe">
        <option value="M">M</option>
        <option value="F">F</option>
      </select>
      <div class="error sexe_error"></div>
    </div>
    <div class="form-item">
      <label for="date_naissance">Né(e) le<span class="star">*</span> </label>
      <input type="date" name="date_naissance" id="date_naissance">
      <div class="error date_naissance_error"></div>
    </div>
    <div class="form-item">
      <label for="lieu_naissance">Né(e) à<span class="star">*</span> </label>
      <input type="text" name="lieu_naissance" id="lieu_naissance">
      <div class="error lieu_naissance_error"></div>
    </div>
    <div class="form-item">
      <label for="adresse">Adresse <span class="star">*</span> </label>
      <input type="text" name="adresse" id="adresse">
      <div class="error adresse_error"></div>
    </div>
    <div class="form-item">
      <label for="cin">CIN <span class="star">*</span> </label>
      <input type="text" name="cin" id="cin">
      <div class="error cin_error">Hello</div>
    </div>
    <div class="form-item">
      <label for="numero_permis">N° Permis <span class="star">*</span> </label>
      <input type="text" name="numero_permis" id="numero_permis">
      <div class="error numero_permis_error"></div>
    </div>
    <div class="form-item">
      <label for="telephone">Télephone <span class="star">*</span> </label>
      <input type="text" name="telephone" id="telephone">
      <div class="error telephone_error"></div>
    </div>
    <div class="form-item">
      <label for="email">Email</label>
      <input type="email" name="email" id="email">
      <div class="error email_error"></div>
    </div>
    <div class="form-item full-width">
      <label for="observation">Observation</label>
      <textarea name="observation" id="observation"></textarea>
      <div class="error">
        @error('observation')
          {{$message}}
        @enderror
      </div>

    </div>
    <div class="form-item full-width">
      <button id='add-client'>Ajouter</button>
    </div>
  </form>
</div>
@stop

@section('js')
<script src="{{ asset('js/clients.js') }}"></script>
<script>
  // Ajax Crud
// $(document).ready(function () {
//   $('#add-client-form').submit(function (e) { 
//     // e.preventDefault();
//     var form = this;
//     $.ajax({
//       type: 'post',
//       url: $(form).attr('action'),
//       data: new FormData(form),
//       processData: false,
//       dataType:'json',
//       contentType:false,
//       beforeSend:function(){
//         $(form).find('div.error').text('');
//       },
//       success:function(data) {
//         if(data.code == 0) {
//           $.each(data.error, function(prefix, val){
//               $(form).find('div.'+prefix+'_error').text(val);
//           });
//         } else {
//           $(form)[0].reset();
//           alert(data.msg);
//           // $('#counties-table').DataTable().ajax.reload(null, false);
//           // toastr.success(data.msg);
//         }
//       }
//     });
//   });
// })
</script>
@stop
