let addVidangeForm2 = document.getElementById('add-vidange-form');
let editVidangeForm2 = document.getElementById('edit-vidange-form');
let addVidangeButton = document.getElementById('add-vidange-button');
let editVidangeButton = document.getElementById('edit-vidange-button');

validationOnBlur(addVidangeForm2)

addVidangeButton.addEventListener('click', (event) => {
  validateDate(addVidangeForm2)
  if (!validateFields(addVidangeForm2) || !validateDate(addVidangeForm2)) {
    event.preventDefault()
  }
})

editVidangeButton.addEventListener('click', (event) => {
  validateDate(editVidangeForm2)
  if (!validateFields(editVidangeForm2) || !validateDate(editVidangeForm2)) {
    event.preventDefault()
  }
})

function validateDate(form) {
  let valid = true;
  const vidangeDate = form.querySelector("input[type=date]");
  console.log(vidangeDate);
  const vidangeDateValue = vidangeDate.value;
  const today = new Date();
  if (!vidangeDateValue || new Date(vidangeDateValue).getTime() > today.getTime()) {
    valid = false
    setErrors(vidangeDate, "La date doit être inférieure ou égale à la date d'aujourd'hui")
  } else {
    setSuccess(vidangeDate)
  }
  return valid
}

validationOnBlur(addVidangeForm2)
validationOnBlur(editVidangeForm2)
function validationOnBlur(form) {
  let inputs = form.querySelectorAll('input:not(input[type=date])');
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


const numberFields = ['type','cout', 'edit_type', 'edit_cout'];
numberFields.forEach((field)=>{
  console.log(document.getElementById(field));
  document.getElementById(field).addEventListener('keydown' , function (event) {
    onlyNumbers(event);
  })
})

function onlyNumbers(event) {
  const pressedKey = event.keyCode
  const allowedKeyCodes = [48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 46, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105, 109, 8];
  if (allowedKeyCodes.includes(pressedKey)) {
    return true
  } else {
    event.preventDefault()
  }
}


function calcKmProchainVidange(typeVidangeId, kmActuelId, kmProchainVidangeId) {
  const typeVidange = document.getElementById(typeVidangeId);
  typeVidange.addEventListener('input', function () {  
    const kmActuel = parseInt(document.getElementById(kmActuelId).value);
    let kmProchainVidange = document.getElementById(kmProchainVidangeId);
    if (this.value) {
      const typeVidangeValue = parseInt(this.value)
      kmProchainVidange.value = kmActuel + typeVidangeValue
    } else {
      kmProchainVidange.value = ''
    }
  })
}

calcKmProchainVidange('edit_type', 'edit_km_actuel', 'edit_km_prochain_vidange')
calcKmProchainVidange('type', 'km_actuel', 'km_prochain_vidange')



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