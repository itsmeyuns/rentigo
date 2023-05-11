const addReservationForm = $('#add-reservation-form');
const reservationsTable = $('.reservations-section tbody')
const editReservationForm = $('#edit-reservation-form')

$(document).ready(function () {

  fetchReservations()

  // Hide Delete Modal
  $('#cancelReservationButton').on('click', function () {
    $.modal.close();
  })

  // Add an event listener to the confirm delete button in the modal
  $('#confirmationReservationButton').on('click', function() {
    // Get the vehicule ID from the hidden
    let reservationId = $('#deleteReservationId').val();
    // Send an Ajax request to delete reservation
    $.ajax({
      url: `/reservations/${reservationId}`,
      type: 'DELETE',
      beforeSend: function () { 
        $.modal.close();
      },
      success: function(response) {
        notification.success(response.success);
        fetchReservations()
      },
      error: function (response) {
        notification.error(response.responseJSON.msg)
      }
    });
  });


  $('#ajouter-reservation').on('click', function () {
    getClients('clients')
    getVehicules('vehicules')
    resetReservationForm(addReservationForm)
    $('#AddReservationModal').modal({
      fadeDuration: 200
    });
  })

  $(editReservationForm).on('submit',function (e) {
    e.preventDefault();
    // Get the reservation ID from the hidden input
    const reservationId = $('#editReservationId').val()
    // Get data from the form
    const formData = new FormData(editReservationForm[0]);
    formData.append('_method', 'put');
    $.ajax({
      type: 'POST',
      url: `/reservations/${reservationId}`,
      data: formData,
      contentType: false,
      processData: false,
      beforeSend:function(){
        $(editReservationForm).find('div.error').text('');
      },
      success: function (response) {
        $.modal.close();
        notification.success(response.msg);
        fetchReservations()
      },
      error: function (response) {
        let errors = response.responseJSON.errors;
        if (errors) {
          $.each(errors, function (field, messages) {
            $('.error.' + field + '_error').html(messages[0]);
            $('.error.' + field + '_error').prev().removeClass('success');
            $('.error.' + field + '_error').prev().addClass('bounce');
          });
        } else {
          $.modal.close();
          notification.error(response.responseJSON.msg)
        }
      }
    });
  });

  $('#resetButton').on('click', function () {  
    fetchReservations();
  })

  $('#rechercher').on('keyup', function () { 
    let value = $(this).val()
      $.ajax({
        type: "GET",
        url: "/reservations/search",
        data: {search: value},
        beforeSend: function() {
          $(reservationsTable).html('')
          $('#reservations-no-result').hide()
          $('#reservations-pagination').hide()
          $('#reservations-loader-container').show();
        },
        success: function (response) {
          if (value) {
            if (response.result.length > 0) {
              // Fill in the table
              fillReservationsTable(response.result)
            } else {
              $(reservationsTable).html('')
              $('#reservations-no-result').show()
            }
            $('#reservations-loader-container').hide()
          } else {
            fetchReservations()
          }
        }
      });
  })

  $('#filter-form').on('submit', function (event) {
    event.preventDefault();
    const formData = $(this).serialize();
    console.log(formData);
    $.ajax({
      type: "GET",
      url: "/reservations/filter",
      data: formData,
      beforeSend: function() {
        $(reservationsTable).html('')
        $('#reservations-loader-container').show();
        $('#reservations-no-result').hide()
        $('#reservations-pagination').hide()
      },
      success: function (response) {
        console.log(response.reservations);
        fillReservationsTable(response.reservations.data)
        // createPaginationLinks(response.reservations, '#reservations-pagination', paginationReservationFetch)
        $('#reservations-loader-container').hide();
      }
    });
  })

  getClients()
  getVehicules()

  addReservationAction()

});

