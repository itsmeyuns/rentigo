const addReservationForm2 = document.getElementById('add-reservation-form');
const editReservationForm2 = document.getElementById('edit-reservation-form');
const addReservationButton = document.getElementById('add-reservation-button');
const editReservationButton = document.getElementById('edit-reservation-button');


addReservationButton.addEventListener('click', function (event) {
  if (!validateFields(addReservationForm2)) {
    event.preventDefault()
  }
})

editReservationButton.addEventListener('click', function (event) {
  if (!validateFields(editReservationForm2)) {
    event.preventDefault()
  }
})


validationOnBlur(addReservationForm2)
validationOnBlur(editReservationForm2)
function validationOnBlur(form) {
  let inputs = form.querySelectorAll('input, select');
  inputs.forEach((input)=>{
    input.addEventListener('blur', function () {
      let inputValue = input.value.trim();
      if (!inputValue) {
        setErrors(this, 'Ce champ est obligatoire')
      } else {
        setSuccess(this)
      }
    })
  })
}

function validateFields(form) {
  let valid = true;
  let inputs = form.querySelectorAll('input, select');
  inputs.forEach(input => {
    if (!input.classList.contains('readonly-input')) {
      const inputValue = input.value.trim();
      if (inputValue === '') {
        setErrors(input, 'Ce champ est obligatoire');
        valid = false;
      } else {
        setSuccess(input);
      }
    }
  })

  return valid;

}
