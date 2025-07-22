function SetActivePage() {
    const params = new Proxy(new URLSearchParams(window.location.search), {
        get: (searchParams, prop) => searchParams.get(prop),
      });
      let value = params.page;

      if (value == null)
      {
          console.log("no page specified in URL. Setting page to default: home");
          value = "home";
      }

      for (let index = 0; index < $(".navbar-link").length; index++) {
        const element = $(".navbar-link")[index];
        if (element.href.includes(value))
        {
            element.classList.add("navbar-link-active");
            console.log("current page: "+value);
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