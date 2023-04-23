const options = document.querySelectorAll(".option");
// let searchForm = document.getElementById('search-vehicule-form')
// searchForm.addEventListener('submit', (event)=> event.preventDefault())


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

let addForm = document.querySelector('.add-form');
addForm.addEventListener('submit', function (e) {
  if (!validateFields()) {
    e.preventDefault()
  }
})



let inputs = addForm.querySelectorAll('input:not(input[type=checkbox], input[type=file])');
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



// Image Preview

let file = document.getElementById('photo')
file.addEventListener('change', function () {
  if (this.files[0]) {
    var picture = new FileReader();
    picture.readAsDataURL(this.files[0])
    picture.addEventListener('load', function (event) {
      document.getElementById('uploadedImage').setAttribute('src', event.target.result)
      document.querySelector('.imgPreview').style.display = "block"
    })
  }
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


const numberFields = ['nombrePlaces', 'nombrePortes', 'prixLocation', 'kilometrage'];
numberFields.forEach((field)=>{
  document.getElementById(field).addEventListener('keydown', function (event) {
    onlyNumbers(event)
  })
})

function onlyNumbers(event) {
  const pressedKey = event.keyCode
  const allowedKeyCodes = [48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 46, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105, 109, 8];
  if (allowedKeyCodes.includes(pressedKey)) {
    return true
  } else {
    event.preventDefault()
  }
}
