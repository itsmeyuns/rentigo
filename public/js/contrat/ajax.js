const addContratForm = $('#add-contrat-form');
const editContratForm = $('#edit-contrat-form');
const contratsTable = $('.contrats-section tbody');


$(document).ready(function () {

  fetchContrats()

  // Hide Delete Modal
  $('#cancelContratButton').on('click', function () {
    $.modal.close();
  })

  // Add an event listener to the confirm delete button in the modal
  $('#confirmationContratButton').on('click', function() {
    // Get the vehicule ID from the hidden
    const contratId = $('#deleteContratId').val();
    console.log(contratId);
    // Send an Ajax request to delete Contrat
    $.ajax({
      url: `/contrats/${contratId}`,
      type: 'DELETE',
      beforeSend: function () { 
        $.modal.close();
      },
      success: function(response) {
        notification.success(response.success);
        fetchContrats()
      },
      error: function (response) {
        notification.error(response.responseJSON.msg)
      }
    });
  });

  $('#ajouter-contrat').on('click', function () {
    resetContratForm(addContratForm)
    getClients('clients')
    getVehiculesDispo('vehicules')  
    $('#AddContratModal').modal({
      fadeDuration: 200
    })
  })

  $('#vehicules, #edit_vehicules').on('change', function () {
    const vehiculeId = $(this).val()
    $.ajax({
      method: 'GET',
      url: `/vehicules/${vehiculeId}/get-prix-location`,
      success: function (response) {  
        $('#prix_location, #edit_prix_location').val(response.prix_location)
      },
      error: function (response) {  
        $('.vehicule_id_error').text(response.responseJSON.error)
      }
    })
  })

  $(editContratForm).on('submit', function (event) {
    event.preventDefault();
    // Get the contrat ID from the hidden input
    const contratId = $('#editContratId').val()
    // Get data from the form
    const formData = new FormData(this);
    formData.append('_method', 'put');
    $.ajax({
      type: "POST",
      url: `/contrats/${contratId}`,
      data: formData,
      contentType: false,
      processData: false,
      beforeSend:function(){
        $(this).find('div.error').text('');
      },
      success: function (response) {
        $.modal.close();
        notification.success(response.msg);
        fetchContrats()
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

  })

  $('#resetButton').on('click', function () {  
    fetchContrats();
  })

  // Search
  $('#rechercher').on('keyup', function () { 
    let value = $(this).val()
      $.ajax({
        type: "GET",
        url: "/contrats/search",
        data: {search: value},
        beforeSend: function() {
          $(contratsTable).html('')
          $('#contrats-no-result').hide()
          $('#contrats-pagination').hide()
          $('#contrats-loader-container').show();
        },
        success: function (response) {
          if (value) {
            const contrats = response.contrats.data;
            if (contrats.length > 0) {
              // Fill in the table
              fillContratsTable(contrats)
              createPaginationLinks(response.contrats, 'contrats-pagination', paginationContratsFetch)
            } else {
              $(contratsTable).html('')
              $('#contrats-no-result').show()
            }
            $('#contrats-loader-container').hide()
          } else {
            fetchContrats()
          }
        }
      });
  })

  // Date Range
  $('#filter-form').on('submit', function (event) {
    event.preventDefault();
    const formData = $(this).serialize();
    console.log(formData);
    $.ajax({
      type: "GET",
      url: "/contrats/filter",
      data: formData,
      beforeSend: function() {
        $(contratsTable).html('')
        $('#contrats-loader-container').show();
        $('#contrats-no-result').hide()
        $('#contrats-pagination').hide()
      },
      success: function (response) {
        console.log(response.contrats);
        fillContratsTable(response.contrats.data)
        createPaginationLinks(response.contrats, 'contrats-pagination', paginationContratsFetch)
        $('#contrats-loader-container').hide();
      }
    });
  })

  addContratAction()
});


function getVehiculesDispo(selectVehiculesId = null, vehiculeId = null, vehiculeObject = null) {
  $.ajax({
    type: "GET",
    url: "/vehicules/disponible",
    success: function (response) {
      const vehicules =  response.vehicules;
      $(`#${selectVehiculesId}`).html(`<option value="" disabled selected>Sélectionner un véhicule</option>`)
      $.each(vehicules, function (index, value) { 
        $(`#${selectVehiculesId}`).append(`
          <option value="${value.id}" ${(value.id === vehiculeId) && 'selected'}>${value.matricule} - ${value.marque}</option>
        `)
      });
      if (vehiculeObject) {
        $(`#${selectVehiculesId}`).append(`<option value="${vehiculeObject.id}" selected>${vehiculeObject.matricule} - ${vehiculeObject.marque}</option>`)
        $(`#edit_prix_location`).val(vehiculeObject.prix_location)
      }
    }
  });
}

function addContratAction() {
  addContratForm.on('submit', function (event) {
    event.preventDefault();
    $.ajax({
      type: 'POST',
      url: $(this).attr('action'),
      data: new FormData(this),
      processData:false,
      contentType:false,
      beforeSend:function(){
        $(this).find('div.error').text('');
      },
      success: function (response) {
        resetContratForm(this)
        $.modal.close();
        fetchContrats()
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
    })
  })
}

function fetchContrats() { 
  $.ajax({
    url: `/contrats/fetch`,
    type: 'GET',
    beforeSend: function() {
      $(contratsTable).html('')
      $('#contrats-loader-container').show();
      $('#contrats-no-result').hide()
    },
    success: function(response) {
      fillContratsTable(response.contrats.data)
      createPaginationLinks(response.contrats,'contrats-pagination', paginationContratsFetch)
      $('#contrats-loader-container').hide();
    },
    error: function(error) {
      console.error(error.responseJSON);
    }
  });
}

function paginationContratsFetch(uri) {
  $.ajax({
    method: 'GET',
    url: `/contrats/${uri}`,
    beforeSend: function() {
      $(contratsTable).html('')
      $('#contrats-loader-container').show();
    },
    success: function (response) { 
      const contrats = response.contrats.data;
      $('#contrats-pagination .next-page').attr('href', response.contrats.next_page_url);
      $('#contrats-pagination .prev-page').attr('href', response.contrats.prev_page_url);
      $('#contrats-pagination .details').html(`Page: <b>${response.contrats.current_page}</b> | affichant <b>${response.contrats.from}</b> - <b>${response.contrats.to}</b> de <b>${response.contrats.total}</b>`)
      fillContratsTable(contrats);
      $('#contrats-pagination .link').removeClass('active')
      $.each($('#contrats-pagination .link'), function (index, link) {
        ($(link).data('page') == response.contrats.current_page ) ? $(link).addClass('active') : $(link).removeClass('active');
      });
      $('#contrats-loader-container').hide();
    }
  })
}

function fillContratsTable(data) {
  $(contratsTable).html('')
  $.each(data, function (key, item) {
    $(contratsTable).append(`
    <tr>
      <td data-th="N° contrat">${item.id}</td>
      <td data-th="Date contrat">${item.date_contrat}</td>
      <td data-th="Date départ">${item.date_debut}</td>
      <td data-th="Date arrivée">${item.date_fin}</td>
      <td data-th="Durée">${dateDiffDays(item.date_debut, item.date_fin)}</td>
      <td data-th="Client">${item.client.prenom} ${item.client.nom}</td>
      <td data-th="Véhicule">${item.vehicule.matricule} - ${item.vehicule.marque}</td>
      <td data-th="Agent">${item.user.prenom} ${item.user.nom}</td>
      <td data-th="Actions" class='actions'>
        <span class="material-icons-round edit edit-contrat" data-id="${item.id}">
          edit
        </span>
        <span class="material-icons-round delete delete-contrat" data-id="${item.id}">
          delete
        </span>
        <div class="material-icons-round more-icon">
          more_vert
          <ul class="more-list">
            <li>
              <span class="material-icons-round">
                autorenew
              </span>
              <a href="">Pronologation</a>
            </li>
            <li>
              <span class="material-icons-round">
                paid
              </span>
              <a href="contrats/${item.id}/reglements">Réglement</a>
            </li>
            <li>
              <span class="material-icons-round">
                print
              </span>
              <a href="contrats/${item.id}/imprimer">Imprimer</a>
            </li>
          </ul>
        </div>
      </td>
    </tr>
    `);
  });
  defaultContratsTable()
  // Actions
  passIdToContratModal()
  deleteContratAction()
  editContratAction()

  $('.more-icon').each(function(index) {
    $(this).on('click', function() {
      const moreList = $(this).children(':first');
      $('.more-icon').each(function(i) {
        // If the index of the current element matches the clicked element
        if (index == i) {
          moreList.toggleClass('show');
        } else {
          $(this).children(':first').removeClass('show');
        }
      });
    });
  });

}


function passIdToContratModal() {  
  $('.delete-contrat, .edit-contrat').on('click', function () { 
    let id = $(this).attr('data-id');
    // To Delete Modal
    $('#deleteContratId').val(id);
    // To Edit Modal
    $('#editContratId').val(id);
  })
}

function deleteContratAction() {
  $('.delete-contrat').on('click', function () { 
    const contratId = $(this).attr('data-id');
    $.ajax({
      url: `/contrats/${contratId}/delete`,
      type: 'GET',
      success: function() {
        $('#DeleteContratModal').modal({
          fadeDuration: 200
        });
      },
      error: function (response) { 
        notification.error(response.responseJSON.msg)
      }
    });
  })
}

function editContratAction() {
  $('.edit-contrat').on('click', function() {
    // Get the contrat ID from the hidden input
    let contratId = $('#editContratId').val();
    // Send an Ajax request to edit the vehicule
    $.ajax({
      url: `/contrats/${contratId}/edit`,
      type: 'GET',
      success: function(response) {
        const contrat = response.contrat
        // Reset Errors
        resetContratForm(editContratForm);
        getClients('edit_clients',contrat.client_id);
        getVehiculesDispo('edit_vehicules', contrat.vehicule_id, response.contrat.vehicule)
        $('#edit_date_debut').val(`${contrat.date_debut}T${contrat.heure_debut}`);
        $('#edit_date_fin').val(`${contrat.date_fin}T${contrat.heure_fin}`);
        $('#edit_date_contrat').val(`${contrat.date_contrat}`);
        $('#edit_montant').val(`${contrat.montant}`);
        $('#EditContratModal').modal({
          fadeDuration: 200
        });
      },
      error: function (response) {
        notification.error(response.responseJSON.msg)
      }
    });
  });
}

function defaultContratsTable() {
  let tbodyLenght = $(contratsTable).children().length;
  for (let i = tbodyLenght; i < 10; i++) {
    $(contratsTable).append(`
      <tr>
        <td data-th=""></td>
        <td data-th=""></td>
        <td data-th=""></td>
        <td data-th=""></td>
        <td data-th=" "></td>
        <td data-th=" "></td>
        <td data-th=" "> </td>
        <td data-th=" "> </td>
        <td data-th=" "> </td>
      </tr> 
    `)
  }
}

function resetContratForm(form) { 
  const formType = $(form).attr('id')
  $(form).find('div.error').text('');
  $('input, select').removeClass('success');
  $('input, select').removeClass('bounce');
  $(form).find('select:not([name="status"])').html('')
  if (formType === 'add-contrat-form') {
    $(form)[0].reset();
  }
}