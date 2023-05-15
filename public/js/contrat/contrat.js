const addContratForm2 = document.getElementById('add-contrat-form');
const editContratForm2 = document.getElementById('edit-contrat-form');
const addContratButton = document.getElementById('add-contrat-button');
const editContratButton = document.getElementById('edit-contrat-button');
const filterForm = document.getElementById('filter-form');
const filterButton = document.getElementById('filter-button');


addContratButton.addEventListener('click', function (event) {
  if (!validateFields(addContratForm2)) {
    event.preventDefault()
  }
})

editContratButton.addEventListener('click', function (event) {
  if (!validateFields(editContratForm2)) {
    event.preventDefault()
  }
})

function validateFields(form) {
  let valid = true;
  let inputs = form.querySelectorAll('input, select');
  inputs.forEach(input => {
    if (!input.classList.contains('readonly-input')) {
      const inputValue = input.value.trim();
      if (inputValue === '') {
        setErrors(input, 'Ce champ est obligatoire');
        valid = false;
      } else {
        setSuccess(input);
      }
    }
  })

  return valid;

}

validationOnBlur(addContratForm2)
function validationOnBlur(form) {
  let inputs = form.querySelectorAll('input, select');
  inputs.forEach((input)=>{
    if (!input.classList.contains('readonly-input')) {
      input.addEventListener('blur', function () {
        let inputValue = input.value.trim();
        if (!inputValue) {
          setErrors(this, 'Ce champ est obligatoire')
        } else {
          setSuccess(this)
        }
      })
    }
  })
}

// Prevent Filter Form From Submitting If It's Empty
filterButton.addEventListener('click', function (event) {
  // Check If atleast one checkbox is checked
  const checkboxes = filterForm.querySelectorAll('input[type="checkbox"]');
  let isChecked = false;
  const checkedCount = Array.from(checkboxes).filter(checkbox => checkbox.checked).length;
  isChecked = (checkedCount > 0) ?? true;

  // Check If Start Date and End Date are Empty
  const startDate = document.getElementById('startDate')
  const endDate = document.getElementById('endDate')
  let validDate = false;
  validDate = (!startDate.value.trim() && !endDate.value.trim()) ? false : true;
  if (!isChecked && !validDate) {
    event.preventDefault();
  }
})


const inputs = [
  { name: 'vehicules', id: 'vehicules' },
  { name: 'prix_location', id: 'prix_location' },
  { name: 'date_debut', id: 'date_debut' },
  { name: 'date_fin', id: 'date_fin' },
  { name: 'montant', id: 'montant' }
];

const editInputs = [
  { name: 'edit_vehicules', id: 'edit_vehicules' },
  { name: 'edit_prix_location', id: 'edit_prix_location' },
  { name: 'edit_date_debut', id: 'edit_date_debut' },
  { name: 'edit_date_fin', id: 'edit_date_fin' },
  { name: 'edit_montant', id: 'edit_montant' }
];

// Create Contrat
inputs.forEach(input => {
  const el = document.getElementById(input.id);
  el.addEventListener('change', () => updateMontant(inputs, addContratForm2));
});

// Edit Contrat
editInputs.forEach(input => {
  const el = document.getElementById(input.id);
  el.addEventListener('change', () => updateMontant(editInputs, editContratForm2));
});

function updateMontant(inputs, form) {
  const values = {};
  let diffDays = 0;
  inputs.forEach(input => {
    const el = form.querySelector(`#${input.id}`);
    values[input.name] = el.value;
  });

  const prixLocation = parseFloat(values['prix_location']) || parseFloat(values['edit_prix_location']) || 0;
  const dateDebut = values['date_debut'] || values['edit_date_debut'];
  const dateFin = values['date_fin'] || values['edit_date_fin'];

  diffDays = dateDiffDays(dateDebut, dateFin);

  console.log(values, prixLocation, dateDebut, dateFin);

  const montantInput = form.querySelector('#montant') || form.querySelector('#edit_montant');
  if (!isNaN(prixLocation) && diffDays > 0) {
    const montant = prixLocation * diffDays;
    montantInput.value = montant.toFixed(2);
  } else {
    montantInput.value = '';
  }
}

function dateDiffDays(startDate, endDate) {  
  const dateDebut = new Date(startDate);
  const dateFin = new Date(endDate);
  let diffDays = 0;
  if (dateFin > dateDebut) {
    const diffTime = Math.abs(dateFin - dateDebut);
    diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
  }
  return diffDays;
}
