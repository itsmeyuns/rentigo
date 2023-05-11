const addReservationForm2 = document.getElementById('add-reservation-form');
const editReservationForm2 = document.getElementById('edit-reservation-form');
const addReservationButton = document.getElementById('add-reservation-button');
const editReservationButton = document.getElementById('edit-reservation-button');
const filterForm = document.getElementById('filter-form');
const filterButton = document.getElementById('filter-button');
console.log(filterForm, filterButton);


addReservationButton.addEventListener('click', function (event) {
  if (!validateFields(addReservationForm2)) {
    event.preventDefault()
  }
})

filterButton.addEventListener('click', function (event) {
  const checkboxes = filterForm.querySelectorAll('input[type="checkbox"]');
  let isChecked = false;
  const checkedCount = Array.from(checkboxes).filter(checkbox => checkbox.checked).length;
  isChecked = (checkedCount > 0) ?? true;

  const startDate = document.getElementById('startDate')
  const endDate = document.getElementById('endDate')
  let validDate = false;
  validDate = (!startDate.value.trim() && !endDate.value.trim()) ? false : true;
  if (!isChecked && !validDate) {
    event.preventDefault();
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