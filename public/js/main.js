// Sidebar
let sidebar = document.getElementById('sidebar');
let sidebareOpen = false;

function openSidebar() {
  if (!sidebareOpen) {
    sidebar.classList.add('sidebar-responsive');
    sidebareOpen = true;
  }
}

function closeSidebar() {
  if (sidebareOpen) {
    sidebar.classList.remove('sidebar-responsive');
    sidebareOpen = false;
  }
}




// Get all links in the sidebar
const links = document.querySelectorAll('.sidebar-list-item');

// Add a click event listener to each link
links.forEach(link => {
    let pathname = new URL(link.firstElementChild.href).pathname;
    if (window.location.pathname.startsWith(pathname)) {
      link.classList.add('active')
    }
})




// Dropdown handling
function openDropdown() {
  let arrowIcon = document.querySelector('.arrow-icon');
  if (arrowIcon.textContent.trim() === "expand_more") {
    arrowIcon.textContent = 'expand_less';
  } else {
    arrowIcon.textContent = 'expand_more';
  }
  document.querySelector('.profile-links').classList.toggle('show');
}


// Notification
let notification = new Notyf({
  duration: 3500,
  dismissible: true,
  position: {
    x: 'right',
    y: 'top'
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

// Back To Top

const scrollToTopButton = document.getElementById('scroll-to-top')
document.addEventListener('scroll', function (e) {
  if (window.scrollY > 200) {
    scrollToTopButton.style.display = 'block'
  } else {
    scrollToTopButton.style.display = 'none'
  }
})
scrollToTopButton.addEventListener("click", () => {
  window.scrollTo({
      top: 0,
      behavior: "smooth"
  });
});