const menuToggle = document.getElementById("menu-toggle");
const menuIcon = document.getElementById("menu-icon");
const mobileMenu = document.getElementById("mobile-menu");
const logo = document.getElementById("logo");
const menuItems = document.querySelectorAll("#mobile-menu a");
let menuOpen = false;

menuToggle.addEventListener("click", () => {
    menuOpen = !menuOpen;
    if (menuOpen) {
        mobileMenu.classList.remove("hidden");
        mobileMenu.classList.add("block");
        menuIcon.innerHTML =
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
    } else {
        mobileMenu.classList.remove("block");
        mobileMenu.classList.add("hidden");
        menuIcon.innerHTML =
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>';
    }
});

// evento de click para el menu movile
menuItems.forEach((item) => {
    item.addEventListener("click", () => {
        menuOpen = false;
        mobileMenu.classList.remove("block");
        mobileMenu.classList.add("hidden");
        menuIcon.innerHTML =
            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>';
    });
});

window.addEventListener("resize", () => {
    if (window.innerWidth < 640) {
        logo.classList.remove("h-20");
        logo.classList.add("h-12");
    } else {
        logo.classList.remove("h-12");
        logo.classList.add("h-20");
    }
});

window.addEventListener("scroll", () => {
    if (window.scrollY > 0) {
        document.querySelector("header").classList.add("shadow-lg");
    } else {
        document.querySelector("header").classList.remove("shadow-lg");
    }
});

// Initial check for logo size on load
if (window.innerWidth < 640) {
    logo.classList.remove("h-20");
    logo.classList.add("h-12");
}

// Codigo para ubicar el menu
$(document).ready(function () {
    $('a[href^="#"]').on("click", function (event) {
        var target = $(this.getAttribute("href"));
        if (target.length) {
            event.preventDefault();
            $("html, body")
                .stop()
                .animate(
                    {
                        scrollTop: target.offset().top - 100,
                    },
                    1000
                ); // Cambia 1000 a la duración de la animación que desees
        }
    });
});

//detecta la ubicacion la seccion

/* const menuLinks = document.querySelectorAll("#menu a");
const mobileMenuLinks = document.querySelectorAll("#mobile-menu a li");
const sections = document.querySelectorAll("section");

window.addEventListener("scroll", () => {
  let current = "";
  sections.forEach((section) => {
    const sectionTop = section.offsetTop;
    const sectionHeight = section.clientHeight;
    if (pageYOffset >= sectionTop - sectionHeight / 3) {
      current = section.getAttribute("id");
    }
  });

  menuLinks.forEach((link) => {
    link.classList.remove("text-red-500");
    if (link.href.includes(current)) {
      link.classList.add("text-red-500");
    }
  });

  mobileMenuLinks.forEach((link) => {
    link.classList.remove("bg-gray-700", "text-white");
    if (link.parentNode.href.includes(current)) {
      link.classList.add("bg-gray-700", "text-white");
    }
  });
}); */
