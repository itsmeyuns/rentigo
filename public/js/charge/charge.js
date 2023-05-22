const addChargeForm2 = document.getElementById('add-charge-form');
const editChargeForm2 = document.getElementById('edit-charge-form');
const addChargeButton = document.getElementById('add-charge-button');
const editChargeButton = document.getElementById('edit-charge-button');
const filterButton = document.getElementById('filter-button');


addChargeButton.addEventListener('click', function (event) {
  if (!validateFields(addChargeForm2)) {
    event.preventDefault()
  }
})

editChargeButton.addEventListener('click', function (event) {
  if (!validateFields(editChargeForm2)) {
    event.preventDefault()
  }
})


validationOnBlur(addChargeForm2)
validationOnBlur(editChargeForm2)
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

// Prevent Filter Form From Submitting If It's Empty
filterButton.addEventListener('click', function (event) {
  // Check If Start Date and End Date are Empty
  const startDate = document.getElementById('date_debut')
  const endDate = document.getElementById('date_fin')
  let validDate = false;
  validDate = (!startDate.value.trim() && !endDate.value.trim()) ? false : true;
  if (!validDate) event.preventDefault();

})
