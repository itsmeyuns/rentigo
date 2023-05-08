const addCarteGForm = $('#add-carte-g-form');
const editCarteGForm = $('#edit-carte-g-form');
const carteGriseTable = $('#carte-grise-section tbody');

$(document).ready(function () {
  fetchCarteGrises()

  // Show AddAssuranceModal
  $('#ajouter-carte-g').on('click', function () {
    resetCarteGriseForm(addCarteGForm)
    $('#AddCarteGModal').modal({
      fadeDuration: 200
    });
  })

  // Hide Delete Modal
  $('#cancelCarteGriseButton').on('click', function () {
    $('#DeleteCarteGModal').parent().fadeOut(500)
  })

  // Add an event listener to the confirm delete button in the modal
  $('#confirmationCarteGriseButton').on('click', function() {
    // Get the assurance ID from the hidden
    let carteGriseId = $('#editCarteGriseId').val();
    // Send an Ajax request to delete Carte Grise
    $.ajax({
      url: `/carte-grises/${carteGriseId}`,
      type: 'DELETE',
      beforeSend: function () { 
        $.modal.close();
      },
      success: function(response) {
        notification.success(response.success);
        fetchCarteGrises()
      },
      error: function (response) {
        notification.error(response.responseJSON.msg)
      }
    });
  });

  $(editCarteGForm).on('submit',function (e) { 
    e.preventDefault();
    // Get the Carte Grise ID from the hidden input
    let carteGriseId = $('#editCarteGriseId').val()
    // Get data from the form
    let formData = new FormData(editCarteGForm[0]);
    formData.append('_method', 'put');
    $.ajax({
      type: 'POST',
      url: `/carte-grises/${carteGriseId}`,
      data: formData,
      contentType: false,
      processData: false,
      beforeSend:function(){
        $(editCarteGForm).find('div.error').text('');
      },
      success: function (response) {
        $.modal.close();;
        notification.success(response.msg);
        fetchCarteGrises()
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
          $.modal.close();;
          notification.error(response.responseJSON.msg)
        }
      }
    });
  });

  addCarteGriseAction()

});

function addCarteGriseAction() {
  $(addCarteGForm).on('submit', function (e) {
    e.preventDefault()
    let formData = new FormData(this);
    $.ajax({
      type: "POST",
      url: $(this).attr('action'),
      data: formData,
      processData:false,
      contentType:false,
      beforeSend:function(){
        $(addCarteGForm).find('div.error').text('');
      },
      success: function (response) {
        resetCarteGriseForm(addCarteGForm)
        $.modal.close();;
        fetchCarteGrises()
        notification.success(response.msg)
      },
      error: function (response) {
        let errors = response.responseJSON.errors;
        $.each(errors, function (field, messages) {
          $('.error.' + field + '_error').html(messages[0]);
          $('.error.' + field + '_error').prev().removeClass('success');
          $('.error.' + field + '_error').prev().addClass('bounce');
        });
      }
    });
  })
}

function editCarteGriseAction() {
  $('.edit-carte-grise').on('click', function() {
    // Get the Carte Grise ID from the hidden input
    const carteGriseId = $('#editCarteGriseId').val();
    // Send an Ajax request to edit the vehicule
    $.ajax({
      url: `/carte-grises/${carteGriseId}/edit`,
      type: 'GET',
      success: function(response) {
      // Reset Errors
      resetCarteGriseForm(editCarteGForm)
      $('#EditCarteGModal').modal({
      fadeDuration: 200
    });
      $.each(response.carte_grise, function(key, val) {
        $(`#edit_${key}_carte_grise`).val(val);
      })
      },
      error: function (response) {
        notification.error(response.responseJSON.msg)
      }
    });
  });
}

function deleteCarteGriseAction() {
  $('.delete-carte-grise').on('click', function () { 
    let carteGriseId = $(this).attr('data-id');
    $.ajax({
      url: `/carte-grises/${carteGriseId}/delete`,
      type: 'GET',
      success: function() {
        $('#DeleteCarteGModal').modal({
      fadeDuration: 200
    });
      },
      error: function (response) { 
        notification.error(response.responseJSON.msg)
      }
    });
  })
}

