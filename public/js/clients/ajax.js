let addForm = $('#add-client-form');
let editForm = $('#edit-client-form');

toastr.options = {
  "closeButton" : true,
  "progressBar" : true
};
fetchClients()
$(document).ready(function(){
  $(addForm).on('submit',function (e) { 
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: $(addForm).attr('action'),
      data: new FormData(addForm[0]),
      processData:false,
      contentType:false,
      beforeSend:function(){
        $(addForm).find('div.error').text('');
      },
      success: function (response) {
        $(addForm)[0].reset();
        $('input').removeClass('success');
        $('input').removeClass('bounce');
        $('.jquery-modal').hide();
        fetchClients()
        toastr.success(response.success);
      },
      error: function (xhr) {
        let errors = xhr.responseJSON.errors;
        $.each(errors, function (field, messages) {
          $('.error.' + field + '_error').html(messages[0]);
          $('.error.' + field + '_error').prev().removeClass('success');
          $('.error.' + field + '_error').prev().addClass('bounce');
        });
      }
    });
  });
});







// Hide Delete Modal
$('#cancelButton').on('click', function () {
  $('#DeleteClientModal').parent().hide()
})

$('.ajouter').on('click', function () { 
  $('#AddClientModal').modal('show')
})


function passIdToModal() { 
  $('.delete, .edit').on('click', function () { 
    let id = $(this).attr('data-id');
    // To Delete Modal
    $('#deleteClientId').val(id);
    // To Edit Modal
    $('#editClientId').val(id);
  })
}

function fetchClients() { 
  $.ajax({
    url: '/fetch',
    type: 'GET',
    success: function(response) {
      $('tbody').html('')
      $.each(response.clients.data, function (key, item) {
        $('tbody').append(`
        <tr>
          <td data-label="Nom">${item.nom}</td>
          <td data-label="Prénom">${item.prenom}</td>
          <td data-label="CIN">${item.cin}</td>
          <td data-label="N° Permis">${item.numero_permis}</td>
          <td data-label="Téléphone">${item.telephone}</td>
          <td data-label="Actions">
            <span href="/clients/{client}" class="material-icons-round show">visibility</span>
            <span class="material-icons-round edit" data-id="${item.id}">edit</span>
            <span class="material-icons-round delete" data-id="${item.id}">delete</span> 
          </td>
        </tr>
        `);
      });

      passIdToModal()
      deleteAction()
      editAction()

    },
    error: function(error) {
      console.error(error);
    }
  });
}

function deleteAction() {
  $('.delete').on('click', function () { 
    let clientId = $(this).data('id');
    $.ajax({
      url: `/clients/${clientId}/delete`,
      type: 'GET',
      success: function(response) {
        if (response.status === 200) {
          $('#DeleteClientModal').modal('show')
        } else {
          toastr.error(response.msg)
        }
      },
    });
  })
}

// Add an event listener to the confirm delete button in the modal
$('#confirmationButton').on('click', function() {
  // Get the client ID from the hidden
  let clientId = $('#deleteClientId').val();
  // Send an Ajax request to delete the client
  $.ajax({
    url: '/clients/'+clientId,
    type: 'DELETE',
    success: function(response) {
      $('.jquery-modal').hide();
      if (response.status === 200) {
        toastr.success(response.success);
        fetchClients()
      } else {
        toastr.error(response.msg)
      }
    }
  });
});

function editAction() { 
  $('.edit').on('click', function() {

    // Get the client ID from the hidden input
    let clientId = $('#editClientId').val();
    let editForm = $('#edit-client-form')
    // Send an Ajax request to edit the client
    $.ajax({
      url: `/clients/${clientId}/edit`,
      type: 'GET',
      success: function(response) {
        if (response.status === 200) {
          $('#EditClientModal').modal('show')
          // Reset Errors
          editForm.find('div.error').text('');

          // Update the form fields with the response data
          $('#edit_nom').val(response.client.nom);
          $('#edit_prenom').val(response.client.prenom);
          $('#edit_sexe').val(response.client.sexe);
          $('#edit_date_naissance').val(response.client.date_naissance);
          $('#edit_lieu_naissance').val(response.client.lieu_naissance);
          $('#edit_adresse').val(response.client.adresse);
          $('#edit_cin').val(response.client.cin);
          $('#edit_numero_permis').val(response.client.numero_permis);
          $('#edit_telephone').val(response.client.telephone);
          $('#edit_email').val(response.client.email);
          $('#edit_observation').val(response.client.observation);
        } else {
          toastr.error(response.msg)
        }
      },
    });
  });
}

$(editForm).on('submit',function (e) { 
  e.preventDefault();
  // Get the client ID from the hidden input
  let clientId = $('#editClientId').val()
  // Get data from the form
  let formData = {
    nom : $('#edit_nom').val(),
    prenom : $('#edit_prenom').val(),
    sexe : $('#edit_sexe').val(),
    date_naissance : $('#edit_date_naissance').val(),
    lieu_naissance : $('#edit_lieu_naissance').val(),
    adresse : $('#edit_adresse').val(),
    cin : $('#edit_cin').val(),
    numero_permis : $('#edit_numero_permis').val(),
    telephone : $('#edit_telephone').val(),
    email : $('#edit_email').val(),
    observation : $('#edit_observation').val(),
  }
  $.ajax({
    type: 'PATCH',
    url: `/clients/${clientId}`,
    data: formData,
    dataType: 'json',
    beforeSend:function(){
      $(editForm).find('div.error').text('');
    },
    success: function (response) {
      $('.jquery-modal').hide();
      if (response.status === 200) {
        toastr.success(response.success);
        fetchClients()
      } else {
        toastr.error(response.msg)
      }
    },
    error: function (xhr) {
      let errors = xhr.responseJSON.errors;
      $.each(errors, function (field, messages) {
        $('.error.' + field + '_error').html(messages[0]);
        $('.error.' + field + '_error').prev().removeClass('success');
        $('.error.' + field + '_error').prev().addClass('bounce');
      });
    }
  });
});