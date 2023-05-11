let moreIcon = document.querySelectorAll('.more-icon');
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


const selectField = document.querySelectorAll('.select-field')
const selectOptions = document.querySelectorAll('.select-options');


selectField.forEach((select) => {
  select.addEventListener('click', function () {
    this.classList.toggle('open');
    // selectField.forEach((element) => {
    //   if (this !== element) {
    //     element.classList.remove('open')
    //   }
    // });
  })
});

// selectOptions.forEach(element => {
//   const selectBox = element.closest('.select-box');
//   const selectText = selectBox.querySelector('.select-text');
//   const oldSelectText = selectText.textContent;
//   element.addEventListener('click', function () {
//     const checkboxes = element.querySelectorAll('input[type="checkbox"]');
//     const checkedCount = Array.from(checkboxes).filter(checkbox => checkbox.checked).length;
//     selectText.textContent = (checkedCount === 0) ? `${oldSelectText}` : `${oldSelectText} (${checkedCount})`
//   })
// });

