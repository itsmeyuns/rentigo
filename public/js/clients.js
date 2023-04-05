let addForm = document.querySelector('.add-form');

addForm.addEventListener('submit', function (e) {
  if (!validateFields()) {
    e.preventDefault()
  }
})

let inputs = document.querySelectorAll('input');
inputs.forEach((input)=>{
  if (input.id === 'email') {
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


//validate email

let email = document.getElementById('email');
function validateEmail() {
  const emailValue = email.value
  const validRegex =  /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  let valid = true;
  if (emailValue) {
    if (emailValue.match(validRegex)) {
      setSuccess(this)
    } else {
      setErrors(this, 'Adresse e-mail invalide!')
      valid = false;
    }
  } else {
    reset(email)
  }

  return valid;
}

email.addEventListener('blur', validateEmail)


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
  element.classList.remove('success')
}


//textarea  
// let observation = document.getElementById('observation')

// observation.addEventListener('keydown', function () {
//   observation.style.height = `auto`         
//   observation.style.height = `${observation.scrollHeight}px`
// })