let addForm = $('#add-client-form');
let editForm = $('#edit-client-form');
let notification = new Notyf({
  duration: 3500,
  dismissible: true,
  position: {
    x: 'right',
    y: 'top'
  }
})

fetchClients()
$(document).ready(function(){
  addAction()
});


// Hide Delete Modal
$('#cancelButton').on('click', function () {
  $('#DeleteClientModal').parent().hide()
})

$('.ajouter').on('click', function () { 
  $('#AddClientModal').modal('show')
  resetAddClientForm()
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
      console.log(response.clients);
      let clients = response.clients.data
      let links = response.clients.links
      console.log(response.clients);
      $('tbody').html('')
      $.each(clients, function (key, item) {
        $('tbody').append(`
        <tr>
          <td data-label="Nom">${item.nom}</td>
          <td data-label="Prénom">${item.prenom}</td>
          <td data-label="CIN">${item.cin}</td>
          <td data-label="N° Permis">${item.numero_permis}</td>
          <td data-label="Téléphone">${item.telephone}</td>
          <td data-label="Actions">
            <span class="material-icons-round show" data-id="${item.id}">visibility</span>
            <span class="material-icons-round edit" data-id="${item.id}">edit</span>
            <span class="material-icons-round delete" data-id="${item.id}">delete</span> 
          </td>
        </tr>
        `);
      });
      $('#pagination').show()
      $('.details').html(`Page: ${response.clients.current_page} | showing ${response.clients.from} - ${response.clients.to} of ${response.clients.total}`)
      $('#pagination div.links').html('')
      $.each(links, function (index, link) {
        let element = `<a href="${link.url}" class="link" data-page="${link.label}">${link.label}</a>`
        if (index === 0) {
          element = `<a href="${link.url}" class="link prev-page" data-page="${link.label}">
                      <span class="material-icons-round">navigate_before</span>
                    </a>`
        }
        if (index === links.length-1) {
          element = `<a href="${link.url}" class="link next-page" data-page="${link.label}">
                      <span class="material-icons-round">navigate_next</span>
                    </a>`
        }
        $('#pagination div.links').append(element)
      })
      // Add Active Class To Element That Represent Page 1
      $('#pagination .link:nth-child(2)').addClass('active')
      pagination()
      passIdToModal()
      deleteAction()
      editAction()
      showAction()

    },
    error: function(error) {
      console.error(error);
    }
  });
}

function pagination() {
  $('#pagination a').on('click', function (event) {  
    event.preventDefault()
    let page = $(this).attr('href').split('page=')[1]
    paginationFetch(page)
  });

}


function paginationFetch(page) {
  $.ajax({
    method: 'GET',
    url: `/fetch?page=${page}`,
    success: function (response) { 
      let clients = response.clients.data;
      $('.next-page').attr('href', response.clients.next_page_url);
      $('.prev-page').attr('href', response.clients.prev_page_url);
      $('.details').html(`Page: ${response.clients.current_page} | showing ${response.clients.from} - ${response.clients.to} of ${response.clients.total}`)
      $('tbody').html('')
      $.each(clients, function (key, item) {
        $('tbody').append(`
        <tr>
          <td data-label="Nom">${item.nom}</td>
          <td data-label="Prénom">${item.prenom}</td>
          <td data-label="CIN">${item.cin}</td>
          <td data-label="N° Permis">${item.numero_permis}</td>
          <td data-label="Téléphone">${item.telephone}</td>
          <td data-label="Actions">
            <span class="material-icons-round show" data-id="${item.id}">visibility</span>
            <span class="material-icons-round edit" data-id="${item.id}">edit</span>
            <span class="material-icons-round delete" data-id="${item.id}">delete</span> 
          </td>
        </tr>
        `);
      });
      $('.link').removeClass('active')
      $.each($('.link'), function (index, link) {
        ($(link).data('page') == response.clients.current_page ) ? $(link).addClass('active') : $(link).removeClass('active');
      })
    }
  })
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
          notification.error(response.msg)
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
        notification.success(response.success);
        fetchClients()
      } else {
        notification.error(response.msg)
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
          notification.error(response.msg)
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

// Search
$('#rechercher').on('keyup', function () { 
  let value = $(this).val()
  $.ajax({
    type: "GET",
    url: "/clients/search",
    data: {search: value},
    success: function (response) {
      $('tbody').html('')
      $('#pagination').hide()
      if (value) {
        $.each(response.result, function (index, item) { 
          $('tbody').append(`
          <tr>
            <td data-label="Nom">${item.nom}</td>
            <td data-label="Prénom">${item.prenom}</td>
            <td data-label="CIN">${item.cin}</td>
            <td data-label="N° Permis">${item.numero_permis}</td>
            <td data-label="Téléphone">${item.telephone}</td>
            <td data-label="Actions">
              <span class="material-icons-round show" data-id="${item.id}">visibility</span>
              <span class="material-icons-round edit" data-id="${item.id}">edit</span>
              <span class="material-icons-round delete" data-id="${item.id}">delete</span> 
            </td>
          </tr>
          `);
        });
      } else {
        fetchClients()
      }
      passIdToModal()
      deleteAction()
      editAction()
      showAction()
    }
  });


})
// $('#ShowClientModal').modal('show')
// Show Client Card
function showAction() { 
  $('.show').on('click', function () {
    let clientId = $(this).data('id');
    $('#ShowClientModal').modal('show')
    $.ajax({
      method: 'GET',
      url: `/clients/show/${clientId}`,
      success: function (response) {
        console.log(response, clientId);
        if (response.status === 200) {
          $.each(response.client, function (key, value) {
            if (key === 'email' && !value) {
              $(`#show_${key}`).html('#####')
            } else {
              $(`#show_${key}`).html(value)
            }
          });
        }
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
        $('.jquery-modal').hide();
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
  $('input').removeClass('success');
  $('input').removeClass('bounce');
}
