const addCarteGForm = $('#add-carte-g-form');
const editCarteGForm = $('#edit-carte-g-form');
const carteGriseTable = $('#carte-grise-section tbody');

$(document).ready(function () {
  fetchCarteGrises()

  // Hide Delete Modal
  $('#cancelCarteGriseButton').on('click', function () {
    $('#DeleteCarteGModal').parent().fadeOut(500)
  })

  // Show addassuranceModal
  $('#ajouter-carte-g').on('click', function () {
    resetCarteGriseForm(addCarteGForm)
    $('#AddCarteGModal').modal('show')
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
        $('.jquery-modal').fadeOut(500);
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



  addCarteGriseAction()

});




function resetCarteGriseForm(form) { 
  const formType = $(form).attr('id')
  $(form).find('div.error').text('');
  $('input').removeClass('success');
  $('input').removeClass('bounce');
  if (formType === 'add-carte-g-form') {
    $(form)[0].reset();
  }
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
        $('.jquery-modal').hide();
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
      fillCarteGriseTable(carteGrises)
      if (carteGrises.length > 0) {
        $('#carte-g-pagination').show()
        $('#carte-g-pagination .details').html(`Page: <b>${response.carte_grises.current_page}</b> | affichant <b>${response.carte_grises.from}</b> - <b>${response.carte_grises.to}</b> de <b>${response.carte_grises.total}</b>`)
        $('#carte-g-pagination div.links').html('')
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
          $('#carte-g-pagination div.links').append(element)
        })
        // Add Active Class To Element That Represent Page 1
        $('#carte-g-pagination .link:nth-child(2)').addClass('active')
        navigateCarteGrise()
      } else {
        $('#carte-g-pagination').hide()
      }
      $('#carte-g-loader-container').hide()
    },
    error: function(error) {
      console.error(error.responseJSON);
    }
  });
}

function navigateCarteGrise() {
  $('#carte-g-pagination a').on('click', function (event) {  
    event.preventDefault()
    if ($(this).attr('href')) {
      let page = $(this).attr('href').split('page=')[1]
      paginationCarteGriseFetch(page)
    }
  });
}

function paginationCarteGriseFetch(page) {
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

function deleteCarteGriseAction() {
  $('.delete-carte-grise').on('click', function () { 
    let carteGriseId = $(this).attr('data-id');
    $.ajax({
      url: `/carte-grises/${carteGriseId}/delete`,
      type: 'GET',
      success: function() {
        $('#DeleteCarteGModal').modal('show')
      },
      error: function (response) { 
        notification.error(response.responseJSON.msg)
      }
    });
  })
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
      $('#EditCarteGModal').modal('show')
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
      $('.jquery-modal').hide();
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
        $('.jquery-modal').hide();
        notification.error(response.responseJSON.msg)
      }
    }
  });
});