const options = document.querySelectorAll(".option");

options.forEach((option) => {
  option.addEventListener("click", () => {
    const checkbox = option.querySelector("input[type='checkbox']");
    checkbox.checked = !checkbox.checked;
    option.classList.toggle("checked");
  });
});

let sp = document.querySelectorAll('span.delete');
sp.forEach(element => {
  element.addEventListener('click', function () {
    alert('Are u sure ?')
  })
});


// document.getElementById('file').addEventListener('change', function(e) {
//   if (!e.target.files[0]) {
//     alert('You selected ' + e.target.files[0].name);
//   } else {
//     alert('wa chrif')
//   }
// });


let addForm = document.querySelector('.add-form');

addForm.addEventListener('submit', function (e) {
  if (!validateFields()) {
    e.preventDefault()
  }
  // validateFields()
})



let inputs = document.querySelectorAll('input:not(input[type=checkbox], input[type=file])');
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


function validateFields() {
  let valid = true;
  let photo = document.getElementById('photo')
  const photoParent = photo.parentElement;
  inputs.forEach(input => {
    const inputValue = input.value.trim();
    if (inputValue === '') {
      setErrors(input, 'Ce champ est obligatoire');
      valid = false;
    } else {
      setSuccess(input);
    }
  })


  if (!photo.value) {
    setErrors(photo, 'Ce champ est obligatoire');
    valid = false;
  } else {
    photoParent.classList.add('success')
    photoParent.querySelector('.error').textContent =  ''
  }

  return valid;

}