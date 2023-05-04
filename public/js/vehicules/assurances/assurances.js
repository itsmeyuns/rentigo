let addAssuranceForm2 = document.getElementById('add-assurance-form');
let editAssuranceForm2 = document.getElementById('edit-assurance-form');
let addAssuranceButton = document.getElementById('add-assurance-button');
let editAssuranceButton = document.getElementById('edit-assurance-button');

addAssuranceButton.addEventListener('click', (event) => {
  if (!validateFields(addAssuranceForm2)) {
    event.preventDefault()
  }
})

editAssuranceButton.addEventListener('click', (event) => {
  if (!validateFields(editAssuranceForm2)) {
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