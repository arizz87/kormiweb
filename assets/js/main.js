/**
 * Template Name: Dewi
 * Template URL: https://bootstrapmade.com/dewi-free-multi-purpose-html-template/
 * Updated: Aug 07 2024 with Bootstrap v5.3.3
 * Author: BootstrapMade.com
 * License: https://bootstrapmade.com/license/
 */

(function () {
  "use strict";

  /**
   * Apply .scrolled class to the body as the page is scrolled down
   */
  function toggleScrolled() {
    const selectBody = document.querySelector("body");
    const selectHeader = document.querySelector("#header");
    if (
      !selectHeader.classList.contains("scroll-up-sticky") &&
      !selectHeader.classList.contains("sticky-top") &&
      !selectHeader.classList.contains("fixed-top")
    )
      return;
    window.scrollY > 100
      ? selectBody.classList.add("scrolled")
      : selectBody.classList.remove("scrolled");
  }

  document.addEventListener("scroll", toggleScrolled);
  window.addEventListener("load", toggleScrolled);

  /**
   * Mobile nav toggle
   */
  const mobileNavToggleBtn = document.querySelector(".mobile-nav-toggle");

  function mobileNavToogle() {
    document.querySelector("body").classList.toggle("mobile-nav-active");
    mobileNavToggleBtn.classList.toggle("bi-list");
    mobileNavToggleBtn.classList.toggle("bi-x");
  }
  mobileNavToggleBtn.addEventListener("click", mobileNavToogle);

  /**
   * Hide mobile nav on same-page/hash links
   */
  document.querySelectorAll("#navmenu a").forEach((navmenu) => {
    navmenu.addEventListener("click", () => {
      if (document.querySelector(".mobile-nav-active")) {
        mobileNavToogle();
      }
    });
  });

  /**
   * Toggle mobile nav dropdowns
   */
  document.querySelectorAll(".navmenu .toggle-dropdown").forEach((navmenu) => {
    navmenu.addEventListener("click", function (e) {
      e.preventDefault();
      this.parentNode.classList.toggle("active");
      this.parentNode.nextElementSibling.classList.toggle("dropdown-active");
      e.stopImmediatePropagation();
    });
  });

  /**
   * Preloader
   */
  const preloader = document.querySelector("#preloader");
  if (preloader) {
    window.addEventListener("load", () => {
      preloader.remove();
    });
  }

  /**
   * Scroll top button
   */
  let scrollTop = document.querySelector(".scroll-top");

  function toggleScrollTop() {
    if (scrollTop) {
      window.scrollY > 100
        ? scrollTop.classList.add("active")
        : scrollTop.classList.remove("active");
    }
  }
  scrollTop.addEventListener("click", (e) => {
    e.preventDefault();
    window.scrollTo({
      top: 0,
      behavior: "smooth",
    });
  });

  window.addEventListener("load", toggleScrollTop);
  document.addEventListener("scroll", toggleScrollTop);

  /**
   * Animation on scroll function and init
   */
  function aosInit() {
    AOS.init({
      duration: 600,
      easing: "ease-in-out",
      once: true,
      mirror: false,
    });
  }
  window.addEventListener("load", aosInit);

  /**
   * Initiate glightbox
   */
  const glightbox = GLightbox({
    selector: ".glightbox",
  });

  /**
   * Initiate Pure Counter
   */
  new PureCounter();

  /**
   * Init swiper sliders
   */
  function initSwiper() {
    document.querySelectorAll(".init-swiper").forEach((swiperElement) => {
      if (!swiperElement.querySelector(".swiper-wrapper")) {
        console.warn("Swiper wrapper tidak ditemukan", swiperElement);
        return;
      }

      const paginationEl = swiperElement.querySelector(".swiper-pagination");

      new Swiper(swiperElement, {
        slidesPerView: 3,
        spaceBetween: 30,
        loop: true,

        autoplay: {
          delay: 3000,
          disableOnInteraction: false,
        },

        pagination: paginationEl
          ? {
              el: paginationEl,
              clickable: true,
            }
          : false,

        breakpoints: {
          320: { slidesPerView: 1 },
          768: { slidesPerView: 2 },
          992: { slidesPerView: 3 },
        },
      });
    });
  }

  window.addEventListener("load", initSwiper);

  /**
   * Init isotope layout and filters
   */
  document.querySelectorAll(".isotope-layout").forEach(function (isotopeItem) {
    let layout = isotopeItem.getAttribute("data-layout") ?? "masonry";
    let filter = isotopeItem.getAttribute("data-default-filter") ?? "*";
    let sort = isotopeItem.getAttribute("data-sort") ?? "original-order";

    let initIsotope;
    imagesLoaded(isotopeItem.querySelector(".isotope-container"), function () {
      initIsotope = new Isotope(
        isotopeItem.querySelector(".isotope-container"),
        {
          itemSelector: ".isotope-item",
          layoutMode: layout,
          filter: filter,
          sortBy: sort,
        },
      );
    });

    isotopeItem
      .querySelectorAll(".isotope-filters li")
      .forEach(function (filters) {
        filters.addEventListener(
          "click",
          function () {
            isotopeItem
              .querySelector(".isotope-filters .filter-active")
              .classList.remove("filter-active");
            this.classList.add("filter-active");
            initIsotope.arrange({
              filter: this.getAttribute("data-filter"),
            });
            if (typeof aosInit === "function") {
              aosInit();
            }
          },
          false,
        );
      });
  });

  /**
   * Correct scrolling position upon page load for URLs containing hash links.
   */
  window.addEventListener("load", function (e) {
    if (window.location.hash) {
      if (document.querySelector(window.location.hash)) {
        setTimeout(() => {
          let section = document.querySelector(window.location.hash);
          let scrollMarginTop = getComputedStyle(section).scrollMarginTop;
          window.scrollTo({
            top: section.offsetTop - parseInt(scrollMarginTop),
            behavior: "smooth",
          });
        }, 100);
      }
    }
  });

  /**
   * Navmenu Scrollspy
   */
  let navmenulinks = document.querySelectorAll(".navmenu a");

  function navmenuScrollspy() {
    navmenulinks.forEach((navmenulink) => {
      if (!navmenulink.hash) return;
      let section = document.querySelector(navmenulink.hash);
      if (!section) return;
      let position = window.scrollY + 200;
      if (
        position >= section.offsetTop &&
        position <= section.offsetTop + section.offsetHeight
      ) {
        document
          .querySelectorAll(".navmenu a.active")
          .forEach((link) => link.classList.remove("active"));
        navmenulink.classList.add("active");
      } else {
        navmenulink.classList.remove("active");
      }
    });
  }
  window.addEventListener("load", navmenuScrollspy);
  document.addEventListener("scroll", navmenuScrollspy);
})();

