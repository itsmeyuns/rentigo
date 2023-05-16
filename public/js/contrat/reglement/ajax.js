const addReglementForm = $('#add-reglement-form');
const editReglementForm = $('#edit-reglement-form');
const reglementsTable = $('#reglements-section tbody');
const contratId = $('#reglements-section').data('contrat-id');

$(document).ready(function () {
  fetchReglements()

  // Hide Delete Modal
  $('#cancelReglementButton').on('click', function () {
    $.modal.close();
  })

  // Add an event listener to the confirm delete button in the modal
  $('#confirmationReglementButton').on('click', function() {
    // Get the vehicule ID from the hidden
    const reglementId = $('#deleteReglementId').val();
    // Send an Ajax request to delete Contrat
    $.ajax({
      url: `/reglements/${reglementId}`,
      type: 'DELETE',
      beforeSend: function () { 
        $.modal.close();
      },
      success: function(response) {
        notification.success(response.success);
        fetchReglements()
      },
      error: function (response) {
        notification.error(response.responseJSON.msg)
      }
    });
  });

  $('#ajouter-reglement').on('click', function () {
    resetReglementForm(addReglementForm)
    $('#AddReglementModal').modal({
      fadeDuration: 200
    })
  })

  $(editReglementForm).on('submit', function (event) {
    event.preventDefault();
    // Get the reglement ID from the hidden input
    const reglementId = $('#editReglementId').val()
    // Get data from the form
    const formData = new FormData(this);
    formData.append('_method', 'put');
    $.ajax({
      type: "POST",
      url: `/reglements/${reglementId}`,
      data: formData,
      contentType: false,
      processData: false,
      beforeSend:function(){
        $(this).find('div.error').text('');
      },
      success: function (response) {
        $.modal.close();
        notification.success(response.msg);
        fetchReglements()
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


  addReglementAction()

});

function addReglementAction() {
  addReglementForm.on('submit', function (event) {
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
        resetReglementForm(this)
        $.modal.close();
        fetchReglements()
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


function fetchReglements() {  
  $.ajax({
    url: `/reglements/${contratId}/fetch`,
    type: 'GET',
    beforeSend: function() {
      $(reglementsTable).html('')
      $('#reglements-loader-container').show();
    },
    success: function(response) {
      fillReglementsTable(response.reglements.data)
      $('#total').text(`Total: ${response.total} DH`)
      $('#paye').text(`Payé: ${response.paye} DH`)
      $('#rest').text(`Rest: ${response.rest} DH`)
      createPaginationLinks(response.reglements,'reglements-pagination', paginationReglementsFetch)
      $('#reglements-loader-container').hide();
    },
    error: function(error) {
      console.error(error.responseJSON);
    }
  });
}

function fillReglementsTable(data) {
  $(reglementsTable).html('')
  $.each(data, function (key, item) {
    $(reglementsTable).append(`
    <tr>
      <td data-th="N° réglement">${item.id}</td>
      <td data-th="Date réglement">${item.date_reglement}</td>
      <td data-th="montant">${item.montant}</td>
      <td data-th="type">${item.type}</td>
      <td data-th="Actions">
        <span class="material-icons-round edit edit-reglement" data-id="${item.id}">
          edit
        </span>
        <span class="material-icons-round delete delete-reglement" data-id="${item.id}">
          delete
        </span>
      </td>
    </tr>
    `);
  });
  defaultReglementsTable()
  // Actions
  passIdToReglementModal()
  deleteReglementAction()
  editReglementAction()
}

function editReglementAction() {
  $('.edit-reglement').on('click', function() {
    // Get the reglement ID from the hidden input
    let reglementId = $('#editReglementId').val();
    // Send an Ajax request to edit the vehicule
    $.ajax({
      url: `/reglements/${reglementId}/edit`,
      type: 'GET',
      success: function(response) {
        const reglement = response.reglement
        // Reset Errors
        resetReglementForm(editReglementForm);
        // Fill Edit Form
        $.each(reglement, function (index, value) { 
          $(`#edit_${index}`).val(`${value}`)
        });
        $('#EditReglementModal').modal({
          fadeDuration: 200
        });
      },
      error: function (response) {
        notification.error(response.responseJSON.msg)
      }
    });
  });
}

function deleteReglementAction() {
  $('.delete-reglement').on('click', function () { 
    const reglementId = $(this).attr('data-id');
    $.ajax({
      url: `/reglements/${reglementId}/delete`,
      type: 'GET',
      success: function() {
        $('#DeleteReglementModal').modal({
          fadeDuration: 200
        });
      },
      error: function (response) { 
        notification.error(response.responseJSON.msg)
      }
    });
  })
}

function passIdToReglementModal() {  
  $('.delete-reglement, .edit-reglement').on('click', function () { 
    let id = $(this).attr('data-id');
    // To Delete Modal
    $('#deleteReglementId').val(id);
    // To Edit Modal
    $('#editReglementId').val(id);
  })
}

function paginationReglementsFetch(uri) {
  $.ajax({
    method: 'GET',
    url: `/reglements/${contratId}/${uri}`,
    beforeSend: function() {
      $(reglementsTable).html('')
      $('#reglements-loader-container').show();
    },
    success: function (response) { 
      const reglements = response.reglements.data;
      $('#reglements-pagination .next-page').attr('href', response.reglements.next_page_url);
      $('#reglements-pagination .prev-page').attr('href', response.reglements.prev_page_url);
      $('#reglements-pagination .details').html(`Page: <b>${response.reglements.current_page}</b> | affichant <b>${response.reglements.from}</b> - <b>${response.reglements.to}</b> de <b>${response.reglements.total}</b>`)
      fillReglementsTable(reglements);
      $('#reglements-pagination .link').removeClass('active')
      $.each($('#reglements-pagination .link'), function (index, link) {
        ($(link).data('page') == response.reglements.current_page ) ? $(link).addClass('active') : $(link).removeClass('active');
      });
      $('#reglements-loader-container').hide();
    }
  })
}

function defaultReglementsTable() {
  let tbodyLenght = $(reglementsTable).children().length;
  for (let i = tbodyLenght; i < 5; i++) {
    $(reglementsTable).append(`
      <tr>
        <td data-th=""></td>
        <td data-th=""></td>
        <td data-th=""></td>
        <td data-th=""></td>
        <td data-th=" "></td>
      </tr> 
    `)
  }
}

function resetReglementForm(form) { 
  const formType = $(form).attr('id')
  console.log(form);
  $(form).find('div.error').text('');
  $('input, select').removeClass('success');
  $('input, select').removeClass('bounce');
  if (formType === 'add-reglement-form') {
    $(form)[0].reset();
  }
}