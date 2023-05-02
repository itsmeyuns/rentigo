$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$(window).on('load', function () {
  $('#main-loader-container').fadeOut(1200);
})