new Swiper(".inorga-slider", {
  loop: true,
  speed: 6000, // makin besar makin halus
  slidesPerView: 5,
  spaceBetween: 30,

  autoplay: {
    delay: 0,
    disableOnInteraction: false,
    pauseOnMouseEnter: false,
    reverseDirection: false, // false = kiri ➜ kanan | true = kanan ➜ kiri
  },

  freeMode: {
    enabled: true,
    momentum: false,
    momentumBounce: false,
  },

  allowTouchMove: false, // 🔥 MATIKAN DRAG
  simulateTouch: false,

  watchSlidesProgress: true,
  watchOverflow: false,

  breakpoints: {
    320: { slidesPerView: 2 },
    576: { slidesPerView: 3 },
    768: { slidesPerView: 4 },
    1200: { slidesPerView: 5 },
  },
});

document.addEventListener("DOMContentLoaded", function () {
  const itemsPerPage = 6;
  const items = document.querySelectorAll(".service-card");
  const pagination = document.getElementById("pagination");

  if (items.length <= itemsPerPage) return;

  let currentPage = 1;
  const totalPages = Math.ceil(items.length / itemsPerPage);

  function showPage(page) {
    items.forEach((item, index) => {
      item.style.display =
        index >= (page - 1) * itemsPerPage && index < page * itemsPerPage
          ? "block"
          : "none";
    });

    document
      .querySelectorAll(".pagination li")
      .forEach((li) => li.classList.remove("active"));

    document
      .querySelector(`.pagination li[data-page="${page}"]`)
      .classList.add("active");
  }

  function createPagination() {
    for (let i = 1; i <= totalPages; i++) {
      const li = document.createElement("li");
      li.className = "page-item";
      li.dataset.page = i;
      li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
      li.addEventListener("click", function (e) {
        e.preventDefault();
        currentPage = i;
        showPage(currentPage);
      });
      pagination.appendChild(li);
    }
  }

  createPagination();
  showPage(currentPage);
});

