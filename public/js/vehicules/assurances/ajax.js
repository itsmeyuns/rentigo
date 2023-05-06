const addAssuranceForm = $('#add-assurance-form');
const editAssuranceForm = $('#edit-assurance-form');
const assuranceTable = $('#assurance-section tbody');
// Show addassuranceModal
$('#ajouter-assurance').on('click', function () {
  resetAssuranceForm(addAssuranceForm)
  $('#AddAssuranceModal').modal('show')
})

function addAssuranceAction() {
  $(addAssuranceForm).on('submit', function (e) {
    e.preventDefault()
    let formData = new FormData(this);
    $.ajax({
      type: "POST",
      url: $(this).attr('action'),
      data: formData,
      processData:false,
      contentType:false,
      beforeSend:function(){
        $(addAssuranceForm).find('div.error').text('');
      },
      success: function (response) {
        resetAssuranceForm(addAssuranceForm)
        $('.jquery-modal').hide();
        fetchAssurances()
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

$(document).ready(function () {
  fetchAssurances()

  // Hide Delete Modal
  $('#cancelAssuranceButton').on('click', function () {
    $('#DeleteAssuranceModal').parent().hide()
  })
  // Add an event listener to the confirm delete button in the modal
  $('#confirmationAssuranceButton').on('click', function() {
    // Get the assurance ID from the hidden
    let assuranceId = $('#deleteAssuranceId').val();
    // Send an Ajax request to delete assurance
    $.ajax({
      url: `/assurances/${assuranceId}`,
      type: 'DELETE',
      beforeSend: function () { 
        $('.jquery-modal').hide();
      },
      success: function(response) {
        notification.success(response.success);
        fetchAssurances()
      },
      error: function (response) {
        notification.error(response.responseJSON.msg)
      }
    });
  });

  addAssuranceAction()
});

function fillAssuranceTable(data) {
  $(assuranceTable).html('')
  $.each(data, function (key, item) {
    $(assuranceTable).append(`
    <tr>
      <td data-th="Date Début">${item.date_debut}</td>
      <td data-th="Date Fin">${item.date_fin}</td>
      <td data-th="Actions">
        <span class="material-icons-round edit edit-assurance" data-id="${item.id}">edit</span>
        <span class="material-icons-round delete delete-assurance" data-id="${item.id}">delete</span> 
      </td>
    </tr>
    `);
  });
  defaultAssuranceTable()
  // Actions
  passIdToAssuranceModal()
  deleteAssuranceAction()
  editAssuranceAction()
}

function defaultAssuranceTable() {
  let tbodyLenght = $(assuranceTable).children().length;
  for (let i = tbodyLenght; i < 5; i++) {
    $(assuranceTable).append(`
      <tr>
        <td data-th=""></td>
        <td data-th=""></td>
        <td data-th=""></td>
      </tr> 
    `)
  }
}

function resetAssuranceForm(form) { 
  const formType = $(form).attr('id')
  $(form).find('div.error').text('');
  $('input').removeClass('success');
  $('input').removeClass('bounce');
  if (formType === 'add-assurance-form') {
    $(form)[0].reset();
  }
}

function fetchAssurances() {
  const vehiculeId = $('.vehicule-demo').data("vehicule-id");
  $.ajax({
    url: `/assurances/${vehiculeId}/fetch`,
    type: 'GET',
    beforeSend: function() {
      $(assuranceTable).html('')
      $('#assurance-loader-container').show(); // Show the loader when the AJAX request starts
    },
    success: function(response) {
      const assurances = response.assurances.data
      fillAssuranceTable(assurances)
      $('#prochaine-assurance').text(response.prochaine_assurance)
      createPaginationLinks(response.assurances, '#assurance-pagination', paginationAssuranceFetch)
      $('#assurance-loader-container').hide();
    },
    error: function(error) {
      console.error(error.responseJSON);
    }
  });
}

function paginationAssuranceFetch(page) {
  const vehiculeId = $('.vehicule-demo').data("vehicule-id");
  $.ajax({
    method: 'GET',
    url: `/assurances/${vehiculeId}/fetch?page=${page}`,
    beforeSend: function() {
      $(assuranceTable).html('')
      $('#assurance-loader-container').show();
    },
    success: function (response) { 
      let assurances = response.assurances.data;
      $('#assurance-pagination .next-page').attr('href', response.assurances.next_page_url);
      $('#assurance-pagination .prev-page').attr('href', response.assurances.prev_page_url);
      $('#assurance-pagination .details').html(`Page: <b>${response.assurances.current_page}</b> | affichant <b>${response.assurances.from}</b> - <b>${response.assurances.to}</b> de <b>${response.assurances.total}</b>`)
      fillAssuranceTable(assurances);
      $('#assurance-pagination .link').removeClass('active')
      $.each($('#assurance-pagination .link'), function (index, link) {
        ($(link).data('page') == response.assurances.current_page ) ? $(link).addClass('active') : $(link).removeClass('active');
      });
      $('#assurance-loader-container').hide();
    }
  })
}


function deleteAssuranceAction() {
  $('.delete-assurance').on('click', function () { 
    let assuranceId = $(this).attr('data-id');
    $.ajax({
      url: `/assurances/${assuranceId}/delete`,
      type: 'GET',
      success: function() {
        $('#DeleteAssuranceModal').modal('show')
      },
      error: function (response) { 
        notification.error(response.responseJSON.msg)
      }
    });
  })
}

function passIdToAssuranceModal() { 
  $('.delete-assurance, .edit-assurance').on('click', function () { 
    let id = $(this).attr('data-id');
    // To Delete Modal
    $('#deleteAssuranceId').val(id);
    // To Edit Modal
    $('#editAssuranceId').val(id);
  })
}

function editAssuranceAction() {
  $('.edit-assurance').on('click', function() {
    // Get the assrance ID from the hidden input
    const assuranceId = $('#editAssuranceId').val();
    let editAssuranceForm = $('#edit-assurance-form')
    // Send an Ajax request to edit the vehicule
    $.ajax({
      url: `/assurances/${assuranceId}/edit`,
      type: 'GET',
      success: function(response) {
      // Reset Errors
      resetAssuranceForm(editAssuranceForm)
      $('#EditAssuranceModal').modal('show')
      $.each(response.assurance, function(key, val) {
        $(`#edit_${key}`).val(val);
      })
      },
      error: function (response) {
        notification.error(response.responseJSON.msg)
      }
    });
  });
}

$(editAssuranceForm).on('submit',function (e) { 
  e.preventDefault();
  // Get the assurance ID from the hidden input
  let assuranceId = $('#editAssuranceId').val()
  // Get data from the form
  let formData = new FormData(editAssuranceForm[0]);
  formData.append('_method', 'put');
  $.ajax({
    type: 'POST',
    url: `/assurances/${assuranceId}`,
    data: formData,
    contentType: false,
    processData: false,
    beforeSend:function(){
      $(editAssuranceForm).find('div.error').text('');
    },
    success: function (response) {
      $('.jquery-modal').hide();
      notification.success(response.msg);
      fetchAssurances()
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