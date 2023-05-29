const addExtraForm = $('#add-extra-form');
const editExtraForm = $('#edit-extra-form');

$(document).ready(function () {

  $('#ajouter-extra').on('click', function () {
    resetExtraForm(addExtraForm)
    $("#AddExtraModal").modal({
      fadeDuration: 200
    });
  });

  $(editExtraForm).on('submit',function (e) { 
    e.preventDefault();
    const extraId = $('#editExtraId').val()
    const formData = new FormData(this);
    formData.append('_method', 'put');
    $.ajax({
      type: 'POST',
      url: `/extras/${extraId}`,
      data: formData,
      contentType: false,
      processData: false,
      beforeSend:function(){
        $(editExtraForm).find('div.error').text('');
      },
      success: function (response) {
        $.modal.close();
        notification.success(response.msg);
        fetchExtras()
      },
      error: function (response) {
        const errors = response.responseJSON.errors;
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

  $('#confirmationExtraButton').on('click', function() {
    const extraId = $('#deleteExtraId').val();
    $.ajax({
      url: `/extras/${extraId}`,
      type: 'DELETE',
      beforeSend: function () { 
        $.modal.close();
      },
      success: function(response) {
        notification.success(response.success);
        fetchExtras()
      },
      error: function (response) {
        notification.error(response.responseJSON.msg)
      }
    });
  });

  fetchExtras()
  addExtraAction()
});

function addExtraAction() { 
  $(addExtraForm).on('submit', function (e) {
    e.preventDefault()
    const formData = new FormData(this);
    $.ajax({
      type: "POST",
      url: $(this).attr('action'),
      data: formData,
      processData:false,
      contentType:false,
      beforeSend:function(){
        $(addExtraForm).find('div.error').text('');
      },
      success: function (response) {
        resetExtraForm(addExtraForm)
        $.modal.close();
        fetchExtras()
        notification.success(response.msg);
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

function fetchExtras() {
  $.ajax({
    url: '/extras',
    type: 'GET',
    beforeSend: function() {
      $('.extras-box-container').html('')
      $('#extras-loader-container').show(); // Show the loader when the AJAX request starts
      $("#extras-empty-data").hide()
    },
    success: function(response) {
      let extras = response.extras
      createExtrasBoxes(extras)
      $('#extras-loader-container').hide();
    },
    error: function(error) {
      console.error(error);
    }
  });
}

function createExtrasBoxes(extras) {  
  $('.extras-box-container').html('')
  $("#extras-empty-data").hide()
  if (extras.length > 0) {
    $.each(extras, function (key, item) {
      $('.extras-box-container').append(`
        <div class="box">
          <div>${item.nom}</div>
          <div class="actions">
            <span class="material-icons-round edit edit-extra" data-id="${item.id}">
              edit
            </span>
            <span class="material-icons-round delete delete-extra" data-id="${item.id}">
              delete
            </span>
          </div>
        </div>
      `)
    })
  } else {
    $("#extras-empty-data").show()
  }
  passIdToExtarsModal()
  deleteExtraAction()
  editExtraAction()
}

function editExtraAction() {
  $('.edit-extra').on('click', function() {
    // Get the vehicule ID from the hidden input
    const extraId = $('#editExtraId').val();
    // Send an Ajax request to edit the vehicule
    $.ajax({
      url: `/extras/${extraId}/edit`,
      type: 'GET',
      success: function(response) {
        $('#EditExtraModal').modal({
          fadeDuration: 200
        });
        // Reset Errors
        resetExtraForm(editExtraForm)
        $('#edit_nom').val(response.extra.nom);
      },
      error: function (response) {
        notification.error(response.responseJSON.msg)
      }
    });
  });
}

function passIdToExtarsModal() { 
  $('.delete-extra, .edit-extra').on('click', function () { 
    const id = $(this).attr('data-id');
    // To Delete Modal
    $('#deleteExtraId').val(id);
    // To Edit Modal
    $('#editExtraId').val(id);
  })
}

function deleteExtraAction() {
  $('.delete-extra').on('click', function () { 
    const extraId = $(this).attr('data-id');
    $.ajax({
      url: `/extras/${extraId}/delete`,
      type: 'GET',
      success: function(response) {
        $('#DeleteExtraModal').modal({
          fadeDuration: 200
        });
      },
      error: function (response) { 
        notification.error(response.responseJSON.msg)
      }
    });
  })
}

function resetExtraForm(form) { 
  const formType = $(form).attr('id')
  $(form).find('div.error').text('');
  $('input').removeClass('success');
  $('input').removeClass('bounce');
  if (formType === 'add-extra-form') {
    $(form)[0].reset();
  }
}