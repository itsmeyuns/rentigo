const form = $('#form-agence');

$(document).ready(function () {
  

  form.on('submit', function (event) {  
    event.preventDefault();
    $.ajax({
      type: "POST",
      url: $(this).attr('action'),
      data: new FormData(this),
      processData: false,
      contentType: false,
      beforeSend:function(){
        $(this).find('div.error').text('');
      },
      success: function (response) {
        notification.success(response.msg)
      },
      error: function (xhr) {
        let errors = xhr.responseJSON.errors;
        $.each(errors, function (field, messages) {
          console.log(field, messages);
          $('.error.' + field + '_error').html(messages[0]);
          $('.error.' + field + '_error').prev().removeClass('success');
          $('.error.' + field + '_error').prev().addClass('bounce');
        });
      },
    });
  })



});