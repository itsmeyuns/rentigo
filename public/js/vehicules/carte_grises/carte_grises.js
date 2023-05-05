let addCarteGForm2 = document.getElementById('add-carte-g-form');
let editCarteGForm2 = document.getElementById('edit-carte-g-form');
let addCarteGButton = document.getElementById('add-carte-g-button');
let editCarteGButton = document.getElementById('edit-carte-g-button');

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

function setErrors(element, message) {
  const inputParent = element.parentElement;
  const errorDiv = inputParent.querySelector('.error');

  element.classList.remove('success')
  element.classList.add('bounce');
  errorDiv.innerText = message;
}

function setSuccess(element) {
  const inputParent = element.parentElement;
  const errorDiv = inputParent.querySelector('.error');
  element.classList.remove('bounce')
  element.classList.add('success')
  errorDiv.innerText = '';
}