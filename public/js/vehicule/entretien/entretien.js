let addEntretienForm2 = document.getElementById('add-entretien-form');
let editEntretienForm2 = document.getElementById('edit-entretien-form');
let addEntretienButton = document.getElementById('add-entretien-button');
let editEntretienButton = document.getElementById('edit-entretien-button');


addEntretienButton.addEventListener('click', (event) => {
  validateDate(addEntretienForm2)
  if (!validateFields(addEntretienForm2) || !validateDate(addEntretienForm2)) {
    event.preventDefault()
  }
})

editEntretienButton.addEventListener('click', (event) => {
  validateDate(editEntretienForm2)
  if (!validateFields(editEntretienForm2) || !validateDate(editEntretienForm2)) {
    event.preventDefault()
  }
})

function validateDate(form) {
  let valid = true;
  const entretienDate = form.querySelector("input[type=date]");
  const entretienDateValue = entretienDate.value;
  const today = new Date();
  if (!entretienDateValue || new Date(entretienDateValue).getTime() > today.getTime()) {
    valid = false
    setErrors(entretienDate, "La date doit être inférieure ou égale à la date d'aujourd'hui")
  } else {
    setSuccess(entretienDate)
  }
  return valid
}

validationOnBlur(addEntretienForm2)
validationOnBlur(editEntretienForm2)
function validationOnBlur(form) {
  let inputs = form.querySelectorAll('input');
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

function validateFields(form) {
  let valid = true;
  let inputs = form.querySelectorAll('input:not(input[type=date])');
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


const numberFieldsEntretien = ['cout_entretien', 'edit_cout_entretien'];
numberFieldsEntretien.forEach((field)=>{
  document.getElementById(field).addEventListener('keydown' , function (event) {
    onlyNumbers(event);
  })
})