function fetchCarteGrises() {
  const vehiculeId = $('.vehicule-demo').data("vehicule-id");
  $.ajax({
    url: `/carte-grises/${vehiculeId}/fetch`,
    type: 'GET',
    beforeSend: function() {
      $(carteGriseTable).html('')
      $('#carte-g-loader-container').show(); // Show the loader when the AJAX request starts
    },
    success: function(response) {
      const carteGrises = response.carte_grises.data
      const links = response.carte_grises.links
      $('#prochaine-carte-g').text(response.prochaine_carte_grise)
      fillCarteGriseTable(carteGrises)
      createPaginationLinks(response.carte_grises, '#carte-g-pagination', paginationCarteGriseFetch)
      $('#carte-g-loader-container').hide()
    },
    error: function(error) {
      console.error(error.responseJSON);
    }
  });
}

function fillCarteGriseTable(data) {
  $(carteGriseTable).html('')
  $.each(data, function (key, item) {
    $(carteGriseTable).append(`
    <tr>
      <td data-th="Date Début">${item.date_debut}</td>
      <td data-th="Date Fin">${item.date_fin}</td>
      <td data-th="Actions">
        <span class="material-icons-round edit edit-carte-grise" data-id="${item.id}">edit</span>
        <span class="material-icons-round delete delete-carte-grise" data-id="${item.id}">delete</span> 
      </td>
    </tr>
    `);
  });
  defaultCarteGriseTable()
  // Actions
  passIdToCarteGriseModal()
  deleteCarteGriseAction()
  editCarteGriseAction()
}

function defaultCarteGriseTable() {
  let tbodyLenght = $(carteGriseTable).children().length;
  for (let i = tbodyLenght; i < 5; i++) {
    $(carteGriseTable).append(`
      <tr>
        <td data-th=""></td>
        <td data-th=""></td>
        <td data-th=""></td>
      </tr> 
    `)
  }
}

function passIdToCarteGriseModal() { 
  $('.delete-carte-grise, .edit-carte-grise').on('click', function () { 
    let id = $(this).attr('data-id');
    // To Delete Modal
    $('#deleteCarteGriseId').val(id);
    // To Edit Modal
    $('#editCarteGriseId').val(id);
  })
}

function resetCarteGriseForm(form) { 
  const formType = $(form).attr('id')
  $(form).find('div.error').text('');
  $('input').removeClass('success');
  $('input').removeClass('bounce');
  if (formType === 'add-carte-g-form') {
    $(form)[0].reset();
  }
}

function paginationCarteGriseFetch(page) {
  console.log(page);
  const vehiculeId = $('.vehicule-demo').data("vehicule-id");
  $.ajax({
    method: 'GET',
    url: `/carte-grises/${vehiculeId}/fetch?page=${page}`,
    beforeSend: function() {
      $(carteGriseTable).html('')
      $('#carte-g-loader-container').show();
    },
    success: function (response) { 
      let carteGrises = response.carte_grises.data;
      $('#carte-g-pagination .next-page').attr('href', response.carte_grises.next_page_url);
      $('#carte-g-pagination .prev-page').attr('href', response.carte_grises.prev_page_url);
      $('#carte-g-pagination .details').html(`Page: <b>${response.carte_grises.current_page}</b> | affichant <b>${response.carte_grises.from}</b> - <b>${response.carte_grises.to}</b> de <b>${response.carte_grises.total}</b>`)
      fillCarteGriseTable(carteGrises);
      $('#carte-g-pagination .link').removeClass('active')
      $.each($('#carte-g-pagination .link'), function (index, link) {
        ($(link).data('page') == response.carte_grises.current_page ) ? $(link).addClass('active') : $(link).removeClass('active');
      });
      $('#carte-g-loader-container').hide();
    }
  })
}