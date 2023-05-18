let addClientForm = document.getElementById('add-client-form');
let addClientButton = document.getElementById('add-client-button');
let editClientButton = document.getElementById('edit-client-button');
let editClientForm = document.getElementById('edit-client-form');

addClientButton.addEventListener('click', function (e) {
  if (!validateFields(addClientForm)) {
    e.preventDefault()
  } 
})

validationOnBlur(addClientForm)


editClientButton.addEventListener('click', function (e) {
  if (!validateFields(editClientForm)) {
    e.preventDefault()
  } 
})

validationOnBlur(editClientForm)


function validationOnBlur(form) { 
  let inputs = form.querySelectorAll('input, select');
  inputs.forEach((input)=>{
    input.addEventListener('blur', function () {
      let inputValue = input.value.trim();
      if (!inputValue) {
        if (input.type === 'email') {reset(input); return};
        setErrors(input, 'Ce champ est obligatoire')
      } else {
        setSuccess(input)
      }
    })
  })
}

function validateFields(form) {
  let valid = true;
  const fields = form.querySelectorAll('input, select');

  fields.forEach(field => {
    if (field.type === "email") {
      return
    }
    const inputValue = field.value.trim();
    if (inputValue === '') {
      setErrors(field, 'Ce champ est obligatoire');
      valid = false;
    } else {
      setSuccess(field);
    }

  })

  return valid;

}


function reset(element) {
  const inputParent = element.parentElement;
  const errorDiv = inputParent.querySelector('.error');

  element.classList.remove('success')
  element.classList.remove('bounce')
  errorDiv.innerText = '';
}
