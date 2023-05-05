const addCarteGForm2 = document.getElementById('add-carte-g-form');
const editCarteGForm2 = document.getElementById('edit-carte-g-form');
const addCarteGButton = document.getElementById('add-carte-g-button');
const editCarteGButton = document.getElementById('edit-carte-g-button');

addCarteGButton.addEventListener('click', (event) => {
  if (!validateFields(addCarteGForm2)) {
    event.preventDefault()
  }
})

editCarteGButton.addEventListener('click', (event) => {
  if (!validateFields(editCarteGForm2)) {
    event.preventDefault()
  }
})

function validateFields(form) {
  let valid = true;
  let inputs = form.querySelectorAll('input');
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