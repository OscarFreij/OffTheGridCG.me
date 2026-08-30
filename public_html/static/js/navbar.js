function SetActivePage() {
    const currentPath = window.location.pathname.replace(/\/+$/, "") || "/";
    const links = document.querySelectorAll(".navbar-link");

    for (let index = 0; index < links.length; index++) {
        const element = links[index];
        const linkPath = new URL(element.href).pathname.replace(/\/+$/, "") || "/";
        if (linkPath === currentPath)
        {
            element.classList.add("navbar-link-active");
            return;
        }
    }
}

SetActivePage();


function toggleNavbarButton(element)
{
  element.classList.toggle('opened');
  let pNode = element.parentNode;
  pNode.querySelector('.navbar-item-container').classList.toggle('opened');
}

document.querySelector('.navbar-toggler').addEventListener('click', toggleNavbarButton.bind(null, document.querySelector('.navbar-toggler')));