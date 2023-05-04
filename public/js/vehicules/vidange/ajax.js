const addForm = $('#add-vidange-form');
const editForm = $('#edit-vidange-form');
const tbody = $('.vidange-section tbody');
$(document).ready(function () {

  fetchVidanges()

  // Hide Delete Modal
  $('#cancelButton').on('click', function () {
    $('#DeleteVidangeModal').parent().hide()
  })

  // Add an event listener to the confirm delete button in the modal
  $('#confirmationButton').on('click', function() {
    // Get the vehicule ID from the hidden
    let vidangeId = $('#deleteVidangeId').val();
    // Send an Ajax request to delete vidange
    $.ajax({
      url: `/vidanges/${vidangeId}`,
      type: 'DELETE',
      beforeSend: function () { 
        $('.jquery-modal').hide();
      },
      success: function(response) {
        notification.success(response.success);
        fetchVidanges()
      },
      error: function (response) {
        notification.error(response.responseJSON.msg)
      }
    });
  });

  // Show addVidangeModal
  $('#ajouter-vidange').on('click', function () {
    resetForm(addForm)
    $('#AddVidangeeModal').modal('show')
  })

  $(editForm).on('submit',function (e) { 
    e.preventDefault();
    // Get the vidange ID from the hidden input
    let vidangeId = $('#editVidangeId').val()
    // Get data from the form
    let formData = new FormData(editForm[0]);
    formData.append('_method', 'put');
    $.ajax({
      type: 'POST',
      url: `/vidanges/${vidangeId}`,
      data: formData,
      contentType: false,
      processData: false,
      beforeSend:function(){
        $(editForm).find('div.error').text('');
      },
      success: function (response) {
        $('.jquery-modal').hide();
        notification.success(response.msg);
        fetchVidanges()
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
        fetchVidanges()
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

function fetchVidanges() { 
  const vehiculeId = $('.vehicule-demo').data("vehicule-id");
  $.ajax({
    url: `/vidanges/${vehiculeId}/fetch`,
    type: 'GET',
    beforeSend: function() {
      $(tbody).html('')
      $('#vidange-loader-container').show(); // Show the loader when the AJAX request starts
    },
    success: function(response) {
      const vidanges = response.vidanges.data
      const links = response.vidanges.links
      fillTable(vidanges)
      if (vidanges.length > 0) {
        $('#vidange-pagination').show()
        $('#vidange-pagination .details').html(`Page: <b>${response.vidanges.current_page}</b> | affichant <b>${response.vidanges.from}</b> - <b>${response.vidanges.to}</b> de <b>${response.vidanges.total}</b>`)
        $('#vidange-pagination div.links').html('')
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
          $('#vidange-pagination div.links').append(element)
        })
        // Add Active Class To Element That Represent Page 1
        $('#vidange-pagination .link:nth-child(2)').addClass('active')
        navigate()
      } else {
        $('#vidange-pagination').hide()
      }
      $('#vidange-loader-container').hide();
    },
    error: function(error) {
      console.error(error.responseJSON);
    }
  });
}

function navigate() {
  $('#vidange-pagination a').on('click', function (event) {  
    event.preventDefault()
    if ($(this).attr('href')) {
      let page = $(this).attr('href').split('page=')[1]
      paginationFetch(page)
    }
  });
}

function paginationFetch(page) {
  const vehiculeId = $('.vehicule-demo').data("vehicule-id");
  $.ajax({
    method: 'GET',
    url: `/vidanges/${vehiculeId}/fetch?page=${page}`,
    beforeSend: function() {
      $(tbody).html('')
      $('#vidange-loader-container').show();
    },
    success: function (response) { 
      let vidanges = response.vidanges.data;
      $('.next-page').attr('href', response.vidanges.next_page_url);
      $('.prev-page').attr('href', response.vidanges.prev_page_url);
      $('.details').html(`Page: <b>${response.vidanges.current_page}</b> | affichant <b>${response.vidanges.from}</b> - <b>${response.vidanges.to}</b> de <b>${response.vidanges.total}</b>`)
      fillTable(vidanges);
      $('.link').removeClass('active')
      $.each($('.link'), function (index, link) {
        ($(link).data('page') == response.vidanges.current_page ) ? $(link).addClass('active') : $(link).removeClass('active');
      });
      $('#vidange-loader-container').hide();
    }
  })
}

function fillTable(data) {
  $(tbody).html('')
  $.each(data, function (key, item) {
    $(tbody).append(`
    <tr>
      <td data-th="Type">${item.type}</td>
      <td data-th="Date">${item.date}</td>
      <td data-th="Km">${item.km_actuel}</td>
      <td data-th="Prochain vidange">${item.km_prochain_vidange}</td>
      <td data-th="cout">${item.cout}</td>
      <td data-th="observation">${item.observation ?? ''}</td>
      <td data-th="Actions">
        <span class="material-icons-round edit edit-vidange" data-id="${item.id}">edit</span>
        <span class="material-icons-round delete delete-vidange" data-id="${item.id}">delete</span> 
      </td>
    </tr>
    `);
  });
  defaultTable()
  // Actions
  passIdToModal()
  deleteAction()
  editAction()
}

function defaultTable() {
  let tbodyLenght = $(tbody).children().length;
  for (let i = tbodyLenght; i < 5; i++) {
    $('tbody').append(`
      <tr>
        <td data-th=""></td>
        <td data-th=""></td>
        <td data-th=""></td>
        <td data-th=""></td>
        <td data-th=" "></td>
        <td data-th=" "></td>
        <td data-th=" "> </td>
      </tr> 
    `)
  }
}

function passIdToModal() { 
  $('.delete-vidange, .edit-vidange').on('click', function () { 
    let id = $(this).attr('data-id');
    // To Delete Modal
    $('#deleteVidangeId').val(id);
    // To Edit Modal
    $('#editVidangeId').val(id);
  })
}

function deleteAction() {
  $('.delete-vidange').on('click', function () { 
    let vidangeId = $(this).attr('data-id');
    $.ajax({
      url: `/vidanges/${vidangeId}/delete`,
      type: 'GET',
      success: function() {
        $('#DeleteVidangeModal').modal('show')
      },
      error: function (response) { 
        notification.error(response.responseJSON.msg)
      }
    });
  })
}

function editAction() {
  $('.edit-vidange').on('click', function() {
    // Get the vidange ID from the hidden input
    let vidangeId = $('#editVidangeId').val();
    let editForm = $('#edit-vidange-form')
    // Send an Ajax request to edit the vehicule
    $.ajax({
      url: `/vidanges/${vidangeId}/edit`,
      type: 'GET',
      success: function(response) {
      // Reset Errors
      resetForm(editForm)
      $('#EditVidangeModal').modal('show')
      $.each(response.vidange, function(key, val) {
        $(`#edit_${key}`).val(val);
      })
      },
      error: function (response) {
        notification.error(response.responseJSON.msg)
      }
    });
  });
}

function resetForm(form) { 
  const formType = $(form).attr('id')
  $(form).find('div.error').text('');
  $('input').removeClass('success');
  $('input').removeClass('bounce');
  if (formType === 'add-vidange-form') {
    $(form)[0].reset();
  }
}