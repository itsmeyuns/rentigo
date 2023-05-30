const updateInfosForm = document.getElementById('update-infos-form');
const updatePasswordForm = document.getElementById('update-password-form');
const updateInfosButton = document.getElementById('update-infos-button');
const passwordFormButton = document.getElementById('update-password-button');


updateInfosButton.addEventListener('click', function (e) {
  if (!validateFields(updateInfosForm)) {
    e.preventDefault()
  }
})

passwordFormButton.addEventListener('click', function (e) {
  if (!validateFields(updatePasswordForm)) {
    e.preventDefault()
  }
})


validationOnBlur(updateInfosForm);
validationOnBlur(updatePasswordForm);
function validationOnBlur(form) {
  const formId = form.getAttribute('id');
  const inputs = form.querySelectorAll('input, select');
  inputs.forEach((input)=>{
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

// const toggles = document.querySelectorAll('.form-container .toggle')
// toggles.forEach(toggle => {
//   toggle.addEventListener('click', function () {
//     const content = toggle.nextElementSibling;
//     if (content.classList.contains('closed')) {
//       content.classList.remove('closed');
//       content.classList.add('opened');
//     } else {
//       content.classList.add('closed');
//       content.classList.remove('opened');
//     }
    
//   })
// })