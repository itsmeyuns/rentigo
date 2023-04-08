let addForm = document.querySelector('.add-form');

addForm.addEventListener('submit', function (e) {
  if (!validateFields() || !validateEmail() || !validateDateNaissance() || !validateLogin() || !validatePassword()) {
    e.preventDefault()
  }
})


let separateVerification = ['email', 'telephone', 'dateNaissance', 'motDePass']

let inputs = document.querySelectorAll('input');
inputs.forEach((input)=>{
  input.addEventListener('blur', function () {
    let inputValue = input.value.trim();
    if (!inputValue) {
      setErrors(this, 'Ce champ est obligatoire')
    } else {
      if (separateVerification.includes(input.name)) {
        return;
      }
      setSuccess(this)
    }
  })
})


function validateFields() {
  let valid = true;
  inputs.forEach(input => {
    const inputValue = input.value.trim();
    if (inputValue === '') {
      setErrors(input, 'Ce champ est obligatoire');
      valid = false;
    } else {
      if (separateVerification.includes(input.name)) {
        return;
      }
      setSuccess(input);
    }
  })

  return valid;

}


// Validate Email

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
      setSuccess(this)
    } else {
      setErrors(this, 'Le numéro de téléphone mobile est invalide.')
      valid = false;
    }
  }
  return valid;
}

phone.addEventListener('blur', validateMobileNumber)



let dateNaissance = document.getElementById('dateNaissance')

function validateDateNaissance() {
  const dateNaissanceValue = dateNaissance.value;

  let validDate = true

  // Create a new Date object from the input value
  const date = new Date(dateNaissanceValue);

  const minDate = new Date('1930-01-01')

  
  // Get today's date
  const maxDate = new Date();

  if (dateNaissanceValue) {
    // Check if the input date is a valid date and not in the future
    if (isNaN(date.getTime()) || date >= maxDate || date < minDate ) {
      setErrors(dateNaissance, 'Date de naissance invalide')
      validDate = false
    }
    else {
      setSuccess(dateNaissance)
    }
  }
  return validDate;

}


dateNaissance.addEventListener('blur', validateDateNaissance)




// Show / Hide Password
let showIcon = document.getElementById('showPassword');
let password = document.getElementById('motDePass')
showIcon.addEventListener('click', function () {
  if (password.type === 'password') {
    password.type = 'text'
    this.textContent = 'visibility_off'
  } else {
    password.type = 'password'
    this.textContent = 'visibility'
  }
})


// Validate Password

function validatePassword() {
  let passwordValue = password.value
  let valid = true
  if (passwordValue) {
    if (passwordValue.length > 7) {
      setSuccess(password)
    } else {
      setErrors(password, 'Le mot de pass doit être de 8 caractères ou plus')
      valid = false;
    }
  }

  return valid

}

password.addEventListener('blur', validatePassword)


// Validate Login

// is 5-20 characters long
// no _ or . or a number at the beginning
// allowed _ or . or a number 
// allowed characters
// no . at the end

let login = document.getElementById('login')
function validateLogin() {
  let loginValue = login.value
  let reg = /^(?!\\d)[a-zA-Z][a-zA-Z0-9_.]{3,18}[a-zA-Z0-9]$/
  let valid = true;
  if (loginValue) {
    if (loginValue.match(reg)) {
      setSuccess(login)
    } else {
      setErrors(login, 'Le login est invalide.')
      valid = false;
    }
  }
  return valid;
}
login.addEventListener('blur', validateLogin)

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
