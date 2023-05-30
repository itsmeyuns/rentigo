const passwordForm = $('#update-password-form');
const infosForm = $('#update-infos-form');

$(document).ready(function () {

  $(infosForm).on('submit', function (event) {
    event.preventDefault();
    $.ajax({
      type: "POST",
      url: $(this).attr('action'),
      data: new FormData(this),
      processData: false,
      contentType: false,
      beforeSend:function(){
        $(infosForm).find('div.error').text('');
      },
      success: function (response) {
        $('#user').text($('#login').val());
        notification.success(response.msg);
      },
      error: function (xhr) {
        const errors = xhr.responseJSON.errors;
        $.each(errors, function (field, messages) {
          $('.error.' + field + '_error').html(messages[0]);
          $('.error.' + field + '_error').prev().removeClass('success');
          $('.error.' + field + '_error').prev().addClass('bounce');
        });
      }
    });
  })

  $(passwordForm).on('submit', function (event) {
    event.preventDefault();
    $.ajax({
      type: "POST",
      url: $(this).attr('action'),
      data: new FormData(this),
      processData: false,
      contentType: false,
      beforeSend:function(){
        $(passwordForm).find('div.error').text('');
      },
      success: function (response) {
        notification.success(response.msg);
        $(passwordForm)[0].reset()
        $('#update-password-form input').removeClass('success');
        $('#update-password-form input').removeClass('bounce');
      },
      error: function (xhr) {
        const errors = xhr.responseJSON.errors;
        $.each(errors, function (field, messages) {
          $('.error.' + field + '_error').html(messages[0]);
          $('.error.' + field + '_error').prev().removeClass('success');
          $('.error.' + field + '_error').prev().addClass('bounce');
        });
      }
    });
  })

  $('.form-container .toggle').on('click', function () {
    $(this).next('.content').fadeToggle(150);
    $(this).children('.icon').toggleClass('rotate-icon');
  })

});