function addReservationAction() {
  addReservationForm.on('submit', function (event) {
    event.preventDefault();
    $.ajax({
      type: 'POST',
      url: $(addReservationForm).attr('action'),
      data: new FormData(addReservationForm[0]),
      processData:false,
      contentType:false,
      beforeSend:function(){
        $(addReservationForm).find('div.error').text('');
      },
      success: function (response) {
        resetReservationForm(addReservationForm)
        $.modal.close();
        fetchReservations()
        notification.success(response.msg)
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
  
  })
}

function getClients(selectClientsId = null, clientID = null) {
  $.ajax({
    type: "GET",
    url: "/clients/fetch",
    success: function (response) {
      const clients =  response.clients.data;
      $(`#${selectClientsId}`).html(`<option value="" disabled selected>Sélectionner un client</option>`);
      $('#clients-list').html('')
      $.each(clients, function (index, value) { 
        $(`#${selectClientsId}`).append(`
          <option value="${value.id}" ${(value.id === clientID) && 'selected'}>${value.nom} ${value.prenom}</option>
        `);

        $('#clients-list').append(`
          <div class="select-option">
            <input type="checkbox" name="client" id="${value.nom}-${index}">
            <label for="${value.nom}-${index}">${value.nom} ${value.prenom}</label>
          </div>
        `)

      });
    }
  });
  console.log($(`#${selectClientsId} option`));
}

function getVehicules(selectVehiculesId = null, vehiculeId = null) {
  $.ajax({
    type: "GET",
    url: "/vehicules/fetch",
    success: function (response) {
      const vehicules =  response.vehicules.data;
      const vehiculesList = $('#vehicules-list');
      $(vehiculesList).html('')
      $(`#${selectVehiculesId}`).html(`<option value="" disabled selected>Sélectionner un véhicule</option>`)
      $.each(vehicules, function (index, value) { 
        $(`#${selectVehiculesId}`).append(`
          <option value="${value.id}" ${(value.id === vehiculeId) && 'selected'}>${value.matricule} - ${value.marque}</option>
        `)

        $(vehiculesList).append(`
          <div class="select-option">
            <input type="checkbox" name="vehicule" id="${value.marque}-${index}">
            <label for="${value.marque}-${index}">${value.matricule} ${value.marque}</label>
          </div>
        `)

      });
    }
  });
}

function resetReservationForm(form) { 
  const formType = $(form).attr('id')
  $(form).find('div.error').text('');
  $('input, select').removeClass('success');
  $('input, select').removeClass('bounce');
  $(form).find('select:not([name="status"])').html('')
  if (formType === 'add-reservation-form') {
    $(form)[0].reset();
  }
}

function fetchReservations() { 
  $.ajax({
    url: `/reservations/fetch`,
    type: 'GET',
    beforeSend: function() {
      $(reservationsTable).html('')
      $('#reservations-loader-container').show();
      $('#reservations-no-result').hide()
    },
    success: function(response) {
      fillReservationsTable(response.reservations.data)
      createPaginationLinks(response.reservations,'#reservations-pagination', paginationReservationFetch)
      $('#filter-form').trigger('reset');
      $('#reservations-loader-container').hide();
    },
    error: function(error) {
      console.error(error.responseJSON);
    }
  });
}

function fillReservationsTable(data) {
  $(reservationsTable).html('')
  $.each(data, function (key, item) {
    $(reservationsTable).append(`
    <tr>
      <td data-th="date réservation">${item.date_reservation}</td>
      <td data-th="client">${item.client.prenom} ${item.client.nom}</td>
      <td data-th="véhicule">${item.vehicule.matricule}-${item.vehicule.marque}</td>
      <td data-th="Date début">${item.date_debut}</td>
      <td data-th="Date fin">${item.date_fin}</td>
      <td data-th="status réservation">${item.status}</td>
      <td data-th="agent">${item.user.prenom} ${item.user.nom}</td>
      <td data-th="Actions">
        <span class="material-icons-round edit edit-reservation" data-id="${item.id}">edit</span>
        <span class="material-icons-round delete delete-reservation" data-id="${item.id}">delete</span> 
      </td>
    </tr>
    `);
  });
  defaultReservationsTable()
  // Actions
  passIdToReservationModal()
  deleteReservationAction()
  editReservationAction()
}

function editReservationAction() {
  $('.edit-reservation').on('click', function() {
    // Get the reservation ID from the hidden input
    let reservationId = $('#editReservationId').val();
    console.log($('#editReservationId'));
    // Send an Ajax request to edit the vehicule
    $.ajax({
      url: `/reservations/${reservationId}/edit`,
      type: 'GET',
      success: function(response) {
        const reservation = response.reservation
        // Reset Errors
        resetReservationForm(editReservationForm);
        getClients('edit_clients',reservation.client_id);
        getVehicules('edit_vehicules', reservation.vehicule_id)
        $('#edit_date_debut').val(`${reservation.date_debut}T${reservation.heure_debut}`);
        $('#edit_date_fin').val(`${reservation.date_fin}T${reservation.heure_fin}`);
        $('#edit_date_reservation').val(`${reservation.date_reservation}`);
        $('#edit_status').val(`${reservation.status}`);
        $('#edit_commentaire').val(`${reservation.commentaire ?? ''}`);
        $('#EditReservationModal').modal({
          fadeDuration: 200
        });
      },
      error: function (response) {
        notification.error(response.responseJSON.msg)
      }
    });
  });
}

function defaultReservationsTable() {
  let tbodyLenght = $(reservationsTable).children().length;
  for (let i = tbodyLenght; i < 10; i++) {
    $(reservationsTable).append(`
      <tr>
        <td data-th=""></td>
        <td data-th=""></td>
        <td data-th=""></td>
        <td data-th=""></td>
        <td data-th=" "></td>
        <td data-th=" "></td>
        <td data-th=" "> </td>
        <td data-th=" "> </td>
      </tr> 
    `)
  }
}

function deleteReservationAction() {
  $('.delete-reservation').on('click', function () { 
    let reservationId = $(this).attr('data-id');
    $.ajax({
      url: `/reservations/${reservationId}/delete`,
      type: 'GET',
      success: function() {
        $('#DeleteReservationModal').modal({
          fadeDuration: 200
        });
      },
      error: function (response) { 
        notification.error(response.responseJSON.msg)
      }
    });
  })
}

function paginationReservationFetch(page) {
  $.ajax({
    method: 'GET',
    url: `/reservations/fetch?page=${page}`,
    beforeSend: function() {
      $(reservationsTable).html('')
      $('#reservations-loader-container').show();
    },
    success: function (response) { 
      const reservations = response.reservations.data;
      $('#reservations-pagination .next-page').attr('href', response.reservations.next_page_url);
      $('#reservations-pagination .prev-page').attr('href', response.reservations.prev_page_url);
      $('#reservations-pagination .details').html(`Page: <b>${response.reservations.current_page}</b> | affichant <b>${response.reservations.from}</b> - <b>${response.reservations.to}</b> de <b>${response.reservations.total}</b>`)
      fillReservationsTable(reservations);
      $('#reservations-pagination .link').removeClass('active')
      $.each($('#reservations-pagination .link'), function (index, link) {
        ($(link).data('page') == response.reservations.current_page ) ? $(link).addClass('active') : $(link).removeClass('active');
      });
      $('#reservations-loader-container').hide();
    }
  })
}

function passIdToReservationModal() { 
  $('.delete-reservation, .edit-reservation').on('click', function () { 
    let id = $(this).attr('data-id');
    // To Delete Modal
    $('#deleteReservationId').val(id);
    // To Edit Modal
    $('#editReservationId').val(id);
  })
}