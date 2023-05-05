const addVisiteTechForm = $('#add-visite-technique-form');
const editVisiteTechForm = $('#edit-visite-technique-form');
const visiteTechTable = $('#visite-technique-section tbody');


$(document).ready(function () {
  fetchVisiteTechniques()

  // Show AddAssuranceModal
  $('#ajouter-visite-tech').on('click', function () {
    // resetVisiteTechForm(addVisiteTechForm)
    $('#AddVisiteTechModal').modal('show')
  })

  // Hide Delete Modal
  $('#cancelVisiteTechButton').on('click', function () {
    $('#DeleteVisiteTechModal').parent().fadeOut(500)
  })

  // Add an event listener to the confirm delete button in the modal
  $('#confirmationVisiteTechButton').on('click', function() {
    // Get the assurance ID from the hidden
    let visiteTechId = $('#editVisitTechId').val();
    // Send an Ajax request to delete Carte Grise
    $.ajax({
      url: `/visite-techniques/${visiteTechId}`,
      type: 'DELETE',
      beforeSend: function () { 
        $('.jquery-modal').fadeOut(500);
      },
      success: function(response) {
        notification.success(response.success);
        fetchVisiteTechniques()
      },
      error: function (response) {
        notification.error(response.responseJSON.msg)
      }
    });
  });

  $(editVisiteTechForm).on('submit',function (e) { 
    e.preventDefault();
    // Get the Carte Grise ID from the hidden input
    let visiteTechId = $('#editVisitTechId').val()
    // Get data from the form
    let formData = new FormData(editVisiteTechForm[0]);
    formData.append('_method', 'put');
    $.ajax({
      type: 'POST',
      url: `/visite-techniques/${visiteTechId}`,
      data: formData,
      contentType: false,
      processData: false,
      beforeSend:function(){
        $(editVisiteTechForm).find('div.error').text('');
      },
      success: function (response) {
        $('.jquery-modal').hide();
        notification.success(response.msg);
        fetchVisiteTechniques()
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
          $('.jquery-modal').hide();
          notification.error(response.responseJSON.msg)
        }
      }
    });
  });

  addVisiteTechniqueAction()

});

function fetchVisiteTechniques() {
  const vehiculeId = $('.vehicule-demo').data("vehicule-id");
  $.ajax({
    url: `/visite-techniques/${vehiculeId}/fetch`,
    type: 'GET',
    beforeSend: function() {
      $(visiteTechTable).html('')
      $('#visite-tech-loader-container').show(); // Show the loader when the AJAX request starts
    },
    success: function(response) {
      const visiteTechniques = response.visite_techniques.data
      fillVisiteTechniqueTable(visiteTechniques)
      createPaginationLinks(response.visite_techniques, '#visite-tech-pagination', paginationVisiteTechFetch)
      $('#visite-tech-loader-container').hide()
    },
    error: function(error) {
      console.error(error.responseJSON);
    }
  });
}

function addVisiteTechniqueAction() {
  $(addVisiteTechForm).on('submit', function (e) {
    e.preventDefault()
    let formData = new FormData(this);
    $.ajax({
      type: "POST",
      url: $(this).attr('action'),
      data: formData,
      processData:false,
      contentType:false,
      beforeSend:function(){
        $(addVisiteTechForm).find('div.error').text('');
      },
      success: function (response) {
        resetVisiteTechForm(addVisiteTechForm)
        $('.jquery-modal').hide();
        fetchVisiteTechniques()
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

function editVisiteTechniqueAction() {
  $('.edit-visite-technique').on('click', function() {
    // Get the Carte Grise ID from the hidden input
    const visiteTechId = $('#editVisitTechId').val();
    // Send an Ajax request to edit the vehicule
    $.ajax({
      url: `/visite-techniques/${visiteTechId}/edit`,
      type: 'GET',
      success: function(response) {
      // Reset Errors
      resetVisiteTechForm(editVisiteTechForm)
      $('#EditVisiteTechModal').modal('show')
      $.each(response.visite_technique, function(key, val) {
        $(`#edit_${key}_visite_technique`).val(val);
      })
      },
      error: function (response) {
        notification.error(response.responseJSON.msg)
      }
    });
  });
}

function deleteVisiteTechniqueAction() {
  $('.delete-visite-technique').on('click', function () { 
    let visiteTechId = $(this).attr('data-id');
    $.ajax({
      url: `/visite-techniques/${visiteTechId}/delete`,
      type: 'GET',
      success: function() {
        $('#DeleteVisiteTechModal').modal('show')
      },
      error: function (response) { 
        notification.error(response.responseJSON.msg)
      }
    });
  })
}

function paginationVisiteTechFetch(page) {
  const vehiculeId = $('.vehicule-demo').data("vehicule-id");
  $.ajax({
    method: 'GET',
    url: `/visite-techniques/${vehiculeId}/fetch?page=${page}`,
    beforeSend: function() {
      $(visiteTechTable).html('')
      $('#visite-tech-loader-container').show();
    },
    success: function (response) { 
      let carteGrises = response.visite_techniques.data;
      $('#visite-tech-pagination .next-page').attr('href', response.visite_techniques.next_page_url);
      $('#visite-tech-pagination .prev-page').attr('href', response.visite_techniques.prev_page_url);
      $('#visite-tech-pagination .details').html(`Page: <b>${response.visite_techniques.current_page}</b> | affichant <b>${response.visite_techniques.from}</b> - <b>${response.visite_techniques.to}</b> de <b>${response.visite_techniques.total}</b>`)
      fillVisiteTechniqueTable(carteGrises);
      $('#visite-tech-pagination .link').removeClass('active')
      $.each($('#visite-tech-pagination .link'), function (index, link) {
        ($(link).data('page') == response.visite_techniques.current_page ) ? $(link).addClass('active') : $(link).removeClass('active');
      });
      $('#visite-tech-loader-container').hide();
    }
  })
}

function fillVisiteTechniqueTable(data) {
  $(visiteTechTable).html('')
  $.each(data, function (key, item) {
    $(visiteTechTable).append(`
    <tr>
      <td data-th="Date Début">${item.date_debut}</td>
      <td data-th="Date Fin">${item.date_fin}</td>
      <td data-th="Actions">
        <span class="material-icons-round edit edit-visite-technique" data-id="${item.id}">edit</span>
        <span class="material-icons-round delete delete-visite-technique" data-id="${item.id}">delete</span> 
      </td>
    </tr>
    `);
  });
  defaultVisiteTechniqueTable()
  // Actions
  passIdToVisiteTechModal()
  deleteVisiteTechniqueAction()
  editVisiteTechniqueAction()
}

function passIdToVisiteTechModal() { 
  $('.delete-visite-technique, .edit-visite-technique').on('click', function () { 
    let id = $(this).attr('data-id');
    // To Delete Modal
    $('#deleteVisitTechId').val(id);
    // To Edit Modal
    $('#editVisitTechId').val(id);
  })
}

function resetVisiteTechForm(form) { 
  const formType = $(form).attr('id')
  $(form).find('div.error').text('');
  $('input').removeClass('success');
  $('input').removeClass('bounce');
  if (formType === 'add-visite-technique-form') {
    $(form)[0].reset();
  }
}

function defaultVisiteTechniqueTable() {
  let tbodyLenght = $(visiteTechTable).children().length;
  for (let i = tbodyLenght; i < 5; i++) {
    $(visiteTechTable).append(`
      <tr>
        <td data-th=""></td>
        <td data-th=""></td>
        <td data-th=""></td>
      </tr> 
    `)
  }
}