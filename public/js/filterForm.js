const moreIcon = document.querySelectorAll('.more-icon');
moreIcon.forEach( (icon, index) => {
  icon.addEventListener('click', function () {
    let moreList = icon.firstElementChild;
    moreIcon.forEach( function (e, i) {
      if (index == i) {
        moreList.classList.toggle('show')
      } else {
        e.firstElementChild.classList.remove('show');
      }
    })
  })
})


// Contrat & Reservation
const filterForm = document.getElementById('filter-form');
const filterButton = document.getElementById('filter-button');

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

const selectField = document.querySelectorAll('.select-field')

selectField.forEach((select) => {
  select.addEventListener('click', function () {
    this.classList.toggle('open');
  })
});