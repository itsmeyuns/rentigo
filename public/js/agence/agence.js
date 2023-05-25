const agenceForm = document.getElementById('form-agence');
const agenceButton = document.getElementById('agence-button');



agenceButton.addEventListener('click', function (event) {
  if (!validateFields(agenceForm)) {
    event.preventDefault()
  }
})


function validateFields(form) {
  let valid = true;
  const inputs = form.querySelectorAll('input:not([type="hidden"])');
  inputs.forEach(input => {
      const inputValue = input.value.trim();
      if (!inputValue) {
        setErrors(input, 'Ce champ est obligatoire');
        valid = false;
      } else {
        setSuccess(input);
      }
  })
  console.log(valid);
  return valid;

}

validationOnBlur(agenceForm)
function validationOnBlur(form) {
  let inputs = form.querySelectorAll('input:not([type="hidden"])');
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
