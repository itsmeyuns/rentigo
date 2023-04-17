let addClientForm = document.getElementById('add-client-form');
let addClientButton = document.getElementById('add-client-button');
let editClientButton = document.getElementById('edit-client-button');
let editClientForm = document.getElementById('edit-client-form');
let separateVerification = ['email']

addClientButton.addEventListener('click', function (e) {
  if (!validateFields(addClientForm) || !validateEmail() || !validateMobileNumber()) {
    e.preventDefault()
  } 
})

validationOnBlur(addClientForm)


editClientButton.addEventListener('click', function (e) {
  if (!validateFields(editClientForm) || !validateEmail() || !validateMobileNumber()) {
    e.preventDefault()
  } 
})

validationOnBlur(editClientForm)


function validationOnBlur(form) { 
  let inputs = form.querySelectorAll('input');
  inputs.forEach((input)=>{
    if (input.type === 'email') {
      return
    }
    input.addEventListener('blur', function () {
      let inputValue = input.value.trim();
      if (!inputValue) {
        setErrors(input, 'Ce champ est obligatoire')
      } else {
        setSuccess(input)
      }
    })
  })
}

function validateFields(form) {
  let valid = true;
  let inputs = form.querySelectorAll('input');

  inputs.forEach(input => {
    if (input.type === "email") {
      return
    }
    const inputValue = input.value.trim();
    if (inputValue === '') {
      setErrors(input, 'Ce champ est obligatoire');
      valid = false;
    } else {
      setSuccess(input);
    }

  })

  return valid;

}



//Validate Email

let email = document.getElementById('email');
function validateEmail() {
  const emailValue = email.value
  const validRegex =  /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  let emailIsValid = true;
  if (emailValue) {
    if (emailValue.match(validRegex)) {
      setSuccess(email)
    } else {
      setErrors(email, 'Adresse e-mail invalide!')
      emailIsValid = false;
    }
  } else {
    reset(email)
  }

  return emailIsValid;
}


email.addEventListener('blur', validateEmail)



// Validate Mobile Number

let phone = document.getElementById('telephone')
function validateMobileNumber() {
  const phoneValue = phone.value;
  const mobileNumberRegex = /^(?:\+\d{1,3})?[-.\s]?\(?\d{1,3}\)?[-.\s]?\d{6,12}$/;
  let valid = true;
  if (phoneValue) {
    if (phoneValue.match(mobileNumberRegex)) {
      setSuccess(phone)
    } else {
      setErrors(phone, 'Le numéro de téléphone mobile est invalide.')
      valid = false;
    }
  }
  return valid;
}

phone.addEventListener('blur', validateMobileNumber)




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

function reset(element) {
  const inputParent = element.parentElement;
  const errorDiv = inputParent.querySelector('.error');

  element.classList.remove('success')
  element.classList.remove('bounce')
  errorDiv.innerText = '';
}


//textarea  
let observation = document.getElementById('observation')

observation.addEventListener('keyup', function () {
  observation.style.height = `63px`         
  observation.style.height = `${observation.scrollHeight}px`
})