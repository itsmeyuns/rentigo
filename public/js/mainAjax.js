$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$(window).on('load', function () {
  $('#main-loader-container').fadeOut(1200);
})

// Start Global Functions
function createPaginationLinks(object, paginationId, paginationFetch) {
  const links = object.links;
  if (object.data.length > 0) {
    const currentPage = object.current_page
    const from = object.from
    const to = object.to
    const total = object.total
    $(`#${paginationId}`).show()
    $(`#${paginationId} .details`).html(`Page: <b>${currentPage}</b> | affichant <b>${from}</b> - <b>${to}</b> de <b>${total}</b>`)
    $(`#${paginationId} div.links`).html('')
    // Add Pagination links
    $.each(links, function (index, link) {
      let element = `<a href="${link.url}" class="link" data-page="${link.label}">${link.label}</a>`
      if (index === 0) {
        element = `<a href="${link.url ?? ''}" class="link prev-page" data-page="${link.label}">
                    <span class="material-icons-round">navigate_before</span>
                  </a>`
      }
      else if (index === links.length-1) {
        element = `<a href="${link.url ?? ''}" class="link next-page" data-page="${link.label}">
                    <span class="material-icons-round">navigate_next</span>
                  </a>`
      }
      $(`#${paginationId} div.links`).append(element)
    })
    // Add Active Class To Element That Represent Page 1
    $(`#${paginationId} .link:nth-child(2)`).addClass('active')
    navigate(paginationId, paginationFetch)
  } else {
    $(`#${paginationId}`).hide()
  }
}

function navigate(paginationId, pgFetch) {
  $(`#${paginationId} a`).on('click', function (event) {  
    event.preventDefault()
    if ($(this).attr('href')) {
      const url = $(this).attr('href')
      const startIndex = url.lastIndexOf('/') +1 ; 
      const uri = url.substring(startIndex);
      pgFetch(uri)
    }
  });
}

function getClients(selectClientsId = null, clientID = null) {
  $.ajax({
    type: "GET",
    url: "/clients/all",
    success: function (response) {
      const clients =  response.clients;
      $(`#${selectClientsId}`).html(`<option value="" disabled selected>Sélectionner un client</option>`);
      $.each(clients, function (index, value) { 
        $(`#${selectClientsId}`).append(`
          <option value="${value.id}" ${(value.id === clientID) ? 'selected' : ''}>${value.nom} ${value.prenom}</option>
        `);
      });
    }
  });
}
// End Global Functions