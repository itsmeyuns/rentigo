const addForm = $('#add-client-form');
const editForm = $('#edit-client-form');

$(document).ready(function(){
  fetchClients()

  // Add an event listener to the confirm delete button in the modal
  $('#confirmationButton').on('click', function() {
    // Get the client ID from the hidden
    const clientId = $('#deleteClientId').val();
    // Send an Ajax request to delete the client
    $.ajax({
      url: `/clients/${clientId}`,
      type: 'DELETE',
      success: function(response) {
        $.modal.close();;
        if (response.status === 200) {
          notification.success(response.success);
          fetchClients()
        } else {
          notification.error(response.msg)
        }
      }
    });
  });

  $('.ajouter').on('click', function () { 
    resetAddClientForm()
    $('#AddClientModal').modal({
      fadeDuration: 200
    });
  });

  // Search
  $('#rechercher').on('keyup', function () { 
    const value = $(this).val()
    $.ajax({
      type: "GET",
      url: "/clients/search",
      data: {search: value},
      beforeSend: function() {
        $('tbody').html('')
        $('#no-result').hide()
        $('#clients-pagination').hide()
        $('#loader-container').show();
      },
      success: function (response) {
        if (value) {
          const clients = response.clients.data;
          if (clients.length > 0) {
            // Fill in the table
            $('#no-result').hide()
            fillTable(clients)
            createPaginationLinks(response.clients, 'clients-pagination', paginationFetch)
          } else {
            $('tbody').html('')
            $('#clients-pagination').hide()
            $('#no-result').show()
          }
          $('#loader-container').hide()
        } else {
          fetchClients()
        }
      }
    });
  })

  $(editForm).on('submit',function (e) { 
    e.preventDefault();
    // Get the client ID from the hidden input
    const clientId = $('#editClientId').val()
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
        $.modal.close();
        if (response.status === 200) {
          notification.success(response.success);
          fetchClients()
        } else {
          notification.error(response.msg)
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

  addAction()

});



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
    url: '/clients/fetch',
    type: 'GET',
    beforeSend: function() {
      $('tbody').html('')
      $('#loader-container').show(); // Show the loader when the AJAX request starts
      $('#no-result').hide()
    },
    success: function(response) {
      const clients = response.clients.data
      fillTable(clients)
      createPaginationLinks(response.clients, 'clients-pagination', paginationFetch)
      
      $('#loader-container').hide();
    },
    error: function(error) {
      console.error(error);
    }
  });
}

function paginationFetch(uri) {
  $.ajax({
    method: 'GET',
    url: `clients/${uri}`,
    beforeSend: function() {
      $('tbody').html('')
      $('#no-result').hide()
      $('#loader-container').show();
    },
    success: function (response) { 
      let clients = response.clients.data;
      $('#clients-pagination .next-page').attr('href', response.clients.next_page_url);
      $('#clients-pagination .prev-page').attr('href', response.clients.prev_page_url);
      $('#clients-pagination .details').html(`Page: <b>${response.clients.current_page}</b> | affichant <b>${response.clients.from}</b> - <b>${response.clients.to}</b> de <b>${response.clients.total}</b>`)
      fillTable(clients);
      $('#clients-pagination .link').removeClass('active')
      $.each($('#clients-pagination .link'), function (index, link) {
        ($(link).data('page') == response.clients.current_page ) ? $(link).addClass('active') : $(link).removeClass('active');
      });
      $('#loader-container').hide();
    }
  })
}

function deleteAction() {
  $('.delete').on('click', function () { 
    let clientId = $(this).attr('data-id');
    $.ajax({
      url: `/clients/${clientId}/delete`,
      type: 'GET',
      success: function(response) {
        if (response.status === 200) {
          $('#DeleteClientModal').modal({
      fadeDuration: 200
    });
        } else {
          notification.error(response.msg)
        }
      },
    });
  })
}

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
          $('#EditClientModal').modal({
          fadeDuration: 200
          });
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
          notification.error(response.msg)
        }
      },
    });
  });
}

// Show Client Card
function showAction() { 
  $('.show').on('click', function () {
    let clientId = $(this).data('id');
    $.ajax({
      method: 'GET',
      url: `/clients/${clientId}/show`,
      success: function (response) {
        $('#ShowClientModal').modal({
          fadeDuration: 200
        });
        $.each(response.client, function (key, value) {
          if (key === 'email' && !value) {
            value = '####'
          } else if (key === 'sexe') {
            value = (value === 'H') ? 'Homme' : 'Femme';
          }
          $(`#show_${key}`).html(value);
        });
      },
      error: function (response) {  
        notification.error(response.responseJSON.msg)
      }
    })

  })
}

function addAction() {
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
        resetAddClientForm()
        $.modal.close();;
        fetchClients()
        notification.success(response.success)
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
}

function resetAddClientForm() { 
  $(addForm).find('div.error').text('');
  $(addForm)[0].reset();
  $('input, select').removeClass('success');
  $('input, select').removeClass('bounce');
}

function fillTable(data) {
  $('tbody').html('')
  $.each(data, function (key, item) {
    $('tbody').append(`
    <tr>
      <td data-th="Nom">${item.nom}</td>
      <td data-th="Prénom">${item.prenom}</td>
      <td data-th="CIN">${item.cin}</td>
      <td data-th="N° Permis">${item.numero_permis}</td>
      <td data-th="Téléphone">${item.telephone}</td>
      <td data-th="Actions">
        <span class="material-icons-round show" data-id="${item.id}">visibility</span>
        <span class="material-icons-round edit" data-id="${item.id}">edit</span>
        <span class="material-icons-round delete" data-id="${item.id}">delete</span> 
      </td>
    </tr>
    `);
  });
  defaultTable()
  // Actions
  passIdToModal()
  deleteAction()
  editAction()
  showAction()
}

function defaultTable() {
  let tbodyLenght = $('tbody').children().length;
  for (let i = tbodyLenght; i < 10; i++) {
    $('tbody').append(`
      <tr>
        <td data-th=""></td>
        <td data-th=""></td>
        <td data-th=""></td>
        <td data-th=" "></td>
        <td data-th=" "></td>
        <td data-th=" "> </td>
      </tr> 
    `)
  }
}
