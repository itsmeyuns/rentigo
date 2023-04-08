let addForm = document.querySelector('.add-form');

addForm.addEventListener('submit', function (e) {
  if (!validateFields() || !validateEmail() || !validateMobileNumber()) {
    e.preventDefault()
  }
})


let separateVerification = ['email']

let inputs = document.querySelectorAll('input');
inputs.forEach((input)=>{
  if (input.type === 'email') {
    return
  }
  input.addEventListener('blur', function () {
    let inputValue = input.value.trim();
    if (!inputValue) {
      setErrors(this, 'Ce champ est obligatoire')
    } else {
      setSuccess(this)
    }
  })
})


function validateFields() {
  let valid = true;
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