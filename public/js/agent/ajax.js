const addAgentForm = $('#add-agent-form');
const editAgentForm = $('#edit-agent-form');
const agentsTable = $('#agents-section tbody');

$(document).ready(function () {

  // Hide Delete Modal
  $('#cancelAgentButton').on('click', function () {
    $.modal.close();
  })

  // Add an event listener to the confirm delete button in the modal
  $('#confirmationAgentButton').on('click', function() {
    // Get the agent ID from the hidden
    const agentId = $('#deleteAgentId').val();
    // Send an Ajax request to delete agent
    $.ajax({
      url: `/agents/${agentId}`,
      type: 'DELETE',
      beforeSend: function () { 
        $.modal.close();
      },
      success: function(response) {
        notification.success(response.success);
        fetchAgents()
      },
      error: function (response) {
        notification.error(response.responseJSON.msg)
      }
    });
  });


  $('#ajouter-agent').on('click', function () {  
    resetAgentForm(addAgentForm)
    $('#AddAgentModal').modal({
      fadeDuration: 200
    })
  });

  // Search
  $('#rechercher').on('keyup', function () { 
    let value = $(this).val()
    $.ajax({
      type: "GET",
      url: "/agents/search",
      data: {search: value},
      beforeSend: function() {
        $(agentsTable).html('')
        $('#agents-no-result').hide()
        $('#agents-pagination').hide()
        $('#agents-loader-container').show();
      },
      success: function (response) {
        if (value) {
          const agents = response.agents.data;
          if (agents.length > 0) {
            // Fill in the table
            fillAgentsTable(agents)
            createPaginationLinks(response.agents, 'agents-pagination', paginationAgentsFetch)
          } else {
            $(agentsTable).html('')
            $('#agents-no-result').show()
          }
          $('#agents-loader-container').hide()
        } else {
          fetchAgents()
        }
      }
    });
  })

  $(editAgentForm).on('submit', function (event) {
    event.preventDefault();
    // Get the contrat ID from the hidden input
    const agentId = $('#editAgentId').val()
    // Get data from the form
    const formData = new FormData(this);
    formData.append('_method', 'put');
    $.ajax({
      type: "POST",
      url: `/agents/${agentId}`,
      data: formData,
      contentType: false,
      processData: false,
      beforeSend:function(){
        $(this).find('div.error').text('');
      },
      success: function (response) {
        $.modal.close();
        notification.success(response.msg);
        fetchAgents()
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

  fetchAgents()
  AddAgentAction()
});

// Show Agent Card
function showAgentAction() { 
  $('.show-agent').on('click', function () {
    let agentId = $(this).data('id');
    $.ajax({
      method: 'GET',
      url: `/agents/${agentId}/show`,
      success: function (response) {
        $('#ShowAgentModal').modal({
          fadeDuration: 200
        });
        $.each(response.agent, function (key, value) {
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

function AddAgentAction() {
  addAgentForm.on('submit', function (event) {
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
        resetAgentForm(this)
        $.modal.close();
        fetchAgents()
        notification.success(response.msg)
      },
      error: function (xhr) {
        let errors = xhr.responseJSON.errors;
        $.each(errors, function (field, messages) {
          console.log(field);
          $('.error.' + field + '_error').html(messages[0]);
          $('.error.' + field + '_error').prev().removeClass('success');
          $('.error.' + field + '_error').prev().addClass('bounce');
        });
      }
    })
  })
}

function fetchAgents() {  
  $.ajax({
    url: `/agents/fetch`,
    type: 'GET',
    beforeSend: function() {
      $(agentsTable).html('')
      $('#agents-loader-container').show();
      $('#agents-no-result').hide()
    },
    success: function(response) {
      fillAgentsTable(response.agents.data)
      createPaginationLinks(response.agents,'agents-pagination', paginationAgentsFetch)
      $('#agents-loader-container').hide();
    },
    error: function(error) {
      console.error(error.responseJSON);
    }
  });
}

function paginationAgentsFetch(uri) {
  $.ajax({
    method: 'GET',
    url: `/agents/${uri}`,
    beforeSend: function() {
      $(agentsTable).html('')
      $('#agents-loader-container').show();
    },
    success: function (response) { 
      const agents = response.agents.data;
      $('#agents-pagination .next-page').attr('href', response.agents.next_page_url);
      $('#agents-pagination .prev-page').attr('href', response.agents.prev_page_url);
      $('#agents-pagination .details').html(`Page: <b>${response.agents.current_page}</b> | affichant <b>${response.agents.from}</b> - <b>${response.agents.to}</b> de <b>${response.agents.total}</b>`)
      fillAgentsTable(agents);
      $('#agents-pagination .link').removeClass('active')
      $.each($('#agents-pagination .link'), function (index, link) {
        ($(link).data('page') == response.agents.current_page ) ? $(link).addClass('active') : $(link).removeClass('active');
      });
      $('#agents-loader-container').hide();
    }
  })
}

function fillAgentsTable(data) {  
  $(agentsTable).html('')
  $.each(data, function (key, item) {
    $(agentsTable).append(`
    <tr>
      <td data-th="nom">${item.nom}</td>
      <td data-th="prénom">${item.prenom}</td>
      <td data-th="cin">${item.cin}</td>
      <td data-th="email">${item.email}</td>
      <td data-th="téléphone">${item.telephone}</td>
      <td data-th="Actions" class="actions">
        <span class="material-icons-round show show-agent" data-id="${item.id}">visibility</span>
        <span class="material-icons-round edit edit-agent" data-id="${item.id}">edit</span>
        <span class="material-icons-round delete delete-agent" data-id="${item.id}">delete</span>
      </td>
    </tr>
    `);
  });
  defaultAgentsTable()
  // Actions
  passIdToAgentModal()
  deleteAgentAction()
  editAgentAction()
  showAgentAction()
}

function editAgentAction() {
  $('.edit-agent').on('click', function() {
    // Get the Agent ID from the hidden input
    let agentId = $('#editAgentId').val();
    // Send an Ajax request to edit Agent
    $.ajax({
      url: `/agents/${agentId}/edit`,
      type: 'GET',
      success: function(response) {
        const agent = response.agent
        console.log(agent);
        // Reset Errors
        resetAgentForm(editAgentForm);
        $.each(agent, function (index, value) {
          $(`#edit_${index}`).val(value);
        });
        $('#EditAgentModal').modal({
          fadeDuration: 200
        });
      },
      error: function (response) {
        notification.error(response.responseJSON.msg)
      }
    });
  });
}

function deleteAgentAction() {
  $('.delete-agent').on('click', function () { 
    const agentId = $(this).attr('data-id');
    $.ajax({
      url: `/agents/${agentId}/delete`,
      type: 'GET',
      success: function() {
        $('#DeleteAgentModal').modal({
          fadeDuration: 200
        });
      },
      error: function (response) { 
        notification.error(response.responseJSON.msg)
      }
    });
  })
}

function passIdToAgentModal() {  
  $('.delete-agent, .edit-agent').on('click', function () { 
    let id = $(this).attr('data-id');
    // To Delete Modal
    $('#deleteAgentId').val(id);
    // To Edit Modal
    $('#editAgentId').val(id);
  })
}

function defaultAgentsTable() {
  let tbodyLenght = $(agentsTable).children().length;
  for (let i = tbodyLenght; i < 10; i++) {
    $(agentsTable).append(`
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

function resetAgentForm(form) { 
  const formType = $(form).attr('id')
  $(form).find('div.error').text('');
  $('input, select').removeClass('success');
  $('input, select').removeClass('bounce');
  if (formType === 'add-agent-form') {
    $(form)[0].reset();
  }
}