document.addEventListener("DOMContentLoaded", function () {
  const cards = document.querySelectorAll(".service-card");
  const button = document.getElementById("toggleButton");
  const pagination = document.getElementById("paginationWrapper");
  if (!pagination) {
    console.warn("portfolio-pagination tidak ditemukan");
    return;
  }
  const limit = 6;
  let expanded = false;

  function showLimited() {
    cards.forEach((card, index) => {
      card.style.display = index < limit ? "block" : "none";
    });

    pagination.style.display = "block";
    button.textContent = "Berita Selengkapnya";
    expanded = false;
  }

  function showAll() {
    cards.forEach((card) => {
      card.style.display = "block";
      card.style.opacity = 0;
      card.style.transition = "opacity 0.4s ease";
      setTimeout(() => (card.style.opacity = 1), 50);
    });

    pagination.style.display = "none";
    button.textContent = "Kembali";
    expanded = true;
  }

  // INIT
  showLimited();

  // TOGGLE
  button.addEventListener("click", function () {
    expanded ? showLimited() : showAll();
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const itemsPerPage = 6;
  const items = document.querySelectorAll(".portfolio-item");
  const pagination = document.getElementById("portfolio-pagination");
  const totalPages = Math.ceil(items.length / itemsPerPage);

  if (!pagination) {
    console.warn("portfolio-pagination tidak ditemukan");
    return;
  }

  let iso;

  function showPage(page) {
    // animasi keluar
    items.forEach((item) => {
      if (item.classList.contains("active-page")) {
        item.classList.add("animate-out");
      }
    });

    setTimeout(() => {
      items.forEach((item, index) => {
        item.classList.remove("active-page", "animate-out");

        if (index >= (page - 1) * itemsPerPage && index < page * itemsPerPage) {
          item.classList.add("active-page");
        }
      });

      // indikator aktif
      document
        .querySelectorAll("#portfolio-pagination .page-item")
        .forEach((li, i) => {
          li.classList.toggle("active", i === page - 1);
        });

      if (iso) {
        imagesLoaded(".isotope-container", function () {
          iso.layout();
        });
      }
    }, 250); // durasi animasi keluar
  }

  function buildPagination() {
    pagination.innerHTML = "";
    for (let i = 1; i <= totalPages; i++) {
      const li = document.createElement("li");
      li.className = "page-item" + (i === 1 ? " active" : "");
      li.innerHTML = `<a class="page-link">${i}</a>`;
      li.addEventListener("click", () => showPage(i));
      pagination.appendChild(li);
    }
  }

  buildPagination();
  showPage(1);

  imagesLoaded(".isotope-container", function () {
    iso = new Isotope(".isotope-container", {
      itemSelector: ".portfolio-item",
      // layoutMode: "fitRows",
      transitionDuration: "0s",
    });
  });
});
