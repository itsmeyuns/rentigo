const options = document.querySelectorAll(".option");
let addVehiculeForm = document.getElementById('add-vehicule-form');
let editVehiculeForm = document.getElementById('edit-vehicule-form');
let addVehiculeButton = document.getElementById('add-vehicule-button');
let editVehiculeButton = document.getElementById('edit-vehicule-button');



addVehiculeButton.addEventListener('click', function (e) {
  if (!validateFields(addVehiculeForm)) {
    e.preventDefault()
  }
})

editVehiculeButton.addEventListener('click', function (e) {
  if (!validateFields(editVehiculeForm)) {
    e.preventDefault()
  }
})


options.forEach((option) => {
  option.addEventListener("click", () => {
    const checkbox = option.querySelector("input[type='checkbox']");
    checkbox.checked = !checkbox.checked;
    option.classList.toggle("checked");
  });
});

function validationOnBlur(form) {
  let inputs = form.querySelectorAll('input:not(input[type=checkbox], input[type=file]), select');
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
validationOnBlur(addVehiculeForm)
validationOnBlur(editVehiculeForm)




// Image Preview

function imagePreview(idInputFile, imgId, previewDiv) { 
  let file = document.getElementById(idInputFile);
  file.addEventListener('change', function () {
    if (this.files[0]) {
      var picture = new FileReader();
      picture.readAsDataURL(this.files[0])
      picture.addEventListener('load', function (event) {
        document.getElementById(imgId).setAttribute('src', event.target.result)
        document.getElementById(previewDiv).style.display = "block"
      })
    }
  })
}

imagePreview("edit_photo", "edit_uploadedImage", "edit_imgPreview")
imagePreview("photo", "uploadedImage", "imgPreview")


function validateFields(form) {
  let valid = true;
  let inputs = form.querySelectorAll('input:not(input[type=checkbox], input[type=file]), select');
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

const numberFields = ['nombre_places', 'nombre_portes', 'prix_location', 'kilometrage', 'edit_nombre_places', 'edit_nombre_portes', 'edit_prix_location', 'edit_kilometrage'];
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
