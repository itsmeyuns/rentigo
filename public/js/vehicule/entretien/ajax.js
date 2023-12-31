const addEntretienForm = $('#add-entretien-form');
const editEntretienForm = $('#edit-entretien-form');
const entretienTable = $('#entretien-section tbody');

$(document).ready(function () {
  fetchEntretiens()

  // Show addVidangeModal
  $('#ajouter-entretien').on('click', function () {
    resetEntretienForm(addEntretienForm)
    $('#AddEntretienModal').modal({
      fadeDuration: 200
    });
  })


  // Add an event listener to the confirm delete button in the modal
  $('#confirmationEntretienButton').on('click', function() {
    // Get the vehicule ID from the hidden
    let entretienId = $('#deleteEntretienId').val();
    // Send an Ajax request to delete entretien
    $.ajax({
      url: `/entretiens/${entretienId}`,
      type: 'DELETE',
      beforeSend: function () { 
        $.modal.close();
      },
      success: function(response) {
        notification.success(response.success);
        fetchEntretiens()
      },
      error: function (response) {
        notification.error(response.responseJSON.msg)
      }
    });
  });

  $(editEntretienForm).on('submit',function (e) { 
    e.preventDefault();
    // Get the entretien ID from the hidden input
    let entretienId = $('#editEntretienId').val()
    // Get data from the form
    let formData = new FormData(editEntretienForm[0]);
    formData.append('_method', 'put');
    $.ajax({
      type: 'POST',
      url: `/entretiens/${entretienId}`,
      data: formData,
      contentType: false,
      processData: false,
      beforeSend:function(){
        $(editEntretienForm).find('div.error').text('');
      },
      success: function (response) {
        $.modal.close();
        notification.success(response.msg);
        fetchEntretiens()
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

  addEntretienAction()
});

function fetchEntretiens() { 
  const vehiculeId = $('.vehicule-demo').data("vehicule-id");
  $.ajax({
    url: `/entretiens/${vehiculeId}/fetch`,
    type: 'GET',
    beforeSend: function() {
      $(entretienTable).html('')
      $('#entretien-loader-container').show(); // Show the loader when the AJAX request starts
    },
    success: function(response) {
      const entretiens = response.entretiens.data
      fillEntretienTable(entretiens)
      createPaginationLinks(response.entretiens, 'entretien-pagination', paginationEntretienFetch)
      $('#entretien-loader-container').hide();
    },
    error: function(error) {
      console.error(error.responseJSON);
    }
  });
}

function paginationEntretienFetch(uri) {
  const vehiculeId = $('.vehicule-demo').data("vehicule-id");
  $.ajax({
    method: 'GET',
    url: `/entretiens/${vehiculeId}/${uri}`,
    beforeSend: function() {
      $(entretienTable).html('')
      $('#entretien-loader-container').show();
    },
    success: function (response) { 
      let entretiens = response.entretiens.data;
      $('#entretien-pagination .next-page').attr('href', response.entretiens.next_page_url);
      $('#entretien-pagination .prev-page').attr('href', response.entretiens.prev_page_url);
      $('#entretien-pagination .details').html(`Page: <b>${response.entretiens.current_page}</b> | affichant <b>${response.entretiens.from}</b> - <b>${response.entretiens.to}</b> de <b>${response.entretiens.total}</b>`)
      fillEntretienTable(entretiens);
      $('#entretien-pagination .link').removeClass('active')
      $.each($('#entretien-pagination .link'), function (index, link) {
        ($(link).data('page') == response.entretiens.current_page ) ? $(link).addClass('active') : $(link).removeClass('active');
      });
      $('#entretien-loader-container').hide();
    }
  })
}

function fillEntretienTable(data) {
  $(entretienTable).html('')
  $.each(data, function (key, item) {
    $(entretienTable).append(`
    <tr>
      <td data-th="Type">${item.type}</td>
      <td data-th="Date">${item.date}</td>
      <td data-th="Km">${item.km_actuel}</td>
      <td data-th="cout">${item.cout}</td>
      <td data-th="observation">${item.observation ?? ''}</td>
      <td data-th="Actions">
        <span class="material-icons-round edit edit-entretien" data-id="${item.id}">edit</span>
        <span class="material-icons-round delete delete-entretien" data-id="${item.id}">delete</span> 
      </td>
    </tr>
    `);
  });
  defaultEntretienTable()
  // Actions
  passIdToEntretienModal()
  deleteEntretienAction()
  editEntretienAction()
}

function defaultEntretienTable() {
  let tbodyLenght = $(entretienTable).children().length;
  for (let i = tbodyLenght; i < 5; i++) {
    $(entretienTable).append(`
      <tr>
        <td data-th=""></td>
        <td data-th=""></td>
        <td data-th=""></td>
        <td data-th=""></td>
        <td data-th=""></td>
        <td data-th=""></td>
      </tr> 
    `)
  }
}

function editEntretienAction() {
  $('.edit-entretien').on('click', function() {
    // Get the entretien ID from the hidden input
    let entretienId = $('#editEntretienId').val();
    // Send an Ajax request to edit
    $.ajax({
      url: `/entretiens/${entretienId}/edit`,
      type: 'GET',
      success: function(response) {
      // Reset Errors
      resetEntretienForm(editEntretienForm)
      $('#EditEntretienModal').modal({
      fadeDuration: 200
    });
      $.each(response.entretien, function(key, val) {
        $(`#edit_${key}_entretien`).val(val);
      })
      },
      error: function (response) {
        notification.error(response.responseJSON.msg)
      }
    });
  });
}

function deleteEntretienAction() {
  $('.delete-entretien').on('click', function () { 
    let entretienId = $(this).attr('data-id');
    $.ajax({
      url: `/entretiens/${entretienId}/delete`,
      type: 'GET',
      success: function() {
        $('#DeleteEntretienModal').modal({
      fadeDuration: 200
    });
      },
      error: function (response) { 
        notification.error(response.responseJSON.msg)
      }
    });
  })
}

function addEntretienAction() {
  $(addEntretienForm).on('submit', function (e) {
    e.preventDefault()
    let formData = new FormData(this);
    $.ajax({
      type: "POST",
      url: $(this).attr('action'),
      data: formData,
      processData:false,
      contentType:false,
      beforeSend:function(){
        $(addEntretienForm).find('div.error').text('');
      },
      success: function (response) {
        console.log(response);
        resetEntretienForm(addEntretienForm)
        $.modal.close();
        fetchEntretiens()
        notification.success(response.msg)
      },
      error: function (response) {
        console.log(response);
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

function passIdToEntretienModal() { 
  $('.delete-entretien, .edit-entretien').on('click', function () { 
    let id = $(this).attr('data-id');
    // To Delete Modal
    $('#deleteEntretienId').val(id);
    // To Edit Modal
    $('#editEntretienId').val(id);
  })
}

function resetEntretienForm(form) {
  const formType = $(form).attr('id')
  $(form).find('div.error').text('');
  $('input').removeClass('success');
  $('input').removeClass('bounce');
  if (formType === 'add-entretien-form') {
    $(form)[0].reset();
  }
}