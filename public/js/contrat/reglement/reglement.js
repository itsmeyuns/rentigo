const addReglementForm2 = document.getElementById('add-reglement-form');
const editReglementForm2 = document.getElementById('edit-reglement-form');
const addReglementButton = document.getElementById('add-reglement-button');
const editReglementButton = document.getElementById('edit-reglement-button');

addReglementButton.addEventListener('click', function (event) {
  if (!validateFields(addReglementForm2)) {
    event.preventDefault()
  }
})

editReglementButton.addEventListener('click', function (event) {
  if (!validateFields(editReglementForm2)) {
    event.preventDefault()
  }
})

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

validationOnBlur(addReglementForm2)
validationOnBlur(editReglementForm2)
function validationOnBlur(form) {
  let inputs = form.querySelectorAll('input, select');
  inputs.forEach((input)=>{
    if (!input.classList.contains('readonly-input')) {
      input.addEventListener('blur', function () {
        let inputValue = input.value.trim();
        if (!inputValue) {
          setErrors(this, 'Ce champ est obligatoire')
        } else {
          setSuccess(this)
        }
      })
    }
  })
}