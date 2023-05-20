const addUserForm = $('#add-user-form');
const editUserForm = $('#edit-user-form');
const usersTable = $('#users-section tbody');

$(document).ready(function () {

  // Hide Delete Modal
  $('#cancelUserButton').on('click', function () {
    $.modal.close();
  })

  // Add an event listener to the confirm delete button in the modal
  $('#confirmationUserButton').on('click', function() {
    // Get the user ID from the hidden
    const userId = $('#deleteUserId').val();
    // Send an Ajax request to delete user
    $.ajax({
      url: `/users/${userId}`,
      type: 'DELETE',
      beforeSend: function () { 
        $.modal.close();
      },
      success: function(response) {
        notification.success(response.success);
        fetchUsers()
      },
      error: function (response) {
        notification.error(response.responseJSON.msg)
      }
    });
  });


  $('#ajouter-user').on('click', function () {  
    resetUserForm(addUserForm)
    $('#AddUserModal').modal({
      fadeDuration: 200
    })
  });

  // Search
  $('#rechercher').on('keyup', function () { 
    let value = $(this).val()
    $.ajax({
      type: "GET",
      url: "/users/search",
      data: {search: value},
      beforeSend: function() {
        $(usersTable).html('')
        $('#users-no-result').hide()
        $('#users-pagination').hide()
        $('#users-loader-container').show();
      },
      success: function (response) {
        if (value) {
          const users = response.users.data;
          if (users.length > 0) {
            // Fill in the table
            fillUsersTable(users)
            createPaginationLinks(response.users, 'users-pagination', paginationUsersFetch)
          } else {
            $(usersTable).html('')
            $('#users-no-result').show()
          }
          $('#users-loader-container').hide()
        } else {
          fetchUsers()
        }
      }
    });
  })

  $(editUserForm).on('submit', function (event) {
    event.preventDefault();
    // Get the contrat ID from the hidden input
    const userId = $('#editUserId').val()
    // Get data from the form
    const formData = new FormData(this);
    formData.append('_method', 'put');
    $.ajax({
      type: "POST",
      url: `/users/${userId}`,
      data: formData,
      contentType: false,
      processData: false,
      beforeSend:function(){
        $(this).find('div.error').text('');
      },
      success: function (response) {
        $.modal.close();
        notification.success(response.msg);
        fetchUsers()
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

  fetchUsers()
  AddUserAction()
});

// Show User Card
function showUserAction() { 
  $('.show-user').on('click', function () {
    let userId = $(this).data('id');
    $.ajax({
      method: 'GET',
      url: `/users/${userId}/show`,
      success: function (response) {
        $('#ShowUserModal').modal({
          fadeDuration: 200
        });
        $.each(response.user, function (key, value) {
          if (key === 'email' && !value) {
            value = '#####';
          } else if (key === 'sexe') {
            value = (value === 'H') ? 'Homme' : 'Femme';
          }
          $(`#show_${key}`).html(value);
        });
      },
      error: function (response) {  
        notification.error(response.responseJSON.msg)
      }
    })
  })
}

function AddUserAction() {
  addUserForm.on('submit', function (event) {
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
        resetUserForm(this)
        $.modal.close();
        fetchUsers()
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

function fetchUsers() {  
  $.ajax({
    url: `/users/fetch`,
    type: 'GET',
    beforeSend: function() {
      $(usersTable).html('')
      $('#users-loader-container').show();
      $('#users-no-result').hide()
    },
    success: function(response) {
      fillUsersTable(response.users.data)
      createPaginationLinks(response.users,'users-pagination', paginationUsersFetch)
      $('#users-loader-container').hide();
    },
    error: function(error) {
      console.error(error.responseJSON);
    }
  });
}

function paginationUsersFetch(uri) {
  $.ajax({
    method: 'GET',
    url: `/users/${uri}`,
    beforeSend: function() {
      $(usersTable).html('')
      $('#users-loader-container').show();
    },
    success: function (response) { 
      const users = response.users.data;
      $('#users-pagination .next-page').attr('href', response.users.next_page_url);
      $('#users-pagination .prev-page').attr('href', response.users.prev_page_url);
      $('#users-pagination .details').html(`Page: <b>${response.users.current_page}</b> | affichant <b>${response.users.from}</b> - <b>${response.users.to}</b> de <b>${response.users.total}</b>`)
      fillUsersTable(users);
      $('#users-pagination .link').removeClass('active')
      $.each($('#users-pagination .link'), function (index, link) {
        ($(link).data('page') == response.users.current_page ) ? $(link).addClass('active') : $(link).removeClass('active');
      });
      $('#users-loader-container').hide();
    }
  })
}

function fillUsersTable(data) {  
  $(usersTable).html('')
  $.each(data, function (key, item) {
    $(usersTable).append(`
    <tr>
      <td data-th="nom">${item.nom}</td>
      <td data-th="prénom">${item.prenom}</td>
      <td data-th="cin">${item.cin}</td>
      <td data-th="téléphone">${item.telephone}</td>
      <td data-th="rôle">${item.role}</td>
      <td data-th="Actions" class="actions">
        <span class="material-icons-round show show-user" data-id="${item.id}">visibility</span>
        <span class="material-icons-round edit edit-user" data-id="${item.id}">edit</span>
        <span class="material-icons-round delete delete-user" data-id="${item.id}">delete</span>
      </td>
    </tr>
    `);
  });
  defaultUsersTable()
  // Actions
  passIdToUserModal()
  deleteUserAction()
  editUserAction()
  showUserAction()
}

function editUserAction() {
  $('.edit-user').on('click', function() {
    // Get the User ID from the hidden input
    let userId = $('#editUserId').val();
    // Send an Ajax request to edit User
    $.ajax({
      url: `/users/${userId}/edit`,
      type: 'GET',
      success: function(response) {
        const user = response.user
        console.log(user);
        // Reset Errors
        resetUserForm(editUserForm);
        $.each(user, function (index, value) {
          $(`#edit_${index}`).val(value);
        });
        $('#EditUserModal').modal({
          fadeDuration: 200
        });
      },
      error: function (response) {
        notification.error(response.responseJSON.msg)
      }
    });
  });
}

function deleteUserAction() {
  $('.delete-user').on('click', function () { 
    const userId = $(this).attr('data-id');
    $.ajax({
      url: `/users/${userId}/delete`,
      type: 'GET',
      success: function() {
        $('#DeleteUserModal').modal({
          fadeDuration: 200
        });
      },
      error: function (response) { 
        notification.error(response.responseJSON.msg)
      }
    });
  })
}

function passIdToUserModal() {  
  $('.delete-user, .edit-user').on('click', function () { 
    let id = $(this).attr('data-id');
    // To Delete Modal
    $('#deleteUserId').val(id);
    // To Edit Modal
    $('#editUserId').val(id);
  })
}

function defaultUsersTable() {
  let tbodyLenght = $(usersTable).children().length;
  for (let i = tbodyLenght; i < 10; i++) {
    $(usersTable).append(`
      <tr>
        <td data-th=""></td>
        <td data-th=""></td>
        <td data-th=""></td>
        <td data-th=""></td>
        <td data-th=" "></td>
        <td data-th=" "></td>
      </tr> 
    `)
  }
}

function resetUserForm(form) { 
  const formType = $(form).attr('id')
  $(form).find('div.error').text('');
  $('input, select').removeClass('success');
  $('input, select').removeClass('bounce');
  if (formType === 'add-user-form') {
    $(form)[0].reset();
  }
}