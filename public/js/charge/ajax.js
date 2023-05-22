const addChargeForm = $('#add-charge-form');
const editChargeForm = $('#edit-charge-form');
const chargesTable = $('#charges-section tbody');

$(document).ready(function () {

  fetchCharges()

  // Hide Delete Modal
  $('#cancelChargeButton').on('click', function () {
    $.modal.close();
  })

  // Add an event listener to the confirm delete button in the modal
  $('#confirmationChargeButton').on('click', function() {
    // Get the vehicule ID from the hidden
    const chargeId = $('#deleteChargeId').val();
    console.log(chargeId);
    // Send an Ajax request to delete Charge
    $.ajax({
      url: `/charges/${chargeId}`,
      type: 'DELETE',
      beforeSend: function () { 
        $.modal.close();
      },
      success: function(response) {
        notification.success(response.success);
        fetchCharges()
      },
      error: function (response) {
        notification.error(response.responseJSON.msg)
      }
    });
  });

  $('#ajouter-charge').on('click', function () {
    resetChargeForm(addChargeForm)
    $('#AddChargeModal').modal({
      fadeDuration: 200
    })
  })

  $('#resetButton').on('click', function () {  
    fetchCharges();
  })

  // Search
  $('#rechercher').on('keyup', function () { 
    let value = $(this).val()
    $.ajax({
      type: "GET",
      url: "/charges/search",
      data: {search: value},
      beforeSend: function() {
        $(chargesTable).html('')
        $('#no-result').hide()
        $('#charges-pagination').hide()
        $('#charges-loader-container').show();
      },
      success: function (response) {
        if (value) {
          const charges = response.charges.data;
          if (charges.length > 0) {
            fillChargesTable(charges)
            createPaginationLinks(response.charges, 'charges-pagination', paginationChargesFetch)
          } else {
            $(chargesTable).html('')
            $('#charges-no-result').show()
          }
          $('#charges-loader-container').hide()
        } else {
          fetchCharges()
        }
      }
    });
  })

  // Date Range
  $('#filter-form').on('submit', function (event) {
    event.preventDefault();
    const formData = $(this).serialize();
    $.ajax({
      type: "GET",
      url: "/charges/filter",
      data: formData,
      beforeSend: function() {
        $(chargesTable).html('')
        $('#charges-loader-container').show();
        $('#charges-no-result').hide()
        $('#charges-pagination').hide()
      },
      success: function (response) {
        fillChargesTable(response.charges.data)
        createPaginationLinks(response.charges, 'charges-pagination', paginationChargesFetch)
        $('#charges-loader-container').hide();
      }
    });
  })

  $(editChargeForm).on('submit', function (event) {
    event.preventDefault();
    // Get the charge ID from the hidden input
    const chargeId = $('#editChargeId').val()
    // Get data from the form
    const formData = new FormData(this);
    formData.append('_method', 'put');
    $.ajax({
      type: "POST",
      url: `/charges/${chargeId}`,
      data: formData,
      contentType: false,
      processData: false,
      beforeSend:function(){
        $(this).find('div.error').text('');
      },
      success: function (response) {
        $.modal.close();
        notification.success(response.msg);
        fetchCharges()
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

  addChargeAction()

});

function addChargeAction() {
  addChargeForm.on('submit', function (event) {
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
        resetChargeForm(this)
        $.modal.close();
        fetchCharges()
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

function fetchCharges() { 
  $.ajax({
    url: `/charges/fetch`,
    type: 'GET',
    beforeSend: function() {
      $(chargesTable).html('')
      $('#charges-loader-container').show();
      $('#charges-no-result').hide()
    },
    success: function(response) {
      fillChargesTable(response.charges.data)
      $('#total').text(`${response.total}`)
      createPaginationLinks(response.charges,'charges-pagination', paginationChargesFetch)
      $('#charges-loader-container').hide();
    },
    error: function(error) {
      console.error(error.responseJSON);
    }
  });
}

function paginationChargesFetch(uri) {
  $.ajax({
    method: 'GET',
    url: `/charges/${uri}`,
    beforeSend: function() {
      $(chargesTable).html('')
      $('#charges-loader-container').show();
    },
    success: function (response) { 
      const charges = response.charges.data;
      $('#charges-pagination .next-page').attr('href', response.charges.next_page_url);
      $('#charges-pagination .prev-page').attr('href', response.charges.prev_page_url);
      $('#charges-pagination .details').html(`Page: <b>${response.charges.current_page}</b> | affichant <b>${response.charges.from}</b> - <b>${response.charges.to}</b> de <b>${response.charges.total}</b>`)
      fillChargesTable(charges);
      $('#charges-pagination .link').removeClass('active')
      $.each($('#charges-pagination .link'), function (index, link) {
        ($(link).data('page') == response.charges.current_page ) ? $(link).addClass('active') : $(link).removeClass('active');
      });
      $('#charges-loader-container').hide();
    }
  })
}

function fillChargesTable(data) {
  $(chargesTable).html('')
  $.each(data, function (key, item) {
    $(chargesTable).append(`
    <tr>
    <td data-th="Date">${item.date}</td>
      <td data-th="Type Charge">${item.type}</td>
      <td data-th="Coût">${item.cout}</td>
      <td data-th="Observation">${item.observation ?? '###' }</td>
      <td data-th="Actions" class='actions'>
        <span class="material-icons-round edit edit-charge" data-id="${item.id}">
          edit
        </span>
        <span class="material-icons-round delete delete-charge" data-id="${item.id}">
          delete
        </span>
      </td>
    </tr>
    `);
  });
  defaultChargesTable()
  // Actions
  passIdToChargeModal()
  deleteChargeAction()
  editChargeAction()

}

function defaultChargesTable() {  
  let tbodyLenght = $(chargesTable).children().length;
  for (let i = tbodyLenght; i < 10; i++) {
    $(chargesTable).append(`
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

function passIdToChargeModal() {  
  $('.delete-charge, .edit-charge').on('click', function () { 
    let id = $(this).attr('data-id');
    // To Delete Modal
    $('#deleteChargeId').val(id);
    // To Edit Modal
    $('#editChargeId').val(id);
  })
}

function deleteChargeAction() {
  $('.delete-charge').on('click', function () { 
    const chargeId = $(this).attr('data-id');
    $.ajax({
      url: `/charges/${chargeId}/delete`,
      type: 'GET',
      success: function() {
        $('#DeleteChargeModal').modal({
          fadeDuration: 200
        });
      },
      error: function (response) { 
        notification.error(response.responseJSON.msg)
      }
    });
  })
}

function editChargeAction() {
  $('.edit-charge').on('click', function() {
    // Get the charge ID from the hidden input
    let chargeId = $('#editChargeId').val();
    // Send an Ajax request to edit the vehicule
    $.ajax({
      url: `/charges/${chargeId}/edit`,
      type: 'GET',
      success: function(response) {
        const charge = response.charge
        // Reset Errors
        resetChargeForm(editChargeForm);
        $.each(charge, function (index, value) { 
          $(`#edit_${index}`).val(value);
        });
        $('#EditChargeModal').modal({
          fadeDuration: 200
        });
      },
      error: function (response) {
        notification.error(response.responseJSON.msg)
      }
    });
  });
}

function resetChargeForm(form) { 
  const formType = $(form).attr('id')
  $(form).find('div.error').text('');
  $('input, select').removeClass('success');
  $('input, select').removeClass('bounce');
  if (formType === 'add-charge-form') {
    $(form)[0].reset();
  }
}