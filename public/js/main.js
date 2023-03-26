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
    if (window.location.pathname === pathname) {
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