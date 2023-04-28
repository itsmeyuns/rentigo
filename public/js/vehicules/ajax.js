let addForm = $('#add-vehicule-form');
let editForm = $('#edit-vehicule-form');
function addAction() { 
  $(addForm).on('submit', function (e) {
    e.preventDefault()
    let formData = new FormData(this);
    $.ajax({
      type: "POST",
      url: $(this).attr('action'),
      data: formData,
      processData:false,
      contentType:false,
      beforeSend:function(){
        $(addForm).find('div.error').text('');
      },
      success: function (response) {
        resetForm(addForm)
        $('.jquery-modal').hide();
        fetchVehicules()
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

$(document).ready(function () {
  fetchVehicules();

  // Hide Delete Modal
  $('#cancelButton').on('click', function () {
    $('#DeleteVehiculeModal').parent().hide()
  })

  // Add an event listener to the confirm delete button in the modal
  $('#confirmationButton').on('click', function() {
    // Get the vehicule ID from the hidden
    let vehiculeId = $('#deleteVehiculeId').val();
    // Send an Ajax request to delete the vehicule
    $.ajax({
      url: `/vehicules/${vehiculeId}`,
      type: 'DELETE',
      beforeSend: function () { 
        $('.jquery-modal').hide();
      },
      success: function(response) {
        notification.success(response.success);
        fetchVehicules()
      },
      error: function (response) {
        notification.error(response.responseJSON.msg)
      }
    });
  });

  // Show addVehiculeModal
  $('.ajouter').on('click', function () {
    resetForm(addForm)
    $('#AddVehiculeModal').modal('show')
  });

  $('#rechercher').on('input', function () { 
    let value = $(this).val()
    $.ajax({
      type: "GET",
      url: "/vehicules/search",
      data: {search: value},
      beforeSend: function() {
        $('.box-container').html('')
        $('#no-result').hide()
        $('.pagination').hide()
        $('#loader-container').show();
      },
      success: function (response) {
        if (value) {
          if (response.result.length > 0) {
            createBoxes(response.result)
          } else {
            $('.box-container').html('')
            $('#no-result').show()
          }
          $('#loader-container').hide()
        } else {
          fetchVehicules()
        }
      }
    });
  })

  $(editForm).on('submit',function (e) { 
    e.preventDefault();
    // Get the client ID from the hidden input
    let vehiculeId = $('#editVehiculeId').val()
    // Get data from the form
    let formData = new FormData(editForm[0]);
    formData.append('_method', 'put');
    $.ajax({
      type: 'POST',
      url: `/vehicules/${vehiculeId}`,
      data: formData,
      contentType: false,
      processData: false,
      beforeSend:function(){
        $(editForm).find('div.error').text('');
      },
      success: function (response) {
        $('.jquery-modal').hide();
        notification.success(response.msg);
        fetchVehicules()
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

  addAction()
});


function resetForm(form) { 
  const formType = $(form).attr('id')
  $(form).find('div.error').text('');
  $('input').removeClass('success');
  $('input').removeClass('bounce');
  if (formType === 'add-vehicule-form') {
    $(form)[0].reset();
    $('#imgPreview').hide();
    $('#uploadedImage').attr('src', '');
  }

}

function fetchVehicules() { 
  $.ajax({
    url: 'vehicules/fetch',
    type: 'GET',
    beforeSend: function() {
      $('.box-container').html('')
      $('#loader-container').show(); // Show the loader when the AJAX request starts
      $('#no-result').hide()
    },
    success: function(response) {
      let vehicules = response.vehicules.data
      let links = response.vehicules.links
      createBoxes(vehicules)
      if (vehicules.length > 0) {
        $('.pagination').show()
        $('.details').html(`Page: <b>${response.vehicules.current_page}</b> | affichant <b>${response.vehicules.from}</b> - <b>${response.vehicules.to}</b> de <b>${response.vehicules.total}</b>`)
        $('.pagination div.links').html('')
        // Add Pagination links
        $.each(links, function (index, link) {
          let element = `<a href="${link.url}" class="link" data-page="${link.label}">${link.label}</a>`
          if (index === 0) {
            element = `<a href="${link.url}" class="link prev-page" data-page="${link.label}">
                        <span class="material-icons-round">navigate_before</span>
                      </a>`
          }
          else if (index === links.length-1) {
            element = `<a href="${link.url}" class="link next-page" data-page="${link.label}">
                        <span class="material-icons-round">navigate_next</span>
                      </a>`
          }
          $('.pagination div.links').append(element)
        })
        // Add Active Class To Element That Represent Page 1
        $('.pagination .link:nth-child(2)').addClass('active')
        navigate()
      } else {
        $('.pagination').hide()
      }
      $('#loader-container').hide();
    },
    error: function(error) {
      console.error(error);
    }
  });
}

function createBoxes(vehicules) {
  console.log(vehicules);
  $('.box-container').html('')
  $.each(vehicules, function (key, item) {
    $('.box-container').append(`
      <div class="box">
        <div class="box-header">
          <div class="box-inner">
            <h3 class="vehicule-marque">${item.marque}</h3>
            <p class="vehicule-model">${item.modele}</p>
          </div>
          <p class="vehicule-prix-location">${item.prix_location}MAD<span>/Jour</span></p>
        </div>
        <div class="box-body">
          <img src="${item.photo}" alt="" class="vehicule-photo">
        </div>
        <div class="box-footer">
          <span class="material-icons-round edit" data-id="${item.id}">edit</span>
          <span class="material-icons-round delete" data-id="${item.id}">
            delete
          </span>
        </div>
      </div>
    `)
  })
  passIdToModal()
  deleteAction()
  editAction()
}

function passIdToModal() { 
  $('.delete, .edit').on('click', function () { 
    let id = $(this).attr('data-id');
    // To Delete Modal
    $('#deleteVehiculeId').val(id);
    // To Edit Modal
    $('#editVehiculeId').val(id);
  })
}

function editAction() {
  $('.edit').on('click', function() {
    // Get the vehicule ID from the hidden input
    let vehiculeId = $('#editVehiculeId').val();
    let editForm = $('#edit-vehicule-form')
    // Send an Ajax request to edit the vehicule
    $.ajax({
      url: `/vehicules/${vehiculeId}/edit`,
      type: 'GET',
      success: function(response) {
        $('#EditVehiculeModal').modal('show')
        // Reset Errors
        resetForm(editForm)
        // Update the form fields with the response data
        const skipped = ['photo', 'deleted_at', 'created_at', 'updated_at']
        $.each(response.vehicule, function(key, val) {
          if (jQuery.inArray(key, skipped) != -1) {
            return
          }
          $(`#edit_${key}`).val(val);
        })
        $('.imgPreview').show();
        $('#edit_uploadedImage').attr('src', `${response.vehicule.photo}`);
      },
      error: function (response) {
          notification.error(response.responseJSON.msg)
      }
    });
  });
}

function deleteAction() {
  $('.delete').on('click', function () { 
    let vehiculeId = $(this).attr('data-id');
    $.ajax({
      url: `/vehicules/${vehiculeId}/delete`,
      type: 'GET',
      success: function(response) {
        $('#DeleteVehiculeModal').modal('show')
      },
      error: function (response) { 
        notification.error(response.responseJSON.msg)
      }
    });
  })
}

function navigate() {
  $('.pagination a').on('click', function (event) {  
    event.preventDefault()
    if ($(this).attr('href')) {
      let page = $(this).attr('href').split('page=')[1]
      paginationFetch(page)
    }
  });

}


function paginationFetch(page) {
  $.ajax({
    method: 'GET',
    url: `vehicules/fetch?page=${page}`,
    beforeSend: function() {
      $('.box-container').html('')
      $('#no-result').hide()
      $('#loader-container').show();
    },
    success: function (response) { 
      let vehicules = response.vehicules.data;
      $('.next-page').attr('href', response.vehicules.next_page_url);
      $('.prev-page').attr('href', response.vehicules.prev_page_url);
      $('.details').html(`Page: <b>${response.vehicules.current_page}</b> | affichant <b>${response.vehicules.from}</b> - <b>${response.vehicules.to}</b> de <b>${response.vehicules.total}</b>`)
      createBoxes(vehicules);
      $('.link').removeClass('active')
      $.each($('.link'), function (index, link) {
        ($(link).data('page') == response.vehicules.current_page ) ? $(link).addClass('active') : $(link).removeClass('active');
      });
      $('#loader-container').hide();
    }
  })
}


$('.filter .option').on('click', function () {
  if ($(this).children('input').is(':checked')) {
    console.log($(this).children('input').val());
  }
  
})

