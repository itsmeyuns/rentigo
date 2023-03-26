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