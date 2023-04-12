let showPassword = document.getElementById('showPassword');
showPassword.addEventListener('click', function () {
  let inputPassword = document.getElementById('password')
  if (password.type === 'password') {
    password.type = 'text'
    this.textContent = 'visibility_off'
  } else {
    password.type = 'password'
    this.textContent = 'visibility'
  }
  inputPassword.focus();
});



// Form validation
const form = document.querySelector('form');
const login = document.getElementById('login');
const password = document.getElementById('password');

login.addEventListener('blur', () => {
  if (login.value.trim() === '') {
    setErrors(login, "Login est requis")
  } else {
    setSuccess(login)
  }

});

password.addEventListener('blur', () => {
  if (password.value.trim() === '') {
    setErrors(password, 'Le mot de passe est requis')
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
    setErrors(login, "Login est requis");
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