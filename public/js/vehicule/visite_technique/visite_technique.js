const addVisiteTechniqueForm2 = document.getElementById('add-visite-technique-form');
const editVisiteTechniqueForm2 = document.getElementById('edit-visite-technique-form');
const addVisiteTechniqueButton = document.getElementById('add-visite-technique-button');
const editVisiteTechniqueButton = document.getElementById('edit-visite-technique-button');

addVisiteTechniqueButton.addEventListener('click', (event) => {
  if (!validateFields(addVisiteTechniqueForm2)) {
    event.preventDefault()
  }
})

editVisiteTechniqueButton.addEventListener('click', (event) => {
  if (!validateFields(editVisiteTechniqueForm2)) {
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