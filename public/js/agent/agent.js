const addAgentForm2 = document.getElementById('add-agent-form');
const editAgentForm2 = document.getElementById('edit-agent-form');
const addAgentButton = document.getElementById('add-agent-button');
const editAgentButton = document.getElementById('edit-agent-button');


addAgentButton.addEventListener('click', function (e) {
  if (!validateFields(addAgentForm2)) {
    e.preventDefault()
  }
})

editAgentButton.addEventListener('click', function (e) {
  if (!validateFields(editAgentForm2)) {
    e.preventDefault()
  }
})


validationOnBlur(addAgentForm2);
validationOnBlur(editAgentForm2);
function validationOnBlur(form) {
  const formId = form.getAttribute('id');
  const inputs = form.querySelectorAll('input, select');
  inputs.forEach((input)=>{
    if (formId === 'edit-agent-form' && input.type === 'password') return 
    input.addEventListener('blur', function () {
      let inputValue = input.value.trim();
      if (!inputValue) {
        setErrors(this, 'Ce champ est obligatoire')
      } else {
        setSuccess(this)
      }
    })
  })
}

function validateFields(form) {
  let valid = true;
  const formId = form.getAttribute('id');
  const inputs = form.querySelectorAll('input, select');
  inputs.forEach(input => {
    if (formId === 'edit-agent-form' && input.type === 'password') return 
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

// Show / Hide Password
const showPasswordIcon = document.getElementById('showPassword');
const editShowPasswordIcon = document.getElementById('editShowPassword');
const passwordInput = document.getElementById('password');
const editPasswordInput = document.getElementById('edit_password');

function togglePasswordVisibility(input, icon) {
  if (input.type === 'password') {
    input.type = 'text';
    icon.textContent = 'visibility_off';
  } else {
    input.type = 'password';
    icon.textContent = 'visibility';
  }
}

showPasswordIcon.addEventListener('click', () => togglePasswordVisibility(passwordInput, showPasswordIcon));

editShowPasswordIcon.addEventListener('click', () => togglePasswordVisibility(editPasswordInput, editShowPasswordIcon));
