let showPassword = document.getElementById('showPassword');

showPassword.addEventListener('click', function () {
  let inputPassword = this.previousElementSibling;
  if (this.innerHTML == 'visibility') {
    this.innerHTML = 'visibility_off';
    inputPassword.type = 'text';
  } else {
    inputPassword.type = 'password';
    this.innerHTML = 'visibility';
  }
  inputPassword.focus();
});



// Form validation
const form = document.querySelector('form');
const login = document.getElementById('login');
const password = document.getElementById('motDePass');

login.addEventListener('blur', () => {
  if (login.value.trim() === '') {
    setErrors(login, 'login est requis')
  } else {
    setSuccess(login)
  }

});

password.addEventListener('blur', () => {
  if (password.value.trim() === '') {
    setErrors(password, 'le mot de passe est requis')
  } else {
    setSuccess(password)
  }
})

form.addEventListener('submit', e => {
  if (!validateFields()) {
    e.preventDefault();
  }
});

function setErrors(element, message) {
  const inputParent = element.parentElement;
  const errorDiv = inputParent.querySelector('.error');

  errorDiv.innerText = message;
  inputParent.classList.add('error');
  inputParent.classList.remove('success');
}

function setSuccess(element) {
  const inputParent = element.parentElement;
  const errorDiv = inputParent.querySelector('.error');

  errorDiv.innerText = '';
  inputParent.classList.add('success');
  inputParent.classList.remove('error');
}

function validateFields() {
  const loginValue = login.value.trim();
  const passwordValue = password.value.trim();
  let valid = true;
  if (loginValue === '') {
    setErrors(login, 'login est requis');
    valid = false;
  } else {
    setSuccess(login);
  }

  if (passwordValue === '') {
    setErrors(password, 'le mot de passe est requis');
    valid = false;
  } else {
    setSuccess(password);
  }

  return valid;

}